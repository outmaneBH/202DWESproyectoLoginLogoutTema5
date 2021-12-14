<?php

/* alamcenamos alugunos vocabularios en arrays para usarlos en cookies */
$cookie = $_COOKIE["IdiomaReg"];
if ($cookie == "en") {
    $aLeng = [1 => 'Hello',
        2 => 'Welcome',
        3 => 'LogOut',
        4 => 'LogIn',
        5 => 'Login',
        6 => 'GoBack'
    ];
} else {
    $aLeng = [1 => 'Hola',
        2 => 'Bienvenido',
        3 => 'Cerrar sesión',
        4 => 'Iniciar sesión',
        5 => 'Entrar',
        6 => 'Volver'
    ];
}
if ($_COOKIE["IdiomaReg"] == "ar") {
    $aLeng = [1 => 'اهلا',
        2 => 'مرحبا',
        3 => 'تسجيل الخروج',
        4 => 'تسجيل الدخول',
        5 => 'أدخل', 6 =>
        'رجوع'
    ];
}

