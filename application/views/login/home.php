<?php $this->load->view('header');?>
<section class="seccion">
   <div class="col-xs-1"></div>
   <div class="col-xs-10">
      <section class="content-header">
         <h1>Panel principal <small><strong>Inicio</strong></small></h1>
         <ol class="breadcrumb">
            <li><?php echo anchor('login/in_sess', '<span class="glyphicon glyphicon-home"></span> Inicio', ''); ?></li>
         </ol>
      </section>
      <hr>
      <div class="row">
         <div class="col-md-4">
            <!-- <img src="<?php //echo base_url(); ?>assets/complements/img/villada_img.jpeg" class="img-responsive"> -->
            <img src="<?php echo base_url(); ?>assets/complements/img/villada_img_s_f.png" class="img-responsive">
         </div>
         <div class="col-xs-12 col-md-4">
            <div class="box box-primary">
               <div class="box-header with-border">
                  <i class="fa fa-bars"></i>
                  <h3 class="box-title">Menú</h3>
                  <div class="box-tools pull-right">
                     <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
               </div>
               <div class="box-body">
                  <div class="list-group">
                     <?php echo anchor('employee', '<i class="fa fa-user"></i> Empleados</a>', 'class="list-group-item" type="button"'); ?>
                     <?php echo anchor('size_box', '<i class="fa fa-dropbox"></i> Cajas</a>', 'class="list-group-item" type="button"'); ?>
                     <?php echo anchor('size', '<i class="fa fa-cubes"></i> Tamaños', 'class="list-group-item" type="button"'); ?>
                     <?php echo anchor('product', '<span class="glyphicon glyphicon-apple"></span> Productos', 'class="list-group-item" type="button"'); ?>
                     <?php echo anchor('producer', '<i class="fa fa-truck"></i> Proveedores</a>', 'class="list-group-item" type="button"'); ?>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-xs-12 col-md-4">
            <div class="box box-primary">
               <div class="box-header with-border">
                  <i class="fa fa-bars"></i>
                  <h3 class="box-title">Menú Logística</h3>
                  <div class="box-tools pull-right">
                     <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
               </div>
               <div class="box-body">
                  <div class="list-group">
                     <?php echo anchor('logistic/logistic_index/', '<i class="fa fa-road"></i> Logística</a>', 'class="list-group-item" type="button" title="Inicio Lógistica"'); ?>
                     <?php echo anchor('logistic/driver', '<i class="fa fa-user"></i> Conductores</a>', 'class="list-group-item" type="button"'); ?>
                     <?php echo anchor('logistic/vehicle', '<i class="fa fa-truck"></i> Vehículos</a>', 'class="list-group-item" type="button"'); ?>
                     <?php echo anchor('logistic/destiny', '<i class="fa fa-map-marker"></i> Destinos</a>', 'class="list-group-item" type="button"'); ?>
                     <?php echo anchor('logistic/departure', '<i class="fa fa-paper-plane-o"></i> Salidas</a>', 'class="list-group-item" type="button"'); ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-xs-1"></div>
</section>
<?php $this->load->view('footer');?>
