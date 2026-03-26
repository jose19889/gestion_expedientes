<?php
use App\Models\NotificationModel;

if (!function_exists('getNavbarData')) {
    function getNavbarData()
    {
        $session = session();
        $userId  = $session->get('user_id');

        $notificacionModel = new NotificationModel();

        // Últimas 10 notificaciones
        $notificaciones = $notificacionModel
            ->where('usuario_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->limit(10)
            ->find();

        // Cantidad de notificaciones no leídas
        $unreadCount = $notificacionModel
            ->where('usuario_id', $userId)
            ->where('leido', 0)
            ->countAllResults();

        // Rol del usuario
        $userRoleId = $session->get('role_id');

        return [
            'notificaciones' => $notificaciones,
            'unreadCount'    => $unreadCount,
            'userRoleId'     => $userRoleId
        ];
    }
}