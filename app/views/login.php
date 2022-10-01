<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<head>

    <title>Login - Canvas Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="">
    <meta name="author" content=""/>

    <link rel="stylesheet"
          href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,800italic,400,600,800"
          type="text/css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css" type="text/css"/>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="assets/js/libs/css/ui-lightness/jquery-ui-1.9.2.custom.css" type="text/css"/>

    <link rel="stylesheet" href="assets/css/App.css" type="text/css"/>
    <link rel="stylesheet" href="assets/css/login.css" type="text/css"/>

    <link rel="stylesheet" href="assets/css/custom.css" type="text/css"/>

</head>

<body>

<div id="login-container">

    <div id="logo">
        <a href="./login.html">
            <img src="assets/img/logos/logo-login.png" alt="Logo" style="width:100%"/>
        </a>
    </div>
    <div id="login">
        <h3>SISTEMA PARA GESTÃO DE TELEFONIA MÓVEL</h3>
        <h5>Para conectar informe usuário e senha!</h5>
        <form action="<?php echo BASEURL_SGT ?>loga" method="POST" autocomplete="off">
            <div class="form-group">
                <label for="login-username">Login</label>
                <input type="text" class="form-control" name="inputuser"  id="inputuser"
                       placeholder="Usuário">
            </div>
            <div class="form-group">
                <label for="login-password">Senha</label>
                <input type="password" class="form-control" id="inputsenha"  name="inputsenha"
                       placeholder="Senha">
            </div>
            <div class="form-group">
                <button type="submit" id="login-btn" class="btn btn-primary btn-block ">Conectar &nbsp; <i
                            class="fa fa-play-circle"></i></button>
            </div>
        </form>
        <?php if(!empty($mensagem)): ?>
            <div class="alert alert-danger" role="alert"><?= $mensagem ?></div>
        <?php endif; ?>
    </div> <!-- /#login -->


</div> <!-- /#login-container -->

<script src="assets/js/libs/jquery-1.9.1.min.js"></script>
<script src="assets/js/libs/jquery-ui-1.9.2.custom.min.js"></script>
<script src="assets/js/libs/bootstrap.min.js"></script>

<script src="assets/js/App.js"></script>

<script src="assets/js/Login.js"></script>

</body>
</html>