<?php get_header(); ?>

<div id="content" class="narrowcolumn">

<!-- This sets the $curauth variable -->

<?php
  $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
  $user_info = get_userdata($curauth->ID);
	$excerpt = $user_info->description;
	$hubemail = $user_info->user_email;
	$image_id = get_field('hub_logo','user_'.$curauth->ID);
	$image = wp_get_attachment_image_src($image_id,"medium");
	$hub_id = $curauth->ID;
  $hub_name = get_field('organization_name');
  ?>

  <header class="entry-header">
  	<div class="row">
  		<div class="col-xs-12 col-sm-6 col-lg-4" style="text-align:center;">
  		    <img src="<?php echo $image[0]; ?>" class="img-responsive"/>
  		</div>
  	</div>

    <div class="row" style="margin-top:1em;">
  		<div class="col-xs-12">
        <p class="before-header"><a href="/hubs/">Hub</a></p>
        <a href="/author/<?php echo $author_name; ?>/" title="<?php the_title_attribute(); ?>" class="hub-title">
  	       <h1><?php echo the_field('organization_name','user_'.$hub_id); ?></h1>
        </a>
	      <p class="lead"><?php echo esc_html($excerpt); ?></p>
      </div>
    </div>
  </header>

	<p><a href="<?php echo $curauth->user_url; ?>"><?php echo $curauth->user_url; ?></a></p>

  <?php
	$location = get_field('organization_location','user_'.$hub_id);
  if ( $location['address'] ) : ?>
	<h2 id="location">Hub location</h2>
	<p>
	<?php


		echo $location['address'];

		?><img src="https://api.tiles.mapbox.com/v3/deklerk.map-57h1d46y/url-bit.ly%2F18KNEkg(<?php echo $location['lng'];?>,<?php echo $location['lat'];?>)/<?php echo $location['lng'];?>,<?php echo $location['lat'];?>,4/1000x300.png" class="img-rounded img-responsive">
	</p>
	<?php endif; ?>

	<?php if ( get_field('organization_profile','user_'.$hub_id) ) : ?>
		<h2 id="about">About this hub</h2>
	<?php endif; ?>
	<?php echo the_field('organization_profile','user_'.$hub_id); ?>

	<h2 id="contact">Contact <?php echo the_field('organization_name','user_'.$hub_id); ?></h2>
	<?php

	echo do_shortcode( '[contact-form-7 id="6076" title="Hub Contact"]' ); ?>

    <h2 id="activities">Activities organized by this hub</h2>

<!-- The Loop -->

	<?php

  // echo $hub_id;

	$postsone = new WP_Query(array(
		'post_type'			=> 'activity',
		'nopaging' 			=> true,
		'author__in'			=> $hub_id
	));

	$posts = $postsone;


	if( $posts->have_posts() ): ?>

				<div id="masonry" class="row">

	<?php while ( $posts->have_posts()) : $posts->the_post();

		setup_postdata( $posts )

		?>

		<?php get_template_part( 'activityloop', get_post_format() ); ?>

	<?php endwhile; ?>
			</div>

	<?php wp_reset_query(); ?>

<?php else: ?>
        <p><?php _e('No activities organized by this hub at this time.'); ?></p>

    <?php endif; ?>

<!-- End Loop -->

    <h2 id="involving">Activities involving this hub</h2>

<!-- The Loop -->

	<?php

	$poststwo = get_posts(array(
		'post_type'			=> 'activity',
		'nopaging' 			=> true,
		'meta_query'		=> array(
			'relation'		=> 'OR',
			array(
				'key'	=> 'partner', // 'User' field type
				'value' => sprintf(':"%s";', $hub_id),
				'compare' => 'LIKE'
			)
		)
	));

	$posts = $poststwo;


	if( $posts ): ?>

		<div id="masonryb" class="row">

			<?php foreach( $posts as $post ):

			setup_postdata( $post )

			?>

			<?php get_template_part( 'activityloop', get_post_format() ); ?>

			<?php endforeach; ?>
		</div>

	<?php wp_reset_postdata(); ?>

<?php else: ?>
        <p><?php _e('No activities involving this hub at this time.'); ?></p>

<?php endif; ?>

<!-- End Loop -->

</div>

<?php wp_reset_postdata(); ?>

<h2 id="topics">Topics started by this hub</h2>

<!-- The Loop -->

<?php

// echo $hub_id;

$poststhree = new WP_Query(array(
'post_type'			=> 'discussion-topics',
'nopaging' 			=> true,
'author__in'			=> $hub_id
));

$posts = $poststhree;


if( $posts->have_posts() ): ?>

    <div id="masonry" class="row">

<?php while ( $posts->have_posts()) : $posts->the_post();

setup_postdata( $posts )

?>

<?php get_template_part( 'activityloop', get_post_format() ); ?>

<?php endwhile; ?>
  </div>

<?php wp_reset_query(); ?>

<?php else: ?>
    <p><?php _e('No topics started by this hub at this time.'); ?></p>

<?php endif; ?>

<!-- End Loop -->

<div class="site-sidebar no-print">
  <a href="#">
  <h4><?php echo $hub_name; ?></h4>
  </a>

  <h5>Contents</h5>
      <ul style="list-style: none;padding-left: 10px;">
      <li><a href="#location">Location</a></li>
      <li><a href="#about">About</a></li>
      <li><a href="#contact">Contact</a></li>
      <?php if(count($postsone) > 0): ?>
      <li><a href="#activities">Activities organized by <?php echo $hub_name; ?></a></li>
      <?php endif; ?>
      <?php if(count($poststwo) > 0): ?>
      <li><a href="#involving">Activities involving <?php echo $hub_name; ?></a></li>
      <?php endif; ?>
      <?php if(count($poststhree) > 0): ?>
      <li><a href="#topics">Topics started by <?php echo $hub_name; ?></a></li>
      <?php endif; ?>
  </ul>
  <?php if(current_user_can('edit_post')): ?>
  <a href="/wp-admin/user-edit.php?user_id=<?php echo $hub_id; ?>">
    <h5><i class="fa fa-pencil" aria-hidden="true"></i> &nbsp; <?php echo get_post_status() == 'draft' ? 'Edit draft' : 'Edit'; ?></h5>
  </a>
  <?php endif; ?>
</div>

<script type="text/javascript" charset="utf-8">
  function toggleDisplay(offset) {
    var $window = $(window);
    return function() {
      if($window.scrollTop() > offset) {
  	    if ($( window ).width() > 1200) {
    		    $('.site-sidebar').fadeIn();
    		}
  	  } else {
    	  if ($( window ).width() > 1200) {
    		    $('.site-sidebar').fadeOut();
    		}
  	  }
    }
  }
  function initContentNavigation() {
    var header = $('.before-header');
  	var offset = header.offset().top;
    var toggleMenu = toggleDisplay(offset);
      window.tm = toggleMenu;
  	$(window).on('scroll', toggleMenu);
  	toggleMenu();
    if($('#wpadminbar').exists()) {
      header.addClass('with-wpadminbar');
    }
  };

  $(window).load(function() {
    var $flexslider = $('.flexslider');
    if($flexslider.exists()) {
      $flexslider.flexslider({ start: initContentNavigation });
    } else {
      // If activitiy image gallery is empty
      initContentNavigation();
    }
  });
</script>
<?php get_footer(); ?>
