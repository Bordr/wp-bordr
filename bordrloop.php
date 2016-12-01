<?php
/**
 * @package Nu Themes
 */
 
$location = get_field('brdr_location');
$image = get_field('brdr_image');
$related_activity = get_field('related_activity');
 
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'box' ); ?>>
	<header class="entry-header">
		<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_field('brdr_from'); ?> &raquo; <?php the_field('brdr_to'); ?></a></h2>

		<?php if ( 'bordr' == get_post_type() ) : ?>
		<div class="entry-meta">
			<p>A story from <a href='/departure/<?php echo get_post($related_activity)->post_name; ?>'><?php echo get_post($related_activity)->post_title; ?></a>
		<!-- .entry-meta --></div>
		<?php endif; ?>
	<!-- .entry-header --></header>

	<div class="clearfix entry-summary">
		<div class="row">
			<div class="col-xs-12 col-sm-6">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
				<?php
				  if($image) {
					 ?><img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>" class="img-responsive"/><?php 
				  } else {
					 ?><img src="/wp-content/uploads/2016/12/egc_bg-cremesoda_400x300.png" class="img-responsive"><?php
				  }
				?>
				</a>
				<p><?php the_field('brdr_story'); ?></p>
			</div>
			<div class="col-xs-12 col-sm-6">
				<b>Experience of this border</b>
				<?php if (get_field('brdr_invisible_visible') == TRUE) : ?>
					<div class="chart_visible-<?php the_ID(); ?> barchart"></div>
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
						var chart = ".chart_visible-<?php the_ID(); ?>";
						drawdotchart(data, chart);	
					});
					</script>
				<?php endif; ?>

				<?php if (get_field('brdr_unimportant_important') == TRUE) : ?>
					<div class="chart_important-<?php the_ID(); ?> barchart"></div>
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
						var chart = ".chart_important-<?php the_ID(); ?>";
						drawdotchart(data, chart);	
					});
					</script>
				<?php endif; ?>

				<?php if (get_field('brdr_negative_positive') == TRUE) : ?>
					<div class="chart_positive-<?php the_ID(); ?> barchart"></div>
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
						var chart = ".chart_positive-<?php the_ID(); ?>";
						drawdotchart(data, chart);	
					});
					</script>
				<?php endif; ?>
				<b>Location of border</b>	
				<p><img src="https://api.tiles.mapbox.com/v3/deklerk.map-57h1d46y/url-bit.ly%2F18KNEkg(<?php echo $location['lng'];?>,<?php echo $location['lat'];?>)/<?php echo $location['lng'];?>,<?php echo $location['lat'];?>,3/600x300.png" class="img-rounded img-responsive"></p>
				<b>Related experiences</b>
				<div class="row">
					<div class="col-xs-4 col-sm-4">
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
					<div class="col-xs-4 col-sm-4">
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
					<div class="col-xs-4 col-sm-4">
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
			</div>
		</div>
	
		<?php the_excerpt(); ?>
	<!-- .entry-summary --></div>

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
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'nuthemes' ), __( '1 Comment', 'nuthemes' ), __( '% Comments', 'nuthemes' ) ); ?></span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'nuthemes' ), '<span class="edit-link">', '</span>' ); ?>
	<!-- .entry-footer --></footer>
<!-- #post-<?php the_ID(); ?> --></article>