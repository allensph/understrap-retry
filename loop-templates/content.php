<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package understrap-retry
 */

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php //the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),'</a></h2>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>

			<div class="entry-meta">
				<?php understrap_posted_on_altered(); ?>
			</div><!-- .entry-meta -->

		<?php endif; ?>

		<?php the_title( sprintf( '<h6 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
		'</a></h6>' ); ?>

		<?php //understrap_edit_post_link(); ?>

	</header><!-- .entry-header -->

	<!-- <footer class="entry-footer"> -->

		<?php //understrap_edit_post_link(); ?>

	<!-- </footer> --><!-- .entry-footer -->

</article><!-- #post-## -->
