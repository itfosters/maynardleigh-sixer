<?php 
?>
<input type="button" id="btnShow" value="Show Popup" />
    <div id="dialog" style="display: none" align="center">
        This is a jQuery Dialog.
    </div>


    <script type="text/javascript">
        $(function () {
            $("#dialog").dialog({
                modal: true,
                autoOpen: false,
                title: "jQuery Dialog",
                width: 300,
                height: 150
            });
            $("#btnShow").click(function () {
                $('#dialog').dialog('open');
            });
        });
    </script>