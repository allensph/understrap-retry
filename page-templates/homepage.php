<?php
/**
 * Template Name: Home
 *
 * This template can be used to override the default template and sidebar setup
 *
 * @package understrap
 */

get_header();
$container = get_theme_mod( 'understrap_container_type' );
$sidebar_pos = get_theme_mod( 'understrap_sidebar_position' );
?>


<?php get_template_part( 'global-templates/hero','none' ); ?>


<div class="wrapper" id="page-wrapper">

	<div class="<?php echo esc_html( $container ); ?>" id="content">

		<div class="row">

			<div
				class="<?php if ( is_active_sidebar( 'right-sidebar' ) ) : ?>col-md-8<?php else : ?>col-md-12<?php endif; ?> content-area"
				id="primary">

				<main class="site-main" id="main" role="main">

					<section class="news-section">
					<?php

					$args = array ( 'post_status' => 'publish', 'posts_per_page' => 5, 'cat' => 2 );
					query_posts( $args );

						if ( have_posts() ): while ( have_posts() ) : the_post();
								// Do stuff with the post content.
								get_template_part( 'loop-templates/content', 'home' );
							endwhile;
						else:
							// Insert any content or load a template for no posts found.
						endif;

						wp_reset_query();
					?>
					</section>

					<section class="test-section">
						<?php get_sidebar( 'home-section' ); ?>
					</section>

				</main><!-- #main -->

			</div><!-- #primary -->

			<?php get_sidebar( 'right' ); ?>

		</div><!-- .row -->

	</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>

<div class="component">
  <!-- Start Nav Structure -->
  <div class="cn-wrapper" id="cn-wrapper">
	<?php wp_nav_menu(
		array(
			'theme_location'  => 'circular',
			// 'container_class' => 'collapse navbar-collapse',
			// 'container_id'    => 'navbarNavDropdown',
			// 'menu_class'      => 'navbar-nav',
			'fallback_cb'     => '',
			'menu_id'         => 'circular-menu',
			// 'walker'          => new WP_Bootstrap_Navwalker(),
		)
	); ?>
  </div>
  <!-- End Nav Structure -->
</div>

