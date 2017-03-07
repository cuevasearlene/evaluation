	<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
	<script src="<?php echo THEME; ?>js/jquery.min.js"></script>
	<div class="content">
		<div class="container">
		<div class="row">
			<!-- Page-Title -->
			<div class="col-sm-12">
				<h4 class="pull-left page-title"><?php echo $title; ?></h4>
				<ol class="breadcrumb pull-right">
					<li><a href="<?php echo site_url(''); ?>">Home</a></li>
					<li class="active"><?php echo $title; ?></li>
				</ol>
			</div>
			</div>


			<div class="row">
			<div class="panel">

				<div class="panel-body">


			
		
					<?php echo $this->general->flash_message(); ?>
					<div class="clearfix">
						<form action="<?php echo site_url($controller.'/save'); ?>" id="form-table" autocomplete="off" method="post" role="form">
							<div class="form-group">
								<label for="gname" class="col-xs-2 control-label required">Group Name</label>
								<div class="col-sm-5">
									<input type="text" name="gname" id="gname" class="form-control" value="<?php echo $this->session->gname; ?>">

								</div><br/>
							</div>
							<br/>
							<div class="form-group">
								<div class="col-sm-12">
									<?php $get_module = $this->general->get_module(array('parent_id' => 0)); ?>
									<?php $role_data = json_decode($this->session->flashdata('role_data')); ?>
									<?php if($get_module->num_rows() > 0): ?>
										<script type="text/javascript">
											$(function(){
												var role_view 	= <?php echo json_encode(explode(',',$role_data->view)); ?>;
												var role_create = <?php echo json_encode(explode(',',$role_data->create)); ?>;
												var role_alter 	= <?php echo json_encode(explode(',',$role_data->alter)); ?>;
												var role_drop 	= <?php echo json_encode(explode(',',$role_data->drop)); ?>;

												$.each(role_view, function(i,v){
													$('#view_'+v).prop('checked', true);
												});
												$.each(role_create, function(i,v){
													$('#view_'+v).prop('checked', true);
													$('#create_'+v).prop('checked', true);
												});
												$.each(role_alter, function(i,v){
													$('#view_'+v).prop('checked', true);
													$('#alter_'+v).prop('checked', true);
												});
												$.each(role_drop, function(i,v){
													$('#view_'+v).prop('checked', true);
													$('#drop_'+v).prop('checked', true);
												});

												$('input:checkbox').click(function(){
													var value = $(this).val();
													if($(this).attr('name') == 'create[]' || $(this).attr('name') == 'alter[]' || $(this).attr('name') == 'drop[]'){
														if(!$('#view_'+value).is(':checked')){
															$('#view_'+value).prop('checked', true);
														}
													}
													if($(this).attr('name') == 'view[]'){
														if(!$(this).is(':checked')){
															$('#create_'+value).prop('checked', false);
															$('#alter_'+value).prop('checked', false);
															$('#drop_'+value).prop('checked', false);
														}
													}
												});
											});
										</script>
										<?php foreach($get_module->result() as $val): ?>
											<div class="module-list clearfix<?php echo ($val->parent_id == 0) ? ' main-group' : ''; ?>">
												<div class="pull-left"><?php echo $val->mod_name; ?></div>
												<div class="pull-right">
													<?php if($val->parent_id == 0): ?>

														<label for="<?php echo 'view_'.$val->modid; ?>">
															<input type="checkbox" class="tc" id="<?php echo 'view_'.$val->modid; ?>" value="<?php echo $val->modid; ?>" name="view[]">
															<span class="labels"> View</span>
														</label>

														<label for="<?php echo 'create_'.$val->modid; ?>">
															<input type="checkbox" class="tc" id="<?php echo 'create_'.$val->modid; ?>" value="<?php echo $val->modid; ?>" name="create[]">
															<span class="labels"> Create</span>
														</label>

														<label for="<?php echo 'alter_'.$val->modid; ?>">
															<input type="checkbox" class="tc" id="<?php echo 'alter_'.$val->modid; ?>" value="<?php echo $val->modid; ?>" name="alter[]">
															<span class="labels"> Edit</span>
														</label>

														<label for="<?php echo 'drop_'.$val->modid; ?>">
															<input type="checkbox" class="tc" id="<?php echo 'drop_'.$val->modid; ?>" value="<?php echo $val->modid; ?>" name="drop[]">
															<span class="labels"> Delete</span>
														</label>
													<?php endif; ?>
												</div>
											</div>
											<?php $get_sub_module = $this->general->get_module(array('parent_id' => $val->modid)); ?>
											<?php if($get_sub_module->num_rows() > 0): ?>
												<?php foreach($get_sub_module->result() as $value): ?>
													<div class="module-list sub clearfix">
														<div class="pull-left"><?php echo $value->mod_name; ?></div>
														<div class="pull-right inline">
															<label for="<?php echo 'view_'.$value->modid; ?>">
																<input type="checkbox" class="tc" id="<?php echo 'view_'.$value->modid; ?>" value="<?php echo $value->modid; ?>" name="view[]">
																<span class="labels"> View</span>
															</label>

															<label for="<?php echo 'create_'.$value->modid; ?>">
																<input type="checkbox" class="tc" id="<?php echo 'create_'.$value->modid; ?>" value="<?php echo $value->modid; ?>" name="create[]">
																<span class="labels"> Create</span>
															</label>

															<label for="<?php echo 'alter_'.$value->modid; ?>">
																<input type="checkbox" class="tc" id="<?php echo 'alter_'.$value->modid; ?>" value="<?php echo $value->modid; ?>" name="alter[]">
																<span class="labels"> Edit</span>
															</label>

															<label for="<?php echo 'drop_'.$value->modid; ?>">
																<input type="checkbox" class="tc" id="<?php echo 'drop_'.$value->modid; ?>" value="<?php echo $value->modid; ?>" name="drop[]">
																<span class="labels"> Delete</span>
															</label>
														</div>
													</div>
												<?php endforeach; ?>
											<?php endif; ?>
										<?php endforeach; ?>
									<?php endif; ?>
								</div>
							</div>

							<div class="form-group" >
								<div class="col-sm-12">
									<br/>
									<?php if($this->general->mod_access('user_group', 'create')): ?>
										<input type="submit" value="Save" class="btn btn-primary pull-right">
									<?php endif ?>
								</div>
							</div>
						</form>
					</div>
					<script type="text/javascript">
						$(document).on('change', '.main-group input[name="view[]"]', function(){
			// alert('change');
			if(!$(this).is(':checked')){
				$(this).closest('.module_group').find('input').prop('checked', false);
			}

		});
	</script>



</div> <!-- container -->

</div> <!-- content -->
</div>
</div>
</div>
