<?php
$tools = get_field('tools');
if( $tools ): ?>
	<div class="fmc_tools">
		<h4 class="fmc_tools_title">Tools</h4>
    <?php foreach( $tools as $post ): ?>
        <?php // Setup this post for WP functions (variable must be named $post).
        setup_postdata($post); ?>
            <a href="<?php the_field('tool_link'); ?>" target="_blank">
           	<?php
			$icon = get_field('icon');
			$size = 'full';
			if( $icon ) {
				echo wp_get_attachment_image( $icon, $size, "", array( "class" => "icon" ) );
			} ?>
			<?php the_title(); ?>
			</a>
    <?php endforeach; ?>
    <?php
    // Reset the global post object so that the rest of the page works correctly.
    wp_reset_postdata(); ?>
	</div>
<?php endif; ?>
