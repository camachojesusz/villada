<?php $this->load->view('header');?>
<section class="seccion">
   <div class="col-xs-1"></div>
   <div class="col-xs-10">
      <section class="content-header">
         <h1>Empleados <small><strong>Listado de Empleados</strong></small></h1>
         <ol class="breadcrumb">
            <li><?php echo anchor('login/in_sess', '<span class="glyphicon glyphicon-home"></span> Inicio', ''); ?></li>
            <li class="active">Empleados</li>
         </ol>
      </section>
      <hr>
      <div class="row">
         <?php if (isset($allemployee) && ! empty($allemployee)): ?>
            <div class="col-xs-12">
               <div class="box box-primary">
                  <?php if (isset($success_curp)): ?>
                     <br>
                     <div class="callout callout-success">
                        <h4>¡Correcto!</h4>
                        <p class="">Se ha registrado un nuevo <b>Empleado</b></p>
                     </div>
                  <?php endif; ?>
                  <?php if (isset($status_alert)): ?>
                     <br>
                     <div class="callout callout-<?php echo ($status_alert != '0') ? 'warning' : 'info' ; ?>">
                        <h4><?php echo ($status_alert != '0') ? '¡Atención!' : '¡Aviso!' ; ?></h4>
                        <p><?php echo ($status_alert != '0') ? 'Se ha desactivado un <b>Empleado</b>' : 'Se ha reactivado un <b>Empleado</b>' ; ?></p>
                     </div>
                  <?php endif; ?>
                  <?php if (isset($success_updateemployee)): ?>
                     <br>
                     <div class="callout callout-info">
                        <h4>¡Aviso!</h4>
                        <p class="">La información de un <b>Empleado</b> ha sido modificada</p>
                     </div>
                  <?php endif; ?>
                  <div class="box-header pull-right">
                     <p class="box-title">
                        <?php echo anchor('employee/new', 'Nuevo Empleado <i class="fa fa-user"></i>&nbsp;<sup><i class="fa fa-plus"></i></sup>', 'type="button" class="btn btn-info btn-sm"'); ?>
                     </p>
                  </div>
                  <div class="box-body">
                     <div id="general_table_wrapper" class="dataTables_wrapper dt-bootstrap">
                        <div class="row">
                           <div class="col-sm-12 table-responsive">
                              <table id="general_table" class="table table-bordered table-striped table-hover table-condensed dataTable" role="grid" aria-describedby="general_table_info">
                                 <thead>
                                    <tr role="row">
                                       <th hidden=""><?php echo ''; ?> </th>
                                       <th>Usuario</th>
                                       <th>Empleado</th>
                                       <th>Área de trabajo</th>
                                       <th>Contacto</th>
                                       <th>Estatus</th>
                                       <th>Opciones</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php foreach($allemployee as $allemployees): ?>
                                       <tr role="row">
                                          <td hidden=""><?php echo $allemployees->id_employee; ?></td>
                                          <td>
                                             <label for=""><li class="fa fa-user"> </li></label>
                                             <?php echo " ".$allemployees->username_users; ?>
                                          </td>
                                          <td>
                                             <label for=""><li class="fa fa-user"> </li></label>
                                             <?php echo " ".$allemployees->name_employee. " ".$allemployees->ap1_employee. " ".$allemployees->ap2_employee; ?>
                                          </td>
                                          <td>
                                             <?php echo $allemployees->character_profile; ?>
                                          </td>
                                          <td>
                                             <label for=""><li class="fa fa-mobile"></li></label>
                                             <?php echo " ".$allemployees->cel_employee; ?>
                                          </td>
                                          <td>
                                             <?php if ($allemployees->status_employee === '0'): ?>
                                             <small class="label label-danger"><i class="fa fa-remove"></i> Inactivo</small>
                                             <?php else: ?>
                                             <small class="label label-info"><i class="fa fa-check"></i> Activo</small>
                                             <?php endif; ?>
                                          </td>
                                          <td class="text-center">
                                             <a href="#modal_more_<?php echo $allemployees->id_employee;?>" type="button" class="btn btn-xs btn-default" data-toggle="modal" data-target="#modal_more_<?php echo $allemployees->id_employee;?>" title="Ver más"><i class="fa fa-eye"></i>
                                             </a>
                                             <?php echo anchor('employee/edit/'.$allemployees->id_employee, '<i class="fa fa-edit" ></i>', 'type="button" title="Editar" class="btn btn-primary btn-xs '.(($allemployees->status_employee === '0') ? ('hidden') : ('')).'"'); ?>
                                             <?php if ($allemployees->status_employee === '1'): ?>
                                                <a href="#modal_delete_<?php echo $allemployees->id_employee;?>" type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modal_delete_<?php echo $allemployees->id_employee; ?>" title="Desactivar">
                                                   <i class="fa fa-remove"></i>
                                                </a>
                                             <?php else: ?>
                                             <?php echo anchor('employee/status_employee/'.$allemployees->id_employee, '<i class="fa fa-check"></i>', 'type="button" class="btn btn-xs btn-info" title="Activar"'); ?>
                                             <?php endif; ?>
                                          </td>
                                       </tr>
                                       <div class="modal fade" id="modal_more_<?php echo $allemployees->id_employee;?>">
                                          <div class="modal-dialog">
                                             <div class="modal-content">
                                                <div class="modal-header">
                                                   <button type="button" class="close" data-dismiss="modal">
                                                      <span aria-hidden="true">&times;</span>
                                                   </button>
                                                   <h3 class="modal-title">Empleado <small class="lead"> <?php echo $allemployees->name_employee." ".$allemployees->ap1_employee; ?></small></h3>
                                                </div>
                                                <div class="modal-body">
                                                   <div class="row">
                                                      <div class="col-xs-12">
                                                         <div class="box box-primary">
                                                            <div class="box-header with-border">
                                                               <h3 class="box-title">Datos de usuario - Área de trabajo</h3>
                                                               <div class="box-tools pull-right">
                                                                  <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Minimizar"><i class="fa fa-minus"></i></button>
                                                               </div>
                                                            </div>
                                                            <div class="box-body">
                                                               <div class="row">
                                                                  <div class="col-xs-12 col-md-4"><i class="fa fa-user"></i></label><br><?php echo $allemployees->username_users; ?></div>
                                                                  <div class="col-xs-12 col-md-4"><label>CURP:</label><br><?php echo $allemployees->curp_employee; ?></div>
                                                                  <div class="col-xs-12 col-md-4"><label>Perfil:</label><br><?php echo $allemployees->character_profile; ?></div>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <div class="col-xs-12">
                                                         <div class="box collapsed-box box-primary">
                                                            <div class="box-header with-border">
                                                               <h3 class="box-title">Domicilio</h3>
                                                               <div class="box-tools pull-right">
                                                                  <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Maximizar"><i class="fa fa-plus"></i></button>
                                                               </div>
                                                            </div>
                                                            <div class="box-body row">
                                                               <div class="col-xs-12">
                                                                  <div class="form-group">
                                                                     <div class="col-xs-12 col-md-6"><p><b>Calle</b><br><?php echo $allemployees->street_employee;?></p></div>
                                                                     <div class="col-xs-12 col-md-3"><p><b>Número exterior</b><br><?php echo $allemployees->numext_employee;?></p></div>
                                                                     <div class="col-xs-12 col-md-3"><p><b>Número interior</b><br><?php echo $allemployees->numint_employee;?></p></div>
                                                                     <div class="col-xs-12 col-md-4"><p><b>Localidad</b><br><?php echo $allemployees->local_employee;?></p></div>
                                                                     <div class="col-xs-12 col-md-4"><p><b>Municipio</b><br><?php echo $allemployees->muni_employee;?></p></div>
                                                                     <div class="col-xs-12 col-md-4"><p><b>Entidad federativa</b><br><?php echo $allemployees->state_employee;?></p></div>
                                                                     <div class="col-xs-12 col-md-4"><p><b>Código Postal</b><br><?php echo $allemployees->postalcode_employee;?></p></div>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <div class="col-xs-12">
                                                         <div class="box collapsed-box box-primary">
                                                            <div class="box-header with-border">
                                                               <h3 class="box-title">Contacto</h3>
                                                               <div class="box-tools pull-right">
                                                                  <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Maximizar"><i class="fa fa-plus"></i></button>
                                                               </div>
                                                            </div>
                                                            <div class="box-body row">
                                                               <div class="col-xs-12">
                                                                  <div class="form-group">
                                                                     <div class="col-xs-12 col-md-4"><p><i class="fa fa-phone"></i>&nbsp;<?php echo $allemployees->phone_employee;?></p></div>
                                                                     <div class="col-xs-12 col-md-4"><p><i class="fa fa-envelope"></i>&nbsp;<?php echo $allemployees->email_employee;?></p></div>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <div class="col-xs-12">
                                                         <div class="box collapsed-box box-primary">
                                                            <div class="box-header with-border">
                                                               <h3 class="box-title">Información complementaria</h3>
                                                               <div class="box-tools pull-right">
                                                                  <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Maximizar"><i class="fa fa-plus"></i></button>
                                                               </div>
                                                            </div>
                                                            <div class="box-body row">
                                                               <div class="col-xs-12">
                                                                  <div class="form-group">
                                                                     <div class="col-xs-12 col-md-4"><p><b>Cuenta con licencia de conducir</b><br>
                                                                        <?php
                                                                        switch ($allemployees->drivercandidate_employee)
                                                                        {
                                                                           case 0:
                                                                           echo "NO";
                                                                           break;
                                                                           case 1:
                                                                           echo "SI";
                                                                           break;
                                                                           default:
                                                                           echo "NO DISPONIBLE";
                                                                           break;
                                                                        }
                                                                        ?>
                                                                     </div>
                                                                     <div class="col-xs-12 col-md-4"><p><b>Tipo de licencia</b><br><?php echo ($allemployees->typelicence_employee === '') ? ' - ' : $allemployees->typelicence_employee;?></p></div>
                                                                     <div class="col-xs-12 col-md-4"><p><b>Folio de licencia</b><br><?php echo ($allemployees->sheetlicence_employee === '') ? ' - ' : $allemployees->sheetlicence_employee;?></p></div>
                                                                     <div class="col-xs-12 col-md-4"><p><b>Experiencia en años</b><br><?php echo ($allemployees->experieciedrive_employee === '') ? ' - ' : $allemployees->experieciedrive_employee;?></p></div>
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
                                       <div class="modal fade" id="modal_delete_<?php echo $allemployees->id_employee; ?>">
                                          <div class="modal-dialog">
                                             <div class="modal-content">
                                                <div class="modal-header">
                                                   <button type="button" class="close" data-dismiss="modal">
                                                      <span aria-hidden="true">&times;</span>
                                                   </button>
                                                   <h3 class="modal-title">Desactivar Empleado</h3>
                                                </div>
                                                <div class="modal-body">
                                                   <div class="row">
                                                      <div class="col-xs-12">
                                                         <div class="callout callout-warning">
                                                            <h4><i class="fa fa-warning"></i> Advertencia</h4>
                                                            <p>Está a punto de desactivar un <b>Empleado</b>, si está seguro de esto presione <b>Continuar</b></p>
                                                         </div>
                                                      </div>
                                                      <div class="col-xs-12">
                                                         <div class="box box-warning">
                                                            <div class="box-header whit-border">
                                                               <h3 class="box-title">Empleado</h3>
                                                               <div class="box-tools pull-right">
                                                                  <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Minimizar">
                                                                     <i class="fa fa-minus"></i>
                                                                  </button>
                                                               </div>
                                                            </div>
                                                            <div class="box-body">
                                                               <div class="row">
                                                                  <div class="col-xs-12 col-md-6">
                                                                     <p><b>Curp:</b><br><?php echo $allemployees->curp_employee; ?></p>
                                                                  </div>
                                                                  <div class="col-xs-12 col-md-6">
                                                                     <p><b>Nombre:</b><br><?php echo $allemployees->name_employee; ?> <?php echo $allemployees->ap1_employee; ?> <?php echo $allemployees->ap2_employee; ?></p>
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
                                                   <?php echo anchor('employee/status_employee/'.$allemployees->id_employee, 'Continuar <i class="fa fa-check"></i>', 'type="button" class="btn btn-sm btn-success"');  ?>
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
                     Aún no hay empleados registrados. Da clic en el botón para agregar un enpleado <?php echo anchor('employee/new', 'Nuevo Empleado <i class="fa fa-user"></i>&nbsp;<sup><i class="fa fa-plus"></i></sup>', 'type="button" class="btn btn-info btn-sm"'); ?>
                  </div>
               </div>
            </div>
         <?php endif; ?>
      </div>
   </div>
   <div class="col-xs-1"></div>
</section>
<?php $this->load->view('footer');?>
