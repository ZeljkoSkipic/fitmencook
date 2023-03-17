<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package fitmencook
 */

get_header();
?>

	<main id="primary" class="site-main">

		<section class="error-404 not-found">
			<header class="page-header">
				<h1 class="page-title"></h1>
			</header><!-- .page-header -->

			<div class="page-content">
					<div class="fmc_container">
						<div class="left_404 spacing_1">
							<?php the_custom_logo(); ?>
							<h1 class="spacing_0_3"><?php the_field('title_404', 'option'); ?></h1>
							<div class="message_404"><?php the_field('message_404', 'option'); ?></div>
						<h5 class="fmc_title_3"><?php the_field('menu_title_404', 'option'); ?></h5>
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'menu_404',
								'menu_id'        => '404'
							)
						);
					?>
						</div>
						<div class="right_404">
						<?php
						$image_404 = get_field('image_404', 'option');
						$size = 'full'; // (thumbnail, medium, large, full or custom size)
						if( $image_404 ) {
							echo wp_get_attachment_image( $image_404, $size );
						} ?>
						</div>
					</div>
			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
