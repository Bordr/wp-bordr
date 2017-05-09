<?php
/*
  ##############################
  ########### Search ###########
  ##############################

  Included are steps to help make this script easier for other to follow
  All you have to do is add custom ACF post types into Step 1 and custom taxonomies into Step 10
  [list_searcheable_acf list all the custom fields we want to include in our search query]
  @return [array] [list of custom fields]
*/

/*
 * [advanced_custom_search search that encompasses ACF/advanced custom fields and taxonomies and split expression before request]
 * @param  [query-part/string]      $search    [the initial "where" part of the search query]
 * @param  [object]                 $wp_query []
 * @return [query-part/string]      $search    [the "where" part of the search query as we customized]
 * modified from gist: https://gist.github.com/FutureMedia/9581381/73afa809f38527d57f4213581eeae6a8e5a1340a
 * see https://vzurczak.wordpress.com/2013/06/15/extend-the-default-wordpress-search/
 * credits to Vincent Zurczak for the base query structure/spliting tags section and Sjouw for comment cleanup
 * final fork: https://gist.github.com/felthy/9673477d1fd1ef8a703a0c377336bd6c
*/

function advanced_custom_search( $search, &$wp_query ) {
    global $wpdb;
    if (empty($search)) {
        return $search;
    }
    // AND (((wp_posts.post_title LIKE '%venenatis%') OR (wp_posts.post_excerpt LIKE '%venenatis%') OR (wp_posts.post_content LIKE '%venenatis%')))  AND (wp_posts.post_password = '')
    // 1- get search expression
    $terms = $wp_query->query_vars['s'];

    // 2- explode search expression to get search terms
    $exploded = preg_split('|\s+|', $terms);
    if ($exploded === FALSE || count($exploded) == 0) {
        $exploded = array(0 => $terms);
    }
    // 3- setup search variable as a string
    $search = '';
    $params = array();

    // 4- a list of advanced custom fields you want to search content in
    $list_searcheable_acf = array(
        "brdr_from",
        "brdr_to",
        "brdr_story",
        "organization_name",
        "from",
        "to",
        "brief_description",
        "why_description",
        "repeater" => array(
            "repeater-sub-field1",
            "repeater-sub-field2"
        )
    );
    // 5- search through tags, inject each into SQL query
    foreach ($exploded as $tag) {
        $s = '%' . $wpdb->esc_like($tag) . '%';
        $search .= "
              AND (
                ({$wpdb->posts}.post_title LIKE '%s')
                OR ({$wpdb->posts}.post_excerpt LIKE '%s')
                OR ({$wpdb->posts}.post_content LIKE '%s')
                " .
            // 8- Adds to $search DB data from custom post types
            "OR EXISTS (
                  SELECT * FROM {$wpdb->postmeta}
                  WHERE post_id = {$wpdb->posts}.ID
                  AND (";
        $params []= $s;
        $params []= $s;
        $params []= $s;

        // 5b - reads through $list_searcheable_acf array to see which custom post types you want to include in the search string
        $metaStatements = array();
        foreach ($list_searcheable_acf as $key => $searcheable_acf) {
            if (is_array($searcheable_acf)) {
                foreach ($searcheable_acf as $repeater_acf) {
                    array_push($metaStatements, "(meta_key LIKE '" . $key . "_%%_" . $repeater_acf . "' AND meta_value LIKE '%s')");
                    $params []= $s;
                }
            } else {
                array_push($metaStatements, "(meta_key = '" . $searcheable_acf . "' AND meta_value LIKE '%s')");
                $params []= $s;
            }
        }
        $search .= join($metaStatements, "\n          OR ");
        $search .= ")
                ) " .
            // 6- Adds to $search DB data from comments
            "OR EXISTS (
                  SELECT * FROM {$wpdb->comments}
                  WHERE comment_post_ID = {$wpdb->posts}.ID
                  AND comment_content LIKE '%s'
                ) " .
            // 7 - Adds to $search DB data from taxonomies
            "OR EXISTS (
                  SELECT * FROM {$wpdb->terms}
                  INNER JOIN {$wpdb->term_taxonomy}
                  ON {$wpdb->term_taxonomy}.term_id = {$wpdb->terms}.term_id
                  INNER JOIN {$wpdb->term_relationships}
                  ON {$wpdb->term_relationships}.term_taxonomy_id = {$wpdb->term_taxonomy}.term_taxonomy_id " .
                  // 7b- Add custom taxonomies here
                  "WHERE (
                          taxonomy = 'your'
                          OR taxonomy = 'custom'
                          OR taxonomy = 'taxonomies'
                          OR taxonomy = 'here'
                        )
                        AND object_id = {$wpdb->posts}.ID
                        AND {$wpdb->terms}.name LIKE '%s'
              )" .
         ")";
        $params []= $s;
        $params []= $s;
    }

    return $wpdb->prepare($search, $params);
} // closes function advanced_custom_search

// 8- use add_filter to put advanced_custom_search into the posts_search results
add_filter( 'posts_search', 'advanced_custom_search', 500, 2 );
