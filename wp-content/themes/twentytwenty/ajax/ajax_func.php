<?php

function load_filtering_scripts() {

    wp_enqueue_script('ajax', get_stylesheet_directory_uri().'/assets/js/filtering.js', 
    array('jquery'), false, true);

	wp_localize_script('ajax','wp_ajax',array('ajax_url' => admin_url('admin-ajax.php')) );
}
add_action('wp_enqueue_scripts', 'load_filtering_scripts');

function filter_cpt() {

	$cpt_name = $_POST['type'];
  
	$ajaxposts = new WP_Query([
	  'post_type' => $cpt_name,
       'post_status' => 'publish',
       'posts_per_page' => 10, 
       'orderby' => 'title',
       'order' => 'ASC',
	   'paged' => $_POST['paged'],

	]);
  
	if($ajaxposts->have_posts()) {
	  while($ajaxposts->have_posts()) : $ajaxposts->the_post(); 
	  get_template_part( 'template-parts/filter', 'posts' );
	  endwhile;
	} else {
	 
	}
  
	die();
  }
  
  add_action('wp_ajax_filter_cpt', 'filter_cpt');
  add_action('wp_ajax_nopriv_filter_cpt', 'filter_cpt');

  
  function load_more_cpt() {
	$ajaxposts = new WP_Query([
	  'post_type' => array('news', 'jobs', 'items'),
	  'posts_per_page' => 6,
	  'orderby' => 'date',
	  'order' => 'DESC',
	  'paged' => $_POST['paged'],
	]);
  
	if($ajaxposts->have_posts()) {
	  while($ajaxposts->have_posts()) : $ajaxposts->the_post();
		get_template_part( 'template-parts/filter', 'posts' );

	  endwhile;
	} else {
	}
  
	die();
  }
  add_action('wp_ajax_load_more_cpt', 'load_more_cpt');
  add_action('wp_ajax_nopriv_load_more_cpt', 'load_more_cpt');
  
