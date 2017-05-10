<?php
/**
 * Template Name: Catalogue Staffz Layout
 *
 * This template can be used to override the default template and sidebar setup
 *
 * @package understrap
 */

get_header();

$container   = get_theme_mod( 'understrap_container_type' );
$sidebar_pos = get_theme_mod( 'understrap_sidebar_position' );
global $titan;
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

						<?php
						$terms = get_terms( array(
							'taxonomy' => 'section',
							'hide_empty' => false,
							'orderby' => 'none',
							//'order' => 'DESC',
						) );

						$catalogue_default = array(
							0 => 'job_title',
							1 => 'staff_name',
							2 => 'staff_email',
							3 => 'staff_phone',
							4 => 'staff_ext',
							5 => 'staff_fax');

						$catalogue_cols = $titan->getOption( 'catalogue_order' );
						$catalogue_cols = empty($catalogue_cols) ? $catalogue_default : $catalogue_cols;

						//Table Header Columns
						$thead = '<div class="catalogue-row header">';
						foreach ($catalogue_cols as $col) {
							$tag    = ucwords( str_replace('_', ' ', $col) );
							$thead .= '<div  style="display: table-cell">'._x( $tag, 'staffz', $theme ) .'</div>';
						}
						$thead .= '</div>';
						//echo $thead;

						//echo '<pre>';print_r($catalogue_cols);echo '</pre>';

						if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
							//Sections Tags with link
							echo '<ul class="sub-pages section-picker">';

							foreach ( $terms as $term ) {
								echo '<li>';
								echo '<a href="#section-term-'. $term->term_id .'"" data-toggle="term-'. $term->term_id .'">' . 
								$term->name . '</a></a>';
								echo '</li>';
							}
							echo '</ul>';

							echo '<div class="catalogue-sections">';

							//All Staffz loop list
							foreach ( $terms as $term ) {

								$section_type  = get_term_meta( $term->term_id, 'section-type', true );

								echo '<section id="term-'. $term->term_id .'">';
								echo '<h3>'.$term->name.'</h3>';

								$the_query = new WP_Query( array( 
									'post_type' => 'staffz',
									'tax_query' => array(
										array(
										'taxonomy' => 'section',
										'field' => 'slug',
										'terms'    => array( $term->slug ),
										),
									),
									'post_status' => 'publish',
									'orderby' => 'menu_order',
									'order'   => 'ASC',
									'posts_per_page' => -1,
								 ) );

								$section_type = get_term_meta( $term->term_id, 'section-type', true ); 
								// $section_type = 'staffs'



								//The Loop
								if ( $the_query->have_posts() ) {

									echo '<div class="catalogue-table">';
									echo $thead;

									while ( $the_query->have_posts() ) :
										$the_query->the_post();

										get_template_part('/staffz/content','catalogue-staff');
										
									endwhile;

									echo '</div>';

									//Restore original Post Data 
									wp_reset_postdata();
								} else {
									// no posts found
									echo '<p>' . _x('No staff found in this section', 'staffz', 'mh-magazine') . '</p>';
								}

								echo '</section>';

							}

							echo "</div>"; 
						}

						?>
						<?php
						
						// if(is_super_admin()) {
						// 	print "<pre>";
						// 	print_r($terms);
						// 	print "</pre>";
						// }

						?>
					</div>

				<?php endwhile; // end of the loop. ?>



				</div>

			</main><!-- #main -->

			<!-- Do the right sidebar check -->
			<?php if ( 'right' === $sidebar_pos || 'both' === $sidebar_pos ) : ?>

				<?php get_sidebar( 'right' ); ?>

			<?php endif; ?>

		</div><!-- .row -->

</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>

<script>
jQuery(document).ready(function($){
	$('.section-picker li a').on('click', function(e){

		var that = 'section#'+ $(this).attr('data-toggle');
		console.log(that);
		$(that).siblings().addClass('inactive');
		$(that).removeClass('inactive');
		
	});
});
</script>