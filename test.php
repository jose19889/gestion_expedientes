<?php
// Contraseña que el usuario va a poner en el login
$pass_input = 'password1'; // cambia por la que intentas usar

// Hash que está guardado en la base de datos
$pass_db = '$2y$10$eR3zH9vK1oRZr2h1d9aTtOeCJwF1kDm0/ZVJzUP7Og3Y3sI0vYy/G'; 
// reemplaza los x por el valor exacto que tienes en la columna password de tu usuario

if (password_verify($pass_input, $pass_db)) {
    echo "¡Contraseña correcta!";
} else {
    echo "Contraseña incorrecta";
}