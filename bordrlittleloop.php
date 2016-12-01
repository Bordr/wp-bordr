<?php
/**
 * @package Nu Themes
 */
 
$location = get_field('brdr_location');
$image = get_field('brdr_image');
$related_activity = get_field('related_activity');
 
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'box' ); ?>>

	<div class="clearfix entry-summary">
		<div class="row">
			<div class="col-xs-12">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
				<?php
				  if($image) {
					 ?><img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>" class="img-responsive"/><?php 
				  } else {
					 ?><img src="/wp-content/uploads/2016/12/egc_bg-cremesoda_400x300.png" class="img-responsive"><?php
				  }
				?>
				<?php the_field('brdr_from'); ?> &raquo; <?php the_field('brdr_to'); ?>
				</a>
			</div>
		</div>
	</div>

<!-- #post-<?php the_ID(); ?> --></article>