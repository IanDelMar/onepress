<?php
/**
 * Theme Option: Blog Posts
 *
 * @package OnePress\Customizer
 * @since 2.1.0
 */

// Add 'Blog Posts' section.
$wp_customize->add_section(
	'onepress_blog_posts',
	array(
		'priority'    => null,
		'title'       => esc_html__( 'Blog Posts', 'onepress' ),
		'description' => '',
		'panel'       => 'onepress_options',
	)
);

// Disable archive prefix setting.
$wp_customize->add_setting(
	'onepress_disable_archive_prefix',
	array(
		'sanitize_callback' => 'onepress_sanitize_checkbox',
		'default'           => '',
	)
);

// Disable archive prefix control.
$wp_customize->add_control(
	'onepress_disable_archive_prefix',
	array(
		'type'        => 'checkbox',
		'label'       => esc_html__( 'Disable archive prefix', 'onepress' ),
		'section'     => 'onepress_blog_posts',
		'description' => esc_html__( 'Check this to disable archive prefix on category, date, tag page.', 'onepress' ),
	)
);
