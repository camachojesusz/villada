<?php $this->load->view('header');?>
<section class="seccion">
  <div class="col-xs-1"></div>
  <div class="col-xs-10">
    <section class="content-header">
      <h1>Productos <small><strong>Listado de Productos</strong></small></h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>login/in_sess"><span class="glyphicon glyphicon-home"></span> Inicio</a></li>
        <li class="active">Productos</li>
      </ol>
    </section>
    <hr>

    <div class="modal fade" id="modal_new_product">
      <div class="modal-dialog">
        <div class="modal-content">
          <?php echo form_open('product/set_info', ['autocomplete' => 'off']); ?>
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title">Nuevo <small class="lead">Producto</small></h3>
          </div>
          <div class="modal-body row">
            <div class="col-xs-12">
              <div class="form-group">
                <input class="form-control" type="hidden" id="txtsender" name="txtsender" value="0">
              </div>
            </div>
            <div class="col-xs-12">
              <div class="form-group">
                <label for=""><sup><li class="fa fa-asterisk color-asterisk-required"></li></sup> Producto</label>
                <input required class="form-control" type="text" id="txtdescribe" name="txtdescribe" placeholder="nombre del producto" value="<?php if (isset($auto_complete) && ! empty($auto_complete)) { echo $auto_complete['describe_product']; } ?>">
              </div>
            </div>

            <div class="col-xs-12 row">
               <div class="col-xs-12">
                  <label for=""><sup><li class="fa fa-asterisk color-asterisk-required"></li></sup> <li class="fa fa-exclamation-circle color-exclamation-sign-a"></li> Tipo de tamaño</label>
                  <br>
                  <?php $i=0; foreach ($ctrl_size_a as $cs): ?>
                     <div class="col-xs-6 <?php echo ($cs === '0') ? 'text-right' : 'text-left' ; ?>">
                        <div class="form-group">
                           <label for="ctrl_size_<?php echo $i; ?>">
                              <?php echo form_checkbox('ctrl_size[]', $cs, '', 'id="ctrl_size_'.$i.'" class=""').'&nbsp;'.$ctrl_size_b[$cs]; ?>
                           </label>
                        </div>
                     </div>
                  <?php $i++; endforeach; ?>
               </div>
            </div>

            <div class="col-xs-12">
               <div class="form-group">
                  <label for="">Descripción</label>
                  <textarea id="txtcharacter" name="txtcharacter" class="form-control" rows="3">
                     <?php if (isset($auto_complete) && ! empty($auto_complete)) { echo trim($auto_complete['character_product']); } ?>
                  </textarea>
               </div>
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

    <div class="row">
      <?php if (isset($allproduct) && !empty($allproduct)): ?>
      <div class="col-xs-12">
        <div class="box box-primary">
          <?php
          if (isset($succes_product)): ?>
            <div class="col-xs-12">
              <br>
              <div class="callout callout-success">
                <h4>¡Correcto!</h4>
                <p class="">Se ha registrado un <b>Producto</b></p>
              </div>
            </div>
          <?php
          endif;
          if (isset($success_updateproduct)):
          ?>
          <div class="col-xs-12">
              <br>
            <div class="callout callout-info">
              <h4>¡Aviso!</h4>
              <p class="">La información de un <b>Producto</b> ha sido modificada</p>
            </div>
          </div>
          <?php
          endif;
          if (isset($alert_delete_product)):
          ?>
          <div class="col-xs-12">
              <br>
            <div class="callout callout-<?php echo ($alert_delete_product === '1') ? 'warning' : 'danger' ;?>">
              <h4><?php echo ($alert_delete_product === '1') ? '¡Atención!' : '¡Error!' ; ?></h4>
              <p class=""><?php echo ($alert_delete_product === '1') ? 'Se ha eliminado un <b>Producto</b>' : 'No se puede eliminar este <b>Producto</b> porque se encuentra relacionado con: <b>Origen, Compra, Selección, Salida o Venta</b>.' ; ?></p>
            </div>
          </div>
          <?php
          endif;
          ?>
          <div class="box-header pull-right">
            <p class="box-title">
              <a href="#modal_new_product" type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal_new_product">
                Nuevo Producto <span class="glyphicon glyphicon-apple"></span>&nbsp;<sup><i class="fa fa-plus"></i></sup></i>
              </a>
            </p>
          </div>
          <div class="box-body">
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
            <div id="general_table_wrapper" class="dataTables_wrapper dt-bootstrap">
              <div class="row">
                <div class="col-sm-12 table-responsive">
                  <table id="general_table" class="table table-bordered table-striped table-hover table-condensed dataTable" role="grid" aria-describedby="general_table_info">
                    <thead>
                      <tr role="row">
                        <th>Clave</th>
                        <th>Producto</th>
                        <th>Descripción</th>
                        <th>Estatus</th>
                        <th>Opciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($allproduct as $allproducts): ?>
                      <tr role="row">
                        <td>
                          <?php echo $allproducts->key_product; ?>
                        </td>
                        <td>
                          <?php echo $allproducts->describe_product; ?>
                        </td>
                        <td>
                          <?php echo $allproducts->character_product; ?>
                        </td>
                        <td>
                          <?php if ($allproducts->status_product === '0'): ?>
                          <small class="label label-danger"><i class="fa fa-remove"></i> Inactivo</small>
                          <?php else: ?>
                          <small class="label label-info"><i class="fa fa-check"></i> Activo</small>
                          <?php endif; ?>
                        </td>
                        <td class="text-center">
                          <?php echo anchor('size/config_size/'.$allproducts->id_product, 'Tamaños&nbsp;<i class="fa fa-cube"></i>&nbsp;<sup><i class="fa fa-plus"></i></sup>', 'style="background: #9B59B6; color: #FFFFFF;" type="button" title="Configurar tamaños" class="btn btn-xs '.(($allproducts->status_product === '0') ? ('hidden') : ('')).'"'); ?>
                          <a href="#modal_edit_product<?php echo $allproducts->id_product;?>" type="button" class="btn btn-primary btn-xs <?php echo (($allproducts->status_product === '0') ? ('hidden') : ('')); ?>" data-toggle="modal" data-target="#modal_edit_product<?php echo $allproducts->id_product;?>" title="Editar">
                            <i class="fa fa-edit"></i>
                          </a>
                          <?php if ($allproducts->status_product === '1'): ?>
                            <a href="#modal_delete_<?php echo $allproducts->id_product;?>" type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modal_delete_<?php echo $allproducts->id_product; ?>" title="Desactivar">
                            <i class="fa fa-remove"></i>
                          </a>
                          <?php else: ?>
                            <?php echo anchor('product/active/'.$allproducts->id_product, '<i class="fa fa-check"></i>', 'type="button" class="btn btn-xs btn-info" title="Activar"'); ?>
                          <?php endif; ?>
                        </td>
                      </tr>
                      <div class="modal fade" id="modal_edit_product<?php echo $allproducts->id_product; ?>">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <?php echo form_open('product/set_info', ['autocomplete' => 'off']); ?>
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">
                              <span aria-hidden="true">&times;</span></button>
                              <h3 class="modal-title">Editar Producto <small><?php echo $allproducts->key_product; ?></small></h3>
                            </div>
                            <div class="modal-body row">
                              <div class="col-xs-12">
                                <div class="form-group">
                                  <input class="" type="hidden" id="txtidproduct" name="txtidproduct" value="<?php echo $allproducts->id_product;?>">
                                  <input class="" type="hidden" id="txtkey" name="txtkey" value="<?php echo $allproducts->key_product;?>">
                                  <input class="" type="hidden" id="txtsender" name="txtsender" value="1">
                                </div>
                              </div>
                              <div class="col-xs-12">
                                <div class="form-group">.
                                  <label for="">Producto<sup><li class="fa fa-asterisk color-asterisk-required"></li></sup></label>
                                  <br>
                                  <input class="form-control" type="text" id="txtdescribe" required name="txtdescribe" placeholder="producto" value="<?php echo $allproducts->describe_product; ?>">
                                </div>
                              </div>
                              <div class="col-xs-12 row">
                                <div class="col-xs-12">
                                  <label for=""><sup><li class="fa fa-asterisk color-asterisk-required"></li></sup> <li class="fa fa-exclamation-circle color-exclamation-sign-a"></li> Tipo de tamaño</label>
                                </div>
                                 <?php $i=0; foreach ($ctrl_size_a as $cs_e): ?>
                                    <div class="col-xs-6 <?php echo ($cs_e === '0') ? 'text-right' : 'text-left' ; ?>">
                                       <div class="form-group">
                                          <label for="ctrl_size_<?php echo $i; ?>">
                                             <?php echo form_checkbox('ctrl_size[]', $cs_e, ($allproducts->ctrl_size != '0,1') ? $cs_e : $allproducts->ctrl_size, 'id="ctrl_size_'.$i.'" class=""').'&nbsp;'.$ctrl_size_b[$cs_e]; ?>
                                          </label>
                                       </div>
                                    </div>
                                 <?php $i++; endforeach; ?>
                              </div>
                              <div class="col-xs-12">
                                <div class="form-group">
                                  <label for="">Descripción</label><br>
                                  <textarea id="txtcharacter" name="txtcharacter" class="form-control" rows="3">
                                    <?php echo trim($allproducts->character_product); ?>
                                  </textarea>
                                </div>
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
                      <div class="modal fade" id="modal_delete_<?php echo $allproducts->id_product; ?>">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">
                              <span aria-hidden="true">&times;</span></button>
                              <h3 class="modal-title">Desactivar Producto <small><?php echo $allproducts->key_product; ?></small></h3>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <div class="col-xs-12">
                                  <div class="callout callout-warning">
                                    <h4><i class="fa fa-warning"></i> Advertencia</h4>
                                    <p>Está a punto de desactivar un <b>Producto</b>, si está seguro de esto presione <b>Continuar</b></p>
                                  </div>
                                </div>
                                <div class="col-xs-12">
                                  <div class="box box-warning">
                                    <div class="box-header whit-border">
                                      <h3 class="box-title">Producto</h3>
                                      <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Minimizar">
                                          <i class="fa fa-minus"></i>
                                        </button>
                                      </div>
                                    </div>
                                    <div class="box-body">
                                      <div class="row">
                                        <div class="col-xs-12 col-md-6">
                                          <p><b>Clave:</b><br><?php echo $allproducts->key_product; ?></p>
                                        </div>
                                        <div class="col-xs-12 col-md-6">
                                          <p><b>Producto:</b><br><?php echo $allproducts->describe_product; ?></p>
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
                              <?php echo anchor('product/delete_product/'.$allproducts->id_product, 'Continuar <i class="fa fa-check"></i>', 'type="button" class="btn btn-sm btn-success"');  ?>
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
            No hay productos registrados, da clic en el botón para agregar uno &nbsp;
            <a href="#modal_new_product" type="button" class="btn btn-info" data-toggle="modal" data-target="#modal_new_product">
              Nuevo Producto <i class="fa fa-plus"></i>
            </a>
          </div>
        </div>
      </div>
      <?php endif;?>
    </div>

  </div>
  <div class="col-xs-1"></div>
</section>
<?php $this->load->view('footer');?>
