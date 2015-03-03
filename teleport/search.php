<!DOCTYPE html>
<html lang="zh" itemscope itemtype="http://schema.org/WebPage">
<head>
<meta charset="utf-8" />
<title>Search Results for: "<?php echo get_search_query(); ?>"</title>
<meta name="keywords" content="<?php echo get_search_query(); ?>" />
<meta name="description" content="Search Results for: <?php echo get_search_query(); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<?php get_header(); ?>
<body>
<?php get_template_part('topbar'); ?>
<div id="content" class="search wrapper clearfix" role="main">
  <section id="main" class="inner lfloat">
    <header class="pagetitle"><h1>Search Results for: "<?php echo get_search_query(); ?>"</h1></header>
    <?php while (have_posts()) : the_post(); ?>
      <?php get_template_part('article'); ?>
    <?php endwhile; ?>
    <?php tp_paging(); ?>
  </section>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
