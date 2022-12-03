<?php
$style = get_field_object('choose_style');
$layout = get_field_object('layout');
$stack = get_field_object('stack');

$margin = get_field_object('margin');
$padding = get_field_object('padding');

$class = 'fmc_section fmc_container';
if ( ! empty( $block['className'] ) ) {
    $class .= ' ' . $block['className'];
}

$sec_in_class = 'section_inner container';
if ( ! empty( $layout ) ) {
    $sec_in_class .=  ' ' . $layout['value'];
}
if ( ! empty( $stack ) ) {
    $sec_in_class .=  ' ' . $stack['value'];
}


?>


<div class="<?php echo $class ?>">
<div class="<?php echo $sec_in_class ?>">
<?php if( have_rows('info_box') ): ?>
<?php while( have_rows('info_box') ): the_row();
	$title = get_sub_field('title');
	$text = get_sub_field('text');
	$subtext = get_sub_field('subtext');
	?>

	<div class="left">
		<h2 class="section_title fmc_main_title"><?php echo $title; ?></h2>
		<div class="section_text"><?php echo $text ?></div>
		<?php
		$link = get_sub_field('button');
		if( $link ):
			$link_url = $link['url'];
			$link_title = $link['title'];
			$link_target = $link['target'] ? $link['target'] : '_self';
			?>
			<a class="fmc_btn" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
		<?php endif; ?>
			<?php
			if($subtext):  ?>
			<p class="sec_subtext"><?php echo $subtext; ?></p>
			<?php endif;
		// Check rows existexists.
		if( have_rows('socials') ): ?>
			<div class="sec_socials">
			<?php // Loop through rows.
			while( have_rows('socials') ) : the_row();

				$social_link = get_sub_field('social_link');
				$social_link_url = $social_link['url'];
				$social_link_target = $social_link['target'] ? $link['target'] : '_self';
				?>
				<a href="<?php echo esc_url( $social_link_url ); ?>" target="<?php echo esc_attr( $social_link_target ); ?>">
				<?php
				$social_image = get_sub_field('social_image');
				$size = 'full'; // (thumbnail, medium, large, full or custom size)
				if( $social_image ) {
					echo wp_get_attachment_image( $social_image, $size );
				} ?>
				</a>

			<?php // End loop.
			endwhile; ?>
			</div>
		<?php endif; ?>
	</div>

<?php endwhile; ?>
<?php endif; ?>
<div class="right">
	<?php
	$image = get_field('media');
	$size = 'full'; // (thumbnail, medium, large, full or custom size)
	if( $image ) {
		echo wp_get_attachment_image( $image, $size );
	} ?>

	</div>
</div>
</div>
