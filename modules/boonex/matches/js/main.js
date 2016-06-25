$(document).ready(function() {
	var today = new Date();
	var now = today.toISOString().substring(0, 10);
	var todaytime = new Date(now).getTime();
$('#startdate, #enddate').change(function () {
            var startDt = $('#startdate').val();
            var endDt = $('#enddate').val();
			if(new Date(startDt).getTime() < todaytime) {
				alert("Start date can not be past date.");
                $('#startdate').val('');
			}
            if ((new Date(startDt).getTime() > new Date(endDt).getTime()))
            {
                alert("End date should not exceeds start date.");
                $('#enddate').val('');
            }
        });
$('#blockbooking').change(function () {
			
			var block_booking = document.querySelector('input[name="block_booking"]:checked').value;
			if(block_booking == 0){
				 $("#enddate").parent().parent().parent().hide();
			} else {
				$("#enddate").parent().parent().parent().show();
			}
        });
$('#starttime').change(function () {
			var hr = today.getHours();
			var startTime = $('#starttime').val();
			var startDt = $('#startdate').val();
			if(new Date(startDt).getTime() == todaytime){
				 if(startTime < hr) {
					 alert("Please select appropriate start time for today date.");
					 $('#starttime').val('');
				 }
				 
			}
        });	
	var interval = $('#refreshtime').val();
	if(interval>0) {
	setInterval(function () {
    loadDynamicBlock(188, window.location.href+'?dynamic=tab');
	loadDynamicBlock(192, window.location.href+'?dynamic=tab');
	loadDynamicBlock(193, window.location.href+'?dynamic=tab');
	loadDynamicBlock(203, window.location.href+'?dynamic=tab');
	}, interval);
	}
	
});		