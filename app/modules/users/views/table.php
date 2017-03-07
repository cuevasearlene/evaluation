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


            <div class="col-sm-5">
              <div class="m-b-30">
                <a href="<?php echo site_url('users/add'); ?>" class="btn btn-success waves-effect waves-light">Add <i class="fa fa-plus"></i></a>
              </div>
            </div>
            <form>
              <div class="col-lg-2 ">
                <div class="m-b-30">
                  <div class="input-group">
                    <select class="form-control" name="status">
                      <option value="all">All</option>
                      <option value="active" <?php echo $_GET['status'] && $_GET['status'] == 'active' ? 'selected="selected"' : null; ?>>Active</option>
                      <option value="not" <?php echo $_GET['status'] && $_GET['status'] == 'not' ? 'selected="selected"' : null; ?>> Not Active</option>
                    </select>

                  </div>
                </div>
              </div>
              <div class="col-lg-2">
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

            <table class="table table-bordered table-striped" id="datatable-editable">
              <thead>
                <tr>
                  <th>Role</th>
                  <th>Username</th>
                  <th>Phone Number</th>
                  <th>Status</th>
                  <th>Created at</th>
                  <th></th>

                </tr>
              </thead>
              <tbody>
               <tbody>
                <?php foreach($get_table->result() as $key => $val):++$key; ?>
                  <tr>
                    <td><?php echo $val->gname; ?></td>
                    <td><?php echo $val->username; ?></td>


                    <td>
                      <?php echo $val->phone; ?>
                    </td>   
                    <td>
                      <?php 
                      $res = '';
                      if($val->guid == 1){
                       $res = '<span class="label label-primary">Active</span>';
                     }
                     else{
                      if($val->verification_code == null || $val->verification_code == ''){
                       $res = '<span class="label label-primary">Active</span>';
                     }
                     else{
                       $res = '<span class="label label-warning">Not Activated</span>';
                     }
                   }
                   echo $res;
                   ?>
                 </td>
                 <td><?php echo date('M d, Y', strtotime($val->created_at)); ?></td> 
                 <td class="actions">
                 
                    <button class="btn btn-default waves-effect waves-light btn-xs m-b-5" data-href="<?php echo site_url('users/edit/').'/'.$val->id; ?>">
                     <i class="ion-edit"></i> Edit</button>
                     <button class="btn btn-default waves-effect waves-light btn-xs m-b-5 delete_user_modal" data-toggle="modal" data-target="#delete_user" data-id="<?php echo $val->id; ?>" data-username="<?php echo $val->username; ?>"><i class="fa fa-trash"></i> Delete</button>
                   </td>
                 </tr>
               <?php endforeach; ?>
             </tbody>

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




<!-- ADD CONFIRM DELETE modal content -->
<div id="delete_user" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Delete User</h4>
      </div>
      <div class="modal-body">
        <form action="POST" id="question_form_delete">
          <input type="hidden" name="id" id="user_delete_id" >
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis  Please Type <b style="font-weight:normal; color:red" id="delete_confirmation"> FOREVER </b> tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p>
            <input class="form-control"  name="confirmation">
            <br/>
            <div id="info_delete_user"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success waves-effect waves-light confirm_delete">Submit</button>
          </form>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->