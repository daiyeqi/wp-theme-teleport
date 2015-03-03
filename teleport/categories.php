<?php /* Template Name: Categories */ ?>
<!DOCTYPE html>
<html lang="zh" itemscope itemtype="http://schema.org/WebPage">
<head>
<meta charset="utf-8" />
<title>Categories</title>
<meta name="keywords" content="Categories" />
<meta name="description" content="All Categories of <?php bloginfo('name'); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<?php get_header(); ?>
<body>
<?php get_template_part('topbar'); ?>
<div id="content" class="categories wrapper clearfix" role="main">
  <section id="main" class="inner lfloat">
    <header class="pagetitle"><h1>All Categories</h1></header>
    <article class="post">
    <section class="content">
      <ul><?php wp_list_categories('show_count=1&hide_empty=0&title_li='); ?></ul>
    </section>
    </article>
  </section>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
