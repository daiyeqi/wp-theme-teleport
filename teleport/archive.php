<?php
  $_title = '';
  $_date = '';
  $_h1 = '';
  if (is_day()) {
    $_date = get_the_date('F jS, Y');
    $_title = 'Daily Archives: ' .  $_date;
    $_h1 = 'Daily Archives: ' . '<strong>' . $_date . '</strong>';
  } else if (is_month()) {
    $_date = get_the_date('F Y');
    $_title = 'Monthly Archives: ' . $_date;
    $_h1 = 'Monthly Archives: ' . '<strong>' . $_date . '</strong>';
  } else if (is_year()) {
    $_date = get_the_date('Y');
    $_title = 'Yearly Archives: ' . $_date;
    $_h1 = 'Yearly Archives: ' . '<strong>' . $_date . '</strong>';
  }
?>
<!DOCTYPE html>
<html lang="zh" itemscope itemtype="http://schema.org/WebPage">
<head>
<meta charset="utf-8" />
<title><?php echo $_title ?></title>
<meta name="keywords" content="<?php echo $_date ?>" />
<meta name="description" content="<?php echo $_title ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<?php get_header(); ?>
<body>
<?php get_template_part('topbar'); ?>
<div id="content" class="archive wrapper clearfix" role="main">
  <section id="main" class="inner lfloat">
    <header class="pagetitle">
      <h1><?php echo $_h1; ?></h1>
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
