<?php
declare(strict_types=1);

/**
 * Variables globales y zona horaria.
 */
date_default_timezone_set('America/Lima');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('APP_NAME', 'Casos prácticos de geometría');
define('APP_ANIO', date('Y'));
define('TURNOS_VALIDOS', ['Mañana', 'Tarde', 'Noche']);
