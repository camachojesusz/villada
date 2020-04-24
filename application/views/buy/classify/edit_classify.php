<?php $this->load->view('header'); ?>

<section class="seccion">
   <div class="col-xs-1"></div>
   <div class="col-xs-10">
      <section class="content-header">
         <h1>Seleccionar tamaños <small><strong>Editar selección</strong></small></h1>
         <ol class="breadcrumb">
            <li><?php echo anchor('login/in_sess', '<span class="glyphicon glyphicon-home"></span> Inicio</a>','title="Inicio"'); ?></li>
            <li><?php echo anchor('buy', 'Compras','title="Compras"'); ?></li>
            <li><?php echo anchor('classify/index/'.$sheet_arrival, 'Seleccionar tamaños','title="Seleccionar tamaños"'); ?></li>
            <li class="active">Editar selección</li>
         </ol>
      </section>
      <hr>
      <div class="col-xs-12">
         <?php echo form_open('classify/set_info_edit', ['method' => 'POST', 'id' => 'form_buy', 'name' => 'form_buy', 'autocomplete' => 'off']); ?>
         <div class="row">
            <div class="col-xs-12">
               <div class="box box-solid box-warning">
                  <div class="box-header with-border">
                     <h3 class="box-title">Editar selección</h3>
                     <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Minimizar"><i class="fa fa-minus"></i></button>
                     </div>
                  </div>
                  <div <?php if ($arrival->row()->status_classify === '0') { echo "hidden"; } ?> class="box-body row">
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
                     <div class="col-xs-12">
                        <div class="box box-warning">
                           <div class="box-body row">
                              <div class="col-xs-3 col-md-2">
                                 <p>
                                    <small>
                                       <b>Proveedor:</b><br><label for=""><?php echo $arrival->row()->describe_producer; ?></label>
                                    </small>
                                 </p>
                              </div>
                              <div class="col-xs-3 col-md-2">
                                 <p>
                                    <small>
                                       <b>Origen:</b><br><label for=""><?php echo $arrival->row()->describe_origin; ?></label>
                                    </small>
                                 </p>
                              </div>
                              <div class="col-xs-3 col-md-2">
                                 <p>
                                    <small>
                                       <b>Producto:</b><br><label for=""><?php echo $arrival->row()->describe_product; ?></label>
                                    </small>
                                 </p>
                              </div>
                              <div class="col-xs-3 col-md-1">
                                 <p>
                                    <small>
                                       <b>Cajas:</b><br><label for=""><?php echo $arrival->row()->boxes_arrival; ?></label>
                                    </small>
                                 </p>
                              </div>
                              <div class="col-xs-3 col-md-1">
                                 <p>
                                    <small>
                                       <b>Peso:</b><br><label for=""><?php echo $arrival->row()->weight_arrival.' kg'; ?></label>
                                    </small>
                                 </p>
                              </div>
                              <div class="col-xs-3 col-md-2">
                                 <p>
                                    <small>
                                       <b>Cajas (disponibles):</b><br><label id="txtboxes_lb_b"><?php echo $arrival_c->row()->boxes_arrival; ?></label>
                                    </small>
                                 </p>
                              </div>
                              <div class="col-xs-3 col-md-2">
                                 <p>
                                    <small>
                                       <b>Peso (disponibles):</b><br><label id="txtweight_lb_b"><?php echo $arrival_c->row()->weight_arrival.' kg'; ?></label>
                                    </small>
                                 </p>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-xs-12 col-md-5">
                        <div class="col-xs-12">
                           <div class="box box-warning">
                              <div class="box-header with-border">
                                 <h3 class="box-title">Tamaño</h3>
                                 <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Minimizar"><i class="fa fa-minus"></i></button>
                                 </div>
                              </div>
                              <div class="box-body row">
                                 <?php if ($arrival->row()->ctrl_size === '0,1' OR $arrival->row()->ctrl_size === '0'): ?>
                                    <div class="col-xs-12">
                                       <div class="form-group">
                                          <label for=""><sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Calidad</label>
                                          <?php if (empty($quality)): ?>
                                             <div class="callout callout-warning">
                                                <h4>Alerta!</h4>
                                                <p class="">
                                                   No se ha agregado alguna <?php echo anchor('size', 'Calidad', ''); ?>
                                                </p>
                                             </div>
                                          <?php else: ?>
                                             <?php echo form_dropdown('txtquality', $quality, set_value('txtquality', $classify->row()->quality_id), 'class="form-control select2" id="txtquality" onkeyup="data_ent()" required'); ?>
                                          <?php endif; ?>
                                       </div>
                                    </div>
                                 <?php endif; ?>
                                 <?php if ($arrival->row()->ctrl_size === '0,1' OR $arrival->row()->ctrl_size === '1'): ?>
                                    <div class="col-xs-12">
                                       <div class="form-group">
                                          <label for=""><sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Categoría</label>
                                          <?php if (empty($category)): ?>
                                             <div class="callout callout-warning">
                                                <h4>Alerta!</h4>
                                                <p class="">
                                                   No se ha agregado alguna <?php echo anchor('size', 'Categoría', ''); ?>
                                                </p>
                                             </div>
                                          <?php else: ?>
                                             <?php echo form_dropdown('txtcategory', $category, set_value('txtcategory', $classify->row()->category_id), 'class="form-control select2" id="txtcategory" onkeyup="data_ent()" required'); ?>
                                          <?php endif; ?>
                                       </div>
                                    </div>
                                 <?php endif; ?>
                              </div>
                           </div>
                        </div>
                        <div class="col-xs-12">
                           <div class="box box-warning">
                              <div class="box-header with-border">
                                 <h3 class="box-title">Calcular destare</h3>
                                 <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Minimizar"><i class="fa fa-minus"></i></button>
                                 </div>
                              </div>
                              <div class="box-body row">
                                 <div class="col-xs-12 col-md-6">
                                    <label>Tipo de Destare:</label>
                                    <p>
                                       <?php if($arrival->row()->type_destare === '0'): ?>
                                          <small class="label label-info"><i class="fa fa-check"></i> Aumático</small>
                                       <?php else: ?>
                                          <small class="label label-info"><i class="fa fa-check"></i> Manual</small>
                                       <?php endif; ?>
                                    </p>
                                    <input type="hidden" id="txtsender" name="txtsender" value="1">
                                    <input type="hidden" id="site_url" name="site_url" value="<?php echo base_url(); ?>">
                                    <input type="hidden" id="sheet_arrival" name="sheet_arrival" value="<?php echo $sheet_arrival; ?>">
                                    <input type="hidden" id="id_arrival" name="id_arrival" value="<?php echo $arrival->row()->id_arrival; ?>">
                                    <input type="hidden" id="id_classify" name="id_classify" value="<?php echo $classify->row()->classify_id; ?>">
                                    <input type="hidden" id="txtctrldestare" name="txtctrldestare" value="<?php echo $arrival->row()->type_destare; ?>">
                                    <input type="hidden" id="ctrl_status_classify" name="ctrl_status_classify" value="<?php echo $arrival->row()->status_classify; ?>">
                                    <input type="hidden" id="ctrl_size" name="ctrl_size" value="<?php echo $arrival->row()->ctrl_size; ?>">
                                    <input type="hidden" id="product_id" name="product_id" value="<?php echo $arrival->row()->product_supply; ?>">
                                 </div>
                                 <div class="col-xs-12 col-md-6">
                                    <label>Valor de Destare:</label>
                                    <p><small class="label label-info"><i class="fa fa-check"></i> <?php echo 'x'.$arrival->row()->val_destare; ?></small></p>
                                    <input type="hidden" id="txtvaldestare" name="txtvaldestare" value="<?php echo $arrival->row()->val_destare; ?>">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-xs-12 col-md-7">
                        <div class="box box-warning">
                           <div class="box-header with-border">
                              <h3 class="box-title">Entrada</h3>
                              <div class="box-tools pull-right">
                                 <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Minimizar"><i class="fa fa-minus"></i></button>
                              </div>
                           </div>
                           <div class="box-body row">
                              <div class="col-xs-12 col-md-6">
                                 <div class="form-group">
                                    <label for="txtboxes"><sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Cajas (Disponibles: <label id="txtboxes_lb"><?php echo $arrival_c->row()->boxes_arrival; ?></label id="txtboxes_lb">)</label>
                                    <div class="input-group">
                                       <input class="form-control" type="tel" required id="txtboxes" name="txtboxes" placeholder="cantidad de cajas" value="<?php echo $classify->row()->boxes_c; ?>" onkeyup="data_ent()">
                                       <span class="input-group-btn">
                                          <a href="#modal_min_bx" data-toggle="modal" data-target="#modal_min_bx" id="" title="Retirar" type="button" class="btn btn-default btn-flat"><i class="fa fa-minus"></i></a>
                                       </span>
                                       <?php if ($arrival_c->row()->boxes_arrival != '0'): ?>
                                          <span class="input-group-btn">
                                             <a href="#modal_add_bx" data-toggle="modal" data-target="#modal_add_bx" id="" title="Agregar" type="button" class="btn btn-info btn-flat"><i class="fa fa-plus"></i></a>
                                          </span>
                                          <span class="input-group-btn">
                                             <button id="btn_add_all_bx" title="Agregar todo" type="button" class="btn btn-primary btn-flat"><i class="fa fa-level-up"></i></button>
                                          </span>
                                       <?php endif; ?>
                                    </div>
                                    <input type="hidden" id="txtboxes_b" name="txtboxes_b" value="<?php echo $classify->row()->boxes_c; ?>" onkeyup="data_ent()">
                                    <input type="hidden" id="txtboxes_c" name="txtboxes_c" value="" onkeyup="data_ent()">
                                    <input type="hidden" id="ctrl_boxes" name="ctrl_boxes" value="<?php echo $arrival_c->row()->boxes_arrival; ?>">
                                    <input type="hidden" id="ctrl_boxes_b" name="ctrl_boxes_b" value="<?php echo $arrival_c->row()->boxes_arrival; ?>">
                                 </div>
                                 <div class="form-group">
                                    <label for="txtweight"><sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Kilos (Disponibles: <label id="txtweight_lb"><?php echo $arrival_c->row()->weight_arrival; ?></label>)</label>
                                    <div class="input-group">
                                       <input class="form-control" type="tel" required id="txtweight" name="txtweight" placeholder="kilos" value="<?php echo $classify->row()->weight_c; ?>" onkeyup="data_ent()">
                                       <span class="input-group-btn">
                                          <a href="#modal_min_kg" data-toggle="modal" data-target="#modal_min_kg" id="" title="Retirar" type="button" class="btn btn-default btn-flat"><i class="fa fa-minus"></i></a>
                                       </span>
                                       <?php if ($arrival_c->row()->weight_arrival != '0'): ?>
                                          <span class="input-group-btn">
                                             <a href="#modal_add_kg" data-toggle="modal" data-target="#modal_add_kg" id="" title="Agregar" type="button" class="btn btn-info btn-flat"><i class="fa fa-plus"></i></a>
                                          </span>
                                          <span class="input-group-btn">
                                             <button id="btn_add_all_kg" title="Agregar todo" type="button" class="btn btn-primary btn-flat"><i class="fa fa-level-up"></i></button>
                                          </span>
                                       <?php endif; ?>
                                    </div>
                                    <input type="hidden" id="txtweight_b" name="txtweight_b" value="<?php echo $classify->row()->weight_c; ?>" onkeyup="data_ent()">
                                    <input type="hidden" id="txtweight_c" name="txtweight_c" value="" onkeyup="data_ent()">
                                    <input type="hidden" id="ctrl_weigth" name="ctrl_weigth" value="<?php echo $arrival_c->row()->weight_arrival; ?>">
                                    <input type="hidden" id="ctrl_weigth_b" name="ctrl_weigth_b" value="<?php echo $arrival_c->row()->weight_arrival; ?>">
                                 </div>
                              </div>
                              <div class="modal fade" id="modal_min_bx">
                                 <div class="modal-dialog">
                                    <div class="modal-content">
                                       <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal">
                                             <span aria-hidden="true">&times;</span>
                                          </button>
                                          <h3 class="modal-title">Retirar <small class="lead">Cajas</small></h3>
                                       </div>
                                       <div class="modal-body row">
                                          <div class="col-xs-12">
                                             <div class="form-group">
                                                <label for=""><sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Cajas (En existencia: <label id="j_txtboxes_lb"><?php echo $classify->row()->boxes_c; ?></label>)</label>
                                                <input class="form-control" type="text" id="j_box_min" name="j_box_min" placeholder="cantidad de cajas a retirar" value="">
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
                                          <button id="btn_min_bx" name="btn_min_bx" type="button" class="btn btn-success" data-dismiss="modal">Retirar <i class="fa fa-minus-square"></i></button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="modal fade" id="modal_add_bx">
                                 <div class="modal-dialog">
                                    <div class="modal-content">
                                       <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal">
                                             <span aria-hidden="true">&times;</span>
                                          </button>
                                          <h3 class="modal-title">Agregar <small class="lead">Cajas</small></h3>
                                       </div>
                                       <div class="modal-body row">
                                          <div class="col-xs-12">
                                             <div class="form-group">
                                                <label for=""><sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Cajas (Disponibles: <?php echo $arrival_c->row()->boxes_arrival; ?>)</label>
                                                <input class="form-control" type="text" id="j_box_add" name="j_box_add" placeholder="cantidad de cajas a sumar" value="">
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
                                          <button id="btn_add_bx" type="button" class="btn btn-success" data-dismiss="modal">Agregar <i class=" fa fa-plus-square"></i></button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="modal fade" id="modal_min_kg">
                                 <div class="modal-dialog">
                                    <div class="modal-content">
                                       <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal">
                                             <span aria-hidden="true">&times;</span>
                                          </button>
                                          <h3 class="modal-title">Retirar <small class="lead">Kilos</small></h3>
                                       </div>
                                       <div class="modal-body row">
                                          <div class="col-xs-12">
                                             <div class="form-group">
                                                <label for=""><sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Kilos (En existencia: <label id="j_txtweight_lb"><?php echo $classify->row()->weight_c; ?></label>)</label>
                                                <input class="form-control" type="text" id="j_kg_min" name="j_kg_min" placeholder="cantidad de cajas a restar" value="">
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
                                          <button id="btn_min_kg" type="button" class="btn btn-success" data-dismiss="modal">Retirar <i class="fa fa-minus-square"></i></button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="modal fade" id="modal_add_kg">
                                 <div class="modal-dialog">
                                    <div class="modal-content">
                                       <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal">
                                             <span aria-hidden="true">&times;</span>
                                          </button>
                                          <h3 class="modal-title">Agregar <small class="lead">Kilos</small></h3>
                                       </div>
                                       <div class="modal-body row">
                                          <div class="col-xs-12">
                                             <div class="form-group">
                                                <label for=""><sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Kilos (Disponibles: <?php echo $arrival_c->row()->weight_arrival; ?>)</label>
                                                <input class="form-control" type="text" id="j_kg_add" name="j_kg_add" placeholder="cantidad de kg a sumar" value="">
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
                                          <button id="btn_add_kg" type="button" class="btn btn-success" data-dismiss="modal">Agregar <i class=" fa fa-plus-square"></i></button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-xs-12 col-md-6">
                                 <div class="form-group">
                                    <label for="txtdestare_a">Destare calculado</label>
                                    <input disabled class="form-control" type="tel" min="0" id="txtdestare_a" name="txtdestare_a" placeholder="destarado calculado" value="<?php echo $classify->row()->destare_c; ?>">
                                    <input class="form-control" type="hidden" min="0" id="txtdestare_b" name="txtdestare_b" value="<?php echo $classify->row()->destare_c; ?>">
                                 </div>
                                 <div class="form-group">
                                    <label for="txttotalweight_a">Total kg entrada</label>
                                    <input disabled class="form-control" type="tel" min="0" id="txttotalweight_a" name="txttotalweight_a" placeholder="total kg entrada" value="<?php echo $classify->row()->total_weight_c; ?>">
                                    <input class="form-control" type="hidden" min="0" id="txttotalweight_b" name="txttotalweight_b" value="<?php echo $classify->row()->total_weight_c; ?>">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-xs-12 col-md-4 pull-right">
                        <div class="col-xs-6 col-sm-12 col-md-6">
                           <div class="form-group">
                              <?php echo anchor('classify/index/'.$sheet_arrival, 'Cancelar <samp class="glyphicon glyphicon-remove"></samp>', 'class="btn btn-default btn-sm btn-block"'); ?>
                           </div>
                        </div>
                        <div class="col-xs-6 col-sm-12 col-md-6">
                           <div class="form-group">
                              <button type="button submit" class="btn btn-sm btn-success btn-block" name="btnsend">Guardar <samp class="glyphicon glyphicon-floppy-disk"></samp></button>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="box-footer">
                     <p class="help-block">
                        <sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Campos obligatorios
                     </p>
                  </div>
               </div>
            </div>
         </div>
         <?php echo form_close(); ?>
      </div>
   </div>
   <div class="col-xs-1"></div>
</section>
<?php $this->load->view('footer');?>
<script src="<?php echo base_url(); ?>assets/complements/js/edit_classify.js"></script>
<script src="<?php echo base_url(); ?>assets/complements/js/info_classify.js"></script>
