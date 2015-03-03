<!DOCTYPE html>
<html lang="zh" itemscope itemtype="http://schema.org/WebPage">
<head>
<meta charset="utf-8" />
<title>Articles Tagged with <?php single_tag_title(); ?></title>
<meta name="keywords" content="<?php single_tag_title(); ?>" />
<meta name="description" content="Articles Tagged with <?php single_tag_title(); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<?php get_header(); ?>
<body>
<?php get_template_part('topbar'); ?>
<div id="content" class="tag wrapper clearfix" role="main">
  <section id="main" class="inner lfloat">
    <header class="pagetitle"><h1>Articles Tagged with <strong><?php single_tag_title(); ?></strong></h1></header>
    <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
      <?php get_template_part('article', 'excerpt'); ?>
    <?php endwhile; ?>
    <?php tp_paging(); ?>
    <?php else : ?>
    <article class="post">
      <section class="content">
        <div class="msgbox msg-error">
          <p>Apologies, but no results were found for the requested archive.</p>
          <p>抱歉，您访问的归档页面未找到。</p>
          <p>リクエストされたアーカイブには何も見つかりませんでした。</p>
        </div>
      </section>
    </article>
    <?php endif; ?>
  </section>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
