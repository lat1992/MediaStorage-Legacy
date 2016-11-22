function removeSearchListOnClick() {
	$('body').on('click', function(){
		$('#livesearchonsearchpage').html('');
		$('#livesearch').html('');
	});
}

removeSearchListOnClick();

function ajaxRefreshLiveSearch(value) {
	if (value){
		$.ajax({
			url: "?page=ajax_refresh_live_search&keyword="+value,
			type: 'GET',
			success: function(result, status) {
				if (!result) {
					return ;
				}
				var data = JSON.parse(result);
				var $html = '';
				for (var i = 0; i < data.length; i++) {
					$html += '<div class="livesearch-result"><a href="?page=search&keyword='+ data[i].data +'&paginate=1">' + data[i].data + '</a></div>';
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

function ajaxRefreshLiveSearchOnSearchPage(value) {
	if (value){
		$.ajax({
			url: "?page=ajax_refresh_live_search&keyword="+value,
			type: 'GET',
			success: function(result, status) {
				if (!result) {
					return ;
				}
				var data = JSON.parse(result);
				var $html = '';
				for (var i = 0; i < data.length; i++) {
					$html += '<div class="livesearch-result"><a href="?page=search&keyword='+ data[i].data +'&paginate=1">' + data[i].data + '</a></div>';
				}
				$('#livesearchonsearchpage').html($html);
			},
			error: function(result, status, error) {
				console.log('ERROR : ');
				console.log(error);
			}
		});
	}
	else {
		$('#livesearchonsearchpage').html('');
	}
}