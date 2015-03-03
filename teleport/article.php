<article class="post" itemscope itemtype="http://schema.org/Article">
  <header class="header">
    <?php echo tp_avatar(get_the_author_meta('user_email'), 42); ?>
    <div class="page-title clearfix">
      <h2 class="lfloat" itemprop="name">
        <a class="title" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a>
      </h2>
    </div>
    <div class="post-meta meta clearfix">
      <span>Author: </span>
      <span class="author">
        <a itemprop="author" href="#" rel="me"><?php the_author(); ?></a>.
      </span>
      <span>Posted on </span>
      <time datetime="<?php echo get_post_time('c', true); ?>" itemprop="datePublished"><?php the_time('F jS, Y \a\t H:i:s'); ?></time>
      <?php edit_post_link('[Edit]'); ?>
      <a href="<?php comments_link(); ?>" class="rfloat" rel="nofollow"><?php comments_number('No Responses', '1 Responses', '% Responses'); ?></a>
    </div>
  </header>
  <section class="content" itemprop="articleBody">
    <?php if (!post_password_required()) : ?>
    <?php the_content(); ?>
    <?php else : ?>
    <?php tp_the_password_form(); ?>
    <?php endif; ?>
  </section>
</article>
