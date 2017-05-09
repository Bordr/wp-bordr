<?php
/*
Template Name: Search Page
*/

get_header(); ?>

	<div class="row">
		<main id="content" class="col-md-12 col-lg-12 col-md-offset-0 col-lg-offset-0 content-area" role="main">

			<div class="row">
			<?php while ( have_posts() ) : the_post(); ?>

				<div class="col-xs-12">
					<?php get_search_form(); ?>
				</div>

			<?php endwhile; ?>
			<!-- .row --></div>

		<!-- #content --></main>

		<?php get_sidebar(); ?>
	<!-- .row --></div>

<?php get_footer(); ?>
