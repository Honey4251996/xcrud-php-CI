<?php
//require 'core/main_functions.php';
//secure_session_start();
if(is_login()){
	header('Location:dashboard');
	exit();
}
ini_db();
$db = $GLOBALS['db'];
$query = $db->prepare("SELECT `id`,`name` FROM `users` WHERE `status` = 1");
$query->execute();
$users = $query->fetchAll(PDO::FETCH_ASSOC);	
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<?php //<meta name="google-signin-client_id" content="379698351308-n16hmo8cdpihjq1u1lcjo2dm4tlvc1a7.apps.googleusercontent.com"> ?>
    <title>Laundry Drive</title>
	<link rel="icon" href="<?php echo base_url("assets/photos/favicon.png")?>" type="image/x-icon">

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url("assets/plugins/bootstrap/css/bootstrap.min.css")?>" rel="stylesheet">
    <!--<link href="plugins/gentelella-master/css/custom.min.css" rel="stylesheet">-->

    <!-- MetisMenu CSS -->
    <!--link href="css/metisMenu.min.css" rel="stylesheet"-->

    <!-- Custom CSS -->
    <!--link href="css/sb-admin-2.css" rel="stylesheet"-->
	
	<link href="<?php echo base_url("assets/css/login.min.css")?>" rel="stylesheet">


    <!-- Custom Fonts -->
    <link href="<?php echo base_url("assets/plugins/font-awesome/css/font-awesome.min.css")?>" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
<!--	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-117563868-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-117563868-1');
	</script>-->
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
                <div id="signin-panel" class="login-panel panel panel-default">
					<img class="logo" src="<?php echo base_url("assets/photos/logo.png")?>" alt="Logo">
                        <h3 class="panel-title message"><span class="fa fa-lock"></span> Sign In to your account</h3>
						<div id=alert  class="alert alert-danger" style="display:none"></div>
                        <form role="form" id="signin-form">
                            <fieldset>
								<?php if($login_type == 'username'): ?>
									<div class="form-group">
										<input id="user" class="form-control" placeholder="username" name="username" type="text" autofocus>
									</div>
								<?php else: ?>
									<div class="form-group">
										<select id="user" class="form-control" name="user" autofocus>
											<?php foreach($users as $user): ?>
												<option value="<?php echo $user['id'] ?>"><?php echo $user['name'] ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								<?php endif; ?>
                                <div class="form-group">
                                    <input id="password" class="form-control" placeholder="Password" name="password" type="password">
                                </div>
          
								<div class="form-group">
                                    <button id="submit-btn" class="btn btn-info btn-block btn-lg" type="submit">Login</button>
                                </div>
                            </fieldset>
                        </form>
                </div>
            </div>
        </div>
    </div>
	<script>if (typeof module === "object" && typeof module.exports === "object") {window.temp = module;module = undefined;}</script>
    <!-- jQuery -->
    <script src="<?php echo base_url("assets/js/jquery.min.js")?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url("assets/plugins/bootstrap/js/bootstrap.min.js")?>"></script>
	<script>if (window.temp) {module = window.temp;window.temp = undefined}</script>
    <!-- Metis Menu Plugin JavaScript -->
    <!--script src="js/metisMenu.min.js"></script-->

    <!-- Custom Theme JavaScript -->
    <!--script src="js/sb-admin-2.js"></script-->
	
	<script>
		$(document).ready(function(){
			$("#signin-form").on('submit', function(e) {
				e.preventDefault();
				var user = $("#user").val();
				var password = $("#password").val();
				
				$("#submit-btn").prop('disabled','true');
				if(password == "" || user == ""){
					$("#alert").text("Please fill the missing fields !!");
					$("#alert").slideDown();
					$("#alert").delay(2000).slideUp();
					setTimeout(function(){$("#submit-btn").prop("disabled",false)},2500);
					return;
				}
				
				$.post("logincode",
					{user:user,password:password},
					function(data,status,xhr){
						var obj = jQuery.parseJSON(data);
						if(obj.status =='failed') {
							$("#alert").text(obj.msg);
							//$("#alert").addClass('alert-danger');
							$("#alert").slideDown();
							$("#alert").delay(2000).slideUp();
							setTimeout(function(){$("#submit-btn").prop("disabled",false)},2500);
							return;
						}else
						if(obj.status == 'success'){
							$("#alert").text(obj.msg);
							$("#alert").removeClass('alert-danger');
							$("#alert").addClass('alert-success');
							$("#alert").slideDown();
							
							setTimeout(function(){window.location.href = "index.php";},500);
						}
					}
				
				);
				
				
			});
		});
		
	</script>

</body>

</html>
