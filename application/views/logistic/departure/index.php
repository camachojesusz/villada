<?php $this->load->view('header'); ?>
<section class="seccion">
   <div class="col-xs-1"></div>
   <div class="col-xs-10">
      <section class="content-header">
         <h1>Salidas</h1>
         <ol class="breadcrumb">
            <li><?php echo anchor('logistic/logistic_index', '<span class="glyphicon glyphicon-home"></span> Inicio</a>','title="Inicio Logística"'); ?></li>
            <li class="active">Salidas</li>
         </ol>
      </section>
      <hr>
      <div class="row">
         <?php if (validation_errors()): ?>
            <div class="col-xs-12">
               <br>
               <div class="callout callout-danger">
                  <h4>¡Error!</h4>
                  <p class="">
                     <ul>
                        <?php echo validation_errors(); ?>
                     </ul>
                  </p>
                  <p>Por favor verifíca los datos e inténtalo de nuevo.</p>
               </div>
            </div>
         <?php endif; ?>
         <?php if(isset($departure) && ! empty($departure)): ?>
            <div class="col-xs-12">
               <div class="box box-primary">
                  <?php if(isset($succes_dp)): ?>
                     <br>
                     <div class="callout callout-success">
                        <h4>¡Correcto!</h4>
                        <p class="">Se ha registrado una nueva <b>Salida</b></p>
                     </div>
                  <?php endif; ?>
                  <?php if(isset($update_dp)): ?>
                     <br>
                     <div class="callout callout-info">
                        <h4>¡Aviso!</h4>
                        <p class="">La información de una <b>Salida</b> ha sido modificada</p>
                     </div>
                  <?php endif; ?>
                  <?php if(isset($status_alert)): ?>
                     <br>
                     <div class="callout callout-<?php echo ($status_alert === '0') ? 'warning' : 'info' ; ?>">
                        <h4><?php echo ($status_alert === '0') ? '¡Atención!' : '¡Aviso!' ; ?></h4>
                        <p class=""><?php echo ($status_alert === '0') ? 'Una <b>Salida</b> ha sido eliminado' : 'Una <b>Salida</b> ha sido reactivado' ; ?></p>
                     </div>
                  <?php endif; ?>
                  <div class="box-header pull-right">
                     <p class="box-title">
                        <?php echo anchor('logistic/departure/new', 'Nueva Salida <span class="fa fa-send"></span>&nbsp;<sup><i class="fa fa-plus"></i></sup>', 'type="button" class="btn btn-info btn-sm"'); ?>
                     </p>
                  </div>
                  <div class="box-body">
                     <div id="buy_wrapper" class="dataTables_wrapper dt-bootstrap">
                        <div class="row">
                           <div class="col-sm-12 table-responsive">
                              <table id="buy" class="table table-bordered table-striped table-hover table-condensed dataTable" role="grid" aria-describedby="buy_info">
                                 <thead>
                                    <tr role="row">
                                       <th hidden=""><?php echo ''; ?> </th>
                                       <th>Folio</th>
                                       <th>Destino</th>
                                       <th>Fecha</th>
                                       <th>Estatus</th>
                                       <th>Opciones</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php foreach ($departure as $departures): ?>
                                       <tr role="row">
                                          <td hidden=""><?php echo $departures->departure_id; ?></td>
                                          <td>
                                             <?php echo $departures->sheet_departure; ?>
                                          </td>
                                          <td>
                                             <i class="fa fa-map-marker"></i> <?php echo $departures->description_d; ?>
                                          </td>
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
                                          <td class="text-center">
                                             <a href="#modal_more_<?php echo $departures->departure_id;?>" type="button" class="btn btn-xs btn-default" data-toggle="modal" data-target="#modal_more_<?php echo $departures->departure_id;?>" title="Ver más"><i class="fa fa-eye"></i></a>
                                             <?php echo anchor('logistic/departure/edit/'.$departures->departure_id.'/'.$departures->driver_type.'/'.$departures->driver_id, '<i class="fa fa-edit"></i>', 'type="button" class="btn btn-primary btn-xs" title="Editar"'); ?>
                                             <?php if ($departures->status === '1'): ?>
                                                <a href="#modal_delete_<?php echo $departures->departure_id;?>" type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modal_delete_<?php echo $departures->departure_id; ?>" title="Eliminar">
                                                   <i class="fa fa-remove"></i>
                                                </a>
                                             <?php else: ?>
                                             <?php echo anchor('logistic/departure/status/'.$departures->status.'/'.$departures->driver_id, '<i class="fa fa-check"></i>', 'type="button" class="btn btn-xs btn-info" title="Activar"'); ?>
                                             <?php endif; ?>
                                          </td>
                                       </tr>
                                       <div class="modal fade" id="modal_more_<?php echo $departures->departure_id; ?>">
                                          <div class="modal-dialog">
                                             <div class="modal-content">
                                                <div class="modal-header">
                                                   <button type="button" class="close" data-dismiss="modal">
                                                      <span aria-hidden="true">&times;</span>
                                                   </button>
                                                   <h3 class="modal-title">Salida <small class="lead"> <?php echo $departures->sheet_departure; ?></small></h3>
                                                </div>
                                                <div class="modal-body">
                                                   <div class="row">
                                                      <div class="col-xs-12">
                                                         <div class="box box-primary">
                                                            <div class="box-header with-border">
                                                               <h3 class="box-title">Destino</h3>
                                                               <div class="box-tools pull-right">
                                                                  <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Maximizar"><i class="fa fa-plus"></i></button>
                                                               </div>
                                                            </div>
                                                            <div class="box-body row">
                                                               <div class="col-xs-12">
                                                                  <div class="form-group">
                                                                     <div class="col-xs-12 col-md-6"><p><i class="fa fa-map-marker"></i> <?php echo $departures->description_d; ?></p></div>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <div class="col-xs-12">
                                                         <div class="box box-primary">
                                                            <div class="box-header with-border">
                                                               <h3 class="box-title">Vehículo - Conductor</h3>
                                                               <div class="box-tools pull-right">
                                                                  <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Minimizar"><i class="fa fa-minus"></i></button>
                                                               </div>
                                                            </div>
                                                            <div class="box-body">
                                                               <div class="row">
                                                                  <div class="col-xs-12 col-md-6">
                                                                     <p>
                                                                        <i class="fa fa-user"></i></label>
                                                                        &nbsp;
                                                                     </p>
                                                                  </div>
                                                                  <div class="col-xs-12 col-md-6"><p><i class="fa fa-truck"></i></label>&nbsp;<?php echo '<b>'.$departures->key_v.'</b> - '.$departures->description_v; ?></p></div>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <div hidden class="col-xs-12">
                                                         <div class="box collapsed-box box-primary">
                                                            <div class="box-header with-border">
                                                               <h3 class="box-title">Fecha - Día</h3>
                                                               <div class="box-tools pull-right">
                                                                  <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Minimizar"><i class="fa fa-minus"></i></button>
                                                               </div>
                                                            </div>
                                                            <div class="box-body">
                                                               <div class="row">
                                                                  <div class="col-xs-12 col-md-6"><p><i class="fa fa-calendar"></i> <?php $date = explode('-', $departures->plan_date); echo $date[2].'-'.$date[1].'-'.$date[0]; ?></p></div>
                                                                  <div class="col-xs-12 col-md-6"><p><?php echo $departures->day; ?></p></div>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="modal-footer">
                                                   <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cerrar <i class="fa fa-remove"></i></button>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="modal fade" id="modal_delete_<?php echo $departures->departure_id; ?>">
                                          <div class="modal-dialog">
                                             <div class="modal-content">
                                                <?php echo form_open('logistic/departure/set_info', ['autocomplete' => 'off']); ?>
                                                <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal">
                                                     <span aria-hidden="true">&times;</span></button>
                                                     <h3 class="modal-title">Eliminar Salida <small><?php echo $departures->sheet_departure; ?></small></h3>
                                                </div>
                                                <div class="modal-body row">
                                                   <div class="col-xs-12">
                                                      <div class="callout callout-warning">
                                                         <h4><i class="fa fa-warning"></i> Advertencia</h4>
                                                         <p>Está a punto de eliminar una <b>Salida</b>, si está seguro de esto presione <b>Continuar</b></p>
                                                      </div>
                                                   </div>
                                                   <div class="col-xs-12">
                                                      <div class="box box-warning">
                                                         <div class="box-header whit-border">
                                                            <h3 class="box-title">Salida</h3>
                                                            <div class="box-tools pull-right">
                                                               <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Minimizar">
                                                                  <i class="fa fa-minus"></i>
                                                               </button>
                                                            </div>
                                                         </div>
                                                         <div class="box-body">
                                                            <div class="row">
                                                               <div class="col-xs-12 col-md-4">
                                                                  <p><b>Folio:</b><br><?php echo $departures->sheet_departure; ?></p>
                                                               </div>
                                                               <div class="col-xs-12 col-md-4">
                                                                  <p><b>Destino:</b><br><?php echo $departures->description_d; ?></p>
                                                               </div>
                                                               <div class="col-xs-12 col-md-4">
                                                                  <p title="<?php echo $departures->day; ?>"><b>Fecha:</b><br><?php echo $departures->plan_date; ?></p>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="modal-footer">
                                                   <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancelar <span class="glyphicon glyphicon-remove"></span></button>
                                                   <?php echo anchor('logistic/departure/status/'.$departures->status.'/'.$departures->departure_id, 'Continuar <i class="fa fa-check"></i>', 'type="button" class="btn btn-sm btn-success"'); ?>
                                                </div>
                                                <?php echo form_close(); ?>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    <?php endforeach; ?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         <?php else: ?>
            <div class="col-xs-12">
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
   <div class="sol-xs-1"></div>
</section>
<?php $this->load->view('footer'); ?>
