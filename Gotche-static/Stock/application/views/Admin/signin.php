
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Admin Dasboard Sign in| Gotche</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url() ?>bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="<?php echo base_url() ?>css/signin/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url() ?>css/signin/signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="<?php echo base_url() ?>js/signin/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<style>
		.error{
			color:red;
		}
		body{
			background-color:#F7F9FB !important;
		}
	
	</style>
  </head>

  <body>

    <div class="container">
	<div class="row" style="padding-top:50px">
	<h4>Admin Login</h4>
	<div class="col-lg-4" style="background-color:white;padding:20px;box-shadow:0 2px 2px 0 rgba(0,0,0,0.14), 0 3px 1px -2px rgba(0,0,0,0.12), 0 1px 5px 0 rgba(0,0,0,0.2)">

      <?php //echo validation_errors(); ?>

<?php echo form_open('admin/login'); ?>

<div class="form-group">
    <label for="email">Username:</label>
    <input type="text" name="username" value="" class="form-control" id="" placeholder="Enter username">
  </div>
  
<?php echo form_error('username','<div class="error">', '</div>'); ?>
<div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" name="password" value="" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
    </div>
<?php echo form_error('password','<div class="error">', '</div>'); ?>

<div><button type="submit" class="btn" style="background-color:maroon; color: white">Login</button></div>

</form>

    </div> <!-- /container -->
	
	</div>
	</div>


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo base_url() ?>js/signin/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>

