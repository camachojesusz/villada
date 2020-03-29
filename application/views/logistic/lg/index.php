<?php //$this->load->view('logistic/header'); ?>
<?php $this->load->view('header'); ?>
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
                     <i class="fa fa-bars"></i>
                     <h3 class="box-title">Menú Logística</h3>
                     <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                     </div>
                  </div>
                  <div class="box-body">
                     <div class="list-group">
                        <?php echo anchor('logistic/logistic_index/', '<i class="fa fa-road"></i> Lógistica</a>', 'class="list-group-item" type="button" title="Inicio Lógistica"'); ?>
                        <?php echo anchor('logistic/driver/', '<i class="fa fa-user"></i> Conductores</a>', 'class="list-group-item" type="button"'); ?>
                        <?php echo anchor('logistic/vehicle/', '<i class="fa fa-truck"></i> Vehículos</a>', 'class="list-group-item" type="button"'); ?>
                        <?php echo anchor('logistic/destiny/', '<i class="fa fa-map-marker"></i> Destinos</a>', 'class="list-group-item" type="button"'); ?>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-xs-12 col-md-8">
               <div class="box box-primary">
                  <div class="box-header with-border">
                     <h3 class="box-title">Últimas salidas</h3>
                     <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                     </div>
                  </div>
                  <div class="box-body">
                     <div class="table-responsive">
                        <table class="table no-margin">
                           <thead>
                              <tr>
                                 <th>Orden</th>
                                 <th>Destino</th>
                                 <th>Estatus</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td><?php echo anchor('logistic/logistic_index', 'OR9842', ''); ?></td>
                                 <td><i class="fa fa-map-marker"></i> CENTRAL TOLUCA</td>
                                 <td><span class="label label-success">Arrivando</span></td>
                              </tr>
                              <tr>
                                 <td><?php echo anchor('logistic/logistic_index', 'OR1848', ''); ?></td>
                                 <td><i class="fa fa-map-marker"></i> CENTRAL CDMX</td>
                                 <td><span class="label label-warning">En camino</span></td>
                              </tr>
                              <tr>
                                 <td><?php echo anchor('logistic/logistic_index', 'OR7429', ''); ?></td>
                                 <td><i class="fa fa-map-marker"></i> PUEBLA</td>
                                 <td><span class="label label-danger">Saliendo</span></td>
                              </tr>
                              <tr>
                                 <td><?php echo anchor('logistic/logistic_index', 'OR7429', ''); ?></td>
                                 <td><i class="fa fa-map-marker"></i> HORTIMEX</td>
                                 <td><span class="label label-info">En pausa</span></td>
                              </tr>
                              <tr>
                                 <td><?php echo anchor('logistic/logistic_index', 'OR1848', ''); ?></td>
                                 <td><i class="fa fa-map-marker"></i> CENTRAL TOLUCA</td>
                                 <td><span class="label label-warning">En camino</span></td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <div class="box-footer clearfix">
                     <p class="text-right">
                        <?php echo anchor('logistic/logistic_index_index', 'Ver todas <i class="fa fa-eye"></i>', 'type="button" class="btn btn-sm btn-info"'); ?>
                     </p>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-xs-1"></div>
   </section>
<?php $this->load->view('footer'); ?>
