<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita5e9e5f56538a24254a01a7343d5b1c7
{
    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'ReallySimpleJWT\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'ReallySimpleJWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/rbdwllr/reallysimplejwt/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita5e9e5f56538a24254a01a7343d5b1c7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita5e9e5f56538a24254a01a7343d5b1c7::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInita5e9e5f56538a24254a01a7343d5b1c7::$classMap;

        }, null, ClassLoader::class);
    }
}
