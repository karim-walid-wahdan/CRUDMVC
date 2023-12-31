<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitdbd8acaa375c45afa1787bac0bab9e9c
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitdbd8acaa375c45afa1787bac0bab9e9c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitdbd8acaa375c45afa1787bac0bab9e9c::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitdbd8acaa375c45afa1787bac0bab9e9c::$classMap;

        }, null, ClassLoader::class);
    }
}
