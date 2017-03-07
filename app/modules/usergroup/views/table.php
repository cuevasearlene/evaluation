<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


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
							<a href="<?php echo site_url('usergroup/add'); ?>" class="btn btn-success waves-effect waves-light">Add <i class="fa fa-plus"></i></a>
						</div>
					</div>
				</div>
				<?php echo $this->general->flash_message(); ?>

				<div class="clearfix">
					<?php if($get_table && $get_table->num_rows() > 0): ?>
						<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Deleting User Group can cause serious problem to other table!</div>
							<table class="table table-bordered table-responsive">
								<thead>
									<tr>

										<th style="width: 5%;" rowspan="2">#</th>
										<th style="width: 10%;"  rowspan="2">Group Name</th>
										<th style="width: 10%;" class="text-center" rowspan="2">Total User</th>
										<th class="text-center" colspan="4">Module</th>
										<th></th>
									</tr>
									<tr>
										<th style="width:5%;" class="text-center">View</th>
										<th style="width:5%;" class="text-center">Create</th>
										<th style="width:5%;" class="text-center">Edit</th>
										<th style="width:5%;" class="text-center">Delete</th>
										<th style="width:10%">Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($get_table->result() as $key => $val):++$key; ?>
										<?php $role = json_decode($val->role); ?>
										<tr>
											<td><?php echo $offset+$key; ?></td>
											<td><?php echo $val->gname; ?></td>
											<td class="text-center">
												<?php $total_user = num_format($this->general->get_table('users', array('guid' => $val->guid), 'COUNT(*) AS total_data')->row()->total_data);echo $total_user;  ?>
											</td>
											<td class="text-center"><?php echo count(array_filter(explode(',', $role->view))); ?></td>
											<td class="text-center"><?php echo count(array_filter(explode(',', $role->create))); ?></td>
											<td class="text-center"><?php echo count(array_filter(explode(',', $role->alter))); ?></td>
											<td class="text-center"><?php echo count(array_filter(explode(',', $role->drop))); ?></td>
											<td>
												<?php if($this->general->mod_access('user_group', 'alter') && ($get_table && $get_table->num_rows() > 0)): ?>
													<a class="btn btn-default waves-effect waves-light btn-xs m-b-5" href="<?php echo site_url($controller.'/edit/'.$val->guid); ?>"  >
                  									<i class="ion-edit"></i> Edit</a>
												<?php endif; ?>
												<?php if($this->general->mod_access('user_group', 'drop') && ($get_table && $get_table->num_rows() > 0)): ?>
													<button class="btn btn-default waves-effect waves-light btn-xs m-b-5 btn_delete_usergroup"  data-name="<?php echo $val->gname; ?>" data-id="<?php echo $val->guid; ?>" data-target="#delete_usegroup" data-toggle="modal" data-total="<?php echo $total_user; ?>">
                  									<i class="fa fa-trash"></i> Delete</button>
												
												<?php endif; ?>
											</td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
					
					<?php else: ?>
						<div class="alert alert-danger">Data belum tersedia</div>
					<?php endif; ?>
				</div>

				<?php if($get_table && $total_row > $get_table->num_rows()): ?>
					<div class="clearfix">
						<div class="pagination-info">
							Showing <?php echo ($offset) ? $offset+1 : 1; ?> to 
							<?php echo ($offset) ? $offset+$get_table->num_rows() : $get_table->num_rows(); ?> of 
							<?php echo $total_row; ?> entries
						</div>
						<div class="dataTables_paginate paging_bootstrap pull-right">
							<?php echo $pagination; ?>
						</div>
					</div>
				<?php endif; ?>
			</div>
			<!-- end: page -->

		</div> <!-- end Panel -->

	</div> <!-- container -->
	
</div> <!-- content -->



<!-- ADD CONFIRM DELETE modal content -->
<div id="delete_usegroup" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Delete User Group</h4>
      </div>
      <div class="modal-body">
      <form action="POST" id="usergroup_form_delete">
        <input type="hidden" name="id" id="usergroup_delete_id" >
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
          quis  Please Type <b style="font-weight:normal; color:red" id="confirm_text"> FOREVER </b> tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p>
          <input class="form-control"  name="confirmation">
          <br/>
          <div id="info_delete_usergroup"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success waves-effect waves-light ">Submit</button>
          </form>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
