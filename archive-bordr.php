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
				0 => '<a href="#charfilter" data-charval="1" data-char="brdr_invisible_visible" class="filter" data-filter="char">Invisible</a>', 
				100 => '<a href="#charfilter" data-charval="100" data-char="brdr_invisible_visible" class="filter" data-filter="char">Visible</a>'),
			'brdr_negative_positive'=>array(
				0 => '<a href="#charfilter" data-charval="1" data-char="brdr_negative_positive" class="filter" data-filter="char">Negative</a>', 
				100 => '<a href="#charfilter" data-charval="100" data-char="brdr_negative_positive" class="filter" data-filter="char">Positive</a>'),
			'brdr_unimportant_important'=>array(
				0 => '<a href="#charfilter" data-charval="1" data-char="brdr_unimportant_important" class="filter" data-filter="char">Unimportant</a>', 
				100 => '<a href="#charfilter" data-charval="100" data-char="brdr_unimportant_important" class="filter" data-filter="char">Important</a>')
		);
		
		$rel_act = array(); 
		$charsavb = array();
		if ( have_posts() ) : 
			while ( have_posts() ) : the_post(); 

			$rel_act[] = get_field('related_activity');

					
			foreach ($char_options as $char_name => $char_ignore) {
				if (get_field($char_name) == TRUE) {
					$charval = get_field($char_name);
					$charsavb[$char_name][] = round($charval/100)*100;
				}
			}
			
			endwhile;

			sort($rel_act);
			
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
			<!---
			<div class="btn-group filtergroup" >
			  <button type="button" id="brdrchar" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				By characteristics <span class="caret"></span>
			  </button>
				  <ul class="dropdown-menu" id="brdrcharmenu">
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
			--->
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

		<?php if ( !is_category( 'notes' )) { get_sidebar(); } ?>
	<!-- .row --></div>

<?php get_footer(); ?>
