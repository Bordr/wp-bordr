<?php
/**
 * The Template for displaying all single posts.
 *
 * Template Name Posts: View Departure
 */

get_header(); ?>

	<div class="row">
		<main id="content" class="col-md-12 col-lg-12 content-area" role="main">

			<div class="row">
			<?php while ( have_posts() ) : the_post(); ?>

				<div class="col-xs-12">
					<?php get_template_part( 'content', 'activity' ); ?>
				</div>

			<?php endwhile; ?>
			<!-- .row --></div>

		<!-- #content --></main>

		<?php get_sidebar(); ?>
	<!-- .row --></div>

<?php get_footer(); ?>