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
            <div class="col-lg-12">
                <div class="panel panel-border panel-primary">
                    <div class="panel-heading"> 
                        <h3 class="panel-title">Attachments</h3> 
                    </div> 
                    <div class="panel-body"> 
                          <div class="col-md-12 portlets">
                                <!-- Your awesome content goes here -->
                                <div class="m-b-30">

                                    <form action="#" class="dropzone" id="dropzone" method="post" enctype="multipart/form-data">
                                       <input type="hidden" name="id" value="<?php echo $id; ?>">
                                      <div class="fallback">
                                        <input name="file" type="file" multiple />
                                      </div>
                                    </form>
                                </div>
                            </div>

                    </div> 
                </div>
            </div>
        </div> <!-- end row -->

    </div> <!-- container -->
</div> <!-- content -->

