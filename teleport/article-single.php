<article class="post" itemscope itemtype="http://schema.org/Article">
  <header class="header">
    <?php echo tp_avatar(get_the_author_meta('user_email'), 42); ?>
    <div class="page-title clearfix">
      <h1 class="lfloat" itemprop="name"><?php the_title(); ?></h1>
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
    <?php tp_link_pages(); ?>
    <?php else : ?>
    <?php tp_the_password_form(); ?>
    <?php endif; ?>
  </section>
  <footer class="post-footer">
    <div class="related-posts">
      <h3>你可能会感兴趣</h3>
      <?php tp_related_post(get_the_ID()); ?>
    </div>
    <div class="post-tag">
      <?php the_tags('<span>Tags : </span>', '', ''); ?>
    </div>
    <div class="announce msgbox">
      <strong>声明:</strong> 本文 "<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>" 采用 <a href="http://creativecommons.org/licenses/by-nc-sa/4.0/" rel="nofollow external license"><abbr title="署名-非商业性使用-相同方式共享">CC BY-NC-SA 4.0</abbr></a> 协议进行授权. <br>转载请注明原文地址: <a href="<?php the_permalink() ?>" itemprop="url" rel="nofollow"><?php the_permalink() ?></a>
    </div>
    <div class="postnav clearfix">
      <div class="prev lfloat">
        <?php previous_post_link('%link', '<div class="control">‹</div><em>Previous post</em><span>%title</span>') ?>
      </div>
      <div class="next rfloat">
        <?php next_post_link('%link', '<em>Next post</em><span>%title</span><div class="control">›</div>') ?>
      </div>
    </div>
  </footer>
</article>
