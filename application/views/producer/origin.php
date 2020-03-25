<?php $this->load->view('header');?>
<section class="seccion">
   <div class="col-xs-1"></div>
   <div class="col-xs-10">
      <section class="content-header">
         <h1>Proveedores <small><strong>Orígenes</strong></small></h1>
         <ol class="breadcrumb">
            <li><?php echo anchor('login/in_sess', '<span class="glyphicon glyphicon-home"></span> Inicio', ''); ?></li>
            <li><?php echo anchor('producer', 'Proveedores', ''); ?></li>
            <li class="active">Orígenes</li>
         </ol>
      </section>
      <hr>
      <div class="row">
         <div class="modal fade" id="modal_create_origin">
            <div class="modal-dialog">
               <div class="modal-content">
                  <?php echo form_open('producer/set_info_og', ['autocomplete' => 'off']); ?>
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                     </button>
                     <h3 class="modal-title">Nuevo <small class="lead">Origen</small></h3>
                  </div>
                  <div class="modal-body row">
                     <div class="col-xs-12 hidden-xs hidden-sm hidden-md hidden-lg">
                        <div class="form-group">
                           <input class="form-control" type="text" id="txtsender" name="txtsender" value="0">
                           <input class="form-control" type="text" id="txtproducer" name="txtproducer" value="<?php echo $info_producer->row()->noctrl_e_producer; ?>">
                        </div>
                     </div>
                     <div class="col-xs-12">
                        <div class="form-group">
                           <label for=""><li class="fa fa-exclamation-circle color-exclamation-sign-a"></li>&nbsp;<sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Origen</label>
                           <input class="form-control" type="text" id="txtdescribe_new_origin" required name="txtdescribe_new_origin" placeholder="nuevo origen" value="">
                        </div>
                     </div>
                     <div class="col-xs-12">
                        <div class="form-group">
                           <label for=""><li class="fa fa-exclamation-circle color-exclamation-sign-b"></li>&nbsp;<sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Productos</label><br>
                           <?php echo form_multiselect('txtproduct_origin[]', $info_product, set_value('txtproduct_origin[]', '0'), 'class="form-control select2" multiple="multiple" style="width: 100%;" required'); ?>
                        </div>
                     </div>
                     <div class="col-xs-12">
                        <div class="form-group">
                           <label for="">Ubicación</label>
                           <input class="form-control" type="text" id="txtlocation_origin" name="txtlocation_origin" placeholder="ubicación" value="">
                        </div>
                     </div>
                  </div>
                  <div class="col-xs-12">
                     <p class="help-block">
                        <sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Campos requeridos
                        <br>
                        <li class="fa fa-exclamation-circle color-exclamation-sign-a"></li> Escribe el lugar de origen
                        <br>
                        <li class="fa fa-exclamation-circle color-exclamation-sign-b"></li> Elige uno o más productos (CTRL + Clic)
                     </p>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cancelar <span class="glyphicon glyphicon-remove"></span></button>
                     <button type="button submit" class="btn btn-sm btn-success" name="btnsend">Guardar <samp class="glyphicon glyphicon-floppy-disk"></samp></button>
                  </div>
                  <?php echo form_close(); ?>
               </div>
            </div>
         </div>
         <?php if (isset($all_origin) && ! empty($all_origin)):?>
            <div class="col-xs-12">
               <div class="box box-primary">
                  <?php if (isset($save_origin)): ?>
                     <br>
                     <div class="callout callout-success">
                        <h4>¡Correcto!</h4>
                        <p>Se ha gardado un <b>Origen</b></p>
                     </div>
                  <?php endif; ?>
                  <?php if (isset($update_origin)): ?>
                     <br>
                     <div class="callout callout-info">
                        <h4>Aviso!</h4>
                        <p>La información de un <b>Origen</b> ha sido modificada</p>
                     </div>
                  <?php endif; ?>
                  <?php if (isset($status_alert)): ?>
                     <br>
                     <div class="callout callout-<?php echo ($status_alert != '1') ? 'warning' : 'info' ; ?>">
                        <h4><?php echo ($status_alert != '1') ? '¡Atención!' : '¡Aviso!' ; ?></h4>
                        <p><?php echo ($status_alert != '1') ? 'Se ha desactivado un <b>Origen</b>' : 'Se ha reactivado un <b>Origen</b>' ; ?></p>
                     </div>
                  <?php endif; ?>
                  <?php if (isset($add_product)): ?>
                     <br>
                     <div class="callout callout-<?php echo ($add_product === '0') ? 'warning' : 'info' ; ?>">
                        <h4><?php echo ($add_product === '0') ? '¡Atención!' : '¡Aviso!' ; ?></h4>
                        <p><?php echo ($add_product === '0') ? 'No se puede agregar <b>Productos</b> al <b>Origen</b> seleccionado porque ya contiene uno similar' : 'Se ha agregado <b>Productos</b> a un <b>Origen</b>' ; ?></p>
                     </div>
                  <?php endif; ?>
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
                  <div class="box-header row">
                     <div class="col-xs-12 col-md-11">
                        <div class="col-xs-12 col-md-4">
                           <p>
                              <small>
                                 <b><li class="fa fa-truck"></li> </b><?php echo $info_producer->row()->describe_producer; ?>
                              </small>
                           </p>
                        </div>
                        <div class="col-xs-12 col-md-4">
                           <p>
                              <small>
                                 <b><li class="fa fa-user"></li> </b><?php echo $info_producer->row()->name_producer.' '.$info_producer->row()->ap1_producer.' '.$info_producer->row()->ap2_producer; ?>
                              </small>
                           </p>
                        </div>
                     </div>
                     <div class="col-xs-12 col-md-1 pull-right">
                        <div class="col-xs-12">
                           <p class="pull-right">
                              <a href="#modal_create_origin" type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal_create_origin">
                                 Nuevo Origen <i class="fa fa-map-signs">&nbsp;<sup><i class="fa fa-plus"></i></sup></i>
                              </a>
                           </p>
                        </div>
                     </div>
                  </div>
                  <div class="box-body">
                     <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap">
                        <div class="row">
                           <div class="col-sm-12 table-responsive">
                              <table id="example1" class="table table-bordered table-striped table-hover table-condensed dataTable" role="grid" aria-describedby="example1_info">
                                 <thead>
                                    <tr role="row">
                                       <th hidden><?php echo ''; ?></th>
                                       <th>Origen</th>
                                       <th>Ubicación</th>
                                       <th>Productos</th>
                                       <th>Estatus</th>
                                       <th>Opciones</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                 <?php foreach ($all_origin->result() as $all_origins): ?>
                                    <tr>
                                       <td hidden><?php echo $all_origins->id_origin; ?></td>
                                       <td>
                                          <i class="fa fa-map-signs"></i>
                                          <?php echo $all_origins->describe_origin; ?>
                                       </td>
                                       <td>
                                          <i class="fa fa-map-marker"></i>
                                          <?php echo ($all_origins->location_origin != '') ? $all_origins->location_origin : 'No disponible' ; ?>
                                       </td>
                                       <td>
                                          <?php
                                          if (isset($supply_product)):
                                             foreach ($supply_product as $supply_products):
                                                if ($all_origins->id_origin === $supply_products->origin_supply):
                                                   $sp[] = $supply_products->id_product;
                                          ?>
                                                   <span class="glyphicon glyphicon-apple"></span> <?php echo $supply_products->describe_product; ?><br>
                                          <?php
                                                endif;
                                             endforeach;
                                          endif;
                                          ?>
                                       </td>
                                       <td>
                                          <?php if ($all_origins->status_origin === '0'):  ?>
                                             <small class="label label-danger"><i class="fa fa-remove"></i> Inactivo</small>
                                          <?php else: ?>
                                             <small class="label label-info"><i class="fa fa-check"></i> Activo</small>
                                          <?php endif; ?>
                                       </td>
                                       <td class="text-center">
                                          <?php if ($all_origins->status_origin === '0'):  ?>
                                             <?php echo anchor('producer/status_origin/'.$all_origins->status_origin.'/'.$all_origins->id_origin.'/'.$info_producer->row()->noctrl_e_producer, '<i class="fa fa-check"></i>', 'type="button" class="btn btn-xs btn-info" title="Activar"'); ?>
                                          <?php else: ?>
                                             <a style="background: #9B59B6; color: #FFFFFF;" title="Productos" href="#modal_add_product<?php echo $all_origins->id_origin; ?>" type="button" class="btn btn-xs" data-toggle="modal" data-target="#modal_add_product<?php echo $all_origins->id_origin; ?>">
                                                <span class="glyphicon glyphicon-apple"></span>&nbsp;<sup><i class="fa fa-plus"></i></sup></i>
                                             </a>
                                             <a title="Editar" href="#modal_edit_origin<?php echo $all_origins->id_origin; ?>" type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modal_edit_origin<?php echo $all_origins->id_origin; ?>">
                                                <i class="fa fa-edit"></i>
                                             </a>
                                             <a href="#modal_delete_<?php echo $all_origins->id_origin;?>" type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modal_delete_<?php echo $all_origins->id_origin; ?>" title="Desactivar">
                                                <i class="fa fa-remove"></i>
                                             </a>
                                          <?php endif; ?>
                                       </td>
                                    </tr>
                                    <div class="modal fade" id="modal_edit_origin<?php echo $all_origins->id_origin; ?>">
                                       <div class="modal-dialog">
                                          <div class="modal-content">
                                             <?php echo form_open('producer/set_info_og', ['autocomplete' => 'off']); ?>
                                             <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">
                                                   <span aria-hidden="true">&times;</span>
                                                </button>
                                                <h3 class="modal-title">Editar <small class="lead">Origen</small></h3>
                                             </div>
                                             <div class="modal-body">
                                                <div class="row">
                                                   <div class="col-xs-12">
                                                      <div class="form-group">
                                                         <input class="form-control" type="hidden" id="txtsender" name="txtsender" value="1">
                                                         <input class="form-control" type="hidden" id="txtorigin" name="txtorigin" value="<?php echo $all_origins->id_origin; ?>">
                                                         <input class="form-control" type="hidden" id="txtproducer" name="txtproducer" value="<?php echo $info_producer->row()->noctrl_e_producer; ?>">
                                                      </div>
                                                   </div>
                                                   <div class="col-xs-12">
                                                      <div class="form-group">
                                                         <label for=""><li class="fa fa-exclamation-circle color-exclamation-sign-a"></li>&nbsp;<sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Origen</label>
                                                         <br>
                                                         <input class="form-control" type="text" id="txtdescribe_new_origin" required name="txtdescribe_new_origin" placeholder="nuevo origen" value="<?php echo $all_origins->describe_origin; ?>">
                                                      </div>
                                                   </div>
                                                   <div class="col-xs-12">
                                                      <div class="form-group">
                                                         <label for="">Ubicación</label>
                                                         <br>
                                                         <input class="form-control" type="text" id="txtlocation_origin" name="txtlocation_origin" placeholder="ubicación" value="<?php echo $all_origins->location_origin; ?>">
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="col-xs-12">
                                                <p class="help-block">
                                                   <sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Campos requeridos
                                                   <br>
                                                   <li class="fa fa-exclamation-circle color-exclamation-sign-a"></li> Escribe el lugar de origen
                                                </p>
                                             </div>
                                             <div class="modal-footer">
                                                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cancelar <span class="glyphicon glyphicon-remove"></span></button>
                                                <button type="button submit" class="btn btn-sm btn-success" name="btnsend">Guardar <samp class="glyphicon glyphicon-floppy-disk"></samp></button>
                                             </div>
                                             <?php echo form_close(); ?>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="modal fade" id="modal_add_product<?php echo $all_origins->id_origin; ?>">
                                       <div class="modal-dialog">
                                          <div class="modal-content">
                                             <?php echo form_open('producer/set_info_og', ['autocomplete' => 'off']); ?>
                                             <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">
                                                   <span aria-hidden="true">&times;</span>
                                                </button>
                                                <h3 class="modal-title">Agregar Productos a Origen: <small class="lead"><?php echo $all_origins->describe_origin; ?></small></h3>
                                             </div>
                                             <div class="modal-body">
                                                <div class="row">
                                                   <div class="col-xs-12">
                                                      <div class="form-group">
                                                         <input class="form-control" type="hidden" id="txtsender" name="txtsender" value="2">
                                                         <input class="form-control" type="hidden" id="txtorigin" name="txtorigin" value="<?php echo $all_origins->id_origin; ?>">
                                                         <input class="form-control" type="hidden" id="txtproducer" name="txtproducer" value="<?php echo $info_producer->row()->noctrl_e_producer; ?>">
                                                      </div>
                                                   </div>
                                                   <div class="col-xs-12">
                                                      <div class="form-group" style="width: 100%;">
                                                         <label for=""><li class="fa fa-exclamation-circle color-exclamation-sign-b"></li>&nbsp;<sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Productos</label><br>
                                                         <?php echo form_multiselect('txtproduct_origin[]', $info_product, set_value('txtproduct_origin[]', $sp), 'class="form-control select2" multiple="multiple" style="width: 100%;" required'); ?>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="col-xs-12">
                                                <p class="help-block">
                                                   <sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Campos requeridos
                                                   <br>
                                                   <li class="fa fa-exclamation-circle color-exclamation-sign-b"></li> Elige uno o más productos (CTRL + Clic)
                                                </p>
                                             </div>
                                             <div class="modal-footer">
                                                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cancelar <span class="glyphicon glyphicon-remove"></span></button>
                                                <button type="button submit" class="btn btn-sm btn-success" name="btnsend">Guardar <samp class="glyphicon glyphicon-floppy-disk"></samp></button>
                                             </div>
                                             <?php echo form_close(); ?>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="modal fade" id="modal_delete_<?php echo $all_origins->id_origin; ?>">
                                       <div class="modal-dialog">
                                          <div class="modal-content">
                                             <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">
                                                   <span aria-hidden="true">&times;</span>
                                                </button>
                                                <h3 class="modal-title">Desactivar <small class="lead">Origen</small></h3>
                                             </div>
                                             <div class="modal-body">
                                                <div class="row">
                                                   <div class="col-xs-12">
                                                      <div class="callout callout-warning">
                                                         <h4><i class="fa fa-warning"></i> Advertencia</h4>
                                                         <p>Está a punto de desactivar un <b>Origen</b>, si está seguro de esto presione <b>Continuar</b></p>
                                                      </div>
                                                   </div>
                                                   <div class="col-xs-12">
                                                      <div class="box box-warning">
                                                         <div class="box-header with-border">
                                                            <h3 class="box-title">Origen</h3>
                                                            <div class="box-tools pull-right">
                                                               <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Minimizar"><i class="fa fa-minus"></i></button>
                                                            </div>
                                                         </div>
                                                         <div class="box-body">
                                                            <div class="row">
                                                               <div class="col-xs-12 col-md-6"><p><b>Origen: </b><br><?php echo $all_origins->describe_origin; ?></p></div>
                                                               <div class="col-xs-12 col-md-6"><p><b><i class="fa fa-map-marker"></i> Ubicación </b><br><?php echo $all_origins->describe_origin; ?></p></div>
                                                            </div>
                                                         </div>
                                                         <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar <span class="glyphicon glyphicon-remove"></span></button>
                                                            <?php echo anchor('producer/status_origin/'.$all_origins->status_origin.'/'.$all_origins->id_origin.'/'.$info_producer->row()->noctrl_e_producer, 'Continuar <i class="fa fa-check"></i>', 'type="button" class="btn btn-sm btn-success"'); ?>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
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
               <div class="panel-body row">
                  <div class="col-xs-12 col-md-6">
                     No se encontró un origen
                  </div>
                  <div class="col-xs-12 col-md-6 pull-right">
                     <a href="#modal_create_origin" type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal_create_origin">
                        Nuevo Origen <i class="fa fa-map-signs">&nbsp;<sup><i class="fa fa-plus"></i></sup></i>
                     </a>
                  </div>
               </div>
            </div>
         </div>
      <?php endif; ?>
      </div>
   </div>
   <div class="col-xs-1"></div>
</section>
<?php $this->load->view('footer');?>
