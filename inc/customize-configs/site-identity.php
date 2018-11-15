<?php
/**
 * Site Identity
 *
 * @package OnePress\Customizer
 * @since Unknown
 */

$is_old_logo = get_theme_mod( 'onepress_site_image_logo' );

$wp_customize->add_setting(
	'onepress_hide_sitetitle',
	array(
		'sanitize_callback' => 'onepress_sanitize_checkbox',
		'default'           => $is_old_logo ? 1 : 0,
	)
);
$wp_customize->add_control(
	'onepress_hide_sitetitle',
	array(
		'label'   => esc_html__( 'Hide site title', 'onepress' ),
		'section' => 'title_tagline',
		'type'    => 'checkbox',
	)
);

$wp_customize->add_setting(
	'onepress_hide_tagline',
	array(
		'sanitize_callback' => 'onepress_sanitize_checkbox',
		'default'           => $is_old_logo ? 1 : 0,
	)
);
$wp_customize->add_control(
	'onepress_hide_tagline',
	array(
		'label'   => esc_html__( 'Hide site tagline', 'onepress' ),
		'section' => 'title_tagline',
		'type'    => 'checkbox',

	)
);

// Retina Logo
$wp_customize->add_setting(
	'onepress_retina_logo',
	array(
		'sanitize_callback' => 'esc_raw_url',
		'default'           => '',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new WP_Customize_Image_Control(
		$wp_customize,
		'onepress_retina_logo',
		array(
			'label'   => esc_html__( 'Retina Logo', 'onepress' ),
			'section' => 'title_tagline',
		)
	)
);


// Logo Width
$wp_customize->add_setting(
	'onepress_logo_height',
	array(
		'sanitize_callback' => 'onepress_sanitize_posint',
		'validate_callback' => 'onepress_validate_posint',
		'default'           => '',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	'onepress_logo_height',
	array(
		'label'   => esc_html__( 'Logo Height In Pixel', 'onepress' ),
		'section' => 'title_tagline',
	)
);
