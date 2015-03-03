<?php the_post();
$description = $post->post_excerpt;
if (empty($description))
  $description = tp_substr($post->post_content, 220);
?>
<!DOCTYPE html>
<html lang="zh" itemscope itemtype="http://schema.org/WebPage">
<head>
<meta charset="utf-8" />
<title><?php the_title(); ?></title>
<meta name="keywords" content="<?php the_title(); ?>" />
<meta name="description" content="<?php echo $description; ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<?php get_header(); ?>
<body>
<?php get_template_part('topbar'); ?>
<div id="content" class="wrapper clearfix" role="main">
  <section id="main" class="inner lfloat">
    <header class="pagetitle"><h1><?php the_title(); ?></h1></header>
    <article class="post" itemscope itemtype="http://schema.org/Article">
      <section class="content" itemprop="articleBody">
      <?php the_content(); ?>
      </section>
    </article>
    <?php comments_template('', true); ?>
  </section>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
