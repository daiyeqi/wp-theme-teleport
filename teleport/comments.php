<?php
  global $comment_count; 
  $_comment = $comments_by_type['comment'];
  $comment_count = count($_comment);
  $_trackbacks = $comments_by_type['pings'];
  $trackback_count = count($_trackbacks);
?>
<div id="comments">
  <?php if (!post_password_required()) : ?>
  <div class="comments-tab clearfix">
    <span class="tab lfloat active">Comments <small>( <?php echo $comment_count ?> )</small></span>
    <?php if (pings_open()) : ?>
    <span class="tab lfloat">Trackbacks <small>( <?php echo $trackback_count ?> )</small></span>
    <?php endif; ?>
    <?php if (comments_open()) : ?>
    <em class="rfloat"><a href="#respond" rel="nofollow">Leave a Reply</a></em>
    <?php endif; ?>
  </div>
  <ol class="commentlist">
  <?php if (!comments_open()) : ?>
    <li class="even">
    <p>Comments are closed.</p>
    <p>评论已关闭</p>
    <p>コメントは受け付けていません。</p>
    </li>
  <?php elseif ($comment_count == 0) : ?>
    <li class="even">
    <p>No comments yet.</p>
    <p>目前尚无任何评论.</p>
    <p>コメントはまだありません。</p>
    </li>
  <?php endif; ?>
  <?php wp_list_comments(array('callback' => 'tp_single_comment'), $_comment); ?>
  </ol>
  <?php if (pings_open()) : ?>
  <ol class="trackbacks hide">
    <li class="trackbackurl">
      <label for="trackback-url">TrackBack URL</label>
      <input type="text" id="trackback-url" name="trackback-url" class="w380" value="<?php trackback_url(); ?>" readonly onclick="this.select()" />
    </li>
  <?php if($trackback_count != 0) : ?>
    <?php wp_list_comments(array('callback' => 'tp_single_trackback'), $_trackbacks); ?>
  <?php else : ?>
    <li class="odd">
    <p>No trackbacks yet.</p>
    <p>目前尚无任何 trackbacks 和 pingbacks.</p>
    <p>トラックバックはまだありません。</p>
    </li>
  <?php endif; ?>
  </ol>
  <?php endif; ?>
  <?php if (comments_open()) : ?>
  <form id="respond" class="clearfix" action="<?php echo site_url('/wp-comments-post.php'); ?>" method="post">
    <?php if($user_ID) : ?>
    <div>Logged in as 
      <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php" rel="nofollow"><strong><?php echo $user_identity; ?></strong></a>. 
      <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account" rel="nofollow">Logout &raquo;</a>
    </div>
    <?php else : ?>
    <?php if ($comment_author != "") : ?>
    <div id="welcome-back">
      Welcome back <strong><?php echo $comment_author; ?></strong>. 
      <a id="rChange" href="javascript:void(0)" rel="nofollow">Change &raquo;</a>
      <a id="rClose" href="javascript:void(0)" rel="nofollow" style="display: none">Close &raquo;</a>
    </div>
    <div id="author-info" style="display: none">
    <?php else : ?>
    <div id="author-info">
    <?php endif; ?>
      <div>
        <input type="text" id="author" name="author" size="24" tabindex="1" class="w220" value="<?php echo $comment_author; ?>" required />
        <label for="author">Name (required)</label>
      </div>
      <div>
        <input type="email" id="email" name="email" size="24" tabindex="2" class="w220" value="<?php echo $comment_author_email; ?>" required />
        <label for="email">Mail (will not be published or shared) (required)</label>
      </div>
      <div>
        <input type="url" id="url" name="url" size="24" tabindex="3" class="w220" value="<?php echo $comment_author_url; ?>" />
        <label for="url">Website</label>
      </div>
    </div>
    <?php endif; ?>
    <div>
      <ul class="kaomoji clearfix">
        <li>☆*:.｡. o(≧▽≦)o .｡.:*☆</li>
        <li>_(:з」∠)_</li>
        <li>♪(´ε｀ )</li>
        <li>ψ(｀∇´)ψ</li>
        <li>(－_－＃)</li>
        <li>(=´∀｀)人(´∀｀=)</li>
        <li>\(//∇//)\</li>
        <li>♪(*^^)o∀*∀o(^^*)♪</li>
        <li>(((o(*ﾟ▽ﾟ*)o)))</li>
        <li>(´･_･`)</li>
        <li>σ(^_^;)</li>
        <li>( *｀ω´)</li>
        <li>(ﾉ｀Д´)ﾉ</li>
        <li>(( _ _ ))..zzzZZ</li>
        <li>(￣▽￣)</li>
        <li>ヽ(｀Д´#)ﾉ</li>
        <li>((((；ﾟДﾟ)))))))</li>
        <li>(&gt;_&lt;)</li>
        <li>(T_T)</li>
        <li>( T_T)＼(^-^ )</li>
        <li>ε=ε=ε=ε=ε=ε=┌(;￣◇￣)┘</li>
      </ul> 
    </div>
    <div>
      <textarea id="comment" name="comment" tabindex="4" rows="8" cols="80" required></textarea>
    </div>
    <div>
      <input name="submit" type="submit" id="comment-submit" class="btn-black" tabindex="5" value="Submit Comment" />
    </div>
    <input type="hidden" name="comment_post_ID" value="<?php the_ID() ?>" />
    <?php wp_nonce_field('akismet_comment_nonce_' . get_the_ID(), 'akismet_comment_nonce', FALSE); ?>
  </form>
  <?php endif; ?>
  <?php else : ?>
  <div class="msgbox">
    <p>This post is password protected. Enter the password to view any comments.</p>
    <p>本文受密码保护。要查看评论，请输入密码。</p>
    <p>この投稿はパスワードで保護されています。コメントを閲覧するにはパスワードを入力してください。</p>
  </div>
  <?php endif; ?>
</div>
