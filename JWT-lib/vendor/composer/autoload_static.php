<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5bcf046678631f46e0060a77d351b4bb
{
    public static $files = array (
        'fa3df3013f51e030ec6f48c5e17462d5' => __DIR__ . '/..' . '/lindelius/php-jwt/src/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'Lindelius\\JWT\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Lindelius\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/lindelius/php-jwt/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5bcf046678631f46e0060a77d351b4bb::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5bcf046678631f46e0060a77d351b4bb::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
