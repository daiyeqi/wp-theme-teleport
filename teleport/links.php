<?php /* Template Name: Links */ ?>
<!DOCTYPE html>
<html lang="zh" itemscope itemtype="http://schema.org/WebPage">
<head>
<meta charset="utf-8" />
<title>Links</title>
<meta name="keywords" content="Links" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<?php get_header(); ?>
<body>
<?php get_template_part('topbar'); ?>
<div id="content" class="links wrapper clearfix" role="main">
  <section id="main" class="inner lfloat">
    <header class="pagetitle"><h1>Links</h1></header>
    <article class="post">
      <section class="content">
        <?php tp_links() ?>
      </section>
    </article>
    <?php comments_template('', true); ?>
  </section>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
