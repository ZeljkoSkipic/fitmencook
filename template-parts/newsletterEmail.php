<?php
$post_url = isset($args['post_url']) ? $args['post_url'] : "";
?>

<table>
    <tr>
        <td><?php printf(__('Thank you for subscribing! By clicking on the <a href=%s><strong>link</strong></a>, you can visit the post from which you subscribed. ', 'fitmencook'), $post_url); ?></td>
    </tr>
</table>
