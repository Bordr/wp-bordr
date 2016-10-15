<?php
/**
 * The template for displaying archive pages.
 *
 */

get_header(); ?>

	<div class="row">
		<main id="content" class="col-sm-12 content-area" role="main">		
		<article class="page" style="margin-bottom:0px;" >
			<div class="row">
			<div class="col-xs-12 col-sm-9 col-lg-9">
				<h1 class="entry-title" style="font-size:24px;">Bordrs</h1>
				<p>Bordrs are stories, impressions, experiences of a border. hello</p>
			</div>
			<div class="col-xs-12 col-sm-3 col-lg-3" style="text-align:right;" >
				<a href="/add-bordr-story/" class="btn btn-primary start">Add Bordr Story</a>
			</div>
			</div>
		</article>
	</div>

	<?php
		// FILTER AND UPCOMING EVENTS SETUP
		
		$perception_options = array(
			'brdr_invisible_visible'=>array(
				0 => '<a href="#perceptionfilter" data-perceptionval="1" data-perception="brdr_invisible_visible" class="filter" data-filter="perception">Invisible</a>', 
				100 => '<a href="#perceptionfilter" data-perceptionval="100" data-perception="brdr_invisible_visible" class="filter" data-filter="perception">Visible</a>'),
			'brdr_negative_positive'=>array(
				0 => '<a href="#perceptionfilter" data-perceptionval="1" data-perception="brdr_negative_positive" class="filter" data-filter="perception">Negative</a>', 
				100 => '<a href="#perceptionfilter" data-perceptionval="100" data-perception="brdr_negative_positive" class="filter" data-filter="perception">Positive</a>'),
			'brdr_unimportant_important'=>array(
				0 => '<a href="#perceptionfilter" data-perceptionval="1" data-perception="brdr_unimportant_important" class="filter" data-filter="perception">Unimportant</a>', 
				100 => '<a href="#perceptionfilter" data-perceptionval="100" data-perception="brdr_unimportant_important" class="filter" data-filter="perception">Important</a>')
		);
		
		$rel_act = array(); 
		$perceptionsavb = array();
		$act_q = new WP_Query(array('post_type' => 'bordr','posts_per_page' => -1));
		if ( $act_q->have_posts() ) : 
			while ( $act_q->have_posts() ) : $act_q->the_post(); 

			$rel_act[] = get_field('related_activity');

					
			foreach ($perception_options as $perception_name => $perception_ignore) {
				if (get_field($perception_name) == TRUE) {
					$perceptionval = get_field($perception_name);
					$perceptionsavb[$perception_name][] = round($perceptionval/100)*100;
				}
			}
			
			endwhile;

			sort($rel_act);
			
			wp_reset_query();
			
		endif;
		?>

	<h2 class="entry-title" style="margin-left:0px; margin-top:30px;">Filter Bordrs</h2>

	<div class="row" style="margin-bottom:30px;">
	
		<div class="col-sm-12">
			<div class="btn-group filtergroup" style="margin-left:0px;">
			  	<?php if ($_GET['relact']) { ?>
				  <button type="button" id="brdract" class="btn btn-primary dropdown-toggle selFilter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<?php echo ucwords(get_post(get_field('related_activity'))->post_title); ?> <span class="caret"></span>
				  </button>
			  	<?php } else { ?>			  	
				  <button type="button" id="brdract" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					By activity <span class="caret"></span>
				  </button>
			  	<?php } ?>			  	
			  <ul class="dropdown-menu" id="brdractmenu">
					<li><a href="#actfilter" data-station="" data-filter="">All activities</a></li>

				<?php
				
				// Array of WP_User objects.
				foreach ( $rel_act as $activity ) {
					if (get_post($activity)->ID != $last_activity) {
						$activity_title = get_post($activity)->post_title;
						$activity_name = get_post($activity)->post_name;
						$activity_ID = get_post($activity)->ID;
					
						?><li><a href="#relact" data-relact="<?php echo $activity_ID; ?>" class="filter" data-filter="relact" style="font-weight:bold;"><?php echo $activity_title; ?></a></li><?php 
						$last_activity = get_post($activity)->ID;
					}
				}
				
				?>
			  </ul>
			</div>

			<div class="btn-group filtergroup" >
			  <button type="button" id="brdrperception" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				By characteristics <span class="caret"></span>
			  </button>
				  <ul class="dropdown-menu" id="brdrperceptionmenu">
					<li><a href="#perceptionfilter" data-perception="" data-perceptionval="">All characteristics</a></li>
					<?php 
					foreach ( $perception_options as $perception => $perception_arr ) {
						if ($perceptionsavb[$perception]) {
							foreach ( $perception_arr as $perceptionkey => $perceptionved ) {							
								if (in_array($perceptionkey, $perceptionsavb[$perception])) {
									?><li><?php echo $perceptionved; ?></li><?php
								}
							}
						}
					}				
				?>
				  </ul>
			</div>

		</div>					
	</div>

	<div class="row">	

		
		<?php if ( have_posts() ) : ?>

				<div id="masonry" class="row">
				<?php while ( have_posts() ) : the_post(); ?>

					<div class="col-xs-12 masonry-item">
						<?php get_template_part( 'bordrloop', get_post_format() ); ?>
					</div>

				<?php endwhile; ?>

			<!-- #masonry --></div>

			<?php nuthemes_content_nav( 'nav-below' ); ?>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'archive' ); ?>

		<?php endif; ?>

		<!-- #content --></main>

	<!-- .row --></div>

<?php get_footer(); ?>
