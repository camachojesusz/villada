<?php $this->load->view('header');?>
<section class="seccion">
   <div class="col-xs-1"></div>
   <div class="col-xs-10">
      <section class="content-header">
         <h1>Panel principal <small><strong>Inicio</strong></small></h1>
         <ol class="breadcrumb">
            <li><?php echo anchor('login/in_sess', '<span class="glyphicon glyphicon-home"></span> Inicio', ''); ?></li>
         </ol>
      </section>
      <hr>
      <div class="row">
         <div class="col-xs-12 col-md-4">
            <div class="box box-primary">
               <div class="box-header with-border">
                  <i class="fa fa-bar-chart-o"></i>
                  <h3 class="box-title">Hola</h3>
                  <div class="box-tools pull-right">
                     <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                     <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
               </div>
               <div class="box-body">
                  <div id="donut-chart" style="height: 300px;"></div>
               </div>
            </div>
         </div>
         <div class="col-xs-12 col-md-8">
            <div class="box box-primary">
               <div class="box-header with-border">
                  <i class="fa fa-bar-chart-o"></i>
                  <h3 class="box-title">Prueba</h3>
                  <div class="box-tools pull-right">
                     <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                     <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
               </div>
               <div class="box-body">
                  <div id="donut-chart" style="height: 300px;"></div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-xs-1"></div>
</section>
<?php $this->load->view('footer');?>
