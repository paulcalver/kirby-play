<?php snippet('header') ?>

<main>
  <article class="section">
    <h1 class="page_title"><?= $page->title()->esc() ?></h1>

    <?php
    // Find the next listed sibling, wrap to the first if we're at the end
    $next = $page->nextListed() ?? $page->siblings()->listed()->first();
    if ($next && $next->id() !== $page->id()): ?>
      <nav class="project-nav">
        <a class="next-project" href="<?= $next->url() ?>">
          Next project: <?= $next->title()->esc() ?> →
        </a>
      </nav>
    <?php endif; ?>

    <?php
    $images = $page->images(); // adjust order if needed
    if ($images->isNotEmpty()):
      $first = $images->first();
      $requested = get('img'); // ?img=filename.jpg
    ?>
      <div class="hero-wrap">
        <img
          id="hero-image"
          src="<?= $first->url() ?>"
          alt="<?= $first->alt()->esc() ?>"
          data-index="0"
          style="cursor:pointer;"
        >
      </div>

      <script>
        (function () {
          const imgs = [
            <?php foreach ($images as $img): ?>
              { src: "<?= $img->url() ?>", alt: "<?= $img->alt()->esc() ?>", name: "<?= $img->filename() ?>" },
            <?php endforeach ?>
          ];

          const hero = document.getElementById('hero-image');
          let i = 0;

          function show(n) {
            i = (n + imgs.length) % imgs.length;
            hero.src = imgs[i].src;
            hero.alt = imgs[i].alt || '';
          }

          // If ?img=filename is present, jump to it
          const params = new URLSearchParams(window.location.search);
          const req = params.get('img');
          if (req) {
            const idx = imgs.findIndex(o => o.name === req);
            if (idx >= 0) show(idx);
          } else {
            show(0);
          }

          hero.addEventListener('click', () => show(i + 1));
          window.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowRight') show(i + 1);
            if (e.key === 'ArrowLeft') show(i - 1);
          });
        })();
      </script>
    <?php endif; ?>

    <?php if ($page->text()->isNotEmpty()): ?>
      <div class="text">
        <?= $page->text()->kt() ?>
      </div>
    <?php endif; ?>
  </article>
</main>

<?php snippet('footer') ?>