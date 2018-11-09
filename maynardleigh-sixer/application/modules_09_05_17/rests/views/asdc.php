
<!DOCTYPE html>
<html>
<head>
<title>Login Form in PHP with Session</title>
<link href="<?php echo ASSESTS_ULR.'css/style.css' ?>" rel="stylesheet" type="text/css">
</head>

<body>
<div id="main">

<h1></h1>
<div id="login">
<?php echo form_open('login/login_form') ?>
<form >
<label><b>Username or Email :</b></label>

<?php echo form_input(['id' =>'name','name'=>'email','placeholder'=>'username or email','required'=>'required'])?>

<!--<input id="name" name="email" placeholder="username or email" type="text" required="required">-->

<label><b>Password :</b></label>

<?php echo form_password(['id'=>'password','name'=>'password','placeholder'=>'password','required'=>'required'])?>

<!--<input id="password" name="password" placeholder="**********" type="password" required="required"><br/>-->
<?php echo
	form_submit(['id'=>'submit','name'=>'submit','value'=>'login']),
	form_reset(['id'=>'reset','name'=>'reset','value'=>'reset']) ?>
<!--<input name="submit" type="submit" value=" Login ">-->
<!--<input name="submit" type="button" value=" Reset ">-->

</form>
</div>
</div>
</body>
</html>