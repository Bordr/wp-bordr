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
              'new_post' => array(
                  'post_type'	=> 'activity',
                  'post_status' => 'publish',
              ),
              'uploader' => 'basic',
              'return' => '%post_url%',
              'submit_value' => 'Add activity',
          )); ?>
        <?php endif ; ?>
    </div>
  </main>
</div>

<script type="text/javascript">
  function toTitleCase(str) {
    return str.replace(/\w\S*/g, function(txt) {
      return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
    });
  }
  <?php /* Create headings in "How"-textarea when choosing methods */ ?>
  $('input[name^="acf[field_570d4d3b389ea]"]').change(function() {
    if($(this).is(':checked')) {
      tinymce.get($('textarea[name="acf[field_5702d2889ac48]"]').attr('id'))
             .execCommand('mceInsertContent', false, "<p><b>" + toTitleCase($(this).val()) + "</b></p><p></p>");
    }
  });
</script>

<?php get_footer(); ?>
