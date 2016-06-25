$(document).ready(function() {	
    var interval = $('#refreshtime').val();
	if(interval>0) {
	setInterval(function () {
    loadDynamicBlock(140, window.location.href+'?dynamic=tab');
	loadDynamicBlock(144, window.location.href+'?dynamic=tab');
	loadDynamicBlock(145, window.location.href+'?dynamic=tab');
	loadDynamicBlock(155, window.location.href+'?dynamic=tab');
	}, interval);
	}
	
});	