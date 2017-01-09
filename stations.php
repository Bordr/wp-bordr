<?php
/**
 * Template Name: All the Stations
 *
 */
 
 $type_options = array('small'=>'<i class="fa fa-train" aria-hidden="true"></i>',
 						'medium' => '<i class="fa fa-industry" aria-hidden="true"></i>',
 						'large' => '<i class="fa fa-globe" aria-hidden="true"></i>');

 $map_icos = array('small'=>'rail',
 						'medium' => 'industrial',
 						'large' => 'soccer');

	$blogusers = get_users('role=hub&orderby=nicename&order=DESC');
	 
	$geojson = array( 'type' => 'FeatureCollection', 'features' => array() );
	 
	// Array of WP_User objects.
	foreach ( $blogusers as $user ) {
		$user_info = get_userdata($user->ID);
		$hub = get_field('organization_name','user_'.$user->ID);
		$location = get_field('organization_location','user_'.$user->ID);
		$excerpt = $user_info->description;
		$hub_type = get_field('hub_type','user_'.$user->ID);
		
		if (!$hub_type[0]) { $hub_itype = 'small'; } else { $hub_itype = $hub_type[0]; } 

		if ($location['lng']>0||$location['lng']<0) {

			$feature = array(
				'type' => 'Feature', 
			  'geometry' => array(
				'type' => 'Point',
				'coordinates' => array($location['lng'],$location['lat'])
					),
			  'properties' => array(
					'name' => $hub,
					'description' => esc_html($excerpt)."<br/>",
					'link' => 'author/'.$user->user_login,
					'marker-color' => '#ffe267',
					'marker-symbol' => $map_icos[$hub_itype]
					)
				);
			array_push($geojson['features'], $feature);

		}

	}
 
	$mapjson = json_encode($geojson);

get_header(); ?>

	<div class="row">
		<main id="content" class="col-sm-12 content-area" role="main">		
		<article class="page" style="margin-bottom:0px;" >
			<div class="row">
				<div class="col-xs-12 col-sm-9 col-lg-9">
					<h1 class="entry-title" style="font-size:24px;">Hubs</h1>
					<p>A hub is an organization or individual that work with audiences to explore borders</p>
				</div>
				<div class="col-xs-12 col-sm-3 col-lg-3" style="text-align:right;" >
					<a href="/join/" class="btn btn-primary start">Request to Join</a>
				</div>
			</div>
		
			<div class="row">
				<div id='map'></div>
				<p></p>
			</div>
		
		</article>

			<script src='//api.tiles.mapbox.com/mapbox-gl-js/v0.25.1/mapbox-gl.js'></script>		
			<script type='text/javascript'>

			mapboxgl.accessToken = 'pk.eyJ1IjoiZGVrbGVyayIsImEiOiIyLXpKZDFvIn0.qiF1bsGVvvMt6EapjAs6pQ';
			var map = new mapboxgl.Map({
				container: 'map', // container id
				style: 'mapbox://styles/deklerk/ciu4zljnr00bb2hq5nkk9bfyr', //stylesheet location
				center: [11, 48], // starting position
				zoom: 1 // starting zoom
			});

			map.addControl(new mapboxgl.Navigation());

			map.scrollZoom.disable();

			map.on('style.load', function () {
		

				map.addSource("markers", {
					type: "geojson",
					data: <?php echo $mapjson; ?>,
					cluster: true,
					clusterMaxZoom: 14, // Max zoom to cluster points on
					clusterRadius: 50 // Radius of each cluster when clustering points (defaults to 50)
				});

				map.addLayer({
					"id": "markers",
					"interactive": true,
					"type": "symbol",
					"source": "markers",
					"layout": {
						"icon-image": "{marker-symbol}-24",
						"text-field": "{name}",
						"text-offset": [0, 1],
						"text-size": 10,
						"text-anchor": "top",
						"icon-offset": [0,1]
					},
					"paint": {
						"icon-color": "#000",
						"text-color": "#000",
						"text-halo-color": "#fff",
						"text-halo-width": 1,
						"text-halo-blur": 1
					}
				});

				// Display the earthquake data in three layers, each filtered to a range of
				// count values. Each range gets a different fill color.
				var layers = [
					[150, '#fff'],
					[20, '#fff'],
					[0, '#fff']
				];

				layers.forEach(function (layer, i) {
					map.addLayer({
						"id": "cluster-" + i,
						"type": "circle",
						"source": "markers",
						"paint": {
							"circle-color": layer[1],
							"circle-radius": 10
						},
						"filter": i === 0 ?
							[">=", "point_count", layer[0]] :
							["all",
								[">=", "point_count", layer[0]],
								["<", "point_count", layers[i - 1][0]]]
					});
				});

				// Add a layer for the clusters' count labels
				map.addLayer({
					"id": "cluster-count",
					"type": "symbol",
					"source": "markers",
					"layout": {
						"text-field": "{point_count}",
						"text-font": [
							"DIN Offc Pro Medium",
							"Arial Unicode MS Bold"
						],
						"text-size": 10
					}
				});
		
			});

			// When a click event occurs near a marker icon, open a popup at the location of
			// the feature, with description HTML from its properties.
			map.on('click', function (e) {
				var features = map.queryRenderedFeatures(e.point, { layers: ['markers'] });

				if (!features.length) {
					return;
				}

				var feature = features[0];

				// Populate the popup and set its coordinates
				// based on the feature found.
				var popup = new mapboxgl.Popup()
					.setLngLat(feature.geometry.coordinates)
					.setHTML('<h4>' + feature.properties.name + '</h4>' + 
							'<p>' + feature.properties.description +'</p>' + 
							'<p><a href="http://globalgrandcentral.net/'+feature.properties.link+'">read more</a></p>')
					.addTo(map);
			});

			// Use the same approach as above to indicate that the symbols are clickable
			// by changing the cursor style to 'pointer'.
			map.on('mousemove', function (e) {
				var features = map.queryRenderedFeatures(e.point, { layers: ['markers'] });
				map.getCanvas().style.cursor = (features.length) ? 'pointer' : '';
			});
	
			</script>
		
		<?php
		wp_reset_query();
		$field_key = "field_57cf284c77dce";
		$field = get_field_object($field_key);
		
		asort($field['choices']);

		if( $field )
		{
			foreach( $field['choices'] as $k => $v )
			{
			?><h2><?php echo $type_options[$k]; ?> <?php echo $v; ?></h2><?php
			
			$arg = array('meta_query' => array('relation' => 'AND', array(
					'key'		=> 'hub_type',
					'value'	=> sprintf('%s";', $k),
					'compare'	=>'LIKE'
			), array(
					'key'		=> 'hub_logo',
					'value'		=> 0,
					'compare'	=>'>'
			)));
			
			$bloguser = get_users($arg);

			if ( $bloguser ) : ?>
				<div class="row">

					<div id="masonry" class="row">
					<?php foreach ( $bloguser as $hub ) {  
					
						$image_id = get_field('hub_logo','user_'.$hub->ID);
						$image = wp_get_attachment_image_src($image_id,"thumbnail");
						
						?>
						<div class="col-xs-6 col-sm-3 col-lg-3 masonry-item" style="text-align:center;">
							<article class="box">
								<a href="/author/<?php echo $hub->user_login; ?>/">
								<img src="<?php echo $image[0]; ?>"/>
								<p><?php the_field('organization_name','user_'.$hub->ID) ?></p>
								</a>
							</article>
						</div>

					<?php } ?>

				<!-- #masonry --></div>
				</div>
		
			<?php else : ?>

				<?php get_template_part( 'no-results', 'archive' ); ?>

			<?php endif;

		
			}
		}
		?>

		</div>
		<!-- #content --></main>
	<!-- .row --></div>

<?php get_footer(); ?>
