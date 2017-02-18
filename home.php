<?php
/**
 * The template for displaying archive pages.
 * orginally -> archive-activity.php
 */

get_header(); ?>

<div class="row">
		<iframe src="https://player.vimeo.com/video/200638965" class="intro-video" width="960" height="540" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
</div>

<div class="row">
	<main id="content" class="col-sm-12 content-area" role="main">		
	<article class="page" style="margin-bottom:0px;" >
		<div class="row intro-container">
				<h1 class="entry-title text-center" style="font-size:24px;">
					Because all people cross borders.
				</h1>
				<span class="intro-text text-center">
					<p>Global Grand Central is a meeting place for organizations and individuals working to make the world a better place through inclusion, curiosity and empowerment.</p>
					<p>We provide an evolving platform to ease, connect and socialize sharing, reporting and mutual learning.</p>
				</span>
			</div>
		</article>
</div>

<div class="page-teaser">
	<div class="row">
		<div class="col-xs-12 col-sm-9 col-lg-9">
			<h1 class="entry-title" style="font-size:24px;">Activities</h1>
			<p>Activities are projects, actions, or interventions that explore borders and enable people to meet others.</p>
		</div>
		<div class="col-xs-12 col-sm-12 col-lg-12" style="text-align:right;" >
			<?php if (is_user_logged_in()) : ?>
				<a href="/add-activity" class="btn btn-primary start">Add Activity</a>
			<?php else : ?>
				<a href="/join/" class="btn btn-primary start">Join to Add an Activity</a>
			<?php endif; ?>
		</div>
	</div>


	<div class="row">	
		<?php $activities_query = new WP_Query( array( 'post_type' => 'activity' )); ?>
 

		
		<?php if ( $activities_query->have_posts() ) : ?>

				<div id="masonry" class="row">
				<?php while ( $activities_query->have_posts() ) : $activities_query->the_post(); ?>

						<?php get_template_part( 'activityloop', get_post_format() ); ?>

				<?php endwhile; ?>

			<!-- #masonry --></div>

			<?php nuthemes_content_nav( 'nav-below' ); ?>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'archive' ); ?>

		<?php
			endif;
			wp_reset_postdata();
		?>

	</div><!-- .row -->
</div><!-- end actitivies teaser -->
<div class="see-all text-center">
	<a href="/activity">See more Activities...</a>
</div>

<div class="page-teaser"><!-- begin stories teaser -->
	<div class="row">
		<div class="col-xs-12 col-sm-9 col-lg-9">
			<h1 class="entry-title" style="font-size:24px;">Bordr stories</h1>
			<p>Bordrs stories are impressions and experiences of a border.</p>
		</div>
		<div class="col-xs-12 col-sm-3 col-lg-3" style="text-align:right;" >
			<a href="/add-bordr-story/" class="btn btn-primary start">Add Bordr Story</a>
		</div>
	</div>
	<div class="row">	
		<?php $stories_query = new WP_Query( array( 'post_type' => 'bordr' )); ?>
		
		<?php if ( $stories_query->have_posts() ) : ?>

				<div id="masonry" class="row">
				<?php while ( $stories_query->have_posts() ) : $stories_query->the_post(); ?>

						<?php get_template_part( 'bordrloop', get_post_format() ); ?>

				<?php endwhile; ?>

			<!-- #masonry --></div>

			<?php nuthemes_content_nav( 'nav-below' ); ?>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'archive' ); ?>

		<?php endif; ?>

		

	</div><!-- .row -->
</div><!-- end stories teaser -->
<div class="see-all text-center">
	<a href="/bordr">See more Bordr Stories...</a>
</div>
</main><!-- #content -->

<?php get_footer(); ?>
