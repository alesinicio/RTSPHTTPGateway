<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit48dd033c485a11951c5b8b32058b4fab
{
    public static $prefixLengthsPsr4 = array (
        'a' => 
        array (
            'alesinicio\\AsyncExecutor\\' => 25,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'alesinicio\\AsyncExecutor\\' => 
        array (
            0 => __DIR__ . '/..' . '/alesinicio/asyncexecutor/src',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit48dd033c485a11951c5b8b32058b4fab::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit48dd033c485a11951c5b8b32058b4fab::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
