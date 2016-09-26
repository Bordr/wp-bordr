<?php
/*
Template Name: Database Preview
*/

get_header();

global $wp_query;

	include "/home/154870/domains/bordr.org/html/crossings/connect.php";
	
	if (empty($_GET['border_name'])) {
	
		if ($wp_query->query_vars['travdept']) { $brdr_cnt = " WHERE rel_dep = '".$wp_query->query_vars['travdept']."' "; } else { $brdr_cnt = ""; }

		// Number of borders
		$query = "SELECT count(*) as borders_crossed FROM app_borders ".$brdr_cnt."";
		$results = mysql_query($query);

		while ($row = mysql_fetch_object($results)) {	
			$num_borders = $row->borders_crossed;
		}

	} 

	if ($wp_query->query_vars['travdept']) {
		$args=array(
			'name'           => $wp_query->query_vars['travdept'],
			'post_type'      => 'departure',
			'post_status'    => 'publish',
			'posts_per_page' => 1
		);
		$my_posts = get_posts( $args );
		if( $my_posts ) {
			$page_title = "Crossings from the " . get_field('from',$my_posts[0]->ID)." - ".get_field('to',$my_posts[0]->ID) . " Departure";
			$page_desc = "as part of the <b>".get_field('from',$my_posts[0]->ID)." - ".get_field('to',$my_posts[0]->ID)."</b> departure";
			$page_filter = "";
			$default_filter = $wp_query->query_vars['travdept'];
			$default_filter_title = get_field('from',$my_posts[0]->ID)." - ".get_field('to',$my_posts[0]->ID);
		}
	} else {
		$page_title = get_the_title();
		$default_filter = "";
		$default_filter_title = "All";
	}

?>

	<div class="row">
		<main id="content" class="col-md-12 col-lg-12 col-md-offset-0 col-lg-offset-0 content-area" role="main">

			<div class="row">
			
				<div class="col-xs-12">
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'box' ); ?> style="margin-bottom:0px;">
						<div class="row">
						<div class="col-sm-12 col-med-6 col-lg-6">
							<h1 class="entry-title"><?php echo $page_title; ?></h1>
						</div>
						<div class="col-sm-12 col-med-6 col-lg-6" style="text-align:right;">
							<button type="button" id="postbtn" class="btn btn-primary start">Book Your Border Story</button>
						</div>

						<!-- .entry-header --></div>
					</article>
				</div>
			
				<div class="col-xs-12">
					<article class="box archive-header hidden-md hidden-sm hidden-xs" style="padding:0px;">
							<div class="graph" id="graph"></div>
							<?
							include('d3/borderviz.php');
							?>
					</article>
					
				</div>	
			
			
				<div class="col-xs-12">
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'box' ); ?>>
						<div class="clearfix entry-content">
						  <?php if ($wp_query->query_vars['travdept']) { ?>
						  <div class="row">
						  	<div class="col-sm-8">
							  <p class="lead">This is a database of border-stories. Currently it contains <?php echo number_format($num_borders, 0, '', ','); ?> entries <? echo $page_desc; ?>. Every story is similar to others.</p>
							  <p><a href="/crossing/" id="brdrdepart" data-deft="<?php echo $default_filter; ?>">View crossing from all departures</a></p>
							</div>
						  </div>
						  						  
						  <?php } else { ?>
						  <div class="row">
						  	<div class="col-sm-8">
							  <p class="lead">This is a database of border-stories. Currently it contains <?php echo number_format($num_borders, 0, '', ','); ?> entries <? echo $page_desc; ?>. Every story is similar to others.</p>
							  <h2>Explore borders</h2>
							</div>
						  </div>
						  <div class="row">
						  	<div class="col-sm-12">
								<div class="btn-group filtergroup">
								  <button type="button" id="brdrcat" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Select a quality <span class="caret"></span>
								  </button>
								  <ul class="dropdown-menu" id="brdrcatmenu">
									<li><a href="#categoryfilter" data-cat="recent">Recently crossed</a></li>
									<li><a href="#categoryfilter" data-cat="visi">Visible</a></li>
									<li><a href="#categoryfilter" data-cat="invi">Invisible</a></li>
									<li><a href="#categoryfilter" data-cat="impo">Important</a></li>
									<li><a href="#categoryfilter" data-cat="unim">Unimportant</a></li>
									<li><a href="#categoryfilter" data-cat="posi">Positive</a></li>
									<li><a href="#categoryfilter" data-cat="nega">Negative</a></li>
									<li><a href="#categoryfilter" data-cat="natu">Natural</a></li>
									<li><a href="#categoryfilter" data-cat="arti">Artificial</a></li>
									<li><a href="#categoryfilter" data-cat="time">Time consuming</a></li>
									<li><a href="#categoryfilter" data-cat="quic">Quickly crossed</a></li>
									<li><a href="#categoryfilter" data-cat="expe">Expensive</a></li>
									<li><a href="#categoryfilter" data-cat="chep">Cheap</a></li>
									<li><a href="#categoryfilter" data-cat="risk">Risky</a></li>
									<li><a href="#categoryfilter" data-cat="safe">Safe</a></li>
								  </ul>
								</div>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<div class="btn-group filtergroup">
								  <button type="button" id="brdrdepart" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" data-deft="<?php echo $default_filter; ?>" aria-haspopup="true" aria-expanded="false">
									Select a departure <span class="caret"></span>
								  </button>
								  <ul class="dropdown-menu" id="brdrdepartmenu">
									<li><a href="#departfilter" data-depart="">All</a></li>
									<!-- The Loop -->

										<?php

										$posts = get_posts(array(
											'post_type' => 'departure',
											'posts_per_page' => 20 
										));
	
										if( $posts ): 

											include "/home/154870/domains/bordr.org/html/crossings/connect.php";										
										
											?>
	
											<?php foreach( $posts as $post ): 

												setup_postdata( $post );		
											
												$post_slug=$post->post_name;
 
												if ($post_slug) {

													$brdr_cnt = " WHERE rel_dep = '".$post_slug."' "; 

													// Number of borders
													$query = "SELECT count(*) as borders_crossed FROM app_borders ".$brdr_cnt."";
													$results = mysql_query($query);

													while ($row = mysql_fetch_object($results)) {	
														$num_borders = $row->borders_crossed;
													}

												} 

												?>
												<?php if ( $num_borders > 0 ) : ?>		
													<li><a href="#departfilter" data-depart="<?php echo $post->post_name; ?>">
														<?php the_field('from'); ?> — <?php the_field('to'); ?>
														</a>
													</li>
												<?php endif; ?>
	
											<?php endforeach; ?>
	
											<?php wp_reset_postdata(); ?>

										<?php endif; ?>

									<!-- End Loop -->
								  </ul>
								</div>
							</div>
							  <?php } ?>
						</div>
					</article>
				</div>
				<div class="col-xs-12">
					<article <?php post_class( 'box' ); ?>>
						<header class="entry-header">
							<h2 id="categoryfilter" class="entry-title">Recently Crossed Borders</h2>
						</header>
					</article>
					
						<div id="feedProfile" data-story="<?php echo $_GET['story']; ?>"><p><img class="filtergroup" src="<?php echo get_template_directory_uri(); ?>/img/loading-bar.gif"/></p></div>
				</div>	
			</div>
		</main>
	</div>


<?php get_footer();

	function format_uri( $string, $separator = '-' )
	{
		$accents_regex = '~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i';
		$special_cases = array( '&' => 'and');
		$string = mb_strtolower( trim( $string ), 'UTF-8' );
		$string = str_replace( array_keys($special_cases), array_values( $special_cases), $string );
		$string = preg_replace( $accents_regex, '$1', htmlentities( $string, ENT_QUOTES, 'UTF-8' ) );
		$string = preg_replace("/[^a-z0-9]/u", "$separator", $string);
		$string = preg_replace("/[$separator]+/u", "$separator", $string);
		return $string;
	}

?>