<?php /* Template Name: Tags */ ?>
<!DOCTYPE html>
<html lang="zh" itemscope itemtype="http://schema.org/WebPage">
<head>
<meta charset="utf-8" />
<title>All Tags</title>
<meta name="keywords" content="Tags" />
<meta name="description" content="All Tags of <?php bloginfo('name'); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<?php get_header(); ?>
<body>
<?php get_template_part('topbar'); ?>
<div id="content" class="tags wrapper clearfix" role="main">
  <section id="main" class="inner lfloat">
    <header class="pagetitle"><h1>All Tags</h1></header>
    <article class="post">
    <section class="content">
      <?php wp_tag_cloud('smallest=13&number=&unit=px'); ?>
    </section>
    </article>
  </section>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
