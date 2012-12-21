<?php if ($teaser): // START if teaser ?>

<article<?php print $attributes; ?>>
  <?php if (!$page && $title): ?>
  <header>
    <?php print render($title_prefix); ?>
    <h2<?php print $title_attributes; ?>><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
    <?php print render($title_suffix); ?>
  </header>
  <?php endif; ?>
  <div class="node-inner teaser">
  <?php if ($display_submitted): ?>
  <footer class="submitted"><?php print $date; ?> -- <?php print $name; ?></footer>
  <?php endif; ?>  
  
  <div<?php print $content_attributes; ?>>
    <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      print render($content);
    ?>
  </div>
  
  <div class="clearfix">
    <?php if (!empty($content['links'])): ?>
      <nav class="links node-links clearfix"><?php print render($content['links']); ?></nav>
    <?php endif; ?>
    
  </div>
  </div>
  <?php print render($content['comments']); ?>
</article>

<?php // END if teaser ?>

<?php else: // START if full node ?>

<article<?php print $attributes; ?>>
  <?php if (!$page && $title): ?>
  <header>
    <?php print render($title_prefix); ?>
    <h2<?php print $title_attributes; ?>><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
    <?php print render($title_suffix); ?>
  </header>
  <?php endif; ?>
  <div class="node-inner full">
  <?php if ($display_submitted): ?>
  <footer class="submitted"><?php print $date; ?> -- <?php print $name; ?></footer>
  <?php endif; ?>  
  
  <div<?php print $content_attributes; ?>>
    <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      global $user;
      if (empty($user->roles[6]) && !in_array('editor', $user->roles) && !in_array('administrator', $user->roles)) {
        print '<div id="members-info">The advance bibliographic search is only available for <a href="/tour">Supporting members</a></div>';
      }
      else {
        print render($content);
        if ($page): ?>
          <p class="more-info">More information to come soon !</p>
        <?php endif;
        $refe = render($content['field_bib_ref_name'][0]);
        $refe_stripped = strip_tags($refe);
        print 'Search this reference on the web:<ul>';
        print '<li><a href="http://scholar.google.com/scholar?hl=en&q='.$refe_stripped.'%29&btnG=&as_sdt=1%2C5&as_sdtp=" title="Search this reference on Google Scholar">Google Scholar</a></li>';
        print '<li><a href="https://www.google.com/search?hl=en&as_q='.$refe_stripped.'&as_epq=&as_oq=&as_eq=&as_nlo=&as_nhi=&lr=&cr=&as_qdr=all&as_sitesearch=&as_occt=any&safe=off&tbs=rl%3A1%2Crls%3A2&as_filetype=pdf&as_rights=#q='.$refe_stripped.'+filetype:pdf&hl=en&lr=&safe=off&as_qdr=all&prmd=imvns&tbas=0&sa=X&ei=23A3UIvqJ5Ck0AWllIGACQ&ved=0CCsQuAs&bav=on.2,or.r_gc.r_pw.&fp=d058f6d271e1b243&biw=1269&bih=669" title="Search PDFs for this reference on Google">PDFs on Google</a></li>';
        print '</ul>';
      }
    ?>
  </div>
  
  <div class="clearfix">
    <?php if (!empty($content['links'])): ?>
      <nav class="links node-links clearfix"><?php print render($content['links']); ?></nav>
    <?php endif; ?>

  </div>
  </div>
  <?php print render($content['comments']); ?>
</article>

<?php endif; // END if full node ?>
