<?php $this->load->view('header'); ?>

<section class="seccion">
   <div class="col-xs-1"></div>
   <div class="col-xs-10">
      <section class="content-header">
         <h1>Compras <small><strong>Nueva Compra</strong></small></h1>
         <ol class="breadcrumb">
            <li><?php echo anchor('login/in_sess', '<span class="glyphicon glyphicon-home"></span> Inicio</a>','title="Inicio"'); ?></li>
            <li><?php echo anchor('buy', 'Compras','title="Compras"'); ?></li>
            <li class="active">Nueva Compra</li>
         </ol>
      </section>
      <hr>
      <div class="col-xs-12">
         <?php echo form_open('buy/set_info', ['method' => 'POST', 'id' => 'form_buy', 'name' => 'form_buy', 'autocomplete' => 'off']); ?>
         <div class="row">
            <div class="col-xs-12">
               <div class="box box-solid box-warning">

                  <div class="box-header with-border">
                     <h3 class="box-title">Registro de Entradas</h3>
                     <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Minimizar"><i class="fa fa-minus"></i></button>
                     </div>
                  </div>
                  <div class="box-body row">

                     <?php if (isset($success_buy)): ?>
                        <div class="col-xs-12">
                           <br>
                           <div class="callout callout-success">
                              <h4>¡Correcto!</h4>
                              <p class="">
                                 Compra guardada con éxito, <label>Folio: </label> <?php if (isset($label_sheet_arrival) && !empty($label_sheet_arrival)): echo anchor('buy', $label_sheet_arrival); else: echo '<i class="fa fa-warning"></i> No concontrado'; endif; ?>
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

                     <div class="col-xs-12">
                        <div class="box  box-warning">
                           <div class="box-header with-border">
                              <h3 class="box-title">Proveedor</h3>
                              <div class="box-tools pull-right">
                                 <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Minimizar"><i class="fa fa-minus"></i></button>
                              </div>
                           </div>
                           <div class="box-body row">
                              <div class="col-xs-12 col-md-4">
                                 <div class="form-group">
                                    <input type="hidden" id="site_url" name="site_url" value="<?php echo base_url(); ?>">
                                    <input type="hidden" id="arrival_sheet" name="arrival_sheet" value="">
                                    <input type="hidden" id="txtsender" name="txtsender" value="0">
                                    <label for="txtproduct"><sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Producto</label>
                                    <br>
                                    <?php echo form_dropdown('txtproduct', $product, set_value('txtproduct', (isset($auto_complete) && !empty($auto_complete)) ? ($auto_complete['product']) : ('-1')), 'class="form-control select2" id="txtproduct" required'); ?>
                                 </div>
                              </div>
                              <div class="col-xs-12 col-md-4">
                                 <div class="form-group">
                                    <label for="txtproducer"><sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Proveedor</label>
                                    <br>
                                    <?php echo form_dropdown('txtproducer', $producer, set_value('txtproducer', (isset($auto_complete) && !empty($auto_complete)) ? ($auto_complete['producer']) : ('-1')), 'class="form-control select2" id="txtproducer" required'); ?>
                                 </div>
                              </div>
                              <div class="col-xs-12 col-md-4">
                                 <div class="form-group">
                                    <label for="txtorigin"><sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Origen</label>
                                    <br>
                                    <?php echo form_dropdown('txtorigin', $origin, set_value('txtorigin', (isset($auto_complete) && !empty($auto_complete)) ? ($auto_complete['origin']) : ('-1')), 'class="form-control select2" id="txtorigin" required'); ?>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="col-xs-12 col-md-5">
                        <div class="box  box-warning">
                           <div class="box-header with-border">
                              <h3 class="box-title">Calcular destare</h3>
                              <div class="box-tools pull-right">
                                 <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Minimizar"><i class="fa fa-minus"></i></button>
                              </div>
                           </div>
                           <div class="box-body row">
                              <div class="col-xs-12">
                                 <div class="form-group">
                                    <label for="txtdestare"><sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Calcular destare</label>
                                    <div class="input-group">
                                       <div class="input-group-addon">
                                          <label for="txtctrldestare_a">
                                             <input checked type="radio" id="txtctrldestare_a" name="txtctrldestare" value="0" required>
                                             Automático
                                          </label>
                                       </div>
                                       <?php echo form_dropdown('txtsizebox', (empty($size_box)) ? '' : $size_box, set_value('txtsizebox', '-1'), 'class="form-control select2" id="txtsizebox"'); ?>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-xs-12">
                                 <div class="form-group">
                                    <div class="input-group">
                                       <div class="input-group-addon">
                                          <label for="txtctrldestare_b">
                                             <input type="radio" id="txtctrldestare_b" name="txtctrldestare" value="1" required>
                                             Manual
                                          </label>
                                       </div>
                                       <input class="form-control" type="tel" min="0" id="txtvaldestare" name="txtvaldestare" placeholder="calcular destare manualmente" disabled="true">
                                       <span class="input-group-btn">
                                          <button disabled id="btndestare" type="button" class="btn btn-info btn-flat"><i class="fa fa-check"></i></button>
                                       </span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="col-xs-12 col-md-7">
                        <div class="box  box-warning">
                           <div class="box-header with-border">
                              <h3 class="box-title">Entrada</h3>
                              <div class="box-tools pull-right">
                                 <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Minimizar"><i class="fa fa-minus"></i></button>
                              </div>
                           </div>
                           <div class="box-body row">
                              <div class="col-xs-12 col-md-6">
                                 <div class="form-group">
                                    <label for="txtboxes"><sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Cajas</label>
                                    <input class="form-control" type="tel" required min="0" id="txtboxes" name="txtboxes" placeholder="cantidad de cajas" value="<?php if(isset($auto_complete) && !empty($auto_complete)): echo $auto_complete['boxes_arrival']; endif; ?>" onkeyup="data_ent()">
                                 </div>
                                 <div class="form-group">
                                    <label for="txtweight"><sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Kilos</label>
                                    <input class="form-control" type="tel" required min="0" id="txtweight" name="txtweight" placeholder="kilos" value="<?php if(isset($auto_complete) && !empty($auto_complete)): echo $auto_complete['weight_arrival']; endif; ?>" onkeyup="data_ent()">
                                 </div>
                              </div>
                              <div class="col-xs-12 col-md-6">
                                 <div class="form-group">
                                    <label for="txtdestare_a">Destare calculado</label>
                                    <input disabled class="form-control" type="tel" min="0" id="txtdestare_a" name="txtdestare_a" placeholder="destarado calculado" value="<?php if(isset($auto_complete) && !empty($auto_complete)): echo $auto_complete['destare_arrival']; endif; ?>">
                                    <input class="form-control" type="hidden" min="0" id="txtdestare_b" name="txtdestare_b" value="<?php if(isset($auto_complete) && !empty($auto_complete)): echo $auto_complete['destare_arrival']; endif; ?>">
                                 </div>
                                 <div class="form-group">
                                    <label for="txttotalweight_a">Total kg entrada</label>
                                    <input disabled class="form-control" type="tel" min="0" id="txttotalweight_a" name="txttotalweight_a" placeholder="total kg entrada" value="<?php if(isset($auto_complete) && !empty($auto_complete)): echo $auto_complete['totalweight_arrival']; endif; ?>">
                                    <input class="form-control" type="hidden" min="0" id="txttotalweight_b" name="txttotalweight_b" value="<?php if(isset($auto_complete) && !empty($auto_complete)): echo $auto_complete['totalweight_arrival']; endif; ?>">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="col-xs-12 col-md-6">
                        <div class="box collapsed-box box-warning">
                           <div class="box-header with-border">
                              <h3 class="box-title">Observaciones</h3>
                              <div class="box-tools pull-right">
                                 <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Maximizar"><i class="fa fa-plus"></i></button>
                              </div>
                           </div>
                           <div class="box-body row">
                              <div class="col-xs-12">
                                 <div class="form-group">
                                    <label for="txtobserve">Observaciones</label>
                                    <textarea class="form-control" id="txtobserve" name="txtobserve" rows="4">
                                       <?php if(isset($auto_complete) && !empty($auto_complete)): echo $auto_complete['observe_arrival']; endif; ?>
                                    </textarea>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="col-xs-12 col-md-4 pull-right">
                        <div class="col-xs-6 col-sm-12 col-md-6">
                           <div class="form-group">
                              <?php echo anchor('buy/new_buy', 'Cancelar <samp class="glyphicon glyphicon-remove"></samp>', 'class="btn btn-default btn-sm btn-block"'); ?>
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
<script src="<?php echo base_url(); ?>assets/complements/js/calculate_destare.js"></script>
<script src="<?php echo base_url(); ?>assets/complements/js/info_supply.js"></script>
