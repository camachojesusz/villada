<?php $this->load->view('header'); ?>
<section class="seccion">

   <div class="col-xs-1"></div>
   <div class="col-xs-10">
      <section class="content-header">
         <h1>Compras <small><strong>Seleccionar tamaños</strong></small></h1>
         <ol class="breadcrumb">
            <li><?php echo anchor('login/in_sess', '<span class="glyphicon glyphicon-home"></span> Inicio</a>','title="Inicio"'); ?></li>
            <li><?php echo anchor('buy', 'Compras','title="Compras"'); ?></li>
            <li class="active">Seleccionar tamaños</li>
         </ol>
      </section>
      <hr>
      <div class="row">
         <?php if (isset($classify) && !empty($classify)): ?>
            <div class="col-xs-12">
               <div class="box box-warning">
                  <div class="box-header row">
                     <div class="col-xs-12 col-md-11 row">
                        <div class="col-xs-3 col-md-2">
                           <p>
                              <small>
                                 <b>Proveedor:</b><br> <?php echo $arrival->row()->describe_producer; ?>
                              </small>
                           </p>
                        </div>
                        <div class="col-xs-3 col-md-2">
                           <p>
                              <small>
                                 <b>Origen:</b><br> <?php echo $arrival->row()->describe_origin; ?>
                              </small>
                           </p>
                        </div>
                        <div class="col-xs-3 col-md-2">
                           <p>
                              <small>
                                 <b>Producto:</b><br> <?php echo $arrival->row()->describe_product; ?>
                              </small>
                           </p>
                        </div>
                        <div class="col-xs-3 col-md-1">
                           <p>
                              <small>
                                 <b>Cajas:</b><br> <?php echo $arrival->row()->boxes_arrival; ?>
                              </small>
                           </p>
                        </div>
                        <div class="col-xs-3 col-md-1">
                           <p>
                              <small>
                                 <b>Peso:</b><br> <?php echo round($arrival->row()->weight_arrival, 2).' kg'; ?>
                              </small>
                           </p>
                        </div>
                        <div class="col-xs-3 col-md-2">
                           <p>
                              <small>
                                 <b>Cajas (disponibles):</b><br> <?php echo $arrival_c->row()->boxes_arrival; ?>
                              </small>
                           </p>
                        </div>
                        <div class="col-xs-3 col-md-2">
                           <p>
                              <small>
                                 <b>Peso (disponibles):</b><br> <?php echo round($arrival_c->row()->weight_arrival, 2).' kg'; ?>
                              </small>
                           </p>
                        </div>
                     </div>
                     <div class="col-xs-12 col-md-1 pull-right">
                        <div class="col-xs-12">
                           <p class="pull-right">
                              <?php ($arrival->row()->status_classify === '2') ? ($activate = 'disabled') : ($activate = ''); echo anchor('classify/new_classify/'.$sheet_arrival, 'Nueva selección <i class="fa fa-balance-scale"></i>&nbsp;<sup><i class="fa fa-plus"></i></sup>', 'class="btn btn-sm btn-info '.$activate.'"'); ?>
                           </p>
                        </div>
                     </div>
                  </div>
                  <div class="box-body">
                     <div id="general_table_wrapper" class="dataTables_wrapper dt-bootstrap">
                        <div class="row">
                           <?php if (isset($success_clfy)): ?>
                              <div class="col-xs-12">
                                 <br>
                                 <div class="callout callout-info">
                                    <h4>¡Aviso!</h4>
                                    <p class="">
                                       Información de <b>Selección</b> modificada.
                                    </p>
                                 </div>
                              </div>
                           <?php endif; ?>
                           <?php if (isset($new_clfy)): ?>
                              <div class="col-xs-12">
                                 <br>
                                 <div class="callout callout-success">
                                    <h4>¡Correcto!</h4>
                                    <p class="">
                                       Se ha agregado una nueva <b>Selección</b>.
                                    </p>
                                 </div>
                              </div>
                           <?php endif; ?>
                           <?php if (isset($delete_clfy)): ?>
                              <div class="col-xs-12">
                                 <br>
                                 <div class="callout callout-warning">
                                    <h4>¡Atención!</h4>
                                    <p class="">
                                       Se ha eliminado una <b>Selección</b>.
                                    </p>
                                 </div>
                              </div>
                           <?php endif; ?>
                           <div class="col-sm-12 table-responsive">
                              <table id="general_table" class="table table-bordered table-striped table-hover table-condensed dataTable" role="grid" aria-describedby="general_table_info">
                                 <thead>
                                    <tr role="row">
                                       <th>Tamaño</th>
                                       <th>Cajas</th>
                                       <th>Peso</th>
                                       <th>Destare</th>
                                       <th>Total Kg</th>
                                       <th>Opciones</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php foreach ($classify->result() as $clfy): ?>
                                       <tr role="row">
                                          <td><label hidden><?php echo $clfy->product_size_id; ?></label><b><?php echo $clfy->description_q; ?></b>&nbsp;<?php echo $clfy->description_c; ?></td>
                                          <td><?php echo $clfy->boxes_c; ?></td>
                                          <td><?php echo $clfy->weight_c.' kg'; ?></td>
                                          <td><?php echo $clfy->destare_c.' kg'; ?></td>
                                          <td><?php echo $clfy->total_weight_c.' kg'; ?></td>
                                          <td class="text-center">
                                             <?php echo anchor('classify/edit_classify/'.$clfy->classify_id, '<i class="fa fa-edit"></i>', 'title="Editar" type="button" class="btn btn-xs btn-primary"').'&nbsp;'; ?>
                                             <a href="#modal_delete_<?php echo $clfy->classify_id; ?>" data-toggle="modal" data-target="#modal_delete_<?php echo $clfy->classify_id; ?>"  title="Eliminar" type="button" class="btn btn-xs btn-danger"><i class="fa fa-remove"></i></a>
                                          </td>
                                          <div class="modal fade" id="modal_delete_<?php echo $clfy->classify_id; ?>">
                                             <div class="modal-dialog">
                                                <div class="modal-content">
                                                   <div class="modal-header">
                                                      <button type="button" class="close" data-dismiss="modal">
                                                         <span aria-hidden="true">&times;</span>
                                                      </button>
                                                      <h3 class="modal-title">Eliminar <small class="lead">Selección</small></h3>
                                                   </div>
                                                   <div class="modal-body">
                                                      <div class="row">
                                                         <div class="col-xs-12">
                                                            <div class="callout callout-warning">
                                                               <h4><i class="fa fa-warning"></i> Advertencia</h4>
                                                               <p>Está a punto de eliminar una <b>Selección</b>, si está seguro de esto presione <b>Continuar</b></p>
                                                            </div>
                                                         </div>
                                                         <div class="col-xs-12">
                                                            <div class="box box-warning">
                                                               <div class="box-header with-border">
                                                                  <h3 class="box-title">Selección</h3>
                                                                  <div class="box-tools pull-right">
                                                                     <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Minimizar"><i class="fa fa-minus"></i></button>
                                                                  </div>
                                                               </div>
                                                               <div class="box-body">
                                                                  <div class="row">
                                                                     <div class="col-xs-12 col-md-4"><p><b>Tamaño:</b><br><?php echo '<b>'.$clfy->description_q.'</b> '.$clfy->description_c; ?></p></div>
                                                                     <div class="col-xs-12 col-md-2"><p><b>Cajas:</b><br><?php echo $clfy->boxes_c; ?></p></div>
                                                                     <div class="col-xs-12 col-md-2"><p><b>Peso:</b><br><?php echo $clfy->weight_c.' kg'; ?></p></div>
                                                                     <div class="col-xs-12 col-md-2"><p><b>Destare:</b><br><?php echo $clfy->destare_c; ?></p></div>
                                                                     <div class="col-xs-12 col-md-2"><p><b>Tot kg:</b><br><?php echo $clfy->total_weight_c.' kg'; ?></p></div>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div class="modal-footer">
                                                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar <span class="glyphicon glyphicon-remove"></span></button>
                                                      <?php echo anchor('classify/delete_classify/'.$clfy->classify_id.'/'.$sheet_arrival, 'Continuar <i class="fa fa-check"></i>', 'type="button" class="btn btn-success"'); ?>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </tr>
                                    <?php endforeach; ?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="box-footer">
                     <div class="box collapsed-box box-warning">
                        <div class="box-header with-border">
                           <h3 class="box-title">Totales</h3>
                           <div class="box-tools pull-right">
                              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Ampliar"><i class="fa fa-minus"></i></button>
                           </div>
                        </div>
                        <div class="box-body">
                           <div class="col-xs-12 row">
                              <div class="col-xs-12 col-md-4">
                                 <p>
                                    <b>Cajas:</b>&nbsp;<?php echo round($count->row()->count_bx, 2); ?>
                                 </p>
                              </div>
                              <div class="col-xs-12 col-md-4">
                                 <p>
                                    <b>Peso:</b>&nbsp;<?php echo round($count->row()->count_kg, 2).' kg'; ?>
                                 </p>
                              </div>
                              <div class="col-xs-12 col-md-4">
                                 <p>
                                    <b>Total Kg:</b>&nbsp;<?php echo round($count->row()->count_tot, 2).' kg'; ?>
                                 </p>
                              </div>
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
                     Aún no se clasifican los tamaños de esta compra. Da clic en el botón para clasificar los tamaños <?php echo anchor('classify/new_classify/'.$sheet_arrival, 'Nueva selección <i class="fa fa-balance-scale"></i>&nbsp;<sup><i class="fa fa-plus"></i></sup>','class="btn btn-sm btn-info"'); ?>
                  </div>
               </div>
            </div>
         <?php endif; ?>
      </div>
   </div>
   <div class="col-xs-1"></div>

</section>
<?php $this->load->view('footer');?>
