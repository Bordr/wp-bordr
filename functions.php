<?php

// if (!is_user_logged_in() && !is_admin())
// {
// 
// 	if (!in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php', 'wp-admin/'))
// 	  && !is_user_logged_in()
// 	  && !is_admin())
// 	{
// 	  wp_redirect('/landing/');
// 	  exit;
// 	}
// }


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
	
	acf_update_setting('google_api_key', 'AIzaSyBx_OgbI2PTKsYfIkalYigpEPdqyvR2LQo');
}

add_action('acf/init', 'my_acf_init');

add_action("pre_get_posts", "custom_front_page");
function custom_front_page($wp_query){
    //Ensure this filter isn't applied to the admin area
    if(is_admin()) {
        return;
    }

    if($wp_query->get('page_id') == get_option('page_on_front')):

        $wp_query->set('post_type', 'activity');
        $wp_query->set('page_id', ''); //Empty

        //Set properties that describe the page to reflect that
        //we aren't really displaying a static page
        $wp_query->is_page = 0;
        $wp_query->is_singular = 0;
        $wp_query->is_post_type_archive = 1;
        $wp_query->is_archive = 1;

    endif;

}

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
        $html = str_replace( 'Biographical Info', 'Short overview of who you are (as an Actor) and what you do?', $html );
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


// DEPARTURE FILTER FUNCTIONS

$GLOBALS['my_query_filters'] = array( 
	'author'	=> 'station',
	'location'	=> 'ctry'
);

// array of filters (field key => field name)
$GLOBALS['my_meta_query_filters'] = array( 
	'field_1'	=> 'method', 
	'field_2'	=> 'char'
);

// action
add_action('pre_get_posts', 'my_pre_get_posts');
// $my_secondary_loop = new WP_Query(array('author'=>16));
// remove_action('pre_get_posts', 'my_pre_get_posts');

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
			
// 			echo $value;
			
			$arg = array(
					'meta_key'		=> 'organization_location',
					'meta_value'	=> sprintf('%s";', $value),
					'meta_compare'	=>'LIKE',
					'fields'	=> 'ID'
			);
			
			$ctryusers = get_users($arg);
// 			print_r($ctryusers);
			$query->set( 'author__in' , $ctryusers ); 
// 			echo $query;
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

?>