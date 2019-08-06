<!DOCTYPE html>

<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Website using webSPELL-RM CMS">
    <meta name="copyright" content="Copyright &copy; 2017-2019 by webspell-rm.de">
    <meta name="author" content="webspell-rm.de">

    <link rel="SHORTCUT ICON" href="/admin/favicon.ico">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<script src="../components/bootstrap/bootstrap.min.css"></script>
<script src="../components/jquery/jquery.min.js"></script>

<link href="/admin/login/style.css" rel="stylesheet">
<title>Admin Login</title>
</head>
<body>
<div class="wrapper fadeInDown">
 <div id="formContent">
  <div class="fadeIn first"><span class="fa-stack fa-2x"> <i class="fas fa-user fa-stack-1x"></i> <i class="fas fa-ban fa-stack-2x" style="color:Tomato"></i></span><br /><b><u>ADMIN ONLY</u></b> </div>
  <form method="post" name="login" action="login/admincheck.php">
   <!--<input class="fadeIn second"  name="ws_user" type="text" placeholder="email" id="login" required>-->

   <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-envelope fa-fw"></i></div>
                            </div>
                            <input class="fadeIn second"  name="ws_user" type="text" placeholder="email" id="login" required>
                        </div>

   <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-lock fa-fw"></i></div>
                                </div>
                                <input class="fadeIn third" name="password" type="password" placeholder="Password" id="password" required>
                            </div>


   <!--<input class="fadeIn third" name="password" type="password" placeholder="Password" id="password" required>-->
   <input type="submit" name="submit" value="Login" class="fadeIn fourth">
  </form>
 </div>
</div>
</body>
