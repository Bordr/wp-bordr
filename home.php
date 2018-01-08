<?php
/**
 * The template for displaying archive pages.
 * orginally -> archive-activity.php
 */

get_header(); ?>

<?php if (!is_user_logged_in()) { ?>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-lg-12" style="text-align:right;">
		<p>
		<a href="/join/" class="btn btn-primary start">Join</a>
		<a href="/wp-login.php" class="btn btn-primary start">Login</a>
		</p>
	</div>
</div>
<?php } ?>

<div class="row">
	<style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style><div class='embed-container'><iframe src='http://player.vimeo.com/video/200638965' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
</div>

<div class="row">
	<main id="content" class="col-sm-12 content-area" role="main">
	<article class="page" style="margin-bottom:0px;" >
		<div class="row intro-container">
				<span class="intro-text text-center">
					<p>Global Grand Central is an open platform and living
                        archives for learning and exchange between artistic,
                        social and cultural activists worldwide.
					</p>
					<p>We build an evolving platform to ease experience sharing,
                        and mutual learning.</p>
				</span>
			</div>
		</article>
</div>

<div class="page-teaser">
	<div class="row section-head">
		<div class="col-xs-12 col-sm-9 col-lg-9">
			<h1 class="entry-title" style="font-size:24px;">Activities</h1>
			<p>Activities are descriptions of projects, actions, and interventions.</p>
		</div>
		<div class="col-xs-12 col-sm-12 col-lg-12" style="text-align:right;" >
			<?php if (is_user_logged_in()) : ?>
				<a href="/add-activity" class="btn btn-primary start" style="margin-top:1.5em;">Add Activity</a>
			<?php else : ?>
				<a href="/join/" class="btn btn-primary start" style="margin-top:1.5em;">Join to Add an Activity</a>
			<?php endif; ?>
		</div>
	</div>


	<div class="row">

		<!-- carousel for small screens -->
		<?php
			$activities_query = new WP_Query( array(
				'post_type' => 'activity',
				'posts_per_page' => '3',
				'meta_key' => 'featured',
				'meta_value' => 'yes',
			));
		?>

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
		<?php
			$activities_query = new WP_Query( array(
				'post_type' => 'activity',
				'posts_per_page' => '3',
				'meta_key' => 'featured',
				'meta_value' => 'yes',
			));
		?>

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

<?php get_footer(); ?>
