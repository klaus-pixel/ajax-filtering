<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
<p><?php the_excerpt(); ?></p>
<?php 
    $postType = get_post_type_object(get_post_type($query->post_type));

    echo '<li><b>' . $postType->labels->singular_name . '</b></li>';