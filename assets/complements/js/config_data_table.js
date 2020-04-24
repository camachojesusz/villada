   $(function () {
      $('#general_table').DataTable({
         'paging'      : true,
         'lengthChange': false,
         'searching'   : true,
         'ordering'    : true,
         'info'        : true,
         'autoWidth'   : true,
         'language'    : {
            "lengthMenu"  : "Mostrar _MENU_ registros por página",
            "zeroRecords" : "Sin coincidencias - revisa la escritura",
            "info"        : "Mostrando de <b>_START_</b> hasta <b>_END_</b>, de <b>_TOTAL_</b> registros",
            "infoEmpty"   : "No hay registros disponibles",
            "infoFiltered": "(<b>_MAX_</b> registros filtrados)",
            "search"      : 'Buscar <li class = "fa fa-search color-search-table"></li>',
            "pagingType"  : "simple_numbers"
         }
      });

      $('#table_size_a').DataTable({
         'paging'      : true,
         'lengthChange': false,
         'searching'   : true,
         'ordering'    : true,
         'info'        : true,
         'autoWidth'   : true,
         'language'    : {
            "lengthMenu"  : "Mostrar _MENU_ registros por página",
            "zeroRecords" : "Sin coincidencias - revisa la escritura",
            "info"        : "Mostrando de <b>_START_</b> hasta <b>_END_</b>, de <b>_TOTAL_</b> registros",
            "infoEmpty"   : "No hay registros disponibles",
            "infoFiltered": "(<b>_MAX_</b> registros filtrados)",
            "search"      : 'Buscar <li class = "fa fa-search color-search-table"></li>',
            "pagingType"  : "simple_numbers"
         }
      });

      $('#table_size_b').DataTable({
         'paging'      : true,
         'lengthChange': false,
         'searching'   : true,
         'ordering'    : true,
         'info'        : true,
         'autoWidth'   : true,
         'language'    : {
            "lengthMenu"  : "Mostrar _MENU_ registros por página",
            "zeroRecords" : "Sin coincidencias - revisa la escritura",
            "info"        : "Mostrando de <b>_START_</b> hasta <b>_END_</b>, de <b>_TOTAL_</b> registros",
            "infoEmpty"   : "No hay registros disponibles",
            "infoFiltered": "(<b>_MAX_</b> registros filtrados)",
            "search"      : 'Buscar <li class = "fa fa-search color-search-table"></li>',
            "pagingType"  : "simple_numbers"
         }
      });

      $('#buy').DataTable({
         'paging'      : true,
         'lengthChange': true,
         'searching'   : true,
         'ordering'    : true,
         'info'        : true,
         'autoWidth'   : true,
         'language'    : {
            "lengthMenu"  : "Mostrar _MENU_ registros por página",
            "zeroRecords" : "Sin coincidencias - revisa la escritura",
            "info"        : "Mostrando de <b>_START_</b> hasta <b>_END_</b>, de <b>_TOTAL_</b> registros",
            "infoEmpty"   : "No hay registros disponibles",
            "infoFiltered": "(<b>_MAX_</b> registros filtrados)",
            "search"      : 'Buscar <li class = "fa fa-search color-search-table"></li>',
            "pagingType"  : "simple_numbers"
         }
      }).column('0:visible').order('desc').draw();

      $('.select2').select2();

      $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
         checkboxClass: 'icheckbox_flat-green',
         radioClass: 'iradio_flat-green'
      })
   })
