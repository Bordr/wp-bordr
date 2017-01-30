<?php

// OPEN GRAPH

function doctype_opengraph($output) {
    return $output . '
    xmlns:og="http://opengraphprotocol.org/schema/"
    xmlns:fb="http://www.facebook.com/2008/fbml"';
}
add_filter('language_attributes', 'doctype_opengraph');

function fb_opengraph() {
    global $post;
    
    ?>
    <meta property="fb:app_id" content="1699080173711636"/>
    <?php
 
	if ( is_singular( 'bordr' ) ) {
        if(get_field('brdr_image')) {
			$image = get_field('brdr_image');
			$img_src = $image['sizes'][ 'large' ];
			if ($image['sizes'][ 'large-width' ] < 200 || $image['sizes'][ 'large-height' ] < 200) {
				$img_src = get_stylesheet_directory_uri() . '/img/egc_bg-cremesoda_400x300.jpg';			
			}
        } else {
            $img_src = get_stylesheet_directory_uri() . '/img/egc_bg-cremesoda_400x300.jpg';
        }
        if(get_field('brdr_story') != '') {
			$excerpt = get_field('brdr_story');
            $excerpt = str_replace("", "'", $excerpt);
        } else {
            $excerpt = get_bloginfo('description');
        }
        ?>
 
    <meta property="og:title" content="<?php echo the_title(); ?>"/>
    <meta property="og:description" content="<?php echo $excerpt; ?>"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="<?php echo the_permalink(); ?>"/>
    <meta property="og:site_name" content="<?php echo get_bloginfo(); ?>"/>
    <meta property="og:image" content="<?php echo $img_src; ?>"/>
    
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:site" content="@glograndcentral">
	<meta name="twitter:title" content="<?php echo the_title(); ?>">
	<meta name="twitter:description" content="<?php echo $excerpt; ?>">
	<meta name="twitter:image" content="<?php echo $img_src; ?>">
 
<?php
    } else if ( is_singular( 'activity' ) ) {
        if(get_field('departure_images')) {
			$image = get_field('departure_images');
			$img_src = $image[0]['sizes']['large'];
			if ($image[0]['sizes'][ 'large-width' ] < 200 || $image[0]['sizes'][ 'large-height' ] < 200) {
				$img_src = get_stylesheet_directory_uri() . '/img/egc_bg-cremesoda_400x300.jpg';			
			}
        } else {
            $img_src = get_stylesheet_directory_uri() . '/img/egc_bg-cremesoda_400x300.jpg';
        }
        if(get_field('brief_description') != '') {
			$excerpt = get_field('brief_description');
            $excerpt = str_replace("", "'", $excerpt);
        } else {
            $excerpt = get_bloginfo('description');
        }
        ?>
 
    <meta property="og:title" content="<?php echo the_title(); ?>"/>
    <meta property="og:description" content="<?php echo $excerpt; ?>"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="<?php echo the_permalink(); ?>"/>
    <meta property="og:site_name" content="<?php echo get_bloginfo(); ?>"/>
    <meta property="og:image" content="<?php echo $img_src; ?>"/>
 
 	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:site" content="@glograndcentral">
	<meta name="twitter:title" content="<?php echo the_title(); ?>">
	<meta name="twitter:description" content="<?php echo $excerpt; ?>">
	<meta name="twitter:image" content="<?php echo $img_src; ?>">
 
<?php
    } else if ( is_page() ) {
        if(has_post_thumbnail() ) {
			$image_src = the_post_thumbnail_url('large');
        } else {
            $img_src = get_stylesheet_directory_uri() . '/img/egc_bg-cremesoda_400x300.jpg';
        }
        if(get_the_excerpt()) {
			$excerpt = get_the_excerpt();
            $excerpt = str_replace("", "'", $excerpt);
        } else {
            $excerpt = get_bloginfo('description');
        }
        ?>
 
    <meta property="og:title" content="<?php echo the_title(); ?>"/>
    <meta property="og:description" content="<?php echo $excerpt; ?>"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="<?php echo the_permalink(); ?>"/>
    <meta property="og:site_name" content="<?php echo get_bloginfo(); ?>"/>
    <meta property="og:image" content="<?php echo $img_src; ?>"/>

	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:site" content="@glograndcentral">
	<meta name="twitter:title" content="<?php echo the_title(); ?>">
	<meta name="twitter:description" content="<?php echo $excerpt; ?>">
	<meta name="twitter:image" content="<?php echo $img_src; ?>">
 
<?php
    } else if ( is_post_type_archive( 'bordr' ) ) {
		$img_src = get_stylesheet_directory_uri() . '/img/egc_logo_600x340.jpg';			
?>
 
    <meta property="og:title" content="Bordr Stories"/>
    <meta property="og:description" content="Bordrs are stories, impressions, experiences of a border."/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="<?php echo esc_url( get_post_type_archive_link( 'bordr' ) ); ?>"/>
    <meta property="og:site_name" content="<?php echo get_bloginfo(); ?>"/>
    <meta property="og:image" content="<?php echo $img_src; ?>"/>

	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:site" content="@glograndcentral">
	<meta name="twitter:title" content="Bordr Stories">
	<meta name="twitter:description" content="Bordrs are stories, impressions, experiences of a border.">
	<meta name="twitter:image" content="<?php echo $img_src; ?>">
 
<?php
    } else if ( is_author() ) {
        if(get_field('organization_logo')) {
			$image = get_field('organization_logo');
			$img_src = $image[0]['sizes']['large'];
			if ($image[0]['sizes'][ 'large-width' ] < 200 || $image[0]['sizes'][ 'large-height' ] < 200) {
				$img_src = get_stylesheet_directory_uri() . '/img/egc_bg-cremesoda_400x300.jpg';			
			}
        } else {
            $img_src = get_stylesheet_directory_uri() . '/img/egc_bg-cremesoda_400x300.jpg';
        }
        if(get_field('organization_profile') != '') {
			$excerpt = get_field('organization_profile');
            $excerpt = str_replace("", "'", $excerpt);
        } else {
            $excerpt = get_bloginfo('description');
        }			
		$excerpt = get_bloginfo('description');
?>
 
    <meta property="og:title" content="<?php echo get_field('organization_name'); ?>"/>
    <meta property="og:description" content="<?php echo $excerpt; ?>"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"/>
    <meta property="og:site_name" content="<?php echo get_bloginfo(); ?>"/>
    <meta property="og:image" content="<?php echo $img_src; ?>"/>
 
 	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:site" content="@glograndcentral">
	<meta name="twitter:title" content="<?php echo get_field('organization_name'); ?>">
	<meta name="twitter:description" content="<?php echo $excerpt; ?>">
	<meta name="twitter:image" content="<?php echo $img_src; ?>">
 
<?php
    } else if ( is_home() ) {
		$img_src = get_stylesheet_directory_uri() . '/img/egc_logo_600x340.jpg';			
		$excerpt = get_bloginfo('description');
?>
 
    <meta property="og:title" content="Global Grand Central"/>
    <meta property="og:description" content="<?php echo $excerpt; ?>"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="<?php echo esc_url( home_url() ); ?>"/>
    <meta property="og:site_name" content="<?php echo get_bloginfo(); ?>"/>
    <meta property="og:image" content="<?php echo $img_src; ?>"/>
 
  	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:site" content="@glograndcentral">
	<meta name="twitter:title" content="Global Grand Central">
	<meta name="twitter:description" content="<?php echo $excerpt; ?>">
	<meta name="twitter:image" content="<?php echo $img_src; ?>">
 
<?php
    } else {
        return;
    }
}
add_action('wp_head', 'fb_opengraph', 5);



// ADMIN FUNCTIONS

add_filter('manage_bordr_posts_columns', 'bordr_table_head');
function bordr_table_head( $defaults ) {
    $defaults['related_activity'] = 'Related Activity';
    return $defaults;
}

/**
 * Fill custom field value
 */
add_action('manage_bordr_posts_custom_column', 'bordr_table_content', 10, 2);
function bordr_table_content( $column_name, $post_id ) {

  switch ($column_name) {
    case 'title':
      $brdr_from = get_post_meta( $post_id, 'brdr_from', true );
      $brdr_to = get_post_meta( $post_id, 'brdr_to', true );
      echo $first_name . ' > ' . $last_name;
      break;

    case 'related_activity':
      $activity = get_post_meta( $post_id, 'related_activity', true );
//       $activity = get_post_meta( $activity, 'related_activity', true );
	  $activity = get_post($activity);
      echo $activity->post_title;
      break;

  }
}

add_filter('the_title', 'bordr_meta_on_title',10, 2);
function bordr_meta_on_title($title, $id) {
  if('bordr' == get_post_type($id)) {
      return get_post_meta( $id, 'brdr_from', true ).' > '.get_post_meta( $id, 'brdr_to', true );
   }
  else {
      return $title;
  }
}

add_action( 'submitpost_box', 'hidden_type_title' );

function hidden_type_title() {
    global $current_user, $post, $post_type;

    // If the current type supports the title, nothing to done, return
    if( post_type_supports( $post_type, 'title' ) )
        return;

    ?>
    <input type="hidden" name="post_title" value="" id="title" />
    <?php
}


// END ADMIN FUNCTIONS

function my_acf_init() {

	acf_update_setting('google_api_key', 'AIzaSyD46ZIXV0LS1gBcNiXMkV-Td66f0HpgNUY');
}

add_action('acf/init', 'my_acf_init');

function wpsites_home_page_cpt_filter($query) {
if ( !is_admin() && $query->is_main_query() && is_home() ) {
$query->set('post_type', array( 'activity' ) );
    }
  }

add_action('pre_get_posts','wpsites_home_page_cpt_filter');

/**
 * Sort our repeater fields array by date subfield descending
 * @param  mixed $a first
 * @param  mixed $b second
 * @return value
 */
function sort_by_date_descending($a, $b) {
    if (strtotime($a['event_date']) == strtotime($b['event_date'])) {
        return 0;
    }
    return (strtotime($a['event_date']) > strtotime($b['event_date'])) ? -1 : 1;
}

/**
 * Sort our repeater fields array by date subfield ascending
 * @param  mixed $a first
 * @param  mixed $b second
 * @return value
 */
function sort_by_date_ascending($a, $b) {
    if (strtotime($a['event_date']) == strtotime($b['event_date'])) {
        return 0;
    }
    return (strtotime($a['event_date']) < strtotime($b['event_date'])) ? -1 : 1;
}

add_action( 'admin_enqueue_scripts', function() {
    wp_enqueue_style('fontawesome', '//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css');
});

function custom_rewrite_tag() {
  add_rewrite_tag('%travdept%', '([^&]+)');
  add_rewrite_tag('%story%', '([^&]+)');
}
add_action('init', 'custom_rewrite_tag', 10, 0);

function custom_rewrite_rule() {
  add_rewrite_rule('^crossing/([^/]*)/?','index.php?page_id=219&travdept=$matches[1]','top');
}
add_action('init', 'custom_rewrite_rule', 10, 0);


add_filter( 'wp_nav_menu_items', 'my_custom_menu_item', 10, 2 );

function my_custom_menu_item( $items, $args ) {

	if ( isset( $args ) && $args->theme_location === 'primary' ) {
        $user=wp_get_current_user();
        $name=$user->display_name; // or user_login , user_firstname, user_lastname
		$loginurl=$user->user_login; // or user_login , user_firstname, user_lastname
        $items .= '<li class="menu-item menu-item-type-custom menu-item-object-custom"><a href="' . home_url() . '/author/' . $loginurl . '/" data-toggle="dropdown" class="dropdown-toggle">Hello, '.$name.' <i class="fa fa-angle-down" aria-hidden="true"></i></a><ul role="menu" class="dropdown-menu"><li class="menu-item menu-item-type-custom menu-item-object-custom"><a href="' . home_url() . '/author/' . $loginurl . '/">View Your Hub Profile</a><li class="menu-item menu-item-type-custom menu-item-object-custom"><a href="/wp-admin/profile.php">Edit Your Hub Profile</a></li><li class="menu-item menu-item-type-custom menu-item-object-custom"><a href="/wp-admin/edit.php?post_type=activity">Edit Activities</a></li><li class="menu-item menu-item-type-custom menu-item-object-custom"><a href="/wp-admin/edit.php?post_type=bordr">Edit Bordr Stories</a></li><li class="menu-item menu-item-type-custom menu-item-object-custom"><a href="/wp-admin/edit-comments.php">Moderate Comments</a></li><li class="menu-item menu-item-type-custom menu-item-object-custom"><a href="'.wp_logout_url( get_permalink() ).'">Logout</a></li></ul></li>';
	}
	return $items;
}

// Remove Bio box

add_action( 'personal_options', array ( 'T5_Hide_Profile_Bio_Box', 'start' ) );
/**
 * Captures the part with the biobox in an output buffer and removes it.
 *
 * @author Thomas Scholz, <info@toscho.de>
 *
 */
class T5_Hide_Profile_Bio_Box
{
    /**
     * Called on 'personal_options'.
     *
     * @return void
     */
    public static function start()
    {
        $action = ( IS_PROFILE_PAGE ? 'show' : 'edit' ) . '_user_profile';
        add_action( $action, array ( __CLASS__, 'stop' ) );
        ob_start();
    }

    /**
     * Strips the bio box from the buffered content.
     *
     * @return void
     */
    public static function stop()
    {
        $html = ob_get_contents();
        ob_end_clean();

        // remove the headline
        $html = str_replace( '<h2>Name</h2>', '<h2>Name of you or your hub</h2>', $html );
        $headline = __( IS_PROFILE_PAGE ? 'About Yourself' : 'About the user' );
        $html = str_replace( '<h2>' . $headline . '</h2>', '', $html );
        $html = str_replace( '<label for="nickname">Nickname', '<label for="nickname">Hub Name', $html );
        $html = str_replace( 'Biographical Info', 'Short overview of who you are (as a Hub) and what you do?', $html );
        $html = str_replace( 'Share a little biographical information to fill out your profile. This may be shown publicly.', '', $html );
        // remove the table row
//         $html = preg_replace( '~<tr class="user-description-wrap">\s*<th><label for="description".*</tr>~imsUu', '', $html );
        print $html;
    }
}


// Image upload function

function sanitize_filename_on_upload($filename) {
	$ext = end(explode('.',$filename));
	// Replace all weird characters
	$sanitized = preg_replace('/[^a-zA-Z0-9-_.]/','', substr($filename, 0, -(strlen($ext)+1)));
	// Replace dots inside filename
	$sanitized = str_replace('.','-', $sanitized);
	return strtolower($sanitized.'.'.$ext);
}
add_filter('sanitize_file_name', 'sanitize_filename_on_upload', 10);

// ONLY SHOW TO HUBS CONTENT THAT IS RELEVANT TO THEM
add_filter( 'ajax_query_attachments_args', 'show_current_user_attachments' );
function show_current_user_attachments( $query ) {
    $user_id = get_current_user_id();
	if( !current_user_can( 'edit_others_posts' ) ) {
        $query['author'] = $user_id;
	}
    return $query;
}
function posts_for_current_author($query) {
	global $pagenow;

	if( 'edit.php' != $pagenow || !$query->is_admin )
	    return $query;

	if( !current_user_can( 'edit_others_posts' ) ) {
		global $user_ID;
		$query->set('author', $user_ID );
	}
	return $query;
}
add_filter('pre_get_posts', 'posts_for_current_author');
function comments_for_current_author($query) {
	global $pagenow;

	if( 'edit-comments.php' != $pagenow )
	    return $query;

	if( !current_user_can( 'edit_others_posts' ) ) {
		global $user_ID, $wpdb;
		$clauses['join'] = ", ".$wpdb->base_prefix."posts";
		$clauses['where'] .= " AND ".$wpdb->base_prefix."posts.post_author = ".$user_ID." AND ".$wpdb->base_prefix."comments.comment_post_ID = ".$wpdb->base_prefix."posts.ID";
        return $clauses;
    	}
	return $query;
}
add_filter('comments_clauses', 'comments_for_current_author');
// END FILTER

// HIDE SOME PROFILE ELEMENTS FOR HUBS

// remove personal options block
if(is_admin()){
  add_action( 'personal_options', 'prefix_hide_personal_options' );
}
function prefix_hide_personal_options() {
?>
<script type="text/javascript">
  jQuery(document).ready(function( $ ){
    $("#your-profile .form-table:first, #your-profile h3:first").remove();
  });
</script>
<?php
}


// ACTIVITY FILTER FUNCTIONS

$GLOBALS['my_query_filters'] = array( 
	'author'	=> 'hub',
	'location'	=> 'ctry',
	'relact'	=> 'relact'
);

// array of filters (field key => field name)
$GLOBALS['my_meta_query_filters'] = array( 
	'field_1'	=> 'method', 
	'field_2'	=> 'char', 
	'field_3'	=> 'perception'
);

// action
add_action('pre_get_posts', 'my_pre_get_posts');

function my_pre_get_posts( $query ) {
	
  if( $query->is_main_query() ){

	// bail early if is in admin
	if( is_admin() ) {
		
		return;
		
	}
	
	// loop over filters
	foreach( $GLOBALS['my_query_filters'] as $key => $name ) {
		
		// continue if not found in url
		if( empty($_GET[ $name ]) ) {
			
			continue;
			
		}
		
		if ($key == "author") {
			// get the value for this filter
			// eg: http://www.website.com/events?city=melbourne,sydney
			$value = explode(',', $_GET[ $name ]);
		
		
			// append to query
			$query->set( 'author__in' , $value ); 
		}
		
		if ($key == "location") {
			$value = $_GET[ $name ];
			
			$arg = array(
					'meta_key'		=> 'organization_location',
					'meta_value'	=> sprintf('%s";', $value),
					'meta_compare'	=>'LIKE',
					'fields'	=> 'ID'
			);
			
			$ctryusers = get_users($arg);
			$query->set( 'author__in' , $ctryusers ); 
		}

		if ($key == "relact") {
			$value = $_GET[ $name ];
			
			$arg = array(
					'post_type'         => 'bordr',
					'meta_query'        => array(
						array(
							'key'   => 'related_activity',
							'value' => $value
						)
					)
			);

			$query->set('meta_query', $arg);
		}
        
	} 
	
	// get meta query
	$meta_query = $query->get('meta_query');

	
	// loop over filters
	foreach( $GLOBALS['my_meta_query_filters'] as $key => $name ) {
		
		// continue if not found in url
		if( empty($_GET[ $name ]) ) {
			
			continue;
			
		}
		
		if (isset($_GET[ $name ]) && $name == 'char') {
		
			$ckey = $_GET[ 'char' ];
			$cvalue = $_GET[ 'charval' ];

			if ($cvalue == 100) { $cvalue = 60; $compare = ">"; } 
			else { $cvalue = 40; $compare = "<"; }

			// append meta query
			$meta_query[] = array(
				'key'		=> $ckey,
				'value'		=> $cvalue,
				'compare'	=> $compare,
				'type' => 'numeric'
			);
			$meta_query[] = array(
				'key'		=> $ckey."_rel",
				'value'		=> 1,
				'compare'	=> '='
			);			
		} else if (isset($_GET[ $name ]) && $name == 'perception') {
		
			$ckey = $_GET[ 'perception' ];
			$cvalue = $_GET[ 'perceptionval' ];

			if ($cvalue == 100) { $cvalue = 60; $compare = ">"; } 
			else { $cvalue = 40; $compare = "<"; }

			// append meta query
			$meta_query[] = array(
				'key'		=> $ckey,
				'value'		=> $cvalue,
				'compare'	=> $compare,
				'type' => 'numeric'
			);
		
		} else if (isset($_GET[ $name ]) && $name == 'method') {
		
			$ckey = $_GET[ 'method' ];

			// append meta query
			$meta_query[] = array(
				'key'		=> 'method_icons',
				'value'		=> '"'.$ckey.'"',
				'compare'	=> 'LIKE'
			);
			
		} else {

			// get the value for this filter
			// eg: http://www.website.com/events?city=melbourne,sydney
			$value = explode(',', $_GET[ $name ]);

			// append meta query
			$meta_query[] = array(
				'key'		=> $key,
				'value'		=> $value,
				'compare'	=> 'IN'
			);
		}
        
	} 
	
	
	// update meta query
	$query->set('meta_query', $meta_query);

	}

}

// --- BEGIN CUSTOM POST TYPE FILTERS
add_action('acf/save_post', 'pre_save_activity', 10, 1);
function pre_save_activity($post_id) {
    // Handle custom frontend fields: title and draft

    // Bail-out if we are in admin or we are not creating an activity
    if (is_admin() || get_post_type($post_id) != 'activity') {
      return $post_id;
    }

    if ($_POST['acf']['field_588b28fa14472'][0] == 'draft') {
        $post_status = 'draft';
    } else {
        $post_status = 'publish';
    }
    $args = array(
        'ID' => $post_id,
        'post_status' => $post_status,
        'post_title' => $_POST['acf']['field_588f1624311a8']
    );
    wp_update_post($args);
    return $post_id;
}

// Hide activity draft field
add_filter('acf/prepare_field/key=field_588b28fa14472', 'hide_field_in_admin', 10, 2);
// Hide frontend activity title field
add_filter('acf/prepare_field/key=field_588f1624311a8', 'hide_field_in_admin', 10, 2);
function hide_field_in_admin($field) {
    if(is_admin()) {
        return false;
    } else {
        return $field;
    }
}

add_filter('acf/load_value/key=field_588b28fa14472', 'load_activity_draft_field_value', 10, 3);
function load_activity_draft_field_value($value, $post_id, $field) {
    return (get_post_status($post_id) == 'draft');
}

add_filter('acf/load_value/key=field_588f1624311a8', 'load_activity_title_field_value', 10, 3);
function load_activity_title_field_value($value, $post_id, $field) {
    return get_the_title($post_id);
}


// --- BEGIN CUSTOM POST TYPES
add_action( 'init', 'cptui_register_my_cpts' );
function cptui_register_my_cpts() {
	$labels = array(
		"name" => __( 'Bordrs', 'bordr' ),
		"singular_name" => __( 'Bordr', 'bordr' ),
		"menu_name" => __( 'My Bordrs', 'bordr' ),
		"all_items" => __( 'All Bordrs', 'bordr' ),
		"add_new" => __( 'Add New Bordr', 'bordr' ),
		"add_new_item" => __( 'Add New Bordr', 'bordr' ),
		"edit_item" => __( 'Edit Bordr', 'bordr' ),
		"new_item" => __( 'New Bordr', 'bordr' ),
		"view_item" => __( 'View Bordr', 'bordr' ),
		"search_items" => __( 'Search Bordrs', 'bordr' ),
		"not_found" => __( 'No Bordrs Found', 'bordr' ),
		"not_found_in_trash" => __( 'No Bordrs Found in Trash', 'bordr' ),
		"archives" => __( 'Bordr archives', 'bordr' ),
		"insert_into_item" => __( 'Insert into bordr', 'bordr' ),
		"uploaded_to_this_item" => __( 'Upload to this bordr', 'bordr' ),
		);

	$args = array(
		"label" => __( 'Bordrs', 'bordr' ),
		"labels" => $labels,
		"description" => "These are bordr stories, stories about experiences around and over metaphorical and geographic borders.",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => true,
		"show_in_menu" => true,
				"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "bordr", "with_front" => true ),
		"query_var" => true,
		"menu_icon" => "dashicons-leftright",
		"supports" => false,					);
	register_post_type( "bordr", $args );

	$labels = array(
		"name" => __( 'Activities', 'bordr' ),
		"singular_name" => __( 'Activity', 'bordr' ),
		"menu_name" => __( 'My Activities', 'bordr' ),
		"all_items" => __( 'All Activities', 'bordr' ),
		"add_new" => __( 'Add New Activity', 'bordr' ),
		"add_new_item" => __( 'Add New Activity', 'bordr' ),
		"edit_item" => __( 'Edit Activity', 'bordr' ),
		"new_item" => __( 'New Activity', 'bordr' ),
		"view_item" => __( 'View Activity', 'bordr' ),
		"search_items" => __( 'Search Activity', 'bordr' ),
		"not_found" => __( 'No Activities Found', 'bordr' ),
		"not_found_in_trash" => __( 'No Activities Found in Trash', 'bordr' ),
		"archives" => __( 'Activities Archive', 'bordr' ),
		"insert_into_item" => __( 'Insert into activity', 'bordr' ),
		"uploaded_to_this_item" => __( 'Uploaded to this activity', 'bordr' ),
		"filter_items_list" => __( 'Filter Activity List', 'bordr' ),
		);

	$args = array(
		"label" => __( 'Activities', 'bordr' ),
		"labels" => $labels,
		"description" => "Activities are projects, actions, or interventions that explore borders and enable people to meet others",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => true,
		"show_in_menu" => true,
				"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "activity", "with_front" => true ),
		"query_var" => true,
		"menu_icon" => "dashicons-universal-access",
		"supports" => array( "title", "editor", "thumbnail", "comments", "revisions", "author" ),					);
	register_post_type( "activity", $args );

// End of cptui_register_my_cpts()
}




// --- BEGIN CUSTOM FIELD GROUPS
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
	'key' => 'group_5762ca8985b91',
	'title' => 'About',
	'fields' => array (
		array (
			'key' => 'field_5762cab774340',
			'label' => 'In the Press',
			'name' => 'in_the_press',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'collapsed' => '',
			'min' => '',
			'max' => '',
			'layout' => 'block',
			'button_label' => 'Add Row',
			'sub_fields' => array (
				array (
					'key' => 'field_5762caf174341',
					'label' => 'News Source',
					'name' => 'news_source',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
					'readonly' => 0,
					'disabled' => 0,
				),
				array (
					'key' => 'field_5762cb0b74342',
					'label' => 'Article Title',
					'name' => 'article_title',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
					'readonly' => 0,
					'disabled' => 0,
				),
				array (
					'key' => 'field_5762cb4574344',
					'label' => 'Date Published',
					'name' => 'date_published',
					'type' => 'date_picker',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'display_format' => 'd/m/Y',
					'return_format' => 'd/m/Y',
					'first_day' => 1,
				),
				array (
					'key' => 'field_5762cb2374343',
					'label' => 'Key Quote',
					'name' => 'key_quote',
					'type' => 'textarea',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'maxlength' => '',
					'rows' => '',
					'new_lines' => 'wpautop',
					'readonly' => 0,
					'disabled' => 0,
				),
				array (
					'key' => 'field_577285846ea75',
					'label' => 'Image from Article',
					'name' => 'article_image',
					'type' => 'image',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'return_format' => 'array',
					'preview_size' => 'medium',
					'library' => 'all',
					'min_width' => '',
					'min_height' => '',
					'min_size' => '',
					'max_width' => '',
					'max_height' => '',
					'max_size' => '',
					'mime_types' => '',
				),
				array (
					'key' => 'field_5762cb6f74345',
					'label' => 'Article Link',
					'name' => 'article_link',
					'type' => 'url',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
				),
			),
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'page',
				'operator' => '==',
				'value' => '18',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

acf_add_local_field_group(array (
	'key' => 'group_5703f201f38b0',
	'title' => 'Activity',
	'fields' => array (
		array (
			'key' => 'field_57c088f00aefe',
			'label' => 'What is an activity?',
			'name' => '',
			'type' => 'message',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '<p>This is the place to log your audience inclusive projects, actions, or interventions. An activity may be anything from a big project, to a limited event. The most important is that something has been learned.</p>
<p>Only a few questions are mandatory, but the more you answer, the more you and others will learn from your efforts.</p>',
			'new_lines' => 'wpautop',
			'esc_html' => 0,
		),
        array (
            'key' => 'field_588f1624311a8',
			'label' => 'Title',
			'name' => 'title',
			'type' => 'text',
			'default_value' => '',
			'maxlength' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
		),
		array (
			'key' => 'field_570c55618d71a',
			'label' => 'Activity Image Gallery',
			'name' => 'departure_images',
			'type' => 'gallery',
			'instructions' => 'Upload images that represent the activity here. The first image will be used as the featured image for the activity.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'min' => '',
			'max' => '',
			'insert' => 'append',
			'library' => 'uploadedTo',
			'min_width' => 300,
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => 2,
			'mime_types' => '',
		),
        array (
			'key' => 'field_56fb182433a5c',
			'label' => '<h2>Explores the space between</h2>',
			'name' => '',
			'type' => 'message',
			'instructions' => 'What border are you exploring?',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'new_lines' => 'wpautop',
			'esc_html' => 0,
		),
		array (
			'key' => 'field_56fb17b033a5a',
			'label' => 'From',
			'name' => 'from',
			'type' => 'text',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 50,
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => 120,
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_56fb17fe33a5b',
			'label' => 'To',
			'name' => 'to',
			'type' => 'text',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 50,
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_5703f367df759',
			'label' => 'Other borders explored in this activity',
			'name' => 'other_borders',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'collapsed' => '',
			'min' => '',
			'max' => '',
			'layout' => 'block',
			'button_label' => 'Add Another Border',
			'sub_fields' => array (
				array (
					'key' => 'field_5703f3acdf75a',
					'label' => 'From',
					'name' => 'ofrom',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => 50,
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => 120,
					'readonly' => 0,
					'disabled' => 0,
				),
				array (
					'key' => 'field_5703f3d0df75b',
					'label' => 'To',
					'name' => 'oto',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => 50,
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
					'readonly' => 0,
					'disabled' => 0,
				),
			),
		),
        array (
			'key' => 'field_573b394e55be5',
			'label' => 'Are you partnering with other hubs?',
			'name' => 'partner',
			'type' => 'user',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'role' => array (
				0 => 'hub',
			),
			'allow_null' => 0,
			'multiple' => 1,
		),
		array (
			'key' => 'field_570ce68c4fe89',
			'label' => 'Brief Description',
			'name' => 'brief_description',
			'type' => 'textarea',
			'instructions' => 'Please describe your project (activity) in a sentence or two. (200 characters max)',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => 'limited',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'maxlength' => 120,
			'rows' => 2,
			'new_lines' => '',
		),
		array (
			'key' => 'field_5702d2689ac47',
			'label' => '<h2>Why</h2>',
			'name' => 'why_description',
			'type' => 'wysiwyg',
			'instructions' => 'Why are you doing this? Explain using images, drawings, photographs, film, sound, or text.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'tabs' => 'all',
			'toolbar' => 'basic',
			'media_upload' => 1,
		),
        		array (
			'key' => 'field_56fb0dcf64d76',
			'label' => '<h2>Location</h2>',
			'name' => 'departure_location',
			'type' => 'google_map',
			'instructions' => 'Where is your activity?',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'center_lat' => '48.3995',
			'center_lng' => '9.9832',
			'zoom' => 3,
			'height' => '',
		),
		array (
			'key' => 'field_56fb18a433a5e',
			'label' => '<h2>Characteristics</h2>',
			'name' => '',
			'type' => 'message',
			'instructions' => 'In what type of area was it held?',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'new_lines' => 'wpautop',
			'esc_html' => 0,
		),
		array (
			'key' => 'field_570d2462d40fc',
			'label' => '',
			'name' => 'urban_rural_rel',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => 'Is it held in an urban or rural area?',
			'default_value' => 0,
		),
		array (
			'key' => 'field_570d2434d40fb',
			'label' => 'Pull the slider to a value that resembles the characteristic of your activity',
			'name' => 'urban_rural',
			'type' => 'number_slider',
			'instructions' => 'Urban area (0)
Rural area (100)',
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_570d2462d40fc',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'slider_units' => '%',
			'default_value' => 0,
			'slider_min_value' => 0,
			'slider_max_value' => 100,
			'increment_value' => 1,
		),
		array (
			'key' => 'field_570d28163c50e',
			'label' => '',
			'name' => 'rich_poor_rel',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => 'It is held in a rich or poor area?',
			'default_value' => 0,
		),
		array (
			'key' => 'field_5702af68cf09b',
			'label' => 'Pull the slider to a value that resembles the characteristic of your activity',
			'name' => 'rich_poor',
			'type' => 'number_slider',
			'instructions' => 'Rich area (0)
Poor area (100)',
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_570d28163c50e',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'slider_units' => '%',
			'default_value' => 0,
			'slider_min_value' => 0,
			'slider_max_value' => 100,
			'increment_value' => 1,
		),
		array (
			'key' => 'field_570d2a7d3c510',
			'label' => '',
			'name' => 'homo_plural_rel',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => 'It is held in a homogenous or pluralistic area?',
			'default_value' => 0,
		),
		array (
			'key' => 'field_5702afe7cf09c',
			'label' => 'Pull the slider to a value that resembles the characteristic of your activity',
			'name' => 'homo_plural',
			'type' => 'number_slider',
			'instructions' => 'Homogenous area (0)
Pluralistic area (100)',
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_570d2a7d3c510',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'slider_units' => '%',
			'default_value' => 50,
			'slider_min_value' => 0,
			'slider_max_value' => 100,
			'increment_value' => 1,
		),
		array (
			'key' => 'field_57be0ee7a98b5',
			'label' => 'Describe the setting',
			'name' => 'setting_desc',
			'type' => 'textarea',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => 8,
			'new_lines' => 'wpautop',
		),
		array (
			'key' => 'field_570d2b113c512',
			'label' => '',
			'name' => 'one_many_rel',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => 'Does it affect a person or people?',
			'default_value' => 0,
		),
		array (
			'key' => 'field_5702b01fcf09d',
			'label' => 'Pull the slider to a value that resembles the characteristic of your activity',
			'name' => 'one_many',
			'type' => 'number_slider',
			'instructions' => 'One person (0)
Many people (100)',
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_570d2b113c512',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'slider_units' => '%',
			'default_value' => 0,
			'slider_min_value' => 0,
			'slider_max_value' => 100,
			'increment_value' => 1,
		),
		array (
			'key' => 'field_570d2be23c514',
			'label' => '',
			'name' => 'young_old_rel',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => 'Does it affect the young or the old?',
			'default_value' => 0,
		),
		array (
			'key' => 'field_5702b044cf09e',
			'label' => 'Pull the slider to a value that resembles the characteristic of your activity',
			'name' => 'young_old',
			'type' => 'number_slider',
			'instructions' => 'Young people (0)
Old people (100)',
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_570d2be23c514',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'slider_units' => '%',
			'default_value' => 50,
			'slider_min_value' => 0,
			'slider_max_value' => 100,
			'increment_value' => 1,
		),
		array (
			'key' => 'field_570d2ca33c517',
			'label' => '',
			'name' => 'known_unknown_rel',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => 'Does it affect known or unknown people?',
			'default_value' => 0,
		),
		array (
			'key' => 'field_5702b08bcf09f',
			'label' => 'Pull the slider to a value that resembles the characteristic of your activity',
			'name' => 'known_unknown',
			'type' => 'number_slider',
			'instructions' => 'Known people (0)
Unknown people (100)',
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_570d2ca33c517',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'slider_units' => '%',
			'default_value' => 50,
			'slider_min_value' => 0,
			'slider_max_value' => 100,
			'increment_value' => 1,
		),
		array (
			'key' => 'field_57be0ff8a98b9',
			'label' => 'Describe the audience/participants (your target group)',
			'name' => 'audience_desc',
			'type' => 'textarea',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => '',
			'new_lines' => 'wpautop',
		),
		array (
			'key' => 'field_57c08ba1444df',
			'label' => '<h2>How the audience/participants were reached or discovered</h2>',
			'name' => 'audience_discovery',
			'type' => 'wysiwyg',
			'instructions' => 'How do/did you find, select, or reach out to your audience/participants (your target group)? Explain using images, drawings, photographs, film, sound, or text.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'tabs' => 'all',
			'toolbar' => 'full',
			'media_upload' => 1,
		),
		array (
			'key' => 'field_570d4d3b389ea',
			'label' => '<h2>How it was done</h2>',
			'name' => 'method_icons',
			'type' => 'checkbox',
			'instructions' => 'Select the methods you\'re using from the list of icons',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array (
				'archiving' => '<i class="fa fa-archive" aria-hidden="true"></i> archiving',
				'bordr' => '<i class="fa fa-map-signs" aria-hidden="true"></i> Bordr',
				'coding' => '<i class="fa fa-code" aria-hidden="true"></i> coding',
				'drawing' => '<i class="fa fa-pencil" aria-hidden="true"></i> drawing',
				'exhibitions' => '<i class="fa fa-picture-o" aria-hidden="true"></i> exhibitions',
				'film' => '<i class="fa fa-video-camera" aria-hidden="true"></i> film',
				'food' => '<i class="fa fa-cutlery" aria-hidden="true"></i> cooking',
				'graffiti' => '<i class="fa fa-paint-brush" aria-hidden="true"></i> graffiti',
				'interviews' => '<i class="fa fa-comment" aria-hidden="true"></i> interviews',
				'lectures' => '<i class="fa fa-university" aria-hidden="true"></i> lecture',
				'mapping' => '<i class="fa fa-map" aria-hidden="true"></i> mapping',
				'making' => '<i class="fa fa-cogs" aria-hidden="true"></i> making',
				'music' => '<i class="fa fa-music" aria-hidden="true"></i> music',
				'performance' => '<i class="fa fa-users" aria-hidden="true"></i> performance',
				'photography' => '<i class="fa fa-camera-retro" aria-hidden="true"></i> photography',
				'public art' => '<i class="fa fa-street-view" aria-hidden="true"></i> public art',
				'sound' => '<i class="fa fa-volume-up" aria-hidden="true"></i> sound',
				'textile' => '<i class="fa fa-scissors" aria-hidden="true"></i> textile',
				'theatre' => '<i class="fa fa-users" aria-hidden="true"></i> theatre',
				'travel' => '<i class="fa fa-globe" aria-hidden="true"></i> travel',
				'workshops' => '<i class="fa fa-bolt" aria-hidden="true"></i> workshops',
				'writing' => '<i class="fa fa-book" aria-hidden="true"></i> writing',
				'other' => '<i class="fa fa-ellipsis-h" aria-hidden="true"></i> other',
			),
			'default_value' => array (
			),
			'layout' => 'horizontal',
			'toggle' => 0,
			'return_format' => 'value',
		),
		array (
			'key' => 'field_5702d2889ac48',
			'label' => '<h2>How</h2>',
			'name' => 'how_description',
			'type' => 'wysiwyg',
			'instructions' => 'How are you using the above method(s)? Explain using images, drawings, photographs, film, sound, or text.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'tabs' => 'all',
			'toolbar' => 'basic',
			'media_upload' => 1,
		),
		array (
			'key' => 'field_5702d2d19ac49',
			'label' => '<h2>Results</h2>',
			'name' => 'results_description',
			'type' => 'wysiwyg',
			'instructions' => 'What were the results? Explain using images, drawings, photographs, film, sound, or text.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'tabs' => 'all',
			'toolbar' => 'basic',
			'media_upload' => 1,
		),
		array (
			'key' => 'field_5702d38d9ac4b',
			'label' => '<h2>How it went</h2>',
			'name' => 'success_rating',
			'type' => 'number_slider',
			'instructions' => 'Was it a success or failure? Failure — 0 Success — 10',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'units' => '',
			'min_value' => 0,
			'max_value' => 10,
			'increment_value' => '.1',
			'slider_min_value' => 0,
			'slider_max_value' => 100,
			'slider_units' => '%',
			'default_value' => 0,
		),
		array (
			'key' => 'field_570d2d7a799fe',
			'label' => '<h2>Main lessons</h2>',
			'name' => 'success_desc',
			'type' => 'wysiwyg',
			'instructions' => 'In what way did it succeed/fail, and what were the main lessons? Explain using images, drawings, photographs, film, sound, or text.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'tabs' => 'all',
			'toolbar' => 'basic',
			'media_upload' => 1,
		),
		array (
			'key' => 'field_5702d2f29ac4a',
			'label' => '<h2>Inspiration</h2>',
			'name' => 'inspiration_description',
			'type' => 'wysiwyg',
			'instructions' => 'What were your inspirations? Explain using images, drawings, photographs, film, sound, or text.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'tabs' => 'all',
			'toolbar' => 'basic',
			'media_upload' => 1,
		),
		array (
			'key' => 'field_575eeb8d38ab6',
			'label' => '<h2>Credits</h2>',
			'name' => 'credits_description',
			'type' => 'wysiwyg',
			'instructions' => 'Who helped realize this activity and deserves mention?',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'tabs' => 'all',
			'toolbar' => 'basic',
			'media_upload' => 0,
		),
		array (
			'key' => 'field_5703fc6d566ed',
			'label' => '<h2>Activity timeline</h2>',
			'name' => 'timeline',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'collapsed' => '',
			'min' => 1,
			'max' => '',
			'layout' => 'row',
			'button_label' => 'Add Entry',
			'sub_fields' => array (
				array (
					'key' => 'field_5703fd5d566ef',
					'label' => 'Name of entry',
					'name' => 'event_title',
					'type' => 'text',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array (
					'key' => 'field_5703fd72566f0',
					'label' => 'Date',
					'name' => 'event_date',
					'type' => 'date_picker',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'display_format' => 'F j, Y',
					'return_format' => 'm/d/Y',
					'first_day' => 1,
				),
				array (
					'key' => 'field_5703fe24566f2',
					'label' => 'End Date',
					'name' => 'end_date',
					'type' => 'date_picker',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'display_format' => 'F j, Y',
					'return_format' => 'm/d/Y',
					'first_day' => 1,
				),
				array (
					'key' => 'field_5703fdd3566f1',
					'label' => 'Description',
					'name' => 'event_description',
					'type' => 'wysiwyg',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'tabs' => 'all',
					'toolbar' => 'full',
					'media_upload' => 1,
				),
			),
		),
		array (
			'key' => 'field_573a10c1e94bd',
			'label' => 'Creative Commons License',
			'name' => 'cc_license',
			'type' => 'true_false',
			'instructions' => 'By checking the box below, I accept that my story (including text, photo, drawing, location, and experience evaluations) will now become part of the public domain with rights and obligations for Bordr.org under a Creative Commons BY 4.0 license.',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
		),
        array (
            'key' => 'field_588b28fa14472',
			'label' => '',
			'layout' => 'vertical',
			'choices' => array (
				'draft' => 'Save as draft?',
			),
			'default_value' => array (
			),
			'allow_custom' => 0,
			'save_custom' => 0,
			'toggle' => 0,
			'return_format' => 'value',
			'name' => 'save_as_draft',
			'type' => 'checkbox',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'activity',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'acf_after_title',
	'style' => 'seamless',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => array (
		0 => 'permalink',
		1 => 'the_content',
		2 => 'excerpt',
		3 => 'discussion',
		4 => 'comments',
		5 => 'author',
		6 => 'format',
		7 => 'featured_image',
		8 => 'categories',
		9 => 'tags',
		10 => 'send-trackbacks',
	),
	'active' => 1,
	'description' => '',
));

acf_add_local_field_group(array (
	'key' => 'group_57d8203caf147',
	'title' => 'Bordr',
	'fields' => array (
		array (
			'key' => 'field_57d820ae30eea',
			'label' => 'From',
			'name' => 'brdr_from',
			'type' => 'text',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => 'where/what',
			'prepend' => '',
			'append' => '',
			'maxlength' => 60,
		),
		array (
			'key' => 'field_57d820c230eeb',
			'label' => 'To',
			'name' => 'brdr_to',
			'type' => 'text',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => 'where/what',
			'prepend' => '',
			'append' => '',
			'maxlength' => 60,
		),
		array (
			'key' => 'field_57d82e1934b8f',
			'label' => 'This story relates to',
			'name' => 'related_activity',
			'type' => 'post_object',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'post_type' => array (
				0 => 'activity',
			),
			'taxonomy' => array (
			),
			'allow_null' => 0,
			'multiple' => 0,
			'return_format' => 'object',
			'ui' => 1,
		),
		array (
			'key' => 'field_57d82e9f34b90',
			'label' => 'Tell the story!',
			'name' => 'brdr_story',
			'type' => 'textarea',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => 'Who? Why? How? When?',
			'maxlength' => '',
			'rows' => '',
			'new_lines' => 'wpautop',
		),
		array (
			'key' => 'field_57d82ee034b91',
			'label' => 'What does this border look like?',
			'name' => 'brdr_image',
			'type' => 'image',
			'instructions' => 'Share a photo. Maximum file size is 6MB and a maximum width or height of 2,500px.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'array',
			'preview_size' => 'medium',
			'library' => 'uploadedTo',
			'min_width' => '400',
			'min_height' => '400',
			'min_size' => '',
			'max_width' => '2500',
			'max_height' => '2500',
			'max_size' => '6',
			'mime_types' => 'jpg, png, jpeg',
		),
		array (
			'key' => 'field_57d82f7834b92',
			'label' => 'How do you experience the border? Tap along the lines to select a value.',
			'name' => '',
			'type' => 'message',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'new_lines' => 'wpautop',
			'esc_html' => 0,
		),
		array (
			'key' => 'field_57d82ff134b93',
			'label' => 'invisible — visible',
			'name' => 'brdr_invisible_visible',
			'type' => 'number_slider',
			'instructions' => '1 is invisible, 100 is visible',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'slider_units' => '',
			'default_value' => 50,
			'slider_min_value' => 1,
			'slider_max_value' => 100,
			'increment_value' => 1,
		),
		array (
			'key' => 'field_57d8304334b94',
			'label' => 'unimportant — important',
			'name' => 'brdr_unimportant_important',
			'type' => 'number_slider',
			'instructions' => '1 is unimportant, 100 is important',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'slider_units' => '',
			'default_value' => 50,
			'slider_min_value' => 1,
			'slider_max_value' => 100,
			'increment_value' => 1,
		),
		array (
			'key' => 'field_57d830a734b96',
			'label' => 'How do you feel about this border?',
			'name' => '',
			'type' => 'message',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'new_lines' => 'wpautop',
			'esc_html' => 0,
		),
		array (
			'key' => 'field_57d8306d34b95',
			'label' => 'negative — positive',
			'name' => 'brdr_negative_positive',
			'type' => 'number_slider',
			'instructions' => '1 is negative, 100 is positive',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'slider_units' => '',
			'default_value' => 50,
			'slider_min_value' => 1,
			'slider_max_value' => 100,
			'increment_value' => 1,
		),
		array (
			'key' => 'field_57d8310a34b97',
			'label' => 'Where is this border?',
			'name' => 'brdr_location',
			'type' => 'google_map',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '100',
				'class' => '',
				'id' => '',
			),
			'center_lat' => '48.4',
			'center_lng' => '9.983333',
			'zoom' => 4,
			'height' => '',
		),
		array (
			'key' => 'field_57d8319e34b98',
			'label' => 'Permission to share?',
			'name' => 'brdr_cc',
			'type' => 'checkbox',
			'instructions' => 'I accept that my story (including text, photo, drawing, location, and experience evaluations) will now become part of the public domain with rights and obligations for Bordr.org under a Creative Commons BY 4.0 license. <a href="https://creativecommons.org/licenses/by-sa/4.0/" target="_blank">Read more here</a>.',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array (
				'yes' => 'Yes',
			),
			'default_value' => array (
			),
			'layout' => 'vertical',
			'toggle' => 0,
			'return_format' => 'value',
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'bordr',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'acf_after_title',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => array (
		0 => 'permalink',
		1 => 'the_content',
		2 => 'excerpt',
		3 => 'custom_fields',
		4 => 'discussion',
		5 => 'comments',
		6 => 'revisions',
		7 => 'slug',
		8 => 'author',
		9 => 'format',
		10 => 'page_attributes',
		11 => 'featured_image',
		12 => 'categories',
		13 => 'tags',
		14 => 'send-trackbacks',
	),
	'active' => 1,
	'description' => '',
));

acf_add_local_field_group(array (
	'key' => 'group_5783ddc72821a',
	'title' => 'Home Page',
	'fields' => array (
		array (
			'key' => 'field_5783ddd0f9a7e',
			'label' => 'Headline text',
			'name' => 'headline',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_5783de09f9a7f',
			'label' => 'Call to action',
			'name' => 'call_to_action',
			'type' => 'wysiwyg',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'tabs' => 'all',
			'toolbar' => 'full',
			'media_upload' => 1,
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'page_template',
				'operator' => '==',
				'value' => 'welcome.php',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

acf_add_local_field_group(array (
	'key' => 'group_57042512f1df9',
	'title' => 'Hub Profile',
	'fields' => array (
		array (
			'key' => 'field_57043c98660f9',
			'label' => 'You are a Hub',
			'name' => '',
			'type' => 'message',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => 'On Global Grand Central, you are registered as a Hub, and your projects, actions, and interventions are called Activities.

Please take a moment and describe your hub.',
			'new_lines' => 'wpautop',
			'esc_html' => 0,
		),
		array (
			'key' => 'field_57cf284c77dce',
			'label' => 'Hub Type',
			'name' => 'hub_type',
			'type' => 'checkbox',
			'instructions' => 'I represent a',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array (
				'small' => 'mobile individual or organization',
				'medium' => 'location-based organization or individual',
				'large' => 'multiple-state organization, network, or large project',
			),
			'default_value' => array (
			),
			'layout' => 'horizontal',
			'toggle' => 0,
			'return_format' => 'value',
		),
		array (
			'key' => 'field_57042530881b3',
			'label' => 'Hub Name',
			'name' => 'organization_name',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array (
			'key' => 'field_57042a48811f3',
			'label' => 'Hub Logo',
			'name' => 'hub_logo',
			'type' => 'image',
			'instructions' => 'Upload your hub\'s (organization) logo.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'id',
			'preview_size' => 'thumbnail',
			'library' => 'all',
			'min_width' => 200,
			'min_height' => 200,
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => 2,
			'mime_types' => 'jpg,png,jpeg',
		),
		array (
			'key' => 'field_570427ce4f90e',
			'label' => 'Hub Location',
			'name' => 'organization_location',
			'type' => 'google_map',
			'instructions' => 'Where is your hub (organization) based?',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'center_lat' => '48.3995',
			'center_lng' => '9.9832',
			'zoom' => 4,
			'height' => '',
		),
		array (
			'key' => 'field_57043db874399',
			'label' => 'Language',
			'name' => 'organization_language',
			'type' => 'text',
			'instructions' => 'In which languages do you conduct your work? (seperate multiple answers by commas)',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_570426ef4f90d',
			'label' => 'Hub Description',
			'name' => 'organization_profile',
			'type' => 'wysiwyg',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'tabs' => 'all',
			'toolbar' => 'full',
			'media_upload' => 1,
		),
		array (
			'key' => 'field_573a144e5437f',
			'label' => 'Photo Gallery',
			'name' => 'hub_images',
			'type' => 'gallery',
			'instructions' => 'Share images of your hub',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'min' => '',
			'max' => '',
			'insert' => 'append',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'user_role',
				'operator' => '==',
				'value' => 'hub',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'acf_after_title',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

endif;

// !--- END CUSTOM FIELD GROUPS

add_filter( 'jetpack_enable_opengraph', '__return_false', 99 );

?>