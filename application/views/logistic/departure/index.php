<?php $this->load->view('header'); ?>
<section class="section">
   <div class="col-xs-1"></div>
   <div class="col-xs-10">
      <section class="content-header">
         <h1>Salidas</h1>
         <ol class="breadcrumb">
            <li><?php echo anchor('logistic/logistic_index', '<span class="glyphicon glyphicon-home"></span> Inicio</a>','title="Inicio Logística"'); ?></li>
            <li class="active">Salidas</li>
         </ol>
      </section>
      <hr>
       <div class="modal fame" id="modal_new">
          <div class="modal-dialog">
             <div class="modal-content">
                <?php echo form_open('logistic/departure/set_info', ['autocomplete' => 'off']); ?>
                <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal">
                      <span aria-hidden="true">&times;</span>
                   </button>
                  <h3 class="modal-title">Nueva <small class="lead"> Salida</small></h3>
                </div>
                <div class="modal-body row">
                   <div class="col-xs-12">
                      <div class="form-group">
                         <input class="form-control" type="hidden" id="txtsender" name="txtsender" value="0">
                      </div>
                   </div>
                   <div class="col-xs-12">
                      <div class="form-group">
                         <label for=""><sup><li class="fa fa-asterisk color-asterisk-required"></li></sup> Fecha de salida </label>
                         <!-- <input required class="form-control" type="text" id="txtdescription_vt" name="txtdescription_vt" placeholder="tipo de vehículo" value="<?php //if (isset($auto_complete) && ! empty($auto_complete)) { echo $auto_complete['description_vt']; } ?>"> -->
                      </div>
                   </div>
                   <div class="col-xs-12">
                      <div class="form-group">
                        <label for=""><li class="fa fa-exclamation-circle color-exclamation-sign-b"></li>&nbsp;<sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Destino</label><br>
                        <?php echo form_dropdown('txtdestiny_id', $vt, set_value('txtdestiny_id', '-1'), 'class="form-control select2" weight="100%"'); ?>
                     </div>
                  </div>
                  <div class="col-xs-12">
                     <div class="form-group">
                        <label for=""><li class="fa fa-exclamation-circle color-exclamation-sign-b"></li>&nbsp;<sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Vehículo</label><br>
                        <?php echo form_dropdown('txtvehicle_id', $vt, set_value('txtvehicle_id', '-1'), 'class="form-control select2" weight="100%"'); ?>
                     </div>
                  </div>
                  <div class="col-xs-12">
                    <div class="form-group">
                       <label for=""><li class="fa fa-exclamation-circle color-exclamation-sign-b"></li>&nbsp;<sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Conductor</label><br>
                       <?php echo form_dropdown('txtdriver_id', $vt, set_value('txtdriver_id', '-1'), 'class="form-control select2" weight="100%"'); ?>
                    </div>
                 </div>
                 <div class="col-xs-12">
                   <div class="form-group">
                      <label for=""><sup><li class="fa fa-asterisk color-asterisk-required"></li></sup>Día</label>
                      <input required class="form-control" type="text" id="txtday" name="txtday" placeholder="día" value="<?php if (isset($auto_complete) && ! empty($auto_complete)) { echo $auto_complete['day']; } ?>">
                   </div>
                </div>
                <div class="col-xs-12">
                   <p class="help-block">
                      <sup><li class="fa fa-asterisk color-asterisk-required"></li></sup> Campos requeridos
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
       </div>

   </div>
   <div class="sol-xs-1"></div>
</section>
<?php $this->load->view('footer'); ?>
