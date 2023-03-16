<div class="last_updated">
	<?php
	$u_time = get_the_time('U');
	$u_modified_time = get_the_modified_time('U');
	if ($u_modified_time >= $u_time + 86400) { ?>
		<time itemprop="dateModified" datetime="<?php the_modified_time('Y-m-d'); ?>">
			<span>Last Updated on:</span>
			<?php the_modified_time('F jS, Y'); ?>
		</time>
		<?php } else { ?>
		<time itemprop="datePublished" datetime="<?php the_time('Y-m-d'); ?>">
			<span>Published on:</span>
			<?php the_time('F jS, Y'); ?>
		</time>
		<?php } ?>
</div>
