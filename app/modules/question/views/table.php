  <div class="content">
    <div class="container">

      <!-- Page-Title -->
      <div class="row">
       <div class="col-sm-12">
        <h4 class="pull-left page-title"><?php echo $title; ?></h4>
        <ol class="breadcrumb pull-right">
          <li><a href="<?php echo site_url(''); ?>">Home</a></li>
          <li class="active"><?php echo $title; ?></li>
        </ol>
      </div>
    </div>


    <div class="panel">

      <div class="panel-body">
        <div class="row">
          <div class="col-sm-6">
            <div class="m-b-30">
              <button id="addToTable" class="btn btn-success waves-effect waves-light modal_question" data-toggle="modal" data-target="#question_modal" data-type="Create">
                Add <i class="fa fa-plus"></i>
              </button>
            </div>
          </div>



          <form>
            <div class="col-lg-2  col-lg-offset-1">
              <div class="m-b-30">
                <div class="input-group">
                  <?php echo form_dropdown('category', $category, $_GET['category'] ?  $_GET['category'] : null, 'class="form-control"'); ?>
                  
                </div>
              </div>
            </div>
            <div class="col-lg-3">

              <div class="m-b-30">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search here" id="q" name="q" value="<?php echo $_GET['q'] ? $_GET['q'] : null;  ?>">
                  <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                  </span>
                </div>
              </div>
            </div>
          </form>
        </div>
        <?php echo $this->general->flash_message(); ?>
        <?php if($total_rows > 0): ?>
          <table class="table table-bordered table-striped " id="datatable-editable">
            <thead>
              <tr>
                <th>Category</th>
                <th>Question</th>
                <th>Created By</th>
                <th>Date Created</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tbody>
                <?php foreach($get_table->result() as $key => $val):++$key; ?>
                  <tr>
                    <td><?php echo $val->category; ?></td>
                    <td style="width:30%" class="question_td">
                      <span class="more">
                       <?php echo $val->question; ?>
                     </span>

                   </td w> 
                   <td><?php echo date('M d, Y', strtotime($val->created_at)); ?></td> 
                   <td>
                    <?php echo $val->username; ?>
                  </td>   
                  <td class="actions">
          
                   <button class="btn btn-default waves-effect waves-light btn-xs m-b-5 modal_question" data-toggle="modal" data-target="#question_modal" data-type="Edit" data-id="<?php echo $val->id; ?>">
                     <i class="ion-edit"></i> Edit</button>
                     <button class="btn btn-default waves-effect waves-light btn-xs m-b-5 modal_question_delete" data-toggle="modal" data-target="#delete_question" data-id="<?php echo $val->id; ?>"><i class="fa fa-trash"></i> Delete</button>
                   </td>
                 </tr>
               <?php endforeach; ?>
             </tbody>

           </tbody>
         </table>
       <?php endif; ?>
       <?php echo $pagination; ?>

     </div>
     <!-- end: page -->

   </div> <!-- end Panel -->

 </div> <!-- container -->

</div> <!-- content -->




<!-- CREATE QUESTION modal content -->
<div id="question_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="question_header"></h4>
      </div>
      <div class="modal-body">
        <form method="POST" id="question_form">
          <input type="hidden" name="id" id="question_id">
          <div class="form-group row">
            <label class="col-md-2 control-label" for="category">Category</label>
            <div class="col-md-8">
              <?php echo form_dropdown('category', $modal_category, '', 'class="form-control"'); ?>
            </div>
          </div>

           <div class="form-group row">
            <label class="col-md-2 control-label" for="category">Type</label>
            <div class="col-md-8">
              <?php echo form_dropdown('type', $types, '', 'class="form-control"'); ?>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-2 control-label" for="question">Question</label>
            <div class="col-md-10">
              <textarea class="form-control" rows="10" name="question" id="question_text"></textarea>
            </div>
          </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success waves-effect waves-light">Submit</button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- ADD CONFIRM DELETE modal content -->
<div id="delete_question" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Delete Question</h4>
      </div>
      <div class="modal-body">
        <form action="POST" id="question_form_delete">
          <input type="hidden" name="id" id="question_delete_id" >
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis  Please Type <b style="font-weight:normal; color:red"> FOREVER </b> tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p>
            <input class="form-control"  name="confirmation">
            <br/>
            <div id="info_delete_question"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success waves-effect waves-light confirm_delete">Submit</button>
          </form>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->