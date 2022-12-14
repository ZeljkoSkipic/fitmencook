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

	<meta name="smartbanner:title" content="FitMenCook - Healthy Recipes">
	<meta name="smartbanner:author" content="Nibble Apps">
	<meta name="smartbanner:price" content="$3.99">
	<meta name="smartbanner:price-suffix-apple" content=" - On the App Store">
	<meta name="smartbanner:price-suffix-google" content=" - In Google Play">
	<meta name="smartbanner:icon-apple" content="http://is3.mzstatic.com/image/thumb/Purple117/v4/5b/7a/f9/5b7af9d5-d144-5137-e040-4b6271d7ad7f/source/350x350bb.jpg">
	<meta name="smartbanner:icon-google" content="https://lh3.googleusercontent.com/FUPpZl9_iHHTpIZsjt1WCDr7oKs6QcojoLUkAg5vLTuqGxr5D49BuYkSgS6W9CI2EA=w300">
	<meta name="smartbanner:button" content="View">
	<meta name="smartbanner:button-url-apple" content="https://itunes.apple.com/app/id980368562?at=10l5Lv&ct=fmc-top-lnk">
	<meta name="smartbanner:button-url-google" content="https://play.google.com/store/apps/details?id=com.nibbleapps.fitmencook">
	<meta name="smartbanner:enabled-platforms" content="android,ios">
	<meta name="p:domain_verify" content="630d33d666a4140aa5b91ccdf37cb378"/>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="main-content" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'fmc' ); ?></a>
	<div class="fmc_mobile_header">
		<figure class="fmc_mobile_logo">
			<a href="/">
				<?php
				$mobile_logo = get_field('mobile_logo', 'option');
				$size = 'full'; // (thumbnail, medium, large, full or custom size)
				if( $mobile_logo ) {
					echo wp_get_attachment_image( $mobile_logo, $size );
				} else {
					the_custom_logo();
				}
				?>
			</a>
		</figure>
		<div class="fmc_mm_trigger">
		<div></div>
		</div>
	</div>
	<div class="fmc_sitehead">
	<header class="fmc_header">
	<figure class="fmc_mobile_logo">
			<a href="/">
				<?php
				$mobile_logo = get_field('mobile_logo', 'option');
				$size = 'full'; // (thumbnail, medium, large, full or custom size)
				if( $mobile_logo ) {
					echo wp_get_attachment_image( $mobile_logo, $size );
				} else {
					the_custom_logo();
				}
				?>
			</a>
		</figure>
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
