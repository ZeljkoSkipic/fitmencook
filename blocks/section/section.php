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
	$icon = get_sub_field('icon');
	$size = 'thumbnail';
	?>

	<div class="left spacing_2">
		<div class="fmc_sec_inner_content">
			<?php if( $icon ) { ?>
				<figure class="fmc_sec_icon">
				<?php echo wp_get_attachment_image( $icon, $size ); ?>
				</figure>
			<?php } ?>

			<h2 class="section_title fmc_title_2 spacing_0_3"><?php echo $title; ?></h2>
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
		</div>
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
