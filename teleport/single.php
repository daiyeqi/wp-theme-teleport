<?php
the_post();
if (post_password_required()) {
  $description = 'This post is password protected. 这是一篇受密码保护的文章。 この投稿はパスワードで保護されています.';
} else {
  $description = $post->post_excerpt;
}
if (empty($description))
  $description = tp_substr($post->post_content, 220);
$tags = get_the_tags();
if(!empty($tags)){
  foreach ($tags as $tag){
    $keywords .= $tag->name . ', ';
  }
}
$categories = get_the_category();
$keywords .= $categories[0]->name;
if(!empty($categories[0]->parent))
  $keywords .= ', ' . get_category($categories[0]->parent)->name;
?>
<!DOCTYPE html>
<html lang="zh" itemscope itemtype="http://schema.org/WebPage">
<head prefix="og: http://ogp.me/ns# article: http://ogp.me/ns/article#">
<meta charset="utf-8" />
<title><?php the_title(); ?></title>
<meta name="keywords" content="<?php echo $keywords ?>" />
<meta name="description" content="<?php echo $description; ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<!-- open graph protocl -->
<meta property="og:title" content="<?php the_title(); ?>" />
<meta property="og:type" content="article" />
<meta property="og:url" content="<?php the_permalink() ?>" />
<meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
<meta property="og:description" content="<?php echo $description; ?>" />
<meta property="og:locale" content="zh_CN" />
<meta property="article:published_time" content="<?php echo get_post_time('c', true); ?>" />
<meta property="article:section" content="<?php echo $categories[0]->name ?>" />
<?php if(!empty($tags)) : ?>
<?php foreach ($tags as $tag) : ?>
<meta property="article:tag" content="<?php echo $tag->name ?>" />
<?php endforeach; ?>
<?php endif; ?>
<!-- open graph protocl end -->
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel='canonical' href="<?php the_permalink() ?>" />
<?php get_header(); ?>
<body>
<?php get_template_part('topbar'); ?>
<div id="content" class="single wrapper clearfix" role="main">
  <section id="main" class="inner lfloat">
    <?php tp_the_breadcrumbs(' › ', true); ?>
    <?php get_template_part('article', 'single'); ?>
    <?php comments_template('', true); ?>
  </section>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
