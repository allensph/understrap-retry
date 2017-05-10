<?php
/**
 * Template Name: Home - Right Sidebar Layout
 *
 * This template can be used to override the default template and sidebar setup
 *
 * @package understrap
 */

get_header();
$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="page-wrapper">

	<div class="<?php echo esc_html( $container ); ?>" id="content">

		<div class="row">

			<div
				class="<?php if ( is_active_sidebar( 'right-sidebar' ) ) : ?>col-md-8<?php else : ?>col-md-12<?php endif; ?> content-area"
				id="primary">

				<main class="site-main" id="main" role="main">

					<header class="entry-header">
						<h2 class="entry-title"><?php single_term_title(); ?></h2>
					</header><!-- .entry-header -->

					<section class="news-section">

					<?php
					$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
					//echo $term->term_id; // will show id
					
					$section_type  = get_term_meta( $term->term_id, 'section-type', true );
					//echo $section_type;

					// The Query
					$paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
					$the_query = new WP_Query( array( 
						'paged' => $paged,
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
					?>

					<?php if ($term->description) : ?>
					<h3 class="section-desc-title"><?php _e('Major Service', 'mh-magazine') ?></h3>
						<!--單位主要業務-->
						<?php //echo get_textarea_with_list('ul', $term->description );
						echo  $term->description; ?>
					<?php endif; ?>
					
					<?php
					// The Loop	
					if ( $the_query->have_posts() ) {
						while ( $the_query->have_posts() ) :
							$the_query->the_post();
							get_template_part('/staffz/content','section-staffs');
						endwhile;
						/* Restore original Post Data */
						wp_reset_postdata();
					} else {
						// no posts found
						echo '<div class="no-article-container"><h3>' . __('No articles found in this site.','mh-magazine') . '</h3></div>';
					}
					?>

					</section>

				</main><!-- #main -->

			</div><!-- #primary -->

			<?php get_sidebar( 'right' ); ?>

		</div><!-- .row -->

	</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>

