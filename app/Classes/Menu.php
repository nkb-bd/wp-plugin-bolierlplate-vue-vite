<?php

namespace LitePluginSkeleton\App\Classes;


class Menu
{
    public $menus;
    
    public $pages = array();
    
    public $subpages = array();
    
    public function __construct()
    {
        $this->menus = new MenuApi();
        
        $this->pages = array(
            array(
                'page_title' => 'Lite Plugin',
                'menu_title' => 'Lite Plugin',
                'capability' => 'manage_options',
                'menu_slug'  => 'lite_plugin',
                'callback'   => array($this, 'callback'),
                'icon_url'   => 'dashicons-store',
                'position'   => 110
            )
        );

//        $this->subpages = array(
//            array(
//                'parent_slug' => 'slug',
//                'page_title'  => 'Title',
//                'menu_title'  => 'title',
//                'capability'  => 'manage_options',
//                'menu_slug'   => 'slug',
//                'callback'    => ''
//            ),
//        );
    }
    
    public function callback()
    {
        echo '<div id="app">Loading </div>';
    }
    
    public function register()
    {
        add_action('admin_enqueue_scripts', function () {
            (new \LitePluginSkeleton\App\Classes\ViteAssetLoader())->init();
        });
        
        $this->menus->addPages($this->pages)->withSubPage('Dashboard')->addSubPages($this->subpages)->register();
    }
}
