$(document).ready(function () {
    $('#check-yes').change(function () {
    	if (this.checked)
    		$('.delete-done').removeClass('visible');
    	else
    		$('.delete-done').addClass('visible');
    })
});

$(document).ready(function () {
    $('#check-yes').change(function () {
    	if (this.checked) {
    		$('.item-register').removeClass('visible');
    		$('.item-login').addClass('visible');
    	}
    		
    	else {
    		$('.item-register').addClass('visible');
    		$('.item-login').removeClass('visible');
    	}
    		
    })
});