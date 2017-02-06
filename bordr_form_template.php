<?php
/**
 * The Template for displaying bordr story form.
 *
 * Template Name: Bordr Form
 */
function my_kses_post( $value ) {
	
	// is array
	if( is_array($value) ) {
	
		return array_map('my_kses_post', $value);
	
	}
	
	
	// return
	return wp_kses_post( $value );

}

add_filter('acf/update_value', 'my_kses_post', 10, 1);
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
									'return' => '/bordr/#GuestStoryAdded',
									'submit_value'		=> 'Add a bordr story'
								)); ?>

							<?php else : ?>

								<?php acf_form(array(
									'post_id'		=> 'new_post',
									'fields'		=> array(
										'field_57d820ae30eea',
										'field_57d820c230eeb', 
										'field_57d82e9f34b90',
										'field_57d82ee034b91',
										'field_57d82ff134b93',
										'field_57d8304334b94',
										'field_57d8306d34b95',
										'field_57d8310a34b97',
										'field_57d8319e34b98'
									), 
									'html_after_fields' => '<input type="hidden" name="acf[field_57d82e1934b8f]" value="697"/>',
									'new_post'		=> array(
										'post_type'		=> 'bordr',
										'post_status'		=> 'publish'
									),
									'uploader' => 'basic',
									'return' => '/bordr/#StoryAdded',
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