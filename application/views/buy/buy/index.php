<?php $this->load->view('header'); ?>
<section class="seccion">

   <div class="col-xs-1"></div>
   <div class="col-xs-10">
      <section class="content-header">
         <h1>Compras</h1>
         <ol class="breadcrumb">
            <li><?php echo anchor('login/in_sess', '<span class="glyphicon glyphicon-home"></span> Inicio</a>','title="Inicio"'); ?></li>
            <li class="active">Compras</li>
         </ol>
      </section>
      <hr>

      <div class="row">
         <?php if (isset($buy) && !empty($buy)): ?>
            <div class="col-xs-12">
               <div class="box box-warning">
                  <div class="box-header pull-right">
                     <p class="box-title">
                        <?php echo anchor('buy/new_buy', 'Comprar <i class="fa fa-shopping-cart"></i>&nbsp;<sup><i class="fa fa-plus"></i>', 'class="btn btn-sm btn-info"'); ?>
                     </p>
                  </div>
                  <div class="box-body">
                     <?php if (isset($success_update_buy)): ?>
                        <div class="col-xs-12">
                           <br>
                           <div class="callout callout-info">
                              <h4>¡Aviso!</h4>
                              <p class="">
                                 La información de una <b>Compra</b> ha sido midificada
                              </p>
                           </div>
                        </div>
                     <?php endif; ?>
                     <?php if (isset($delete_buy)): ?>
                        <div class="col-xs-12">
                           <br>
                           <div class="callout callout-warning">
                              <h4>¡Atención!</h4>
                              <p class="">
                                 Se ha eliminado una <b>compra</b>.
                              </p>
                           </div>
                        </div>
                     <?php endif; ?>
                     <div id="buy_wrapper" class="dataTables_wrapper dt-bootstrap">
                        <div class="row">
                           <div class="col-sm-12 table-responsive">
                              <table id="buy" class="table table-bordered table-hover table-condensed dataTable" role="grid" aria-describedby="buy_info">
                                 <thead>
                                    <tr role="row">
                                       <th>Folio</th>
                                       <th>Proveedor</th>
                                       <th>Origen</th>
                                       <th>Producto</th>
                                       <th>Cajas</th>
                                       <th>Kg</th>
                                       <th>Destare</th>
                                       <th>Tot Kg</th>
                                       <th>Opciones</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php foreach ($buy as $buys):?>
                                       <tr role="row" <?php if ($buys->status_classify === '0') { echo 'class="danger"'; } elseif ($buys->status_classify === '1') { echo 'class="warning"'; } else { echo 'class="success"'; } ?>>
                                          <td>
                                             <?php echo $buys->sheet_arrival; ?>
                                          </td>
                                          <td>
                                             <?php echo $buys->describe_producer; ?>
                                          </td>
                                          <td>
                                             <?php echo $buys->describe_origin; ?>
                                          </td>
                                          <td>
                                             <?php echo $buys->describe_product;?>
                                          </td>
                                          <td>
                                             <?php echo $buys->boxes_arrival; ?>
                                          </td>
                                          <td>
                                             <?php echo $buys->weight_arrival.' kg'; ?>
                                          </td>
                                          <td>
                                             <?php echo $buys->destare_arrival.' kg'; ?>
                                          </td>
                                          <td>
                                             <?php echo $buys->totalweight_arrival.' kg'; ?>
                                          </td>
                                          <td class="text-center">
                                             <?php
                                             echo anchor('classify/index/'.$buys->sheet_arrival, 'Seleccionar <i class="fa fa-balance-scale"></i>', 'type="button" class="btn btn-xs" style="background: #138D75; color: #FFFFFF;"').'&nbsp;';
                                             echo anchor('buy/edit_buy/'.$buys->sheet_arrival, '<i class="fa fa-edit"></i>', 'title="Editar" type="button" class="btn btn-xs btn-primary'.(($buys->status_classify != '0') ? (' hidden') : ('')).'"');
                                             ?>
                                             <a href="#modal_delete_<?php echo $buys->sheet_arrival; ?>" data-toggle="modal" data-target="#modal_delete_<?php echo $buys->sheet_arrival; ?>" title="Eliminar" type="button" class="btn btn-xs btn-danger <?php echo (($buys->status_classify != '0') ? (' hidden') : ('')); ?>"><i class="fa fa-remove"></i></a>
                                          </td>
                                          <div class="modal fade" id="modal_delete_<?php echo $buys->sheet_arrival; ?>">
                                             <div class="modal-dialog">
                                                <div class="modal-content">
                                                   <div class="modal-header">
                                                      <button type="button" class="close" data-dismiss="modal">
                                                         <span aria-hidden="true">&times;</span>
                                                      </button>
                                                      <h3 class="modal-title">Eliminar <small class="lead">Compra</small></h3>
                                                   </div>
                                                   <div class="modal-body">
                                                      <div class="row">
                                                         <div class="col-xs-12">
                                                            <div class="callout callout-warning">
                                                               <h4><i class="fa fa-warning"></i> Advertencia</h4>
                                                               <p>Está a punto de eliminar una <b>Compra</b>, si está seguro de esto presione <b>Continuar</b></p>
                                                            </div>
                                                         </div>
                                                         <div class="col-xs-12">
                                                            <div class="box box-warning">
                                                               <div class="box-header with-border">
                                                                  <h3 class="box-title">Compra</h3>
                                                                  <div class="box-tools pull-right">
                                                                     <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Minimizar"><i class="fa fa-minus"></i></button>
                                                                  </div>
                                                               </div>
                                                               <div class="box-body">
                                                                  <div class="row">
                                                                     <div class="col-xs-12 col-md-4"><p><b>Folio:</b><br><?php echo $buys->sheet_arrival; ?></p></div>
                                                                     <div class="col-xs-12 col-md-4"><p><b>Proveedor:</b><br><?php echo $buys->describe_producer; ?></p></div>
                                                                     <div class="col-xs-12 col-md-4"><p><b>Origen:</b><br><?php echo $buys->describe_origin; ?></p></div>
                                                                     <div class="col-xs-12 col-md-4"><p><b>Producto:</b><br><?php echo $buys->describe_product;?></p></div>
                                                                     <div class="col-xs-12 col-md-2"><p><b>Cajas:</b><br><?php echo $buys->boxes_arrival; ?></p></div>
                                                                     <div class="col-xs-12 col-md-2"><p><b>Peso:</b><br><?php echo $buys->weight_arrival.' kg'; ?></p></div>
                                                                     <div class="col-xs-12 col-md-2"><p><b>Destare:</b><br><?php echo $buys->destare_arrival.' kg'; ?></p></div>
                                                                     <div class="col-xs-12 col-md-2"><p><b>Tot kg:</b><br><?php echo $buys->totalweight_arrival.' kg'; ?></p></div>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div class="modal-footer">
                                                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar <span class="glyphicon glyphicon-remove"></span></button>
                                                      <?php echo anchor('buy/delete_arrival/'.$buys->sheet_arrival, 'Continuar <i class="fa fa-check"></i>', 'type="button" class="btn btn-success"'); ?>
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
               </div>
            </div>
         <?php else: ?>
            <div class="col-xs-12">
               <div class="panel panel-warning">
                  <div class="panel-heading">
                     <h3 class="panel-title">¡Error!</h3>
                  </div>
                  <div class="panel-body">
                     Aún no hay Compras. Da clic en el botón para realizar una compra <a href="<?php echo base_url();?>buy/new_buy" class="btn btn-info">Comprar <i class="fa fa-shopping-cart"></i>&nbsp;<sup><i class="fa fa-plus"></i></sup></a>
                  </div>
               </div>
            </div>
         <?php endif; ?>
      </div>
   </div>
   <div class="col-xs-1"></div>
</section>
<?php $this->load->view('footer');?>
