<?php
// File: app/Helpers/Role_helper.php

if (!function_exists('hasRole')) {
    function hasRole($role)
    {
        // Your logic to check user roles
        $userRole = session()->get('role'); // Example: Assume the user's role is stored in session
        return $userRole === $role; // Check if the user's role matches the specified role
    }
}
