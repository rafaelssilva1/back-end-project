<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit227b31fbb636e9bde59f0f952d3a2c8b
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit227b31fbb636e9bde59f0f952d3a2c8b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit227b31fbb636e9bde59f0f952d3a2c8b::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit227b31fbb636e9bde59f0f952d3a2c8b::$classMap;

        }, null, ClassLoader::class);
    }
}
