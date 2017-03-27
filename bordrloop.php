<?php
/**
 * @package Bordr
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
				<?php if (isset($cat_title)) : ?><p class="lead"><?php echo $cat_title; ?></p><?php else: ?>
				<p>A story from <em><a href='/activity/<?php echo get_post($related_activity)->post_name; ?>/'><?php echo get_post($related_activity)->post_title; ?></em></a>
				<?php endif; ?>
			<!-- .entry-meta --></div>
			<?php endif; ?>
		</div>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark" class="story-title">
		<header class="entry-header story-header">
			<?php the_field('brdr_from'); ?>
		<!-- .entry-header --></header>
		<div class="down-arrow">
			<img class="arrow-img" src="/wp-content/themes/bordr/img/down-arrow.png" />
		</div>

		<div class="clearfix entry-summary">
			<div class="row story-preview">
					<?php
					  if($image) {
						 ?><img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>" class="img-responsive story-img"/><?php
					  }
					  else {
						?><img src="/wp-content/themes/bordr/img/ggc-default-img.png" class="img-responsive story-img"/><?php
					  }
					?>
					<div class="expand-story">Learn more...</div>
			</div>
		</div>
		<div class="up-arrow">
			<img class="arrow-img" src="/wp-content/themes/bordr/img/up-arrow.png" />
		</div>
		<header class="entry-header story-to">
			<?php the_field('brdr_to'); ?>
		<!-- .entry-header --></header>
		</a>

		<footer class="entry-meta">
				<?php edit_post_link( __( 'Edit', 'nuthemes' ), '<span class="edit-link">', '</span>' ); ?>
		<!-- .entry-footer --></footer>

	<!-- #post-<?php the_ID(); ?> --></article>
</div>
