<?php

/*** Built-in Plugin : Staffz ***/

// By Allensph 2017-01-17
$theme = wp_get_theme()->get( 'TextDomain' );

// Creates Custom Post Type

function create_post_type_staffz() {

	global $theme;
	

// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x( 'Staffs', 'Post Type General Name', $theme ),
		'singular_name'       => _x( 'Staff', 'Post Type Singular Name', $theme ),
		'menu_name'           => __( 'Staff Files', $theme ),
		'parent_item_colon'   => __( 'Parent Staff', $theme ),
		'all_items'           => __( 'All Staffs', $theme ),
		'view_item'           => __( 'View Staff', $theme ),
		'add_new_item'        => __( 'Add New Staff', $theme ),
		'add_new'             => __( 'Add New', $theme ),
		'edit_item'           => __( 'Edit Staff', $theme ),
		'update_item'         => __( 'Update Staff', $theme ),
		'search_items'        => __( 'Search Staff', $theme ),
		'not_found'           => __( 'Not Found', $theme ),
		'not_found_in_trash'  => __( 'Not found in Trash', $theme ),
	);
	
// Set other options for Custom Post Type
	
	$args = array(
		'label'               => __( 'Staff Files', $theme ),
		'description'         => __( 'Staff files and informations', $theme ),
		'labels'              => $labels,
		'menu_icon'	          => 'dashicons-networking',
		'supports'            => array( 'title', /*'editor', 'excerpt', 'author',*/ 'thumbnail', 'revisions', 'custom-fields', 'page-attributes', ),
		'hierarchical'        => true,
		'rewrite'             => array('slug' => 'staffz'),
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
		'taxonomies'          => array( 'section' ),
	);
	
	// Registering your Custom Post Type
	register_post_type( 'staffz', $args );

}

/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/

add_action( 'init', 'create_post_type_staffz', 0 );





//hook into the init action and call create_book_taxonomies when it fires

add_action( 'init', 'create_hierarchical_taxonomy_staffsection', 0 );

//create a custom taxonomy name it topics for your posts

function create_hierarchical_taxonomy_staffsection() {

    global $theme;

// Add new taxonomy, make it hierarchical like categories
//first do the translations part for GUI

  $labels = array(
    'name' => _x( 'Sections', 'taxonomy general name', $theme ),
    'singular_name' => _x( 'Section', 'taxonomy singular name', $theme ),
    'search_items' =>  __( 'Search Sections', $theme ),
    'all_items' => __( 'All Sections', $theme ),
    'parent_item' => __( 'Parent Section', $theme ),
    'parent_item_colon' => __( 'Parent Section:', $theme ),
    'edit_item' => __( 'Edit Section', $theme ), 
    'update_item' => __( 'Update Section', $theme ),
    'add_new_item' => __( 'Add New Section', $theme ),
    'new_item_name' => __( 'New Section Name', $theme ),
    'menu_name' => __( 'Sections', $theme ),
  ); 	

// Now register the taxonomy

  register_taxonomy('section',array('staffz'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'section' ),
  ));

}

// Add Feature Image to Admin Post list

add_image_size('featured_preview', 60, 60, false);

function get_staffz_photo($post_ID) {
    $post_thumbnail_id = get_post_thumbnail_id($post_ID);
    if ($post_thumbnail_id) {
        $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id);
        return $post_thumbnail_img[0];
    }
}

function staffz_columns_head($defaults) {
    global $theme;
    $defaults['featured_image'] = __('Staff Photo', $theme );
    return $defaults;
}

function staffz_columns_content($column_name, $post_ID) {
    if ($column_name == 'featured_image') {
        $post_featured_image = get_staffz_photo($post_ID);
        if ($post_featured_image) {
		if( function_exists('the_post_thumbnail') )
		echo the_post_thumbnail( 'featured_preview' );
        }
    }
}

add_filter('manage_staffz_posts_columns', 'staffz_columns_head');
add_action('manage_staffz_posts_custom_column', 'staffz_columns_content', 10, 2);

// Move Feature Image to First Column

function staffz_reoder_columns_head($defaults) {  

    global $theme;

    $new = array();
    $image = $defaults['featured_image'];			// save the image column
    unset($defaults['featured_image']);				// remove image column from the columns list, will be put it back later
    unset($defaults['author']);						// remove author column from the columns list

    $defaults['title'] = _x('Staff Name', 'staffz', $theme);// rename 'Title' column name

    foreach($defaults as $key=>$value) {
        if($key=='title') {  						// when we find the title column
           $new['featured_image'] = $image;  		// put the tags column before it
        }    
        $new[$key]=$value;
    }  

    return $new;  
} 
add_filter('manage_staffz_posts_columns', 'staffz_reoder_columns_head');



// WodPress Core Strings Handler - for Edit Staffz

add_filter( 'gettext', 'staffz_core_string_handler', 10, 2 );
function staffz_core_string_handler( $translation, $text ) {

	global $post_type;
	global $theme;
	
	if ( 'staffz' === $post_type ) {
	switch ( $text ) {
			case 'Enter title here': return __('Enter Staff Name here', $theme);
			break;
			case 'Most Used': return __('Most Used Section', $theme);
			break;
			//case 'Parent': return __('Most Used Section', $theme);
			//break;
    		}
	}
	return $translation;
}





//Create meta field in Taxonomy Page

$section_types = array(
    'staffs'      => _x('Staff Term', 'staffz', $theme),
    'faculties'   => _x('Faculty Term', 'staffz', $theme),
);

add_action( 'section_add_form_fields', 'add_feature_group_field', 10, 2 );
function add_feature_group_field($taxonomy) {
	global $theme;
    global $section_types;
?>	<div class="form-field term-group">
        <label for="section-type"><?php echo _x('Section Type', 'staffz', $theme); ?></label>
        <select class="postform" id="section-type" name="section-type">
            <option value="-1"><?php echo _x('Untype','staffz', $theme); ?></option><?php foreach ($section_types as $_group_key => $_group) : ?>
                <option value="<?php echo $_group_key; ?>" class=""><?php echo _x( $_group, 'staffz', $theme ); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-field term-section-url-wrap">
        <label for="section-url"><?php _e('Section Url', $theme); ?></label>
		<input type="text" name="section-url" id="section-url" value="">
		<p class="description"><?php _e( 'Enter a value for this field', $theme ); ?></p>
    </div>
    <div class="form-field term-section-phone-wrap">
        <label for="section-phone"><?php _e('Section Phone Number', $theme); ?></label>
        <input type="text" name="section-phone" id="section-phone" value="">
        <p class="description"><?php _e( 'Enter a value for this field', $theme ); ?></p>
    </div>
    <div class="form-field term-section-addr-wrap">
        <label for="section-addr"><?php _e('Section Address', $theme); ?></label>
        <input type="text" name="section-addr" id="section-addr" value="">
        <p class="description"><?php _e( 'Enter a value for this field', $theme ); ?></p>
    </div><?php
}

//Save meta field during Add New Custom Term, in Taxonomy Page
add_action( 'created_section', 'save_feature_meta', 10, 2 );
function save_feature_meta( $term_id, $tt_id ){
    if( isset( $_POST['section-type'] ) && '' !== $_POST['section-type'] ){
        $type = sanitize_title( $_POST['section-type'] );
        add_term_meta( $term_id, 'section-type', $type, true );
    }  
    if( isset( $_POST['section-url'] ) && '' !== $_POST['section-url'] ){
        //$url = sanitize_title( $_POST['section-url'] );
        $url = esc_url( $_POST['section-url'] );
        add_term_meta( $term_id, 'section-url', $url, true );
    }
    if( isset( $_POST['section-addr'] ) && '' !== $_POST['section-addr'] ){
        $addr = sanitize_title( $_POST['section-addr'] );
        add_term_meta( $term_id, 'section-addr', $addr, true );
    }    
    if( isset( $_POST['section-phone'] ) && '' !== $_POST['section-phone'] ){
        $phone = sanitize_title( $_POST['section-phone'] );
        add_term_meta( $term_id, 'section-phone', $phone, true );
    }
}

//Create meta field / Check existing Value in Editing Term Page 
add_action( 'section_edit_form_fields', 'edit_feature_group_field', 10, 2 );
function edit_feature_group_field( $term, $taxonomy ){
    
    global $theme;
    global $section_types;

    // get current group
    $section_type  = get_term_meta( $term->term_id, 'section-type', true );
    $section_url   = get_term_meta( $term->term_id, 'section-url', true );
    $section_phone = get_term_meta( $term->term_id, 'section-phone', true );
    $section_addr  = get_term_meta( $term->term_id, 'section-addr', true );
                
    ?><tr class="form-field term-section-type-wrap">
        <th scope="row"><label for="section-type"><?php echo _x('Section Type', 'staffz', $theme); ?></label></th>
		 <td><select class="postform" id="section-type" name="section-type">
            <option value="-1"><?php echo _x('Untype','staffz', $theme); ?></option>
	            <?php foreach( $section_types as $_group_key => $_group ) : ?>
	                <option value="<?php echo $_group_key; ?>" <?php selected( $section_type, $_group_key ); ?>>
	                <?php echo _x( $_group, 'staffz', $theme ); ?></option>
	            <?php endforeach; ?>
        	</select>
        </td>
    </tr>
    <tr class="form-field term-section-url-wrap">
        <th scope="row"><label for="section-url"><?php _e('Section Url', $theme); ?></label></th>
        <td>
			<!--<input type="text" name="section-url" id="section-url" value="<?php echo esc_attr(  $section_url ) ? esc_attr(  $section_url ) : ''; ?>">-->
			<input type="text" name="section-url" id="section-url" value="<?php echo esc_url(  $section_url ) ? esc_url(  $section_url ) : ''; ?>">
			<p class="description"><?php _e( 'Enter a value for this field', $theme ); ?></p>        
        </td>
    </tr>
    <tr class="form-field term-section-phone-wrap">
        <th scope="row"><label for="section-phone"><?php _e('Section Phone Number', $theme); ?></label></th>
        <td>
            <input type="text" name="section-phone" id="section-phone" value="<?php echo esc_attr(  $section_phone ) ? esc_attr(  $section_phone ) : ''; ?>">
            <p class="description"><?php _e( 'Enter a value for this field', $theme ); ?></p>        
        </td>
    </tr>    
    <tr class="form-field term-section-addr-wrap">
        <th scope="row"><label for="section-addr"><?php _e('Section Address', $theme); ?></label></th>
        <td>
            <input type="text" name="section-addr" id="section-addr" value="<?php echo esc_attr(  $section_addr ) ? esc_attr(  $section_addr ) : ''; ?>">
            <p class="description"><?php _e( 'Enter a value for this field', $theme ); ?></p>        
        </td>
    </tr>    


<?php
}

//Save meta field in Editing Term Page
add_action( 'edited_section', 'update_feature_meta', 10, 2 );
function update_feature_meta( $term_id, $tt_id ){

    if( isset( $_POST['section-type'] ) && '' !== $_POST['section-type'] ){
        $section_type = sanitize_title( $_POST['section-type'] );
        update_term_meta( $term_id, 'section-type', $section_type );
    }
    if( isset( $_POST['section-url'] ) && '' !== $_POST['section-url'] ){
        $section_url = esc_url( $_POST['section-url'] );
        update_term_meta( $term_id, 'section-url', $section_url );
    }
    if( isset( $_POST['section-addr'] ) && '' !== $_POST['section-addr'] ){
        $section_addr = esc_attr( $_POST['section-addr'] );
        update_term_meta( $term_id, 'section-addr', $section_addr );
    }     
    if( isset( $_POST['section-phone'] ) && '' !== $_POST['section-phone'] ){
    	$section_phone = esc_attr( $_POST['section-phone'] );
        update_term_meta( $term_id, 'section-phone', $section_phone );
    }    
}

//Create Table header in Taxonomy Page
add_filter('manage_edit-section_columns', 'add_feature_group_column' );
function add_feature_group_column( $columns ){
	global $theme;
	unset($columns['description']); // Remoove Term Description Column in Table
    unset($columns['slug']); // Remoove Term Slug Column in Table
    $columns['section-url'] = __( 'Section Url', $theme );
    $columns['section-phone'] = __( 'Section Phone Number', $theme );
    $columns['section-addr'] = __( 'Section Address', $theme );
    return $columns;
}


//Bind meta field value to Columns
add_filter('manage_section_custom_column', 'add_feature_group_column_content', 10, 3 );
function add_feature_group_column_content( $content, $column_name, $term_id ){

	$term_id = absint( $term_id );
    if( $column_name == 'section-url' ){

		$section_url = get_term_meta( $term_id, 'section-url', true );
		if( !empty( $section_url ) ){
		    $content .= str_replace( parse_url( $section_url, PHP_URL_SCHEME ) . '://', '', $section_url );
		}
		return $content;

    } elseif( $column_name == 'section-phone' ) {

        $section_phone = get_term_meta( $term_id, 'section-phone', true );
        if( !empty( $section_phone ) ){
            $content .= esc_attr( $section_phone );
        }   
        return $content;

    } elseif( $column_name == 'section-addr' ) {

		$section_addr = get_term_meta( $term_id, 'section-addr', true );
		if( !empty( $section_addr ) ){
			$content .= esc_attr( $section_addr );
		}   
		return $content;

    }else {
    	return $content;
    }

}

// Update CSS  / JS within in Admin
function staffz_admin_style() {
  wp_enqueue_style('admin-styles', get_template_directory_uri().'/staffz-admin.css');
  wp_enqueue_script('admin-script', get_template_directory_uri().'/staffz-admin.js');
}
add_action('admin_enqueue_scripts', 'staffz_admin_style');

?>