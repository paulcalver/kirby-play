<?php snippet('header') ?>

<main>
  <?php if ($projects = page('projects')): ?>
    <?php foreach ($projects->children()->listed() as $p): ?>
      <article class="section">
        <h2 class="page_title">
          <a href="<?= $p->url() ?>"><?= $p->title()->esc() ?></a>
        </h2>

        <?php if ($p->images()->isNotEmpty()): ?>
          <div class="image-row">
            <?php foreach ($p->images() as $img): ?>
              <a href="<?= $p->url() ?>?img=<?= urlencode($img->filename()) ?>">
                <img src="<?= $img->url() ?>" alt="<?= $img->alt()->esc() ?>">
              </a>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </article>
    <?php endforeach; ?>
  <?php else: ?>
    <p>Projects page not found. Create a page with the slug <code>projects</code>.</p>
  <?php endif; ?>
</main>

<?php snippet('footer') ?>
