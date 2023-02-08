<?php

$title = get_field('title');
$image = get_field('image');
$size = 'full';
$text = get_field('text');


$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

$class = 'order';
if ( ! empty( $block['className'] ) ) {
    $class .= ' ' . $block['className'];
}

?>

<div class="fmc_post_order spacing_1_0">
	<h2><?php echo $title ?></h2>
	<?php
	if( $image ) {
		echo wp_get_attachment_image( $image, $size );
	} ?>
	<div class="fmc_po_content">
		<?php echo $text; ?>
	</div>
	<?php
	$link = get_field('post_button');
	if( $link ):
		$link_url = $link['url'];
		$link_title = $link['title'];
		$link_target = $link['target'] ? $link['target'] : '_self';
		?>
	<a class="fmc_btn" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
	<?php endif; ?>
</div>
