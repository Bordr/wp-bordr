<?php
/**
 * @package Nu Themes
 */
 
$location = get_field('brdr_location');
$image = get_field('brdr_image');
$related_activity = get_field('related_activity');
 
?>
<div class="col-xs-12 col-sm-6 col-lg-4 masonry-item">
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'box' ); ?>>
		<div class="from-activity">
			<?php if ( 'bordr' == get_post_type() ) : ?>
			<div class="entry-meta">
				<p>A story from <a href='/activity/<?php echo get_post($related_activity)->post_name; ?>/'><?php echo get_post($related_activity)->post_title; ?></a>
			<!-- .entry-meta --></div>
			<?php endif; ?>
		</div>
		<header class="entry-header story-header">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark" class="story-title"><?php the_field('brdr_from'); ?></a>
		<!-- .entry-header --></header>
		<div class="down-arrow">
			<img class="arrow-img" src="/wp-content/themes/bordr/img/down-arrow.png" />
		</div>

		<div class="clearfix entry-summary">
			<div class="row story-preview">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
					<?php
					  if($image) {
						 ?><img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>" class="img-responsive story-img"/><?php 
					  }
					  else {
						?><img src="/wp-content/themes/bordr/img/ggc-default-img.png" class="img-responsive story-img"/><?php
					  }
					?>
					<div class="expand-story">Learn more...</div>
					</a>
			</div>
		</div>
		<div class="up-arrow">
			<img class="arrow-img" src="/wp-content/themes/bordr/img/up-arrow.png" />
		</div>
		<header class="entry-header story-to">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark" class="story-title"><?php the_field('brdr_to'); ?></a>
		<!-- .entry-header --></header>

		<footer class="entry-meta">
				<?php edit_post_link( __( 'Edit', 'nuthemes' ), '<span class="edit-link">', '</span>' ); ?>
		<!-- .entry-footer --></footer>

	<!-- #post-<?php the_ID(); ?> --></article>
</div>