
<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <title>Horticultura de Villada</title>
   <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/bootstrap/dist/css/bootstrap.css">
   <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/font-awesome/css/font-awesome.min.css">
   <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/Ionicons/css/ionicons.min.css">
   <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
   <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/iCheck/all.css">
   <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/select2/dist/css/select2.min.css">
   <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/AdminLTE.css">
   <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/skins/_all-skins.min.css">
   <link rel="stylesheet" href="<?php echo base_url();?>assets/complements/css/styles.css">
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-green-light layout-top-nav">
   <div class="wrapper">
      <header class="main-header">
         <nav class="navbar navbar-fixed-top">
            <div class="container">
               <div class="navbar-header">
                  <?php echo anchor('login/in_sess', '<b>Horticultura</b> de Villada', 'class="navbar-brand"');?>
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                     <i class="fa fa-bars"></i>
                  </button>
               </div>
               <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                  <ul class="nav navbar-nav">
                     <li class=""><?php echo anchor('buy', 'Compras', ''); ?></li>
                     <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Logística <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                           <li><?php echo anchor('logistic/logistic_index', '<i class="fa fa-road"></i>Logística', 'title="Inicio Lógistica"'); ?></li>
                           <li><?php echo anchor('logistic/driver', '<i class="fa fa-user"></i>Conductores</a>', ''); ?></li>
                           <li><?php echo anchor('logistic/vehicle', '<i class="fa fa-truck"></i>Vehiculos</a>', ''); ?></li>
                           <li><?php echo anchor('logistic/destiny', '<i class="fa fa-map-marker"></i>Destinos', ''); ?></li>
                        </ul>
                     </li>
                     <li class=""><?php echo anchor('', 'Ventas', ''); ?></li>
                     <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Menú <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                           <li><?php echo anchor('employee', '<i class="fa fa-user"></i>Empleados</a>', ''); ?></li>
                           <li><?php echo anchor('size_box', '<i class="fa fa-dropbox"></i>Cajas</a>', ''); ?></li>
                           <li><?php echo anchor('size', '<i class="fa fa-cubes"></i>Tamaños', ''); ?></li>
                           <li><?php echo anchor('product', '<span class="glyphicon glyphicon-apple"></span>Productos', ''); ?></li>
                           <li><?php echo anchor('producer', '<i class="fa fa-truck"></i>Proveedores</a>', ''); ?></li>
                        </ul>
                     </li>
                  </ul>
               </div>
               <div class="navbar-custom-menu">
                  <ul class="nav navbar-nav">
                     <li class="pull-right"><a href="<?=base_url()."login/cs_sess";?>"> Cerrar sesión <span class="glyphicon glyphicon-off"></span></a></li>
                  </ul>
               </div>
            </div>
         </nav>
      </header>
   </div>
   <!---El div que debería cerrar aqui, lo hace en footer.php-->
