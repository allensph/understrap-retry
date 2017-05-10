<?php /* Loop Template used for Single Staff (cpt:Staffz) */ ?>
<?php global $titan; ?>
<?php global $theme; ?>

<article <?php post_class('clearfix staffz single-staff'); ?>>

	<header class="entry-header">
		<h2 class="entry-title">
		<?php echo single_staff_title();?>
		</h2>
	</header>

	<div class="entry-content">
	<div class="staffz-thumb">

		<?php if ( has_post_thumbnail() ) { the_post_thumbnail('medium');} ?>
	</div>

	<div class="staffz-content clearfix">
		<div class="staffz-intro">

			<header class="staffz-header">
				<h2 class="staffz-title">
					<?php  the_title(); ?>
					<small><?php echo $titan->getOption('job_title'); ?></small>
				</h2>	
			</header>		
		<?php

			$this_term_id = array_values( wp_get_post_terms( get_the_ID(), 'section', array('fields' => 'ids') ) )[0];
			$section_type = get_term_meta( $this_term_id, 'section-type', true );

			$basic_default = array(
				0 => 'duputy',
				1 => 'staff_services',
				2 => 'staff_email',
				3 => 'staff_phone',
				4 => 'staff_fax');

			$basic_cols  = $titan->getOption( $section_type . '_basic_order');
			$basic_cols = empty($basic_cols) ? $basic_default : $basic_cols;

			$advance_cols = $titan->getOption( $section_type . '_advance_order');

			// echo "<pre>";
			// print_r($basic_cols);
			// print_r($advance_cols);
			// echo "</pre>";
		?>

		<?php

			$output = '';
			
			if( $titan->getOption('duputy') || $titan->getOption('duputy2') ) {
				$o_duputy  = '<dl class="staff-duputy">';
				$o_duputy .= '<dt><i class="fa fa-user"></i>' . _x('Duputy', 'staffz', $theme).' </dt>';
				$o_duputy .= '<dd>';
				if( $titan->getOption('duputy' )): $o_duputy .= get_the_title($titan->getOption('duputy' )); endif;
				if( $titan->getOption('duputy2')): $o_duputy .= "、" . get_the_title($titan->getOption('duputy2')); endif;
				$o_duputy .= '</dd></dl>';
			}else{
				$o_duputy = '';
			}

			$o_staff_services = $titan->getOption('staff_services') == '' ? '' :
								get_textarea_with_list( 'ol', $titan->getOption('staff_services') );

			$o_staff_email	  = $titan->getOption('staff_email') == '' ? '' :
								  '<dl id="staff-mail"><dt><a href="mailto:'.$titan->getOption('staff_email') .'">'
								. '<i class="fa fa-envelope"></i>' . _x('Email', 'staffz', $theme).'</a></dt></dl>';

			if( $titan->getOption('staff_phone') ) {
				$o_staff_phone  = '<dl id="staff-phone">';
				$o_staff_phone .= '<dt><i class="fa fa-phone-square"></i>' . _x('Phone', 'staffz', $theme) .'</dt>';

				if( $titan->getOption('staff_phone_direct') ) {

					$o_staff_phone .= '<dd>'. $titan->getOption('staff_phone'). '</dd>';
					$o_staff_phone .= '</dl>';

					$o_staff_phone .= '<dl id="staff-ext">';
					$o_staff_phone .= '<dt><i class="fa fa-phone-square"></i>' . _x('Ext Number', 'staffz', $theme). '</dt>';
					$o_staff_phone .= '<dd>' .$titan->getOption('staff_ext'). '</dd>';
					$o_staff_phone .= '</dl>';	

				}else{

					$o_staff_phone .= '<dd>' .$titan->getOption('staff_phone');
					$o_staff_phone .= '<small>' ._x('Ext', 'staffz', $theme). '</small> '. $titan->getOption('staff_ext');
					$o_staff_phone .= '</dd>';	

				}

				$o_staff_phone .= '</dl>';


			}else{

				if($titan->getOption('staff_ext')) {
					$o_staff_phone .= '<dl id="staff-ext">';
					$o_staff_phone .= '<dt><i class="fa fa-phone-square"></i>' . _x('Ext Number', 'staffz', $theme). '</dt>';
					$o_staff_phone .= '<dd>' .$titan->getOption('staff_ext'). '</dd>';
					$o_staff_phone .= '</dl>';	
				}
			}

			$o_staff_fax	  = $titan->getOption('staff_fax') == '' ? '' :
								  '<dl id="staff-fax"><dt><i class="fa fa-fax"></i>' . _x('Fax Number', 'staffz', $theme).'</dt>'
								. '<dd>' . $titan->getOption('staff_fax') . '</dd></dl>';

			foreach( $basic_cols as $col ) {
				$output .= ${ "o_" . $col };
			}
			echo $output;

		?>

		</div>

	</div>

<?php if($section_type == 'faculties'): ?>

	<div class="advance-cols">

		<?php 

		$o_educations = get_textarea_content( 
						_x('Education', 'staffz', $theme),
						$titan->getOption('educations'),
						$titan->getOption( $section_type . '_edu_type')
						);

		$o_experiences= get_textarea_content(
						_x('Experience', 'staffz', $theme),
						$titan->getOption('experiences'),
						$titan->getOption( $section_type . '_exp_type')
						);

		$o_honors	  = get_textarea_content(
						_x('Honor', 'staffz', $theme),
						$titan->getOption('honors'),
						$titan->getOption( $section_type . '_hnr_type')
						);

		$o_teaching   = get_textarea_content( 
						_x('Teaching', 'staffz', $theme),
						$titan->getOption('teaching'),
						$titan->getOption( $section_type . '_tch_type')
						);

		$o_specialty  = get_textarea_content(
						_x('Specialty', 'staffz', $theme),
						$titan->getOption('specialty'),
						$titan->getOption( $section_type . '_spc_type')
						);

		$o_papers	  = get_textarea_content(
						_x('Journal Papers', 'staffz', $theme),
						$titan->getOption('papers'),
						$titan->getOption( $section_type . '_ppr_type')
						);

		$o_projects   = get_textarea_content(
						_x('Research Projects', 'staffz', $theme),
						$titan->getOption('projects'),
						$titan->getOption( $section_type . '_prj_type')
						);

		$output = '';

		if(!empty($advance_cols)):
			foreach( $advance_cols as $col ) {
				$output .= ${ "o_" . $col };
			}
			echo $output;
		endif;

		?>

	</div>	
	
	<?php endif; ?>

	</div>
</article>