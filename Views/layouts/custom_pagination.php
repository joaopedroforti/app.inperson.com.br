<?php $pager->setSurroundCount(2) ?>

<nav aria-label="Page navigation">
  <ul class="pagination pagination-rounded">
    <?php if ($pager->hasPrevious()) : ?>
      <li class="paginate_button page-item previous" id="basic-datatable_previous">
            <a href="<?= $pager->getPrevious() ?>" aria-controls="basic-datatable" tabindex="0" class="page-link">
                <i class="mdi mdi-chevron-left"></i>
            </a>
        </li>
    <?php endif ?>

    <?php foreach ($pager->links() as $link) : ?>
      <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
        <a class="page-link" href="<?= $link['uri'] ?>">
          <?= $link['title'] ?>
        </a>
      </li>
    <?php endforeach ?>

    <?php if ($pager->hasNext()) : ?>
        <li class="paginate_button page-item next" id="basic-datatable_next">
            <a href="<?= $pager->getNext() ?>" aria-controls="basic-datatable" tabindex="0" class="page-link">
                <i class="mdi mdi-chevron-right"></i>
            </a>
        </li>
    <?php endif ?>
  </ul>
</nav>