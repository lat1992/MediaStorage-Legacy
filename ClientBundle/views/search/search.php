<?php
require_once('ClientBundle/views/layout/header.php');
?>
<link rel="stylesheet" type="text/css" href="ClientBundle/ressources/search/css/styles.css" />
<div class="searchbox">
    <form method="get">
    	<input type="hidden" name="page" value="search">
        <input type="text" id="keyword" name="keyword" onkeyup="ajaxRefreshLiveSearch(this.value)" autocomplete="off" />
        <input type="submit" value="&#x1f50d;" id="submitButton" />
        <div id="livesearch"></div>
    </form>
</div>

<script>
	function ajaxRefreshLiveSearch(value) {
		if (value){
			$.ajax({
				url: "?page=ajax_refresh_live_search&keyword="+value,
				type: 'GET',
				success: function(result, status) {
					if (!result)
						return ;
	                console.log(result);
					var data = JSON.parse(result);
					var $html = '';
					for (var i = 0; i < data.length; i++) {
						$html += data[i].data + '<br/>';
					}
					$('#livesearch').html($html);
				},
				error: function(result, status, error) {
					console.log('ERROR : ');
					console.log(error);
				}
			});
		}
		else {
			$('#livesearch').html('');
		}
	}
</script>

<?php
require_once('ClientBundle/views/layout/footer.php');
?>
