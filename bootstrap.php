<?php

/**
 * Plugin Name: AAM Enhanced Access Policy
 * Description: Enhance Advanced Access Manager access policy with useful collection of callbacks
 * Version: 0.0.1
 * Author: Vasyl Martyniuk <vasyl@vasyltech.com>
 * Author URI: https://vasyltech.com
 *
 * -------
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of AAM Protected Media Files source package.
 **/

namespace AAM\AddOn\EnhancedAccessPolicy;

/**
 * Main add-on's bootstrap class
 *
 * @package AAM\AddOn\EnhancedAccessPolicy
 * @author Vasyl Martyniuk <vasyl@vasyltech.com>
 * @version 0.0.1
 */
class Bootstrap
{

    /**
     * Auto-loader for the collection of callbacks
     *
     * @param string $class_name
     *
     * @return void
     *
     * @access public
     * @version 0.0.1
     */
    public static function autoload($class_name)
    {
        if (strpos($class_name, __NAMESPACE__) === 0) {
            $filename  = __DIR__ . '/callback/';
            $filename .= str_replace(
                array(__NAMESPACE__ . '\\', '\\'), array('', '/'), $class_name
            ) . '.php';
        }

        if (!empty($filename) && file_exists($filename)) {
            require($filename);
        }
    }

    /**
     * Activation hook
     *
     * @return void
     *
     * @access public
     * @version 0.0.1
     */
    public static function activate()
    {
        global $wp_version;

        if (version_compare(PHP_VERSION, '5.6.40') === -1) {
            exit(__('PHP 5.6.40 or higher is required.'));
        } elseif (version_compare($wp_version, '4.7.0') === -1) {
            exit(__('WP 4.7.0 or higher is required.'));
        } elseif (!defined('AAM_VERSION') || (version_compare(AAM_VERSION, '6.0.4') === -1)) {
            exit(__('Free Advanced Access Manager plugin 6.0.4 or higher is required.'));
        }
    }

}

if (defined('ABSPATH')) {
    // Register autoloader
    spl_autoload_register(__NAMESPACE__ . '\Bootstrap::autoload');

    // Activation hooks
    register_activation_hook(__FILE__, __NAMESPACE__ . '\Bootstrap::activate');
}