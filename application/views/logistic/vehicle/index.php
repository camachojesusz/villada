<?php $this->load->view('header'); ?>
<section class="seccion">
   <div class="col-xs-1"></div>
   <div class="col-xs-10">
      <section class="content-header">
         <h1>Vehículos <small>Tipos de Vehículos</small></h1>
         <ol class="breadcrumb">
            <li><?php echo anchor('logistic/logistic_index', '<span class="glyphicon glyphicon-home"></span> Inicio</a>','title="Inicio Logística"'); ?></li>
            <li class="active">Tipos de vehículos</li>
         </ol>
      </section>
      <hr>
      <div class="modal fade" id="modal_new">
         <div class="modal-dialog">
            <div class="modal-content">
               <?php echo form_open('logistic/vehicle/set_info', ['autocomplete' => 'off']); ?>
               <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                 </button>
                 <h3 class="modal-title">Nuevo <small class="lead"> Tipo de Vehículo</small></h3>
               </div>
               <div class="modal-body row">
                  <div class="col-xs-12">
                     <div class="form-group">
                        <input class="form-control" type="hidden" id="txtsender" name="txtsender" value="0">
                        <input class="form-control" type="hidden" id="auxiliar_sender" name="auxiliar_sender" value="0">
                     </div>
                  </div>
                  <div class="col-xs-12">
                     <div class="form-group">
                        <label for=""><sup><li class="fa fa-asterisk color-asterisk-required"></li></sup> Tipo de vehículo</label>
                        <input required class="form-control" type="text" id="txtdescription_vt" name="txtdescription_vt" placeholder="tipo de vehículo" value="<?php if (isset($auto_complete) && ! empty($auto_complete)) { echo $auto_complete['description_vt']; } ?>">
                     </div>
                  </div>
                  <div class="col-xs-12">
                     <p class="help-block">
                        <sup><li class="fa fa-asterisk color-asterisk-required"></li></sup> Campos requeridos
                     </p>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancelar <span class="glyphicon glyphicon-remove"></span></button>
                  <button type="button submit" class="btn btn-success btn-sm" name="btnsend">Guardar <samp class="glyphicon glyphicon-floppy-disk"></samp></button>
               </div>
               <?php echo form_close(); ?>
            </div>
         </div>
      </div>
      <div class="row">
         <?php if (isset($vehicle_vt) && ! empty($vehicle_vt)): ?>
            <div class="col-xs-12">
               <div class="box box-primary">
                  <?php if (isset($success_vt)): ?>
                     <br>
                     <div class="callout callout-success">
                        <h4>¡Correcto!</h4>
                        <p class="">Se ha registrado un nuevo <b>Tipo de Vehículo</b></p>
                     </div>
                  <?php endif; ?>
                  <?php if (isset($update_vt)): ?>
                     <br>
                     <div class="callout callout-info">
                        <h4>¡Aviso!</h4>
                        <p class="">La información de un <b>Tipo de Vehículo</b> ha sido modificada</p>
                     </div>
                  <?php endif; ?>
                  <?php if (isset($status_alert)): ?>
                     <br>
                     <div class="callout callout-<?php echo ($status_alert === '0') ? 'warning' : 'info' ; ?>">
                        <h4><?php echo ($status_alert === '0') ? '¡Atención!' : '¡Aviso!' ; ?></h4>
                        <p class=""><?php echo ($status_alert === '0') ? 'Un <b>Tipo de Vehículo</b> ha sido desactivado' : 'Un <b>Tipo de Vehículo</b> ha sido reactivado' ; ?></p>
                     </div>
                  <?php endif; ?>
                  <div class="box-header pull-right">
                     <p class="box-title">
                        <a href="modal_new" type="button" title="Nuevo Tipo de Vehículo" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal_new">Tipo de Vehículo <span class="fa fa-truck"></span></a>
                        <?php echo anchor('logistic/vehicle/index_vehicle', 'Vehículos <i class="fa fa-truck"></i>&nbsp;<sup><i class="fa fa-plus"></i></sup>', 'type="button" title="Listado de vehículos" class="btn btn-info btn-sm"'); ?>
                     </p>
                  </div>
                  <div class="box-body">
                     <div id="general_table_wrapper" class="dataTables_wrapper dt-bootstrap">
                        <div class="row">
                           <div class="col-sm-12 table-responsive">
                              <table id="general_table" class="table table-bordered table-striped table-hover table-condensed dataTable" role="grid" aria-describedby="general_table_info">
                                 <thead>
                                    <tr role="row">
                                       <th>Tipo de vehículo</th>
                                       <th>Estatus</th>
                                       <th>Opciones</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php foreach ($vehicle_vt as $vehicles):?>
                                       <tr role="row">
                                          <td>
                                             <?php echo $vehicles->description_vt; ?>
                                          </td>
                                          <td>
                                             <?php if($vehicles->status === '0'): ?>
                                                <small class="label label-danger"><i class="fa fa-remove"></i> Inactivo</small>
                                             <?php else: ?>
                                                <small class="label label-info"><i class="fa fa-check"></i> Activo</small>
                                             <?php endif; ?>
                                          </td>
                                          <td class="text-center">
                                             <a href="#modal_edit<?php echo $vehicles->vt_id;?>" type="button" class="btn btn-primary btn-xs <?php echo (($vehicles->status === '0') ? ('hidden') : ('')); ?>" data-toggle="modal" data-target="#modal_edit<?php echo $vehicles->vt_id;?>" title="Editar">
                                                <i class="fa fa-edit"></i>
                                             </a>
                                             <?php if ($vehicles->status === '1'): ?>
                                                <a href="#modal_delete_<?php echo $vehicles->vt_id;?>" type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modal_delete_<?php echo $vehicles->vt_id; ?>" title="Desactivar">
                                                   <i class="fa fa-remove"></i>
                                                </a>
                                             <?php else: ?>
                                                <?php echo anchor('logistic/active/'.$vehicles->vt_id, '<i class="fa fa-check"></i>', 'type="button" class="btn btn-xs btn-info" title="Activar"'); ?>
                                             <?php endif; ?>
                                          </td>
                                       </tr>
                                       <div class="modal fade" id="modal_edit<?php echo $vehicles->vt_id; ?>">
                                          <div class="modal-dialog">
                                             <div class="modal-content">
                                                <?php echo form_open('logistic/vehicle/set_info', ['autocomplete' => 'off']); ?>
                                                <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal">
                                                     <span aria-hidden="true">&times;</span></button>
                                                     <h3 class="modal-title">Editar Tipo de Vehículo</h3>
                                                </div>
                                                <div class="modal-body row">
                                                  <div class="col-xs-12">
                                                     <div class="form-group">
                                                        <input class="form-control" type="hidden" id="txtvt_id" name="txtvt_id" value="<?php echo $vehicles->vt_id; ?>">
                                                        <input class="form-control" type="hidden" id="txtsender" name="txtsender" value="1">
                                                        <input class="form-control" type="hidden" id="auxiliar_sender" name="auxiliar_sender" value="0">
                                                     </div>
                                                  </div>
                                                  <div class="col-xs-12">
                                                     <div class="form-group">
                                                       <label for=""><sup><li class="fa fa-asterisk color-asterisk-required"></li></sup> Tipo de vehículo</label>
                                                       <input required class="form-control" type="text" id="txtdescription_vt" name="txtdescription_vt" placeholder="tipo de vehículo" value="<?php echo $vehicles->description_vt; ?>">
                                                    </div>
                                                 </div>
                                                 <div class="col-xs-12">
                                                    <p class="help-block">
                                                      <sup><li class="fa fa-asterisk color-asterisk-required"></li></sup> Campos requeridos
                                                   </p>
                                                </div>
                                                <div class="modal-footer">
                                                   <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancelar <span class="glyphicon glyphicon-remove"></span></button>
                                                   <button type="button submit" class="btn btn-success btn-sm" name="btnsend">Guardar <samp class="glyphicon glyphicon-floppy-disk"></samp></button>
                                                </div>
                                                <?php echo form_close(); ?>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="modal fade" id="modal_delete_<?php echo $vehicles->vt_id; ?>">
                                          <div class="modal-dialog">
                                             <div class="modal-content">
                                                <?php echo form_open('logistic/vehicle/set_info', ['autocomplete' => 'off']); ?>
                                                <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal">
                                                     <span aria-hidden="true">&times;</span></button>
                                                     <h3 class="modal-title">Desactivar un Tipo de Vehículo <small><?php echo $vehicles->vt_id; ?></small></h3>
                                                </div>
                                                <div class="modal-body row">
                                                   <div class="col-xs-12">
                                                      <div class="form-group">
                                                         <input class="form-control" type="hidden" id="txtsender" name="txtsender" value="1">
                                                      </div>
                                                   </div>
                                                   <div class="col-xs-12">
                                                      <div class="callout callout-warning">
                                                         <h4><i class="fa fa-warning"></i> Advertencia</h4>
                                                         <p>Está a punto de desactivar un <b>Tipo de Vehículo</b>, si está seguro de esto presione <b>Continuar</b></p>
                                                      </div>
                                                   </div>
                                                   <div class="col-xs-12">
                                                      <div class="box box-warning">
                                                         <div class="box-header whit-border">
                                                            <h3 class="box-title">Vehículo</h3>
                                                            <div class="box-tools pull-right">
                                                               <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Minimizar">
                                                                  <i class="fa fa-minus"></i>
                                                               </button>
                                                            </div>
                                                         </div>
                                                         <div class="box-body">
                                                            <div class="row">
                                                               <div class="col-xs-12 col-md-6">
                                                                  <p><b>Tipo de Vehículo:</b><br><?php echo $vehicles->description_vt; ?></p>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="modal-footer">
                                                   <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancelar <span class="glyphicon glyphicon-remove"></span></button>
                                                   <?php echo anchor('logistic/vehicle/status/0/'.$vehicles->status.'/'.$vehicles->vt_id, 'Continuar <i class="fa fa-check"></i>', 'type="button" class="btn btn-sm btn-success"'); ?>
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
                     Aún no hay Tipos de Vehículos registrados. Da clic en el botón para agregar uno <a href="modal_new" type="button" title="Nuevo Tipo de Vehículo" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal_new">Tipo de Vehículo <span class="fa fa-truck"></span></a>
                  </div>
               </div>
            </div>
         <?php endif; ?>
      </div>
   </div>
   <div class="col-xs-1"></div>
</section>
<?php $this->load->view('footer'); ?>
