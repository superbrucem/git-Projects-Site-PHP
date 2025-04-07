<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7ff2c1af893ea8377fa7aeb1b2a8eda2
{
    public static $files = array (
        '253c157292f75eb38082b5acb06f3f01' => __DIR__ . '/..' . '/nikic/fast-route/src/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPAdvanced\\' => 12,
        ),
        'F' => 
        array (
            'FastRoute\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPAdvanced\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'FastRoute\\' => 
        array (
            0 => __DIR__ . '/..' . '/nikic/fast-route/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7ff2c1af893ea8377fa7aeb1b2a8eda2::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7ff2c1af893ea8377fa7aeb1b2a8eda2::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit7ff2c1af893ea8377fa7aeb1b2a8eda2::$classMap;

        }, null, ClassLoader::class);
    }
}
