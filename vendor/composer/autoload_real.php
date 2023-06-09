<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit8f4b6b2dbe0bef913bbda62a5ba7029a
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

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInit8f4b6b2dbe0bef913bbda62a5ba7029a', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit8f4b6b2dbe0bef913bbda62a5ba7029a', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit8f4b6b2dbe0bef913bbda62a5ba7029a::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
