<?php
/**
 * The template for displaying archive pages.
 * orginally -> archive-activity.php
 */

get_header(); ?>

<div class="row">
	<style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style><div class='embed-container'><iframe src='http://player.vimeo.com/video/200638965' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
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
	<div class="row section-head">
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

		<!-- carousel for small screens -->
		<?php $activities_query = new WP_Query( array( 'post_type' => 'activity', 'posts_per_page' => '6' )); ?>
		
		<?php if ( $activities_query->have_posts() ) : ?>

			<div id="activities-carousel" class="carousel slide" data-ride="carousel" data-interval="4000">
				<ol class="carousel-indicators">
					<li data-target="#activities-carousel" data-slide-to="0" class="active"></li>
					<li data-target="#activities-carousel" data-slide-to="1"></li>
					<li data-target="#activities-carousel" data-slide-to="2"></li>
				</ol>

				<div class="carousel-inner" role="listbox">
					<?php $i=0; ?>
					<?php while ( $activities_query->have_posts() ) : $activities_query->the_post(); ?>
						<?php
							if ( $i == 0 )
								$itemClass = "item active";
							else
								$itemClass = "item";
						?>
						<div id="activity-<?php echo $i; ?>" class="<?php echo $itemClass ?>" >
							<?php get_template_part( 'activityteaser', get_post_format() ); ?>
						</div>
						<?php $i++; ?>
					<?php endwhile; ?>
				</div>
			</div>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'archive' ); ?>

		<?php
			endif;
			wp_reset_postdata();
		?>

		<!-- more at once for bigger screens -->
		<?php $activities_query = new WP_Query( array( 'post_type' => 'activity', 'posts_per_page' => '6' )); ?>
		
		<?php if ( $activities_query->have_posts() ) : ?>

			<div id="masonry activities-masonry" class="row">
				<?php $i=0; ?>
				<?php while ( $activities_query->have_posts() ) : $activities_query->the_post(); ?>
					<div id="story-<?php echo $i; ?>" >
						<?php get_template_part( 'activityloop', get_post_format() ); ?>
					</div>
					<?php $i++; ?>
				<?php endwhile; ?>

			<!-- #masonry --></div>

			<?php nuthemes_content_nav( 'nav-below' ); ?>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'archive' ); ?>

		<?php endif; ?>

	</div><!-- .row -->
</div><!-- end actitivies teaser -->
<div class="see-all text-center">
	<a href="/activity">See more Activities...</a>
</div>

<div class="page-teaser"><!-- begin stories teaser -->
	<div class="row section-head">
		<div class="col-xs-12 col-sm-9 col-lg-9">
			<h1 class="entry-title" style="font-size:24px;">Bordr stories</h1>
			<p>Bordrs stories are impressions and experiences of a border.</p>
		</div>
		<div class="col-xs-12 col-sm-3 col-lg-3" style="text-align:right;" >
			<a href="/add-bordr-story/" class="btn btn-primary start">Add Bordr Story</a>
		</div>
	</div>

	<div class="row">
		<?php $stories_query = new WP_Query( array( 'post_type' => 'bordr', 'posts_per_page' => '6' )); ?>
		
		<?php if ( $stories_query->have_posts() ) : ?>

			<div id="stories-carousel" class="carousel slide" data-ride="carousel" data-interval="4000">
				<ol class="carousel-indicators">
					<li data-target="#stories-carousel" data-slide-to="0" class="active"></li>
					<li data-target="#stories-carousel" data-slide-to="1"></li>
					<li data-target="#stories-carousel" data-slide-to="2"></li>
				</ol>

				<div class="carousel-inner" role="listbox">
					<?php $i=0; ?>
					<?php while ( $stories_query->have_posts() ) : $stories_query->the_post(); ?>
						<?php
							if ( $i == 0 )
								$itemClass = "item active";
							else
								$itemClass = "item";
						?>
						<div id="story-<?php echo $i; ?>" class="<?php echo $itemClass ?>" >
							<?php get_template_part( 'bordrteaser', get_post_format() ); ?>
						</div>
						<?php $i++; ?>
					<?php endwhile; ?>
				</div>
			</div>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'archive' ); ?>

		<?php
			endif;
			wp_reset_postdata();
		?>

		<!-- more at once for bigger screens -->
		<?php $stories_query = new WP_Query( array( 'post_type' => 'bordr', 'posts_per_page' => '6' )); ?>
		
		<?php if ( $stories_query->have_posts() ) : ?>

			<div id="masonry" class="row">
				<?php $i=0; ?>
				<?php while ( $stories_query->have_posts() ) : $stories_query->the_post(); ?>
					<div id="story-<?php echo $i; ?>" >
						<?php get_template_part( 'bordrloop', get_post_format() ); ?>
					</div>
					<?php $i++; ?>
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

</div>
		<!-- #main --></div>

		<footer id="home-foot" class="site-footer" role="contentinfo">
			<div class="container">
				<div class="row">
					<div class="col-sm-4 col-md-4 site-info">
						<a href="http://ec.europa.eu/programmes/creative-europe/projects/ce-project-details-page/?nodeRef=workspace://SpacesStore/92784398-e6d7-4950-b1e4-3bcde44e03fe" target="_blank"><img src="/wp-content/uploads/2015/12/eu_flag_creative_europe_co_funded_pos_rgb_right.jpg" style="width:200px;"></a>
					<!-- .site-info --></div>
					<div class="col-sm-2 col-md-3 site-info">
						<i class="fa fa-paragraph" aria-hidden="true"></i> <a href="https://github.com/Bordr/bordr/wiki" target="_blank">Help build our forms</a><br/>
						<i class="fa fa-github" aria-hidden="true"></i> <a href="https://github.com/Bordr/bordr" target="_blank">Help code this site</a>
					<!-- .site-credit --></div>
					<div class="col-sm-2 col-md-2 site-info">
						<a href="/terms-of-service/" target="_blank">Terms of Service</a><br/>
						<a href="/privacy-policy/" target="_blank">Privacy Policy</a><br/>
					<!-- .site-info --></div>
					<div class="col-sm-4 col-md-3">
						Global Grand Central, 2017<br/>
						<i class="fa fa-creative-commons" aria-hidden="true"></i> <a href="https://creativecommons.org/licenses/by-sa/4.0/" target="_blank">Attribution-ShareAlike License</a><br/>
					<!-- .site-info --></div>
				</div>
			</div>
		<!-- #footer --></footer>

		<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/bordr.js"></script>
		<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.flexslider.js"></script>

		<?php wp_footer(); ?>
	
		<?php
		acf_enqueue_uploader();
		?>

	<?php
		if(file_exists(stream_resolve_include_path('analytics.php'))) {
    		include 'analytics.php';
    	}
	?>

	</body>
</html>