<?php

/*** Built-in Plugin : Weblinks ***/

// By Allensph 2017-05-12
$theme = wp_get_theme()->get( 'TextDomain' );

// Creates Custom Post Type

function create_post_type_weblinks() {

	global $theme;
	

// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x( 'Weblinks', 'Post Type General Name', $theme ),
		'singular_name'       => _x( 'Weblink', 'Post Type Singular Name', $theme ),
		'menu_name'           => __( 'Weblinks', $theme ),
		'parent_item_colon'   => __( 'Parent Weblink', $theme ),
		'all_items'           => __( 'All Weblinks', $theme ),
		'view_item'           => __( 'View Weblink', $theme ),
		'add_new_item'        => __( 'Add New Weblink', $theme ),
		'add_new'             => __( 'Add New', $theme ),
		'edit_item'           => __( 'Edit Weblink', $theme ),
		'update_item'         => __( 'Update Weblink', $theme ),
		'search_items'        => __( 'Search Weblink', $theme ),
		'not_found'           => __( 'Not Found', $theme ),
		'not_found_in_trash'  => __( 'Not found in Trash', $theme ),
	);
	
// Set other options for Custom Post Type
	
	$args = array(
		'label'               => __( 'Weblinks', $theme ),
		'description'         => __( 'Website link and thumbnail', $theme ),
		'labels'              => $labels,
		'menu_icon'	          => 'dashicons-admin-links',
		'supports'            => array( 'title', /*'editor', 'excerpt', 'author',*/ 'thumbnail', 'revisions', 'custom-fields', 'page-attributes', ),
		'hierarchical'        => true,
		'rewrite'             => array('slug' => 'weblinks'),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 25,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
		
		// This is where we add taxonomies to our CPT
		'taxonomies'          => array( 'weblinkcategory' ),
	);
	
	// Registering your Custom Post Type
	register_post_type( 'weblinks', $args );

}

/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/

add_action( 'init', 'create_post_type_weblinks', 0 );





//hook into the init action and call create_book_taxonomies when it fires

add_action( 'init', 'create_hierarchical_taxonomy_weblinkcategory', 0 );

//create a custom taxonomy name it topics for your posts

function create_hierarchical_taxonomy_weblinkcategory() {

    global $theme;

// Add new taxonomy, make it hierarchical like categories
//first do the translations part for GUI

  $labels = array(
    'name' => _x( 'Link Catagories', 'taxonomy general name', $theme ),
    'singular_name' => _x( 'Link Catagory', 'taxonomy singular name', $theme ),
    'search_items' =>  __( 'Search Link Catagories', $theme ),
    'all_items' => __( 'All Link Catagories', $theme ),
    'parent_item' => __( 'Parent Link Catagory', $theme ),
    'parent_item_colon' => __( 'Parent Link Catagory:', $theme ),
    'edit_item' => __( 'Edit Link Catagory', $theme ), 
    'update_item' => __( 'Update Link Catagory', $theme ),
    'add_new_item' => __( 'Add New Link Catagory', $theme ),
    'new_item_name' => __( 'New Link Catagory Name', $theme ),
    'menu_name' => __( 'Link Catagories', $theme ),
  ); 	

// Now register the taxonomy

  register_taxonomy('weblinkcategory',array('weblinks'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'weblinkcategory' ),
  ));

}

// Add Feature Image to Admin Post list

add_image_size('featured_preview', 96, 60, false);

function get_weblinks_thumbnail($post_ID) {
    $post_thumbnail_id = get_post_thumbnail_id($post_ID);
    if ($post_thumbnail_id) {
        $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id);
        return $post_thumbnail_img[0];
    }
}

function weblinks_columns_head($defaults) {
    global $theme;
    $defaults['featured_image'] = __('Site Preview', $theme );
    return $defaults;
}

function weblinks_columns_content($column_name, $post_ID) {
    if ($column_name == 'featured_image') {
        $post_featured_image = get_weblinks_thumbnail($post_ID);
        if ($post_featured_image) {
		if( function_exists('the_post_thumbnail') )
		echo the_post_thumbnail( 'featured_preview' );
        }
    }
}

add_filter('manage_weblinks_posts_columns', 'weblinks_columns_head');
add_action('manage_weblinks_posts_custom_column', 'weblinks_columns_content', 10, 2);

// Move Feature Image to First Column

function weblinks_reoder_columns_head($defaults) {  

    global $theme;

    $new = array();
    $image = $defaults['featured_image'];			// save the image column
    unset($defaults['featured_image']);				// remove image column from the columns list, will be put it back later
    unset($defaults['author']);						// remove author column from the columns list

    $defaults['title'] = _x('Site Name', 'weblinks', $theme);// rename 'Title' column name

    foreach($defaults as $key=>$value) {
        if($key=='title') {  						// when we find the title column
           $new['featured_image'] = $image;  		// put the tags column before it
        }    
        $new[$key]=$value;
    }  

    return $new;  
} 
add_filter('manage_weblinks_posts_columns', 'weblinks_reoder_columns_head');



// WordPress Core Strings Handler - for Edit Weblink

add_filter( 'gettext', 'weblinks_core_string_handler', 10, 2 );
function weblinks_core_string_handler( $translation, $text ) {

	global $post_type;
	global $theme;
	
	if ( 'weblinks' === $post_type ) {
	switch ( $text ) {
			case 'Enter title here': return __('Enter Site Name here', $theme);
			break;
			case 'Most Used': return __('Most Used Catagories', $theme);
			break;
			//case 'Parent': return __('Most Used Section', $theme);
			//break;
    		}
	}
	return $translation;
}


?>