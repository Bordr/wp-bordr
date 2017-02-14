<?php
/**
 * @package Nu Themes
 */
 
$location = get_field('brdr_location');
$image = get_field('brdr_image');
$related_activity = get_field('related_activity');
 
?>

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
		<img class="arrow-img" src="../wp-content/themes/bordr/img/down-arrow.png" />
	</div>

	<div class="clearfix entry-summary">
		<div class="row story-preview">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
				<?php
				  if($image) {
					 ?><img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>" class="img-responsive story-img"/><?php 
				  }
				  else {
				  	?><img src="../wp-content/themes/bordr/img/ggc-default-img.png" class="img-responsive story-img"/><?php
				  }
				?>
				<div class="expand-story">Learn more...</div>
				</a>
		</div>
	</div>
	<div class="up-arrow">
		<img class="arrow-img" src="../wp-content/themes/bordr/img/up-arrow.png" />
	</div>
	<header class="entry-header story-to">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark" class="story-title"><?php the_field('brdr_to'); ?></a>
	<!-- .entry-header --></header>
		<div class="row">
			<div class="col-sm-12 related-stories">
			<h4>Related stories</h4>
				<div class="related-story">
					<?php
					$cvalue = get_field('brdr_invisible_visible'); 
					if ($cvalue == 100) { $cvalue = 60; $compare = ">"; } 
					else { $cvalue = 40; $compare = "<"; }
					  $second_query = new WP_Query( array(
						  'post_type' => 'bordr',
						  'meta_query' => array(
								'key'		=> 'brdr_invisible_visible',
								'value'		=> $cvalue,
								'compare'	=> $compare,
								'type' => 'numeric'
							),
						  'posts_per_page' => 1,
						  'ignore_sticky_posts' => 1,
						  'orderby' => 'rand',
						  'post__not_in'=>array(get_the_ID())
					   ) );
					//Loop through posts and display...
						if($second_query->have_posts()) {
						 while ($second_query->have_posts() ) : $second_query->the_post(); $rimage = get_field('brdr_image'); ?>
						 	<a href="<?php the_permalink() ?>" >
							 	<?php
								  if($rimage) {
									 ?><img src="<?php echo $rimage['sizes']['large']; ?>" alt="<?php echo $rimage['alt']; ?>" class="img-responsive related-story-img"/><?php 
								  } else {
									 ?><img src="/wp-content/uploads/2016/12/egc_bg-cremesoda_400x300.png" class="img-responsive related-story-img"><?php
								  }
								?>
							</a>
							<p>as visible as
							 	<a href="<?php the_permalink() ?>" title="<?php the_field('brdr_from'); ?> &raquo; <?php the_field('brdr_to'); ?>"><?php the_field('brdr_from'); ?> &raquo; <?php the_field('brdr_to'); ?>
								</a>
							</p>
					   <?php endwhile; wp_reset_query();
					   }
					?>
				</div>
				<div class="related-story">
					<?php
					$cvalue = get_field('brdr_unimportant_important'); 
					if ($cvalue == 100) { $cvalue = 60; $compare = ">"; } 
					else { $cvalue = 40; $compare = "<"; }
					  $second_query = new WP_Query( array(
						  'post_type' => 'bordr',
						  'meta_query' => array(
								'key'		=> 'brdr_unimportant_important',
								'value'		=> $cvalue,
								'compare'	=> $compare,
								'type' => 'numeric'
							),
						  'posts_per_page' => 1,
						  'ignore_sticky_posts' => 1,
						  'orderby' => 'rand',
						  'post__not_in'=>array(get_the_ID())
					   ) );
					//Loop through posts and display...
						if($second_query->have_posts()) {
						 while ($second_query->have_posts() ) : $second_query->the_post(); $rimage = get_field('brdr_image'); ?>
						 	<a href="<?php the_permalink() ?>" >	
							 	<?php
								  if($rimage) {
									 ?><img src="<?php echo $rimage['sizes']['large']; ?>" alt="<?php echo $rimage['alt']; ?>" class="img-responsive related-story-img-even"/><?php 
								  } else {
									 ?><img src="/wp-content/uploads/2016/12/egc_bg-cremesoda_400x300.png" class="img-responsive related-story-img-even"><?php
								  }
								?>
							</a>
							<p>as important as
								<a href="<?php the_permalink() ?>" title="<?php the_field('brdr_from'); ?> &raquo; <?php the_field('brdr_to'); ?>"><?php the_field('brdr_from'); ?> &raquo; <?php the_field('brdr_to'); ?>
								</a>
							</p>
					   <?php endwhile; wp_reset_query();
					   }
					?>
				</div>					
				<div class="related-story">
					<?php
					$cvalue = get_field('brdr_negative_positive'); 
					if ($cvalue == 100) { $cvalue = 60; $compare = ">"; } 
					else { $cvalue = 40; $compare = "<"; }
					  $second_query = new WP_Query( array(
						  'post_type' => 'bordr',
						  'meta_query' => array(
								'key'		=> 'brdr_negative_positive',
								'value'		=> $cvalue,
								'compare'	=> $compare,
								'type' => 'numeric'
							),
						  'posts_per_page' => 1,
						  'ignore_sticky_posts' => 1,
						  'orderby' => 'rand',
						  'post__not_in'=>array(get_the_ID())
					   ) );
					//Loop through posts and display...
						if($second_query->have_posts()) {
						 while ($second_query->have_posts() ) : $second_query->the_post(); $rimage = get_field('brdr_image'); ?>
						 	<a href="<?php the_permalink() ?>" >
							 	<?php
								  if($rimage) {
									 ?><img src="<?php echo $rimage['sizes']['large']; ?>" alt="<?php echo $rimage['alt']; ?>" class="img-responsive related-story-img"/><?php 
								  } else {
									 ?><img src="/wp-content/uploads/2016/12/egc_bg-cremesoda_400x300.png" class="img-responsive related-story-img"><?php
								  }
								?>
							</a>
							<p>as positive as
								<a href="<?php the_permalink() ?>" title="<?php the_field('brdr_from'); ?> &raquo; <?php the_field('brdr_to'); ?>"><?php the_field('brdr_from'); ?> &raquo; <?php the_field('brdr_to'); ?>
								</a>
							</p>
					   <?php endwhile; wp_reset_query();
					   }
					?>
				</div>
			</div>
		</div>
		<footer class="entry-meta entry-footer">
			<?php edit_post_link( __( 'Edit', 'nuthemes' ), '<span class="edit-link">', '</span>' ); ?>
	<!-- .entry-footer --></footer>

<!-- #post-<?php the_ID(); ?> --></article>