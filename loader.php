<?php
//namespace LitePluginSkeleton;

use LitePluginSkeleton\App\Core\App;

function litePluginSkeletonLoaderx($class)
{
    $nameSpace = 'LitePluginSkeleton';
    if (0 !== strpos($class, $nameSpace)) {
        return;
    }
    
    $file = str_replace(
        [$nameSpace, '\\', '/App/', '/Includes/'],
        ['', DIRECTORY_SEPARATOR, 'app/', 'includes/'],
        $class
    );
    
    $basePath = plugin_dir_path(__FILE__);
    $file = $basePath . trim($file, '/') . '.php';
    if (file_exists($file)) {
        require_once($file);
    }
}

spl_autoload_register('litePluginSkeletonLoaderx');

App::load(LITE_PLUGIN_PATH);
