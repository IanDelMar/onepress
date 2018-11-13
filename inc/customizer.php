<?php
/**
 * OnePress Theme Customizer.
 *
 * @package OnePress\Customizer
 */

/**
 * Retrieve animate.css animations as choice array for select.
 *
 * @see https://github.com/daneden/animate.css
 *
 * @since x.x.x
 * @return array
 */
function onepress_get_animatecss_choices() {
	$animatecss = array(
		'bounce',
		'flash',
		'pulse',
		'rubberBand',
		'shake',
		'headShake',
		'swing',
		'tada',
		'wobble',
		'jello',
		'bounceIn',
		'bounceInDown',
		'bounceInLeft',
		'bounceInRight',
		'bounceInUp',
		'bounceOut',
		'bounceOutDown',
		'bounceOutLeft',
		'bounceOutRight',
		'bounceOutUp',
		'fadeIn',
		'fadeInDown',
		'fadeInDownBig',
		'fadeInLeft',
		'fadeInLeftBig',
		'fadeInRight',
		'fadeInRightBig',
		'fadeInUp',
		'fadeInUpBig',
		'fadeOut',
		'fadeOutDown',
		'fadeOutDownBig',
		'fadeOutLeft',
		'fadeOutLeftBig',
		'fadeOutRight',
		'fadeOutRightBig',
		'fadeOutUp',
		'fadeOutUpBig',
		'flipInX',
		'flipInY',
		'flipOutX',
		'flipOutY',
		'lightSpeedIn',
		'lightSpeedOut',
		'rotateIn',
		'rotateInDownLeft',
		'rotateInDownRight',
		'rotateInUpLeft',
		'rotateInUpRight',
		'rotateOut',
		'rotateOutDownLeft',
		'rotateOutDownRight',
		'rotateOutUpLeft',
		'rotateOutUpRight',
		'hinge',
		'rollIn',
		'rollOut',
		'zoomIn',
		'zoomInDown',
		'zoomInLeft',
		'zoomInRight',
		'zoomInUp',
		'zoomOut',
		'zoomOutDown',
		'zoomOutLeft',
		'zoomOutRight',
		'zoomOutUp',
		'slideInDown',
		'slideInLeft',
		'slideInRight',
		'slideInUp',
		'slideOutDown',
		'slideOutLeft',
		'slideOutRight',
		'slideOutUp',
	);

	$choices = array();
	foreach ( $animatecss as $v ) {
		$choices[ $v ] = $v;
	}
	return $choices;
}

/**
 * Add horizontal line
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @param string               $setting_id A unique slug-like ID for the theme setting.
 * @param string               $section_id Any Customizer section.
 */
function onepress_add_hr_setting( $wp_customize, $setting_id, $section_id ) {
	$wp_customize->add_setting(
		$setting_id,
		array(
			'sanitize_callback' => 'onepress_sanitize_text',
		)
	);
	$wp_customize->add_control(
		new OnePress_Misc_Control(
			$wp_customize,
			$setting_id,
			array(
				'section' => $section_id,
				'type'    => 'hr',
			)
		)
	);
}

/**
 * Add main setting for sections
 *
 * Adds the disable, id, title, subtitle, description setting for a given
 * section (about, contact, ...).
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @param string               $section_id   The section ID (gallery, ...).
 * @param string               $setting_name The setting name.
 */
function onepress_add_section_main_setting( $wp_customize, $section_id, $setting_name = null ) {
	switch ( $setting_name ) {
		case 'disable':
			// Add setting.
			$wp_customize->add_setting(
				'onepress_' . $section_id . '_disable',
				array(
					'sanitize_callback' => 'onepress_sanitize_checkbox',
					'default'           => onepress_get_default_disable( $section_id ),
				)
			);
			// Add control.
			$wp_customize->add_control(
				'onepress_' . $section_id . '_disable',
				array(
					'type'        => 'checkbox',
					'label'       => esc_html__( 'Hide this section?', 'onepress' ),
					'section'     => 'onepress_' . $section_id . '_settings',
					'description' => esc_html__( 'Check this box to hide this section.', 'onepress' ),
				)
			);
			break;
		case 'id':
			// Add setting.
			$wp_customize->add_setting(
				'onepress_' . $section_id . '_id',
				array(
					'sanitize_callback' => 'sanitize_key',
					'default'           => $section_id,
				)
			);
			// Add control.
			$wp_customize->add_control(
				'onepress_' . $section_id . '_id',
				array(
					'label'       => esc_html__( 'Section ID:', 'onepress' ),
					'section'     => 'onepress_' . $section_id . '_settings',
					'description' => esc_html__( 'The section id, we will use this for link anchor.', 'onepress' ),
				)
			);
			break;
		case 'title':
			// Add setting.
			$wp_customize->add_setting(
				'onepress_' . $section_id . '_title',
				array(
					'sanitize_callback' => 'sanitize_text_field',
					'default'           => esc_html( onepress_get_default_section_title( $section_id ) ),
				)
			);
			// Add control.
			$wp_customize->add_control(
				'onepress_' . $section_id . '_title',
				array(
					'label'       => esc_html__( 'Section Title', 'onepress' ),
					'section'     => 'onepress_' . $section_id . '_settings',
					'description' => '',
				)
			);
			break;
		case 'subtitle':
			// Add setting.
			$wp_customize->add_setting(
				'onepress_' . $section_id . '_subtitle',
				array(
					'sanitize_callback' => 'sanitize_text_field',
					'default'           => esc_html__( 'Section Subtitle', 'onepress' ),
				)
			);
			// Add control.
			$wp_customize->add_control(
				'onepress_' . $section_id . '_subtitle',
				array(
					'label'       => esc_html__( 'Section Subtitle', 'onepress' ),
					'section'     => 'onepress_' . $section_id . '_settings',
					'description' => '',
				)
			);
			break;
		case 'desc':
			// Add setting.
			$wp_customize->add_setting(
				'onepress_' . $section_id . '_desc',
				array(
					'sanitize_callback' => 'onepress_sanitize_text',
					'default'           => '',
				)
			);
			// Add control.
			$wp_customize->add_control(
				new OnePress_Editor_Custom_Control(
					$wp_customize,
					'onepress_' . $section_id . '_desc',
					array(
						'label'       => esc_html__( 'Section Description', 'onepress' ),
						'section'     => 'onepress_' . $section_id . '_settings',
						'description' => '',
					)
				)
			);
			break;
		default:
			return null;
	}
}

/**
 * Get the default section title
 *
 * @param string $section_id The section ID (about, contact, ...).
 * @return string The default section title.
 */
function onepress_get_default_section_title( $section_id ) {
	$sections = Onepress_Config::get_sections();
	$default = false;
	if ( ! empty( $sections ) && isset( $sections[ $section_id ] ) ) {
		$default  = $sections[ $section_id ]['title'];
	}
	return ! empty( $default ) ? $default : '';
}

/**
 * Get the default for the section's disable setting.
 *
 * @param string $section_id The section ID (about, contact, ...).
 * @return bool The default disable value.
 */
function onepress_get_default_disable( $section_id ) {
	$sections = Onepress_Config::get_sections();
	$default  = $sections[ $section_id ]['disable'];

	return $default ? true : false;
}

/**
 * Add upsell message for section
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @param string               $section_id The ID of the customizer section.
 */
function onepress_add_upsell_for_section( $wp_customize, $section_id ) {
	if ( apply_filters( 'onepress_add_upsell_for_section', true, $section_id ) ) {

		$name = $section_id . '__upsell';
		$wp_customize->add_setting(
			$name,
			array(
				'sanitize_callback' => 'onepress_sanitize_text',
			)
		);
		$wp_customize->add_control(
			new OnePress_Misc_Control(
				$wp_customize,
				$name,
				array(
					'type'        => 'notice-info',
					'section'     => $section_id,
					'description' => wp_kses_post( __( '<h4 class="customizer-group-heading-message">Advanced Section Styling</h4><p class="customizer-group-heading-message">Check out the <a target="_blank" href="https://www.famethemes.com/plugins/onepress-plus/?utm_source=theme_customizer&utm_medium=text_link&utm_campaign=onepress_customizer#get-started">OnePress Plus</a> version for full control over the section styling which includes background color, image, video, parallax effect, custom style and more ...</p>', 'onepress' ) ),
				)
			)
		);
	}
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function onepress_customize_register( $wp_customize ) {

	// Load custom controls.
	$path = get_template_directory();
	require $path . '/inc/customizer-controls.php';

	// Remove default sections.
	// Custom WP default control & settings.
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	/**
	 * Hook to add other customize
	 */
	do_action( 'onepress_customize_before_register', $wp_customize );

	$pages           = get_pages();
	$option_pages    = array();
	$option_pages[0] = esc_html__( 'Select page', 'onepress' );
	foreach ( $pages as $p ) {
		$option_pages[ $p->ID ] = $p->post_title;
	}

	$users = get_users(
		array(
			'orderby' => 'display_name',
			'order'   => 'ASC',
			'number'  => '',
		)
	);

	$option_users[0] = esc_html__( 'Select member', 'onepress' );
	foreach ( $users as $user ) {
		$option_users[ $user->ID ] = $user->display_name;
	}

	/**
	 * Load Customize Configs
	 *
	 * @since 2.1.0
	 */
	$configs = array(
		'site-identity.php',               // Site identity.
		'options.php',                     // Custom CSS.
		'options-global.php',              // Global settings.
		'options-colors.php',              // Theme colors.
		'options-header.php',              // Header.
		'options-navigation.php',          // Navigation.
		'options-sections-navigation.php', // Section navigation.
		'options-page.php',                // Page title area.
		'options-blog-posts.php',          // Blog posts.
		'options-single.php',              // Single posts.
		'options-footer.php',              // Footer social, widgets, copyright.
	);

	foreach ( $configs as $config ) {
		$file = $path . '/inc/customize-configs/' . $config;
		if ( file_exists( $file ) ) {
				require_once $file;
		}
	}

	/**
	 * @since 2.1.1
	 * Load sections if enabled
	 */
	$sections = Onepress_Config::get_sections();

	foreach ( $sections as $key => $section ) {

		if ( Onepress_Config::is_section_active( $key ) ) {
			$file = $path . '/inc/customize-configs/section-' . $key . '.php';
			if ( file_exists( $file ) ) {
				require_once $file;
			}
		}
	}

	/**
	 * Section Up sell
	 */
	require_once $path . '/inc/customize-configs/section-upsell.php';

	/**
	 * Hook to add other customize
	 */
	do_action( 'onepress_customize_after_register', $wp_customize );

	/**
	 * Move WC Panel to bottom
	 *
	 * @since 2.1.1
	 */
	if ( onepress_is_wc_active() ) {
		$wp_customize->get_panel( 'woocommerce' )->priority = 300;
	}

}
add_action( 'customize_register', 'onepress_customize_register' );

/**
 * Selective refresh
 */
require get_template_directory() . '/inc/customizer-selective-refresh.php';


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function onepress_customize_preview_js() {
	wp_enqueue_script( 'onepress_customizer_liveview', get_template_directory_uri() . '/assets/js/customizer-liveview.js', array( 'customize-preview', 'customize-selective-refresh' ), false, true );
}
add_action( 'customize_preview_init', 'onepress_customize_preview_js', 65 );

function opneress_customize_js_settings() {
	if ( ! class_exists( 'Onepress_Dashboard' ) ) {
		return;
	}

	$actions       = Onepress_Dashboard::get_instance()->get_recommended_actions();
	$number_action = $actions['number_notice'];

	wp_localize_script(
		'customize-controls',
		'onepress_customizer_settings',
		array(
			'number_action'     => $number_action,
			'is_plus_activated' => class_exists( 'OnePress_Plus' ) ? 'y' : 'n',
			'action_url'        => admin_url( 'themes.php?page=ft_onepress&tab=recommended_actions' ),
		)
	);
}
add_action( 'customize_controls_enqueue_scripts', 'opneress_customize_js_settings' );

/**
 * Customizer Icon picker
 */
function onepress_customize_controls_enqueue_scripts() {
	wp_localize_script(
		'customize-controls',
		'C_Icon_Picker',
		apply_filters(
			'c_icon_picker_js_setup',
			array(
				'search' => esc_html__( 'Search', 'onepress' ),
				'fonts'  => array(
					'font-awesome' => array(
						// Name of icon.
						'name'   => esc_html__( 'Font Awesome', 'onepress' ),
						// prefix class example for font-awesome fa-fa-{name}.
						'prefix' => 'fa',
						// font url.
						'url'    => esc_url( add_query_arg( array( 'ver' => '4.7.0' ), get_template_directory_uri() . '/assets/css/font-awesome.min.css' ) ),
						// Icon class name, separated by |.
						'icons'  => 'fa-glass|fa-music|fa-search|fa-envelope-o|fa-heart|fa-star|fa-star-o|fa-user|fa-film|fa-th-large|fa-th|fa-th-list|fa-check|fa-times|fa-search-plus|fa-search-minus|fa-power-off|fa-signal|fa-cog|fa-trash-o|fa-home|fa-file-o|fa-clock-o|fa-road|fa-download|fa-arrow-circle-o-down|fa-arrow-circle-o-up|fa-inbox|fa-play-circle-o|fa-repeat|fa-refresh|fa-list-alt|fa-lock|fa-flag|fa-headphones|fa-volume-off|fa-volume-down|fa-volume-up|fa-qrcode|fa-barcode|fa-tag|fa-tags|fa-book|fa-bookmark|fa-print|fa-camera|fa-font|fa-bold|fa-italic|fa-text-height|fa-text-width|fa-align-left|fa-align-center|fa-align-right|fa-align-justify|fa-list|fa-outdent|fa-indent|fa-video-camera|fa-picture-o|fa-pencil|fa-map-marker|fa-adjust|fa-tint|fa-pencil-square-o|fa-share-square-o|fa-check-square-o|fa-arrows|fa-step-backward|fa-fast-backward|fa-backward|fa-play|fa-pause|fa-stop|fa-forward|fa-fast-forward|fa-step-forward|fa-eject|fa-chevron-left|fa-chevron-right|fa-plus-circle|fa-minus-circle|fa-times-circle|fa-check-circle|fa-question-circle|fa-info-circle|fa-crosshairs|fa-times-circle-o|fa-check-circle-o|fa-ban|fa-arrow-left|fa-arrow-right|fa-arrow-up|fa-arrow-down|fa-share|fa-expand|fa-compress|fa-plus|fa-minus|fa-asterisk|fa-exclamation-circle|fa-gift|fa-leaf|fa-fire|fa-eye|fa-eye-slash|fa-exclamation-triangle|fa-plane|fa-calendar|fa-random|fa-comment|fa-magnet|fa-chevron-up|fa-chevron-down|fa-retweet|fa-shopping-cart|fa-folder|fa-folder-open|fa-arrows-v|fa-arrows-h|fa-bar-chart|fa-twitter-square|fa-facebook-square|fa-camera-retro|fa-key|fa-cogs|fa-comments|fa-thumbs-o-up|fa-thumbs-o-down|fa-star-half|fa-heart-o|fa-sign-out|fa-linkedin-square|fa-thumb-tack|fa-external-link|fa-sign-in|fa-trophy|fa-github-square|fa-upload|fa-lemon-o|fa-phone|fa-square-o|fa-bookmark-o|fa-phone-square|fa-twitter|fa-facebook|fa-github|fa-unlock|fa-credit-card|fa-rss|fa-hdd-o|fa-bullhorn|fa-bell|fa-certificate|fa-hand-o-right|fa-hand-o-left|fa-hand-o-up|fa-hand-o-down|fa-arrow-circle-left|fa-arrow-circle-right|fa-arrow-circle-up|fa-arrow-circle-down|fa-globe|fa-wrench|fa-tasks|fa-filter|fa-briefcase|fa-arrows-alt|fa-users|fa-link|fa-cloud|fa-flask|fa-scissors|fa-files-o|fa-paperclip|fa-floppy-o|fa-square|fa-bars|fa-list-ul|fa-list-ol|fa-strikethrough|fa-underline|fa-table|fa-magic|fa-truck|fa-pinterest|fa-pinterest-square|fa-google-plus-square|fa-google-plus|fa-money|fa-caret-down|fa-caret-up|fa-caret-left|fa-caret-right|fa-columns|fa-sort|fa-sort-desc|fa-sort-asc|fa-envelope|fa-linkedin|fa-undo|fa-gavel|fa-tachometer|fa-comment-o|fa-comments-o|fa-bolt|fa-sitemap|fa-umbrella|fa-clipboard|fa-lightbulb-o|fa-exchange|fa-cloud-download|fa-cloud-upload|fa-user-md|fa-stethoscope|fa-suitcase|fa-bell-o|fa-coffee|fa-cutlery|fa-file-text-o|fa-building-o|fa-hospital-o|fa-ambulance|fa-medkit|fa-fighter-jet|fa-beer|fa-h-square|fa-plus-square|fa-angle-double-left|fa-angle-double-right|fa-angle-double-up|fa-angle-double-down|fa-angle-left|fa-angle-right|fa-angle-up|fa-angle-down|fa-desktop|fa-laptop|fa-tablet|fa-mobile|fa-circle-o|fa-quote-left|fa-quote-right|fa-spinner|fa-circle|fa-reply|fa-github-alt|fa-folder-o|fa-folder-open-o|fa-smile-o|fa-frown-o|fa-meh-o|fa-gamepad|fa-keyboard-o|fa-flag-o|fa-flag-checkered|fa-terminal|fa-code|fa-reply-all|fa-star-half-o|fa-location-arrow|fa-crop|fa-code-fork|fa-chain-broken|fa-question|fa-info|fa-exclamation|fa-superscript|fa-subscript|fa-eraser|fa-puzzle-piece|fa-microphone|fa-microphone-slash|fa-shield|fa-calendar-o|fa-fire-extinguisher|fa-rocket|fa-maxcdn|fa-chevron-circle-left|fa-chevron-circle-right|fa-chevron-circle-up|fa-chevron-circle-down|fa-html5|fa-css3|fa-anchor|fa-unlock-alt|fa-bullseye|fa-ellipsis-h|fa-ellipsis-v|fa-rss-square|fa-play-circle|fa-ticket|fa-minus-square|fa-minus-square-o|fa-level-up|fa-level-down|fa-check-square|fa-pencil-square|fa-external-link-square|fa-share-square|fa-compass|fa-caret-square-o-down|fa-caret-square-o-up|fa-caret-square-o-right|fa-eur|fa-gbp|fa-usd|fa-inr|fa-jpy|fa-rub|fa-krw|fa-btc|fa-file|fa-file-text|fa-sort-alpha-asc|fa-sort-alpha-desc|fa-sort-amount-asc|fa-sort-amount-desc|fa-sort-numeric-asc|fa-sort-numeric-desc|fa-thumbs-up|fa-thumbs-down|fa-youtube-square|fa-youtube|fa-xing|fa-xing-square|fa-youtube-play|fa-dropbox|fa-stack-overflow|fa-instagram|fa-flickr|fa-adn|fa-bitbucket|fa-bitbucket-square|fa-tumblr|fa-tumblr-square|fa-long-arrow-down|fa-long-arrow-up|fa-long-arrow-left|fa-long-arrow-right|fa-apple|fa-windows|fa-android|fa-linux|fa-dribbble|fa-skype|fa-foursquare|fa-trello|fa-female|fa-male|fa-gratipay|fa-sun-o|fa-moon-o|fa-archive|fa-bug|fa-vk|fa-weibo|fa-renren|fa-pagelines|fa-stack-exchange|fa-arrow-circle-o-right|fa-arrow-circle-o-left|fa-caret-square-o-left|fa-dot-circle-o|fa-wheelchair|fa-vimeo-square|fa-try|fa-plus-square-o|fa-space-shuttle|fa-slack|fa-envelope-square|fa-wordpress|fa-openid|fa-university|fa-graduation-cap|fa-yahoo|fa-google|fa-reddit|fa-reddit-square|fa-stumbleupon-circle|fa-stumbleupon|fa-delicious|fa-digg|fa-pied-piper-pp|fa-pied-piper-alt|fa-drupal|fa-joomla|fa-language|fa-fax|fa-building|fa-child|fa-paw|fa-spoon|fa-cube|fa-cubes|fa-behance|fa-behance-square|fa-steam|fa-steam-square|fa-recycle|fa-car|fa-taxi|fa-tree|fa-spotify|fa-deviantart|fa-soundcloud|fa-database|fa-file-pdf-o|fa-file-word-o|fa-file-excel-o|fa-file-powerpoint-o|fa-file-image-o|fa-file-archive-o|fa-file-audio-o|fa-file-video-o|fa-file-code-o|fa-vine|fa-codepen|fa-jsfiddle|fa-life-ring|fa-circle-o-notch|fa-rebel|fa-empire|fa-git-square|fa-git|fa-hacker-news|fa-tencent-weibo|fa-qq|fa-weixin|fa-paper-plane|fa-paper-plane-o|fa-history|fa-circle-thin|fa-header|fa-paragraph|fa-sliders|fa-share-alt|fa-share-alt-square|fa-bomb|fa-futbol-o|fa-tty|fa-binoculars|fa-plug|fa-slideshare|fa-twitch|fa-yelp|fa-newspaper-o|fa-wifi|fa-calculator|fa-paypal|fa-google-wallet|fa-cc-visa|fa-cc-mastercard|fa-cc-discover|fa-cc-amex|fa-cc-paypal|fa-cc-stripe|fa-bell-slash|fa-bell-slash-o|fa-trash|fa-copyright|fa-at|fa-eyedropper|fa-paint-brush|fa-birthday-cake|fa-area-chart|fa-pie-chart|fa-line-chart|fa-lastfm|fa-lastfm-square|fa-toggle-off|fa-toggle-on|fa-bicycle|fa-bus|fa-ioxhost|fa-angellist|fa-cc|fa-ils|fa-meanpath|fa-buysellads|fa-connectdevelop|fa-dashcube|fa-forumbee|fa-leanpub|fa-sellsy|fa-shirtsinbulk|fa-simplybuilt|fa-skyatlas|fa-cart-plus|fa-cart-arrow-down|fa-diamond|fa-ship|fa-user-secret|fa-motorcycle|fa-street-view|fa-heartbeat|fa-venus|fa-mars|fa-mercury|fa-transgender|fa-transgender-alt|fa-venus-double|fa-mars-double|fa-venus-mars|fa-mars-stroke|fa-mars-stroke-v|fa-mars-stroke-h|fa-neuter|fa-genderless|fa-facebook-official|fa-pinterest-p|fa-whatsapp|fa-server|fa-user-plus|fa-user-times|fa-bed|fa-viacoin|fa-train|fa-subway|fa-medium|fa-y-combinator|fa-optin-monster|fa-opencart|fa-expeditedssl|fa-battery-full|fa-battery-three-quarters|fa-battery-half|fa-battery-quarter|fa-battery-empty|fa-mouse-pointer|fa-i-cursor|fa-object-group|fa-object-ungroup|fa-sticky-note|fa-sticky-note-o|fa-cc-jcb|fa-cc-diners-club|fa-clone|fa-balance-scale|fa-hourglass-o|fa-hourglass-start|fa-hourglass-half|fa-hourglass-end|fa-hourglass|fa-hand-rock-o|fa-hand-paper-o|fa-hand-scissors-o|fa-hand-lizard-o|fa-hand-spock-o|fa-hand-pointer-o|fa-hand-peace-o|fa-trademark|fa-registered|fa-creative-commons|fa-gg|fa-gg-circle|fa-tripadvisor|fa-odnoklassniki|fa-odnoklassniki-square|fa-get-pocket|fa-wikipedia-w|fa-safari|fa-chrome|fa-firefox|fa-opera|fa-internet-explorer|fa-television|fa-contao|fa-500px|fa-amazon|fa-calendar-plus-o|fa-calendar-minus-o|fa-calendar-times-o|fa-calendar-check-o|fa-industry|fa-map-pin|fa-map-signs|fa-map-o|fa-map|fa-commenting|fa-commenting-o|fa-houzz|fa-vimeo|fa-black-tie|fa-fonticons|fa-reddit-alien|fa-edge|fa-credit-card-alt|fa-codiepie|fa-modx|fa-fort-awesome|fa-usb|fa-product-hunt|fa-mixcloud|fa-scribd|fa-pause-circle|fa-pause-circle-o|fa-stop-circle|fa-stop-circle-o|fa-shopping-bag|fa-shopping-basket|fa-hashtag|fa-bluetooth|fa-bluetooth-b|fa-percent|fa-gitlab|fa-wpbeginner|fa-wpforms|fa-envira|fa-universal-access|fa-wheelchair-alt|fa-question-circle-o|fa-blind|fa-audio-description|fa-volume-control-phone|fa-braille|fa-assistive-listening-systems|fa-american-sign-language-interpreting|fa-deaf|fa-glide|fa-glide-g|fa-sign-language|fa-low-vision|fa-viadeo|fa-viadeo-square|fa-snapchat|fa-snapchat-ghost|fa-snapchat-square|fa-pied-piper|fa-first-order|fa-yoast|fa-themeisle|fa-google-plus-official|fa-font-awesome|fa-handshake-o|fa-envelope-open|fa-envelope-open-o|fa-linode|fa-address-book|fa-address-book-o|fa-address-card|fa-address-card-o|fa-user-circle|fa-user-circle-o|fa-user-o|fa-id-badge|fa-id-card|fa-id-card-o|fa-quora|fa-free-code-camp|fa-telegram|fa-thermometer-full|fa-thermometer-three-quarters|fa-thermometer-half|fa-thermometer-quarter|fa-thermometer-empty|fa-shower|fa-bath|fa-podcast|fa-window-maximize|fa-window-minimize|fa-window-restore|fa-window-close|fa-window-close-o|fa-bandcamp|fa-grav|fa-etsy|fa-imdb|fa-ravelry|fa-eercast|fa-microchip|fa-snowflake-o|fa-superpowers|fa-wpexplorer|fa-meetup',

					),
				),

			)
		)
	);
}
add_action( 'customize_controls_enqueue_scripts', 'onepress_customize_controls_enqueue_scripts' );
