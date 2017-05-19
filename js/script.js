$(document).ready(function () {
    $('#check-yes').change(function () {
    	if (this.checked)
    		$('.delete-done').removeClass('visible');
    	else
    		$('.delete-done').addClass('visible');
    })
});