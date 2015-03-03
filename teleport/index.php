<!DOCTYPE html>
<html lang="zh" itemscope itemtype="http://schema.org/WebPage">
<head prefix="og: http://ogp.me/ns#">
<meta charset="utf-8" />
<title><?php bloginfo('name'); ?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<!-- open graph protocl -->
<meta property="og:type" content="website" />
<meta property="og:title" content="<?php bloginfo('name'); ?>" />
<meta property="og:url" content="<?php bloginfo('url'); ?>" />
<meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
<meta property="og:description" content="<?php bloginfo('description'); ?>" />
<meta property="og:locale" content="zh_CN" />
<?php get_header(); ?>
<body>
<?php get_template_part('topbar'); ?>
<div id="content" class="wrapper clearfix" role="main">
  <section id="main" class="inner lfloat">
    <?php while (have_posts()) : the_post(); ?>
      <?php get_template_part('article'); ?>
    <?php endwhile; ?>
    <?php tp_paging(); ?>
  </section>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
