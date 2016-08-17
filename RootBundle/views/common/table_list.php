	<table cellspacing="0">
		<tr>
<?php
		foreach ($table_header as $header) {
			echo $header;
		}
?>
		</tr>
<?php

		if (count($this->_errorArray) == 0) {

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