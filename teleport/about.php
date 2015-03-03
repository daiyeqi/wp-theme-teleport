<?php /* Template Name: About Me */ ?>
<?php the_post(); ?>
<!DOCTYPE html>
<html lang="zh" itemscope itemtype="http://schema.org/WebPage">
<head>
<meta charset="utf-8" />
<title>About Key</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<?php get_header(); ?>
<body>
<?php get_template_part('topbar'); ?>
<div id="content" class="about wrapper clearfix" role="main" itemscope itemtype="http://schema.org/Person">
  <section id="main" class="inner lfloat">
    <div class="face">
      <?php echo tp_avatar(get_the_author_meta('user_email'), 200) ?>
    </div>
  </section>

</div>
<?php get_footer(); ?>
