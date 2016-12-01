<?php
/**
 * @package Nu Themes
 */
 
global $post;
$post_slug=$post->post_name;
 
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'box' ); ?>>
	<header class="entry-header">

<!-- Begin Gallery -->

<?php 

$related_activity = get_field('related_activity');
$brdr_story = get_field('brdr_story');
$brdr_image = get_field('brdr_image');

?>

		<p><img src="<?php echo $brdr_image['url']; ?>" alt="<?php echo $brdr_image['alt']; ?>" class="img-responsive"/></p>
		<h1 class="entry-title"><?php the_field('brdr_from'); ?> &raquo; <?php the_field('brdr_to'); ?><br/></h1>
		<div class="entry-meta">
		<p>A story from <a href='/activity/<?php echo get_post($related_activity)->post_name; ?>'><?php echo get_post($related_activity)->post_title; ?></a>
		</p>
			<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
			<?php endif; ?>
		<!-- .entry-meta --></div>
	<!-- .entry-header --></header>

	<div class="clearfix entry-content">
		<?php

			if (get_field('brdr_story')) :
			the_field('brdr_story');
			endif;
			?>

		<div class="row">
			<div class="col-md-6">
			<h2>Experience of this border</h2>
			<?php if (get_field('brdr_invisible_visible') == TRUE) : ?>
				<div class="chart_visible barchart"></div>
				<script>
				$(function() {
					var data = {
					  'totalMin': 0,
					  'totalMax': 100,
					  'totalAverage': 50,
					  'postTotal': <?php the_field('brdr_invisible_visible'); ?>,
					  'leftField': 'Invisble',
					  'rightField': 'Visible'
					}
					var chart = ".chart_visible";
					drawdotchart(data, chart);	
				});
				</script>
			<?php endif; ?>

			<?php if (get_field('brdr_unimportant_important') == TRUE) : ?>
				<div class="chart_important barchart"></div>
				<script>
				$(function() {
					var data = {
					  'totalMin': 0,
					  'totalMax': 100,
					  'totalAverage': 50,
					  'postTotal': <?php the_field('brdr_unimportant_important'); ?>,
					  'leftField': 'Unimportant',
					  'rightField': 'Important'
					}
					var chart = ".chart_important";
					drawdotchart(data, chart);	
				});
				</script>
			<?php endif; ?>

			<?php if (get_field('brdr_negative_positive') == TRUE) : ?>
				<div class="chart_positive barchart"></div>
				<script>
				$(function() {
					var data = {
					  'totalMin': 0,
					  'totalMax': 100,
					  'totalAverage': 50,
					  'postTotal': <?php the_field('brdr_negative_positive'); ?>,
					  'leftField': 'Negative',
					  'rightField': 'Positive'
					}
					var chart = ".chart_positive";
					drawdotchart(data, chart);	
				});
				</script>
			<?php endif; ?>
			</div>
			<div class="col-md-6">
			<h2>Location of border</h2><?php
			$location = get_field('brdr_location');
			
			?><img src="https://api.tiles.mapbox.com/v3/deklerk.map-57h1d46y/url-bit.ly%2F18KNEkg(<?php echo $location['lng'];?>,<?php echo $location['lat'];?>)/<?php echo $location['lng'];?>,<?php echo $location['lat'];?>,4/800x400.png" class="img-rounded img-responsive">
			<?php echo $location['address']; ?>
			</div>
		</div>
		<h2>Related experiences</h2>
				<div class="row">
					<div class="col-xs-12 col-sm-4">
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
								<p>as visible as
							 	<a href="<?php the_permalink() ?>" title="<?php the_field('brdr_from'); ?> &raquo; <?php the_field('brdr_to'); ?>"><?php the_field('brdr_from'); ?> &raquo; <?php the_field('brdr_to'); ?>
								<?php
								  if($rimage) {
									 ?><img src="<?php echo $rimage['sizes']['large']; ?>" alt="<?php echo $rimage['alt']; ?>" class="img-responsive"/><?php 
								  } else {
									 ?><img src="/wp-content/uploads/2016/12/egc_bg-cremesoda_400x300.png" class="img-responsive"><?php
								  }
								?>
								</a>
								</p>
						   <?php endwhile; wp_reset_query();
						   }
						?>
					</div>
					<div class="col-xs-12 col-sm-4">
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
								 <p>as important as
								 <a href="<?php the_permalink() ?>" title="<?php the_field('brdr_from'); ?> &raquo; <?php the_field('brdr_to'); ?>"><?php the_field('brdr_from'); ?> &raquo; <?php the_field('brdr_to'); ?>
								<?php
								  if($rimage) {
									 ?><img src="<?php echo $rimage['sizes']['large']; ?>" alt="<?php echo $rimage['alt']; ?>" class="img-responsive"/><?php 
								  } else {
									 ?><img src="/wp-content/uploads/2016/12/egc_bg-cremesoda_400x300.png" class="img-responsive"><?php
								  }
								?>
								</a>
								</p>
						   <?php endwhile; wp_reset_query();
						   }
						?>
					</div>					
					<div class="col-xs-12 col-sm-4">
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
								<p>as positive as
								<a href="<?php the_permalink() ?>" title="<?php the_field('brdr_from'); ?> &raquo; <?php the_field('brdr_to'); ?>"><?php the_field('brdr_from'); ?> &raquo; <?php the_field('brdr_to'); ?>
								<?php
								  if($rimage) {
									 ?><img src="<?php echo $rimage['sizes']['large']; ?>" alt="<?php echo $rimage['alt']; ?>" class="img-responsive"/><?php 
								  } else {
									 ?><img src="/wp-content/uploads/2016/12/egc_bg-cremesoda_400x300.png" class="img-responsive"><?php
								  }
								?>
								</a>
								</p>
						   <?php endwhile; wp_reset_query();
						   }
						?>
					</div>
				</div>	
	<!-- .entry-content --></div>

	<footer class="entry-meta entry-footer">
		<?php if ( 'post' == get_post_type() ) : ?>
			<?php
				$categories_list = get_the_category_list( __( ', ', 'nuthemes' ) );
				if ( $categories_list && nuthemes_categorized_blog() ) :
			?>
			<span class="cat-links">
				<?php printf( __( '%1$s', 'nuthemes' ), $categories_list ); ?>
			</span>
			<?php endif; ?>

			<?php
				$tags_list = get_the_tag_list( '', __( ', ', 'nuthemes' ) );
				if ( $tags_list ) :
			?>
			<span class="tags-links">
				<?php printf( __( '%1$s', 'nuthemes' ), $tags_list ); ?>
			</span>
			<?php endif; ?>
		<?php endif; ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
				<div class="col-xs-12">
					<?php
						if ( comments_open() || '0' != get_comments_number() )
							comments_template();
					?>
				</div>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'nuthemes' ), '<span class="edit-link">', '</span>' ); ?>
	<!-- .entry-footer --></footer>
<!-- #post-<?php the_ID(); ?> --></article>