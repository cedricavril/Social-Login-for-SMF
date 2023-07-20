<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc2f612f3bf7fa27444af02ce84563173
{
    public static $prefixLengthsPsr4 = array (
        'H' => 
        array (
            'Hybridauth\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Hybridauth\\' => 
        array (
            0 => __DIR__ . '/..' . '/hybridauth/hybridauth/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc2f612f3bf7fa27444af02ce84563173::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc2f612f3bf7fa27444af02ce84563173::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc2f612f3bf7fa27444af02ce84563173::$classMap;

        }, null, ClassLoader::class);
    }
}
