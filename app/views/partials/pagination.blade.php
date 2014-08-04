<?php
	$presenter = new MotionryPaginationPresenter($paginator);
	$trans = $environment->getTranslator();
?>

<?php if ($paginator->getLastPage() > 1): ?>
	<div class="pagination">
		<ul>
            <?php echo $presenter->getPrevious($trans->trans('pagination.previous')); ?>

            <?php $lastPage = $paginator->getLastPage() > ($paginator->getCurrentPage() + 2) ? $paginator->getCurrentPage() + 2 : $paginator->getLastPage(); ?>
            <?php echo $presenter->getPageRange($paginator->getCurrentPage(), $lastPage); ?>

            <?php echo $presenter->getNext($trans->trans('pagination.next')); ?>
		</ul>
	</div>
<?php endif; ?>
