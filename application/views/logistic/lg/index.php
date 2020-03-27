<?php $this->load->view('logistic/header'); ?>
   <section class="seccion">
      <div class="col-xs-1"></div>
      <div class="col-xs-10">
         <section class="content-header">
            <h1>Logística</h1>
            <ol class="breadcrumb">
               <li><?php echo anchor('logistic/logistic_index', '<span class="glyphicon glyphicon-home"></span> Inicio</a>','title="Inicio Logística"'); ?></li>
            </ol>
         </section>
         <hr>
         <div class="row">
            <div class="col-xs-12 col-md-4">
               <div class="box box-primary">
                  <div class="box-header with-border">
                     <i class="fa fa-road"></i>
                     <h3 class="box-title">Logística</h3>
                     <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                     </div>
                  </div>
                  <div class="box-body">
                     <div class="list-group">
                        <?php echo anchor('logistic/drivers/driver_index', '<i class="fa fa-user"></i> Conductores</a>', 'class="list-group-item" type="button"'); ?>
                        <?php echo anchor('logistic/vehicles/vehicles_index', '<i class="fa fa-truck"></i> Vehículos</a>', 'class="list-group-item" type="button"'); ?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-xs-1"></div>
   </section>
<?php $this->load->view('footer'); ?>
