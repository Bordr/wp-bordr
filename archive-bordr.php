<?php
/**
 * The template for displaying the bordr story archive pages.
 *
 */

get_header(); ?>

	<div class="row">
		<main id="content" class="col-sm-12 content-area" role="main">		
		<article class="page" style="margin-bottom:0px;" >
			<div class="row">
			<div class="col-xs-12 col-sm-9 col-lg-9">
				<h1 class="entry-title" style="font-size:24px;">Bordr stories</h1>
				<p>Bordr stories are impressions and experiences of a border.</p>
			</div>
			<div class="col-xs-12 col-sm-3 col-lg-3" style="text-align:right;" >
				<a href="/add-bordr-story/" class="btn btn-primary start" style="margin-top:1.5em;">Add Bordr Story</a>
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
					<li><a href="#actfilter" data-hub="" data-filter="">All activities</a></li>

				<?php
				
				// Array of WP_User objects.
				foreach ( $rel_act as $activity ) {
					if (get_post($activity)->ID != $last_activity) {
						$activity_title = get_post($activity)->post_title;
						$activity_name = get_post($activity)->post_name;
						$activity_ID = get_post($activity)->ID;
					
						?><li><a href="#relact" data-relact="<?php echo $activity_ID; ?>" class="filter" data-filter="relact"><?php echo $activity_title; ?></a></li><?php 
						$last_activity = get_post($activity)->ID;
					}
				}
				
				?>
			  </ul>
			</div>

			<div class="btn-group filtergroup" >
			  <button type="button" id="brdrperception" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				By experience <span class="caret"></span>
			  </button>
				  <ul class="dropdown-menu" id="brdrperceptionmenu">
					<li><a href="#perceptionfilter" data-perception="" data-perceptionval="">All experiences</a></li>
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
			<?php
				$i=0; //increment
				$n=2; //in
			?>

			<div id="masonry" class="row">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php //add increment to loop, if i == i+2, show "what's your story"
					if ($i == $n) { ?>
						<div class="col-xs-12 col-sm-6 col-lg-4 masonry-item">
							<article class="box bordr type-bordr status-publish hentry">
								<div class="from-activity">
												<div class="entry-meta">
														<a href='/add-bordr-story/'>Add your own story!</em></a>
													<!-- .entry-meta --></div>
											</div>
								<a href="/add-bordr-story/" title="Add your bordr story" rel="bookmark" class="story-title">
								<header class="entry-header story-header">
									From...		<!-- .entry-header --></header>
								<div class="down-arrow">
									<img class="arrow-img" src="/wp-content/themes/bordr/img/down-arrow.png" />
								</div>

								<div class="clearfix entry-summary">
									<div class="row story-preview">
											<img src="/wp-content/themes/bordr/img/ggc-default-img.png" class="img-responsive story-img"/>
											<div class="expand-story">What's your story?</div>
									</div>
								</div>
								<div class="up-arrow">
									<img class="arrow-img" src="/wp-content/themes/bordr/img/up-arrow.png" />
								</div>
								<header class="entry-header story-to">
									to...?		<!-- .entry-header --></header>
								</a>
								
								<footer class="entry-meta">
										<span class="edit-link"><a class="post-edit-link" href="http://www.globalgrandcentral.net/wp-admin/post.php?post=6145&#038;action=edit">Edit</a></span>		<!-- .entry-footer --></footer>

							</article>
						</div>
					<?php
						$n = $n + (2 * $i); //somewhat arbitrary increasing interval
					}
				?>
					<?php
						get_template_part( 'bordrloop', get_post_format() );
						$i++;
					?>

			<?php endwhile; ?>

			<!-- #masonry --></div>

			<?php nuthemes_content_nav( 'nav-below' ); ?>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'archive' ); ?>

		<?php endif; ?>

		<!-- #content --></main>

	<!-- .row --></div>

<?php get_footer(); ?>
