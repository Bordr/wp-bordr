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
				<p>Bordrs are stories, impressions, experiences of a border.</p>
			</div>
			<div class="col-xs-12 col-sm-3 col-lg-3" style="text-align:right;" >
				<a href="/add-bordr-story/" class="btn btn-primary start">Add Bordr Story</a>
			</div>
			</div>
		</article>
	</div>

	<?php
		// FILTER AND UPCOMING EVENTS SETUP
		
		$char_options = array(
			'brdr_invisible_visible'=>array(
				0 => '<a href="#charfilter" data-charval="0" data-char="brdr_invisible_visible" class="filter" data-filter="char">Visible</a>', 
				100 => '<a href="#charfilter" data-charval="100" data-char="brdr_invisible_visible" class="filter" data-filter="char">Invisible</a>'),
			'brdr_negative_positive'=>array(
				0 => '<a href="#charfilter" data-charval="0" data-char="brdr_negative_positive" class="filter" data-filter="char">Negative</a>', 
				100 => '<a href="#charfilter" data-charval="100" data-char="brdr_negative_positive" class="filter" data-filter="char">Positive</a>'),
			'brdr_unimportant_important'=>array(
				0 => '<a href="#charfilter" data-charval="0" data-char="brdr_unimportant_important" class="filter" data-filter="char">Unimportant</a>', 
				100 => '<a href="#charfilter" data-charval="100" data-char="brdr_unimportant_important" class="filter" data-filter="char">Important</a>')
		);
		
		$events = array(); 
		$charsavb = array();
		$stationsavb = array();
		$countriesavb = array();
		if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
		<?php 
			$author_id = get_the_author_meta('ID');
			$deptname = get_field('brdr_from')." — ".get_field('brdr_to');
					
			foreach ($char_options as $char_name => $char_ignore) {
				if (get_field($char_name) == TRUE) {
					$charval = get_field($char_name);
					$charsavb[$char_name][] = round($charval/100)*100;
				}
			}
			
			$stationsavb[] = $author_id;
			
			$address = get_field('brdr_location');
			$countriesavb[] = end(explode(",",$address['address']));
			$countriesavb = array_unique($countriesavb);
			endwhile;
		endif; ?>

<!-- 
	<h2 class="entry-title" style="margin-left:20px; margin-top:30px;">Filter Bordrs</h2>

	<div class="row" style="margin-bottom:30px;">
	
		<div class="col-sm-12">
			<div class="btn-group filtergroup" style="margin-left:20px;">
			  	<?php if ($_GET['station']) { ?>
				  <button type="button" id="depstat" class="btn btn-primary dropdown-toggle selFilter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<?php echo ucwords(get_field('related_activity','user_'.$_GET['activity'])); ?> <span class="caret"></span>
				  </button>
			  	<?php } else { ?>			  	
				  <button type="button" id="depstat" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					By activity <span class="caret"></span>
				  </button>
			  	<?php } ?>			  	
			  <ul class="dropdown-menu" id="depstatmenu">
					<li><a href="#stationfilter" data-station="" data-filter="">All activities</a></li>

				<?php
				
				$blogusers = get_users('role=station');
				$stations_arr = array();
	 
				// Array of WP_User objects.
				foreach ( $blogusers as $user ) {
				
					if (in_array($user->ID,$stationsavb)) {
		
						$user_info = get_userdata($user->ID);
						$station = get_field('organization_name','user_'.$user->ID);
						$location = get_field('organization_location','user_'.$user->ID);
						
						$location_ctry = trim(end(explode(",", $location['address'])));
						$ctrysavb[] = $location_ctry;

						$ctrystations[$location_ctry][] = "<li><a href=\"#stationfilter\" data-station=\"".$user->ID."\" class=\"filter\" data-filter=\"station\">".ucwords($station)."</a></li>";

					}

				}
				
				$ctrysavb = array_unique($ctrysavb);
				sort($ctrysavb);
// 				print_r($ctrysavb);

				foreach ( $ctrysavb as $ctry ) {
				
					?><li><a href="#ctryfilter" data-ctry="<?php echo $ctry; ?>" class="filter" data-filter="ctry" style="font-weight:bold;"><?php echo $ctry; ?></a></li><?php 
					
					foreach ( $ctrystations[$ctry] as $station ) {
					
						echo $station; 
					
					}
				
				}
				
				?>
			  </ul>
			</div>
			
			<div class="btn-group filtergroup" >
			  <button type="button" id="depchar" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				By characteristics <span class="caret"></span>
			  </button>
				  <ul class="dropdown-menu" id="depcharmenu">
					<li><a href="#charfilter" data-char="" data-charval="">All characteristics</a></li>
					<?php 
					foreach ( $char_options as $char => $char_arr ) {
						if ($charsavb[$char]) {
							foreach ( $char_arr as $charkey => $charved ) {							
								if (in_array($charkey, $charsavb[$char])) {
									?><li><?php echo $charved; ?></li><?php
								}
							}
						}
					}				
				?>
				  </ul>
			</div>

		</div>					
	</div>
 -->
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

		<?php if ( !is_category( 'notes' )) { get_sidebar(); } ?>
	<!-- .row --></div>

<?php get_footer(); ?>
