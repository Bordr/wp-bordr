<?php
/**
 * The template for displaying archive pages.
 * orginally -> archive-activity.php
 */

get_header(); ?>

	<div class="row">
		<main id="content" class="col-sm-12 content-area" role="main">		
		<article class="page" style="margin-bottom:0px;" >
			<div class="row">
			<div class="col-xs-12 col-sm-9 col-lg-9">
				<h1 class="entry-title" style="font-size:24px;">Activities</h1>
				<p>Activities are projects, actions, or interventions that explore borders and enable people to meet others.</p>
			</div>
			<div class="col-xs-12 col-sm-3 col-lg-3" style="text-align:right;" >
				<?php if (is_user_logged_in()) :
				?><a href="/wp-admin/post-new.php?post_type=activity" class="btn btn-primary start">Add Activity</a><?php
					endif;
				?>
			</div>
			</div>
		</article>
	</div>

	<?php
		// FILTER AND UPCOMING EVENTS SETUP
		
		$char_options = array(
			'urban_rural'=>array(
				0 => '<a href="#charfilter" data-charval="0" data-char="urban_rural" class="filter" data-filter="char">Setting: Urban</a>', 
				100 => '<a href="#charfilter" data-charval="100" data-char="urban_rural" class="filter" data-filter="char">Setting: Rural</a>'),
			'rich_poor'=>array(
				0 => '<a href="#charfilter" data-charval="0" data-char="rich_poor" class="filter" data-filter="char">Setting: Rich</a>', 
				100 => '<a href="#charfilter" data-charval="100" data-char="rich_poor" class="filter" data-filter="char">Setting: Poor</a>'),
			'homo_plural'=>array(
				0 => '<a href="#charfilter" data-charval="0" data-char="homo_plural" class="filter" data-filter="char">Setting: Homogenous</a>', 
				100 => '<a href="#charfilter" data-charval="100" data-char="homo_plural" class="filter" data-filter="char">Setting: Pluralistic</a>'),
			'one_many'=>array(
				0 => '<a href="#charfilter" data-charval="0" data-char="one_many" class="filter" data-filter="char">Audience: Few</a>', 
				100 => '<a href="#charfilter" data-charval="100" data-char="one_many" class="filter" data-filter="char">Audience: Many</a>'),
			'young_old'=>array(
				0 => '<a href="#charfilter" data-charval="0" data-char="young_old" class="filter" data-filter="char">Audience: Young</a>', 
				100 => '<a href="#charfilter" data-charval="100" data-char="young_old" class="filter" data-filter="char">Audience: Old</a>'),
			'known_unknown'=>array(
				0 => '<a href="#charfilter" data-charval="0" data-char="known_unknown" class="filter" data-filter="char">Audience: Known</a>', 
				100 => '<a href="#charfilter" data-charval="100" data-char="known_unknown" class="filter" data-filter="char">Audience: Unknown</a>'),
		);
		
		$methodsavb = array();
		$charsavb = array();
		$stationsavb = array();
		$countriesavb = array();
		if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
		<?php 
			$author_id = get_the_author_meta('ID');
			$deptname = get_field('from')." — ".get_field('to');
					
			if (get_field('method_icons')) {
				$methodsavb = array_merge($methodsavb, get_field('method_icons'));
			}
			
			foreach ($char_options as $char_name => $char_ignore) {
				if (get_field($char_name."_rel") == TRUE) {
					$charval = get_field($char_name);
					$charsavb[$char_name][] = round($charval/100)*100;
				}
			}
			
			$stationsavb[] = $author_id;
			
			$address = get_field('departure_location');
			$countriesavb[] = end(explode(",",$address['address']));
			$countriesavb = array_unique($countriesavb);
				
		?>
	<?php endwhile; 
			wp_reset_query();
		endif; ?>


	<h2 class="entry-title" style="margin-left:0px; margin-top:30px;">Filter Activities By</h2>

	<div class="row" style="margin-bottom:30px;">
	
		<div class="col-sm-12">
			<div class="btn-group filtergroup" style="margin-left:0px;">
			  	<?php if ($_GET['station']) { ?>
				  <button type="button" id="depstat" class="btn btn-primary dropdown-toggle selFilter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<?php echo ucwords(get_field('organization_name','user_'.$_GET['station'])); ?> <span class="caret"></span>
				  </button>
			  	<?php } else { ?>			  	
				  <button type="button" id="depstat" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					By hub <span class="caret"></span>
				  </button>
			  	<?php } ?>			  	
			  <ul class="dropdown-menu" id="depstatmenu">
					<li><a href="#stationfilter" data-station="" data-filter="">All Hubs</a></li>

				<?php
				
				$blogusers = get_users('role=hub');
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
				By Setting / By Audience <span class="caret"></span>
			  </button>
				  <ul class="dropdown-menu" id="depcharmenu">
					<li><a href="#charfilter" data-char="" data-charval="">By Setting / By Audience</a></li>
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

			<div class="btn-group filtergroup" >
			  <button type="button" id="depmet" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				How it was done <span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu" id="depmetmenu">
				<li><a href="#methodfilter" data-method="">All Methods</a></li>
				<?php
				
				$field_key = "field_570d4d3b389ea";
				$field = get_field_object($field_key);

				if( $field )
				{
						foreach( $field['choices'] as $k => $v )
						{

							if (in_array($k, $methodsavb)) {
							 
							?><li><a href="#methodfilter" data-method="<?php echo $k; ?>" class="filter" data-filter="method"><?php echo $v; ?></a></li><?php

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

					<div class="col-xs-12 col-sm-6 col-lg-4 masonry-item">
						<?php get_template_part( 'activityloop', get_post_format() ); ?>
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
