 $(document).ready(function () {
   $('#main-menu').metisMenu();

    $(window).bind("load resize", function () {
        if ($(this).width() < 751) {
            $('div.sidebar-collapse').addClass('collapse')
        } else {
            $('div.sidebar-collapse').removeClass('collapse')
        }
    });

    //Active and delete
	
    $('#itfactionevents').click(function(event) {
        if(this.checked) {
            $('.itfrowdatas').each(function() { 
                this.checked = true;
            });
        }else{
            $('.itfrowdatas').each(function() {
                this.checked = false;
            });        
        }
    });

	var checkboxes = $("#frmitf input[type='checkbox']"),submitButt = $(".itfdelete");
	submitButt.unbind("click");
	submitButt.attr("disabled", true);
	checkboxes.click(function() {			
			if(!checkboxes.is(":checked")) {							
				submitButt.unbind("click");
			}else{
				submitButt.bind("click");
			}
			submitButt.attr("disabled", !checkboxes.is(":checked"));
		});
	//End Active and delete

	$(".itfdelete").click(function()
		{
			var ids =$(this).attr("name");				  
			if(ids=="delete")
			{
			  if(confirm("Do you want to delete ?")) {				  
				  $("#itfaction").val("delete");
				  $("#frmitf").submit();
			  }
			}else{
				$("#itfaction").val(ids);
				 $("#frmitf").submit();
			}
		  
		});
});
      