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
	<?php the_field('body_top_script', 'option'); ?> <!-- Head External Code -->
	<?php wp_head(); ?>
	<meta name="theme-color" content="#EAECF0" />
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php the_field('head_script', 'option'); ?> <!-- Body Top External Code -->
<div id="main-content" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'fmc' ); ?></a>
	<div class="fmc_mobile_header">
		<figure class="fmc_mobile_logo">
			<?php the_custom_logo(); ?>
		</figure>
		<?php
		$search_link = get_field('search_link', 'option');
		if( $search_link ): ?>
			<div class="search_icon">
				<a href="<?php echo esc_url( $search_link ); ?>">
					<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M16.5 16.5L11.5 11.5M13.1667 7.33333C13.1667 10.555 10.555 13.1667 7.33333 13.1667C4.11167 13.1667 1.5 10.555 1.5 7.33333C1.5 4.11167 4.11167 1.5 7.33333 1.5C10.555 1.5 13.1667 4.11167 13.1667 7.33333Z" stroke="#344054" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
				</a>
			</div>
		<?php endif; ?>
		<div class="fmc_mm_trigger">
		<div></div>
		</div>
	</div>
	<div class="fmc_full_screen_search">
		<div class="fmc_full_screen_close">CLOSE</div>
		<div class="fmc_fss_inner">
			<?php echo do_shortcode('[wpdreams_ajaxsearchpro id=1]'); ?>
			<div class="fmc_search_cats">
			<?php // Get the taxonomy's terms
			$terms = get_terms(
				array(
					'taxonomy'   => 'recipe-category',
					'hide_empty' => true,
					'exclude' => '59'
				)
			);

			// Check if any term exists
			if ( ! empty( $terms ) && is_array( $terms ) ) :
				// Run a loop and print them all

				foreach ( $terms as $term ) : ?>
				<figure>
				<?php
				$cat_icon = get_field('category_icon', $term);
				$size = 'full'; ?>
				<a href="<?php echo esc_url( get_term_link( $term ) ) ?>">
					<?php if( $cat_icon ) {
						echo wp_get_attachment_image( $cat_icon, $size, "", array( "class" => "cat_icon" ) );
					} ?>
					<figcaption><?php echo $term->name; ?></figcaption>
				</a>
				</figure>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
		</div>
	</div>
	<div class="fmc_sitehead">
	<header class="fmc_header">
		<figure class="fmc_mobile_logo">
			<?php the_custom_logo(); ?>
		</figure>
		<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'menu_id'        => 'primary'
				)
			);
		?>

		<div class="fmc_header_right">
			<div class="fmc_search_container">

				<?php echo do_shortcode('[wpdreams_ajaxsearchpro id=1]'); ?>
				<div class="search_icon">
					<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M16.5 16.5L11.5 11.5M13.1667 7.33333C13.1667 10.555 10.555 13.1667 7.33333 13.1667C4.11167 13.1667 1.5 10.555 1.5 7.33333C1.5 4.11167 4.11167 1.5 7.33333 1.5C10.555 1.5 13.1667 4.11167 13.1667 7.33333Z" stroke="#344054" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
				</div>
				<div class="search_icon2">
					<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M16.5 16.5L11.5 11.5M13.1667 7.33333C13.1667 10.555 10.555 13.1667 7.33333 13.1667C4.11167 13.1667 1.5 10.555 1.5 7.33333C1.5 4.11167 4.11167 1.5 7.33333 1.5C10.555 1.5 13.1667 4.11167 13.1667 7.33333Z" stroke="#344054" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
				</div>
			</div>
			<?php
			$order_link = get_field('order_link', 'option');
			if( $order_link ):
				$order_link_url = $order_link['url'];
				$order_link_title = $order_link['title'];
				$order_link_target = $order_link['target'] ? $order_link['target'] : '_self';
				?>
				<a class="fmc_btn" href="<?php echo esc_url( $order_link_url ); ?>" target="<?php echo esc_attr( $order_link_target ); ?>"><?php echo esc_html( $order_link_title ); ?></a>
			<?php endif; ?>
		</div>
	</header>
	</div>
