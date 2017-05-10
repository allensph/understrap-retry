<?php
/**
 * Single post partial template.
 *
 * @package understrap-retry
 */

?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php the_title( '<h3 class="entry-title">', '</h3>' ); ?>

		<!-- <div class="entry-meta">

			<?php //understrap_posted_on(); ?>

		</div> -->
		<!-- .entry-meta -->

	</header><!-- .entry-header -->

	<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

	<div class="entry-content">

		<?php understrap_posted_on_altered(); ?>
		<?php //understrap_taxonomy_link(); ?>
		<?php the_content(); ?>

		<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
			'after'  => '</div>',
		) );
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php //understrap_entry_footer_altered(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
