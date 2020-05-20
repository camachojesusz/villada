<?php $this->load->view('header'); ?>
<section class="seccion">
   <div class="col-xs-1"></div>
   <div class="col-xs-10">
      <section class="content-header">
         <h1>Salidas <small>Nueva Salida</small></h1>
         <ol class="breadcrumb">
            <li><?php echo anchor('logistic/logistic_index', '<span class="glyphicon glyphicon-home"></span> Inicio</a>','title="Inicio Logística"'); ?></li>
            <li><?php echo anchor('logistic/departure', 'Salidas',''); ?></li>
            <li class="active">Nueva Salida</li>
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
         <?php echo form_open('logistic/departure/set_info', ['autocomplete' => 'off']); ?>
         <div class="row">
            <div class="col-xs-12">
               <div class="box box-solid box-success">
                  <div class="box-header with-border">
                     <h3 class="box-title">Salida</h3>
                     <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Minimizar"><i class="fa fa-minus"></i></button>
                     </div>
                  </div>
                  <div class="box-body row">
                     <div class="col-xs-12 col-md-4">
                        <div class="form-group">
                           <label for=""><li class="fa fa-exclamation-circle color-exclamation-sign-a"></li>&nbsp;<sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Fecha estimada</label>
                           <input class="form-control" type="hidden" id="txtsender" name="txtsender" value="0">
                           <input class="form-control" type="date" id="txtplan_date" name="txtplan_date" title="Elige una fecha" value="<?php echo (isset($auto_complete['plan_date'])) ? $auto_complete['plan_date'] : '' ; ?>">
                        </div>
                     </div>
                     <div class="col-xs-12 col-md-4">
                        <div class="form-group">
                           <label for=""><sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Destino</label><br>
                           <?php echo form_dropdown('txtdestiny_id', $dy, set_value('txtdestiny_id', '-1'), 'class="form-control select2" weight="100%"'); ?>
                        </div>
                     </div>
                     <div class="col-xs-12 col-md-4">
                        <div class="form-group">
                           <label for=""><sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Vehículo</label><br>
                           <?php echo form_dropdown('txtvehicle_id', $ve, set_value('txtvehicle_id', '-1'), 'class="form-control select2" weight="100%"'); ?>
                        </div>
                     </div>
                     <div class="col-xs-12 col-md-6">
                        <label for=""><li class="fa fa-exclamation-circle color-exclamation-sign-b"></li>&nbsp;<sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Conductor</label>
                        <div class="input-group">
                           <label for="txt_ctrl_driver_a" class="input-group-addon" title="Conductor">
                              <input type="radio" id="txt_ctrl_driver_a" name="txt_ctrl_driver" value="0" required checked <?php if (isset($auto_complete['driver_type']) && $auto_complete['driver_type'] === '0') { echo "checked"; }?>>
                              <i class="fa fa-user"></i>
                           </label>
                           <?php echo form_dropdown('txtdriver_id', $dr, set_value('txtdriver_id', '-1'), 'id="txtdriver_id" class="form-control select2" weight="100%" '.((isset($auto_complete['driver_type']) && $auto_complete['driver_type'] === '1') ? ' disabled' : '')); ?>
                        </div>
                     </div>
                     <div class="col-xs-12 col-md-6">
                        <label for="">&nbsp;</label>
                        <div class="input-group">
                           <label for="txt_ctrl_driver_b" class="input-group-addon" title="Candidato a chofer">
                              <input type="radio" id="txt_ctrl_driver_b" name="txt_ctrl_driver" value="1" required <?php if (isset($auto_complete['driver_type']) && $auto_complete['driver_type'] === '1') { echo "checked"; $_activate = ''; } else { $_activate = ' disabled'; } ?>>
                              <i class="fa fa-user"></i>
                           </label>
                           <?php echo form_dropdown('txtdriver_emp_id', $dr_employ, set_value('txtdriver_emp_id', '-1'), 'id="txtdriver_emp_id" class="form-control select2" weight="100%"'.$_activate); ?>
                        </div>
                     </div>
                  </div>
                  <div class="box-footer">
                     <p class="help-block">
                        <sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Campos obligatorios
                        <br>
                        <li class="fa fa-exclamation-circle color-exclamation-sign-a"></li>&nbsp;Seleccione una fecha estimada de llegada
                        <br>
                        <li class="fa fa-exclamation-circle color-exclamation-sign-b"></li>&nbsp;Seleccione un tipo de conductor y posteriormente el conductor asignado
                     </p>
                  </div>
               </div>
            </div>
            <div class="col-xs-12 col-md-4 pull-right">
               <div class="col-xs-6 col-sm-12 col-md-6">
                  <div class="form-group">
                     <?php echo anchor('logistic/departure', 'Cancelar <samp class="glyphicon glyphicon-remove"></samp>', 'type="button" class="btn btn-sm btn-default btn-block"'); ?>
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
<?php $this->load->view('footer'); ?>
<script src="<?php echo base_url(); ?>assets/complements/js/departure_driver.js"></script>
