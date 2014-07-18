<?php
	$presenter = new MotionryPaginationPresenter($paginator);
?>

<?php if ($paginator->getLastPage() > 1): ?>
	<ul class="pager-nav">
		<?php
			echo $presenter->getPrevious('prev');

			echo $presenter->getNext('next');
		?>
	</ul>
<?php endif; ?>

