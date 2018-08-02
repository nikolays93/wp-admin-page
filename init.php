<?php

/**
 * Plugin Name: Admin menu page
 * Description: Render a custom admin page.
 * Version: 1.0.0
 * Author: NikolayS93
 * Author URI: https://vk.com/nikolays_93
 * Author EMAIL: NikolayS93@ya.ru
 * License: GNU General Public License v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

if ( ! defined( 'ABSPATH' ) )
  exit; // With wordpress only

if( !class_exists('NikolayS93\WPAdminPage\Version') ) {
    include_once __DIR__ . '/src/Version.php';
    // include_once __DIR__ . '/src/Callback.php';
    // include_once __DIR__ . '/src/Notice.php';
    include_once __DIR__ . '/src/Preset.php';
    include_once __DIR__ . '/src/Util.php';
    include_once __DIR__ . '/src/_Notice.php';
    include_once __DIR__ . '/src/Page.php';
    include_once __DIR__ . '/src/Section.php';
    include_once __DIR__ . '/src/Metabox.php';
    include_once __DIR__ . '/src/Screen.php';
}
