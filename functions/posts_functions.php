<?php
function custom_new_taxonomies_for_pages() {
	register_taxonomy_for_object_type( 'post_tag', 'page' );
}

function custom_tag_cat_archives( $wp_query ) {
	$my_taxonomies_array = ['post','page'];
 
 	if ( $wp_query->get( 'tag' ) )
 	$wp_query->set( 'post_type', $my_taxonomies_array );
}