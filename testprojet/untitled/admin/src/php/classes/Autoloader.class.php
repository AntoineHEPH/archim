<?php
class Autoloader {
    public static function register() {
        spl_autoload_register([__CLASS__, 'autoload']);
    }

    public static function autoload($class) {
        $baseDir = __DIR__; // dossier où sont stockées les classes
        $path = $baseDir . '/' . $class . '.class.php';

        if (file_exists($path)) {
            require_once $path;
        } else {
            // DEBUG optionnel
            // echo "Autoload : classe non trouvée -> $path<br>";
        }
    }
}
