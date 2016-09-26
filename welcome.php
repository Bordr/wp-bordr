<?php
/**
 * Template Name: Welcome Front Page
 *
 */

get_header('fp'); 

$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );

?>


	<?php while ( have_posts() ) : the_post(); ?>

		<div class="row">
			<main id="content" class="col-sm-12 content-area" role="main" style="padding:0px;">		
			<article class="homebox page" style="margin-bottom:0px;" >
				<div class="row" style="margin: 0; background: linear-gradient(rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.3)), url('<?php echo $thumb['0'];?>'); background-repeat: no-repeat; background-size: cover; display: table; width: 100%; color: white;">
					<div class="col-xs-12 welcome">
						<h1 class="home-title" style="color:white;"><?php the_field('headline'); ?></h1>
						<p><?php the_field('call_to_action'); ?></p>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 home-lead">
						<?php the_content(); ?>
					</div>
				</div>
			</article>
	

			<!-- #content --></main>

		<!-- .row --></div>

	<?php endwhile; ?>

<?php get_footer('fp'); ?>
