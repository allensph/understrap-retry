<?php

/** Titan Framworks Options **/

$titan = TitanFramework::getInstance( 'understrap-master' );
$theme = wp_get_theme()->get( 'TextDomain' );
require get_template_directory() . '/staffz/staffz-post-type.php';
require get_template_directory() . '/staffz/staffz-functions.php';

add_action( 'tf_create_options', 'admin_options_creating_function' );
function admin_options_creating_function() {

	global $titan;
	global $theme;
	
	///// Create Admin Panel

	$basicPanel = $titan->createAdminPanel( array(
	'name' => _x('Basic Information', 'staffz', $theme),
	'position' => '25',
	) );

	$office_tab = $basicPanel->createTab( array(
	'name' => _x('Department Profile', 'staffz', $theme),
	) );
	
	//單位中文名稱
	$office_tab->createOption( array(
		'name' => _x('Office Name', 'staffz', $theme),
		'id' => 'dep_title_tw',
		'type' => 'text',
		'default' => '國立交通大學',
		//'livepreview' => '$(".dep-title-tw").html(value)'
	) );
	
	//單位英文名稱
	$office_tab->createOption( array(
		'name' => _x('Office Name in English', 'staffz', $theme),
		'id' => 'dep_title_en',
		'type' => 'text',
		'default' => 'NCTU',
		//'livepreview' => '$(".dep-title-en").html(value)'
	) );

	//聯絡電話
	$office_tab->createOption( array(
		'name' => _x('Phone Number', 'staffz', $theme),
		'id' => 'dep_phone',
		'type' => 'text',
		'default' => '03-5712121',
		//'livepreview' => '$(".dep-phone").html(value)'
	) );
	
	//分機
	$office_tab->createOption( array(
		'name' => _x('Phone Extension', 'staffz', $theme),
		'id' => 'dep_ext',
		'type' => 'text',
		'default' => '',
		//'livepreview' => '$(".dep-phone").html(value)'
	) );
	
	//傳真號碼
	$office_tab->createOption( array(
		'name' => _x('Fax Number', 'staffz', $theme),
		'id' => 'dep_fax',
		'type' => 'text',
		'default' => '03-5712121',
		//'livepreview' => '$(".dep-fax").html(value)'
	) );
	
	//單位地址
	$office_tab->createOption( array(
		'name' => _x('Address', 'staffz', $theme),
		'id' => 'dep_address',
		'type' => 'text',
		'default' => '（館舍、樓層及辦公室等）',
		//'livepreview' => '$(".dep-address").html(value)'
	) );
	
	//電子郵件
	$office_tab->createOption( array(
		'name' => _x('Email', 'staffz', $theme),
		'id' => 'dep_email',
		'type' => 'text',
		'default' => 'yourid@nctu.edu.tw',
		//'livepreview' => '$(".dep-email").html(value)'
	) );

	$office_tab->createOption( array(
	'type' => 'save',
	'save' => __('Save Changes', $theme),
	'reset' => __('Reset to Defaults', $theme),
	) );

/*---------------------------------------------------*/

	$section_tab = $basicPanel->createTab( array(
	'name' => _x('Section Profile', 'staffz', $theme),
	) );

	$section_tab->createOption( array(
		'name' => _x('Enable Section Title Block', 'staffz', $theme),
		'id' => 'sec_title_block',
		'type' => 'enable',
		'enabled' => __('Enable', $theme),
		'disabled' => __('Disable', $theme),		
		'default' => false,
	) );

	//部門中文名稱
	$sec_title = get_bloginfo('name');
	$section_tab->createOption( array(
		'name' => _x('Section Name', 'staffz', $theme),
		'id' => 'sec_title',
		'type' => 'text',
		'default' => $sec_title,
	) );

	//聯絡電話
	$section_tab->createOption( array(
		'name' => _x('Phone Number', 'staffz', $theme),
		'id' => 'sec_phone',
		'type' => 'text',
		'default' => '03-5712121',
	) );

	//傳真號碼
	$section_tab->createOption( array(
		'name' => _x('Fax Number', 'staffz', $theme),
		'id' => 'sec_fax',
		'type' => 'text',
		'default' => '03-5712121',
	) );

	$section_tab->createOption( array(
		'name' => _x('Page link', 'staffz', $theme),
		'id' => 'sec_title_page1',
		'type' => 'select-pages',
		'default' => '0',
	) );

	$section_tab->createOption( array(
		'name' => _x('Page link', 'staffz', $theme),
		'id' => 'sec_title_page2',
		'type' => 'select-pages',
		'default' => '0',
	) );

	$section_tab->createOption( array(
		'type' => 'save',
		'save' => __('Save Changes', $theme),
		'reset' => __('Reset to Defaults', $theme),
	) );

/*---------------------------------------------------*/

	$geo_tab = $basicPanel->createTab( array(
	'name' => _x('GEO information', 'staffz', $theme),
	) );

	//Google 地圖 地點
	$geo_tab->createOption( array(
		'name' => _x('Location Map Type', 'staffz', $theme),
		'id' => 'loc_map_type',
		'type' => 'select',
		'options' => array(
			'1' => _x('Google Map', 'staffz', $theme),
			'2' => _x('Google My Map', 'staffz', $theme),
			//'3' => 'My Custom Map', 'staffz', $theme),
			'4' => _x('Disable Map', 'staffz', $theme),
		),
		'default' => '1',
	) );

	//Google 地圖 地點
	$geo_tab->createOption( array(
		'name' => _x('Google Map Place', 'staffz', $theme),
		'id' => 'gmap_address',
		'type' => 'text',
		'default' => '交通大學圖書館',
	) );
	//Google 地圖 縮放倍率
	$geo_tab->createOption( array(
	'name' => _x('Google Map Zoom', 'staffz', $theme),
	'id' => 'gmap_zoom',
	'type' => 'number',
	'default' => '18',
	'min' => '12',
	'max' => '21',
	) );
	//Google 我的地圖 ID
	$geo_tab->createOption( array(
		'name' => _x('Google MyMap ID', 'staffz', $theme),
		'id' => 'mymap_id',
		'type' => 'text',
		'default' => '1OUBhwHGDJ1K54dHg8HEqCd8N4xo',
		'livepreview' => '$(".second.tf-iframe>iframe").attr("src", value);',
	) );
	//Google 我的地圖 縮放倍率
	$geo_tab->createOption( array(
	'name' => _x('Google MyMap Zoom', 'staffz', $theme),
	'id' => 'mymap_zoom',
	'type' => 'number',
	'default' => '18',
	'min' => '12',
	'max' => '21',
	) );
/*
	$mid = $titan->getOption('mymap_id');
	$geo_tab->createOption( array(
		'name' => __('Google My Map Preview', $theme),
		'type' => 'iframe',
		'url' => 'https://www.google.com/maps/d/embed?mid='.$mid.'&z=18',
		'height' => '600',
	) );*/

	$geo_tab->createOption( array(
	'type' => 'save',
	'save' => __('Save Changes', $theme),
	'reset' => __('Reset to Defaults', $theme),
	) );




	$adminPanel = $titan->createAdminPanel( array(
	'name' => _x('Options', 'staffz post type', $theme),
	'parent' => 'edit.php?post_type=staffz',

	) );
	
	$tab01 =  $adminPanel->createTab( array(
	'name' => _x('Multi Sections List', 'staffz', $theme), //多分類清單
	) );
/*
	$tab01->createOption( array(
		'type' => 'select',
		'id' => 'sections_loop_layout',
		'name' => '樣式',
		'options' => array(
			'' => '--choose--',
			'layout1' => 'layout 1',
			'layout2' => 'layout 2',
			'layout3' => 'layout 3',	
		),
		'default' => 'layout1',
	) );
*/
	$tab01->createOption( array(
		'type'	=> 'enable',
		'id'	=> 'section_title_link',
		'name'	=> '組織名稱連結',
		'enabled' => __('Enable', $theme),
		'disabled' => __('Disable', $theme),
		'default' => 'true',
	) );
/*
	$tab01->createOption( array(
		'type'	=> 'enable',
		'id'	=> 'section_image',
		'name'	=> '啟用組織圖示',
		'enabled'=> '顯示',
		'disabled'=> '隱藏',
		'default' => false,
	) );
*/
	$tab01->createOption( array(
		'type'	=> 'enable',
		'id'	=> 'section_extlink',
		'name'	=> '外部連結',
		'enabled' => __('Enable', $theme),
		'disabled' => __('Disable', $theme),
		'default' => true,
	) );

	$tab01->createOption( array(
		'type'	=> 'text',
		'id'	=> 'section_extlink_text',
		'name'	=> '外部連結文字',
	) );

	$tab01->createOption( array(
		'type'	=> 'enable',
		'id'	=> 'section_addr',
		'name'	=> '位置',
		'enabled' => __('Enable', $theme),
		'disabled' => __('Disable', $theme),
		'default' => true,
	) );

	$tab01->createOption( array(
		'type'	=> 'enable',
		'id'	=> 'section_phone',
		'name'	=> '電話',
		'enabled' => __('Enable', $theme),
		'disabled' => __('Disable', $theme),
		'default' => true,
	) );

	$tab01->createOption( array(
	'type' => 'save',
	'save' => __('Save Changes', $theme),
	'reset' => __('Reset to Defaults', $theme),
	) );

/*--------------------------------------------------------*/

	//Leadings

	$leadings_Tab = $adminPanel->createTab( array(
	'name' => _x('Leadings', 'staffz tab', $theme),
	) );

	// Create options in My General Tab

	$leadings_Tab->createOption( array(
	'name' => _x('Columns Order', 'staffz', $theme),
	'type' => 'heading',
	) );

	$leadings_Tab->createOption( array(
		'name'    => _x('Basic Columns Order', 'staffz', $theme),
		'id'      => 'leadings_basic_order',
		'type'    => 'sortable',
		'desc'    => 'This is our option',
		'options' => array(
		//'job_title'		=> _x('Job Title', 'staffz', $theme),	//職稱
		'duputy'		=> _x('Duputy', 'staffz', $theme),			//代理人
		'staff_services'=> _x('Services', 'staffz', $theme),		//主辦業務
		'staff_email'	=> _x('Email', 'staffz', $theme),			//Email
		'staff_phone'	=> _x('Phone Number', 'staffz', $theme),	//電話
		//'staff_ext'		=> _x('Ext', 'staffz', $theme),			//分機
		'staff_fax'		=> _x('Fax Number', 'staffz', $theme),		//傳真		
		),
	) );

	$leadings_Tab->createOption( array(
		'name'    => _x('Advance Columns Order', 'staffz', $theme),
		'id'      => 'leadings_advance_order',
		'type'    => 'sortable',
		'desc'    => 'This is our option',
		'options' => array(
		'educations'	=> _x('Education', 'staffz', $theme),			//學歷
		'experiences'	=> _x('Experience', 'staffz', $theme),			//經歷
		'honors'		=> _x('Honor', 'staffz', $theme),				//榮譽
		'teaching'		=> _x('Teaching', 'staffz', $theme),			//授課領域
		'specialty'		=> _x('Specialty', 'staffz', $theme),			//研究專長
		'papers'		=> _x('Journal Papers', 'staffz', $theme),		//期刊論文
		'projects'		=> _x('Research Projects', 'staffz', $theme),	//研究計畫
		),
	) );

	$leadings_Tab->createOption( array(
	'name' => _x('Columns Content Type', 'staffz', $theme),
	'type' => 'heading',
	) );

	$leadings_Tab->createOption( array(
		'name'		=> _x('Educations Content Type', 'staffz', $theme),
		'type'		=> 'select',
		'id'		=> 'leadings_edu_type',
		'options'	=> array(
			'1' => _x('Text Paragraph', 'staffz', $theme),
			'2' => _x('Ordered List', 'staffz', $theme),
			'3' => _x('Unordered List', 'staffz', $theme),
			'4' => _x('Table', 'staffz', $theme),
		),
		'default'	=> '3',
	) );

	$leadings_Tab->createOption( array(
		'name'		=> _x('Experiences Content Type', 'staffz', $theme),
		'type'		=> 'select',
		'id'		=> 'leadings_exp_type',
		'options'	=> array(
			'1' => _x('Text Paragraph', 'staffz', $theme),
			'2' => _x('Ordered List', 'staffz', $theme),
			'3' => _x('Unordered List', 'staffz', $theme),
			'4' => _x('Table', 'staffz', $theme),
		),
		'default'	=> '3',
	) );

	$leadings_Tab->createOption( array(
		'name'		=> _x('Honors Content Type', 'staffz', $theme),
		'type'		=> 'select',
		'id'		=> 'leadings_hnr_type',
		'options'	=> array(
			'1' => _x('Text Paragraph', 'staffz', $theme),
			'2' => _x('Ordered List', 'staffz', $theme),
			'3' => _x('Unordered List', 'staffz', $theme),
			'4' => _x('Table', 'staffz', $theme),
		),
		'default'	=> '3',
	) );

	$leadings_Tab->createOption( array(
		'name'		=> _x('Teaching Content Type', 'staffz', $theme),
		'type'		=> 'select',
		'id'		=> 'leadings_tch_type',
		'options'	=> array(
			'1' => _x('Text Paragraph', 'staffz', $theme),
			'2' => _x('Ordered List', 'staffz', $theme),
			'3' => _x('Unordered List', 'staffz', $theme),
			'4' => _x('Table', 'staffz', $theme),
		),
		'default'	=> '1',
	) );

	$leadings_Tab->createOption( array(
		'name'		=> _x('Specialty Content Type', 'staffz', $theme),
		'type'		=> 'select',
		'id'		=> 'leadings_spc_type',
		'options'	=> array(
			'1' => _x('Text Paragraph', 'staffz', $theme),
			'2' => _x('Ordered List', 'staffz', $theme),
			'3' => _x('Unordered List', 'staffz', $theme),
			'4' => _x('Table', 'staffz', $theme),
		),
		'default'	=> '1',
	) );

	$leadings_Tab->createOption( array(
		'name'		=> _x('Papers Content Type', 'staffz', $theme),
		'type'		=> 'select',
		'id'		=> 'leadings_ppr_type',
		'options'	=> array(
			'1' => _x('Text Paragraph', 'staffz', $theme),
			'2' => _x('Ordered List', 'staffz', $theme),
			'3' => _x('Unordered List', 'staffz', $theme),
			'4' => _x('Table', 'staffz', $theme),
		),
		'default'	=> '2',
	) );

	$leadings_Tab->createOption( array(
		'name'		=> _x('Projects Content Type', 'staffz', $theme),
		'type'		=> 'select',
		'id'		=> 'leadings_prj_type',
		'options'	=> array(
			'1' => _x('Text Paragraph', 'staffz', $theme),
			'2' => _x('Ordered List', 'staffz', $theme),
			'3' => _x('Unordered List', 'staffz', $theme),
			'4' => _x('Table', 'staffz', $theme),
		),
		'default'	=> '2',
	) );

	$leadings_Tab->createOption( array(
	'type' => 'save',
	'save' => __('Save Changes', $theme),
	'reset' => __('Reset to Defaults', $theme),
	) );

/*---------------------------------------------------*/

	//Faculties Tab

	$faculties_Tab = $adminPanel->createTab( array(
	'name' => _x('Faculties', 'staffz tab', $theme),
	) );

	// Create options in My General Tab

	$faculties_Tab->createOption( array(
	'name' => _x('Columns Order', 'staffz', $theme),
	'type' => 'heading',
	) );

	$faculties_Tab->createOption( array(
		'name'    => _x('Basic Columns Order', 'staffz', $theme),
		'id'      => 'faculties_basic_order',
		'type'    => 'sortable',
		'desc'    => 'This is our option',
		'options' => array(
		//'job_title'		=> _x('Job Title', 'staffz', $theme),	//職稱
		'duputy'		=> _x('Duputy 1', 'staffz', $theme),		//代理人1
		//'duputy2'		=> _x('Duputy 2', 'staffz', $theme),		//代理人2
		'staff_services'=> _x('Services', 'staffz', $theme),		//主辦業務
		'staff_email'	=> _x('Email', 'staffz', $theme),			//Email
		'staff_phone'	=> _x('Phone Number', 'staffz', $theme),	//電話
		//'staff_ext'		=> _x('Ext', 'staffz', $theme),				//分機
		'staff_fax'		=> _x('Fax Number', 'staffz', $theme),		//傳真		
		),
	) );

	$faculties_Tab->createOption( array(
		'name'    => _x('Advance Columns Order', 'staffz', $theme),
		'id'      => 'faculties_advance_order',
		'type'    => 'sortable',
		'desc'    => 'This is our option',
		'options' => array(
		'educations'	=> _x('Education', 'staffz', $theme),			//學歷
		'experiences'	=> _x('Experience', 'staffz', $theme),			//經歷
		'honors'		=> _x('Honor', 'staffz', $theme),				//榮譽
		'teaching'		=> _x('Teaching', 'staffz', $theme),			//授課領域
		'specialty'		=> _x('Specialty', 'staffz', $theme),			//研究專長
		'papers'		=> _x('Journal Papers', 'staffz', $theme),		//期刊論文
		'projects'		=> _x('Research Projects', 'staffz', $theme),	//研究計畫
		)
	) );

	$faculties_Tab->createOption( array(
	'name' => _x('Columns Content Type', 'staffz', $theme),
	'type' => 'heading',
	) );

	$faculties_Tab->createOption( array(
		'name'		=> _x('Educations Content Type', 'staffz', $theme),
		'type'		=> 'select',
		'id'		=> 'faculties_edu_type',
		'options'	=> array(
			'1' => _x('Text Paragraph', 'staffz', $theme),
			'2' => _x('Ordered List', 'staffz', $theme),
			'3' => _x('Unordered List', 'staffz', $theme),
			'4' => _x('Table', 'staffz', $theme),
		),
		'default'	=> '3',
	) );

	$faculties_Tab->createOption( array(
		'name'		=> _x('Experiences Content Type', 'staffz', $theme),
		'type'		=> 'select',
		'id'		=> 'faculties_exp_type',
		'options'	=> array(
			'1' => _x('Text Paragraph', 'staffz', $theme),
			'2' => _x('Ordered List', 'staffz', $theme),
			'3' => _x('Unordered List', 'staffz', $theme),
			'4' => _x('Table', 'staffz', $theme),
		),
		'default'	=> '3',
	) );

	$faculties_Tab->createOption( array(
		'name'		=> _x('Honors Content Type', 'staffz', $theme),
		'type'		=> 'select',
		'id'		=> 'faculties_hnr_type',
		'options'	=> array(
			'1' => _x('Text Paragraph', 'staffz', $theme),
			'2' => _x('Ordered List', 'staffz', $theme),
			'3' => _x('Unordered List', 'staffz', $theme),
			'4' => _x('Table', 'staffz', $theme),
		),
		'default'	=> '3',
	) );

	$faculties_Tab->createOption( array(
		'name'		=> _x('Teaching Content Type', 'staffz', $theme),
		'type'		=> 'select',
		'id'		=> 'faculties_tch_type',
		'options'	=> array(
			'1' => _x('Text Paragraph', 'staffz', $theme),
			'2' => _x('Ordered List', 'staffz', $theme),
			'3' => _x('Unordered List', 'staffz', $theme),
			'4' => _x('Table', 'staffz', $theme),
		),
		'default'	=> '1',
	) );

	$faculties_Tab->createOption( array(
		'name'		=> _x('Specialty Content Type', 'staffz', $theme),
		'type'		=> 'select',
		'id'		=> 'faculties_spc_type',
		'options'	=> array(
			'1' => _x('Text Paragraph', 'staffz', $theme),
			'2' => _x('Ordered List', 'staffz', $theme),
			'3' => _x('Unordered List', 'staffz', $theme),
			'4' => _x('Table', 'staffz', $theme),
		),
		'default'	=> '1',
	) );

	$faculties_Tab->createOption( array(
		'name'		=> _x('Papers Content Type', 'staffz', $theme),
		'type'		=> 'select',
		'id'		=> 'faculties_ppr_type',
		'options'	=> array(
			'1' => _x('Text Paragraph', 'staffz', $theme),
			'2' => _x('Ordered List', 'staffz', $theme),
			'3' => _x('Unordered List', 'staffz', $theme),
			'4' => _x('Table', 'staffz', $theme),
		),
		'default'	=> '2',
	) );

	$faculties_Tab->createOption( array(
		'name'		=> _x('Projects Content Type', 'staffz', $theme),
		'type'		=> 'select',
		'id'		=> 'faculties_prj_type',
		'options'	=> array(
			'1' => _x('Text Paragraph', 'staffz', $theme),
			'2' => _x('Ordered List', 'staffz', $theme),
			'3' => _x('Unordered List', 'staffz', $theme),
			'4' => _x('Table', 'staffz', $theme),
		),
		'default'	=> '2',
	) );

	$faculties_Tab->createOption( array(
	'type' => 'save',
	'save' => __('Save Changes', $theme),
	'reset' => __('Reset to Defaults', $theme),
	) );

/*---------------------------------------------------*/

	//Staffs Tab

	$staffs_Tab = $adminPanel->createTab( array(
	'name' => _x('Staffs', 'staffz tab', $theme),
	) );

	// Create options in My General Tab

	$staffs_Tab->createOption( array(
	'name' => _x('Columns Order', 'staffz', $theme),
	'type' => 'heading',
	) );

	$staffs_Tab->createOption( array(
		'name'    => _x('Basic Columns Order', 'staffz', $theme),
		'id'      => 'staffs_basic_order',
		'type'    => 'sortable',
		'desc'    => 'This is our option',
		'options' => array(
		//'job_title'		=> _x('Job Title', 'staffz', $theme),	//職稱
		'duputy'		=> _x('Duputy 1', 'staffz', $theme),		//代理人1
		//'duputy2'		=> _x('Duputy 2', 'staffz', $theme),		//代理人2
		'staff_services'=> _x('Services', 'staffz', $theme),		//主辦業務
		'staff_email'	=> _x('Email', 'staffz', $theme),			//Email
		'staff_phone'	=> _x('Phone Number', 'staffz', $theme),	//電話
		//'staff_ext'		=> _x('Ext', 'staffz', $theme),			//分機
		'staff_fax'		=> _x('Fax Number', 'staffz', $theme),		//傳真		
		),
	) );

	$staffs_Tab->createOption( array(
		'name'    => _x('Advance Columns Order', 'staffz', $theme),
		'id'      => 'staffs_advance_order',
		'type'    => 'sortable',
		'desc'    => 'This is our option',
		'options' => array(
		'educations'	=> _x('Education', 'staffz', $theme),			//學歷
		'experiences'	=> _x('Experience', 'staffz', $theme),			//經歷
		'honors'		=> _x('Honor', 'staffz', $theme),				//榮譽
		'teaching'		=> _x('Teaching', 'staffz', $theme),			//授課領域
		'specialty'		=> _x('Specialty', 'staffz', $theme),			//研究專長
		'papers'		=> _x('Journal Papers', 'staffz', $theme),		//期刊論文
		'projects'		=> _x('Research Projects', 'staffz', $theme),	//研究計畫
		),	
	) );

	$staffs_Tab->createOption( array(
	'name' => _x('Columns Content Type', 'staffz', $theme),
	'type' => 'heading',
	) );

	$staffs_Tab->createOption( array(
		'name'		=> _x('Educations Content Type', 'staffz', $theme),
		'type'		=> 'select',
		'id'		=> 'staffs_edu_type',
		'options'	=> array(
			'1' => _x('Text Paragraph', 'staffz', $theme),
			'2' => _x('Ordered List', 'staffz', $theme),
			'3' => _x('Unordered List', 'staffz', $theme),
			'4' => _x('Table', 'staffz', $theme),
		),
		'default'	=> '3',
	) );

	$staffs_Tab->createOption( array(
		'name'		=> _x('Experiences Content Type', 'staffz', $theme),
		'type'		=> 'select',
		'id'		=> 'staffs_exp_type',
		'options'	=> array(
			'1' => _x('Text Paragraph', 'staffz', $theme),
			'2' => _x('Ordered List', 'staffz', $theme),
			'3' => _x('Unordered List', 'staffz', $theme),
			'4' => _x('Table', 'staffz', $theme),
		),
		'default'	=> '3',
	) );

	$staffs_Tab->createOption( array(
		'name'		=> _x('Honors Content Type', 'staffz', $theme),
		'type'		=> 'select',
		'id'		=> 'staffs_hnr_type',
		'options'	=> array(
			'1' => _x('Text Paragraph', 'staffz', $theme),
			'2' => _x('Ordered List', 'staffz', $theme),
			'3' => _x('Unordered List', 'staffz', $theme),
			'4' => _x('Table', 'staffz', $theme),
		),
		'default'	=> '3',
	) );

	$staffs_Tab->createOption( array(
		'name'		=> _x('Teaching Content Type', 'staffz', $theme),
		'type'		=> 'select',
		'id'		=> 'staffs_tch_type',
		'options'	=> array(
			'1' => _x('Text Paragraph', 'staffz', $theme),
			'2' => _x('Ordered List', 'staffz', $theme),
			'3' => _x('Unordered List', 'staffz', $theme),
			'4' => _x('Table', 'staffz', $theme),
		),
		'default'	=> '1',
	) );

	$staffs_Tab->createOption( array(
		'name'		=> _x('Specialty Content Type', 'staffz', $theme),
		'type'		=> 'select',
		'id'		=> 'staffs_spc_type',
		'options'	=> array(
			'1' => _x('Text Paragraph', 'staffz', $theme),
			'2' => _x('Ordered List', 'staffz', $theme),
			'3' => _x('Unordered List', 'staffz', $theme),
			'4' => _x('Table', 'staffz', $theme),
		),
		'default'	=> '1',
	) );

	$staffs_Tab->createOption( array(
		'name'		=> _x('Papers Content Type', 'staffz', $theme),
		'type'		=> 'select',
		'id'		=> 'staffs_ppr_type',
		'options'	=> array(
			'1' => _x('Text Paragraph', 'staffz', $theme),
			'2' => _x('Ordered List', 'staffz', $theme),
			'3' => _x('Unordered List', 'staffz', $theme),
			'4' => _x('Table', 'staffz', $theme),
		),
		'default'	=> '2',
	) );

	$staffs_Tab->createOption( array(
		'name'		=> _x('Projects Content Type', 'staffz', $theme),
		'type'		=> 'select',
		'id'		=> 'staffs_prj_type',
		'options'	=> array(
			'1' => _x('Text Paragraph', 'staffz', $theme),
			'2' => _x('Ordered List', 'staffz', $theme),
			'3' => _x('Unordered List', 'staffz', $theme),
			'4' => _x('Table', 'staffz', $theme),
		),
		'default'	=> '2',
	) );

	$staffs_Tab->createOption( array(
	'type' => 'save',
	'save' => __('Save Changes', $theme),
	'reset' => __('Reset to Defaults', $theme),
	) );

/*---------------------------------------------------*/

	//Catalogue Tab

	$catalogue_Tab = $adminPanel->createTab( array(
		'name' => _x('Catalogue', 'staffz tab', $theme),
	) );

	$catalogue_Tab->createOption( array(
		'name' => _x('Columns Order', 'staffz', $theme),
		'type' => 'heading',
	) );

	$catalogue_Tab->createOption( array(
		'name'    => _x('Catalogue Order', 'staffz', $theme),
		'id'      => 'catalogue_order',
		'type'    => 'sortable',
		'desc'    => 'This is our option',
		'options' => array(
		'job_title'		=> _x('Job Title', 'staffz', $theme),		//職稱
		'staff_name'	=> _x('Staff Name', 'staffz', $theme),		//姓名
		//'duputy'		=> _x('Duputy 1', 'staffz', $theme),		//代理人1
		//'duputy2'		=> _x('Duputy 2', 'staffz', $theme),		//代理人2
		//'staff_services'=> _x('Services', 'staffz', $theme),		//主辦業務
		'staff_email'	=> _x('Staff Email', 'staffz', $theme),			//Email
		'staff_phone'	=> _x('Staff Phone', 'staffz', $theme),	//電話
		'staff_ext'		=> _x('Staff Ext', 'staffz', $theme),			//分機
		'staff_fax'		=> _x('Staff Fax', 'staffz', $theme),		//傳真		
		),
	) );

	$catalogue_Tab->createOption( array(
	'type' => 'save',
	'save' => __('Save Changes', $theme),
	'reset' => __('Reset to Defaults', $theme),
	) );

/*---------------------------------------------------*/

	///// Staffz - Create Meta Box
	
	//if section custom field 'type' is faculty / staff....

	$jobs_meta = $titan->createMetaBox( array(
		'name' => _x('Responsibles', 'staffz', $theme), //職務資訊
		'post_type' => 'staffz',
	) );
		
	$jobs_meta->createOption( array(
		'name' => _x('Job Title', 'staffz', $theme),
		'id' => 'job_title',	//職稱
		'type' => 'text',
		) );
	$jobs_meta->createOption( array(
		'name' 		=> _x('Duputy 1', 'staffz', $theme),
		'id' 		=> 'duputy',//代理人1
		'type' 		=> 'select-posts',
		'post_type' 	=> 'staffz',
		'post_status' 	=> 'publish',
		'orderby' 	=> 'menu_order',
		'default'	=> '',
		) );
	$jobs_meta->createOption( array(
		'name' 		=> _x('Duputy 2', 'staffz', $theme),
		'id' 		=> 'duputy2',//代理人2
		'type' 		=> 'select-posts',
		'post_type' 	=> 'staffz',
		'post_status' 	=> 'publish',
		'orderby' 	=> 'menu_order',
		'default'	=> '',
		) );
	$jobs_meta->createOption( array(
		'name' => _x('Services', 'staffz', $theme),//主辦業務	
		'id' => 'staff_services',
		'type' => 'textarea',									
		) );
	
	//endif....

	$contact_meta = $titan->createMetaBox( array(
		'name' => _x('Contact Informations', 'staffz', $theme),		//聯絡資訊
		'post_type' => 'staffz',
	) );
	
	$contact_meta->createOption( array(
		'name' => _x('Email', 'staffz', $theme),	//Email
		'id' => 'staff_email',
		'type' => 'text',
		) );		
	$contact_meta->createOption( array(
		'name' => _x('Phone Number', 'staffz', $theme),	//電話
		'id' => 'staff_phone',
		'type' => 'text',
		) );
	$contact_meta->createOption( array(
		'name' => _x('Direct Phone Number', 'staffz', $theme),	//電話為直播號碼
		'id' => 'staff_phone_direct',
		'type' => 'enable',
		'default' => true,
		'enabled' => _x('Direct Line', 'staffz', $theme),
		'disabled' => _x('Not Direct Line', 'staffz', $theme),
		) );
	$contact_meta->createOption( array(
		'name' => _x('Ext', 'staffz', $theme),		//分機
		'id' => 'staff_ext',
		'type' => 'text',
		) );
	$contact_meta->createOption( array(
		'name' => _x('Fax Number', 'staffz', $theme),	//傳真
		'id' => 'staff_fax',
		'type' => 'text',
		) );
		
		
	$exp_meta = $titan->createMetaBox( array(
		'name' => _x('Experiences', 'staffz', $theme),	//學經歷
		'post_type' => 'staffz',
	) );
	$exp_meta->createOption( array(
		'name' => _x('Education', 'staffz', $theme),	//學歷
		'id' => 'educations',
		'type' => 'textarea',
	) );
	$exp_meta->createOption( array(
		'name' => _x('Experience', 'staffz', $theme),	//經歷
		'id' => 'experiences',
		'type' => 'textarea',
	) );
	$exp_meta->createOption( array(
		'name' => _x('Honor', 'staffz', $theme),		//榮譽
		'id' => 'honors',
		'type' => 'textarea',
	) );
	
	$aca_meta = $titan->createMetaBox( array(
		'name' => _x('Academic Achievements', 'staffz', $theme),//學術成就
		'post_type' => 'staffz',
	) );	
	$aca_meta->createOption( array(
		'name' => _x('Teaching', 'staffz', $theme),	//授課領域
		'id' => 'teaching',
		'type' => 'text',
	) );
	$aca_meta->createOption( array(
		'name' => _x('Specialty', 'staffz', $theme),	//研究專長
		'id' => 'specialty',
		'type' => 'text',
	) );
	
	$aca_meta->createOption( array(
		'name' => _x('Journal Papers', 'staffz', $theme),	//期刊論文
		'id' => 'papers',
		'type' => 'textarea',
	) );
	$aca_meta->createOption( array(
		'name' => _x('Research Projects', 'staffz', $theme),//研究計畫
		'id' => 'projects',
		'type' => 'textarea',
	) );

/*----------------------------------------------------------*/
//Page Meta Boxes 頁面選項

	$pageMetaBox1 = $titan->createMetaBox( array(
		'name' => 'Staffz Page Options',
		'context' => 'side',
		'priority'=> 'default',
	) );

	$pageMetaBox1->createOption( array(
		'name' => 'Select a Staff',
		'id' => 'staffz_single_id',
		'type' => 'select-posts',
		'desc' => 'This is an option',
		'post_type' => 'staffz',
		'default' => '',
	) );
/*	$pageMetaBox1->createOption( array(
		'name' => 'Page Layout',
		'id' => 'staffz_single_layout',
		'type' => 'select',
		'options' => array(),
	) );


	$pageMetaBox2 = $titan->createMetaBox( array(
		'name' => 'Download Page Options',
		'context' => 'side',
		'priority'=> 'default',
	) );
	$pageMetaBox2->createOption( array(
		'name' => 'Downloads or not',
		'id'   => 'download_list_page',
		'type' => 'enable',
		'default' => false,
	) );
*/	
}

add_action( 'tf_create_options', 'mytheme_create_options' );
function mytheme_create_options() {
	
	global $titan;
	global $theme;	

	$header_section = $titan->createThemeCustomizerSection( array(
		'id' => 'header_image',
	) );

	//頁首樣式
	$header_section->createOption( array(
		'name' => __('Header Layout', $theme),
		'id' => 'header_layout',
		'type' => 'select',
		'options' => array(
		'1' => sprintf(_x('Layout %d', 'options panel', $theme), 1),
		'2' => sprintf(_x('Layout %d', 'options panel', $theme), 2),
		'3' => sprintf(_x('Layout %d', 'options panel', $theme), 3),
		'4' => sprintf(_x('Layout %d', 'options panel', $theme), 4),
		),
		'default' => '1',
	) );

	$general_section = $titan->createThemeCustomizerSection( array(
		'id' => 'understrap_general',
		'name' => __('General Options', $theme),
	) );

	//導覽列位置指引
	$general_section->createOption( array(
	'name' => __('Navigation Position Guide', $theme),
	'id' => 'menu_hint_enabled',
	'type' => 'enable',
	'default' => true,
	'enabled' => __('Enable', $theme),
	'disabled' => __('Disable', $theme),
	) );

	//小工具位置指引
	$general_section->createOption( array(
	'name' => __('Sidebar Position Guide', $theme),
	'id' => 'widget_hint_enabled',
	'type' => 'enable',
	'default' => true,
	'enabled' => __('Enable', $theme),
	'disabled' => __('Disable', $theme),	
	) );

	$archives_section = $titan->createThemeCustomizerSection( array(
		'id' => 'understrap_archives_layout',
		'name' => __('Archieve Options', $theme),
	) );

	$args = array(
		"exclude"    => '1',
		"hide_empty" => 0,
	        "type"       => "post",      
	        "orderby"    => "name",
	        "order"      => "ASC" );
	$categories = get_categories($args);

	foreach( $categories as $category ) {
	
	//分類顏色
	$archives_section->createOption( array(
		'name' => __('Category Color :', $theme).$category->name,
		'id'   => 'catgory_color_'.$category->cat_ID,
		'type' => 'color',
		'css'  => 'article.category-'.$category->cat_ID.' .category-tag { background: value}',
		'livepreview' => '$("article.category-'.$category->cat_ID.' .category-tag").css("background",value)',
		'default' => '#134c9d',
	) );
	
	}

	//置頂文章文字
	$archives_section->createOption( array(
		'name' => __('Sticky Post Label', $theme),
		'id' => 'sticky_label',
		'type' => 'text',
		'default' => __('Sticky', $theme),
		'livepreview' => '$(".sticky-tag").html(value)'
	) );

	//置頂文章樣式
	$archives_section->createOption( array(
		'name' => __('Sticky Post Style', $theme),
		'id' => 'sticky_style',
		'type' => 'select',
		'options' => array(
		'1' => sprintf(_x('Layout %d', 'options panel', $theme), 1),
		'2' => sprintf(_x('Layout %d', 'options panel', $theme), 2),
		),
		'default' => '1',
	) );

	//置頂文章顏色
	$archives_section->createOption( array(
		'name' => __('Sticky Post Color', $theme),
		'id'   => 'sticky_color',
		'type' => 'color',
		'default' => '#e74c3c',
	) );


	$sitemap_section = $titan->createThemeCustomizerSection( array(
		'id' => 'understrap_sitemap',
		'name' => __('Sitemap Options', $theme),
	) );
	
	function get_menus_in_array() {
		$menus = get_terms('nav_menu');
		$array = array();
		foreach($menus as $menu){
			$array[$menu->term_id] = $menu->name;
		}
		return $array;
	}
	
	//主要選單
	$sitemap_section->createOption( array(
		'name' => __('Major Navigation', $theme),
		'id' => 'major_nav',
		'type' => 'select',
		'options' => array( 0 => '— 選擇 —' ) + get_menus_in_array(),
		'default' => '0',
	) );
	
	//次要選單
	$sitemap_section->createOption( array(
		'name' => __('Minor Navigation', $theme),
		'id' => 'minor_nav',
		'type' => 'select',
		'options' => array( 0 => '— 選擇 —' ) + get_menus_in_array(),
		'default' => '0',
	) );
	
	//其他選單
	$sitemap_section->createOption( array(
		'name' => __('Another Navigation', $theme),
		'id' => 'another_nav',
		'type' => 'select',
		'options' => array( 0 => '— 選擇 —' ) + get_menus_in_array(),
		'default' => '0',
	) );
}

?>