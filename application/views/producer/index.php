<?php $this->load->view('header');?>
<section class="seccion">
  <div class="col-xs-1"></div>
  <div class="col-xs-10">
      <section class="content-header">
         <h1>Proveedores<small><strong>Ver proveedores</strong></small></h1>
         <ol class="breadcrumb">
            <li><?php echo anchor('login/in_sess/','<span class="glyphicon glyphicon-home"></span> Inicio', ''); ?></li>
            <li class="active">Proveedores</a></li>
         </ol>
      </section>
    <hr>
      <div class="row">
         <?php if(isset($allproducer)&& !empty($allproducer)): ?>
         <div class="col-xs-12">
            <div class="box box-primary">
               <?php if (isset($success_producer) && isset($info_producer)): ?>
                  <br>
                  <div class="callout callout-success">
                     <h4>¡Correcto!</h4>
                     <p class="">Proveedor guardado con <label for="">Clave: </label> <?php foreach ($info_producer->result() as $info_new_producer) { echo $info_new_producer->noctrl_producer; } ?></p>
                  </div>
               <?php endif; ?>
               <?php if (isset($success_updateproducer)): ?>
                  <br>
                  <div class="callout callout-info">
                     <h4>¡Aviso!</h4>
                     <p class="">La información de un proveedor ha sido modificada</p>
                  </div>
               <?php endif; ?>
               <?php if (isset($status_alert)): ?>
                  <br>
                  <div class="callout callout-<?php echo ($status_alert === '0') ? 'warning' : 'info' ; ?>">
                     <h4><?php echo ($status_alert != '0') ? '¡Atención!' : '¡Aviso!' ; ?></h4>
                     <p><?php echo ($status_alert != '0') ? 'Se ha desactivado un <b>Empleado</b>' : 'Se ha reactivado un <b>Empleado</b>' ; ?></p>
                  </div>
               <?php endif; ?>
               <?php if (isset($fail_producerupdate)): ?>
                  <br>
                  <div class="callout callout-danger">
                     <h4>¡Error!</h4>
                     <p class="">Falló la edición del proveedor, vuelve a intentarlo</p>
                  </div>
               <?php endif; ?>
               <div class="box-header pull-right">
                  <p class="box-title"><?php echo anchor('producer/new_producer/','Nuevo Proveedor <i class="fa fa-truck"></i>&nbsp;<sup><i class="fa fa-plus"></i></sup>', 'class="btn btn-info btn-sm"'); ?></p>
               </div>
               <div class="box-body">
                  <div id="general_table_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                     <div class="row">
                        <div class="col-sm-12 table-responsive">
                           <table id="general_table" class="table table-bordered table-striped table-hover table-condensed dataTable" role="grid" aria-describedby="general_table_info">
                              <thead>
                                 <tr role="row">
                                    <th hidden><?php echo ''; ?></th>
                                    <th>Identificación</th>
                                    <th>Proveedor</th>
                                    <th>Contacto</th>
                                    <th>Estatus</th>
                                    <th>Opciones</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php foreach($allproducer as $allproducers): ?>
                                    <tr role="row">
                                       <td hidden=""><?php echo $allproducers->id_producer; ?></td>
                                       <td>
                                          <label for="">Clave:</label>
                                          &nbsp;
                                          <?php echo $allproducers->noctrl_producer; ?>
                                       </td>
                                       <td>
                                          <label for=""><li class="fa fa-truck"></li> </label>
                                          &nbsp;
                                          <?php echo $allproducers->describe_producer; ?>
                                       </td>
                                       <td>
                                          <label for=""><li class="fa fa-mobile"></li></label>
                                          &nbsp;
                                          <?php echo $allproducers->cel_producer; ?>
                                       </td>
                                       <td>
                                          <?php if ($allproducers->status_producer === '0'):  ?>
                                             <small class="label label-danger"><i class="fa fa-remove"></i> Inactivo</small>
                                          <?php else: ?>
                                             <small class="label label-info"><i class="fa fa-check"></i> Activo</small>
                                          <?php endif; ?>
                                       </td>
                                       <td class="text-center">
                                          <a href="#modal_more_<?php echo $allproducers->id_producer;?>" type="button" class="btn btn-xs btn-default" data-toggle="modal" data-target="#modal_more_<?php echo $allproducers->id_producer;?>" title="Ver más">
                                             <i class="fa fa-eye"></i>
                                          </a>
                                          <?php if ($allproducers->status_producer === '1'): ?>
                                          <?php echo anchor('producer/origins/'.$allproducers->noctrl_e_producer,'<i class="fa fa-map-signs"></i>', 'style="background: #9B59B6; color: #FFFFFF;" type="button" title="Orígenes" class="btn btn-xs '.(($allproducers->status_producer === '0') ? ('hidden') : ('')).'"');?>
                                          <?php echo anchor('producer/edit/'.$allproducers->id_producer, '<i class="fa fa-edit" ></i>', 'type="button" title="Editar" class="btn btn-primary btn-xs '.(($allproducers->status_producer === '0') ? ('hidden') : ('')).'"'); ?>
                                             <a href="#modal_delete_<?php echo $allproducers->id_producer;?>" type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modal_delete_<?php echo $allproducers->id_producer; ?>" title="Desactivar">
                                                <i class="fa fa-remove"></i>
                                             </a>
                                          <?php else: ?>
                                             <?php echo anchor('producer/status_producer/'.$allproducers->status_producer.'/'.$allproducers->noctrl_e_producer, '<i class="fa fa-check"></i>', 'type="button" class="btn btn-xs btn-info" title="Activar"'); ?>
                                          <?php endif; ?>
                                       </td>
                                    </tr>
                                    <div class="modal fade" id="modal_more_<?php echo $allproducers->id_producer; ?>">
                                       <div class="modal-dialog">
                                          <div class="modal-content">
                                             <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">
                                                   <span aria-hidden="true">&times;</span>
                                                </button>
                                                <h3 class="modal-title">Proveedor <small class="lead"><?php echo $allproducers->noctrl_producer." - ".$allproducers->describe_producer; ?></small></h3>
                                             </div>
                                             <div class="modal-body">
                                                <div class="row">
                                                   <div class="col-xs-12">
                                                      <div class="box box-primary">
                                                         <div class="box-header with-border">
                                                            <h3 class="box-title">Datos del proveedor</h3>
                                                            <div class="box-tools pull-right">
                                                               <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Minimizar"><i class="fa fa-minus"></i></button>
                                                            </div>
                                                         </div>
                                                         <div class="box-body">
                                                            <div class="row">
                                                               <div class="col-xs-12 col-md-4"><p><?php echo (($allproducers->document_producer === '0') ? '<b>CURP:</b><br>' : '<b>RFC:</b><br>').$allproducers->describedocument_producer; ?></p></div>
                                                               <div class="col-xs-12 col-md-8"><p><b>Proveedor o empresa</b><br><?php echo $allproducers->describe_producer; ?></p></div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div class="col-xs-12">
                                                      <div class="box collapsed-box box-primary">
                                                         <div class="box-header with-border">
                                                            <h3 class="box-title">Informacion de contacto</h3>
                                                            <div class="box-tools pull-right">
                                                               <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Maximizar"><i class="fa fa-plus"></i></button>
                                                            </div>
                                                         </div>
                                                         <div class="box-body row">
                                                            <div class="col-xs-12">
                                                               <div class="form-group">
                                                                  <div class="col-xs-12"><p><b>Nombre completo:</b><br><?php echo $allproducers->name_producer.' '.$allproducers->ap1_producer.' '.$allproducers->ap2_producer;?></p></div>
                                                                  <div class="col-xs-12 col-md-6"><p><i class="fa fa-envelope"></i> <?php echo ($allproducers->email_producer != '') ? $allproducers->email_producer : 'No disponible' ;?></p></div>
                                                                  <div class="col-xs-12 col-md-6"><p><i class="fa fa-phone"></i> <?php echo ($allproducers->phone_producer != '') ? $allproducers->phone_producer : 'No disponible' ;?></p></div>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div class="col-xs-12">
                                                      <div class="box collapsed-box box-primary">
                                                         <div class="box-header with-border">
                                                            <h3 class="box-title">Dirección</h3>
                                                            <div class="box-tools pull-right">
                                                               <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Maximizar"><i class="fa fa-plus"></i></button>
                                                            </div>
                                                         </div>
                                                         <div class="box-body row">
                                                            <div class="col-xs-12">
                                                               <div class="form-group">
                                                                  <div class="col-xs-12 col-md-6"><p><b>Calle</b><br><?php echo ($allproducers->street_producer != '') ? $allproducers->street_producer : 'No disponible';?></p></div>
                                                                  <div class="col-xs-12 col-md-3"><p><b>Número exterior</b><br><?php echo ($allproducers->numint_producer != '') ? $allproducers->numext_producer : 'No disponible';?></p></div>
                                                                  <div class="col-xs-12 col-md-3"><p><b>Número interior</b><br><?php echo ($allproducers->numint_producer != '') ? $allproducers->numint_producer : 'No disponible';?></p></div>
                                                                  <div class="col-xs-12 col-md-6"><p><b>Localidad</b><br><?php echo ($allproducers->local_producer != '') ? $allproducers->local_producer : 'No disponible';?></p></div>
                                                                  <div class="col-xs-12 col-md-6"><p><b>Municipio</b><br><?php echo ($allproducers->muni_producer != '') ? $allproducers->muni_producer : 'No disponible';?></p></div>
                                                                  <div class="col-xs-12 col-md-6"><p><b>Estado</b><br><?php echo ($allproducers->state_producer != '-1') ? mb_strtoupper($allproducers->state_producer) : 'No disponible' ;?></p></div>
                                                                  <div class="col-xs-12 col-md-6"><p><b>Código Postal</b><br><?php echo ($allproducers->postalcode_producer != '') ? $allproducers->postalcode_producer : 'No disponible';?></p></div>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="modal-footer">
                                                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cerrar <i class="fa fa-remove"></i></button>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="modal fade" id="modal_delete_<?php echo $allproducers->id_producer; ?>">
                                       <div class="modal-dialog">
                                          <div class="modal-content">
                                             <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                                                <h3 class="modal-title">Desactivar <small class="lead">Proveedor</small></h3>
                                             </div>
                                             <div class="modal-body">
                                                <div class="row">
                                                   <div class="col-xs-12">
                                                      <div class="callout callout-warning">
                                                         <h4><i class="fa fa-warning"></i>Advertencia</h4>
                                                         <p>Está a punto de desactivar un <b>Proveedor</b>, si está seguro de esto presione <b>Continuar</b></p>
                                                      </div>
                                                   </div>
                                                   <div class="col-xs-12">
                                                      <div class="box box-warning">
                                                         <div class="box-header with-border">
                                                            <h3 class="box-title">Proveedor</h3>
                                                            <div class="box-tools pull-right">
                                                               <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Minimizar"> <i class="fa fa-minus"></i></button>
                                                            </div>
                                                         </div>
                                                         <div class="box-body">
                                                            <div class="row">
                                                               <div class="col-xs-12 col-md-6">
                                                                  <p><b>Clave:</b><br><?php echo $allproducers->noctrl_producer; ?></p>
                                                               </div>
                                                               <div class="col-xs-12 col-md-6">
                                                                  <p><?php echo (($allproducers->document_producer === '0') ? '<b>CURP:</b><br>' : '<b>RFC:</b><br>').$allproducers->describedocument_producer; ?></p>
                                                               </div>
                                                               <div class="col-xs-12">
                                                                  <p><b>Nombre del proveedor o de la empresa:</b><br><?php echo $allproducers->describe_producer; ?></p>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar <span class="glyphicon glyphicon-remove"></span>
                                                </button>
                                                <?php echo anchor('producer/status_producer/'.$allproducers->status_producer.'/'.$allproducers->noctrl_e_producer, 'Continuar <i class="fa fa-check"></i>', 'type="button" class="btn btn-success"');  ?>
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
                  Aún no hay proveedores registrados. Da clic en el botón para agregar un proveedor <?php echo anchor('producer/new_producer/','Nuevo Proveedor <i class="fa fa-truck"></i>&nbsp;<sup><i class="fa fa-plus"></i></sup>', 'class="btn btn-info btn-sm"'); ?>
               </div>
            </div>
         </div>
         <?php endif; ?>
      </div>
   </div>
   <div class="col-xs-1"></div>
</section>
<?php $this->load->view('footer');?>
