<?php $this->load->view('header'); ?>
<section class="seccion">

   <div class="col-xs-1"></div>
   <div class="col-xs-10">
      <section class="content-header">
         <h1>Cajas <small><strong>Tipos de Cajas</strong></small></h1>
         <ol class="breadcrumb">
            <li><?php echo anchor('login/in_sess', '<span class="glyphicon glyphicon-home"></span> Inicio</a>','title="Inicio"'); ?></li>
            <li class="active">Tipos de Cajas</li>
         </ol>
      </section>
      <hr>

      <div class="modal fade" id="modal_new_sb">
         <div class="modal-dialog">
            <div class="modal-content">
               <?php echo form_open('size_box/set_info', ['autocomplete' => 'off']); ?>
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">
                     <span aria-hidden="true">&times;</span></button>
                     <h3 class="modal-title">Nuevo <small class="lead">Tipo de Caja</small></h3>
                  </div>
                  <div class="modal-body row">
                     <div class="col-xs-12">
                        <div class="form-group">
                           <input class="form-control" type="hidden" id="txtsender" name="txtsender" value="0">
                        </div>
                     </div>
                     <div class="col-xs-12">
                        <div class="form-group">
                           <label for=""><sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Descripción</label>
                           <input class="form-control" type="text" id="txtdescribe" required name="txtdescribe" placeholder="descripción" value="<?php if (isset($auto_complete) && !empty($auto_complete)){echo $auto_complete['description'];} ?>">
                        </div>
                     </div>
                     <div class="col-xs-12">
                        <div class="form-group">
                           <label for=""><sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Valor de destare</label>
                           <input class="form-control" type="phone" id="txtvalue" required name="txtvalue" placeholder="valor de destare" value="<?php if (isset($auto_complete) && ! empty($auto_complete)){ echo $auto_complete['destare_value']; } ?>">
                        </div>
                     </div>
                     <div class="col-xs-12">
                        <div class="form-group">
                           <label for="txtdefault_sb"><li class="fa fa-exclamation-circle color-exclamation-sign-b"></li>&nbsp;<sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Usar como predeterminado</label>
                           <br>
                           <label for="txtdefault_sb_b">
                              <input type="radio" id="txtdefault_sb_b" checked required name="txtdefault_sb" value="0" <?php if (isset($auto_complete) && ! empty($auto_complete)){ if ($auto_complete['default_value'] === '0') { echo "checked"; } } ?>>
                              No <i class="fa fa-times color-asterisk-required"></i>
                           </label>
                           <br>
                           <label for="txtdefault_sb_a">
                              <input type="radio" id="txtdefault_sb_a" required name="txtdefault_sb" value="1" <?php if (isset($auto_complete) && ! empty($auto_complete)){ if ($auto_complete['default_value'] === '1') { echo "checked"; } } ?>>
                              Si <i class="fa fa-check color-exclamation-sign-a"></i>
                           </label>
                        </div>
                     </div>
                  </div>
                  <div class="col-xs-12">
                     <p class="help-block">
                        <sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>&nbsp;Campos requeridos
                        <br>
                        <li class="fa fa-exclamation-circle color-exclamation-sign-b"></li>&nbsp;Al usar como predeterminado, el destare se calculará con el <label>Valor de destare</label> asignado para las nuevas compras
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

      <div class="row">
         <?php if(isset($boxes) && ! empty($boxes)): ?>
            <div class="col-xs-12">
               <div class="box box-primary">

                  <div class="box-header pull-right">
                     <p class="box-title">
                        <a href="#modal_new_sb" type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal_new_sb">Nueva caja <i class="fa fa-dropbox"></i>&nbsp;<sup><i class="fa fa-plus"></i></sup></a>
                     </p>
                  </div>

                  <div class="box-body">
                     <?php if (isset($success_sb)): ?>
                        <div class="col-xs-12">
                           <br>
                           <div class="callout callout-success">
                              <h4>¡Correcto!</h4>
                              <p class="">
                                 Nuevo <b>Tipo de Caja</b> guardado con éxito
                              </p>
                           </div>
                        </div>
                     <?php endif; ?>

                     <?php if (isset($success_default_sb)): ?>
                        <div class="col-xs-12">
                           <br>
                           <div class="callout callout-info">
                              <h4>¡Aviso!</h4>
                              <p class="">
                                 Un <b>Tipo de Caja</b> se ha cambiado a <b>Predeterminado</b>
                              </p>
                           </div>
                        </div>
                     <?php endif; ?>

                     <?php if (isset($status_alert)): ?>
                        <div class="col-xs-12">
                           <br>
                           <div class="callout callout-warning">
                              <h4>!Aviso!</h4>
                              <p>Se ha eliminado un <b>Tipo de Caja</b>
                              </p>
                           </div>
                        </div>
                     <?php endif; ?>

                     <?php if (isset($success_update_sb)): ?>
                        <div class="col-xs-12">
                           <br>
                           <div class="callout callout-info">
                              <h4>¡Aviso!</h4>
                              <p class="">
                                 La información de <b>Tipo de Caja</b> ha sido midificada
                              </p>
                           </div>
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

                     <div id="general_table_wrapper" class="dataTables_wrapper dt-bootstrap">
                        <div class="row">
                           <div class="col-sm-12 table-responsive">
                              <table id="general_table" class="table table-bordered table-striped table-hover table-condensed dataTable" role="grid" aria-describedby="general_table_info">
                                 <thead>
                                    <tr role="row">
                                       <th>Descripción</th>
                                       <th>Valor de destare</th>
                                       <th>Estatus</th>
                                       <th>Opciones</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php foreach ($boxes->result() as $box): ?>
                                       <tr role="row">
                                          <td>
                                             <p hidden><?php echo $box->id; ?></p>
                                             <?php echo $box->description; ?>
                                          </td>
                                          <td><?php echo '<small><strong>x</strong></small>'.$box->destare_value; ?></td>
                                          <td>
                                             <?php
                                             if ($box->default_value === '0'):
                                             ?>
                                                <small class="label label-info"><i class="fa fa-check"></i> Activo</small>
                                             <?php
                                             else:
                                             ?>
                                                <small class="label label-success"><i class="fa fa-check"></i> Predeterminado</small>
                                             <?php
                                             endif;
                                             ?>
                                          </td>
                                          <td class="text-center">
                                       
                                             <?php
                                             if ($box->default_value === '0')
                                             {
                                                echo anchor('size_box/default_size_box/'.$box->id, '<i class="fa fa-level-up"></i>','type="button"  title="Predeterminado" class="btn btn-xs" style="background: #138D75; color: #FFFFFF;"');
                                             }
                                             ?>
                                             <a href="#modal_edit_sb<?php echo $box->id;?>" type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modal_edit_sb<?php echo $box->id;?>" title="Editar"><i class="fa fa-edit"></i></a>
                                             <a href="#modal_delete_sb<?php echo $box->id;?>" type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modal_delete_sb<?php echo $box->id;?>" title="Desactivar"><i class="fa fa-remove"></i></a>
                                          </td>
                                       </tr>

                                       <div class="modal fade" id="modal_delete_sb<?php echo $box->id; ?>">
                                       <div class="modal-dialog">
                                          <div class="modal-content">
                                             <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                                                <h3 class="modal-title">Eliminar Cajas</h3>                                     
                                             </div>
                                             <div class="modal-body">
                                                <div class="row">
                                                   <div class="col-xs-12">
                                                      <div class="callout callout-warning">
                                                         <h4><i class="fa fa-warning">&nbsp;</i>Advertencia</h4>
                                                         <p>Está a punto de eliminar una <b>Caja</b>, si está seguro de esto presione <b>Continuar</b></p>
                                                      </div>
                                                   </div>
                                                   <div class="col-xs-12">
                                                      <div class="box box-warning">
                                                         <div class="box-header with-border">
                                                            <h3 class="box-title">Cajas</h3>
                                                            <div class="box-tools pull-right">
                                                               <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Minimizar"> <i class="fa fa-minus"></i></button>
                                                            </div>
                                                         </div>
                                                         <div class="box-body">
                                                            <div class="row">
                                                               <div class="col-xs-12 col-md-6">
                                                                  <p><b>Descripción:</b><br><?php echo $box->description; ?></p>   
                                                               </div>
                                                               <div class="col-xs-12 col-md-6">
                                                                  <p><b>Destare:</b><br><?php echo $box->destare_value; ?></p>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="modal-footer">
                                                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancelar <span class="glyphicon glyphicon-remove"></span>
                                                </button>
                                                <?php echo anchor('size_box/status_box/'.$box->status.'/'.$box->id, 'Continuar <i class="fa fa-check"></i>', 'type="button" class="btn btn-success btn-sm"');  ?>
                                             </div>
                                          </div>
                                       </div>  
                                    </div>

                                       <div class="modal fade" id="modal_edit_sb<?php echo $box->id; ?>">
                                          <div class="modal-dialog">
                                             <div class="modal-content">
                                                <?php echo form_open('size_box/set_info'); ?>
                                                <div class="modal-header">
                                                   <button type="button" class="close" data-dismiss="modal">
                                                      <span aria-hidden="true">&times;</span>
                                                   </button>
                                                   <h3 class="modal-title">Editar Tipo de Caja <small><?php echo $box->description; ?></small></h3>
                                                </div>
                                                <div class="modal-body row">
                                                   <div class="col-xs-12">
                                                      <div class="form-group">
                                                         <input class="" type="hidden" id="txtidsb" name="txtidsb" value="<?php echo $box->id;?>">
                                                         <input class="" type="hidden" id="txtsender" name="txtsender" value="1">
                                                      </div>
                                                   </div>
                                                   <div class="col-xs-12 col-md-6">
                                                      <div class="form-group">
                                                         <label for=""><sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Descripción</label>
                                                         <br>
                                                         <input class="form-control" type="text" id="txtdescribe" required name="txtdescribe" placeholder="producto" value="<?php echo $box->description; ?>">
                                                      </div>
                                                   </div>
                                                   <div class="col-xs-12 col-md-6">
                                                      <div class="form-group">
                                                         <label for=""><sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Valor de destare</label>
                                                         <br>
                                                         <input class="form-control" type="text" id="txtvalue" required name="txtvalue" placeholder="producto" value="<?php echo $box->destare_value; ?>">
                                                      </div>
                                                   </div>
                                                   <div class="col-xs-12 col-md-6">
                                                      <div class="form-group">
                                                         <label for="txtdefault_sb"><li class="fa fa-exclamation-circle color-exclamation-sign-b"></li>&nbsp;<sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Usar como predeterminado</label>
                                                         <br>
                                                         <label for="txtdefault_sb_b">
                                                            <input type="radio" id="txtdefault_sb_b" checked required name="txtdefault_sb" value="0" <?php if (isset($auto_complete) && ! empty($auto_complete)){ if (! strcmp("0", $auto_complete['default_value'])) { echo "checked"; } } ?>>
                                                            No <i class="fa fa-times color-asterisk-required"></i>
                                                         </label>
                                                         <br>
                                                         <label for="txtdefault_sb_a">
                                                            <input type="radio" id="txtdefault_sb_a" required name="txtdefault_sb" value="1" <?php if (isset($auto_complete) && ! empty($auto_complete)){ if (! strcmp("1", $auto_complete['default_value'])) { echo "checked"; } } ?>>
                                                            Si <i class="fa fa-check color-exclamation-sign-a"></i>
                                                         </label>
                                                      </div>
                                                   </div>
                                                </div>
                                                   <div class="col-xs-12">
                                                      <p class="help-block">
                                                         <sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>&nbsp;Campos requeridos
                                                         <br>
                                                         <li class="fa fa-exclamation-circle color-exclamation-sign-b"></li>&nbsp;Al usar como predeterminado, el destare se calculará con el <label>Valor de destare</label> asignado para las nuevas compras
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
                     Aún no hay Cajas. Da clic en el botón un nuevo tipo de caja <?php echo anchor('#modal_new_sb', 'Nueva caja <i class="fa fa-dropbox"></i>&nbsp;<sup><i class="fa fa-plus"></i></sup>','type="button" class="btn btn-info" data-toggle="modal" data-target="#modal_new_sb"'); ?>
                  </div>
               </div>
            </div>
         <?php endif; ?>
      </div>

   </div>
   <div class="col-xs-1"></div>

</section>
<?php $this->load->view('footer');?>
