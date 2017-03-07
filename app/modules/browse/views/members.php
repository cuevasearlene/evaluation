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
            <input type="hidden" value="<?php echo $id; ?>" name="id" id="id">
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading"> 
                        <h3 class="panel-title">Members By Name</h3> 
                    </div> 
                    <div class="panel-body"> 
                      <div class="col-md-12" id="table_users_container">
                     
                    </div>
                </div> 
            </div>

        </div>
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading"> 
                    <h3 class="panel-title">Members By Group</h3> 
                </div> 
                <div class="panel-body"> 
                  <div class="col-md-12" id="table_category_container">
                
                </div>
            </div> 
        </div>
    </div> <!-- end row -->

</div> <!-- container -->
</div> <!-- content -->
</div>