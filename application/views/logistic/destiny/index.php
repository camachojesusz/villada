<?php //$this->load->view('logistic/header'); ?>
<?php $this->load->view('header'); ?>
   <section class="seccion">
      <div class="col-xs-1"></div>
      <div class="col-xs-10">
         <section class="content-header">
            <h1>Destinos</h1>
            <ol class="breadcrumb">
               <li><?php echo anchor('logistic/logistic_index', '<span class="glyphicon glyphicon-home"></span> Inicio</a>','title="Inicio Logística"'); ?></li>
               <li class="active">Destinos</li>
            </ol>
         </section>
         <hr>
         <div class="row">
            <?php if (isset($destiny) && ! empty($destiny)): ?>
               <div class="col-xs-12">
                  <div class="box box-primary">
                     <?php if (isset($success_destiny)): ?>
                        <br>
                        <div class="callout callout-success">
                           <h4>¡Correcto!</h4>
                           <p class="">Se ha registrado un nuevo <b>Destino</b></p>
                        </div>
                     <?php endif; ?>
                     <?php if (isset($update_destiny)): ?>
                        <br>
                        <div class="callout callout-info">
                           <h4>¡Aviso!</h4>
                           <p class="">La información de un <b>Destino</b> ha sido modificada</p>
                        </div>
                     <?php endif; ?>
                     <?php if (isset($status_alert)): ?>
                        <br>
                        <div class="callout callout-<?php echo ($status_alert === '0') ? 'warning' : 'info' ; ?>">
                           <h4><?php echo ($status_alert === '0') ? '¡Atención!' : '¡Aviso!' ; ?></h4>
                           <p class=""><?php echo ($status_alert === '0') ? 'Un <b>Destino</b> ha sido desactivado' : 'Un <b>Destino</b> ha sido reactivado' ; ?></p>
                        </div>
                     <?php endif; ?>
                     <div class="box-header pull-right">
                        <p class="box-title">
                           <?php echo anchor('logistic/destiny/new', 'Nuevo Destino <i class="fa fa-map-marker"></i>&nbsp;<sup><i class="fa fa-plus"></i></sup>', 'type="button" class="btn btn-info btn-sm"'); ?>
                        </p>
                     </div>
                     <div class="box-body">
                        <div id="general_table_wrapper" class="dataTables_wrapper dt-bootstrap">
                           <div class="row">
                              <div class="col-sm-12 table-responsive">
                                 <table id="general_table" class="table table-bordered table-striped table-hover table-condensed dataTable" role="grid" aria-describedby="general_table_info">
                                    <thead>
                                       <tr role="row">
                                          <th hidden=""><?php echo ''; ?></th>
                                          <th>Descripción</th>
                                          <th>Destare</th>
                                          <th>Estatus</th>
                                          <th>Opciones</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php foreach ($destiny as $dty): ?>
                                          <tr role="row">
                                             <td class="hidden"><?php echo $dty->destiny_id; ?></td>
                                             <td><?php echo $dty->description_d; ?></td>
                                             <td><p><small class="label label-info"><i class="fa fa-check"></i> <?php echo 'x'.$dty->destare; ?></small></p></td>
                                             <td>
                                                <?php if ($dty->status === '0'): ?>
                                                <small class="label label-danger"><i class="fa fa-remove"></i> Inactivo</small>
                                                <?php else: ?>
                                                <small class="label label-info"><i class="fa fa-check"></i> Activo</small>
                                                <?php endif; ?>
                                             </td>
                                             <td class="text-center">
                                                <a href="#modal_more_<?php echo $dty->destiny_id;?>" type="button" class="btn btn-xs btn-default" data-toggle="modal" data-target="#modal_more_<?php echo $dty->destiny_id;?>" title="Ver más"><i class="fa fa-eye"></i></a>
                                                <?php echo anchor('logistic/destiny/edit/'.$dty->destiny_id, '<i class="fa fa-edit" ></i>', 'type="button" title="Editar" class="btn btn-primary btn-xs '.(($dty->status === '0') ? ('hidden') : ('')).'"'); ?>
                                                <?php if ($dty->status === '1'): ?>
                                                   <a href="#modal_delete_<?php echo $dty->destiny_id;?>" type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modal_delete_<?php echo $dty->destiny_id; ?>" title="Desactivar">
                                                      <i class="fa fa-remove"></i>
                                                   </a>
                                                <?php else: ?>
                                                <?php echo anchor('logistic/destiny/status/'.$dty->status.'/'.$dty->destiny_id, '<i class="fa fa-check"></i>', 'type="button" class="btn btn-xs btn-info" title="Activar"'); ?>
                                                <?php endif; ?>
                                             </td>
                                          </tr>
                                          <div class="modal fade" id="modal_more_<?php echo $dty->destiny_id;?>">
                                             <div class="modal-dialog">
                                                <div class="modal-content">
                                                   <div class="modal-header">
                                                      <button type="button" class="close" data-dismiss="modal">
                                                         <span aria-hidden="true">&times;</span>
                                                      </button>
                                                      <h3 class="modal-title">Destino <small class="lead"> <?php echo $dty->description_d; ?></small></h3>
                                                   </div>
                                                   <div class="modal-body">
                                                      <div class="row">
                                                         <div class="col-xs-12">
                                                            <div class="box box-primary">
                                                               <div class="box-header with-border">
                                                                  <h3 class="box-title">Ubibacón</h3>
                                                                  <div class="box-tools pull-right">
                                                                     <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Maximizar"><i class="fa fa-plus"></i></button>
                                                                  </div>
                                                               </div>
                                                               <div class="box-body row">
                                                                  <div class="col-xs-12">
                                                                     <div class="form-group">
                                                                        <div class="col-xs-12 col-md-6"><p><b>Calle</b><br><?php echo ($dty->street != '') ? $dty->street : 'No disponible' ;?></p></div>
                                                                        <div class="col-xs-12 col-md-3"><p><b>Número exterior</b><br><?php echo ($dty->numext != '') ? $dty->numext : 'No disponible';?></p></div>
                                                                        <div class="col-xs-12 col-md-3"><p><b>Número interior</b><br><?php echo ($dty->numint != '') ? $dty->numint : 'No disponible';?></p></div>
                                                                        <div class="col-xs-12 col-md-4"><p><b>Localidad</b><br><?php echo ($dty->local != '') ? $dty->local : 'No disponible';?></p></div>
                                                                        <div class="col-xs-12 col-md-4"><p><b>Municipio</b><br><?php echo ($dty->muni != '') ? $dty->muni : 'No disponible';?></p></div>
                                                                        <div class="col-xs-12 col-md-4"><p><b>Entidad federativa</b><br><?php echo ($dty->state != '') ? mb_strtoupper($dty->state) : 'No disponible';?></p></div>
                                                                        <div class="col-xs-12 col-md-4"><p><b>Código Postal</b><br><?php echo ($dty->postal_code != '') ? $dty->postal_code : 'No disponible';?></p></div>
                                                                     </div>
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
                                          <div class="modal fade" id="modal_delete_<?php echo $dty->destiny_id; ?>">
                                             <div class="modal-dialog">
                                                <div class="modal-content">
                                                   <div class="modal-header">
                                                      <button type="button" class="close" data-dismiss="modal">
                                                         <span aria-hidden="true">&times;</span>
                                                      </button>
                                                      <h3 class="modal-title">Desactivar Destino</h3>
                                                   </div>
                                                   <div class="modal-body">
                                                      <div class="row">
                                                         <div class="col-xs-12">
                                                            <div class="callout callout-warning">
                                                               <h4><i class="fa fa-warning"></i> Advertencia</h4>
                                                               <p>Está a punto de desactivar un <b>Destino</b>, si está seguro de esto presione <b>Continuar</b></p>
                                                            </div>
                                                         </div>
                                                         <div class="col-xs-12">
                                                            <div class="box box-warning">
                                                               <div class="box-header whit-border">
                                                                  <h3 class="box-title">Destino</h3>
                                                                  <div class="box-tools pull-right">
                                                                     <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Minimizar">
                                                                        <i class="fa fa-minus"></i>
                                                                     </button>
                                                                  </div>
                                                               </div>
                                                               <div class="box-body">
                                                                  <div class="row">
                                                                     <div class="col-xs-12 col-md-8">
                                                                        <p><b><i class="fa fa-map-marker"></i></b>&nbsp;<?php echo $dty->description_d; ?></p>
                                                                     </div>
                                                                     <div class="col-xs-12 col-md-4">
                                                                        <p><small class="label label-info" title="Destare"><i class="fa fa-check"></i> <?php echo 'x'.$dty->destare; ?></small></p>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div class="modal-footer">
                                                      <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cancelar <span class="glyphicon glyphicon-remove"></span>
                                                      </button>
                                                      <?php echo anchor('logistic/destiny/status/'.$dty->status.'/'.$dty->destiny_id, 'Continuar <i class="fa fa-check"></i>', 'type="button" class="btn btn-sm btn-success"');  ?>
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
                        Aún no hay Destinos registrados. Da clic en el botón para agregar uno <?php echo anchor('logistic/destiny/new', 'Nuevo Destino <i class="fa fa-map-marker"></i>&nbsp;<sup><i class="fa fa-plus"></i></sup>', 'type="button" class="btn btn-info btn-sm"'); ?>
                     </div>
                  </div>
               </div>
            <?php endif; ?>
         </div>
      </div>
      <div class="col-xs-1"></div>
   </section>
<?php $this->load->view('footer'); ?>
