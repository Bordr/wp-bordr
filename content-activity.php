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

$gallery = get_field('departure_images');
$methods = get_field('method_icons');

$method_options = array('photography'=>'<i class="fa fa-camera-retro" aria-hidden="true"></i> photos',
 						'music' => '<i class="fa fa-music" aria-hidden="true"></i> music',
 						'food' => '<i class="fa fa-cutlery" aria-hidden="true"></i> food',
						'writing' => '<i class="fa fa-book" aria-hidden="true"></i> writing',
						'film' => '<i class="fa fa-video-camera" aria-hidden="true"></i> film',
						'lectures' => '<i class="fa fa-university" aria-hidden="true"></i> lectures',
						'theatre' => '<i class="fa fa-users" aria-hidden="true"></i> theatre',
						'coding' => '<i class="fa fa-code" aria-hidden="true"></i> coding', 
						'bordr' => '<i class="fa fa-map-signs" aria-hidden="true"></i> Bordr', 
						'public art' => '<i class="fa fa-street-view" aria-hidden="true"></i> public art', 
						'travel' => '<i class="fa fa-globe" aria-hidden="true"></i> travel', 
						'workshops' => '<i class="fa fa-bolt" aria-hidden="true"></i> workshops',
						'archiving' => '<i class="fa fa-archive" aria-hidden="true"></i> archiving',
						'drawing' => '<i class="fa fa-pencil" aria-hidden="true"></i> drawing',
						'graffiti' => '<i class="fa fa-brush" aria-hidden="true"></i> graffiti',
						'mapping' => '<i class="fa fa-map" aria-hidden="true"></i> mapping',
						'interviews' => '<i class="fa fa-comment" aria-hidden="true"></i> interviews',
						'performance' => '<i class="fa fa-users" aria-hidden="true"></i> performance',
						'sound' => '<i class="fa fa-volume-up" aria-hidden="true"></i> sound',
						'exhibitions' => '<i class="fa fa-picture-o" aria-hidden="true"></i> exhibitions',
						'textile' => '<i class="fa fa-scissors" aria-hidden="true"></i> textile', 
						'other' => '<i class="fa fa-ellipsis-h" aria-hidden="true"></i> other',  
						'making' => '<i class="fa fa-cogs" aria-hidden="true"></i> making');

if( $gallery ): ?>
    <div id="slider" class="featuredonpost flexslider">
        <ul class="slides">
            <?php foreach( $gallery as $image ): ?>
                <li>
                    <img src="<?php echo $image['sizes']['large'] ?>" alt="<?php echo $image['alt']; ?>" />
                    <p class="flex-caption"><?php echo $image['caption']; ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    
<script type="text/javascript" charset="utf-8">
  $(window).load(function() {
    $('.flexslider').flexslider();
  });
</script>
    
<?php endif; ?>

<!-- End Gallery -->
		<p  class="lead">Activity: <?php the_title(); ?></p>
		<p>Explores the space between</p>
		<h1 class="lead"><?php the_field('from'); ?> — <?php the_field('to'); ?></h1>
		<?php if ( $oborders = get_field( 'other_borders' ) ) :
		?>
		<?php 
			$resultstr = array();
			foreach ( $oborders as $idx => $border ) :
				$resultstr[] = $border['ofrom']." – ".$border['oto'];
			endforeach;
			$result = implode(", ",$resultstr);
			?><p>It also explores the borders between: <?php echo $result; ?>.</p> <?php
		endif;
		?>
		<p  class="lead">An activity by    
		<?php nuthemes_posted_by(); ?>
		</p>
		<?php if (get_field('partner')) :
		?><p>Partnering with <?php
				$partners = get_field('partner');
				$resultstr = array();
				foreach( $partners as $partner ): 
						$resultstr[] = "<a href=\"/author/".$partner['user_nicename']."/\">".$partner['display_name']."</a>";
				endforeach;
				$result = implode(", ",$resultstr);
				echo $result;
		endif;
		?>
		</p>
			<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
<!-- 
			<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'nuthemes' ), __( '1 Comment', 'nuthemes' ), __( '% Comments', 'nuthemes' ) ); ?></span>
 -->
			<?php endif; ?>
		<!-- .entry-meta -->
	<!-- .entry-header --></header>

	<div class="clearfix entry-content">
		<?php

			?><div class="lead"><?php 
			the_field('brief_description');
			?></div><?php
			
			if (get_field('why_description')) :
			?><h2>Why</h2><?php
			the_field('why_description');
			endif;
			?>

			<h2>Location</h2><?php		
			$location = get_field('departure_location');
			
			echo $location['address'];
			
			?><img src="https://api.tiles.mapbox.com/v3/deklerk.map-57h1d46y/url-bit.ly%2F18KNEkg(<?php echo $location['lng'];?>,<?php echo $location['lat'];?>)/<?php echo $location['lng'];?>,<?php echo $location['lat'];?>,4/1000x300.png" class="img-rounded img-responsive">

		<h2>Characteristics</h2>
		<div class="row">
			<div class="col-md-6">
			<h3>Area</h3>
			<?php if (get_field('urban_rural_rel') == TRUE) : ?>
				<div class="chart_rural barchart"></div>
				<?php // the_field('urban_rural_desc'); ?>
				<script>
				$(function() {
					var data = {
					  'totalMin': 0,
					  'totalMax': 100,
					  'totalAverage': 50,
					  'postTotal': <?php the_field('urban_rural'); ?>,
					  'leftField': 'Urban',
					  'rightField': 'Rural'
					}
					var chart = ".chart_rural";
					drawdotchart(data, chart);	
				});
				</script>
				<?php endif; ?>
			
				<?php if (get_field('rich_poor_rel') == TRUE) : ?>
				<div class="chart_rich barchart"></div>
				<?php // the_field('rich_poor_desc'); ?>	
				<script>
				$(function() {
					var data = {
					  'totalMin': 0,
					  'totalMax': 100,
					  'totalAverage': 50,
					  'postTotal': <?php the_field('rich_poor'); ?>,
					  'leftField': 'Rich',
					  'rightField': 'Poor'
					}
					var chart = ".chart_rich";
					drawdotchart(data, chart);	
				});
				</script>
				<?php endif; ?>

				<?php if (get_field('homo_plural_rel') == TRUE) : ?>
				<div class="chart_homo barchart"></div>
				<?php // the_field('homo_plural_desc'); ?>
				<script>
				$(function() {
					var data = {
					  'totalMin': 0,
					  'totalMax': 100,
					  'totalAverage': 50,
					  'postTotal': <?php the_field('homo_plural'); ?>,
					  'leftField': 'Homogenous area',
					  'rightField': 'Pluralistic area'
					}
					var chart = ".chart_homo";
					drawdotchart(data, chart);		
				});
				</script>
				<?php endif; ?>
				<?php the_field('setting_desc'); ?>
			</div>
			<div class="col-md-6">
				<h3>Audience</h3>
				<?php if (get_field('one_many_rel') == TRUE) : ?>
				<div class="chart_one barchart"></div>
				<?php // the_field('one_many_desc'); ?>
				<script>
				$(function() {
					var data = {
					  'totalMin': 0,
					  'totalMax': 100,
					  'totalAverage': 50,
					  'postTotal': <?php the_field('one_many'); ?>,
					  'leftField': 'Affects one person',
					  'rightField': 'Affects many people'
					}
					var chart = ".chart_one";
					drawdotchart(data, chart);		
				});
				</script>
				<?php endif; ?>
			
				<?php if (get_field('young_old_rel') == TRUE) : ?>
				<div class="chart_young barchart"></div>
				<?php // the_field('young_old_desc'); ?>
				<script>
				$(function() {
					var data = {
					  'totalMin': 0,
					  'totalMax': 100,
					  'totalAverage': 50,
					  'postTotal': <?php the_field('young_old'); ?>,
					  'leftField': 'Affects youth',
					  'rightField': 'Affects the eldery'
					}
					var chart = ".chart_one";
					drawdotchart(data, chart);		
				});
				</script>
				<?php endif; ?>			

				<?php if (get_field('known_unknown_rel') == TRUE) : ?>
				<div class="chart_known barchart"></div>
				<?php // the_field('known_unknown_desc'); ?>
				<script>
				$(function() {
					var data = {
					  'totalMin': 0,
					  'totalMax': 100,
					  'totalAverage': 50,
					  'postTotal': <?php the_field('known_unknown'); ?>,
					  'leftField': 'Affects known people',
					  'rightField': 'Affects unknown people'
					}
					var chart = ".chart_known";
					drawdotchart(data, chart);		
				});
				</script>
				<?php endif; ?>		
				<?php the_field('audience_desc'); ?>
			</div>
		</div>

		<?php
		if (get_field('audience_discovery')) :
		?><h2>How the audience/participants were reached or discovered</h2><?php
		the_field('audience_discovery');
		endif;
		?>

		<h2>Methods Used</h2>
		<div class="row">
		<?php 
		if( $methods ): ?> 
			<?php foreach( $methods as $method ): ?>
				<div class="col-xs-4 col-sm-2">
					<?php echo $method_options[$method]; ?>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
		</div>


		<?php
		if (get_field('how_description')) :
		?><h2>How</h2><?php
		the_field('how_description');
		endif;
		?>


		<h2>Results</h2>

		<!-- The Loop -->

			<?php
			
			$posts = get_posts(array(
						'post_type'		=> 'bordr',
						'numberposts'	=> 4,
						'meta_query'		=> array(
							array(
								'key' => 'related_activity',
								'value' =>  get_the_ID(),
								'compare' => 'LIKE'
								)
							)
			));
			
			if( $posts ): ?>
			<h3>Bordr Stories</h3>	
			<p>As part of this activity, border-stories were booked. <a href="/bordr/?relact=<?php echo get_the_ID();?>">View all the stories posted with this activity</a></p>	
						<div id="masonry" class="row">
		
			<?php foreach( $posts as $post ): 
		
				setup_postdata( $post )
		
				?>

					<div class="col-xs-6 col-sm-4 col-lg-3 masonry-item">
						<?php get_template_part( 'bordrlittleloop', get_post_format() ); ?>
					</div>

			<?php endforeach; ?>
					</div>
					
			<?php wp_reset_postdata(); ?>

		<?php else: ?>
				<p><?php _e('No stories from this activity at this time.'); ?></p>

		<?php endif; ?>

		<!-- End Loop -->

		<?php
		if (get_field('results_description')) :
		the_field('results_description');
		endif;
		?>

		<?php if (strlen(get_field('success_desc')) > 10) : ?>
		<h3>How it went</h3>
		<div class="chart_success barchart"></div>
		<?php // the_field('known_unknown_desc'); ?>
		<script>
		$(function() {
			var data = {
			  'totalMin': 0,
			  'totalMax': 100,
			  'totalAverage': 50,
			  'postTotal': <?php the_field('success_rating'); ?>,
			  'leftField': 'Failure',
			  'rightField': 'Success'
			}
			var chart = ".chart_success";
			drawdotchart(data, chart);		
		});
		</script>
		<?php endif; ?>		
		<h3>Main lessons learned</h3>
		<?php the_field('success_desc'); ?>

			<?php
			if (get_field('inspiration_description')) :
			?><h2>Inspiration</h2><?php
			the_field('inspiration_description');
			endif;
		
		?>


		<?php if (get_field('partner') && ($suppress == 1)) :
		?><h2>Partners</h2><?php
				$partners = get_field('partner');
				foreach( $partners as $partner ): ?>
						
						<a href="/author/<?php echo($partner['user_nicename']); ?>/"><?php echo($partner['display_name']); ?></a><br/>
				<?php endforeach;
		endif;

		if (get_field('credits_description')) :
		?><h2>Credits</h2><?php
		the_field('credits_description');
		endif;
		?>

<!-- Begin Timeline -->
		<h2>Activity Timeline</h2>
		<?php if ( $events = get_field( 'timeline' ) ) :
			// Re-order our events just in case
			usort( $events, 'sort_by_date_ascending');

			// Set a year checker to see if we should print a new year
			$year = 0;
			$is_new_year = false;
		?>
		<div class="timeline">
	

		<?php foreach ( $events as $idx => $event ) :

				$is_new_year = false;

				$event_year = date( "Y", strtotime( $event['event_date'] ) );

				if ( $year != $event_year ) {
					$year = $event_year;
					$is_new_year = true;
				}
			?>

		<?php if ( $is_new_year ) { ?>

		<?php if ( $idx > 0 ) { // If it's not the first event, we need to end the current list ?>
					</ul>
		

		<?php } ?>

				<h2><?php echo $event_year; ?></h2>

				<ul>

		<?php } ?>

			<li>
				<h3><?php echo $event['event_title']; ?></h3>

		<?php echo $event['event_description']; ?>

				<time><?php echo date( "j F Y", strtotime($event['event_date']) ); ?></time>
			</li>

		<?php endforeach; ?>

			</ul>
		</div>


		<?php endif; ?>

<!-- End Timeline -->

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'nuthemes' ),
				'after'  => '</div>',
			) );
		?>
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