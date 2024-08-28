<section class="pagination">
	<!-- First page -->
	<a href="/" class="pag__first <?php if (!isset($page_id) || (int)$page_id === 1) echo 'dis'; ?>">
		<img src="../../public/assets/icons/left-m.svg" alt="First"/>
	</a>

	<!-- Back page -->
	<a href="?page=<?= $page_id - 1 ?>"
	   class="pag__back <?php if (!isset($page_id) || (int)$page_id === 1) echo 'dis'; ?>">
		<img src="../../public/assets/icons/left.svg" alt="Back"/>
	</a>

	<!-- Links -->
	<?php

	if (!isset($page_id)) {
		echo '<a href="/" class="pag__page active"><span>1</span></a>';
		$count_from = 2;
	} else {
		$count_from = 1;
	}

	for ($num = $count_from; $num <= $pages; $num++) {
		if ($num == $page_id) {
			echo '<a href="?page=' . $num . '" class="pag__page active"><span>' . $num . '</span></a>';
		} else {
			echo '<a href="?page=' . $num . '" class="pag__page"><span>' . $num . '</span></a>';
		}
	}
	?>

	<!-- Next page -->
	<?php
	if ($page_id < $pages) {
		if (!isset($page_id)) {
			echo '
              <a href="?page=2" class="pag__next ">
                <img src="../../public/assets/icons/right.svg" alt="Next" />
              </a>
            ';
		} else {
			echo '
              <a href="?page=' . $page_id + 1 . '" class="pag__next ">
                <img src="../../public/assets/icons/right.svg" alt="Next" />
              </a>
            ';
		}
	} else {
		echo '
            <a href="#" class="pag__next dis">
              <img src="../../public/assets/icons/right.svg" alt="Next" />
            </a>
          ';
	}
	?>

	<!-- Last page -->
	<a href="?page=<?= $pages ?>" class="pag__last <?php if ((int)$page_id === (int)$pages) echo 'dis'; ?>"
	   type="button">
		<img src="../../public/assets/icons/right-m.svg" alt="Last"/>
	</a>
</section>