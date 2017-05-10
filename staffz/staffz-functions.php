<?php

/** Textarea / Editor Content Handlers **/

function get_textarea_content($title, $content, $content_type) {
	$type = $content_type > 1 ? 'scalable' : 'fixed';
	$output  = '<h4 class="col-title ' . $type .'">'. $title . '</h4>'; 
	$output .= '<section class="col-section">';
	switch( $content_type ) {
		case 1:	$output .= '<p>'. $content .'</p>';
		break;
		case 2: $output .= get_textarea_with_list( 'ol', $content );
		break;
		case 3: $output .= get_textarea_with_list( 'ul', $content );
		break;
		case 4: $output .= get_textarea_with_table( '|', $content );
		break;
	}
	$output .= '</section>';
	return $output;
}

//transform content to list items
function get_textarea_with_list($order, $content) {
	$content = esc_html( $content );
	$lines = explode("\n", $content );

	if ( !empty($lines) ) {
		if(count($lines) === 1) {
			$output  = '<p class="description-content">';
			$output .= $content;
			$output .= '</p>';
		}else{
			$output = '<'.$order.'>';
			foreach ( $lines as $line ) { $output .= '<li>'. trim( $line ) .'</li>'; }
			$output .= '</'.$order.'>';
		}
		return $output;
	}else{
		return 'There is nothing in textarea.';
	}
}


//transform content to table
function get_textarea_with_table($sperator, $content) {
	$content = esc_html( $content );
	$lines = explode("\n", $content );

	if ( !empty($lines) ) {
		$output = '<div class="rwdct-table">';
		$first = true;
		foreach ( $lines as $line ) {

			$cols = explode($sperator, $line);
			$output .= '<div class="rwdct-row">';
		
			foreach ( $cols as $key=>$value ) {

				if($first) { $thead[$key] = $value; }
				$output .= $first ? '<div class="rwdct-thead">'.$value.'</div>' : '<div class="rwdct-cell">' . '<span class="cell-title">' . $thead[$key] . '</span>' . '<span class="cell-content">' . $value . '</span>' .'</div>';
			}
			$first=false;
			$output .= '</div>';
		}
		$output .= '</div>';
		return $output;
	}
}


/* Get Current Menu item Lable */

function get_menu_label_by_post_id($post_id, $menu) {

    $menu_title = '';
    $nav = wp_get_nav_menu_items($menu);

    foreach ( $nav as $item ) {

        if ( $post_id == $item->object_id ) {
            $menu_title = $item->post_title;
            break;
        }

    }

    return ($menu_title !== '') ? $menu_title : get_the_title($post_id);

}

/* Get the Menu Name of the current page */

function my_get_menu_item_name( $loc ) {
    global $post;
    $locs = get_nav_menu_locations();
    $menu = wp_get_nav_menu_object( $locs[$loc] );
    if($menu) {
        $items = wp_get_nav_menu_items($menu->term_id);
        foreach ($items as $k => $v) {
            // Check if this menu item links to the current page
            if ($items[$k]->object_id == $post->ID) {
                $name = $items[$k]->title;
                break;
            }
        }
    }
    return $name;
}

/* Single Staff Page Title */

function single_staff_title() {

	global $titan;

	if(get_locale() == 'zh_TW') {
		$output = str_ireplace( '國立交通大學', '',  $titan->getOption('dep_title_tw') );
	}else{
		$output = str_ireplace( array('NCTU', 'National Chiao Tung University'), '',  $titan->getOption('dep_title_en') );
	}
	$output .= $titan->getOption('job_title');
	return $output;
}
?>