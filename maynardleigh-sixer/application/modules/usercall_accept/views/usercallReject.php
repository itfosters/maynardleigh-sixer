<script>
        var reason = prompt("Please enter reason for rejection", "Not Available.");
        if (reason != null) {
            $.ajax({
                        url: FRONTURL +'usercall_accept/saverejectcomment',
                        dataType: 'json',
                        type:'post',
                        data: {
                            rejectreason: reason,
                            assigntimeid: '<?php echo $frmdata['assignTimeId'];?>'
                        },
                        success: function(){
                            alert("O ho..!! You have rejected your schedule. ");
                            window.close();
                        }
                    });
        }else{
            alert ("Please enter reason for rejection.");
            window.close();
        }
            
        </script>