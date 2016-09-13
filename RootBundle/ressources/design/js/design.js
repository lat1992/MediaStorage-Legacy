$( document ).ready(function() {

	 $(document).on('input', 'input[type=color]', function(e) {
	 	$(this).next().val($(this).val());
	 });

	$(document).on('change paste', 'input[type=text]', function(e) {
	 	$(this).prev().val($(this).val());
	 });
});