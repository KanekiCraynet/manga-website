<?php
add_filter( 'rwmb_meta_boxes', 'prefix_register_meta_boxes' );
function prefix_register_meta_boxes( $meta_boxes ) {
	$prefix = 'smoke_';
	$prefixx = 'smoker_';
	$meta_boxes[] = array(
		'id' => 'komik',
		'title' => __( 'Info Manga Series', 'meta-box' ),
		'pages' => array( 'komik' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
			array(
				'name'     => __( 'Hot Manga?', 'meta-box' ),
				'id'       => "{$prefix}hot",
				'type'     => 'select',
				'options'  => array(
					'No' => __( 'No', 'meta-box' ),
					'Yes' => __( 'Yes', 'meta-box' ),
				),
				'multiple'    => false,
				'std'         => 'No',
			),
			array(
				'name'  => __( 'Native Title', 'meta-box' ),
				'id'    => "{$prefix}nativez",
				'desc'  => __( 'Input Native Title', 'meta-box' ),
				'type'  => 'text',
			),
			array(
				'name'     => __( 'Status', 'meta-box' ),
				'id'       => "{$prefix}status",
				'type'     => 'select',
				'options'  => array(
					'Ongoing' => __( 'Ongoing', 'meta-box' ),
					'Completed' => __( 'Completed', 'meta-box' ),
				),
				'multiple'    => false,
				'std'         => 'Ongoing',
			),
			array(
				'name'     => __( 'Project', 'meta-box' ),
				'id'       => "{$prefix}project",
				'type'     => 'select',
				'options'  => array(
					'No' => __( 'No', 'meta-box' ),
					'Yes' => __( 'Yes', 'meta-box' ),
				),
				'multiple'    => false,
				'std'         => 'No',
			),
           array(
				'name' => __( 'Author', 'meta-box' ),
				'id'   => "{$prefix}author",
				'desc'  => __( 'input Author name', 'meta-box' ),
				'type' => 'text',
			),
			array(
				'name'  => __( 'Rating', 'meta-box' ),
				'id'    => "{$prefix}rate",
				'desc'  => __( 'input rating komik', 'meta-box' ),
				'type'  => 'text',
			),
						array(
				'name'  => __( 'Total Chapter', 'meta-box' ),
				'id'    => "{$prefix}total",
				'desc'  => __( 'input chapter komik', 'meta-box' ),
				'type'  => 'text',
			),
			array(
				'name' => __( 'Release Date', 'meta-box' ),
				'id'   => "{$prefix}date",
				'desc'  => __( 'input release date', 'meta-box' ),
				'type' => 'date',

				'js_options' => array(
					'appendText'      => __( '(M dd, yyyy)', 'meta-box' ),
					'dateFormat'      => __( 'M dd, yy', 'meta-box' ),
					'changeMonth'     => true,
					'changeYear'      => true,
					'showButtonPanel' => true,
				),
			),
		
         )
			
	);
	
	$meta_boxes[] = array(
		'id' => 'post',
		'title' => __( 'Kategori Komik', 'meta-box' ),
	        'pages' => array( 'post' ),
	        'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
			array(
				'name' => __( 'Chapter', 'meta-box' ),
				'id'   => "{$prefixx}chapter",
				'desc'  => __( 'Masukkan Chapter Keberapa', 'meta-box' ),
				'type' => 'text',
			),
			array(
				'name'     => __( 'Format', 'meta-box' ),
				'id'       => "{$prefix}formz",
				'type'     => 'select',
				'options'  => array(
					'Volume' => __( 'Volume', 'meta-box' ),
					'Chapter' => __( 'Chapter', 'meta-box' ),
				),
				'multiple'    => false,
				'std'         => 'Volume',
			),
		array(
				'name'    => __( 'Komik', 'meta-box' ),
				'id'      => "{$prefix}series",
				'type'    => 'post',
				'post_type' => 'komik',
				'field_type' => 'select_advanced',
				'query_args' => array(
					'post_status'    => 'publish',
					'posts_per_page' => - 1,
					'orderby' => 'title',
					'order' => 'ASC',
				),
		 )

		)
	);
	
$meta_boxes[] = array(
		'id' => 'chapter',
		'title' => __( 'Info Chapter', 'meta-box' ),
	        'pages' => array( 'chapter' ),
	        'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
			array(
				'name' => __( 'Chapter', 'meta-box' ),
				'id'   => "{$prefixx}chapter",
				'desc'  => __( 'Masukkan Chapter Keberapa', 'meta-box' ),
				'type' => 'text',
			),
			array(
				'name'  => __( 'Download Box', 'meta-box' ),
				'id'    => "{$prefix}dlbox",
				'desc'  => __( 'Masukkan link Download', 'meta-box' ),
				'type'  => 'textarea',
			),
      array(
        'name'  => __( 'Gambar Manga', 'meta-box' ),
        'id'    => "{$prefix}gamb",
        'desc'  => __( 'Masukkan Gambar Manga Sesuai urutan', 'meta-box' ),
        'type'  => 'textarea',
        'clone' => 'true',
      ),
		array(
				'name'    => __( 'Komik', 'meta-box' ),
				'id'      => "{$prefix}series",
				'type'    => 'post',
				'post_type' => 'komik',
				'field_type' => 'select_advanced',
				'query_args' => array(
					'post_status'    => 'publish',
					'posts_per_page' => - 1,
					'orderby' => 'title',
					'order' => 'ASC',
				),
		 )

		)
	);

$meta_boxes[] = array(
		'id' => 'dlbatch',
		'title' => __( 'Link Download', 'meta-box' ),
	        'pages' => array( 'komik' ),
		'fields' => array(
			array(
				'name'  => __( 'Link Download', 'meta-box' ),
				'id'    => "{$prefix}dlbatch",
				'desc'  => __( 'Input link download', 'meta-box' ),
				'type'  => 'wysiwyg',
			),
		)
	);

$meta_boxes[] = array(
		'id' => 'dlbox',
		'title' => __( 'Link Download', 'meta-box' ),
	        'pages' => array( 'post' ),
		'fields' => array(
			array(
				'name'  => __( 'Link Download', 'meta-box' ),
				'id'    => "{$prefix}dlbox4",
				'desc'  => __( 'Input link download 2', 'meta-box' ),
				'type'  => 'text',
			),
					array(
				'name'  => __( 'Link Download', 'meta-box' ),
				'id'    => "{$prefix}dlbox1",
				'desc'  => __( 'Input link download 3', 'meta-box' ),
				'type'  => 'text',
			),
		)
	);

	return $meta_boxes;
}
?>