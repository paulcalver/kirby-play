<?php snippet('header') ?>

<main>
  <?php if ($projects = page('projects')): ?>
    <div class="image-flow">
      <?php foreach ($projects->children()->listed() as $p): ?>
        <?php foreach ($p->images() as $img): ?>
          <?php
          // Orientation check
          $isPortrait = $img->height() >= $img->width();

          // 5:6 portrait => 200x240, 6:5 landscape => 200x167
          $w = 200;
          $h = $isPortrait ? 240 : 167;

          // Crop with Kirby focus if available
          if (method_exists($img, 'focusCrop')) {
            $thumb = $img->focusCrop($w, $h);
          } else {
            $thumb = $img->crop($w, $h);
          }
          ?>
          <a href="<?= $p->url() ?>?img=<?= urlencode($img->filename()) ?>">
            <img
              src="<?= $thumb->url() ?>"
              width="<?= $w ?>"
              height="<?= $h ?>"
              alt="<?= $img->alt()->or($p->title())->esc() ?>">
          </a>
        <?php endforeach; ?>

        <!-- blank column between projects -->
        <div class="project-spacer" aria-hidden="true"></div>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    <p>Projects page not found. Create a page with the slug <code>projects</code>.</p>
  <?php endif; ?>
</main>

<?php snippet('footer') ?>