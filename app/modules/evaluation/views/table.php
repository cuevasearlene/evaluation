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

          <div class="row">
            <form>
              <div class="col-lg-12">
                <div class="panel panel-default">
                  <div class="panel-body">
                    <div class="col-lg-2">
                     <div class="input-group" style="width:100%">
                       <a class="btn-lg btn waves-effect waves-light btn-primary" href="<?php echo site_url($controller.'/add'); ?>">
                        <h6 class="h6-padding-5 text-white"><i class="fa fa-plus"></i> &nbspCreate Evaluation</h6>
                      </a>
                    </div>
                  </div>
                  <div class="col-lg-2">
                   <div class="input-group" style="width:100%">
                    <select class="form-control input-lg" name="status">
                      <option value="">All</option>
                      <option value="active"  <?php echo $_GET['status'] == 'active' ? 'selected="selected"': null; ?> >Active</option>
                      <option value="inactive" <?php echo $_GET['status'] == 'inactive' ? 'selected="selected"': null; ?> >Inactive</option>
                    </select>

                  </div>
                </div>
                <div class="col-lg-2">
                  <div class="input-group" style="width:100%">
                    <?php echo form_dropdown('topics', $category, ($_GET['topics'] ? $_GET['topics'] : null), 'class="form-control input-lg"'); ?>

                  </div>
                </div>


                <div class="col-lg-6">
                  <div class="input-group">

                    <input type="text" id="example-input1-group2" name="q" class="form-control input-lg" placeholder="Enter Title, Topic, & Etc Here" value="<?php echo $_GET['q'] ? $_GET['q'] : null ;?>">
                    <span class="input-group-btn">
                      <button type="submit" class="btn-lg btn waves-effect waves-light btn-primary w-md"><i class="fa fa-filter"></i></button>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>

      </div>

      <div class="row">
        <div class="col-lg-12">
         <?php echo $this->general->flash_message(); ?>
       </div>
     <!-- <a href="<?php echo site_url($controller.'/add'); ?>">
      <div class="col-sm-6 col-lg-4">
        <div class="panel">
            <div class="panel-body">
                <div class="media-main" style="text-align:center;padding-top:20%;padding-bottom:14%">
                    <i class="fa fa-plus fa-5x"></i>
                    <br/>
                    <h4>Create Evaluation</h4>
                </div>
                <div class="clearfix"></div> 
            </div> 
        </div> 
    </div> 
  </a> -->
  <?php foreach($get_table->result() as $key => $val):++$key; ?>
    <div class="col-sm-6 col-lg-4">
      <div class="panel">
        <div class="panel-body">
          <div class="media-main">
            <div class="row">
              <div class="col-lg-10 col-xs-10 overflow-hidden">
                <h4><?php echo substr( $val->title, 0, 25); ?></h4>
              </div>
              <div class="col-lg-2 col-xs-2">
                <div class="dropdown">
                  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <i class="ion-navicon-round"></i>
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li>
                     <a href="<?php echo site_url('evaluation/edit_info/'.$val->id); ?>"> 
                       <i class="fa fa-pencil"></i> Edit
                     </a>
                   </li>
                   <li>
                    <a href="<?php echo site_url('evaluation/edit_attachment/'.$val->id); ?>">
                      <i class="fa fa-paperclip"></i> 
                      Attachment(s)
                    </a>
                  </li>
                  <li>
                    <a href="<?php echo site_url('evaluation/questions/index/'.$val->id); ?>">
                      <i class="fa fa-question"></i> Question(s)
                    </a>
                  </li>
                  <li>
                    <a href="<?php echo site_url('evaluation/members/index/'.$val->id); ?>">
                      <i class="ion-android-social"></i> Members(s)
                    </a>
                  </li>
                  <li>
                    <a href="<?php echo site_url('evaluation/reports/index/'.$val->id); ?>"> <i class="fa fa-pie-chart"></i> Report
                    </a>
                  </li>
                  <li role="separator" class="divider"></li>
                  <li><a href="#" class="btn_delete_evaluation" data-target="#delete_evaluation" data-id="<?php echo $val->id; ?>" data-toggle="modal"><i class="fa fa-trash"></i> Delete</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="info">
            <p class="text-muted" style="word-break:break-all"><?php echo substr( $val->description, 0, 150); ?>
            </p>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">

          <div class="col-lg-3 show-print-icon">
          <div class="hover-print" id="print_qr_code"><i class="fa fa-print" aria-hidden="true"></i></div>
           <img src="<?php $this->general->generate_qr($val->id, $val->id); echo MEDIA.'qr_generated/'.$val->id.'.png';?>" class="qr-small pull-left add-box-shadow">  
         </div>
         <div class="col-lg-8">
          <div class="comment-rating-container">
            <?php if($val->ratings > 0): ?>
             <button class="btn btn-link rating btn_ratings pull-left" data-target="#ratings" data-toggle="modal" data-id="<?php  echo $val->id ?>"> 
               <?php if($val->ratings <= 1 && $val->ratings >= 0): ?>
                 <span>★☆☆☆☆</span>
               <?php endif ?>
               <?php if($val->ratings <= 2 && $val->ratings >= 1.01): ?>
                <span>★★☆☆☆</span>
              <?php endif ?>
              <?php if($val->ratings <= 3 && $val->ratings >= 2.01): ?>
               <span>★★★☆☆</span>
             <?php endif ?>
             <?php if($val->ratings <= 4 && $val->ratings >= 3.01): ?>
               <span>★★★★☆</span>
             <?php endif ?>
             <?php if($val->ratings <= 5 && $val->ratings >= 4.01): ?>
               <span>★★★★★</span>
             <?php endif ?> 
             <?php echo '( '.number_format($val->ratings).' )'; ?>
           </button>
         <?php endif ?>
         <?php if($val->comment > 0): ?>
           <button class="btn btn-link btn_comment pull-left" data-target="#comments" data-toggle="modal" data-id="<?php  echo $val->id; ?>">
            <i class="fa fa-comment"></i> 
            (<?php echo number_format($val->comment); ?>)
          </button>
        <?php endif ?>

      </div>
    </div>
  </div>
</div> <!-- panel-body -->
<div class="panel-footer">
  <div class="row">
    <div class="col-sm-6">
     <label class="small"><i class="fa fa-clock-o"></i> Until: <?php echo date('M d, Y', strtotime($val->expired_at )); ?></label>
   </div>
   <div class="col-sm-6">

    <span class="badge badge-primary pull-right members_evaluation" style="font-size:12px;cursor:pointer"  data-toggle="modal" data-target="#members" data-tt="tooltip"  data-placement="bottom" title="Members" data-id="<?php echo $val->id; ?>">
      <?php echo number_format($val->authorize); ?> <i class="ion-android-social-user"></i>
    </span>
    <span class="badge badge-success pull-right done_evaluation_members" style="font-size:12px;cursor:pointer;margin-right:5px"  data-toggle="modal" data-target="#evaluated" data-tt="tooltip"  data-placement="bottom" title="Evaluated"  data-id="<?php echo $val->id; ?>">
      <?php echo number_format($val->evaluated); ?> <i class="fa fa-check"></i>
    </span>
    <?php if($val->questions < 5): ?>
      <span class="badge badge-warning  pull-right" style="font-size:12px;cursor:pointer;margin-right:5px" data-tt="tooltip"  data-placement="bottom" title="Your Question is Less Than 5 please fix this">
        <?php echo number_format($val->questions); ?> <i class="fa fa-warning"></i>
      </span>
    <?php endif ?>
  </div>
</div>
</div>
</div> <!-- panel -->
</div> <!-- end col -->
<?php endforeach; ?>




</div> <!-- End row -->

<?php echo $pagination; ?>

</div> <!-- container -->

</div> <!-- content -->



<!-- LIST RATINGS modal content -->
<div id="comments" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Comments</h4>
      </div>
      <div class="modal-body" id="comment_container">

      </div>
    </div>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

<!-- LIST RATINGS modal content -->

<!-- LIST RATINGS modal content -->
<div id="ratings" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Members Rated</h4>
      </div>
      <div class="modal-body" id="ratings_container">

      </div>
    </div>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

<!-- LIST RATINGS modal content -->


<!-- LIST EVALUATED modal content -->
<div id="evaluated" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Evaluated Members</h4>
      </div>
      <div class="modal-body" id="evaluated_container">

      </div>
    </div>
  </div><!-- /.modal-content -->
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



<!-- LIST EVALUATED modal content -->
<div id="delete_evaluation" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Warning This Can Delete Information about Evaluation</h4>
      </div>
      <div class="modal-body" >
      <form id="delete_evaluation_form" method="POST">
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. Duis aute irure dolor to 
            <b style="color:red" id="name_delete">DELETE [NAME]</b>
            <input type="hidden" name="evaluation_id">
            voluptate velit esse
            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            <input class="form-control" type="text" placeholder="Please Input Confirmation" name="confirmation" />
          </div>
          <div class="row">
           <input class="btn btn-primary pull-right" type="submit" />
         </div>
       </form>
     </div>
   </div><!-- /.modal-content -->
 </div><!-- /.modal-dialog -->

 <!-- LIST EVALUATED modal content -->

 <!-- FLOAT ADD BUTTON -->
 <a href="<?php echo site_url($controller.'/add'); ?>" class="float">
  <i class="fa fa-plus my-float"></i>
</a>
<div class="label-container">
  <div class="label-text">Create Evaluation</div>
  <i class="fa fa-play label-arrow"></i>
</div>


<style type="text/css">

	.rating > span{
		color: #e8962c;
		font-size: 14px
	}
	.btn_ratings:hover, .btn_comment:hover{
		text-decoration: none;
		opacity: .5
	}
	.btn_ratings, .btn_comment{
		box-shadow: none !important;
	}

</style>