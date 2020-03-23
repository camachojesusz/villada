<?php $this->load->view('header');?>
<section class="seccion">
   <div class="col-xs-1"></div>
   <div class="col-xs-10">
      <section class="content-header">
         <h1>Tamaños <small><strong>Tamaños</strong></small></h1>
         <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>login/in_sess"><span class="glyphicon glyphicon-home"></span> Inicio</a></li>
            <li class="active">Tamaños</li>
         </ol>
      </section>
      <hr>
      <div class="modal fade" id="modal1">
         <div class="modal-dialog">
            <div class="modal-content">
               <?php echo form_open('size/set_info', ['autocomplete' => 'off']); ?>
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">
                     <span aria-hidden="true">&times;</span>
                  </button>
                  <h3 class="modal-title">Nueva <small class="lead">Calidad</small></h3>
               </div>
               <div class="modal-body row">
                  <div class="col-xs-12 hidden-xs hidden-sm hidden-md hidden-lg">
                     <div class="form-group">
                        <input type="hidden" name="txtsender" value="0">
                        <input type="hidden" name="auxiliar_sender" value="0">
                     </div>
                  </div>
                  <div class="col-xs-12">
                     <div class="form-group">
                        <label for="">Calidad<sup><li class="fa fa-asterisk color-asterisk-required"></li></sup></label>
                        <input class="form-control" type="text" id="txtdescribe_q"  name="txtdescribe_q" placeholder="Calidad" value="">
                     </div>
                  </div>
               </div>
               <div class="col-xs-12">
                  <p class="help-block">
                     <sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Campos requeridos
                     <br>
                  </p>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar <span class="glyphicon glyphicon-remove"></span></button>
                  <button type="button submit" class="btn btn-success" name="btnsend">Guardar <samp class="glyphicon glyphicon-floppy-disk"></samp></button>
               </div>
               <?php echo form_close(); ?>
            </div>
         </div>
      </div>
      <div class="modal fade" id="modal2">
         <div class="modal-dialog">
            <div class="modal-content">
               <?php echo form_open('size/set_info', ['autocomplete' => 'off']); ?>
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">
                     <span aria-hidden="true">&times;</span>
                  </button>
                  <h3 class="modal-title">Nueva <small class="lead">Categoria</small></h3>
               </div>
               <div class="modal-body row">
                  <div class="col-xs-12 hidden-xs hidden-sm hidden-md hidden-lg">
                     <div class="form-group">
                        <input type="hidden" name="txtsender" value="0">
                        <input type="hidden" name="auxiliar_sender" value="1">
                     </div>
                  </div>
                  <div class="col-xs-12">
                     <div class="form-group">
                        <label for="">Categoría<sup><li class="fa fa-asterisk color-asterisk-required"></li></sup></label>
                        <input class="form-control" type="text" id="txtdescribe_c" required name="txtdescribe_c" placeholder="Categoria" value="">
                     </div>
                  </div>
               </div>
               <div class="col-xs-12">
                  <p class="help-block">
                     <sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Campos requeridos
                     <br>
                  </p>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar <span class="glyphicon glyphicon-remove"></span></button>
                  <button type="button submit" class="btn btn-success" name="btnsend">Guardar <samp class="glyphicon glyphicon-floppy-disk"></samp></button>
               </div>
               <?php echo form_close(); ?>
            </div>
         </div>
      </div>
      <div class="row">
         <?php if (isset($quality) OR isset($category)): ?>
            <div class="col-xs-12">
               <div class="box box-primary">
                  <div class="box-body">
                     <div class="row">
                        <div class="col-xs-12"></div>
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
                        <?php if (isset($success_quality)): ?>
                           <div class="col-xs-12">
                              <br>
                              <div class="callout callout-success">
                                 <h4>¡Correcto!</h4>
                                 <p><b>Calidad</b> guardada con éxito.</p>
                              </div>
                           </div>
                        <?php endif; ?>
                        <?php if (isset($update_quality)): ?>
                           <div class="col-xs-12">
                              <br>
                              <div class="callout callout-info">
                                 <h4>¡Aviso!</h4>
                                 <p>La informacion de una <b>Calidad</b> ha sido cambiada.</p>
                              </div>
                           </div>
                        <?php endif; ?>
                        <?php if (isset($success_category)): ?>
                           <div class="col-xs-12">
                              <br>
                              <div class="callout callout-success">
                                 <h4>¡Correcto!</h4>
                                 <p><b>Categoria</b> guardada con éxito.</p>
                              </div>
                           </div>
                        <?php endif; ?>
                        <?php if (isset($update_category)): ?>
                           <div class="col-xs-12">
                              <br>
                              <div class="callout callout-info">
                                 <h4>¡Aviso!</h4>
                                 <p>La informacion de una <b>Categoria</b> ha sido cambiada.</p>
                              </div>
                           </div>
                        <?php endif; ?>
                        <?php if (isset($status_alert_a)): ?>
                           <div class="col-xs-12">
                              <br>
                              <div class="callout callout-<?php echo ($status_alert_a === '0') ? 'danger' : 'warning' ; ?>">
                                 <h4><?php echo ($status_alert_a === '0') ? '¡Error¡' : '¡Aviso!' ; ?></h4>
                                 <p> <?php echo ($status_alert_a === '0') ? 'No se permite eliminar esta <b>Calidad</b> porque se encuentra relacionada con: <b>Origen, Compra, Selección, Salida o Venta</b>.</p>' : 'Se ha eliminado una <b>Calidad</b>.' ; ?>
                              </div>
                           </div>
                        <?php endif; ?>
                        <?php if (isset($status_alert_b)): ?>
                           <div class="col-xs-12">
                              <br>
                              <div class="callout callout-<?php echo ($status_alert_b === '0') ? 'danger' : 'warning' ; ?>">
                                 <h4><?php echo ($status_alert_b === '0') ? '¡Error¡' : '¡Aviso!' ; ?></h4>
                                 <p> <?php echo ($status_alert_b === '0') ? 'No se permite eliminar esta <b>Categoría</b> porque se encuentra relacionada con: <b>Origen, Compra, Selección, Salida o Venta</b>.</p>' : 'Se ha eliminado una <b>Categoría</b>.' ; ?>
                              </div>
                           </div>
                        <?php endif; ?>
                        <div class="col-xs-12 col-md-6">
                           <div class="box box-info">
                              <div class="box-header with-border">
                                 <h3 class="box-title">Calidad</h3>
                                 <div class="box-tools pull-right">
                                    <a href="#modal1" type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal1">Nueva Calidad</a>
                                 </div>
                              </div>
                              <div class="box-body">
                                 <div id="table_size_a_wrapper" class="dataTables_wrapper dt-bootstrap">
                                    <div class="table-responsive">
                                       <table id="table_size_a" class="table table-bordered table-striped table-hover table-condensed dataTable" role="grid" aria-describedby="table_size_a_info">
                                          <thead>
                                             <tr role="row">
                                                <th hidden><?php echo ''; ?></th>
                                                <th>Calidad</th>
                                                <th>Opciones</th>
                                             </tr>
                                          </thead>
                                          <?php foreach ($quality as $qualities): ?>
                                             <tr>
                                                <td hidden><?php echo $qualities->quality_id; ?></td>
                                                <td><?php echo ($qualities->description_q != '') ? $qualities->description_q : '-' ; ?></td>
                                                <td class="text-center">
                                                   <a title="Editar calidad" href="#modal_edit_a_<?php echo $qualities->quality_id; ?>" type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modal_edit_a_<?php echo $qualities->quality_id; ?>"><i class="fa fa-edit"></i></a>
                                                   <a title="Eliminar calidad" href="#modal_delete_a_<?php echo $qualities->quality_id; ?>" type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modal_delete_a_<?php echo $qualities->quality_id; ?>"><i class="fa fa-remove"></i></a>
                                                </td>
                                             </tr>
                                             <div class="modal fade" id="modal_edit_a_<?php echo $qualities->quality_id; ?>">
                                                <div class="modal-dialog">
                                                   <div class="modal-content">
                                                      <?php echo form_open('size/set_info', ['autocomplete' => 'off']); ?>
                                                      <div class="modal-header">
                                                         <button type="button" class="close" data-dismiss="modal">
                                                            <span aria-hidden="true">&times;</span>
                                                         </button>
                                                         <h3 class="modal-title">Editar <small class="lead">Calidad</small></h3>
                                                      </div>
                                                      <div class="modal-body row">
                                                         <div class="col-xs-12">
                                                            <div class="form-group">
                                                               <input type="hidden" name="txtsender" value="1">
                                                               <input type="hidden" name="auxiliar_sender" value="0">
                                                               <input type="hidden" name="quality_id" value="<?php echo $qualities->quality_id; ?>">
                                                            </div>
                                                         </div>
                                                         <div class="col-xs-12">
                                                            <div class="form-group">
                                                               <label for=""><sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Calidad</label>
                                                               <input class="form-control" type="text" id="txtdescribe_q" required name="txtdescribe_q" placeholder="calidad" value="<?php echo $qualities->description_q; ?>">
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <div class="col-xs-12">
                                                         <p class="help-block">
                                                            <sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Campos requeridos
                                                            <br>
                                                         </p>
                                                      </div>
                                                      <div class="modal-footer">
                                                         <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar <span class="glyphicon glyphicon-remove"></span></button>
                                                         <button type="button submit" class="btn btn-success" name="btnsend">Guardar <samp class="glyphicon glyphicon-floppy-disk"></samp></button>
                                                      </div>
                                                      <?php echo form_close(); ?>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="modal fade" id="modal_delete_a_<?php echo $qualities->quality_id; ?>">
                                                <div class="modal-dialog">
                                                   <div class="modal-content">
                                                      <div class="modal-header">
                                                         <button type="button" class="close" data-dismiss="modal">
                                                            <span aria-hidden="true">&times;</span>
                                                         </button>
                                                         <h3 class="modal-title">Eliminar <small class="lead">Calidad</small></h3>
                                                      </div>
                                                      <div class="modal-body">
                                                         <div class="row">
                                                            <div class="col-xs-12">
                                                               <div class="callout callout-warning">
                                                                  <h4><i class="fa fa-warning"></i> Advertencia</h4>
                                                                  <p>Está a punto de eliminar una <b>Calidad</b>, si está seguro de esto presione <b>Continuar</b></p>
                                                               </div>
                                                            </div>
                                                            <div class="col-xs-12">
                                                               <div class="box box-warning">
                                                                  <div class="box-header whit-border">
                                                                     <h3 class="box-title">Calidad</h3>
                                                                     <div class="box-tools pull-right">
                                                                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Minimizar">
                                                                           <i class="fa fa-minus"></i>
                                                                        </button>
                                                                     </div>
                                                                  </div>
                                                                  <div class="box-body">
                                                                     <div class="row">
                                                                        <div class="col-xs-12">
                                                                           <p><b>Calidad:</b><br><?php echo ($qualities->description_q != '') ? $qualities->description_q : '-' ; ?></p>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <div class="modal-footer">
                                                         <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar <span class="glyphicon glyphicon-remove"></span></button>
                                                         <?php echo anchor('size/status_size/0/'.$qualities->quality_id, 'Continuar <i class="fa fa-check"></i>', 'type="button" class="btn btn-success"'); ?>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          <?php endforeach; ?>
                                       </table>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                           <div class="box box-info">
                              <div class="box-header with-border">
                                 <h3 class="box-title">Categoría</h3>
                                 <div class="box-tools pull-right">
                                    <a href="#modal2" type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal2">Nueva Categoría</a>
                                 </div>
                              </div>
                              <div class="box-body">
                                 <div id="table_size_b_wrapper" class="dataTables_wrapper dt-bootstrap">
                                    <div class="table-responsive">
                                       <table id="table_size_b" class="table table-bordered table-striped table-hover table-condensed dataTable" role="grid" aria-describedby="table_size_b_info">
                                          <thead>
                                             <tr role="row">
                                                <th hidden><?php echo ""; ?></th>
                                                <th>Categoria</th>
                                                <th>Opciones</th>
                                             </tr>
                                          </thead>
                                          <?php foreach ($category as $categories): ?>
                                             <tr>
                                                <td hidden><?php echo $categories->category_id; ?></td>
                                                <td><?php echo ($categories->description_c != '') ? $categories->description_c : '-' ; ?></td>
                                                <td class="text-center">
                                                   <a title="Editar categoria" href="#modal_edit_b_<?php echo $categories->category_id; ?>" type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modal_edit_b_<?php echo $categories->category_id; ?>"><i class="fa fa-edit"></i></a>
                                                   <a title="Eliminar categoría" href="#modal_delete_b_<?php echo $categories->category_id; ?>" type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modal_delete_b_<?php echo $categories->category_id; ?>"><i class="fa fa-remove"></i></a>
                                                </td>
                                             </tr>
                                             <div class="modal fade" id="modal_edit_b_<?php echo $categories->category_id; ?>">
                                                <div class="modal-dialog">
                                                   <div class="modal-content">
                                                      <?php echo form_open('size/set_info', ['autocomplete' => 'off']); ?>
                                                      <div class="modal-header">
                                                         <button type="button" class="close" data-dismiss="modal">
                                                            <span aria-hidden="true">&times;</span>
                                                         </button>
                                                         <h3 class="modal-title">Editar <small class="lead">Categoría</small></h3>
                                                      </div>
                                                      <div class="modal-body row">
                                                         <div class="col-xs-12">
                                                            <div class="form-group">
                                                               <input type="hidden" name="txtsender" value="1">
                                                               <input type="hidden" name="auxiliar_sender" value="1">
                                                               <input type="hidden" name="category_id" value="<?php echo $categories->category_id; ?>">
                                                            </div>
                                                         </div>
                                                         <div class="col-xs-12">
                                                            <div class="form-group">
                                                               <label for=""><sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Categoria</label>
                                                               <input class="form-control" type="text" id="txtdescribe_c" required name="txtdescribe_c" placeholder="Categoria" value="<?php echo $categories->description_c; ?>">
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <div class="col-xs-12">
                                                         <p class="help-block">
                                                            <sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Campos requeridos
                                                            <br>
                                                         </p>
                                                      </div>
                                                      <div class="modal-footer">
                                                         <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar <span class="glyphicon glyphicon-remove"></span></button>
                                                         <button type="button submit" class="btn btn-success" name="btnsend">Guardar <samp class="glyphicon glyphicon-floppy-disk"></samp></button>
                                                      </div>
                                                      <?php echo form_close(); ?>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="modal fade" id="modal_delete_b_<?php echo $categories->category_id; ?>">
                                                <div class="modal-dialog">
                                                   <div class="modal-content">
                                                      <div class="modal-header">
                                                         <button type="button" class="close" data-dismiss="modal">
                                                            <span aria-hidden="true">&times;</span>
                                                         </button>
                                                         <h3 class="modal-title">Eliminar <small class="lead">Categoría</small></h3>
                                                      </div>
                                                      <div class="modal-body">
                                                         <div class="row">
                                                            <div class="col-xs-12">
                                                               <div class="callout callout-warning">
                                                                  <h4><i class="fa fa-warning"></i> Advertencia</h4>
                                                                  <p>Está a punto de eliminar una <b>Categoría</b>, si está seguro de esto presione <b>Continuar</b></p>
                                                               </div>
                                                            </div>
                                                            <div class="col-xs-12">
                                                               <div class="box box-warning">
                                                                  <div class="box-header whit-border">
                                                                     <h3 class="box-title">Categoría</h3>
                                                                     <div class="box-tools pull-right">
                                                                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Minimizar">
                                                                           <i class="fa fa-minus"></i>
                                                                        </button>
                                                                     </div>
                                                                  </div>
                                                                  <div class="box-body">
                                                                     <div class="row">
                                                                        <div class="col-xs-12">
                                                                           <p><b>Categoría:</b><br><?php echo ($categories->description_c != '') ? $categories->description_c : '-' ; ?></p>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <div class="modal-footer">
                                                         <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar <span class="glyphicon glyphicon-remove"></span></button>
                                                         <?php echo anchor('size/status_size/1/'.$categories->category_id, 'Continuar <i class="fa fa-check"></i>', 'type="button" class="btn btn-success"'); ?>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          <?php endforeach; ?>
                                       </table>
                                    </div>
                                 </div>
                              </div>
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
                     Aún no hay Tamaños. Da clic en el botón para crear el tipo que necesitas <a href="#modal1" type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal1">Nueva Calidad</a> <a href="#modal2" type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal2">Nueva Categoría</a>
                  </div>
               </div>
            </div>
         <?php endif; ?>
      </div>
   <div class="col-xs-1"></div>
</section>
<?php $this->load->view('footer'); ?>
