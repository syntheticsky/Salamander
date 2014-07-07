<header>
  <!-- Fixed navbar -->
  <nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>

      <?php
              $defaults = array(
        'theme_location'  => 'main_navigation',
        'menu'            => '',
        'container'       => 'div',
        'container_class' => 'collapse navbar-collapse',
        'container_id'    => '',
        'menu_class'      => 'nav navbar-nav',
        'menu_id'         => '',
        'echo'            => true,
        'fallback_cb'     => '',
        'before'          => '',
        'after'           => '',
        'link_before'     => '',
        'link_after'      => '',
        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        'depth'           => 0,
        'walker'          => '',
      );

      wp_nav_menu( $defaults );
      ?>
    </div>
  </nav>
</header>
