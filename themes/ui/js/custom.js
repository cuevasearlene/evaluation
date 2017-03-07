var captcha_word = '';
var base_url = '';



$(function(){

 $(".btn_print").click(function () {
  $("#print_area").printThis({
    debug: true,
    canvas: true   
  });
});

 $('[data-tt="tooltip"]').tooltip(); 
 base_url = $('body').data('url');
 summary_reports();
 members_table();
 table_category();
 read_more();
 question_list_table();


  // FOR ATTACHMENTS
  Dropzone.autoDiscover = false;
  var fileList = new Array;
  var i =0;
  if($(".dropzone").length > 0){
   var filetype = allowed_filetype();
   
 }
 $(".dropzone").dropzone({
  addRemoveLinks: true,
  acceptedFiles: filetype,
  url: base_url+'/evaluation/evaluation/upload_file',
  init: function () {
    var r = $.parseJSON(retrieve_file());
    var arr = $.map(r, function(el) { return el });
    if(arr != null && arr.length > 0){
      for (var i = 0; i < arr.length ; i++) {
        var mockFile = { name: arr[i].name, size: arr[i].size };
        this.options.addedfile.call(this, mockFile);
        if(arr[i].name.match(/.(jpg|jpeg|png|gif)$/i)){
         this.options.thumbnail.call(this, mockFile,$('body').data('url')+'assets/attachments/'+$('input[name="id"]').val()+'/'+arr[i].name);
       }

       mockFile.previewElement.classList.add('dz-success');
       mockFile.previewElement.classList.add('dz-complete');
     }
   }

   $(this.element).addClass("dropzone");
   this.on("success", function(file, serverFileName) {
    fileList[i] = {"serverFileName" : serverFileName, "fileName" : file.name,"fileId" : i };
    i++;
  });
   this.on("removedfile", function(file) {
    $.ajax({
      url: base_url+'evaluation/delete_file',
      type: "POST",
      data: { "filename" : file.name, 'id' : $('input[name="id"]').val() }
    });
  });
 }
});

 var date = new Date();
 date.setDate(date.getDate()-1);
 $('.datepicker').datepicker({
  startDate: date,
  format: 'MM dd, yyyy - (DD)'
});
 base_url = $('body').data('url');
    // THIS FORM IS FOR REGISTRATION FORM
    $( "#registerform" ).validate({
      rules: {
        name:    { 
          required: true,
          nameRegex: true
        },
        email:   { 
          required: true,
          remote: {
            type: 'POST',
            url: base_url+'api/custom_validation',
            data: {
             'email': function () { return $('input[name="email"]').val(); }
           },
           dataType: 'json'
         }
       },
       username: { 
        required: true,
        remote: {
          type: 'POST',
          url: base_url+'api/custom_validation',
          data: {
           'username': function () { return $('input[name="username"]').val(); }
         },
         dataType: 'json'
       },
       loginRegex: true
     },
     number: { required: true },
     password: { pwcheck: true, required: true, minlength: 6 },
     password_again: {
      equalTo: "#password"
    },
    captcha: {
      captcha: "#captcha"
    }
  },
  messages: {
    password: { pwcheck: "Password Must contain characters and number" },
    captcha:   { captcha: "Invalid Captcha" },
    email: { remote : 'Email Already Taken'},
    username: { remote : 'Username Already Taken', 
    loginRegex : 'Character and number are only accepted on username'},
    name: { nameRegex : 'Invalid Name'}
  }
});
     // THIS FORM IS FOR REGISTRATION FORM


       // THIS FORM IS FOR UPDATE USER FORM
       $( "#user_update_form" ).validate({
        rules: {
          name:    { 
            required: true,
            nameRegex: true
          },
          email:   { 
            required: true,
            remote: {
              type: 'POST',
              url: base_url+'api/custom_validation',
              data: {
               'email': function () { return $('input[name="email"]').val(); },
               'id': $('input[name="id"]').val()
             },
             dataType: 'json'
           }
         },
         username: { 
          required: true,
          remote: {
            type: 'POST',
            url: base_url+'api/custom_validation',
            data: {
             'username': function () { return $('input[name="username"]').val(); },
             'id': $('input[name="id"]').val()
           },
           dataType: 'json'
         },
         loginRegex: true
       },
       number: { required: true },
       password: { pwcheck: true, required: true, minlength: 6 },
       password_again: {
        equalTo: "#password"
      },
      captcha: {
        captcha: "#captcha"
      }
    },
    messages: {
      password: { pwcheck: "Password Must contain characters and number" },
      captcha:   { captcha: "Invalid Captcha" },
      email: { remote : 'Email Already Taken'},
      username: { remote : 'Username Already Taken', 
      loginRegex : 'Character and number are only accepted on username'},
      name: { nameRegex : 'Invalid Name'}
    }
  });
    // THIS FORM IS FOR UPDATE USER FORM

      // THIS FORM IS FOR RESET
      $( "#resetform" ).validate({
        rules: {
          code: { required: true },
          password: { pwcheck: true, required: true, minlength: 6 },
          password_again: {
            equalTo: "#password"
          },

        },
        messages: {
          password: { pwcheck: "Password Must contain characters and number" },
          
        }

      });

        // THIS FORM IS FOR ADD QUESTION
        $( "#add_question" ).validate({
          rules: {
            question: { required: true, minlength: 30  },
            category: { required: true },
            type: { required: true },
          }
          ,
          submitHandler: function(){
            append_question();
          }
        });


       // THIS FORM IS FOR ADD QUESTION
       $( "#question_form" ).validate({
        rules: {
          question: { required: true, minlength: 30 }
          ,category: { required: true }
          ,type: { required: true }
          
        },
        submitHandler: function(){
          insert_data_question('question/create', $('#question_form'));
        }
      });



       if($('#captcha_container').length  > 0){
         captcha();
       }


          // BASIC INFORMATION SAVE
          $( "#basicform" ).validate({
            rules: {
             title: { required: true, minlength: 15 },
             category: { required: true },
             description: { required: true, minlength: 50 },
             page: { required: true },
             expired_at: { required: true },
           },
           submitHandler: function(){
            insert_data_wizard('evaluation/save_basic', $('#basicform'));
          }

        }); 
         // BASIC INFORMATION SAVE

         $( "#editbasicform" ).validate({
          rules: {
           title: { required: true, minlength: 15 },
           category: { required: true },
           description: { required: true, minlength: 50 },
           page: { required: true },
           expired_at: { required: true },
         },
         submitHandler: function(){

          update_data_wizard('evaluation/update_basic', $('#editbasicform'));

        }

      }); 
         // BASIC INFORMATION SAVE

       });





//PASSWORD CHECK
$.validator.addMethod("pwcheck", function(value) {
   return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
       && /\d/.test(value) // has a digit
     });
// NAME CHECK
$.validator.addMethod("nameRegex", function(value, element) {
  return this.optional(element) || /^([a-z']+(-| )?)+$/i.test(value);
}, "Letters only please");
// USERNAME CHECK
$.validator.addMethod("loginRegex", function(value, element) {
  return this.optional(element) || /^[a-z0-9\-]+$/i.test(value);
}, "Username must contain only letters, numbers, or dashes.");



$.validator.addMethod("captcha", function(value) {
  if(value == captcha_word){
    console.log(captcha_word);
    return true;
  }
  else{
    return false;
  }
});


$(document).on('click', '.add_members', function(){
  if(confirm('are you sure you want to add this member(s)')){

    $.ajax({
      type: 'post'
      ,dataType: 'json'
      ,data: {id: $(this).data('id'), category: $(this).data('category'), evaluation_id: $('input[name="id"]').val()}
      ,url: base_url+'evaluation/members/add_members'
      ,success:function(r){
        if(r.status == 'success'){

          sweetAlert("Good job!", r.message, "success")
          members_table();
          table_category();
        }
        else{
          sweetAlert("Oops...", r.message, "error");
        }
      }
    });
  }
});

// THIS IS FOR CHECKING IF YOU ALREADY ADD THE 



// RESEND ACTIVATION FOR REGISTRATION
$(document).on('click', '#resend_activation', function(){
  if($('input[name="number"]').val() == ''){
   sweetAlert("Oops...", 'Please Enter your Valid Phone Number', "error");
   return false;
 }
 $.ajax({
  type: 'post'
  ,data: {number: $('input[name="number"]').val()}
  ,dataType: 'json'
  ,url: $('body').data('url')+'api/resend_code' 
  ,success: function(r){
    if(r.status == 'success'){
      sweetAlert("Good job!", r.message, "success")
    }
    else{
      sweetAlert("Oops...", r.message, "error");
    }
  } 
});
});
// RESEND ACTIVATION FOR REGISTRATION

// THIS FUNCTION IS FOR RESEND CODE FOR PASSWORD RESET
$(document).on('click', '#resend_code', function(){
  $.ajax({
    type: 'post'
    ,dataType: 'json'
    ,url: $('body').data('url')+'recover/do_resend' 
    ,success: function(r){
      if(r.status == 'success'){
        sweetAlert("Good job!", r.message, "success")
      }
      else{
        sweetAlert("Oops...", r.message, "error");
      }
    } 
  });
});
// THIS FUNCTION IS FOR RESEND CODE FOR PASSWORD RESET



// THIS CODE WILL APPEND QUESTION ON WIZARD
function append_question(){
  $.ajax({
    type: 'post'
    ,dataType: 'json'
    ,data: {question: $('textarea[name="question"]').val(), id: $('input[name="id"]').val(), category: $('select[name="category"]').val(), type: $('select[name="type"]').val()}
    ,url: $('body').data('url')+'api/create_question'
    ,success: function(r){
      if(r.status == 'success'){
        $('textarea[name="question"]').val('');
        $(r.message).appendTo('#questions_container');
      }
      else{
        sweetAlert("Oops...", r.message, "error");
      }
    } 
  });
}
// THIS CODE WILL APPEND QUESTION ON WIZARD

// QUESION MODULE HERE
$(document).on('click', '.modal_question', function(){
  var type = $(this).data('type');
  var id = $(this).data('id');

  $('#question_header').text(type+ ' Question');
  if(type == 'Create'){
    $('#question_form').find('input[type="hidden"]').val('');
    $('#question_form').find('input[type="hidden"]').val('');
    $('textarea[name="question"]').val('');
    $("#question_form").validate().resetForm();
  }
  else if(type == 'Edit'){

    $("#question_form").validate().resetForm();
    $('#question_id').val(id);
    $.ajax({
      type: 'POST'
      ,data:{id:id}
      ,url: $('body').data('url')+'api/question_info' 
      ,dataType: 'json'
      ,success: function(r){
        $('select[name="category"]').val(r.data.category);
        $('textarea[name="question"]').text(r.data.question);
        $('select[name="type"]').val(r.data.type);
      }   
    });
  }
});


$(document).on('click', '.add_exists_question', function(){
    alert($(this).data('qid'));

});

$(document).on('click', '.modal_question_delete', function(){

  $('#question_delete_id').val($(this).data('id'));

  $('#info_delete_question').html('');
  $.ajax({
    type: 'post'
    ,dataType: 'json'
    ,data: {id: $(this).data('id')}
    ,url: $('body').data('url')+'api/quest_affect_evaluation' 
    ,success: function(r){
      if(r.data > 0){
       var append =  general_message('warning', 'This might be affect '+r.data+' Evaluations');
       $('#info_delete_question').append(append);
     }

   }  
 });
});


$(document).on('submit', '#question_form_delete', function(e){ 
  e.preventDefault();
  $.ajax({
    type: 'post'
    ,dataType: 'json'
    ,data: $(this).serialize()
    ,url: $('body').data('url')+'question/delete'
    ,success: function(r){
      if(r.status == 'success'){
        sweetAlert("Good job!", r.message, "success")

      }
      else{
        sweetAlert("Oops...", r.message, "error");
      }
    } 
  });
});
// QUESION MODULE HERE




// USER MODULE HERE


$(document).on('click', '.delete_user_modal', function(){

  $('#user_delete_id').val($(this).data('id'));
  $('#delete_confirmation').text($(this).data('username'));
});


$(document).on('submit', '#sms_gateway', function(e){
  e.preventDefault();
  $.ajax({
    type: 'post'
    ,dataType: 'json'
    ,data: $(this).serialize()
    ,url: $('body').data('url')+'settings/save_sms_gateway'
    ,success: function(r){
      if(r.status == 'success'){
        sweetAlert("Good job!", r.message, "success")

      }
      else{
        sweetAlert("Oops...", r.message, "error");
      }
    } 
  });

});



$(document).on('submit', '#question_form_delete', function(e){ 
  e.preventDefault();
  $.ajax({
    type: 'post'
    ,dataType: 'json'
    ,data: $(this).serialize()
    ,url: $('body').data('url')+'users/delete'
    ,success: function(r){
      if(r.status == 'success'){
        sweetAlert("Good job!", r.message, "success")

      }
      else{
        sweetAlert("Oops...", r.message, "error");
      }
    } 
  });
});
// USER MODULE HERE







// USEGROUP MODULE HERE
$(document).on('click', '.btn_delete_usergroup', function(){
 $('#info_delete_usergroup').html('');
 var id = $(this).data('id');
 var name = $(this).data('name');
 var total = $(this).data('total');
 $('#confirm_text').text(name); 
 $('#usergroup_delete_id').val(id);
 if(total >  0){
   var append =  general_message('warning', 'This might be affect '+total+' Users and their actions');
   $('#info_delete_usergroup').append(append);

 }

});

$(document).on('submit', '#usergroup_form_delete', function(e){ 
  e.preventDefault();
  $.ajax({
    type: 'post'
    ,dataType: 'json'
    ,data: $(this).serialize()
    ,url: $('body').data('url')+'usergroup/delete'
    ,success: function(r){
      if(r.status == 'success'){
        sweetAlert("Good job!", r.message, "success")
      }
      else{
        sweetAlert("Oops...", r.message, "error");
      }
    } 
  });
});

// USEGROUP MODULE HERE






// THIS CODE WILL APPEND CHOICES ON WIZARD
$(document).on('click', '.add_choices', function(){
  $.ajax({
    type: 'post'
    ,dataType: 'json'
    ,data: {question_id: $(this).data('id'), details: $(this).parent().parent().find('.form-control').val()}
    ,url: $('body').data('url')+'api/create_choices' 
    ,success: function(r){
      if(r.status == 'success'){
        $(r.message).prependTo('#'+r.id);
        $('.add_choices').parent().parent().find('.form-control').val('');
      }
      else{
       sweetAlert("Oops...", r.message, "error");

     }
   } 
 });
});

$(document).on('click', '.delete_choices', function(){
  $.ajax({
    type: 'post'
    ,dataType: 'json'
    ,data: {id: $(this).data('id')}
    ,url: $('body').data('url')+'api/delete_choices' 
    ,success: function(r){
      if(r.status == 'success'){
        $('[data-id="choices'+r.id+'"]').detach();

      }
      else{
       sweetAlert("Oops...", r.message, "error");

     }
   } 
 });
});

$(document).on('click', '.delete_question', function(){
  if(confirm('are you sure you want to delete this question')){
    $.ajax({
      type: 'post'
      ,dataType: 'json'
      ,data: {id: $(this).data('id')}
      ,url: $('body').data('url')+'api/delete_question' 
      ,success: function(r){
        if(r.status == 'success'){
         $('[data-question-container="'+r.id+'"]').detach();

       }
       else{
         sweetAlert("Oops...", r.message, "error");

       }
     } 
   });

  }


});





// THIS CODE WILL APPEND CHOICES ON WIZARD



// THIS SECTION IS FOR CAPTCHA
// CAPTCHA
function captcha(){
  $('#captcha_container').html('');
  $.ajax({
    type: 'POST'
    ,url: $('body').data('url')+'api/captcha' 
    ,dataType: 'json'
    ,success: function(r){
      captcha_word = r.word;
      $('#captcha_container').html(r.image);
    } 
  });
}


$(document).on('click', '#captcha_reload', function(){
  captcha();
});


function insert_data_wizard(url ='',$form){
  $.ajax({
    type: 'post'
    ,dataType: 'json'
    ,data: $form.serialize()
    ,url: base_url+url
    ,success: function(r){
      if(r.status == 'success'){
        sweetAlert("Good job!", r.message, "success") 
      }
      else{
        sweetAlert("Oops...", r.message, "error");
      }
    } 
  });
}
function update_data_wizard(url ='',$form){
  $.ajax({
    type: 'post'
    ,dataType: 'json'
    ,data: $form.serialize()
    ,url: base_url+url
    ,success: function(r){
      if(r.status == 'success'){
        sweetAlert("Good job!", r.message, "success") 
      }
      else{
        sweetAlert("Oops...", r.message, "error");
      }
    } 
  });
}



function insert_data_question(url ='',$form){

  $.ajax({
    type: 'post'
    ,dataType: 'json'
    ,data: $form.serialize()
    ,url: base_url+url
    ,success: function(r){
      if(r.status == 'success'){
        sweetAlert("Good job!", r.message, "success");
        $('textarea[name="question"]').text("");
        $('textarea[name="question"]').val("");

      }
      else{
        sweetAlert("Oops...", r.message, "error");
      }
    } 
  });
}



// THIS SECTION IS FOR CAPTCHA
// CAPTCHA


// THIS SECTION IS FOR MESSAGE APPEND

function general_message(type = '', val =''){
  var message = '';
  if(type == 'error'){
    message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+val+'</div>';
  }
  else if(type == 'success'){
    message = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+val+'</div>';
  }
  else if(type == 'info'){
    message = '<div class="alert alert-info"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+val+'</div>';
  }
  else if(type == 'warning'){
    message = '<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+val+'</div>';
  }
  return message;

}


$(document).on('click',"[data-href]", function(){
  window.location = $(this).data('href');
});

 // DATA HREF

 function retrieve_file(){
  var jqxhr = $.ajax({
    type: 'POST',       
    url: base_url+'/evaluation/evaluation/retrieve_file',
    data: {id:$('input[name="id"]').val()},
    dataType: 'json',
    global: false,
    async:false,
    success: function(data) {
      return data;
    }
  }).responseText;
  return jqxhr;
}
// RETRIEVE ALL FILES UPLOADED



function allowed_filetype(){
  var jqxhr = $.ajax({
    type: 'POST',       
    url: base_url+'/api/allowed_filetype',
    global: false,
    async:false,
    success: function(data) {
      return data;
    }
  }).responseText;
  return jqxhr;
}

$(document).on('click', '.add_category', function(){
  if(confirm('are you sure you want to add this category')){
    $.ajax({
      type: 'post'
      ,dataType: 'json'
      ,data: {name: $(this).data('name'), value: $('#txt'+$(this).data('name')).val()}
      ,url: base_url+'settings/add_category'
      ,success:function(r){
        if(r.status == 'success'){
          sweetAlert("Good job!", "Successfully Added", "success");
        }
        else{
          sweetAlert("Oops...", r.message, "error");
        }
      }
    });
  }
});  


$(document).on('click', '.delete_category', function(){
  if(confirm('are you sure you want to delete this category')){
    $.ajax({
      type: 'post'
      ,dataType: 'json'
      ,data: {name: $(this).data('name'), value: $(this).data('value')}
      ,url: base_url+'settings/delete_category'
      ,success:function(r){
        if(r.status == 'success'){
          sweetAlert("Good job!", r.message, "success");
        }
        else{
          sweetAlert("Oops...", r.message, "error");
        }
      }
    });
  }


});  


// THIS FUNCTION IS FOR LOADING ALL THOSE MEMBER WHO EVALUATED
$(document).on('click', '.members_evaluation', function(){
  $('#members_container').html('');
  var append = '<table id="members_evaluation_table" class="table table-bordered table-striped" cellspacing="0" width="100%"> <thead> <tr> <th>Category</th> <th>Username</th> </tr></thead> <tbody> </tbody> </table>';
  $('#members_container').append(append);

  table = $('#members_evaluation_table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
          "url": base_url+'/evaluation/members/load_members',
          "type": "POST",
          "data" : {id:$(this).data('id')}
        },
        "columns": [
        { data: 'category', name: 'category', orderable: false, sortable: false },
        { data: 'username', name:'username', orderable: false, sortable: false },
        ],

      });
});




// THIS FUNCTION IS FOR DELETING EVALUATION
$(document).on('click', '.btn_delete_evaluation', function(){
  $('#name_delete').text($(this).data('id'));
  $('input[name="evaluation_id"]').val($(this).data('id'));
});

$(document).on('submit', '#delete_evaluation_form', function(e){
  e.preventDefault();
  if(confirm('are you sure you want to delete all data on this evaluation this could not be retrieve')){
    $.ajax({
      type: 'post'
      ,dataType: 'json'
      ,data: $(this).serialize()
      ,url: base_url+'evaluation/delete_evaluation'
      ,success:function(r){
        if(r.status =='error'){
          sweetAlert("Error", r.message, "error");
        }
        else{
         sweetAlert("Congratulations", r.message, "success");
       }
     }
   });
  }
});

// THIS FUNCTION IS FOR DELETING EVALUATION



$(document).on('click', '.done_evaluation_members', function(){
 $('#evaluated_container').html('');
 var append = '<table id="done_evaluation_members_table" class="table table-bordered table-striped" cellspacing="0" width="100%"> <thead> <tr> <th>Category</th> <th>Username</th> </tr></thead> <tbody> </tbody> </table>';
 $('#evaluated_container').append(append);
 table = $('#done_evaluation_members_table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
          "url": base_url+'/evaluation/members/load_evaluated_members',
          "type": "POST",
          "data" : {id:$(this).data('id')}
        },
        "columns": [
        { data: 'category', name: 'category', orderable: false, sortable: false },
        { data: 'username', name:'username', orderable: false, sortable: false },
        ],

      });
});

function evaluated_table(){
 if( $('#evaluated_table').length > 0){

  $('#evaluated_container').html('');
  var append = '<table id="evaluated_table" class="table table-bordered table-striped" cellspacing="0" width="100%"> <thead> <tr> <th>Category</th> <th>Username</th> </tr></thead> <tbody> </tbody> </table>';
  $('#evaluated_container').append(append);
  table = $('#evaluated_table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
          "url": base_url+'/evaluation/evaluation/user_by_category',
          "type": "POST",
          "data" : {id:$('input[name="id"]').val()}
        },
        "columns": [
        { data: 'category', name: 'category', orderable: false, sortable: false },
        { data: 'category_user', name:'category_user', orderable: false, sortable: false },
        { data: 'action', name: 'action', orderable: false, sortable: false }
        ],

      });
}
}
function table_category(){

  $('#table_category_container').html('');
  var html = ' <table class="table table-bordered table-striped" cellspacing="0" width="100%" id="table_category"> <thead> <tr> <th>Count</th> <th>Available Members</th> <th></th> </tr></thead> <tbody> </tbody> </table>';
  $('#table_category_container').append(html);
  table = $('#table_category').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
          "url": base_url+'evaluation/members/user_by_category',
          "type": "POST",
          "data" : {id:$('input[name="id"]').val()}
        },
        "columns": [
        { data: 'category', name: 'category'   },
        { data: 'category_user', name:'category_user'  },
        { data: 'action', name: 'action', orderable: false, sortable: false }
        ],

      });

}

function members_table(){

  $('#table_users_container').html('');
  var html = ' <table class="table table-bordered table-striped" cellspacing="0" width="100%" id="table_users"> <thead> <tr> <th>Category</th> <th>Username</th> <th></th> </tr></thead> <tbody> </tbody> </table>';
  $('#table_users_container').append(html);
  table = $('#table_users').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
          "url": base_url+'evaluation/members/user_by_evaluation',
          "type": "POST",
          "data" : {id:$('input[name="id"]').val()}
        },
        "columns": [
        { data: 'category', name: 'category' },
        { data: 'username', name:'username'},
        { data: 'action', name: 'action', orderable: false, sortable: false }
        ],
      });
} 


function question_list_table(){
  if($('#question_list_edit').length > 0){

    table = $('#question_list_edit').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
          "url": base_url+'evaluation/questions/get_question_list',
          "type": "POST",
          "data" : {id:$('input[name="id"]').val()}
        },
        "autoWidth": false,
        "columns": [
        { data: 'category', name: 'category' },
        { data: 'question', name:'question', width: "50%", className: "question_td"},
        { data: 'action', name: 'action', orderable: false, sortable: false }
        ],
        initComplete: function() {
          read_more();
        }
      });
  } 
}


// RATINGS DATATABLE

$(document).on('click', '.btn_ratings', function(){
  var id = $(this).data('id');

  var html = ' <table class="table table-bordered table-striped ratings_table" cellspacing="0" width="100%" id=""> <thead> <tr> <th>Username</th> <th>Rate</th> <th>Date Rated</th>  </tr></thead> <tbody> </tbody> </table>';
  $('#ratings_container').html(html);
  table = $('.ratings_table').DataTable({ 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
          "url": base_url+'evaluation/retrieve_ratings',
          "type": "POST",
          "data" : {id: $(this).data('id')}
        },
        "columns": [
        { data: 'username', name: 'username' },
        { data: 'rate', name:'rate'},
        { data: 'created_at', name:'created_at'},
        ],
      });

});




$(document).on('click', '.btn_comment', function(){
 var id = $(this).data('id');

 var html = ' <table class="table table-bordered table-striped comment_table" cellspacing="0" width="100%" id=""> <thead> <tr> <th>Username</th> <th>Comment</th> <th>Date Comment</th> </tr></thead> <tbody> </tbody> </table>';
 $('#comment_container').html(html);
 table = $('.comment_table').DataTable({ 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
          "url": base_url+'evaluation/retrieve_comments',
          "type": "POST",
          "data" : {id: $(this).data('id')}
        },
        "columns": [
        { data: 'username', name: 'username' },
        { data: 'comment', name:'comment'},
        { data: 'created_at', name:'created_at'}
        ],
      });


});

$(document).on('click', '.view_comment', function(){
 var id = $(this).data('id');

 var html = ' <table class="table table-bordered table-striped comment_table" cellspacing="0" width="100%" id=""> <thead> <tr> <th>Username</th> <th>Comment</th> <th>Date Comment</th> </tr></thead> <tbody> </tbody> </table>';
 $('#comment_container').html(html);
 table = $('.comment_table').DataTable({ 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
          "url": base_url+'browse/retrieve_comments',
          "type": "POST",
          "data" : {id: $(this).data('id')}
        },
        "columns": [
        { data: 'username', name: 'username' },
        { data: 'comment', name:'comment'},
        { data: 'created_at', name:'created_at'}
        ],
      });


});
// RATINGS DATATABLE


function summary_reports(){
  if($('#summary_graph').length > 0){
   $.ajax({
    type: 'post'
    ,dataType: 'json'
    ,data: {id: $('input[name="id"]').val()}
    ,url: base_url+'api/summary_reports'
    ,success:function(r){

      var ctx = $("#summary_graph");
      var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
          labels: ["Evaluated", "Pending"],
          datasets: [{
            backgroundColor: [
            "#2ecc71",
            "#3498db",

            ],
            data: [r.evaluated, r.authorize]
          }]
        }
      });

    }
  });

 }
}



// THIS IS FOR APPENDING GRAPHS
$(document).on('click', '.btn_graph_user', function(){

 var question =  $(this).data('question');
 var id =  $(this).data('id');
 $('#question_container_graph').html(question);
 $.ajax({
  type: 'post'
  ,dataType: 'json'
  ,data: {qid: id}
  ,url: base_url+'evaluation/reports/question_summary_graph'
  ,success:function(r){

   $('#answers_graph').html('<canvas id="graph_answers_chart" width="100%" height="80px">');
   var ctx = document.getElementById("graph_answers_chart");
   var labels = [], datas= [];

   $.each(r.answers, function(s, i){
    if(r.others > 0){
      labels.push('Others');
      datas.push(r.others);
    }
    labels.push(i.text);
    datas.push(parseInt(i.answers));
  })

   var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: labels,
      datasets: [{
        backgroundColor: [
        "#2ecc71",
        "#3498db",

        ],
        data: datas
      }]
    }
  });


 }
});



});
// THIS IS FOR APPENDING GRAPHS


// THIS IS FOR LIST OF USER WHO ANSWERS
$(document).on('click', '.users_anwers_modal', function(){
 var question =  $(this).data('qq');
 var question_id =  $(this).data('qid');
 var answer_id =  $(this).data('aid');
 var answer =  $(this).data('answer');
 

 $('#question_container, #answer_container, #question_answer').html('');
 $('#question_container').append(question);
 $('#answer_container').append(answer);

 var html = ' <table class="table table-bordered table-striped answers_users" cellspacing="0" width="100%" id=""> <thead> <tr> <th>Category</th> <th>Username</th>  </tr></thead> <tbody> </tbody> </table>';
 $('#question_answer').append(html);
 table = $('.answers_users').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
          "url": base_url+'evaluation/reports/load_evaluated_members',
          "type": "POST",
          "data" : {aid: answer_id, qid: question_id}
        },
        "columns": [
        { data: 'category', name: 'category' },
        { data: 'username', name:'username'}
        ],
      });
});

// This is FOR OTHER ANWERS

// THIS IS FOR LIST OF USER WHO ANSWERS
$(document).on('click', '.btn_other_modal', function(){
 var id =  $(this).data('qid');


 var html = '<table class="table table-bordered table-striped others_answers" cellspacing="0" width="100%" id=""> <thead> <tr> <th>Username</th> <th>Answer</th>  <th>When</th>  </tr></thead> <tbody> </tbody> </table>';
 $('#others_answer_container').append(html);
 table = $('.others_answers').DataTable({ 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
          "url": base_url+'evaluation/reports/load_other_answers',
          "type": "POST",
          "data" : {qid: id}
        },
        "columns": [
        { data: 'username', name: 'username' },
        { data: 'answers', name:'answers'},
        { data: 'created_at', name:'created_at'},
        ],
      });



});



// ADDING READMORE ON TEXT WRAP
function read_more(){
     var showChar = 50;  // How many characters are shown by default
     var ellipsestext = "...";
     var moretext = "Show more >";
     var lesstext = "Show less";

     $('.more').each(function() {
      var content = $(this).html();

      if(content.length > showChar) {

        var c = content.substr(0, showChar);
        var h = content.substr(showChar, content.length - showChar);

        var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

        $(this).html(html);
      }

    });

     $(".morelink").click(function(){
      if($(this).hasClass("less")) {
        $(this).removeClass("less");
        $(this).html(moretext);
      } else {
        $(this).addClass("less");
        $(this).html(lesstext);
      }
      $(this).parent().prev().toggle();
      $(this).prev().toggle();
      return false;
    });
   }
// ADDING READMORE ON TEXT WRAP

$(document).on('click', '.scan_qr_code', function(){
  $('#id_qr_code').attr('src', $(this).data('src'));
  loop();
});
$(document).on('click', '.login_qr_code', function(){

});
function loop() {
  $('#move-red').animate({'top': '130'}, {
    duration: 900, 
    complete: function() {
      $('#move-red').animate({top: 60}, {
        duration: 900, 
        complete: loop});
    }});
}


