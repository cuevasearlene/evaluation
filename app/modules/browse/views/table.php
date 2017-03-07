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
                        <div class="col-lg-3">
                            <div class="input-group" style="width:100%">
                                <?php echo form_dropdown('topics', $category, ($_GET['topics'] ? $_GET['topics'] : null), 'class="form-control input-lg"'); ?>

                            </div>
                        </div>


                        <div class="col-lg-9">
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
       <?php foreach($get_table->result() as $key => $val):++$key; ?>
        <div class="col-sm-6 col-lg-4">
            <div class="panel add-border-top">
                <div class="panel-heading bg-blue view-panel-header">
                    <h4 class="panel-title text-white"><?php echo $val->category; ?></h4>
                </div>
                <div class="panel-body panel-less-padding">
                    <div class="media-main remove-padding-top">

                     <div class="info">
                        <h5 class="text-blue"><?php echo $val->title; ?></h5>
                        <p class="text-muted text-grey" style="word-break:break-all"><?php echo substr( $val->description, 0, 150); ?>
                        </p>
                    </div>
                    <!-- <div class="row">                    
                        <div class="dropdown pull-left ">
                          <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <i class="icon ion-qr-scanner"></i>
                            Scan qr code
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                         <li>
                             <img src="<?php $this->general->generate_qr($val->id, $val->id); echo MEDIA.'qr_generated/'.$val->id.'.png';?>" class="qr-small pull-left"> 
                         </li>
                     </ul>
                 </div>

             </div> -->
         </div>
         <div class="clearfix"></div> 

    </div> <!-- panel-body -->
    <div class="panel-footer footer-border bg-white">
        <div class="row">
            <div class="col-sm-5">
             <label class="small tiny"><i class="fa fa-clock-o"></i> Until: <?php echo date('M d, Y', strtotime($val->expired_at )); ?></label>
         </div>
         <div class="col-sm-7">
            <span class="badge add-padding-x badge-success pull-right view_comment" style="font-size:11px;cursor:pointer;margin-right:5px"  data-toggle="modal" data-target="#comments" data-tt="tooltip"  data-placement="bottom" title="View comments"  data-id="<?php echo $val->id; ?>">
            <i class="ion-chatbox-working"></i>&nbspcomments
            </span>
            <span class="badge add-padding-x badge-primary pull-right scan_qr_code" style="font-size:11px;cursor:pointer;margin-right:5px"  data-toggle="modal" data-target="#qrcode" data-tt="tooltip" data-src="<?php $this->general->generate_qr($val->id, $val->id); echo MEDIA.'qr_generated/'.$val->id.'.png';?>" data-placement="bottom" title="Scan qr code" data-id="<?php echo $val->id; ?>">
                <i class="ion-qr-scanner"></i>&nbspcode
            </span>
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




<!-- LIST EVALUATED modal content -->
<div id="qrcode" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content modal-qr-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Scan with your camera</h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8">
                <img id="id_qr_code" src="" class="resposive qr-medium">
            </div>
            <div class="col-lg-2"></div>         
        </div>
        <h5>Demo</h5>
        <div class="row add-margin-top">

             <div class="col-lg-2"></div>
            <div class="col-lg-8">
                <img class="img-responsive" src="<?php echo THEME; ?>images/qr-demo.png"/>
                <div class="scanning-demo" id="move-red"></div>
            </div>
            <div class="col-lg-2"></div>
        </div>
    </div>
</div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

<div id="qrcode_login" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content modal-qr-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Scan to login</h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8">
                <img src="<?php $this->general->generate_qr("login", "cuevas.badillo.evalapp"); echo MEDIA.'qr_generated/'.$val->id.'.png';?>" class="resposive qr-medium">
            </div>
            <div class="col-lg-2"></div>         
        </div>     
    </div>
</div>
</div><!-- /.modal-content -->
</div>
<!-- LIST EVALUATED modal content -->


<!-- LIST EVALUATED modal content -->
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


<!-- LIST EVALUATED modal content -->


<!-- FLOAT ADD BUTTON -->
