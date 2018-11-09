 $(document).ready(function () {
   $('#main-menu').metisMenu();

    $(window).bind("load resize", function () {
        if ($(this).width() < 751) {
            $('div.sidebar-collapse').addClass('collapse')
        } else {
            $('div.sidebar-collapse').removeClass('collapse')
        }
    });

$('#attendencemenus').on('show.bs.dropdown', function(e) {
	
	$.ajax({
		url:FRONTURL+"attendence/attendenceblock",
		beforeSend:function(){
			$('#attendenceblock').addClass("loaders");
		},
		success:function(res){
			$('#attendenceblock').removeClass("loaders");
			$('#attendenceblock').html(res);
		}
	});
});
   $(document).ready(function(){
    $("#selecctall").change(function(){
      $(".checkbox1").prop('checked', $(this).prop("checked"));
      });
}); 
});
      