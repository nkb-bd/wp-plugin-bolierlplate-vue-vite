<?php

namespace LitePluginSkeleton\App\Classes;


/*
 * VITE & Tailwind JIT development
 * Inspired by https://github.com/andrefelipe/vite-php-setup
 *
 */

define('VITE_HOST', 'http://localhost:5133');

class ViteAssetLoader
{
    
    public static function base_path()
    {
        return LITE_PLUGIN_URL . "public/dist/";
    }
    
    public static function init($script = 'main.js')
    {
        self::cssTag($script);
        self::jsTag($script);
    }
    
    public static function jsTag($entry)
    {
        $url = self::isDev($entry) ? 'http://localhost:5133/' . $entry : self::assetUrl($entry);
        
        if (!$url) {
            return '';
        }
        
        wp_register_script("module/lite-plugin-main-js", $url, false, true);
        wp_enqueue_script("module/lite-plugin-main-js");
        
        add_filter('script_loader_tag', function ($tag, $handle, $src) {
            if ($handle === 'module/lite-plugin-main-js') {
                $tag = '<script type="module" id="module/lite-plugin-main-js" src="' . esc_url($src) . '"></script>';
            }
            return $tag;
        }, 10, 3);
    }
    
    
    private static function cssTag($entry)
    {
        // not needed on dev, it's inject by Vite
        if (self::isDev($entry)) {
            return '';
        }
        $tags = '';
        foreach (self::cssUrls($entry) as $url) {
            wp_register_style("lite-plugin/$entry", $url);
            wp_enqueue_style("lite-plugin/$entry", $url);
        }
        return $tags;
    }
    
    
    // Helpers to locate files
    
    private static function getManifest()
    {
        $content = file_get_contents(LITE_PLUGIN_PATH . 'public/dist/manifest.json');
        return json_decode($content, true);
    }
    
    private static function assetUrl(string $entry)
    {
        $manifest = self::getManifest();
        return isset($manifest[$entry]) ? self::base_path() . $manifest[$entry]['file'] : self::base_path() . $entry;
    }
    
    private static function getPublicURLBase($entry)
    {
        return self::isDev($entry) ? '/public/dist/' : self::base_path();
    }
    
    private static function importsUrls($entry)
    {
        $urls = [];
        $manifest = self::getManifest();
        
        if (!empty($manifest[$entry]['imports'])) {
            foreach ($manifest[$entry]['imports'] as $imports) {
                $urls[] = self::getPublicURLBase($entry) . $manifest[$imports]['file'];
            }
        }
        return $urls;
    }
    
    private static function cssUrls(string $entry)
    {
        $urls = [];
        $manifest = self::getManifest();
        
        if (!empty($manifest[$entry]['css'])) {
            foreach ($manifest[$entry]['css'] as $file) {
                $urls[] = self::getPublicURLBase($entry) . $file;
            }
        }
        return $urls;
    }
    
    public static function isDev(string $entry)
    {
        // This method is very useful for the local server
        // if we try to access it, and by any means, didn't started Vite yet
        // it will fallback to load the production files from manifest
        
        static $exists = null;
        if ($exists !== null) {
            return $exists;
        }
        $handle = curl_init(VITE_HOST . '/' . $entry);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_NOBODY, true);
        
        curl_exec($handle);
        $error = curl_errno($handle);
        curl_close($handle);
        
        return $exists = !$error;
    }
}
