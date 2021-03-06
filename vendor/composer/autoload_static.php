<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8435d72fb732b28ff72ef90347cd4c07
{
    public static $files = array (
        '993876fc8902a18033f085ec6ad50c55' => __DIR__ . '/../..' . '/source/Config.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Source\\' => 7,
        ),
        'L' => 
        array (
            'League\\Plates\\' => 14,
        ),
        'C' => 
        array (
            'CoffeeCode\\Router\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Source\\' => 
        array (
            0 => __DIR__ . '/../..' . '/source',
            1 => __DIR__ . '/../..' . '/source/utils',
        ),
        'League\\Plates\\' => 
        array (
            0 => __DIR__ . '/..' . '/league/plates/src',
        ),
        'CoffeeCode\\Router\\' => 
        array (
            0 => __DIR__ . '/..' . '/coffeecode/router/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8435d72fb732b28ff72ef90347cd4c07::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8435d72fb732b28ff72ef90347cd4c07::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit8435d72fb732b28ff72ef90347cd4c07::$classMap;

        }, null, ClassLoader::class);
    }
}
