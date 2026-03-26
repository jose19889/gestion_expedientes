<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Notifications extends Controller
{
    protected $db;

  public function __construct()
{
    $this->db = \Config\Database::connect();
    $this->session = session(); // inicializamos la sesión
}

  

    /*===========================================
    variable undercode===========================*/protected function getNavbarData()
{
    $db = $this->db;
    $departamentoId = $this->session->get('departamento_id');
    $userRoleId = $this->session->get('role_id');

    // Contar notificaciones no leídas
    $unreadCount = $db->table('notificaciones')
        ->where('departamento_id', $departamentoId)
        ->where('leido', 0)
        ->countAllResults();

    // Obtener últimas 5 notificaciones
    $notificaciones = $db->table('notificaciones')
        ->where('departamento_id', $departamentoId)
        ->orderBy('id', 'DESC')
        ->limit(5)
        ->get()
        ->getResultArray();

    return [
        'unreadCount'    => $unreadCount,
        'notificaciones' => $notificaciones,
        'userRoleId'     => $userRoleId
    ];
}

  /* =========================================
       📌 1. LISTAR TODAS LAS NOTIFICACIONES
    ========================================= */public function index()
{
    $data = $this->getNavbarData(); // navbar
    $departamentoId = session()->get('departamento_id');

    // Todas las notificaciones del departamento
    $data['notificaciones_completas'] = $this->db->table('notificaciones')
        ->where('departamento_id', $departamentoId)
        ->orderBy('id','DESC')
        ->get()
        ->getResultArray();

    return view('notifications/index', $data);
}
    /* =========================================
       📌 2. ABRIR NOTIFICACIÓN
       marca como leída + redirige al expediente
    ========================================= */

public function open($idNotificacion)
{
    $noti = $this->db->table('notificaciones')
        ->where('id', $idNotificacion)
        ->get()
        ->getRowArray();

    if(!$noti){
        return redirect()->to('/dashboard');
    }

    // Solo jefe
    if(session()->get('role_id') != 2){
        return redirect()->back()->with('error','No tienes permisos para abrir esta notificación');
    }

    // Marcar como leída
    $this->db->table('notificaciones')
        ->where('id', $idNotificacion)
        ->update(['leido' => 1]);

    // Redirigir a la URL de la notificación
    if(!empty($noti['url'])){
        return redirect()->to(site_url($noti['url']));
    } elseif(!empty($noti['expediente_id'])){
        // Si tiene expediente_id, ir al expediente automáticamente
        return redirect()->to(site_url('dossier-edit/'.$noti['expediente_id']));
    }

    // fallback
    return redirect()->to('/dashboard');
}
    /* =========================================
       📌 3. CONTAR NO LEÍDAS (campana navbar)
    ========================================= */
    public function contarNoLeidas()
    {
        $departamentoId = session()->get('departamento_id');

        return $this->db->table('notificaciones')
            ->where('departamento_id', $departamentoId)
            ->where('leido', 0)
            ->countAllResults();
    }

    /* =========================================
       📌 4. OBTENER ÚLTIMAS (dropdown navbar)
    ========================================= */
    public function ultimas($limit = 10)
    {
        $departamentoId = session()->get('departamento_id');

        return $this->db->table('notificaciones')
            ->where('departamento_id', $departamentoId)
            ->orderBy('id','DESC')
            ->limit($limit)
            ->get()
            ->getResultArray();
    }

    /* =========================================
       📌 5. MARCAR TODAS COMO LEÍDAS
    ========================================= */
    public function mark_as_read()
    {
        $departamentoId = session()->get('departamento_id');

        $this->db->table('notificaciones')
            ->where('departamento_id', $departamentoId)
            ->update(['leido' => 1]);

        return redirect()->back()
            ->with('success','Todas las notificaciones marcadas como leídas');
    }
}