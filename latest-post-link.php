<?php
/*
Plugin Name: Latest Post Link
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: Redirect to l;atest post by adding ?latestpost to url
Version: 2.0
Author: Alan Fuller
Author URI: https://Ufullworks.net
License: A "Slug" license name e.g. GPL2
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

add_action('init', function() {
	if ( isset($_REQUEST['latestpost'])) {

		$query = new WP_Query( array(
			'post_type'      => 'post',
			'posts_per_page' => 1,
			'post_status'    => 'publish'
		) );
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				$link = get_permalink();
				break;
			}
			wp_reset_postdata();
		} else {
			$link = get_home_url();
		}

		wp_redirect( $link, '302' );
		exit;
	}
});
