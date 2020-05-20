<!DOCTYPE html>
<html>
<head>
   <title>Horticultura de Villada</title>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <link rel="icon" href="<?php echo base_url();?>assets/complements/img/villada_ico.ico">
   <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
   <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/font-awesome/css/font-awesome.min.css">
   <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/Ionicons/css/ionicons.min.css">
   <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/AdminLTE.css">
   <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/iCheck/square/blue.css">
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>   
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <b>Horticultura</b> de Villada
  </div>

  <div class="login-box-body">
    <h3 class="display-4 text-center">Iniciar Sesión</h3><hr>
      <?php
      echo form_open('login/is_post', array('method' => 'POST', 'autocomplete' => 'off'));


      if (isset($user_false)) {
        //Si existe esta variable es porque hay un error de usuario o contraseña
      ?>
      <div class="alert alert-danger">
        <button class="close" data-dismiss= "alert"><span>&times;</span></button>
        <strong>¡Error!</strong> Usuario o contraseña incorrectos
      </div>
      <?php
      }
      ?>
      <div class="form-group has-feedback">
        <label for="txtuser">Usuario</label>
        <input type="text" id="txtuser" name="txtuser" class="form-control" placeholder="usuario" autofocus="" required="" value="<?php if (isset($info_user) && !empty($info_user)) {echo $info_user['user_name'];}?>">
        <i class="fa fa-user form-control-feedback"></i>
      </div>

      <div class="form-group has-feedback">
        <label for="txtpass">Contraseña</label>
        <input type="password" id="txtpass" name="txtpass" class="form-control" placeholder="contraseña" required="" value="">
        <i class="fa fa-lock form-control-feedback"></i>
      </div>

      <div class="row">
        <div class="col-xs-12">
          <button type="submit" class="btn btn-success btn-block btn-flat"><b>Ingresar</b> <span class="glyphicon glyphicon-log-in"></span></button>
          <hr>
          <p class="text-center">
            <!--<a href="#">Olvidé mi contraseña</a><br>-->
          </p>
        </div>
      </div>

    </form>
  </div>
</div>

<script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/iCheck/icheck.min.js"></script>
</body>
</html>
