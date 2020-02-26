<?php
/**
 * Plugin Name:       Search Dazzler
 * Plugin URI:        
 * Description:       Adds a custom search bar to the site.
 * Version:           1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Hugo Moran
 * Author URI:        
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 *
 * Search Dazzler is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Search Dazzler is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Maite Grid. If not, see https://www.gnu.org/licenses/gpl-2.0.html
 *
 * @package Search Dazzler
 */

// === TODO LIST ===
// - Load search bar JavaScript. [DONE]
// - Load search bar CSS. [DONE]
// - Create shortcode to display search bar on.


/**
 * Enqueues plugin style, calendar JS and its CSS.
 *
 * @return void
 */
function search_dazzler_scripts() {
    wp_enqueue_style( 'search-style',
        plugin_dir_url( __FILE__ )
        . 'assets/css/style.css'
    );

    wp_enqueue_style( 'search-style',
        plugin_dir_url( __FILE__ )
        . 'assets/css/bulma-calendar.min.css'
    );

    wp_enqueue_script( 'search-calendar', plugin_dir_url( __FILE__ )
        . 'assets/js/bulma-calendar.min.js');
}
add_action( 'wp_enqueue_scripts', 'search_dazzler_scripts' );

function search_dazzler_shortcode() {

}
