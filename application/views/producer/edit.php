<?php $this->load->view('header');?>
<section class="seccion">
   <div class="col-xs-1"></div>
   <div class="col-xs-10">
      <section class="content-header">
         <h1>Proveedores <small><strong>Editar proveedor</strong></small></h1>
         <ol class="breadcrumb">
            <li><?php echo anchor('login/in_sess','<span class="glyphicon glyphicon-home"></span> Inicio', ''); ?>
            <li><?php echo anchor('producer','Proveedores', ''); ?></li>
            <li class="active">Editar</li>
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
    <?php echo form_open('producer/set_info', ['autocomplete' => 'off']); ?>
        <div class="row">
          <div class="col-xs-12">
            <div class="box box-solid box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Datos del proveedor</h3>
                <div class="box-tools">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Minimizar"><i class="fa fa-minus"></i></button>
                </div>
              </div>
              <div class="box-body row">
                <div class="col-xs-12 col-md-6">
                  <input type="hidden" name="txtsender" value="1">
                  <input type="hidden" name="txtstatus" value="1">
                  <input type="hidden" name="txtnoctrl" value="<?php echo $producer_info->row()->noctrl_producer; ?>">
                  <input type="hidden" name="txtideditable" value="<?php echo $producer_info->row()->noctrl_e_producer; ?>">
                  <label for=""><li class="fa fa-exclamation-circle color-exclamation-sign-a"></li>&nbsp;<sup><li class="fa fa-asterisk color-asterisk-required"></li></sup> Identificación</label>&nbsp;<a target="_blank" href="https://www.gob.mx/curp/">consultar CURP</a>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <label for="txtdocument0">
                        <input type="radio" name="txtdocument" id="txtdocument0" value="0" required <?php echo ($producer_info->row()->document_producer === '0') ? 'checked' : '' ; ?>> CURP
                      </label>
                        &nbsp;
                        <label for="txtdocument1">
                          <input type="radio" name="txtdocument" id="txtdocument1" value="1" required <?php echo ($producer_info->row()->document_producer === '1') ? 'checked' : '' ; ?>> RFC
                        </label>
                    </div>
                    <input type="text" maxlength="18" name="txtdescribedocument" id="txtdescribedocument" required class="form-control" placeholder="escribe la CURP o RFC" value="<?php echo $producer_info->row()->describedocument_producer; ?>">
                  </div>
                </div>
                <div class="col-xs-12 col-md-6">
                  <div class="form-group">
                    <label for="txtdescribe"><li class="fa fa-exclamation-circle color-exclamation-sign-c"></li>&nbsp;<sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Proveedor o empresa</label>
                    <input class="form-control" type="text" id="txtdescribe" required name="txtdescribe" placeholder="proveedor o empresa" value="<?php echo $producer_info->row()->describe_producer;?>">
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <p class="help-block">
                  <sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Campos obligatorios
                  <br>
                  <li class="fa fa-exclamation-circle color-exclamation-sign-a"></li> Campo de identificación, elige sólo un dato y escríbelo según sea el caso
                  <br>
                  <li class="fa fa-exclamation-circle color-exclamation-sign-c"></li> Escribe el nombre de la empresa (Ej. Chiles S.A.) o un nombre de referencia del productor (Ej. José Pérez)
                </p>
              </div>
            </div>
          </div>

          <div class="col-xs-12">
            <div class="box box-solid box-success">
              <div class="box-header">
                <h3 class="box-title">Contacto</h3>
                <div class="box-tools">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Minimizar"><i class="fa fa-minus"></i></button>
                </div>
              </div>
              <div class="box-body row">
                <div class="col-xs-12 col-sm-4">
                  <div class="form-group">
                    <label for="txtname"><li class="fa fa-exclamation-circle color-exclamation-sign-d"></li>&nbsp;<sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Nombre (s)</label>
                    <input class="form-control" type="text" id="txtname" name="txtname" placeholder="nombre (s)" required value="<?php echo $producer_info->row()->name_producer;?>">
                  </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                  <div class="form-group">
                    <label for="txtap1"><li class="fa fa-exclamation-circle color-exclamation-sign-d"></li>&nbsp;<sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Apellido paterno</label>
                    <input class="form-control" type="text" id="txtap1"name="txtap1" placeholder="apellido paterno" required value="<?php echo $producer_info->row()->ap1_producer;?>">
                  </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                  <div class="form-group">
                    <label for="txtap2"><li class="fa fa-exclamation-circle color-exclamation-sign-d"></li>&nbsp;Apellido materno</label>
                    <input class="form-control" type="text" id="txtap2" name="txtap2" placeholder="apellido materno" value="<?php echo $producer_info->row()->ap2_producer;?>">
                  </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                  <br>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-phone"></i>
                    </div>
                    <input class="form-control" type="tel" maxlength="10" id="txtphone" name="txtphone" placeholder="teléfono" value="<?php echo $producer_info->row()->phone_producer;?>">
                  </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                  <br>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-mobile"></i>
                    </div>
                    <input class="form-control" type="tel" maxlength="10" id="txtcel" name="txtcel" placeholder="celular" value="<?php echo $producer_info->row()->cel_producer;?>">
                  </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                  <br>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-envelope"></i>
                    </div>
                    <input class="form-control" type="email" id="txtemail" name="txtemail" placeholder="ejemplo@ejemplo.com" vvalue="<?php echo $producer_info->row()->email_producer;?>">
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <p class="help-block">
                  <sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Campos obligatorios
                  <br>
                  <li class="fa fa-exclamation-circle color-exclamation-sign-d"></li> Escribe el nombre completo de la persona que fungirá como contacto con la empresa o el nombre completo del productor
                </p>
              </div>
            </div>
          </div>

          <div class="col-xs-12">

            <div class="box box-solid box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Dirección</h3>
                <div class="box-tools">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Minimizar"><i class="fa fa-minus"></i></button>
                </div>
              </div>
              <div class="box-body row">
                <div class="col-xs-12 col-sm-4">
                  <div class="form-group">
                    <label for="txtstreet">Calle</label>
                    <input class="form-control" type="text" id="txtstreet" name="txtstreet" placeholder="calle" value="<?php echo $producer_info->row()->street_producer;?>">
                  </div>
                </div>
                <div class="col-xs-12 col-sm-8">
                  <div class="col-xs-12 col-sm-4">
                    <div class="form-group">
                      <label for="txtnumint"><span class="glyphicon glyphicon-exclamation-sign color-exclamation-sign-b"></span> Número interior</label>
                      <input class="form-control" type="text" min="0" id="txtnumint" name="txtnumint" placeholder="0" value="<?php echo $producer_info->row()->numint_producer;?>">
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-4">
                    <div class="form-group">
                      <label for="txtnumext"><span class="glyphicon glyphicon-exclamation-sign color-exclamation-sign-b"></span> Número exterior</label>
                      <input class="form-control" type="text" min="0" id="txtnumext" name="txtnumext" placeholder="0" value="<?php echo $producer_info->row()->numext_producer;?>">
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-4">
                    <div class="form-group">
                      <label for="txtpostalcode">Código Postal</label>
                      <input class="form-control" type="text" maxlength="5" id="txtpostalcode" name="txtpostalcode" placeholder="CP" value="<?php echo $producer_info->row()->postalcode_producer;?>">
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                  <div class="form-group">
                    <label for="txtlocal">Localidad o Colonia</label>
                    <input class="form-control" type="text" id="txtlocal" name="txtlocal" placeholder="localidad o colonia" value="<?php echo $producer_info->row()->local_producer;?>">
                  </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                  <div class="form-group">
                    <label for="txtmuni">Municipio</label>
                    <input class="form-control" type="text" id="txtmuni" name="txtmuni" placeholder="municipio" value="<?php echo $producer_info->row()->muni_producer;?>">
                  </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                  <div class="form-group">
                    <label for="txtstate">Entidad federativa</label>
                    <?php echo form_dropdown('txtstate', $states, set_value('txtstate', $producer_info->row()->state_producer), 'class="form-control select2" required'); ?>
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <p class="help-block">
                  <span class="glyphicon glyphicon-exclamation-sign color-exclamation-sign-b"></span> Si no cuenta con número de vivienda, escribe un cero (<strong>0</strong>).
                </p>
              </div>
            </div>
          </div>

          <div class="col-xs-12 col-md-4 pull-right">
            <div class="col-xs-6 col-sm-12 col-md-6">
              <div class="form-group">
                <?php echo anchor('producer', 'Cancelar <samp class="glyphicon glyphicon-remove"></samp>', 'type="button" class="btn btn-sm btn-default btn-block"'); ?>
              </div>
            </div>
            <div class="col-xs-6 col-sm-12 col-md-6">
              <div class="form-group">
                <button type="button submit" class="btn btn-success btn-block btn-sm" name="btnsend">Guardar <samp class="glyphicon glyphicon-floppy-disk"></samp></button>
              </div>
            </div>
          </div>
        </div>
      <?php
        echo form_close();
      ?>
    </div>
  </div>
  <div class="col-xs-1"></div>
</section>
<?php $this->load->view('footer');?>
