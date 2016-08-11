	<table cellspacing="0">
		<tr>
<?php
		foreach ($table_header as $header) {
			echo $header;
		}
?>
		</tr>
<?php

		if (!$groups['error']) {

			foreach ($table_data as $row) {
?>
			<tr>
<?php
				foreach($row as $td) {
					echo $td;
				}
?>
			</tr>
<?php
			}

		}

?>
	</table>