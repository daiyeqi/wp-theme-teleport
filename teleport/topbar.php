<header id="topbar">
  <div class="wrapper clearfix">
    <hgroup class="caption lfloat">
<?php if (is_home() || is_front_page()) { ?>
      <h1 class="title white lfloat"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
<?php } else { ?>
      <h2 class="title white lfloat"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h2>
<?php } ?>
      <h2 class="tagline white lfloat"><?php bloginfo('description'); ?></h2>
    </hgroup>
    <div class="search lfloat">
      <form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
        <input type="search" name="s" id="s" value="" placeholder="Search" />
      </form>
    </div>
    <nav class="rfloat">
      <ul class="nav clearfix">

      </ul>
    </nav>
  </div>
</header>
