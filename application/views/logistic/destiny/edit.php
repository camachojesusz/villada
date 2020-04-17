<?php //$this->load->view('logistic/header'); ?>
<?php $this->load->view('header'); ?>
   <section class="seccion">
      <div class="col-xs-1"></div>
      <div class="col-xs-10">
         <section class="content-header">
            <h1>Destinos</h1>
            <ol class="breadcrumb">
               <li><?php echo anchor('logistic/logistic_index', '<span class="glyphicon glyphicon-home"></span> Inicio</a>','title="Inicio Logística"'); ?></li>
               <li><?php echo anchor('logistic/destiny', 'Destinos', ''); ?></li>
               <li class="active">Nuevo Destino</li>
            </ol>
         </section>
         <hr>
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
            <?php echo form_open('logistic/destiny/set_info', ['autocomplete' => 'off']); ?>
            <div class="row">
               <div class="col-xs-12">
                  <div class="box box-solid box-success">
                     <div class="box-header with-border">
                        <h3 class="box-title">Destino</h3>
                        <div class="box-tools">
                           <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Minimizar"><i class="fa fa-minus"></i></button>
                        </div>
                     </div>
                     <div class="box-body row">
                        <div class="col-xs-12 col-md-5">
                           <div class="form-group">
                              <label for="txtname"><sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Destino</label>
                              <input type="hidden" id="txtsender" name="txtsender" value="1">
                              <input type="hidden" name="txtdestiny" value="<?php echo $destiny->row()->destiny_id; ?>">
                              <input required class="form-control" type="text" id="txtname" name="txtname" placeholder="destino" value="<?php echo $destiny->row()->description_d; ?>">
                           </div>
                        </div>
                        <div class="col-xs-12 col-md-7">
                           <?php if (empty($size_box)): ?>
                              <div class="callout callout-warning">
                                 <h4>¡Alerta!</h4>
                                 <p class="">
                                    No se han agregado <b>Cajas</b>
                                 </p>
                              </div>
                           <?php else: ?>
                              <div class="col-xs-12 col-md-6">
                                 <div class="form-group">
                                    <label for="txtdestare"><li class="fa fa-exclamation-circle color-exclamation-sign-b"></li>&nbsp;<sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Calcular destare</label>
                                    <div class="input-group">
                                       <div class="input-group-addon">
                                          <label for="txtctrldestare_a">
                                             <input checked type="radio" id="txtctrldestare_a" name="txtctrldestare" value="0" required>
                                             Automático
                                          </label>
                                       </div>
                                       <?php echo form_dropdown('txtsizebox', (empty($size_box)) ? '' : $size_box, set_value('txtsizebox', $destiny->row()->destare), 'class="form-control select2" id="txtsizebox"'); ?>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-xs-12 col-md-6">
                                 <div class="form-group">
                                    <label for="">&nbsp;</label>
                                    <div class="input-group">
                                       <div class="input-group-addon">
                                          <label for="txtctrldestare_b">
                                             <input type="radio" id="txtctrldestare_b" name="txtctrldestare" value="1" required>
                                             Manual
                                          </label>
                                       </div>
                                       <input class="form-control" type="tel" min="0" id="txtvaldestare" name="txtvaldestare" value="<?php echo ($destiny->row()->type_destare === '0') ? '' : $destiny->row()->destare; ?>" placeholder="calcular destare manualmente" title="calcular destare manualmente" disabled="true">
                                    </div>
                                 </div>
                              </div>
                           <?php endif; ?>
                        </div>
                     </div>
                     <div class="box-footer">
                        <p class="help-block">
                           <sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Campos obligatorios
                           <br>
                           <li class="fa fa-exclamation-circle color-exclamation-sign-b"></li>&nbsp;Seleccione un tipo de caja para calular el destare durante las ventas en este destino
                        </p>
                     </div>
                  </div>
               </div>
               <div class="col-xs-12">
                  <div class="box box-solid box-success">
                     <div class="box-header with-border">
                        <h3 class="box-title">Ubicación detallada</h3>
                        <div class="box-tools">
                           <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Minimizar"><i class="fa fa-minus"></i></button>
                        </div>
                     </div>
                     <div class="box-body row">
                        <div class="col-xs-12 col-md-4">
                           <div class="form-group">
                              <label for="txtstreet">Calle</label>
                              <input class="form-control" type="text" id="txtstreet" name="txtstreet" placeholder="calle" value="<?php  echo $destiny->row()->street; ?>">
                           </div>
                        </div>
                        <div class="col-xs-12 col-md-8">
                           <div class="col-xs-12 col-sm-4">
                              <div class="form-group">
                                 <label for="txtnumint"><li class="fa fa-exclamation-circle color-exclamation-sign-a"></li >&nbsp;Número interior</label>
                                 <input class="form-control" type="text" id="txtnumint" name="txtnumint" placeholder="0" default="0" value="<?php  echo $destiny->row()->numint; ?>">
                              </div>
                           </div>
                           <div class="col-xs-12 col-sm-4">
                              <div class="form-group">
                                 <label for="txtnumext"><li class="fa fa-exclamation-circle color-exclamation-sign-a"></li>&nbsp;Número exterior</span></label>
                                 <input class="form-control" type="text" id="txtnumext" name="txtnumext" placeholder="0" default="0" value="<?php  echo $destiny->row()->numext; ?>">
                              </div>
                           </div>
                           <div class="col-xs-12 col-sm-4">
                              <div class="form-group">
                                 <label for="txtpostalcode">Código Postal</label>
                                 <input class="form-control" type="text" maxlength="5" id="txtpostalcode" name="txtpostalcode" placeholder="CP" value="<?php echo $destiny->row()->postal_code; ?>">
                              </div>
                           </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                           <div class="form-group">
                              <label for="txtlocal">Localidad o Colonia</label>
                              <input class="form-control" type="text" id="txtlocal" name="txtlocal" placeholder="localidad o colonia" value="<?php echo $destiny->row()->local; ?>">
                           </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                           <div class="form-group">
                              <label for="txtmuni">Municipio</label>
                              <input class="form-control" type="text" id="txtmuni" name="txtmuni" placeholder="municipio" value="<?php echo $destiny->row()->muni; ?>">
                           </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                           <div class="form-group">
                              <label for="txtstate">Entidad federativa</label>
                              <?php echo form_dropdown('txtstate', $states, set_value('txtstate', $destiny->row()->state), 'class="form-control select2"'); ?>
                           </div>
                        </div>
                     </div>
                     <div class="box-footer">
                        <p class="help-block">
                           <li class="fa fa-exclamation-circle color-exclamation-sign-a"></li> Si no cuenta con número de vivienda (S/N), escribe un cero (<strong>0</strong>).
                        </p>
                     </div>
                  </div>
               </div>
               <div class="col-xs-12 col-md-4 pull-right">
                  <div class="col-xs-6 col-sm-12 col-md-6">
                     <div class="form-group">
                        <?php echo anchor('logistic/destiny', 'Cancelar <samp class="glyphicon glyphicon-remove"></samp>', 'type="button" class="btn btn-sm btn-default btn-block"'); ?>
                     </div>
                  </div>
                  <div class="col-xs-6 col-sm-12 col-md-6">
                     <div class="form-group">
                        <button type="button submit" class="btn btn-sm btn-success btn-block" name="btnsend">Guardar <samp class="glyphicon glyphicon-floppy-disk"></samp></button>
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
