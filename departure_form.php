<?php
/**
 * The Template for displaying departure form.
 *
 * Template Name: Departure Form
 */

acf_form_head(); ?>
<?php get_header(); ?>

	<div class="row">
		<main id="content" class="col-md-12 col-lg-12 col-md-offset-0 col-lg-offset-0 content-area" role="main">

			<div class="row">

				<div class="col-xs-12">
					<?php get_template_part( 'content', 'departureform' ); ?>
				</div>

			<!-- .row --></div>

		<!-- #content --></main>

	<!-- .row --></div>

<?php get_footer(); ?>