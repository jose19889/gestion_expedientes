<?php
namespace App\Services;

class NotificationService
{
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function notificarCambioDepartamento($expedienteId, $departamentoId)
    {
        $usuarios = $this->db->table('usuarios')
            ->where('departamento_id', $departamentoId)
            ->get()
            ->getResult();

        $expediente = $this->db->table('expedientes')
            ->where('id', $expedienteId)
            ->get()
            ->getRow();

        foreach ($usuarios as $usuario) {
            $this->db->table('notificaciones')->insert([
                'usuario_id' => $usuario->id,
                'departamento_id' => $departamentoId,
                'titulo' => 'Nuevo expediente asignado',
                'mensaje' => 'Se ha asignado el expediente #' . $expedienteId,
                'tipo' => 'asignacion',
                'expediente_id' => $expedienteId
            ]);
        }

        $this->enviarEmail($usuarios, $expediente);
    }

    private function enviarEmail($usuarios, $expediente)
    {
        foreach ($usuarios as $usuario) {
            // implementar envío
        }
    }
}