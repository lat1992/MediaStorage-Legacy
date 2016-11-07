<?php
	if (isset($total_pages) && isset($current_page)) {
?>
		<div class="div-paging">
<?php
			$query = $_GET;

			for ($i = 1; $i <= $total_pages; $i++) {
				$query['paginate'] = $i;
				$query_result = http_build_query($query);

				if ($current_page == $i)
					$page_number = '<b>' . $i . '</b>';
				else
					$page_number = '<span>' . $i . '</span>';
?>
				<a href="<?= $_SERVER['PHP_SELF'] . '?' . $query_result ?>" class="link-paging"><?= $page_number ?></a>&nbsp;&nbsp;
<?php
			}
?>
		</div>
<?php
	}
?>
