<?php

$title = get_field('logos_title');


$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

$class = 'fmc_logo_slide_block';
if ( ! empty( $block['className'] ) ) {
    $class .= ' ' . $block['className'];
}

?>
<div class="<?php echo $class; ?>">
<div class="fmc_container">
	<h4 class="title_spacing_1"><?php echo $title; ?></h4>
</div>
<?php if( have_rows('images') ): ?>
    <ul class="fmc_logo_slider">
    <?php while( have_rows('images') ): the_row();
        $image = get_sub_field('logo');
        ?>
        <li class="carousel-cell">
            <?php echo wp_get_attachment_image( $image, 'full' ); ?>
        </li>
    <?php endwhile; ?>
    </ul>
<?php endif; ?>
</div>
