<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit491bc16e099d7f0d440639c887dfbb52
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Slim\\PDO\\' => 9,
        ),
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
        'C' => 
        array (
            'CorsSlim\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Slim\\PDO\\' => 
        array (
            0 => __DIR__ . '/..' . '/slim/pdo/src/PDO',
        ),
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
        'CorsSlim\\' => 
        array (
            0 => __DIR__ . '/..' . '/palanik/corsslim',
        ),
    );

    public static $prefixesPsr0 = array (
        'S' => 
        array (
            'Slim' => 
            array (
                0 => __DIR__ . '/..' . '/slim/slim',
            ),
        ),
        'P' => 
        array (
            'Pentagonal\\Phpass' => 
            array (
                0 => __DIR__ . '/..' . '/pentagonal/phpass/src',
            ),
        ),
    );

    public static $classMap = array (
        'JsonApiMiddleware' => __DIR__ . '/..' . '/entomb/slim-json-api/jsonAPI/JsonApiMiddleware.php',
        'JsonApiView' => __DIR__ . '/..' . '/entomb/slim-json-api/jsonAPI/JsonApiView.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit491bc16e099d7f0d440639c887dfbb52::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit491bc16e099d7f0d440639c887dfbb52::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit491bc16e099d7f0d440639c887dfbb52::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit491bc16e099d7f0d440639c887dfbb52::$classMap;

        }, null, ClassLoader::class);
    }
}