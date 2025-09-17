<?php
/*
  Templates render the content of your pages.

  They contain the markup together with some control structures
  like loops or if-statements. The `$page` variable always
  refers to the currently active page.

  To fetch the content from each field we call the field name as a
  method on the `$page` object, e.g. `$page->title()`.

  This default template must not be removed. It is used whenever Kirby
  cannot find a template with the name of the content file.

  Snippets like the header and footer contain markup used in
  multiple templates. They also help to keep templates clean.

  More about templates: https://getkirby.com/docs/guide/templates/basics
*/
?>

<?php snippet('header') ?>


<main>
  <article class="section">
    <h1 class="page_title"><?= $page->title()->esc() ?></h1>

    <?php if ($img = $page->images()->shuffle()->first()): ?>
      <div class="random-image">
        <img src="<?= $img->url() ?>" alt="<?= $img->alt()->esc() ?>">
      </div>
    <?php endif; ?>

    <?php if ($page->text()->isNotEmpty()): ?>
      <div class="text">
        <?= $page->text()->kt() ?>
      </div>
    <?php endif; ?>
  </article>
</main>

