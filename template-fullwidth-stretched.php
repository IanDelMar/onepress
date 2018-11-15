<?php
/**
 * Template Name: Full Width - Stretched Content
 *
 * The page template for displaying fluid full width pages.
 *
 * @link https://developer.wordpress.org/themes/template-files-section/page-template-files/
 *
 * @package OnePress\Page_Templates
 * @since 2.0.0
 */

get_header();

/** This action is documented in page.php */
do_action( 'onepress_page_before_content' );
?>
<div id="content" class="site-content">

	<?php onepress_breadcrumb(); ?>

	<div id="content-inside" class="no-sidebar">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

				<?php
				while ( have_posts() ) { // Start of the loop.
					the_post();
					get_template_part( 'template-parts/content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				} // End of the loop.
				?>

			</main><!-- #main -->
		</div><!-- #primary -->
	</div><!--#content-inside -->
</div><!-- #content -->

<?php get_footer(); ?>
