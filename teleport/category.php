<!DOCTYPE html>
<html lang="zh" itemscope itemtype="http://schema.org/WebPage">
<head>
<meta charset="utf-8" />
<title>Archives for <?php single_cat_title(); ?> Category</title>
<meta name="keywords" content="<?php single_cat_title(); ?>" />
<meta name="description" content="Archives for <?php single_cat_title(); ?> Category" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<?php get_header(); ?>
<body>
<?php get_template_part('topbar'); ?>
<div id="content" class="categorie wrapper clearfix" role="main">
  <section id="main" class="inner lfloat">
    <?php tp_the_breadcrumbs(' › ', false); ?>
    <header class="pagetitle">
      <h1>Archives for <strong><?php single_cat_title(); ?></strong> Category</h1>
    </header>
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
