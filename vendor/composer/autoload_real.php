<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit67d50db94be0bb3c0a58d2dcff973e1e
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit67d50db94be0bb3c0a58d2dcff973e1e', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit67d50db94be0bb3c0a58d2dcff973e1e', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit67d50db94be0bb3c0a58d2dcff973e1e::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
