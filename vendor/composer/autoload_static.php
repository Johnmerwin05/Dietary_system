<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0b8b998536cabadb05c7bbf842d5ccb5
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Phpml\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Phpml\\' => 
        array (
            0 => __DIR__ . '/..' . '/php-ai/php-ml/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0b8b998536cabadb05c7bbf842d5ccb5::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0b8b998536cabadb05c7bbf842d5ccb5::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit0b8b998536cabadb05c7bbf842d5ccb5::$classMap;

        }, null, ClassLoader::class);
    }
}
