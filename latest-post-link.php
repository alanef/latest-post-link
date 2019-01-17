<?php

/*
Plugin Name: Latest Post Link
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: Display Latest Post as a link.
Version: 1.0
Author: Alan Fuller
Author URI: https://Ufullworks.net
License: A "Slug" license name e.g. GPL2
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


/**
 * Add a widget to the dashboard.
 *
 * This function is hooked into the 'wp_dashboard_setup' action below.
 */
function lpl_add_dashboard_widgets() {

	wp_add_dashboard_widget(
		'lpl_dashboard_widget',         // Widget slug.
		'Latest Post Link',         // Title.
		'lpl_dashboard_widget_function' // Display function.
	);
}

add_action( 'wp_dashboard_setup', 'lpl_add_dashboard_widgets' );

/**
 * Create the function to output the contents of our Dashboard Widget.
 */
function lpl_dashboard_widget_function() {
	$query = new WP_Query( array(
		'post_type'      => 'post',
		'posts_per_page' => 1,
		'post_status'    => 'publish'
	) );
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			$link = get_permalink();
		}
		wp_reset_postdata();
	} else {
		$link = 'No Posts';
	}
	// Display whatever it is you want to show.
	echo "Latest post URL: " . $link;
	?>
    <p>Courtesy of Fullworks Custom Plugins <a href="https://fullworks.net">https://fullworks.net</a></p>
	<?php
}