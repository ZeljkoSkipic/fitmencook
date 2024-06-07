<?php
$tools = get_field('tools');
if( $tools ): ?>
	<div class="fmc_tools">
		<h4 class="fmc_tools_title"><?php echo wp_kses_post( get_field('tools_title', 'option') ); ?></h4>

		<em><?php echo wp_kses_post( get_field('tools_intro', 'option') ); ?></em>
		<div class="tools_inner">
			<?php foreach( $tools as $post ): ?>
				<?php // Setup this post for WP functions (variable must be named $post).
				setup_postdata($post); ?>
					<a href="<?php echo wp_kses_post( get_field('tool_link') ); ?>" target="_blank">
					<?php
					$icon = get_field('icon');
					$size = 'full';
					if( $icon ) {
						echo wp_get_attachment_image( $icon, $size, "", array( "class" => "icon" ) );
					} ?>
					<?php the_title(); ?>
					</a>
			<?php endforeach; ?>
			</div>
    <?php
    // Reset the global post object so that the rest of the page works correctly.
    wp_reset_postdata(); ?>
	</div>
<?php endif; ?>
