<?php /* Loop Template used for Section Taxonomy (cpt:Staffz) */ ?>
<?php global $titan; ?>
<?php global $theme; ?>
<?php global $section_type; ?>

<article <?php post_class('clearfix staffz-loop-layout1'); ?>>
	<div class="entry-content">
	
	<div class="staffz-thumb">
	<?php if ( has_post_thumbnail() ) { the_post_thumbnail('thumbnail');} ?>
	</div>
	<div class="staffz-content clearfix">
		<header class="staffz-header">
			<h4 class="staffz-title">
			<?php 
			//$section_type  = get_term_meta( $term->term_id, 'section-type', true );
			echo $section_type == 'staffs' ? get_the_title() : '<a href="' . get_the_permalink() . '" rel="bookmark">' . get_the_title() . '</a>';				

				?>
				<small><?php echo $titan->getOption('job_title'); ?></small>
			</h4>	
		</header>

		<div class="staffz-intro">
				<?php if( $titan->getOption('staff_email') ): ?>
					<dl id="staff-mail">
						<dt>
							<a href="mailto:<?php echo $titan->getOption('staff_email'); ?>">
								<i class="fa fa-envelope"></i>
								<?php echo _x('Email', 'staffz', $theme); ?>
							</a>
						</dt>
					<!--<dd>
							<?php echo $titan->getOption('staff_email'); ?><br>
						</dd> -->
					</dl>
				<?php endif; ?>
				
				<?php if( $titan->getOption('staff_phone') ): ?>
					<dl id="staff-phone">
						<dt>
							<i class="fa fa-phone-square"></i>
							<?php echo _x('Phone', 'staffz', $theme); ?>
						</dt>


					<?php if($titan->getOption('staff_phone_direct')): ?>

						<dd><?php echo $titan->getOption('staff_phone'); ?></dd>

					</dl>
					<dl id="staff-ext">	
						<dt>
							<i class="fa fa-phone-square"></i>
							<?php echo _x('Ext Number', 'staffz', $theme); ?>
						</dt>
						<dd>
							<?php echo $titan->getOption('staff_ext'); ?>
						</dd>
					</dl>

					<?php elseif(!$titan->getOption('staff_phone_direct')): ?>

					 	<dd><?php echo $titan->getOption('staff_phone'); ?>
						<small><?php echo _x('Ext', 'staffz', $theme); ?></small> <?php echo $titan->getOption('staff_ext'); ?>
						</dd>

					<?php endif; ?>

					</dl>
				<?php elseif( !$titan->getOption('staff_phone') ): ?>
					<?php if($titan->getOption('staff_ext')): ?>
						<dl id="staff-ext">
							<dt>
								<i class="fa fa-phone-square"></i>
								<?php echo _x('Ext Number', 'staffz', $theme); ?>
							</dt>
							<dd>
								<?php echo $titan->getOption('staff_ext'); ?>
							</dd>
						</dl>
					<?php endif; ?>
				<?php endif; ?>

				<?php if( $titan->getOption('duputy') || $titan->getOption('duputy2') ): ?>
					<dl id="staff-duputy">
						<dt>
							<i class="fa fa-user"></i>
							<?php echo _x('Duputy', 'staffz', $theme); ?>
						</dt>
						<dd>
							<?php  if( $titan->getOption('duputy' )): echo get_the_title($titan->getOption('duputy' )); endif; ?>
							<?php  if( $titan->getOption('duputy2')): echo get_the_title($titan->getOption('duputy2')); endif; ?>
						</dd>
					</dl>
				<?php endif; ?>
		</div>
		<div class="staffz-duty">
				<!--承辦業務-->
					<?php echo get_textarea_with_list( 'ol',$titan->getOption('staff_services')); ?>

			<?php //sticky_tag(); ?>
			<?php //the_excerpt(); ?>
		</div>
	</div>

	</div>
</article>