<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit614a1537bc2adbdd41e51e7500b7c78a
{
    public static $classMap = array (
        'WePay' => __DIR__ . '/..' . '/wepay/php-sdk/wepay.php',
        'WePayException' => __DIR__ . '/..' . '/wepay/php-sdk/wepay.php',
        'WePayPermissionException' => __DIR__ . '/..' . '/wepay/php-sdk/wepay.php',
        'WePayRequestException' => __DIR__ . '/..' . '/wepay/php-sdk/wepay.php',
        'WePayServerException' => __DIR__ . '/..' . '/wepay/php-sdk/wepay.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit614a1537bc2adbdd41e51e7500b7c78a::$classMap;

        }, null, ClassLoader::class);
    }
}
