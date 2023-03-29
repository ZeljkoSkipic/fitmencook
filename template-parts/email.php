<?php
$post_type_obj = get_post_type_object( get_post_type() );
?>

Hello,<br>

English FitMenCook website has a new <?php echo $post_type_obj->labels->singular_name; ?> published.<br>
<?php echo $post_type_obj->labels->singular_name; ?>: <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br><br>

<a href="<?php echo get_admin_url(null, 'post-new.php') . '?post_type='. get_post_type();?>">Click here to add a new Spanish <?php echo $post_type_obj->labels->singular_name;  ?>.</a>
