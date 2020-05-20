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
                        <?php echo anchor('logistic/departure', '<i class="fa fa-paper-plane-o"></i> Salidas</a>', 'class="list-group-item" type="button"'); ?>
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
                  <?php if (! empty($departure)): ?>
                     <div class="box-body">
                        <div class="table-responsive">
                           <table class="table no-margin">
                              <thead>
                                 <tr>
                                    <th>Folio</th>
                                    <th>Destino</th>
                                    <th>Fecha</th>
                                    <th>Estatus</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php foreach ($departure as $departures): ?>
                                    <tr>
                                       <td><?php echo '<b>'.$departures->sheet_departure.'</b>'; ?></td>
                                       <td><i class="fa fa-map-marker"></i> <?php echo $departures->description_d; ?></td>
                                       <td title="<?php echo $departures->day; ?>">
                                          <i class="fa fa-calendar"></i> <?php $date = explode('-', $departures->plan_date); echo $date[2].'-'.$date[1].'-'.$date[0]; ?>
                                       </td>
                                       <?php if($departures->delivery_status === '0'): ?>
                                          <td><span class="label label-danger">Saliendo</span></td>
                                       <?php endif; ?>
                                       <?php if($departures->delivery_status === '1'): ?>
                                          <td><span class="label label-warning">En camino</span></td>
                                       <?php endif; ?>
                                       <?php if($departures->delivery_status === '3'): ?>
                                          <td><span class="label label-info">En pausa</span></td>
                                       <?php endif; ?>
                                       <?php if($departures->delivery_status === '4'): ?>
                                          <td><span class="label label-success">Arrivando</span></td>
                                       <?php endif; ?>
                                    </tr>
                                 <?php endforeach; ?>
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <div class="box-footer clearfix">
                        <p class="text-right">
                           <?php echo anchor('logistic/departure', 'Ver todas <i class="fa fa-eye"></i>', 'title="Ir a Salidas" type="button" class="btn btn-sm btn-info"'); ?>
                        </p>
                     </div>
                  <?php else: ?>
                     <div class="box-body">
                        <div class="panel panel-warning">
                           <div class="panel-heading">
                              <h3 class="panel-title">¡Error!</h3>
                           </div>
                           <div class="panel-body">
                              Aún no hay Salidas registradas. Da clic en el botón para agregar uno <?php echo anchor('logistic/departure/new', 'Nueva Salida <span class="fa fa-send"></span>&nbsp;<sup><i class="fa fa-plus"></i></sup>', 'type="button" class="btn btn-info btn-sm"'); ?>
                           </div>
                        </div>
                     </div>
                  <?php endif; ?>
               </div>
            </div>
         </div>
      </div>
      <div class="col-xs-1"></div>
   </section>
<?php $this->load->view('footer'); ?>
