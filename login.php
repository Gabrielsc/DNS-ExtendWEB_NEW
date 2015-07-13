<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/icons/favicon.ico">
    <link rel="apple-touch-icon" href="images/icons/favicon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/icons/favicon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/icons/favicon-114x114.png">
    <!--Loading bootstrap css-->
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700">
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,700,300">
    <link type="text/css" rel="stylesheet" href="styles/jquery-ui-1.10.4.custom.min.css">
    <link type="text/css" rel="stylesheet" href="styles/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="styles/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="styles/animate.css">
    <link type="text/css" rel="stylesheet" href="styles/all.css">
    <link type="text/css" rel="stylesheet" href="styles/main.css">
    <link type="text/css" rel="stylesheet" href="styles/style-responsive.css">
    <link type="text/css" rel="stylesheet" href="styles/zabuto_calendar.min.css">
    <link type="text/css" rel="stylesheet" href="styles/pace.css">
    <link type="text/css" rel="stylesheet" href="styles/jquery.news-ticker.css">

	<link rel="stylesheet" type="text/css" href="styles/my_style.css">

    
</head>
<body class="page-login">
	<div class="form-login">
		<h2>DNS-Extend-WEB</h2><br>
		<div class="panel panel-grey">
            <div class="panel-heading">Login</div>
            <div class="panel-body pan">
            	<br>
            	<div id="icon-contact">
				
				</div>
                <form action="login-validar.php" method="post" class="form-horizontal">
                <div class="form-body pal">

                    <div class="form-group">
                        <label for="inputPassword" class="col-md-3 control-label">
                            IP Servidor</label>
                        <div class="col-md-9">
                            <div class="input-icon right">
                                <i class="fa fa-lock"></i>
                                <input id="inputIp" type="text" class="form-control" name="ipserver" /></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputLogin" class="col-md-3 control-label">Login</label>
                        <div class="col-md-9">
                            <div class="input-icon right">
                                <i class="fa fa-user"></i>
                                <input id="inputLogin" type="text" class="form-control" name="login" /></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-md-3 control-label">
                            Password</label>
                        <div class="col-md-9">
                            <div class="input-icon right">
                                <i class="fa fa-lock"></i>
                                <input id="inputPassword" type="password" placeholder="" class="form-control" name="senha" /></div>
                            <span class="help-block mbn"><a href="#"><small>Forgot password?</small> </a></span>
                        </div>
                    </div>
                    
                    <div class="col-md-offset-3 col-md-6">
                        <button type="submit" class="btn btn-primary">
                            Login
                        </button>
                        <a href="cadastrar.php">Cadastrar</a>
                    </div>
                    
                </div>
                <div class="form-actions pal">
                    <div class="form-group mbn">
                        
                    </div>
                </div>
                </form>
            </div>
        </div>
	</div>
    <br>
    <br>
    <br>
	<footer>
        DNS-ExtendsWEB - Desenvolvido por Gabriel Cavalcante e Kaio Moura.
    </footer>
</body>
</html>