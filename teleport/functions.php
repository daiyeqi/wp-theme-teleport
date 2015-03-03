<?php

/*  function  */
function tp_substr($content, $length) {
  $content = str_replace(PHP_EOL, " ", $content);
  return mb_strimwidth(strip_tags($content), 0, $length, '...', 'UTF-8');
}

function tp_human_time($time) {
  $current_time = time();
  $diff = $current_time - $time;
  if ($diff <= 60) {
    $since = $diff <= 5 ? 'about 5 seconds ago' : $diff . ' seconds ago';
  } else if ($diff <= 3600) {
    $mins = (int)($diff / 60);
    $since = $mins <= 1 ? 'about a minute ago': $mins . ' minutes ago';
  } else if ($diff <= 86400) {
    $hours = (int)($diff / 3600);
    $since = $hours <= 1 ? 'about an hour ago' : $hours . ' hours ago';
  } else if ($diff <= 604800) {
    $days = (int)($diff / 86400);
    $since = $days <= 1 ? 'about a day ago' : $days . ' days ago';
  } else if ($diff <= 4838400) {
    $weeks = (int)($diff / 604800);
    $since = $weeks <= 1 ? 'about a week ago' : $weeks . ' weeks ago';
  } else {
    $since = date('F jS, Y \a\t H:i', $time);
  }
  return $since;
}

function tp_paging($p = 2) {
  $chain = '';
  global $wp_query;
  $page_size = $wp_query->max_num_pages;
  if ($page_size <= 1) return;
  $current_page = get_query_var('paged');
  $current_page = empty($current_page) ? 1 : $current_page;
  $chain .= '<div class="paging">';
  $chain .= '<span>Page ' . $current_page . ' of ' . $page_size . '</span>';
  if ($current_page > $p + 1)
    $chain .= '<a class="btn-small" href="' . get_pagenum_link(1) . '">First</a>';
  if ($current_page > 1)
    $chain .= '<a class="btn-small" href="' . get_pagenum_link($current_page - 1) . '">Prev</a>';
  else
    $chain .= '<a class="btn-small" disabled>Prev</a>';
  if ($current_page > $p + 2)
    $chain .= '<a class="btn-small" disabled>...</a>' ;
  for ($i = $current_page - $p; $i <= $current_page + $p; $i++) {
    if ($i > 0 && $i <= $page_size) {
      if ($i == $current_page)
        $chain .= '<a class="btn-small" disabled>' . $i . '</a>';
      else
        $chain .= '<a class="btn-small" href="' . get_pagenum_link($i) . '">' . $i . '</a>';
    }
  }
  if ($current_page < $page_size - $p - 1)
    $chain .= '<a class="btn-small" disabled>...</a>';
  if ($current_page < $page_size)
    $chain .= '<a class="btn-small" href="' . get_pagenum_link($current_page + 1) . '">Next</a>';
  else
    $chain .= '<a class="btn-small" disabled>Next</a>';
  if ($current_page < $page_size - $p)
    $chain .= '<a class="btn-small" href="' . get_pagenum_link($page_size) . '">Last</a>';
  $chain .= '</div>';
  echo $chain;
}

function tp_avatar($mail, $size, $class = 'avatar') {
  $avatar = '//en.gravatar.com/avatar/' . md5(strtolower(trim($mail))) . '?d=mm&amp;';
  return '<img src="' . $avatar . 's=' . $size * 2 . '" alt="avatar" itemprop="image" class="' . $class . '" height="' . $size . '" width="' . $size . '">';
}

function tp_recent_posts($number) {
  $chain = '';
  $posts = wp_get_recent_posts(array('numberposts' => $number));
  foreach ($posts as $post) {
    $chain .= '<li><a href="' . get_permalink($post['ID']) . '" title="Look ' . $post['post_title'] . '" >' . tp_substr($post['post_title'], 30) . '</a></li>';
  }
  echo $chain;
}

function tp_recent_comments($number) {
  $chain = '';
  $comments = get_comments(array('number' => $number, 'status' => 'approve', 'type' => 'comment'));
  foreach ($comments as $comment) {
    $GLOBALS['comment'] = $comment;
    $chain .= '<li>'. tp_avatar(get_comment_author_email(), 36) . '<div class="info"><a href="' . get_comment_link() . '" rel="nofollow">' . get_comment_author() . '</a></div><div class="excerpt"  title="' . strip_tags(get_comment_text()) . '">' . tp_substr(get_comment_text(), 26) . '</div></li>';
  }
  echo $chain;
}

function tp_single_comment($comment) {
  $chain = '';
  global $comment_count;
  $GLOBALS['comment'] = $comment;
  $chain .= '<li class="comment ' . tp_comment_alt() . ' clearfix" id="comment-' . get_comment_ID() . '" itemprop="comment" itemscope itemtype="http://schema.org/Comment">';
  $chain .= tp_avatar(get_comment_author_email(), 45, 'avatar lfloat');
  $chain .= '<div class="content lfloat">';
  $chain .= '<div class="author">';
  if (get_comment_author_url())
    $chain .= '<a id="reviewer-' . get_comment_ID() . '" href="' . get_comment_author_url() . '" rel="nofollow" itemprop="author" target="_blank">' . get_comment_author() . '</a>';
  else
    $chain .= '<span id="reviewer-' . get_comment_ID() . '" itemprop="author">' . get_comment_author() . '</span>';
  $chain .= '</div>';
  $chain .= '<div class="description" id="commentbody-' . get_comment_ID() . '" itemprop="description">';
  $chain .= get_comment_text();
  $chain .= '</div>';
  $chain .= '<a href="' . get_comment_link() . '" title="' . get_comment_time('c', true) . '" rel="nofollow">';
  $chain .= '<time itemprop="datePublished" datetime="' . get_comment_time('c', true) . '">' . tp_human_time(get_comment_time('U', true)) . '</time>';
  $chain .= '</a>';
  if (current_user_can('edit_comment', get_comment_ID()))
    $chain .= ' <a href="' . get_edit_comment_link() . '" title="Edit comment" target="_blank">[Edit]</a>';
  $chain .= '</div>';
  $chain .= '<div class="comment-right lfloat">';
  $chain .= '<div class="commentnum">';
  $chain .= '<a href="' . get_comment_link() . '" rel="nofollow">#' . ($comment_count + 1) . '</a>';
  $chain .= '</div>';
  $chain .= '<div class="reply">';
  $chain .= '<a href="javascript:void(0)" data-name="' . get_comment_author() . '" data-commentid="comment-' . get_comment_ID() . '" rel="nofollow" style="display: none">Reply</a>';
  $chain .= '</div>';
  $chain .= '</div>';
  echo $chain;
}

function tp_single_trackback($comment) {
  $chain = '';
  $GLOBALS['comment'] = $comment;
  $chain .= '<li class="trackback ' . tp_comment_alt() . '">';
  $chain .= '<div class="title">';
  $chain .= '<a href="' . get_comment_author_url() . '" rel="external nofollow">' . get_comment_author() . '</a>';
  $chain .= '</div>';
  $chain .= '<time itemprop="datePublished" datetime="' . get_comment_time('c', true) . '">' . tp_human_time(get_comment_time('U', true)) . '</time>';
  $chain .= '</li>';
  echo $chain;
}

function tp_comment_alt() {
  global $comment_count;
  $class = '';
  if ($comment_count % 2)
    $class = 'odd';
  else
    $class = 'even';
  $comment_count = $comment_count - 1;
  return $class;
}

function tp_related_post($post_id) {
  $chain = '';
  $size = 5;
  global $tags;
  global $categories;
  $permalink = get_option('permalink_structure');
  $category = $categories[0];
  $chain .= '<ul>';
  $post_ids = array($post_id);
  if (!empty($tags)) {
    foreach ($tags as $tag) {
      $ids .=  $tag->term_taxonomy_id . ', ';
    }
    $posts = get_related_post_id_by_tags($ids, $post_id, $size);
    $chain .= build_related_post($post_ids, $posts, $permalink);
  }
  if (count($post_ids) <= $size) {
    $posts = get_related_post_id_by_category($post_ids, $category, ($size - count($post_ids)));
    $chain .= build_related_post($post_ids, $posts, $permalink);
  }
  if (count($post_ids) <= $size) {
    $posts = get_related_post_by_rand($post_ids, ($size - count($post_ids)));
    $chain .= build_related_post($post_ids, $posts, $permalink);
  }
  $chain .= '</ul>';
  echo $chain;
}

function build_related_post(&$post_ids, $posts, $permalink) {
  $chain = '';
  if (!empty($posts)) {
    foreach ($posts as $post) {
      $chain .= '<li>';
      if (empty($permalink))
        $chain .= '<a href="' . home_url('?p=' . $post->ID) . '" title="' . $post->post_title . '">';
      else
        $chain .= '<a href="' . home_url(str_replace("%postname%", $post->post_name, $permalink)) . '" title="View this post ' . $post->post_title . '">';
      $chain .= $post->post_title . '</a>';
      $chain .= '</li>';
      array_push($post_ids, $post->ID);
    }
  }
  return $chain;
}

function get_related_post_by_rand($post_ids, $limit) {
  global $wpdb;
  $query = 'SELECT t1.ID, t1.post_name, t1.post_title ';
  $query .= 'FROM ';
  $query .= $wpdb->posts . ' AS t1 ';
  $query .= 'WHERE t1.ID NOT IN (' . implode(', ', $post_ids) . ') ';
  $query .= 'AND t1.post_status = "publish" ';
  $query .= 'AND t1.post_type = "post" ';
  $query .= 'ORDER BY ';
  $query .= 'RAND() ';
  $query .= 'LIMIT ' . ($limit + 1);
  return $wpdb->get_results($query);
}

function get_related_post_id_by_category($post_ids, $category, $limit) {
  global $wpdb;
  $query = 'SELECT t1.ID, t1.post_name, t1.post_title ';
  $query .= 'FROM ';
  $query .= $wpdb->posts . ' AS t1, ';
  $query .= $wpdb->term_relationships .' AS t2 ';
  $query .= 'WHERE t1.ID NOT IN (' . implode(', ', $post_ids) . ') ';
  $query .= 'AND t1.ID = t2.object_id ';
  $query .= 'AND t2.term_taxonomy_id =' . $category->term_taxonomy_id . ' ';
  $query .= 'AND t1.post_status = "publish" ';
  $query .= 'AND t1.post_type = "post" ';
  $query .= 'GROUP BY t1.ID ';
  $query .= 'ORDER BY ';
  $query .= 'RAND() ';
  $query .= 'LIMIT ' . ($limit + 1);
  return $wpdb->get_results($query);
}

function get_related_post_id_by_tags($ids, $post_id, $limit) {
  global $wpdb;
  $query = 'SELECT t1.ID, t1.post_name, t1.post_title, count(0) AS count ';
  $query .= 'FROM ';
  $query .= $wpdb->posts . ' AS t1, ';
  $query .= $wpdb->term_relationships .' AS t2 ';
  $query .= 'WHERE t1.ID != ' . $post_id . ' ';
  $query .= 'AND t1.ID = t2.object_id ';
  $query .= 'AND t2.term_taxonomy_id in (' . substr($ids, 0, -2) . ') ';
  $query .= 'AND t1.post_status = "publish" ';
  $query .= 'AND t1.post_type = "post" ';
  $query .= 'GROUP BY t1.ID ';
  $query .= 'ORDER BY ';
  $query .= 'count(0) DESC, ';
  $query .= 't1.post_date DESC ';
  $query .= 'LIMIT ' . $limit;
  return $wpdb->get_results($query);
}

function tp_links() {
  $chain = '';
  $categorys = get_terms('link_category', array ('order'=>'DESC'));
  foreach ($categorys as $category) {
    $chain .= '<h3>' . $category->name . '</h3>' . '<ul class="clearfix">';
    $bookmarks = get_bookmarks(array('category'=>$category->term_id));
    if (!empty ($bookmarks)) {
      foreach ($bookmarks as $bookmark) {
        $chain .= '<li><a rel="external" style="background:url(//www.google.com/s2/favicons?domain_url=' . $bookmark->link_url . ') no-repeat;" href="' . $bookmark->link_url . '" title="' . $bookmark->link_description . '" target="_blank">' . $bookmark->link_name . '</a></li>';
      }
    }
    $chain .= '</ul>';
  }
  echo $chain;
}

function tp_the_breadcrumbs($separator, $link){
  $chain = '';
  $chain .= '<div id="breadcrumb" itemprop="breadcrumb">';
  $chain .= '<a href="' . get_bloginfo('url') . '" class="home" rel="nofollow">Home</a> › ';
  $chain .= '<a href="' . get_bloginfo('url') . '/categories/" rel="nofollow">All Categories</a> › ';
  if (is_single()) {
    $categorys = get_the_category();
    $category = $categorys[0];
  } else {
    $category = get_category(intval(get_query_var('cat')));
  }
  if ($category->parent)
    $chain .= get_category_parents($category->parent, true, $separator);
  if ($link)
    $chain .= '<h2><a href="' . esc_url(get_category_link($category->term_id)) . '" title="' . esc_attr("View all posts in " . $category->name) . '">' . $category->name . '</a></h2>';
  else
    $chain .= '<h3>' . $category->name . '</h3>';
  $chain .= '</div>';
  echo $chain;
}

function tp_the_excerpt() {
  global $post;
  $chain = $post->post_excerpt;
  $raw_excerpt = $chain;
  if (post_password_required($post)) {
    $chain = '<div class="msgbox msg-info"><p>This post is password protected.</p><p>这是一篇受密码保护的文章。</p><p>この投稿はパスワードで保護されています.</p</div>';
    return $chain;
  } else {
    if ('' == $chain) {
      $chain = get_the_content('');
      $chain = strip_tags($chain);
      $chain = mb_strimwidth('<p>' . $chain . '</p>', 0, 500, '<p><a href="' . get_permalink() . '" class="btn" rel="nofollow">Continue Reading...</a></p>', 'UTF-8');
    }
  }
  return $chain;
}

function tp_get_archives() {
  $_chain = '';
  $chain = '';
  $selector = '';
  $_count = 0;
  global $wpdb, $wp_locale;
  $permalink = get_option('permalink_structure');
  $query = 'SELECT ID, post_name, post_title, comment_count, YEAR(post_date) AS "year", MONTH(post_date) AS "month", DAYOFMONTH(post_date) AS "dayofmonth" FROM ' . $wpdb->posts . ' WHERE post_status = "publish" AND post_type = "post" ORDER BY post_date DESC';
  $arcresults = $wpdb->get_results($query);
  $selector .= '<select class="selector">';
  $selector .= '<option value="all" selected="selected">All</option>';
  $chain .= '<div class="monthly-archives">';
  $_template = '<div class="year-%1$s month"><h4><a href="%2$s" title="Show detailed results for %3$s">%3$s</a><em>(%4$s)</em></h4><ul>%5$s</ul></div>';
  if ($arcresults) {
    $_year = '';
    $_month = '';
    $_year_month = '';
    foreach ((array) $arcresults as $arcresult) {
      $year = $arcresult->year;
      $month = $arcresult->month;
      if ($_year_month != $year . $month) {
        if ($_chain != '') {
          $chain .= sprintf($_template, $_year, get_month_link($_year, $_month), $wp_locale->get_month($_month) . ' ' . $_year, sprintf(_n('%s post', '%s posts', $_count), $_count), $_chain);
          $_count = 0;
          $_chain = '';
        }
        if ($year != $_year) {
          $_year = $year;
          $selector .= '<option value="' . $year . '">' . $year . '</option>';
        }
        $_month = $month;
        $_year_month = $year . $month;
      }
      $_chain .= '<li>';
      $_chain .= '<span>' . tp_ordinal($arcresult->dayofmonth) . ' : </span>';
      if (empty($permalink))
        $_chain .= '<a href="' . home_url('?p=' . $arcresult->ID) . '" title="' . $arcresult->post_title . '">';
      else
        $_chain .= '<a href="' . home_url(str_replace("%postname%", $arcresult->post_name, $permalink)) . '" title="View this post ' . $arcresult->post_title . '">';
      $_chain .= $arcresult->post_title . '</a>';
      $_chain .= '<em>(' . $arcresult->comment_count . ')</em>';
      $_chain .= '</li>';
      $_count++;
    }
    $chain .= sprintf($_template, $_year, get_month_link($_year, $_month), $wp_locale->get_month($_month) . ' ' . $_year, sprintf(_n('%s post', '%s posts', $_count), $_count), $_chain);
  }
  $selector .= '</select>';
  $chain .= '</div>';
  $chain = $selector . $chain;
  echo $chain;
}

function tp_ordinal($num) {
  if (!in_array(($num % 100), array(11, 12, 13))) {
    switch ($num % 10) {
      case 1: return $num . 'st';
      case 2: return $num . 'nd';
      case 3: return $num . 'rd';
    }
  }
  return $num . 'th';
}

function tp_the_password_form () {
  $chain = '';
  global $post;
  $chain .= '<div class="msgbox msg-info">';
  $chain .= '<p>This post is password protected. To view it please enter your password below: </p>';
  $chain .= '<p>这是一篇受密码保护的文章。您需要提供访问密码: </p>';
  $chain .= '<p>この投稿はパスワードで保護されています. 表示するにはパスワードを入力してください: </p>';
  $chain .= '<form action="' . esc_url(site_url('wp-login.php?action=postpass', 'login_post')) . '" method="post">';
  $chain .= '<label for="pwbox-' .  get_the_ID() . '">Password: </label>';
  $chain .= '<input name="post_password" class="small" id="pwbox-' .  get_the_ID() . '" type="password" size="20" /> ';
  $chain .= '<input type="submit" class="btn small" name="Submit" value="Submit" />';
  $chain .= '</form>';
  $chain .= '</div>';
  echo $chain;
}

function tp_link_pages() {
  global $page, $numpages, $multipage, $more;
  $output = '';
  if ($multipage) {
    $output .= '<p class="post-paging"><span>Pages: </span>';
    for ($i = 1; $i < ( $numpages + 1 ); $i = $i + 1 ) {
      $output .= ' ';
      if ($i != $page || ((!$more) && ($page == 1)))
        $output .= _tp_link_page($i);
      else
        $output .= '<a class="current btn small" disabled>';
      $output .= $i;
      $output .= '</a>';
    }
    $output .= '</p>';
  }
  echo $output;
}

function _tp_link_page($i) {
  global $post, $wp_rewrite;
  if (1 == $i) {
    $url = get_permalink();
  } else {
    if ('' == get_option('permalink_structure') || in_array($post->post_status, array('draft', 'pending')))
      $url = add_query_arg( 'page', $i, get_permalink() );
    elseif ('page' == get_option('show_on_front') && get_option('page_on_front') == $post->ID )
      $url = trailingslashit(get_permalink()) . user_trailingslashit("$wp_rewrite->pagination_base/" . $i, 'single_paged');
    else
      $url = trailingslashit(get_permalink()) . user_trailingslashit($i, 'single_paged');
  }
  return '<a class="btn small" href="' . esc_url( $url ) . '">';
}

/*  Hook  */
function tp_content_more_link($value, $more_link_text) {
  global $post;
  return '<a href="' . get_permalink() . '#more-' . $post->ID . '" class="btn" rel="nofollow">Continue Reading...</a>';
}

function tp_pre_comment_content($comment_content) {
  return str_replace(PHP_EOL, " ", strip_tags($comment_content, '<a>'));
}

function tp_filter_pre($matches) {
  return '<pre' . $matches[1] . '>' . htmlspecialchars($matches[2]) . '</pre>';
}

function tp_filter_content($content) {
  $content = preg_replace_callback("/<pre(.+?)>(.+?)<\/pre>/is", "tp_filter_pre", $content);
  return $content;
}

/* post */
add_filter('the_content', 'tp_filter_content', 9);
add_filter('the_content_more_link', 'tp_content_more_link', 9, 2);
add_filter('protected_title_format', function($format) { return '%s'; });
add_filter('private_title_format', function($format) { return '%s'; });

/* comment */
add_filter('pre_comment_content', 'tp_pre_comment_content');
