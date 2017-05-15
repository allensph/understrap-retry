<?php
/**
 * Template Name: Taxonomy Weblinkcategory Layout
 *
 * This template can be used to override the default template and sidebar setup
 *
 * @package understrap
 */

get_header();

$container   = get_theme_mod( 'understrap_container_type' );
$sidebar_pos = get_theme_mod( 'understrap_sidebar_position' );
global $titan;

$terms = get_terms( array(
	'taxonomy' => 'weblinkcategory',
	'hide_empty' => false,
	'orderby' => 'none',
	//'order' => 'DESC',
) );

?>

<div class="wrapper" id="page-wrapper">

	<div class="<?php echo esc_html( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<div class="col-md-4 widget-area" id="left-sidebar" role="complementary">
				<aside id="weblink_category_menu" class="weblink-category">		
				<?php

						echo '<ul class="sub-pages weblink-category-menu">';

						foreach ( $terms as $term ) {
							echo '<li>';
							echo '<a href="/?weblinkcategory='. $term->name .'">' . 
							$term->name . '</a></a>';
							echo '</li>';
						}
						echo '</ul>';
				?>
				</aside>
			</div>	

			<div class="col-md-8 content-area" id="primary">

				<main class="site-main" id="main">
					
						<?php //get_template_part( 'loop-templates/content', 'page' ); ?>
						<header class="entry-header">
							<h2 class="entry-title">
								<?php single_term_title(); ?>
							</h2>
						</header>

						<div class="entry-content clearfix">

							<section class="weblinkcategory-section">

								<?php

									//Query
									$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

									$the_query = new WP_Query( array( 
										'paged' => $paged,
										'post_type' => 'weblinks',
										'tax_query' => array(
											array(
											'taxonomy' => 'weblinkcategory',
											'field' => 'slug',
											'terms'    => array( $term->slug ),
											),
										),
										'post_status' => 'publish',
										'orderby' => 'menu_order',
										'order'   => 'ASC',
										'posts_per_page' => -1,
										 ) );


									//The Loop
									if ( $the_query->have_posts() ) {

										echo '<div class="catalogue-table">';
										//echo $thead;

										while ( $the_query->have_posts() ) :
											$the_query->the_post();
											
											$output  = '<div style="width: 25%; display: inline-block;">';
											$output .= '<a href="'. esc_url($titan->getOption('weblinks_site_url')) .'" target="_blank">';
											$output .= get_the_title();
											$output .= '</a>';
											$output .= '</div>';

											echo $output;
											//get_template_part('/staffz/content','catalogue-staff');
											
										endwhile;

										echo '</div>';

										//Restore original Post Data 
										wp_reset_postdata();
									} else {
										// no posts found
										echo '<p>' . _x('No link found in this category', 'weblinks', 'mh-magazine') . '</p>';
									}
								?>
							</section>
						</div>

							<?php
							
							// if(is_super_admin()) {
							// 	print "<pre>";
							// 	print_r($terms);
							// 	print "</pre>";
							// }

							?>

				</main>
				<!-- #main -->
			</div>

			<!-- Do the right sidebar check -->
			<?php if ( 'right' === $sidebar_pos || 'both' === $sidebar_pos ) : ?>

				<?php get_sidebar( 'right' ); ?>

			<?php endif; ?>

		</div><!-- .row -->

</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>