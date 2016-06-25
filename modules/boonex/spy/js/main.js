$(document).ready(function() {	
    var interval = $('#refreshtime').val();
	if(interval>0) {
	setInterval(function () {
    loadDynamicBlock(220, window.location.href+'?dynamic=tab');
	}, interval);
}
	
});	