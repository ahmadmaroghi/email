<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6763730c416955ed7696f5cada0ca822
{
    public static $files = array (
        'decc78cc4436b1292c6c0d151b19445c' => __DIR__ . '/..' . '/phpseclib/phpseclib/phpseclib/bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        'p' => 
        array (
            'phpseclib\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'phpseclib\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpseclib/phpseclib/phpseclib',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6763730c416955ed7696f5cada0ca822::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6763730c416955ed7696f5cada0ca822::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
