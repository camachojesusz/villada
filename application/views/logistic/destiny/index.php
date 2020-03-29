<?php //$this->load->view('logistic/header'); ?>
<?php $this->load->view('header'); ?>
   <section class="seccion">
      <div class="col-xs-1"></div>
      <div class="col-xs-10">
         <section class="content-header">
            <h1>Destinos</h1>
            <ol class="breadcrumb">
               <li><?php echo anchor('logistic/logistic_index', '<span class="glyphicon glyphicon-home"></span> Inicio</a>','title="Inicio Logística"'); ?></li>
               <li class="active">Destinos</li>
            </ol>
         </section>
         <hr>
         <div class="row">
         </div>
      </div>
      <div class="col-xs-1"></div>
   </section>
<?php $this->load->view('footer'); ?>
