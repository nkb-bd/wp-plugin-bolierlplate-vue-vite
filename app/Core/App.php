<?php

namespace LitePluginSkeleton\App\Core;

use LitePluginSkeleton\App\Classes\Menu;
use LitePluginSkeleton\App\Core\Router\Rest;

final class App
{
    
    /**
     * All registered keys.
     *
     * @var array
     */
    protected static $registry = [];
    
    private static $instance;
    
    public $filePath;
    
    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }
    
    /**
     * Bind a new key/value into the container.
     *
     * @param string $key
     * @param mixed $value
     */
    public static function bind($key, $value)
    {
        static::$registry[$key] = $value;
    }
    
    /**
     * Retrieve a value from the registry.
     *
     * @param string $key
     */
    public static function get($key)
    {
        if (!array_key_exists($key, static::$registry)) {
            throw new Exception("No {$key} is bound in the container.");
        }
        
        return static::$registry[$key];
    }
    
    public function init()
    {
        add_action('rest_api_init', function () {
             (new \LitePluginSkeleton\App\Core\Router\Rest('lite-plugin-skeleton'))->load($this->filePath . 'app/routes.php');
        });
        
        (new \LitePluginSkeleton\App\Classes\Menu())->register();
        
    }
    
    public static function instance()
    {
        return static::$instance;
    }
    
    public function loadFile($path)
    {
        if (!file_exists($this->filePath . $path)) {
            return;
        }
        return require_once $this->filePath . $path;
    }
    
    
    public static function load($filePath)
    {
        if (null !== static::$instance) {
            return false;
        }
        static::$instance = new static($filePath);
        static::$instance->init();
        
        return true;
    }
}
