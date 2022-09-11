<?php defined('ABSPATH') or die;

if (! function_exists('ltpDB')) {
    /**
     * @return \WpFluent\QueryBuilder\QueryBuilderHandler
     */
    function ltpDB()
    {
        if(function_exists('wpFluent')) {
            return wpFluent();
        }

        static $wpFluent;

        if (! $wpFluent) {

            require_once(__DIR__.'/autoload.php');

            global $wpdb;

            $connection = new \WpFluent\Connection($wpdb, ['prefix' => $wpdb->prefix]);

            $wpFluent = new \WpFluent\QueryBuilder\QueryBuilderHandler($connection);
        }

        return $wpFluent;
    }
}
