<?php
/**
 * Template Name: All the Stations
 *
 */
 
 $type_options = array('small'=>'<i class="fa fa-train" aria-hidden="true"></i>',
 						'medium' => '<i class="fa fa-industry" aria-hidden="true"></i>',
 						'large' => '<i class="fa fa-globe" aria-hidden="true"></i>');

	$blogusers = get_users('role=station&orderby=nicename&order=DESC');
	 
	$geojson = array( 'type' => 'FeatureCollection', 'features' => array() );
	 
	// Array of WP_User objects.
	foreach ( $blogusers as $user ) {
		$user_info = get_userdata($user->ID);
		$station = get_field('organization_name','user_'.$user->ID);
		$location = get_field('organization_location','user_'.$user->ID);
		$excerpt = $user_info->description;

		if ($location['lng']>0) {

			$feature = array(
				'type' => 'Feature', 
			  'geometry' => array(
				'type' => 'Point',
				'coordinates' => array($location['lng'],$location['lat'])
					),
			  'properties' => array(
					'name' => $station,
					'description' => esc_html($excerpt)."<br/>",
					'link' => 'author/'.$user->user_login,
					'marker-color' => '#ffe267',
					'marker-symbol' => 'industrial'
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
				<p>If you want to become a hub, <a href="/about/">contact us</a>.</p>
			</div>
			</div>
		
			<div class="row">
				<div id='map'></div>
				<p></p>
			</div>
		
		</article>
		
			<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.16.0/mapbox-gl.js'></script>
			<script type='text/javascript'>

			console.log(<?php echo $mapjson; ?>);

			mapboxgl.accessToken = 'pk.eyJ1IjoiZGVrbGVyayIsImEiOiIyLXpKZDFvIn0.qiF1bsGVvvMt6EapjAs6pQ';
			var map = new mapboxgl.Map({
				container: 'map', // container id
				style: 'mapbox://styles/deklerk/cimdn7icb00gy9pm0abrzrgj1', //stylesheet location
				center: [11, 48], // starting position
				zoom: 3 // starting zoom
			});

			map.addControl(new mapboxgl.Navigation());

			map.scrollZoom.disable();
			map.doubleClickZoom.disable();

			map.on('style.load', function () {
		

				map.addSource("markers", {
					"type": "geojson",
					"data": <?php echo $mapjson; ?>,
					"cluster": false
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
						"text-size": 9,
						"text-anchor": "top",
						"icon-offset": [0,1]
					},
					"paint": {
						"icon-color": "#ffffff",
						"text-color": "#ffffff"
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
					.setHTML('<h3>' + feature.properties.name + '</h3>' + 
							'<p>' + feature.properties.description +'</p>' + 
							'<p><a href="http://europegrandcentral.net/'+feature.properties.link+'">read more</a></p>')
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
			
			$arg = array(
					'meta_key'		=> 'station_type',
					'meta_value'	=> sprintf('%s";', $k),
					'meta_compare'	=>'LIKE'
			);
			
			$bloguser = get_users($arg);

			if ( $bloguser ) : ?>
				<div class="row">

					<div id="masonry" class="row">
					<?php foreach ( $bloguser as $hub ) { ?>

						<div class="col-xs-6 col-sm-4 col-lg-4 masonry-item" style="text-align:center;">
							<a href="/author/<?php echo $user->user_login; ?>/">
							<img src="<?php the_field('organization_logo','user_'.$hub->ID) ?>" class="img-responsive"/>
							<p><?php the_field('organization_name','user_'.$hub->ID) ?></p>
							</a>
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
