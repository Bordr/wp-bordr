<?php
/**
 * The Template for displaying departure form.
 *
 * Template Name: Bordr Form
 */

acf_form_head(); ?>
<?php get_header(); ?>

	<div class="row">
		<main id="content">

			<div class="row">

				<div class="col-xs-12">

					<h2 style="padding-left:10px;"><?php the_title(); ?></h2>
					<p><?php the_content(); ?></p>

							<?php /* The loop */ ?>

							<?php if (is_user_logged_in()) : ?>

								<?php acf_form(array(
									'post_id'		=> 'new_post',
									'new_post'		=> array(
										'post_type'		=> 'bordr',
										'post_status'		=> 'publish'
									),
									'uploader' => 'basic',
									'return' => '/bordr/',
									'submit_value'		=> 'Add a bordr story'
								)); ?>

							<?php else : ?>

								<?php acf_form(array(
									'post_id'		=> 'new_post',
									'fields'		=> array(
										'brdr_from',
										'brdr_to', 
										'brdr_story',
										'brdr_image',
										'brdr_invisible_visible',
										'brdr_unimportant_important',
										'brdr_negative_positive',
										'brdr_location',
										'brdr_cc'
									), 
									'html_after_fields' => '<input type="hidden" name="acf[field_57d82e1934b8f]" value="697"/>',
									'new_post'		=> array(
										'post_type'		=> 'bordr',
										'post_status'		=> 'publish'
									),
									'uploader' => 'basic',
									'return' => '/bordr/',
									'submit_value'		=> 'Add a bordr story'
								)); ?>

							<?php endif ; ?>
				</div>

			<!-- .row --></div>

		<!-- #content --></main>

	<!-- .row --></div>

<script type="text/javascript">
(function($) {
	
	// setup fields
	acf.do_action('append', $('#popup-id'));
	
})(jQuery);	
</script>

<?php
acf_enqueue_uploader();
?>

<?php get_footer(); ?>