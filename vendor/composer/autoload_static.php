<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc9db19855b817ebee00c465e401d93a8
{
    public static $prefixLengthsPsr4 = array (
        'd' => 
        array (
            'driver\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'driver\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'driver\\control\\action' => __DIR__ . '/../..' . '/src/control/action.php',
        'driver\\helper\\html' => __DIR__ . '/../..' . '/src/helper/html.php',
        'driver\\router\\autenticate' => __DIR__ . '/../..' . '/src/router/autenticate.php',
        'driver\\router\\router' => __DIR__ . '/../..' . '/src/router/router.php',
        'driver\\view\\display' => __DIR__ . '/../..' . '/src/view/display.php',
        'driver\\view\\mimes' => __DIR__ . '/../..' . '/src/view/mimes.php',
        'driver\\view\\view' => __DIR__ . '/../..' . '/src/view/view.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc9db19855b817ebee00c465e401d93a8::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc9db19855b817ebee00c465e401d93a8::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc9db19855b817ebee00c465e401d93a8::$classMap;

        }, null, ClassLoader::class);
    }
}