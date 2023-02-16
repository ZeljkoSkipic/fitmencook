<?php

$class = 'fmc_hero fmc_container';
if ( ! empty( $block['className'] ) ) {
    $class .= ' ' . $block['className'];
}

?>


<div class="<?php echo $class; ?>">
	<?php
	$hero = get_field('left');
	if( $hero ): ?>
		<div class="fmc_hero_left">
			<h2 class="fmc_hero_prefix"><?php echo $hero['prefix']; ?></h2>
			<h1 class="fmc_hero_title spacing_0_2"><?php echo $hero['title']; ?></h1>
			<?php if($hero['subtitle']) { ?>
			<div class="fmc_hero_subtitle">
				<?php echo $hero['subtitle']; ?>
			</div>
			<?php } ?>
			<?php if( $hero['below_title'] == 'btn' ) { ?>
			<div class="fmc_app_badges">
			<?php if($hero['button']['url'] ) { ?>
				<a class="fmc_btn" href="<?php echo esc_url( $hero['button']['url'] ); ?>" target="_blank"><?php echo esc_html( $hero['button']['title'] ); ?></a>
			<?php } ?>
			<a class="fmc_hero_rating" href="<?php echo esc_url( $hero['amazon_link']['url'] ); ?>">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/amazon-rating.svg" alt="">
			</a>
			</div>
			<?php } ?>


			<?php if( $hero['below_title'] == 'app' ) { ?>
			<div class="fmc_app_badges">
				<h5><?php echo $hero['app_icons_prefix']; ?></h5>
				<?php get_template_part('template-parts/app-badges'); ?>
				<img class="fmc_hero_downloads" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/app-downloads.svg" alt="">
			</div>
			<?php } ?>
		</div>

	<?php endif; ?>
	<div class="fmc_hero_right">
		<?php
			$image = get_field('image');
			$size = 'full'; // (thumbnail, medium, large, full or custom size)
			if( $image ) {
				echo wp_get_attachment_image( $image, $size );
			} ?>
	</div>
</div>
