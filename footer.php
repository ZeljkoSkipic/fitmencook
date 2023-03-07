<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package fitmencook
 */

?>

<footer class="fmc_footer spacing_2_0">
		<div class="fmc_footer_main">
			<div class="fmc_container spacing_1">
				<div class="fmc_footer_col">
					<?php dynamic_sidebar( 'footer-1' ); ?>
				</div>
				<div class="fmc_footer_col">
					<?php dynamic_sidebar( 'footer-2' ); ?>
				</div>
				<div class="fmc_footer_col">
					<?php dynamic_sidebar( 'footer-3' ); ?>
				</div>
				<div class="fmc_footer_col">
					<?php dynamic_sidebar( 'footer-4' ); ?>
				</div>
			</div>
		</div>
		<div class="fmc_copyright">
			<div class="fmc_container spacing_3">
				<?php dynamic_sidebar( 'copy' ); ?>
			</div>
		</div>

		</footer>
</div><!-- #main-content -->

<?php wp_footer(); ?>

</body>
</html>
