<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc402567fbb2a56279a3e559b19e22c5b
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
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc402567fbb2a56279a3e559b19e22c5b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc402567fbb2a56279a3e559b19e22c5b::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}