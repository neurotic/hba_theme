<div<?php print $attributes; ?>>

<?php if (isset($tabs) && is_array($tabs['#primary'])): ?><div class="tabs clearfix"><?php print render($tabs); ?></div><?php endif; ?>

  <?php if (!empty($variables['node'])) { ?>
  <?php if ($node->type == 'family' || $node->type == 'species' || $node->type == 'subspecies') {
          // Act on the unpublishing of an article.
          if ($node->status == 0) { ?>
            <span class="node-status-unpublished"><?php print t('unpublished'); ?></span>
          <?php
          }
        }
      }
      ?>
  
  <div<?php print $content_attributes; ?>>
    
    <a id="main-content"></a>
    <?php if ($title): ?>
    <?php if ($title_hidden): ?><div class="element-invisible"><?php endif; ?>
    <?php print render($title_prefix); ?>
    <h1 class="title" id="page-title"><?php print $title; ?></h1>
    <?php print render($title_suffix); ?>
    <?php if ($title_hidden): ?></div><?php endif; ?>
    <?php endif; ?>
    <div class="content-inner">
      <?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
      <?php print $content; ?>
    </div>
  </div>
</div>
