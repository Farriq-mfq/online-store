<div class="pagination-block">
    <ul class="pagination-btns flex-center">
        <li><a href="<?= $pager->getFirst() ?>" class="single-btn prev-btn ">|<i class="zmdi zmdi-chevron-left"></i> </a>
        </li>
        <li><a href="<?= $pager->getPreviousPage() ?>" class="single-btn prev-btn "><i class="zmdi zmdi-chevron-left"></i> </a>
        </li>
        <?php foreach ($pager->links() as $link) : ?>
            <li class="<?= $link['active'] ? 'active"' : '' ?>"><a href="<?= $link['uri'] ?>" class="single-btn"><?= $link['title'] ?></a></li>
        <?php endforeach ?>
        <li><a href="<?= $pager->getNextPage() ?>" class="single-btn next-btn"><i class="zmdi zmdi-chevron-right"></i></a>
        </li>
        <li><a href="<?= $pager->getLast() ?>" class="single-btn next-btn"><i class="zmdi zmdi-chevron-right"></i>|</a>
        </li>
    </ul>
</div>