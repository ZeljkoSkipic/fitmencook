<?php

$remove_featured = get_field('remove_featured_image');


if( ($remove_featured == '0') ) { ?>
	<figure class="featured_image_top">
		<?php the_post_thumbnail(); ?>
	</figure>
<?php } ?>
