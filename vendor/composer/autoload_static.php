<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitcdbf7904a0affccbb23691f5d1c4a70a
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\Server\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\Server\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitcdbf7904a0affccbb23691f5d1c4a70a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitcdbf7904a0affccbb23691f5d1c4a70a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitcdbf7904a0affccbb23691f5d1c4a70a::$classMap;

        }, null, ClassLoader::class);
    }
}
