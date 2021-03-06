<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita7c514a70217424da75034d94c94e51b
{
    public static $prefixLengthsPsr4 = array (
        'l' => 
        array (
            'lisao\\curl\\' => 11,
        ),
        'B' => 
        array (
            'Boat\\Dev\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'lisao\\curl\\' => 
        array (
            0 => __DIR__ . '/..' . '/lisao/curl/src',
        ),
        'Boat\\Dev\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita7c514a70217424da75034d94c94e51b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita7c514a70217424da75034d94c94e51b::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
