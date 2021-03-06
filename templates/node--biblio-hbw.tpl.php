<?php if ($teaser) { // START if teaser ?>

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

<?php } // END if teaser ?>

<?php if (!$teaser) { // START if full node ?>

<?php
global $user;
// node visible per rols: basic (encara que parcialment), supporting, institutional, editor, administrator
if (!empty($user->roles[5]) || !empty($user->roles[6]) || !empty($user->roles[7]) || !empty($user->roles[4]) || !empty($user->roles[3])) { ?>

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
  
  <div class="clearfix">
    <?php if (!empty($content['links'])): ?>
      <nav class="links node-links clearfix"><?php print render($content['links']); ?></nav>
    <?php endif; ?>
  </div>
  
  <div<?php print $content_attributes; ?>>
    <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      
      print '<div id="biblio-main-info">' . render($content) . '</div>';
      if (empty($content['field_bib_pdf_link'])) {
        print '<div class="help">The link to PDF is a work in progress</div>';
      }

      // Reference full node only available for Supporting, Institutional, Editor and Administrator roles
      if (empty($user->roles[6]) && empty($user->roles[7]) && empty($user->roles[4]) && empty($user->roles[3])) {
        print '<div class="avis">The advanced bibliographic search and features are only available for Supporting and Institutional members. To make the most of all of HBW\'s features, discover our subscriptions now.<div class="btn-container"><a title="Compare subscriptions" class="btn" href="/pricing">HBW Alive Plans & Pricing</a>&nbsp;&nbsp;' . l('Why subscribe','subscription-plans', array('attributes' => array('title' => t('Why subscribe ?'),'class' => 'btn'))) .'<div class="sign-in">or <a title="Sign in now if you already have a membership" href="/user">sign in</a> if you already have a membership</div></div></div>';
      }
      else {
        /*if ($page):
          print '<p class="more-info">More information coming soon!</p>';
        endif;*/
        $refe = render($content['field_bib_ref_name'][0]);
        //$resta = render($content['field_bib_resta'][0]);
        $title1 = htmlspecialchars(strip_tags($title));
        $title2 = preg_replace('/[^a-z0-9]+/i', ' ', $title1);
        $title3 = str_replace(' ', '+', $title2);
        $title4 = str_replace('amp+', '', $title3);
        $refe1 = htmlspecialchars(strip_tags($refe));
        $refe2 = preg_replace('/[^a-z0-9]+/i', ' ', $refe1);
        $refe3 = str_replace(' ', '+', htmlspecialchars(strip_tags($refe2)));
        $refe4 = str_replace('amp+', '', $refe3);
        print '<div class="more-link"><ul><li>Check any available <a href="https://www.google.com/search?hl=en&as_q='.$title4.'+'.$refe4.'&as_epq=&as_oq=&as_eq=&as_nlo=&as_nhi=&lr=&cr=&as_qdr=all&as_sitesearch=&as_occt=any&safe=off&tbs=rl%3A1%2Crls%3A2&as_filetype=pdf&as_rights=#q='.$title4.'+'.$refe4.'+filetype:pdf&hl=en&lr=&safe=off&as_qdr=all&prmd=imvns&tbas=0&sa=X&ei=23A3UIvqJ5Ck0AWllIGACQ&ved=0CCsQuAs&bav=on.2,or.r_gc.r_pw.&fp=d058f6d271e1b243&biw=1269&bih=669" title="Search PDFs for this reference on Google">PDF on Google</a>.</li>';
        print '<li>Find this reference on the web with <a href="http://scholar.google.com/scholar?hl=en&q='.$title4.'+'.$refe4.'&btnG=&as_sdt=1%2C5&as_sdtp=" title="Search this reference on Google Scholar">Google Scholar</a>.</li></ul></div>';
      }
    ?>
  </div>
  
  <?php
    //$output = '<div class="sp-search">' . views_embed_view('species_table_by_family','page_2') . '</div>';
    /*$block = module_invoke('views', 'block_view', '024b51b0948df12f8903897e79946969');
    print $block['content'];*/
    if (!empty($user->roles[6]) || !empty($user->roles[7]) || !empty($user->roles[3]) || !empty($user->roles[4])) {
      $block = block_load('views', '258063f6767b6942b787998a1c928f07');
      print drupal_render(_block_get_renderable_array(_block_render_blocks(array($block))));
      //dpm($user->roles);
    }
  ?>
  
  <?php
    // Other references with the same title. Possible duplicates nodes for editors.
    /*$nid = arg(1);
    $result_nb = db_query("SELECT COUNT(*) FROM {node} WHERE title LIKE '$title' AND node.nid !='$nid'")->fetchField();
    $result = db_query("SELECT nid, title FROM {node} WHERE title LIKE '$title' AND nid !='$nid' ORDER BY nid ASC");
    if($result_nb > 0){
      print '<div class="avis"><h2 class="block-title">' . $result_nb . ' other references with the same title</h2>';
      print '<div class="help">These are possible duplicates references based on the <em>title</em>. The 2 references should be compared in order to determine it, as it is strongly possible that other elements of the reference will be different.</div>';
      foreach ($result as $record) {
        print '<div class="item"><a target="_blank" title="Open ' . $record->title . ' in a new tab" href="/node/' . $record->nid . '">' . $record->title . '</a> - id: ' . $record->nid . '</div>';
      }
      print '</div>';
    }*/
  ?>

  <?php
  
    if (!empty($user->roles[3]) || !empty($user->roles[4])) {
        // View Other references with the same title (possible duplicates nodes for editors to review)
        $block = block_load('views', 'nodes_where_this_biblio-block_5', $node->nid);
        print drupal_render(_block_get_renderable_array(_block_render_blocks(array($block))));
    }

  ?>

  <?php print render($content['comments']); ?>
</article>

<?php }

else {
  print '<div class="avis">You need a membership to access the references. To make the most of all of HBW\'s features, subscribe now by clicking on the button below.<div class="btn-container"><a title="Compare subscriptions" class="btn" href="/pricing">HBW Alive Plans & Pricing</a>&nbsp;&nbsp;' . l('Why subscribe','subscription-plans', array('attributes' => array('title' => t('Why subscribe ?'),'class' => 'btn'))) .'<div class="sign-in">or <a title="Sign in now if you already have a membership" href="/user">sign in</a> if you already have a membership</div></div></div>';
  }

} // END if full node ?>
