<table class="table-list" cellspacing="0">
	<tr>
<?php
		foreach ($table_data['header'] as $header) {
			echo $header;
		}
?>
	</tr>
<?php

	if (count($this->_errorArray) == 0) {

		foreach ($table_data['data'] as $row) {
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