<!DOCTYPE html>
<html lang="en"><head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="hrm of itfosters">
        <meta name="author" content="itfosters">
        <title><?php echo $template['title']; ?></title>
        <link href="<?php echo base_url("assests/css"); ?>/bootstrap.css" rel="stylesheet">
        <link href="<?php echo base_url("assests/css"); ?>/font-awesome.css" rel="stylesheet">
        <link href="<?php echo base_url("assests/css"); ?>/style.css" rel="stylesheet">
    </head>
    <body>
        
            <?php echo $template['body']; ?>
        
    </body>
     <script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
     <script>
        $("label").click(function(){
        $(this).parent().find("label").css({"background-color": "#D8D8D8"});
        $(this).css({"background-color": "#7ED321"});
        $(this).nextAll().css({"background-color": "#7ED321"});
        });
     </script>
</html>