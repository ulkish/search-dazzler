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
// - Create shortcode to display search bar on. [DONE]
// - Fix CSS on search bar.
// - Transform search bar into a form in order to make it usable.


/**
 * Enqueues plugin style, calendar JS and its CSS.
 *
 * @return void
 */
function search_dazzler_scripts() {

    wp_enqueue_style( 'search-calendar-style',
        plugin_dir_url( __FILE__ )
        . 'assets/css/bulma-calendar.min.css'
    );

    wp_enqueue_style( 'search-plugin-style',
        plugin_dir_url( __FILE__ )
        . 'assets/css/style.css'
    );

    wp_enqueue_script( 'search-calendar', plugin_dir_url( __FILE__ )
        . 'assets/js/bulma-calendar.min.js');
}
add_action( 'wp_enqueue_scripts', 'search_dazzler_scripts' );

/**
 * Adds our custom shortcode to output a search bar in the site.
 *
 * @return void
 */
function search_dazzler_shortcode() {

    $static_searchbar = 
'<form action=' . admin_url( "admin-post.php" ) . ' method="POST" class="columns">
    <input type="hidden" name="action" value="search_action_hook">
    <div class="column is-8 is-offset-2">
        <div class="field is-horizontal">
            <div class="field-body">
              <div class="field">
                <input id="checkIn" name="checkIn" type="date">
              </div>
              <div class="field">
                <input id="checkOut" name="checkOut" type="date">
              </div>
              <div class="field">
                <div class="control">
                    <div class="dropdown is-active">
                        <div class="dropdown-trigger">
                          <button class="button" aria-haspopup="true" aria-controls="dropdown-menu">
                            <span>Habitaciones, adultos, niños</span>
                            <span class="icon is-small">
                              <i class="fas fa-angle-down" aria-hidden="true"></i>
                            </span>
                          </button>
                        </div>
                        <div class="dropdown-menu" id="dropdown-menu" role="menu">
                          <div class="dropdown-content">
                            <a href="#" class="dropdown-item">
                              HABITACIONES
                            </a>
                            <hr class="dropdown-divider">
                            <a class="dropdown-item">
                              ADULTOS
                            </a>
                            <hr class="dropdown-divider">
                            <div href="#" class="dropdown-item">
                              NIÑOS
                            </div>
                          </div>
                        </div>
                      </div>
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <div class="select">
                        <select name="select_two">
                          <option>lorem1</option>
                          <option>lorem2</option>
                          <option>lorem3</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="field is-grouped">
                <p class="control">
                  <input type="submit" name="submit" value="Submit!"class="button is-primary">
                </p>
              </div>
            </div>
          </div>
    </div>
</form>' . 

// The JavaScript
"<script>
    var options = {
        type: 'date',
        labelFrom: 'Check-in',
        labelTo: 'Check-out',
        // displayMode: 'inline',
        isRange: 'true',
        closeOnSelect: 'false'
    }

    bulmaCalendar.attach('#checkIn', { labelFrom: 'Check-in' });
    bulmaCalendar.attach('#checkOut', { labelFrom: 'Check-Out' });

    var calendars = bulmaCalendar.attach('[type=" . '"date"'. "]', options);

// Loop on each calendar initialized
for(var i = 0; i < calendars.length; i++) {
	// Add listener to date:selected event
	calendars[i].on('select', date => {
		console.log(date);
	});
}

// To access to bulmaCalendar instance of an element
var element = document.querySelector('#my-element');
if (element) {
	// bulmaCalendar instance is available as element.bulmaCalendar
	element.bulmaCalendar.on('select', function(datepicker) {
		console.log(datepicker.data.value());
	});
}
</script>";

    return $static_searchbar;
}
add_shortcode( 'search_dazzler', 'search_dazzler_shortcode' );
/**
 * Handles URL form submission data to create a link and redirect to it.
 *
 * @return void
 */
function handle_url_data() {

    if (! empty($_POST["checkIn"]) && ! empty($_POST["checkOut"]) && ! empty($_POST["select_two"])) {
        $check_in = $_POST["checkIn"];
        $check_out = $_POST["checkOut"];

        $select_two = $_POST["select_two"];
        wp_redirect( 'https://www.google.com/search?q='
        . $check_in . '+' . $check_out . '+' . $select_two );
    }
}
add_action('admin_post_nopriv_search_action_hook', 'handle_url_data');
add_action('admin_post_search_action_hook', 'handle_url_data');

/**
 * Outputs a list of all the scripts enqueued on the site.
 *
 * @return void
 */
function inspect_scripts() {
    global $wp_scripts;
    echo "<h1>Enqueued JavaScript files:</h1><ul>";

    foreach( $wp_scripts->queue as $handle ) {
        echo "<li>" . $handle . "</li>";
    }

    echo "</ul>";
}
// add_action( 'wp_print_styles', 'inspect_scripts' );

/**
 * Outputs a list of all the styles enqueued on the site.
 *
 * @return void
 */
function inspect_styles() {
    global $wp_styles;
    echo "<h2>Enqueued CSS Stylesheets</h2><ul>";
    foreach( $wp_styles->queue as $handle ) :
        echo "<li>" . $handle . "</li>";
    endforeach;
    echo "</ul>";
}
// add_action( 'wp_print_styles', 'inspect_styles' );
