<?php
/**
 * Template Name: Activity form
 */

get_header();

?>

<div class="row">
  <main id="content">
	<div class="row">
      <?php the_content(); ?>

	  <div class="col-xs-12">
        <?php if(current_user_can('publish_posts', the_post())) : ?>
          <?php acf_form(array(
              'post_id' => 'new_post',
              'post_title' => true,
              'new_post' => array(
                  'post_type'	=> 'activity',
                  'post_status' => 'publish',
              ),
              'uploader' => 'basic',
              'return' => '/',
              'submit_value' => 'Add an activity'
          )); ?>
        <?php endif ; ?>
    </div>
  </main>
</div>

<?php get_footer(); ?>
