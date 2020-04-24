
<?php $this->load->view('header'); ?>
<section class="seccion">
   <div class="col-xs-1"></div>
   <div class="col-xs-10">
      <section class="content-header">
         <h1>Tamaños <small><strong>Configurar tamaños</strong></small></h1>
         <ol class="breadcrumb">
            <li><?php echo anchor('login/in_sess', '<span class="glyphicon glyphicon-home"></span> Inicio', ''); ?> </li>
            <li><?php echo anchor('product', 'Productos', ''); ?> </li>
            <li class="active">Configurar tamaños</li>
         </ol>
      </section>
      <hr>
      <div class="modal fade" id="modal1">
         <div class="modal-dialog">
            <div class="modal-content">
               <?php echo form_open('size/set_info_cs', ['autocomplete' => 'off']); ?>
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                     </button>
                     <h3 class="modal-title">Nueva <small class="lead">Configuración</small></h3>
                  </div>
                  <div class="modal-body">
                     <div class="row">
                        <div class="col-xs-12">
                           <div class="form-group">
                              <input type="hidden" name="txtsender" value="0">
                              <input type="hidden" name="txtidproduct" value="<?php echo $info_product->row()->id_product; ?>">
                           </div>
                        </div>
                        <?php if ($info_product->row()->ctrl_size === '0,1' OR $info_product->row()->ctrl_size === '0'): ?>
                           <div class="col-xs-12">
                              <div class="form-group">
                                 <label for=""><li class="fa fa-exclamation-circle color-exclamation-sign-b"></li><sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Calidad</label>
                                 <?php echo form_multiselect('qualities[]', $qualities, set_value('qualities[]', ''), 'class="form-control select2" multiple="multiple" style="width: 100%;" required'); ?>
                                 <input type="hidden" name="auxiliar_sender[]" value="0">
                              </div>
                           </div>
                        <?php endif; ?>
                        <?php if (($info_product->row()->ctrl_size === '0,1' OR $info_product->row()->ctrl_size === '1')): ?>
                           <div class="col-xs-12" <?php echo ($info_product->row()->ctrl_size === '0,1' OR $info_product->row()->ctrl_size === '1') ? '' : 'hidden' ; ?>>
                              <div class="form-group">
                                 <label for=""><li class="fa fa-exclamation-circle color-exclamation-sign-b"></li><sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Categoria</label>
                                 <?php echo form_multiselect('categories[]', $categories, set_value('categories[]', ''), 'class="form-control select2" multiple="multiple" style="width: 100%;" required'); ?>
                                 <input type="hidden" name="auxiliar_sender[]" value="1">
                              </div>
                           </div>
                        <?php endif; ?>
                     </div>
                  </div>
                  <div class="col-xs-12">
                     <p class="help-block">
                        <sup><li class="fa fa-asterisk color-asterisk-required"></li></sup> Campos requeridos
                        <br>
                        <li class="fa fa-exclamation-circle color-exclamation-sign-b"></li> Elige uno o más elementos (CTRL + Clic)
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
      <?php if (isset($allsize) && ! empty($allsize)): ?>
         <div class="col-xs-12">
            <div class="box box-primary">
               <div class="box-header row">
                  <div class="col-xs-12 col-md-10 row">
                     <div class="col-xs-12 col-md-2">
                        <p>
                           <small>
                              <b>Clave:</b><br> <?php echo $info_product->row()->key_product; ?>
                           </small>
                        </p>
                     </div>
                     <div class="col-xs-12 col-md-2">
                        <p>
                           <small>
                              <b>Producto:</b><br> <?php echo $info_product->row()->describe_product; ?>
                           </small>
                        </p>
                     </div>
                     <div class="col-xs-12 col-md-8">
                        <p>
                           <small>
                              <b>Descripción:</b><br> <?php echo $info_product->row()->character_product; ?>
                           </small>
                        </p>
                     </div>
                  </div>
                  <div class="col-xs-12 col-md-2 row">
                     <div class="col-xs-12">
                        <p class="box-title">
                           <a href="#modal1" type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal1">Nueva Configuración <i class="fa fa-cubes"></i></a>
                        </p>
                     </div>
                  </div>
                  <?php if (isset($create_config_size)): ?>
                     <div class="col-xs-12">
                        <br>
                        <div class="callout callout-success">
                           <h4>¡Correcto!</h4>
                           <p><b>Configuración</b> terminada con éxito.</p>
                        </div>
                     </div>
                  <?php endif; ?>
                  <?php if (isset($status_alert)): ?>
                  <div class="col-xs-12">
                     <br>
                     <div class="callout callout-<?php echo ($status_alert === '0') ? 'warning' : 'info' ;?>">
                        <h4><?php echo ($status_alert === '0') ? '¡Atención!' : '¡Aviso!' ; ?></h4>
                        <p class=""><?php echo ($status_alert === '0') ? 'Se ha desactivado un <b>Configuración</b>' : 'Se ha activado una <b>Configuración</b>' ; ?></p>
                     </div>
                  </div>
                  <?php endif; ?>
                  <?php if (isset($edit_alert)): ?>
                     <div class="col-xs-12">
                        <br>
                        <div class="callout callout-<?php echo ($edit_alert === '0') ? 'info' : 'danger' ;?>">
                           <h4><?php echo ($edit_alert === '0') ? '¡Aviso!' : '¡Error!' ; ?></h4>
                           <p class=""><?php echo ($edit_alert === '0') ? 'Se ha cambiado la información de una <b>Configuración</b>' : 'No se permite el cambio seleccionado para la <b>Configuración</b>, probablemente ya existe una similar. Verifíca la información e inténtalo de nuevo.' ; ?></p>
                        </div>
                     </div>
                  <?php endif; ?>
               </div>
               <div class="box-body">
                  <div id="general_table_wrapper" class="dataTables_wrapper dt-bootstrap">
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
                        <div class="col-sm-12 table-responsive">
                           <table id="general_table" class="table table-bordered table-striped table-hover table-condensed dataTable" role="grid" aria-describedby="general_table_info">
                              <thead>
                                 <tr>
                                    <th hidden><?php echo ''; ?></th>
                                    <th>Calidad</th>
                                    <th>Categoría</th>
                                    <th>Opciones</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php foreach ($allsize->result() as $sz): ?>
                                    <tr role="row">
                                       <td hidden><?php echo $sz->quality_id.' '.$sz->category_id; ?></td>
                                       <td><?php echo  ($sz->description_q != '') ? $sz->description_q : '-' ; ?></td>
                                       <td><?php echo  ($sz->description_c != '') ? $sz->description_c : '-' ; ?></td>
                                       <td class="text-center">
                                          <a href="#modal_edit_<?php echo $sz->product_size_id; ?>" data-toggle="modal" data-target="#modal_edit_<?php echo $sz->product_size_id; ?>"  title="Editar" type="button" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                                          &nbsp;
                                          <?php if ($sz->status_ps === '1'): ?>
                                             <a href="#modal_delete_<?php echo $sz->product_size_id; ?>" data-toggle="modal" data-target="#modal_delete_<?php echo $sz->product_size_id; ?>"  title="Desactivar" type="button" class="btn btn-xs btn-danger"><i class="fa fa-remove"></i></a>
                                          <?php else: ?>
                                             <?php echo anchor('size/status_config/'.$sz->product_size_id.'/'.$sz->product_id, '<i class="fa fa-check"></i>', 'title="Activar" type="button" class="btn btn-xs btn-info"'); ?>
                                          <?php endif; ?>
                                       </td>
                                       <div class="modal fade" id="modal_delete_<?php echo $sz->product_size_id; ?>">
                                          <div class="modal-dialog">
                                             <div class="modal-content">
                                                <div class="modal-header">
                                                   <button type="button" class="close" data-dismiss="modal">
                                                      <span aria-hidden="true">&times;</span>
                                                   </button>
                                                   <h3 class="modal-title">Desactivar <small class="lead">Configuración</small></h3>
                                                </div>
                                                <div class="modal-body">
                                                   <div class="row">
                                                      <div class="col-xs-12">
                                                         <div class="callout callout-warning">
                                                            <h4><i class="fa fa-warning"></i> Advertencia</h4>
                                                            <p>Está a punto de desactivar una <b>Configuración</b>, si está seguro de esto presione <b>Continuar</b></p>
                                                         </div>
                                                      </div>
                                                      <div class="col-xs-12">
                                                         <div class="box box-warning">
                                                            <div class="box-header whit-border">
                                                               <h3 class="box-title">Configuración</h3>
                                                               <div class="box-tools pull-right">
                                                                  <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Minimizar">
                                                                     <i class="fa fa-minus"></i>
                                                                  </button>
                                                               </div>
                                                            </div>
                                                            <div class="box-body">
                                                               <div class="row">
                                                                  <div class="col-xs-12 col-md-6">
                                                                     <p><b>Calidad:</b><br><?php echo ($sz->description_q != '') ? $sz->description_q : '-' ; ?></p>
                                                                  </div>
                                                                  <div class="col-xs-12 col-md-6">
                                                                     <p><b>Categoria:</b><br><?php echo ($sz->description_c != '') ? $sz->description_c : '-' ; ?></p>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="modal-footer">
                                                   <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar <span class="glyphicon glyphicon-remove"></span></button>
                                                   <?php echo anchor('size/status_config/'.$sz->product_size_id.'/'.$sz->product_id, 'Continuar <i class="fa fa-check"></i>', 'type="button" class="btn btn-success"'); ?>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="modal fade" id="modal_edit_<?php echo $sz->product_size_id; ?>">
                                          <div class="modal-dialog">
                                             <div class="modal-content">
                                                <?php echo form_open('size/set_info_cs', ['autocomplete' => 'off']); ?>
                                                <div class="modal-header">
                                                   <button type="button" class="close" data-dismiss="modal">
                                                      <span aria-hidden="true">&times;</span>
                                                   </button>
                                                   <h3 class="modal-title">Editar <small class="lead">Configuración</small></h3>
                                                </div>
                                                <div class="modal-body">
                                                   <div class="row">
                                                      <div class="col-xs-12">
                                                         <div class="form-group">
                                                            <input type="hidden" name="txtsender" value="1">
                                                            <input type="hidden" name="config_id" value="<?php echo $sz->product_size_id; ?>">
                                                            <input type="hidden" name="txtidproduct" value="<?php echo $info_product->row()->id_product; ?>">
                                                         </div>
                                                      </div>
                                                      <?php if ($info_product->row()->ctrl_size === '0,1' OR $info_product->row()->ctrl_size === '0'): ?>
                                                         <div class="col-xs-12">
                                                            <div class="form-group">
                                                               <label for=""><sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Calidad</label>
                                                               <?php echo form_dropdown('qualities[]', $qualities, set_value('qualities[]', $sz->quality_id), 'class="form-control select2" style="width: 100%;" required'); ?>
                                                               <input type="hidden" name="auxiliar_sender[]" value="0">
                                                            </div>
                                                         </div>
                                                      <?php endif; ?>
                                                      <?php if (($info_product->row()->ctrl_size === '0,1' OR $info_product->row()->ctrl_size === '1')): ?>
                                                         <div class="col-xs-12" <?php echo ($info_product->row()->ctrl_size === '0,1' OR $info_product->row()->ctrl_size === '1') ? '' : 'hidden' ; ?>>
                                                            <div class="form-group">
                                                               <label for=""><sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Categoria</label>
                                                               <?php echo form_dropdown('categories[]', $categories, set_value('categories[]', $sz->category_id), 'class="form-control select2" style="width: 100%;" required'); ?>
                                                               <input type="hidden" name="auxiliar_sender[]" value="1">
                                                            </div>
                                                         </div>
                                                      <?php endif; ?>
                                                   </div>
                                                </div>
                                                <div class="col-xs-12">
                                                   <p class="help-block">
                                                      <sup><li class="fa fa-asterisk color-asterisk-required"></li></sup> Campos requeridos
                                                      <br>
                                                      <li class="fa fa-exclamation-circle color-exclamation-sign-a"></li> Selecciona el <b>Tipo de tamaño</b> que se usará para <b>Configurar tamaños</b> en este producto
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
                                    </tr>
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
                     Aún no hay <b>Configuraciones de tamaños</b> para este producto. Da clic en <a href="#modal1" type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal1">Nueva Configuración <i class="fa fa-cubes"></i></a> para agregar una.
                  </div>
               </div>
            </div>
      <?php endif; ?>
      </div>
   </div>
   <div class="col-xs-1"></div>
</section>
<?php $this->load->view('footer');?>
