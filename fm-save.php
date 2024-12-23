<?php 
/**
 * Plugin Name:Fm shortcode 
 * Plugin URI: https://wedevs.academy
 * Description:  how to shortcode requires in  WordPress.
 * Version: 0.1.0
 * Author: Firoz mahmud
 * Author URI: https://firoz.co
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: Shortcode
 */

 if(!defined('ABSPATH')) {
    exit;
 }

 class Wedevs_Fm_Save {
    private static $instance;
    public static function get_instance(){
        if(!self:: $instance){
            self::$instance = new self();

        }
        return self::$instance;
    }

    private function __construct(){
        $this->require_classes();
    }

    public function require_classes(){
        require_once __DIR__ . '/includes/save-data.php';
        new Wedevs_Fm_Save_Post();
    }
 }

 Wedevs_Fm_Save::get_instance();