<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Nu Themes
 */
 
	$blogusers = get_users('role=station');
	 
	$geojson = array( 'type' => 'FeatureCollection', 'features' => array() );
	 
	// Array of WP_User objects.
	foreach ( $blogusers as $user ) {
		$user_info = get_userdata($user->ID);
		$station = get_field('organization_name','user_'.$user->ID);
		$location = get_field('organization_location','user_'.$user->ID);
		$excerpt = $user_info->description;

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
 
	$mapjson = json_encode($geojson);
 
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'box' ); ?>>
	<header class="entry-header">
		<h1 class="archive-title"><?php the_title(); ?></h1>
	<!-- .entry-header --></header>

	<div class="clearfix entry-content">

		<?php the_content();
		
		 ?>

	<!-- .entry-content --></div>
			<div id='map'></div>
<!-- #post-<?php the_ID(); ?> --></article>

<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.16.0/mapbox-gl.js'></script>
<script type='text/javascript'>
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
