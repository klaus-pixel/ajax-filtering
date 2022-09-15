<?php

/*Template Name: CPT*/

get_header(); ?>

<div class="post_types">
<ul>
    <li class="post_type_item active"><a href="<?= home_url('/cpt')?>">ALL</a></li>
<?php
$cpt_args = [
    'public'   => true,
    '_builtin' => false,
];

$type_slugs = array_map( function( $type ) {
    return $type->slug;
},
 $post_types=get_post_types( $cpt_args, 'objects' ) );
foreach($post_types as $post_type) : ?>
        <li><a class="post_type_item" href="#!" data-type="<?= $post_type->name?>"><?= $post_type->name ?></a></li>
  <?php   
endforeach;
?>
</ul>
</div>

<?php

$args = array(
       'post_type' => array('news', 'jobs', 'items'),
       'post_status' => 'publish',
       'posts_per_page' => 10, 
       'orderby' => 'title',
       'order' => 'ASC',
       'paged' => 1,
    );

    $query = new WP_Query( $args );
    // var_dump($query);
if($query->have_posts()) : ?>
 <ul class="post-titles"> 
    <?php
    while($query->have_posts()) : $query->the_post(); 

    include('template-parts/filter-posts.php');

    endwhile;
endif;
?>
</ul>
<?php wp_reset_postdata(); ?>

<div class="btn__wrapper">
  <a href="#!" class="btn btn__primary" id="load-more">Load more</a>
</div>

<?php
  get_footer();
?>

