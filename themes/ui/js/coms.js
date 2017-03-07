$(document).ready(function(){
  var my_eval = $('#my_evaluation');

  if(my_eval.length > 0){
  var append = '<table id="my_evaluation_table" class="table table-bordered table-striped" cellspacing="0" width="100%"> <thead> <tr> <th>Title</th> <th>Created</th> </tr></thead> <tbody> </tbody> </table>';
  $('#my_evaluation').append(append);

  table = $('#my_evaluation_table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
          "url": base_url+'/users/retrieve_my_evaluation',
          "type": "POST",
        },
        "columns": [
        { data: 'title', name: 'title', orderable: false, sortable: false },
        { data: 'created_at', name:'created_at', orderable: false, sortable: false },
        ],

      });
  }

})