<?php get_header(); ?>

<div id="content" class="narrowcolumn">

<!-- This sets the $curauth variable -->

    <?php
    $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
    
    $user_info = get_userdata($curauth->ID);
	$excerpt = $user_info->description;
		
    ?>
    
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-lg-3" style="text-align:center;">
		<img src="<?php the_field('organization_logo','user_'.$curauth->ID) ?>" class="img-responsive"/>
		</div>
	</div>

	<h1>Hub: <?php echo the_field('organization_name'); ?></h1>

	<p class="lead"><?php echo esc_html($excerpt); ?></p>

	<h2>Hub location</h2>
	<p>
	<?php
		$location = get_field('organization_location');
		
		echo $location['address'];
		
		?><img src="https://api.tiles.mapbox.com/v3/deklerk.map-57h1d46y/url-bit.ly%2F18KNEkg(<?php echo $location['lng'];?>,<?php echo $location['lat'];?>)/<?php echo $location['lng'];?>,<?php echo $location['lat'];?>,4/1000x300.png" class="img-rounded img-responsive">
	</p>

	<?php if ( get_field('organization_profile') ) : ?>
		<h2>About this hub</h2>
	<?php endif; ?>
	<?php echo the_field('organization_profile'); ?>

    <h2>Activities involving this hub</h2>

<!-- The Loop -->

	<?php
	
	$postsone = get_posts(array(
		'post_type'			=> 'activity',
		'author'			=> $curauth->ID
	));

	$poststwo = get_posts(array(
		'post_type'			=> 'activity',
		'meta_query'		=> array(
			'relation'		=> 'OR', 
			array(
				'key'	=> 'partner', // 'User' field type
				'value' => sprintf(':"%s";', $curauth->ID),
				'compare' => 'LIKE'
			)
		)
	));
	
	$posts = array_merge($postsone,$poststwo);

	
	if( $posts ): ?>
	
				<div id="masonry" class="row">
		
	<?php foreach( $posts as $post ): 
		
		setup_postdata( $post )
		
		?>

					<div class="col-xs-12 col-sm-6 col-lg-4 masonry-item">
						<?php get_template_part( 'activityloop', get_post_format() ); ?>
					</div>

	<?php endforeach; ?>
			</div>
	
	<?php wp_reset_postdata(); ?>

<?php else: ?>
        <p><?php _e('No activities from this hub at this time.'); ?></p>

    <?php endif; ?>

<!-- End Loop -->

	<h2>Website</h2>
	<p><a href="<?php echo $curauth->user_url; ?>"><?php echo $curauth->user_url; ?></a></p>

</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>