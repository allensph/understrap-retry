<?php

/** Titan Framworks Options **/

if(empty($titan) ) :
$titan = TitanFramework::getInstance( 'understrap-master' ); endif;
$theme = wp_get_theme()->get( 'TextDomain' );
require get_template_directory() . '/weblinks/weblink-post-type.php';

add_action( 'tf_create_options', 'weblinks_options_creating_function' );
function weblinks_options_creating_function() {

	global $titan;
	global $theme;

	$postMetaBox = $titan->createMetaBox( array(
		'name' => _x('Weblink Options', 'weblinks', $theme),
		'post_type' => 'weblinks',
	) );

	$postMetaBox->createOption( array(
		'name' => _x('Site URL', 'weblinks', $theme),
		'id' => 'weblinks_site_url',
		'type' => 'text',
		'placeholder' => _x('Site URL without http or https', 'weblinks', $theme),
		) );
	}

?>