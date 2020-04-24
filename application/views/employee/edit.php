<?php $this->load->view('header');?>
<section class="seccion">
   <div class="col-xs-1"></div>
   <div class="col-xs-10">
      <section class="content-header">
         <h1>Empleados <small><strong>Editar empleado</strong></small></h1>
         <ol class="breadcrumb">
            <li><?php echo anchor('login/in_sess', '<span class="glyphicon glyphicon-home"></span> Inicio', ''); ?></li>
            <li><?php echo anchor('employee', 'Empleados', ''); ?></li>
            <li class="acitve">Editar empleado</li>
         </ol>
      </section>
      <hr>
      <?php if (isset($success_curp)): ?>
         <div class="col-xs-12">
            <div class="panel panel-success">
               <div class="panel-heading">
                  <h3 class="panel-title">¡Correcto!</h3>
               </div>
               <div class="panel-body">
                  Se ha editado un empleado
               </div>
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
         <?php echo form_open('employee/set_info', ['autocomplete' => 'off']); ?>
         <div class="row">
            <div class="col-xs-12">
               <div class="box box-solid box-success">
                  <div class="box-header with-border">
                     <h3 class="box-title">Datos de usuario - Área de trabajo</h3>
                     <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Minimizar"><i class="fa fa-minus"></i></button>
                     </div>
                  </div>
                  <div class="box-body row">
                     <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="form-group">
                           <label for="txtusername"><sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Usuario</label>
                           <input class="form-control" type="text" id="txtusername" name="txtusername" placeholder="usuario" value="<?php echo $allemployee->row()->username_users;?>">
                        </div>
                     </div>
                     <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="form-group">
                           <label for="txtpuserpass1"><li class="fa fa-exclamation-circle color-exclamation-sign-a"></li>&nbsp;<sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Contraseña</label>
                           <input class="form-control" type="password" minlength="8" maxlength="32" id="txtpuserpass1" name="txtpuserpass1" placeholder="escribe una contraseña" value="<?php echo $allemployee->row()->userpass_users; ?>" required="">
                        </div>
                     </div>
                     <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="form-group">
                           <label for="txtpuserpass2"><li class="fa fa-exclamation-circle color-exclamation-sign-a"></li>&nbsp;<sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Confirma la contraseña</label>
                           <input class="form-control" type="password" minlength="8" maxlength="32" id="txtpuserpass2" name="txtpuserpass2" placeholder=" escribe otra vez la contraseña" value="<?php echo $allemployee->row()->userpass_users; ?>" required="">
                        </div>
                     </div>
                     <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="form-group">
                           <label for="txttype"><li class="fa fa-exclamation-circle color-exclamation-sign-b"></li>&nbsp;<sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Tipo de empleado</label>
                           <?php echo form_dropdown('txtprofile', $info_profile, set_value('txtprofile', $allemployee->row()->profile_users), 'class="form-control select2" required'); ?>
                        </div>
                     </div>
                  </div>
                  <div class="box-footer">
                     <p class="help-block">
                        <sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Campos obligatorios
                        <br>
                        <li class="fa fa-exclamation-circle color-exclamation-sign-a"></li>
                        La contraseña debe contener entre 8 y 32 caracteres
                        <br>
                        <li class="fa fa-exclamation-circle color-exclamation-sign-b"></li>
                        Elige la o las responsabilidades del empleado
                     </p>
                  </div>
               </div>
            </div>
            <div class="col-xs-12">
               <div class="box box-solid box-success">
                  <div class="box-header with-border">
                     <h3 class="box-title">Datos Personales</h3>
                     <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Minimizar"><i class="fa fa-minus"></i></button>
                     </div>
                  </div>
                  <div class="box-body row">
                     <div class="col-xs-12 col-md-6">
                        <div  hidden class="form-group">
                           <input type="hidden" name="txtsender" value="1" required>
                           <input type="hidden" name="txtideditable" value="<?php echo $allemployee->row()->id_employee;?>" required>
                        </div>
                        <div class="form-group">
                           <label for="txtcurp"><sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>CURP</label>&nbsp;<a target="_blank" href="https://www.gob.mx/curp/">consultar CURP</a>
                           <input class="form-control" type="text" maxlength="18" id="txtcurp" name="txtcurp" placeholder="CURP" value="<?php echo $allemployee->row()->curp_employee;?>">
                        </div>
                     </div>
                     <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                           <label for="txtname"><sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Nombre (s)</label>
                           <input class="form-control" type="text" id="txtname" name="txtname" placeholder="nombre (s)" value="<?php echo $allemployee->row()->name_employee;?>" required="">
                        </div>
                     </div>
                     <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                           <label for="txtap1"><sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Apellido paterno</label>
                           <input class="form-control" type="text" id="txtap1"name="txtap1" placeholder="apellido paterno" value="<?php echo $allemployee->row()->ap1_employee;?>" required="">
                        </div>
                     </div>
                     <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                           <label for="txtap2"><sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Apellido materno</label>
                           <input class="form-control" type="text" id="txtap2" name="txtap2" placeholder="apellido materno" value="<?php echo $allemployee->row()->ap2_employee;?>" required="">
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
                     <h3 class="box-title">Domicilio</h3>
                     <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Minimizar"><i class="fa fa-minus"></i></button>
                     </div>
                  </div>
                  <div class="box-body row">
                     <div class="col-xs-12 col-md-4">
                        <div class="form-group">
                           <label for="txtstreet">Calle</label>
                           <input class="form-control" type="text" id="txtstreet" name="txtstreet" placeholder="calle" value="<?php echo $allemployee->row()->street_employee;?>">
                        </div>
                     </div>
                     <div class="col-xs-12 col-md-8">
                        <div class="col-xs-12 col-sm-4">
                           <div class="form-group">
                              <label for="txtnumint"><li class="fa fa-exclamation-circle color-exclamation-sign-a"></li>&nbsp;Número interior</label>
                              <input class="form-control" type="text" id="txtnumint" name="txtnumint" placeholder="0" default="0" value="<?php echo $allemployee->row()->numint_employee;?>">
                           </div>
                        </div>
                        <div class="col-xs-12 col-sm-4">
                           <div class="form-group">
                              <label for="txtnumext"><li class="fa fa-exclamation-circle color-exclamation-sign-a"></li></span>&nbsp;Número exterior</label>
                              <input class="form-control" type="text" id="txtnumext" name="txtnumext" placeholder="0" default="0" value="<?php echo $allemployee->row()->numext_employee;?>">
                           </div>
                        </div>
                        <div class="col-xs-12 col-sm-4">
                           <div class="form-group">
                              <label for="txtpostalcode">Código Postal</label>
                              <input class="form-control" type="text" maxlength="5" id="txtpostalcode" name="txtpostalcode" placeholder="CP" value="<?php echo $allemployee->row()->postalcode_employee;?>">
                           </div>
                        </div>
                     </div>
                     <div class="col-xs-12 col-md-4">
                        <div class="form-group">
                           <label for="txtlocal">Localidad o Colonia</label>
                           <input class="form-control" type="text" id="txtlocal" name="txtlocal" placeholder="localidad o colonia" value="<?php echo $allemployee->row()->local_employee;?>">
                        </div>
                     </div>
                     <div class="col-xs-12 col-md-4">
                        <div class="form-group">
                           <label for="txtmuni">Municipio</label>
                           <input class="form-control" type="text" id="txtmuni" name="txtmuni" placeholder="municipio" value="<?php echo $allemployee->row()->muni_employee;?>">
                        </div>
                     </div>
                     <div class="col-xs-12 col-md-4">
                        <div class="form-group">
                           <label for="txtstate">Entidad federativa</label>
                           <?php echo form_dropdown('txtstate', $states, set_value('txtstate', $allemployee->row()->state_employee), 'class="form-control select2" required'); ?>
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
            <div class="col-xs-12">
               <div class="box box-solid box-success">
                  <div class="box-header with-border">
                     <h3 class="box-title">Información complementaria</h3>
                     <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Minimizar"><i class="fa fa-minus"></i></button>
                     </div>
                  </div>
                  <div class="box-body row">
                     <div class="col-xs-12 col-md-4">
                        <div class="box box-success">
                           <div class="box-header with-border">
                              <h3 class="box-title">Contacto</h3>
                              <div class="box-tools">
                                 <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Minimizar"><i class="fa fa-minus"></i></button>
                              </div>
                           </div>
                           <div class="box-body row">
                              <div class="col-xs-12 ">
                                 <br>
                                 <div class="input-group">
                                    <div class="input-group-addon">
                                       <i class="fa fa-phone"></i>
                                    </div>
                                    <input class="form-control" type="tel" maxlength="10" id="txtphone" name="txtphone" placeholder="teléfono" value="<?php echo $allemployee->row()->phone_employee;?>">
                                 </div>
                              </div>
                              <div class="col-xs-12 ">
                                 <br>
                                 <div class="input-group">
                                    <div class="input-group-addon">
                                       <i class="fa fa-mobile"></i>
                                    </div>
                                    <input class="form-control" type="tel" maxlength="10" id="txtcel" name="txtcel" placeholder="celular" value="<?php echo $allemployee->row()->cel_employee;?>">
                                 </div>
                              </div>
                              <div class="col-xs-12 ">
                                 <br>
                                 <div class="input-group">
                                    <div class="input-group-addon">
                                       <i class="fa fa-envelope"></i>
                                    </div>
                                    <input class="form-control" type="email" id="txtemail" name="txtemail" placeholder="ejemplo@ejemplo.com" value="<?php echo $allemployee->row()->email_employee;?>">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-xs-12 col-md-8">
                        <div class="box box-success">
                           <div class="box-header with-border">
                              <h3 class="box-title">Candidato a chofer</h3>
                              <div class="box-tools pull-right">
                                 <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Minimizar"><i class="fa fa-minus"></i></button>
                              </div>
                           </div>
                           <div class="box-body row">
                              <div class="col-xs-12 col-md-4">
                                 <div class="form-group">
                                    <label for="txtdrivercandidate"><sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>¿Cuenta con licencia de conducir?
                                       <br>
                                       <label for="txtdrivercandidate_a">
                                          <input type="radio" id="txtdrivercandidate_a" required name="txtdrivercandidate" value="1" <?php if(!$comp_document = strcmp("1", $a = $allemployee->row()->drivercandidate_employee)) { echo "checked"; } ?>>
                                          Si <i class="fa fa-thumbs-o-up color-exclamation-sign-a"></i>
                                       </label>
                                       <br>
                                       <label for="txtdrivercandidate_b">
                                          <input type="radio" id="txtdrivercandidate_b" required name="txtdrivercandidate" value="0" <?php if(!$comp_document = strcmp("0", $a = $allemployee->row()->drivercandidate_employee)) { echo "checked"; } ?>>
                                          No <i class="fa fa-thumbs-o-down"></i>
                                       </label>
                                    </div>
                                 </div>
                                 <div class="col-xs-12 col-md-8">
                                    <label for="txttypelicence">Tipo de licencia</label>
                                    <div class="input-group">
                                       <div class="input-group-addon">
                                          <i class="fa fa-pencil"></i>
                                       </div>
                                       <input class="form-control" type="text" id="txttypelicence" name="txttypelicence" placeholder="licencia tipo" value="<?php echo $allemployee->row()->typelicence_employee; ?>">
                                    </div>
                                    <label for="txtsheetlicence">Folio de licencia</label>
                                    <div class="input-group">
                                       <div class="input-group-addon">
                                          <i class="fa fa-pencil"></i>
                                       </div>
                                       <input class="form-control" type="text" id="txtsheetlicence" name="txtsheetlicence" placeholder="folio de licencia" value="<?php echo $allemployee->row()->sheetlicence_employee; ?>">
                                    </div>
                                    <label for="txtexperieciedrive">Experiencia (años)</label>
                                    <div class="input-group">
                                       <div class="input-group-addon">
                                          <i class="fa fa-calendar-check-o"></i>
                                       </div>
                                       <input class="form-control" type="text" id="txtexperieciedrive" name="txtexperieciedrive" placeholder="experiencia de manejo (años)" value="<?php echo $allemployee->row()->experieciedrive_employee ?>">
                                    </div>
                                 </div>
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
               <div class="col-xs-12 col-md-4 pull-right">
                  <div class="col-xs-6 col-sm-12 col-md-6">
                     <div class="form-group">
                        <!-- <button type="reset" class="btn btn-sm btn-default btn-block">Cancelar <samp class="glyphicon glyphicon-remove"></samp></button> -->
                        <?php echo anchor('employee', 'Cancelar <samp class="glyphicon glyphicon-remove"></samp>', 'type="button" class="btn btn-sm btn-default btn-block"'); ?>
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
<script src="<?php echo base_url(); ?>assets/complements/js/employee.js"></script>
