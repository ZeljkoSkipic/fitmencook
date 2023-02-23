<?php
/**
 * Template Name: Contact
 * Template Post Type: page
 */

get_header();
?>

	<main id="primary" class="site-main">
		<div class="img_bg">
			<?php the_post_thumbnail(); ?>
		</div>
		<?php the_content(); ?>

	</main><!-- #main -->

<?php
get_footer();
