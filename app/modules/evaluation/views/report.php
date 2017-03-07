	 	 <div class="content">
	 	 	<div class="container">
	 	 		<!-- Page-Title -->
	 	 		<div class="row">
	 	 			<div class="col-sm-12">
	 	 				<h4 class="pull-left page-title"><?php echo $title; ?></h4>
	 	 				<ol class="breadcrumb pull-right">
	 	 					<li><a href="<?php echo site_url(''); ?>">Home</a></li>
	 	 					<li><a href="<?php echo site_url($controller); ?>"><?php echo ucfirst($controller); ?></a></li>
	 	 					<li class="active"><?php echo $title; ?></li>

	 	 				</ol>
	 	 			</div>
	 	 		</div>
	 	 		<div class="row">
	 	 			<div class="col-lg-8">
	 	 				<div class="panel panel-default">
	 	 					<div class="panel-heading"  > 
	 	 						<div class="row">
	 	 							<div class="col-lg-6">
	 	 								<h3 class="panel-title" id="btn">Questions</h3> 
	 	 							</div>
	 	 							<div class="col-lg-6">
	 	 								<button class="btn btn-default btn_print pull-right">
	 	 									<i class="fa fa-print"></i>
	 	 								</button>
	 	 							</div>
	 	 						</div> 
	 	 					</div>
	 	 					<div class="panel-body" id="print_area">
	 	 						<input type="hidden" name="id" value="<?php echo $id; ?>">
	 	 						<div class="row">
	 	 							<ol>
	 	 								<?php foreach ($questions->result() as $vals): ?>


	 	 									<li style="word-break:break-all"><?php echo $vals->question; ?></li>



	 	 									<?php 

	 	 									$custom = array('single_custom', 'multiple_custom');
	 	 									$this->db->group_by('question_id');
	 	 									$response = $this->general->get_table('evaluation_summary', array('question_id' => $vals->id), 'COUNT(1) as "total_res"')->row()->total_res;

	 	 									if(in_array($vals->type, $custom)){
	 	 										$other_answers = $this->general->get_table('evaluation_summary_other', array('question_id' => $vals->id), 'id')->num_rows();
	 	 										$response = $response + $other_answers;
	 	 									}

	 	 									?>
	 	 									<?php $this->db->join('(SELECT count(1) as answer, es.answer_id from evaluation_summary as es group by es.answer_id) as temp', 'temp.answer_id = qc.id','right'); ?>
	 	 									<?php $choices = $this->general->get_table('question_choices as qc', array('question_eval_id' => $vals->id), 'qc.text, temp.answer, qc.id'); ?>

	 	 									<br/>
	 	 									<table class="table table-bordered table-answer">
	 	 										<thead>
	 	 											<tr>
	 	 												<th>Answer Choices</th>
	 	 												<th>Reponse 
	 	 													<button class="btn btn-default btn-xs pull-right btn_graph_user"  style="font-size:8px" data-target="#graph_answers" data-toggle="modal" data-id="<?php echo $vals->id; ?>" data-question="<?php echo $vals->question; ?>">
	 	 														<i class="fa fa-line-chart"> </i></button
	 	 														></th>
	 	 													</tr>
	 	 												</thead>
	 	 												<tbody>
	 	 										         			<?php  
	 	 										         			
	 	 										         			$size = $choices->num_rows();
	 	 										         			$i = 0;
	 	 										         			 ?>
	 	 													<?php foreach ($choices->result() as $val): ?>
	 	 														<tr>
	 	 															<td>
	 	 																<button class="btn btn-default btn-xs users_anwers_modal" data-target="#answers_users" data-toggle="modal" style="font-size:8px" data-answer="<?php echo $val->text; ?>" data-qq="<?php echo $vals->question; ?>" data-qid="<?php echo $vals->id; ?>" data-aid="<?php echo $val->id; ?>"><i class="ion-chevron-down" style="margin-right:4%"></i></button>  <?php echo $val->text; ?></td>
	 	 																<td>
	 	 																	<span class="pull-left">
	 	 																		<strong>

	 	 																			<?php echo number_format(($val->answer > 0 ? ($val->answer / $response) * 100: null), 2); ?> %
	 	 																		</strong>
	 	 																	</span>
	 	 																	<span  class="pull-right">
	 	 																		<?php echo $val->answer;$i++; ?>
	 	 																	</span>

	 	 																</td>
	 	 															</tr>

	 	 															<?php if($i == $size): ?>
	 	 																<?php

	 	 																if(in_array($vals->type, $custom)): ?>
	 	 																	<?php  
	 	 																	$others = $this->general->get_table('evaluation_summary_other', array('question_id' => $vals->id), 'id')->num_rows(); 

	 	 																	?>
	 	 																	<?php  if($others > 0): 	?>
	 	 																		<tr> 
	 	 																			<td>
	 	 																				<button class="btn btn-default btn-xs btn_other_modal" data-target="#others_answers" data-toggle="modal" style="font-size:8px" data-qid="<?php echo $vals->id; ?>"><i class="ion-chevron-down" style="margin-right:4%"></i></button> 
	 	 																				Others
	 	 																			</td>
	 	 																	
 	 																				<td>
 	 																					<span class="pull-left">
 	 																						<strong>
 	 																							<?php echo number_format(($others > 0 ? ($others / $response) * 100: null), 2); ?> %
 	 																						</strong>
 	 																					</span>
 	 																					<span  class="pull-right">
 	 																					<?php echo $others; ?>
 	 																					</span>

 	 																				</td>
	 	 																		</tr>
	 	 																	<?php  endif; ?>
	 	 																<?php  endif; ?>
	 	 															<?php  endif; ?>
	 	 														<?php endforeach; ?>

	 	 													
	 	 													</tbody>
	 	 													<tfoot>
	 	 														<tr>
	 	 															<th>Total</th>
	 	 															<th style="text-align:right"><?php echo number_format($response); ?></th>

	 	 														</tr>
	 	 													</tfoot>
	 	 												</table>



	 	 												<br/>

	 	 											<?php endforeach ?>
	 	 										</ol>
	 	 									</div>
	 	 								</div>
	 	 							</div>
	 	 						</div>
	 	 						<style type="text/css">
	 	 							ol{
	 	 								padding-right: 30px
	 	 							}
	 	 							table.table-answer tbody th, table.table-answer tbody td,  table.table-answer thead td,  table.table-answer thead th{
	 	 								padding:5px;
	 	 								font-size:11px;

	 	 							}

	 	 							table.table-answer thead th, table.table-answer tfoot th{
	 	 								background:  #eee;
	 	 								font-size:11px;
	 	 								padding:5px;
	 	 							}
	 	 							table.table-answer{
	 	 								width: 100%
	 	 							}
	 	 						</style>

	 	 						<div class="col-lg-4">
	 	 							<div class="panel panel-default">
	 	 								<div class="panel-heading"> 
	 	 									<h3 class="panel-title">Sumary Reports</h3> 
	 	 								</div> 
	 	 								<div class="panel-body">

	 	 									<input type="hidden" name="id" value="<?php echo $id; ?>">
	 	 									<div class="col-md-12">
	 	 								
	 	 										<br/>
	 	 										<canvas id="summary_graph" width="100%" height="100px">

	 	 										</canvas>
	 	 												<div class="tiles-progress">
	 	 											<div class="m-t-20">
	 	 												<h5 class="text-uppercase">Evaluated <span class="pull-right"><?php echo number_format($sum->evaluated); ?> of <?php echo number_format($sum->evaluated + $sum->authorize); ?></span></h5>
	 	 												<?php $total = $sum->evaluated  / ($sum->evaluated + $sum->authorize) * 100;  ?>
	 	 												<div class="progress progress-sm m-0">
	 	 													<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $total; ?>%;">
	 	 														<span class="sr-only">60% Complete</span>
	 	 													</div>
	 	 												</div>
	 	 											</div>
	 	 										</div>
	 	 										<br/>
	 	 										<h5>Rating</h5>
	 	 										<table class="table table-bordered table-responsive table-striped table-answer">
	 	 											<tbody>
	 	 												<tr>
	 	 													<th>Campaign Start</th>
	 	 													<td>:</td>
	 	 													<td><?php echo date('F d, Y', strtotime($sum->created_at)); ?></td>
	 	 												</tr>
	 	 												<tr>
	 	 													<th>End At</th>
	 	 													<td>:</td>
	 	 													<td><?php echo date('F d, Y', strtotime($sum->expired_at)); ?></td>
	 	 												</tr>
	 	 												<tr>
	 	 													<th>Evaluted</th>
	 	 													<td>:</td>
	 	 													<td><?php echo number_format($sum->evaluated); ?></td>
	 	 												</tr>
	 	 												<tr>
	 	 													<th>Pending</th>
	 	 													<td>:</td>
	 	 													<td><?php echo number_format($sum->authorize); ?></td>
	 	 												</tr>
	 	 												<tr>
	 	 													<th>Total</th>
	 	 													<td>:</td>
	 	 													<td><?php echo number_format($sum->evaluated + $sum->authorize); ?></td>
	 	 												</tr>
	 	 											</tbody>
	 	 										</table>


	 	 									</div>
	 	 								</div>
	 	 							</div> 
	 	 						</div>
	 	 					</div> <!-- end row -->
	 	 				</div> <!-- container -->
	 	 			</div> <!-- content -->




	 	 			<!-- LIST GRAPH -->
	 	 			<div id="graph_answers" class="modal fade" tabindex="-1" role="dialog" >
	 	 				<div class="modal-dialog">
	 	 					<div class="modal-content p-0 b-0">
	 	 						<div class="panel panel-color panel-primary">
	 	 							<div class="panel-heading"> 
	 	 								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
	 	 								<h3 class="panel-title">List of Person Answered</h3> 
	 	 							</div> 
	 	 							<div class="panel-body" > 
	 	 								<div class="col-md-12" style="margin-bottom:5%">
	 	 								<p id="question_container_graph" style="word-break:break-all;"></p> 
	 	 								<strong id="questions_graph"></strong>
	 	 								</div>
	 	 								<div id="answers_graph">
	 	 											
	 	 								</div>
	 	 							</div> 
	 	 						</div>
	 	 					</div><!-- /.modal-content -->
	 	 				</div><!-- /.modal-dialog -->
	 	 			</div><!-- /.modal-dialog -->


	 	 			<!-- LIST EVALUATED modal content -->
	 	 			<div id="answers_users" class="modal fade" tabindex="-1" role="dialog" >
	 	 				<div class="modal-dialog">
	 	 					<div class="modal-content p-0 b-0">
	 	 						<div class="panel panel-color panel-primary">
	 	 							<div class="panel-heading"> 
	 	 								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
	 	 								<h3 class="panel-title">List of Person Answered</h3> 
	 	 							</div> 
	 	 							<div class="panel-body" > 
	 	 								<div class="col-md-12" style="margin-bottom:5%">
	 	 								<p id="question_container" style="word-break:break-all;"></p> 
	 	 								<strong id="answer_container"></strong>
	 	 								</div>
	 	 								<div id="question_answer">
	 	 									
	 	 								</div>
	 	 							</div> 
	 	 						</div>
	 	 					</div><!-- /.modal-content -->
	 	 				</div><!-- /.modal-dialog -->
	 	 			</div><!-- /.modal-dialog -->


	 	 				 			<!-- LIST EVALUATED modal content -->
	 	 			<div id="others_answers" class="modal fade" tabindex="-1" role="dialog" >
	 	 				<div class="modal-dialog">
	 	 					<div class="modal-content p-0 b-0">
	 	 						<div class="panel panel-color panel-primary">
	 	 							<div class="panel-heading"> 
	 	 								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
	 	 								<h3 class="panel-title">Other Answers</h3> 
	 	 							</div> 
	 	 							<div class="panel-body" > 
	 	 						
	 	 								<div id="others_answer_container">
	 	 									
	 	 								</div>
	 	 							</div> 
	 	 						</div>
	 	 					</div><!-- /.modal-content -->
	 	 				</div><!-- /.modal-dialog -->
	 	 			</div><!-- /.modal-dialog -->

	 	 			<!-- LIST EVALUATED modal content -->


	 	 			<!-- LIST EVALUATED modal content -->
	 	 			<div id="members" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	 	 				<div class="modal-dialog">
	 	 					<div class="modal-content">
	 	 						<div class="modal-header">
	 	 							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	 	 							<h4 class="modal-title" id="myModalLabel">Members</h4>
	 	 						</div>
	 	 						<div class="modal-body" id="members_container">

	 	 						</div>
	 	 					</div>
	 	 				</div><!-- /.modal-content -->
	 	 			</div><!-- /.modal-dialog -->

<!-- LIST EVALUATED modal content -->