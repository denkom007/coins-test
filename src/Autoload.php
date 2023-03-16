<?php

namespace src;

class Autoload
{
    /**
     * Автозагрузка классов
     * @return void
     */
    public static function register(): void
    {
        spl_autoload_register(function() {
            $files = [
                __DIR__ . '/KassaInterface.php',
                __DIR__ . '/Kassa.php',
            ];
            
            foreach ($files as $file) {
                $file = str_replace('\\', DIRECTORY_SEPARATOR, $file);
                
                if (file_exists($file)) {
                    require_once $file;
                }
            }
        });
    }
}