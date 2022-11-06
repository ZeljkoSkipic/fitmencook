<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package fitmencook
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="main-content" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'fmc' ); ?></a>
	<div class="fmc_sitehead">
	<header class="fmc_header">
		<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary-left',
					'menu_id'        => 'primary-left',
				)
			);
		?>
		<?php the_custom_logo(); ?>
		<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary-right',
					'menu_id'        => 'primary-right',
				)
			);
		?>
	</header>
	</div>
