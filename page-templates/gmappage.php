<?php
/**
 * Template Name: Google Map Layout
 *
 * This template can be used to override the default template and sidebar setup
 *
 * @package understrap
 */

get_header();

$container   = get_theme_mod( 'understrap_container_type' );
$sidebar_pos = get_theme_mod( 'understrap_sidebar_position' );

?>

<div class="wrapper" id="page-wrapper">

	<div class="<?php echo esc_html( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<!-- Do the left sidebar check -->
			<?php get_template_part( 'global-templates/left-sidebar-check', 'none' ); ?>
			
			<main class="site-main" id="main">
				
				<?php while ( have_posts() ) : the_post(); ?>

					<?php //get_template_part( 'loop-templates/content', 'page' ); ?>
					<header class="entry-header">
						<h2 class="entry-title">
							<?php the_title(); ?>
						</h2>
					</header>

					<div class="entry-content clearfix">

						<?php the_content(); ?>
						
						<style>
						    .google-maps {
						        position: relative;
						        padding-bottom: 75%; // This is the aspect ratio
						        height: 0;
						        overflow: hidden;
						    }
						    .google-maps iframe {
						        position: absolute;
						        top: 0;
						        left: 0;
						        width: 100% !important;
						        //height: 100% !important;
						    }
						</style>
						 
						<?php $map_type = $titan->getOption('loc_map_type'); ?>
						<?php 
						switch( $map_type ) {
							case 1: ?>

						<div class="google-maps">
						<?php
							$gm_addr = $titan->getOption('gmap_address');
							$gm_zoom = $titan->getOption('gmap_zoom');
							$key = 'AIzaSyDwT8iWWyr_FG7AxY7z1hc49t2YfkVaT8Y';
							echo 
							'<iframe width="800" height="600" frameborder="0" style="border:0" 
							src="https://www.google.com/maps/embed/v1/place?key='.$key.'&q=' . $gm_addr . '&zoom='.$gm_zoom.'" 
							allowfullscreen></iframe>';
						?>
						</div>

						<?php break; ?>
						<?php case 2: ?>

						按下左上角圖標展開單位清單。
						<div class="google-maps">
							<?php 
							$mm_id = $titan->getOption('mymap_id');
							$mm_zoom = $titan->getOption('mymap_zoom');
							echo
							'<iframe src="https://www.google.com/maps/d/embed?mid='.$mm_id.'&z='.$mm_zoom.'" width="800" height="600"></iframe>';
							?>
						</div>

						<?php break; ?>
						<?php } ?> 
					
					</div>


				<?php endwhile; // end of the loop. ?>

			</main><!-- #main -->

		</div><!-- #primary -->

		<!-- Do the right sidebar check -->
		<?php if ( 'right' === $sidebar_pos || 'both' === $sidebar_pos ) : ?>

			<?php get_sidebar( 'right' ); ?>

		<?php endif; ?>

	</div><!-- .row -->

</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
