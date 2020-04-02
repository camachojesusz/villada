<?php //$this->load->view('logistic/header'); ?>
<?php $this->load->view('header'); ?>
   <section class="seccion">
      <div class="col-xs-1"></div>
      <div class="col-xs-10">
         <section class="content-header">
            <h1>Conductores</h1>
            <ol class="breadcrumb">
               <li><?php echo anchor('logistic/logistic_index', '<span class="glyphicon glyphicon-home"></span> Inicio</a>','title="Inicio Logística"'); ?></li>
               <li><?php echo anchor('logistic/driver', 'Conductores',''); ?></li>
               <li class="active">Editar Conductor</li>
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
            <?php echo form_open('logistic/driver/set_info', ['autocomplete' => 'off']); ?>
            <div class="row">
               <div class="col-xs-12">
                  <div class="box box-solid box-success">
                     <div class="box-header with-border">
                        <h3 class="box-title">Información de Licencia</h3>
                        <div class="box-tools">
                           <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Minimizar"><i class="fa fa-minus"></i></button>
                        </div>
                     </div>
                     <div class="box-body row">
                        <div class="col-xs-12 col-md-4">
                           <label for="txtsheetlicence"><sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Folio de licencia</label>
                           <div class="input-group">
                              <div class="input-group-addon">
                                 <i class="fa fa-pencil"></i>
                              </div>
                              <input required class="form-control" type="text" id="txtsheetlicence" name="txtsheetlicence" placeholder="folio de licencia" value="<?php echo $drive->row()->sheet_licence; ?>">
                           </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                           <label for="txttypelicence"><sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Tipo de licencia</label>
                           <div class="input-group">
                              <div class="input-group-addon">
                                 <i class="fa fa-pencil"></i>
                              </div>
                              <input required class="form-control" type="text" id="txttypelicence" name="txttypelicence" placeholder="licencia tipo" value="<?php echo $drive->row()->type_licence; ?>">
                           </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                           <label for="txtexperieciedrive">Experiencia de manejo (años)</label>
                           <div class="input-group">
                              <div class="input-group-addon">
                                 <i class="fa fa-calendar-check-o"></i>
                              </div>
                              <input class="form-control" type="text" id="txtexperieciedrive" name="txtexperieciedrive" placeholder="experiencia de manejo (años)" value="<?php echo $drive->row()->experiencie_drive; ?>">
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
               <div class="col-xs-12">
                  <div class="box box-solid box-success">
                     <div class="box-header with-border">
                        <h3 class="box-title">Datos del Conductor</h3>
                        <div class="box-tools">
                           <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Minimizar"><i class="fa fa-minus"></i></button>
                        </div>
                     </div>
                     <div class="box-body row">
                        <div class="col-xs-12 col-md-4">
                           <div class="form-group">
                              <input type="hidden" name="txtsender" value="1">
                              <input type="hidden" name="txtdriver" value="<?php echo $drive->row()->driver_id; ?>">
                              <label for="txtname"><sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Nombre</label>
                              <input class="form-control" type="text" id="txtname" name="txtname" placeholder="nombre" value="<?php echo $drive->row()->name; ?>" required="">
                           </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                           <div class="form-group">
                              <label for="txtap1"><sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Apellido paterno</label>
                              <input class="form-control" type="text" id="txtap1" name="txtap1" placeholder="apellido paterno" value="<?php echo $drive->row()->ap1; ?>" required="">
                           </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                           <div class="form-group">
                              <label for="txtap2"><sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Apellido materno</label>
                              <input class="form-control" type="text" id="txtap2" name="txtap2" placeholder="apellido materno" value="<?php echo $drive->row()->ap2; ?>" required="">
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
               <div class="col-xs-12">
                  <div class="box box-solid box-success">
                     <div class="box-header with-border">
                        <h3 class="box-title">Contacto</h3>
                        <div class="box-tools">
                           <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Minimizar"><i class="fa fa-minus"></i></button>
                        </div>
                     </div>
                     <div class="box-body row">
                        <div class="col-xs-12 col-md-4">
                           <div class="input-group">
                              <div class="input-group-addon">
                                 <sup><li class="fa fa-asterisk color-exclamation-sign-b"></li></sup>&nbsp;<i class="fa fa-phone"></i>
                              </div>
                              <input class="form-control" type="tel" maxlength="10" id="txtphone" name="txtphone" placeholder="teléfono" value="<?php echo $drive->row()->phone; ?>">
                           </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                           <div class="input-group">
                              <div class="input-group-addon">
                                 <sup><li class="fa fa-asterisk color-exclamation-sign-b"></li></sup>&nbsp;<i class="fa fa-mobile"></i>
                              </div>
                              <input class="form-control" type="tel" maxlength="10" id="txtcel" name="txtcel" placeholder="celular" value="<?php echo $drive->row()->mobile_phone; ?>">
                           </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                           <div class="input-group">
                              <div class="input-group-addon">
                                 <i class="fa fa-envelope"></i>
                              </div>
                              <input class="form-control" type="email" id="txtemail" name="txtemail" placeholder="ejemplo@ejemplo.com" value="<?php echo $drive->row()->email; ?>">
                           </div>
                        </div>
                     </div>
                     <div class="box-footer">
                        <p class="help-block">
                           <sup><li class="fa fa-asterisk color-exclamation-sign-b"></li></sup>Campos altamente recomendados
                        </p>
                     </div>
                  </div>
               </div>
               <div class="col-xs-12">
                  <div class="box box-solid box-success">
                     <div class="box-header with-border">
                        <h3 class="box-title">Domicilio</h3>
                        <div class="box-tools">
                           <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Minimizar"><i class="fa fa-minus"></i></button>
                        </div>
                     </div>
                     <div class="box-body row">
                        <div class="col-xs-12 col-md-4">
                           <div class="form-group">
                              <label for="txtstreet">Calle</label>
                              <input class="form-control" type="text" id="txtstreet" name="txtstreet" placeholder="calle" value="<?php echo $drive->row()->street; ?>">
                           </div>
                        </div>
                        <div class="col-xs-12 col-md-8">
                           <div class="col-xs-12 col-sm-4">
                              <div class="form-group">
                                 <label for="txtnumint"><li class="fa fa-exclamation-circle color-exclamation-sign-a"></li >&nbsp;Número interior</label>
                                 <input class="form-control" type="text" id="txtnumint" name="txtnumint" placeholder="0" default="0" value="<?php echo $drive->row()->numint; ?>">
                              </div>
                           </div>
                           <div class="col-xs-12 col-sm-4">
                              <div class="form-group">
                                 <label for="txtnumext"><li class="fa fa-exclamation-circle color-exclamation-sign-a"></li>&nbsp;Número exterior</span></label>
                                 <input class="form-control" type="text" id="txtnumext" name="txtnumext" placeholder="0" default="0" value="<?php echo $drive->row()->numext; ?>">
                              </div>
                           </div>
                           <div class="col-xs-12 col-sm-4">
                              <div class="form-group">
                                 <label for="txtpostalcode">Código Postal</label>
                                 <input class="form-control" type="text" maxlength="5" id="txtpostalcode" name="txtpostalcode" placeholder="CP" value="<?php echo $drive->row()->postal_code; ?>">
                              </div>
                           </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                           <div class="form-group">
                              <label for="txtlocal">Localidad o Colonia</label>
                              <input class="form-control" type="text" id="txtlocal" name="txtlocal" placeholder="localidad o colonia" value="<?php echo $drive->row()->local; ?>">
                           </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                           <div class="form-group">
                              <label for="txtmuni">Municipio</label>
                              <input class="form-control" type="text" id="txtmuni" name="txtmuni" placeholder="municipio" value="<?php echo $drive->row()->muni; ?>">
                           </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                           <div class="form-group">
                              <label for="txtstate">Entidad federativa</label>
                              <?php echo form_dropdown('txtstate', $states, set_value('txtstate',  $drive->row()->state), 'class="form-control select2"'); ?>
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
                        <?php echo anchor('logistic/driver', 'Cancelar <samp class="glyphicon glyphicon-remove"></samp>', 'type="button" class="btn btn-sm btn-default btn-block"'); ?>
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
