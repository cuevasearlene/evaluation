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
            <div class="col-lg-8 col-lg-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                            <h3 class="panel-title">Basic Information</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="POST" novalidate="novalidate" id="basicform" >
                            <div class="form-group">
                              
                               <div class="row">
                                 <div class="col-lg-8">
                                  <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                       <div class="row">
                        <div class="col-lg-4">
                             <label for="category">Category</label>
                        <?php echo form_dropdown('category', $category, $this->session->category ? $this->session->category : null, 'class="form-control"'); ?>
                    
                       </div>  
                   </div>
               </div>

               <div class="form-group">
               <div class="row">
                <div class="col-lg-10">
                         <label for="description">Description</label>
                   <textarea type="text" class="form-control" id="description" name="description" rows="8">
                   </textarea>
               </div>  
           </div>
       </div>

       <div class="form-group">
       <div class="row">
        <div class="col-lg-4">
         <label for="size">Page Size</label>
           <input type="text" class="form-control" name="page" id="page" min="0">
               </div>  
           </div>
        </div>

        <div class="form-group">

        <div class="row">
            <div class="col-lg-5">
              <label for="date">Expired at</label>
               <input type="text" class="form-control datepicker" name="expired_at" id="date" >
           </div>  
        </div>
        </div>
        <button type="submit" class="btn btn-primary waves-effect waves-light pull-right ">Submit</button>
        </form>
        </div><!-- panel-body -->
        </div>
        </div>
        </div>
        </div>
        </div>
