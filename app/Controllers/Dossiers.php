<?php

namespace App\Controllers;

use App\Models\DossierModel;
use App\Models\UserModel;
use App\Models\TipoDossierModel;
use App\Models\DeptsModel; // tu modelo de departamentos
use App\Models\EstadoModel;
use App\Models\FileModel;
use App\Models\NotificationModel;
use CodeIgniter\Controller;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Services\NotificationService;
use Config\Database;


require_once APPPATH . 'ThirdParty/phpqrcode/qrlib.php';
//require_once APPPATH . 'ThirdParty/dompdf/autoload.inc.php';
class Dossiers extends BaseController
{
    protected $DossierModel;
    protected $DeptsModel;

    public function __construct()
    {
        $this->DossierModel = new DossierModel();
        $this->DeptsModel   = new DeptsModel();
         $this->UserModel = new UserModel();
           $this->TipoDossierModel = new TipoDossierModel();
              $this->EstadoModel = new EstadoModel();
               $this->FileModel = new FileModel();
        
    }
public function index()
{
    helper('navbar');

    // Datos del navbar
    $navbarData = getNavbarData();

    $session = session();
    $userId     = $session->get('user_id');
    $userRoleId = $session->get('role_id');
    $userDeptId = $session->get('departamento_id');

    $dossierModel      = new DossierModel();
    $departamentoModel = new DeptsModel();
    $estadoModel       = new EstadoModel();

    $filtros = [
        'departamento' => $this->request->getGet('departamento'),
        'estado'       => $this->request->getGet('estado'),
        'prioridad'    => $this->request->getGet('prioridad'),
    ];

    $expedientes = $dossierModel->getExpedientesData($userId, $userRoleId, $userDeptId, $filtros);
    $departamentos = $departamentoModel->getDepartamentos();
    $estados       = $estadoModel->orderBy('orden', 'ASC')->findAll();

    // Pasamos navbarData y otros datos
    $data = [
        'expedientes'   => $expedientes,
        'departamentos' => $departamentos,
        'estados'       => $estados,
        'filtros'       => $filtros,
        'userRoleId'    => $userRoleId,
        'userId'        => $userId,
        'navbarData'    => $navbarData,  // ✅ navbar completo
    ];

    return view('dossier/index', $data);
}
    public function create()
{
    // Generar un código provisional para mostrar en el formulario
    $codigo = 'EXP-' . date('Y') . '-' . strtoupper(uniqid());

    // Obtener usuario actual desde sesión
    $user_id = session()->get('user_id');

    // Instanciar modelos si no lo hiciste en el constructor
    $this->TipoDossierModel = new \App\Models\TipoDossierModel();
    $this->UserModel = new \App\Models\UserModel();

    // Obtener todos los tipos de expediente
    $tipos = $this->TipoDossierModel->findAll();

    // Obtener datos del usuario desde el modelo
    $user = $this->UserModel->find($user_id);

    // Traer estados dinámicos
    $estadoModel = new EstadoModel();
    $estados = $estadoModel->getEstados();

    // Validar si el usuario tiene el permiso 'crear_expediente_saltar_recepcion'
    $user_can_change = false;
    if ($user && isset($user['permissions'])) {
        // Suponiendo que 'permissions' es un campo JSON o array con permisos
        $permissions = is_array($user['permissions']) ? $user['permissions'] : json_decode($user['permissions'], true);
        $user_can_change = in_array('crear_expediente_saltar_recepcion', $permissions);
    }

    // Pasar datos a la vista
    return view('dossier/create', [
        'codigo'          => $codigo,
        'tipos'           => $tipos,           // <-- Pasar $tipos a la vista
        'estados' => $estados,
        'user_can_change' => $user_can_change
    ]);
}
    /*|--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */
public function store()
{
    helper(['form', 'url']);

    // 1️⃣ Validar que la petición sea POST
    if ($this->request->getMethod() !== 'post') {
        return redirect()->to('/create-dossier');
    }

    // 2️⃣ Validar sesión de usuario
    $session = session();
    $user_id = $session->get('user_id');

    if (!$user_id) {
        $session->setFlashdata('danger', 'Debes iniciar sesión para crear un expediente.');
        return redirect()->to('/sign-in');
    }

    $userModel = new \App\Models\UserModel();
    $user = $userModel->find($user_id);

    if (!$user) {
        $session->setFlashdata('danger', 'Usuario no encontrado.');
        return redirect()->to('/sign-in');
    }

    // 3️⃣ Validar formulario
    $rules = [
        'titulo'                 => 'required|min_length[3]',
        'descripcion'            => 'required|min_length[5]',
        'tipo_expedientes'       => 'required|integer|is_not_unique[tipos_expedientes.id]',
        'departamento_actual'    => 'required|integer',
        'prioridad'              => 'required',
        'nivel_confidencialidad' => 'required',
        'estado_id'              => 'required|integer'
    ];

    if (!$this->validate($rules)) {
        $session->setFlashdata('danger', 'Error: revise los datos del formulario.');
        return redirect()->to('/create-dossier')->withInput();
    }

    // 4️⃣ Generar código y hash
    $codigo   = 'EXP-' . date('Y') . '-' . strtoupper(uniqid());
    $hash     = bin2hex(random_bytes(32));
    $asignado = $this->request->getPost('asignado_a');

    // 5️⃣ Generar QR
    $urlPublica = base_url("consulta/" . $hash);
    $qrDir = WRITEPATH . 'uploads/qrs/';
    if (!is_dir($qrDir)) mkdir($qrDir, 0777, true);
    $qrFile = 'exp_' . uniqid() . '.png';
    \QRcode::png($urlPublica, $qrDir . $qrFile);

    // 6️⃣ Preparar datos
    $data = [
        'codigo'                 => $codigo,
        'hash_publico'           => $hash,
        'titulo'                 => $this->request->getPost('titulo'),
        'descripcion'            => $this->request->getPost('descripcion'),
        'tipo_expedientes'       => (int) $this->request->getPost('tipo_expedientes'),
        'departamento_actual'    => (int) $this->request->getPost('departamento_actual'),
        'asignado_a'             => $asignado ?: null,
        'prioridad'              => $this->request->getPost('prioridad'),
        'nivel_confidencialidad' => $this->request->getPost('nivel_confidencialidad'),
        'estado_id'              => (int) $this->request->getPost('estado_id'),
        'creado_por'             => $user_id,
        'fecha_creacion'         => date('Y-m-d H:i:s'),
        'fecha_actualizacion'    => date('Y-m-d H:i:s'),
        'codigo_qr'              => 'writable/uploads/qrs/' . $qrFile
    ];

    // 7️⃣ Insertar expediente
    /*$this->DossierModel->insert($data);
    $dossier_id = $this->DossierModel->getInsertID();

    // 8️⃣ Guardar archivos adjuntos
    $files = $this->request->getFileMultiple('expedientes');

    if ($files) {
        $uploadPath = WRITEPATH . 'uploads/expedientes/';
        if (!is_dir($uploadPath)) mkdir($uploadPath, 0777, true);

        foreach ($files as $file) {
            if ($file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move($uploadPath, $newName);

                $this->FileModel->insert([
                    'expediente_id'   => $dossier_id,
                    'nombre_original' => $file->getClientName(),
                    'ruta_archivo'    => 'writable/uploads/expedientes/' . $newName,
                    'fecha_subida'    => date('Y-m-d H:i:s')
                ]);
            }
        }
    }

    // 9️⃣ Redirigir con éxito
    $session->setFlashdata('success', 'Expediente creado correctamente.');
    return redirect()->to('/dossiers');*/
    // 7️⃣ Guardar expediente
    $this->DossierModel->insert($data);
    $dossier_id = $this->DossierModel->getInsertID();

    if (!$dossier_id) {
        session()->setFlashdata('danger', 'Error: No se pudo crear el expediente.');
        return redirect()->to('/dossiers/create')->withInput();
    }

    // 8️⃣ Subir archivos adjuntos
    $files = $this->request->getFileMultiple('expedientes');

    if ($files) {
        $uploadPath = WRITEPATH . 'uploads/expedientes/';
        if (!is_dir($uploadPath)) mkdir($uploadPath, 0777, true);

        foreach ($files as $file) {
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move($uploadPath, $newName);

                $this->FileModel->insert([
                    'expediente_id'   => $dossier_id,
                    'nombre_original' => $file->getClientName(),
                    'ruta_archivo'    => 'writable/uploads/expedientes/' . $newName,
                    'tipo'            => $file->getClientExtension(), // opcional
                    'subido_por'      => $user_id
                ]);
            }
        }
    }

    // 9️⃣ Redirigir con éxito
    session()->setFlashdata('success', 'Expediente creado correctamente.');
    return redirect()->to('/dossiers');
}

public function edit($id = null)
{
    helper(['form', 'url']);

     $usuarioId = $this->request->getPost('usuario_id');

    if (!$id) {
        return redirect()->to('/dossiers')->with('danger', 'Expediente no especificado.');
    }

    $dossier = (object) $this->DossierModel->find($id);

    if (!$dossier) {
        return redirect()->to('/dossiers')->with('danger', 'Expediente no encontrado.');
    }

    $archivos = $this->FileModel->getByExpediente($id);

    $data = [
        'dossier'       => $dossier,
        'archivos'      => $archivos,
        'departamentos' => array_map(fn($d) => (object)$d, $this->DeptsModel->findAll()),
    'estados'       => array_map(fn($e) => (object)$e, $this->EstadoModel->findAll())
    ];

    return view('dossier/edit', $data);
}

public function update($id = null)
{
    helper(['form', 'url']);

    if (!$id) {
        return redirect()->to('/dossiers')->with('danger', 'Expediente no especificado.');
    }

    //$dossier = $this->DossierModel->find($id);
    $dossier = (object) $this->DossierModel->find($id);

    if (!$dossier) {
        return redirect()->to('/dossiers')->with('danger', 'Expediente no encontrado.');
    }

    $rules = [
        'titulo'                 => 'required|min_length[3]',
        'descripcion'            => 'required|min_length[5]',
        //'departamento_actual'    => 'required|integer',
        'estado_id'              => 'required|integer'
    ];

   

    if (!$this->validate($rules)) {
         dd($rules); // Si no está vacío, verás el array con los datos de la BD
       // return redirect()->back()->withInput()->with('danger', 'Revise los datos del formulario.');
    }

    $data = [
        'titulo'              => $this->request->getPost('titulo'),
        'descripcion'         => $this->request->getPost('descripcion'),
        'estado_id'           => $this->request->getPost('estado_id'),
        'prioridad'           => $this->request->getPost('prioridad'),
        'nivel_confidencialidad' => $this->request->getPost('nivel_confidencialidad'),
        'fecha_actualizacion' => date('Y-m-d H:i:s')
    ];

    $this->DossierModel->update($id, $data);
    session()->setFlashdata('success', 'Expediente actualizadog correctamente.');
    return redirect()->to('/dossiers');

   
}
public function descargar($id)
{
    $dossier = $this->DossierModel->find($id);

    if (!$dossier) {
        return redirect()->back()->with('error', 'Expediente no encontrado.');
    }

    // Cargamos la librería
    $dompdf = new \Dompdf\Dompdf();

    // Preparamos la imagen del QR en Base64 para que el PDF la reconozca
    $path = FCPATH . $dossier['codigo_qr'];
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $qrBase64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

    // Cargamos una vista HTML y le pasamos los datos
    $html = view('dossiers/pdf_template', [
        'dossier' => $dossier,
        'qrCode'  => $qrBase64
    ]);

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    // Descarga automática
    return $dompdf->stream("Expediente_" . $dossier['codigo'] . ".pdf", ["Attachment" => true]);
}

public function display_file($fileId)
{
    $file = $this->FileModel->find($fileId);
    if (!$file) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Archivo no encontrado');
    }

    // La ruta completa del archivo en writable
    $rutaArchivo = WRITEPATH . 'uploads/expedientes/' . basename($file['ruta_archivo']);

    if (!file_exists($rutaArchivo)) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Archivo no encontrado en el servidor');
    }

    // Detectamos el MIME
    $mime = mime_content_type($rutaArchivo);

    return $this->response
                ->setHeader('Content-Type', $mime)
                ->setHeader('Content-Disposition', 'inline; filename="' . $file['nombre_original'] . '"')
                ->setBody(file_get_contents($rutaArchivo));
}



public function generarPDF($dossier_id)
{
    // 1️⃣ Obtener datos del expediente
    $dossier = $this->DossierModel->find($dossier_id);
    if (!$dossier) {
        return redirect()->to('/dossiers')->with('danger', 'Expediente no encontrado.');
    }

    // 2️⃣ Obtener archivos adjuntos
    $archivos = $this->FileModel->getByExpediente($dossier_id);

    // 3️⃣ Preparar HTML
    $html = view('dossiers/pdf_template', [
        'dossier' => $dossier,
        'archivos' => $archivos
    ]);

    // 4️⃣ Configurar Dompdf
    $options = new Options();
    $options->set('isRemoteEnabled', true); // Permite usar imágenes externas
    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    // 5️⃣ Enviar PDF al navegador
    $dompdf->stream("expediente_{$dossier['codigo']}.pdf", ["Attachment" => true]);
}


    public function mover($id)
{
    $dossierModel = new \App\Models\DossierModel();
    $departamentoModel = new \App\Models\DeptsModel();

    $expediente = $dossierModel->find($id);
    $departamentos = $departamentoModel->findAll();

    return view('dossier/move', [
        'expediente' => $expediente,
        'departamentos' => array_map(fn($d) => (object)$d, $this->DeptsModel->findAll()),
    'estados'       => array_map(fn($e) => (object)$e, $this->EstadoModel->findAll())
    ]);

}


public function assign($expedienteId)
    {
        $session = session();
        $userRoleId = $session->get('role_id');

        // Solo Director (1) o Jefe de Sección (2)
        if(!in_array($userRoleId, [1,2])){
            $session->setFlashdata('error', 'No tienes permiso para asignar este expediente.');
            return redirect()->back();
        }

        $dossierModel = new DossierModel();
        $expediente   = $dossierModel->find($expedienteId);

        if(!$expediente){
            $session->setFlashdata('error', 'Expediente no encontrado.');
            return redirect()->back();
        }

        // Usuarios disponibles para asignar (puedes filtrar por departamento si quieres)
        $usuarioModel = new UserModel();
        $usuarios = $usuarioModel->orderBy('nombre', 'ASC')->findAll(); // normalmente array de arrays
        $usuarios = array_map(fn($u) => (object) $u, $usuarios); // convertir cada usuario a objeto

        $data = [
            'expediente' => $expediente,
            'usuarios'   => $usuarios
        ];

       

        return view('dossier/assign', $data);
    }



public function assign_save($expedienteId)
{
    $usuarioId = $this->request->getPost('usuario_id');

    $dossierModel = new \App\Models\DossierModel();

    $data = [
        'asignado_a' => $usuarioId
    ];

    $resultado = $dossierModel->update($expedienteId, $data);

   echo "<pre>";
print_r([
    'expediente_id' => $expedienteId,
    'usuario_id' => $usuarioId,
    'resultado_update' => $resultado
]);
echo "</pre>";
exit;
}



public function UpdateMovement($id)
{
    $dossierModel = new \App\Models\DossierModel();
    $movModel     = new \App\Models\DossierMovementModel();

    $expediente = $dossierModel->find($id);

    if(!$expediente){
        return redirect()->back()->with('error','Expediente no encontrado');
    }

    $departamentoOrigen  = $expediente->departamento_actual;
    $departamentoDestino = $this->request->getPost('departamento_id');

    // ⚡ Actualiza el expediente correctamente
    $dossierModel->update($id, [
        'departamento_actual' => $departamentoDestino
    ]);

    // 🔔 Notificaciones (CORREGIDO)
    $notificacionService = new \App\Services\NotificationService(\Config\Database::connect());

    $notificacionService->notificarCambioDepartamento($id, $departamentoDestino);

    // 📜 Registrar movimiento histórico
    $movModel->insert([
        'expediente_id' => $id,
        'departamento_origen' => $departamentoOrigen,
        'departamento_destino' => $departamentoDestino,
        'usuario_id' => session()->get('user_id'),
        'accion' => 'Mover expediente',
        'comentario' => $this->request->getPost('comentario'),
        'ip_origen' => $this->request->getIPAddress(),
        'fecha' => date('Y-m-d H:i:s')
    ]);

    return redirect()->to('/dossiers')->with('success','Expediente movido correctamente');
}

public function getNotificacionesUsuario($usuarioId)
{
    return $this->db->table('notificaciones')
        ->where('usuario_id', $usuarioId)
        ->orderBy('created_at', 'DESC')
        ->get()
        ->getResult();
}
public function view($id) {
    // 1. Obtenemos los datos básicos del expediente
    $data['expediente'] = $this->DossierModel->find($id); 
    
    // 2. Obtenemos los movimientos (Asegúrate de que la llave sea 'movimientos')
    $data['movimientos'] = $this->DossierModel->get_by_id($id);
    
    return view('dossier/view', $data);
}

public function marcarComoLeida($id)
{
    return $this->db->table('notificaciones')
        ->where('id', $id)
        ->update(['leida' => 1]);
}

}