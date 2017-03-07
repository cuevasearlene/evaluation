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
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading"> 
                        <h3 class="panel-title">Allowed FileType</h3> 
                    </div>

                    <div class="panel-body"> 
                      <ul class="list-unstyled" id="filetype">
                        <?php $res = explode(',', $filetype); ?>
                        <?php for ($i=0; $i < sizeof($res); $i++): ?>
                            <li><button class="btn btn-default waves-effect waves-light btn-xs m-b-5 delete_category" data-name="filetype" data-value="<?php echo $res[$i]; ?>"><i class="fa fa-times"></i></button> <?php echo $res[$i]; ?></li>
                        <?php endfor; ?>
                    </ul>
                    <div class="input-group"> 
                        <input type="text"  class="form-control" placeholder="FileType" id="txtfiletype"> 
                        <span class="input-group-btn"> 
                           <button type="button" class="btn waves-effect waves-light btn-primary add_category" data-name="filetype">Submit</button> 
                       </span> 
                   </div>
               </div> 
           </div>
       </div>

       <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading"> 
                <h3 class="panel-title">User Category</h3> 
            </div>

            <div class="panel-body"> 


              <ul class="list-unstyled" id="user">
                <?php $res = explode(',', $user); ?>
                <?php for ($i=0; $i < sizeof($res); $i++): ?>
                    <li><button class="btn btn-default waves-effect waves-light btn-xs m-b-5 delete_category" data-name="user" data-value="<?php echo $res[$i]; ?>"><i class="fa fa-times"></i></button> <?php echo $res[$i]; ?></li>
                <?php endfor; ?>
            </ul>
            <div class="input-group"> 
                <input type="text" class="form-control" placeholder="User" id="txtuser"> 
                <span class="input-group-btn"> 
                 <button type="button" class="btn waves-effect waves-light btn-primary add_category" data-name="user">Submit</button> 
             </span> 
          </div>

     </div> 
 </div>
</div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading"> 
                <h3 class="panel-title">Topic Category</h3> 
            </div>

            <div class="panel-body"> 

              <ul class="list-unstyled" id="topic">
                <?php $res = explode(',', $topic); ?>
                <?php for ($i=0; $i < sizeof($res); $i++): ?>
                    <li><button class="btn btn-default waves-effect waves-light btn-xs m-b-5 delete_category" data-name="topic" data-value="<?php echo $res[$i]; ?>"><i class="fa fa-times"></i></button> <?php echo $res[$i]; ?></li>
                <?php endfor; ?>
            </ul>
              <div class="input-group"> 
                <input type="text"  class="form-control" placeholder="Topic" id="txttopic"> 
                <span class="input-group-btn"> 
                 <button type="button" class="btn waves-effect waves-light btn-primary add_category" data-name="topic">Submit</button> 
             </span> 
           </div>

        </div> 
    </div>
</div>

<div class="col-lg-6">
    <div class="panel panel-default">
        <div class="panel-heading"> 
            <h3 class="panel-title">Question Category</h3> 
        </div>

        <div class="panel-body"> 

          <ul class="list-unstyled" id="question">
              <?php $res = explode(',', $question); ?>
              <?php for ($i=0; $i < sizeof($res); $i++): ?>
                <li><button class="btn btn-default waves-effect waves-light btn-xs m-b-5 delete_category" data-name="question" data-value="<?php echo $res[$i]; ?>"><i class="fa fa-times"></i></button> <?php echo $res[$i]; ?></li>

            <?php endfor; ?>
        </ul>
           <div class="input-group"> 
                <input type="text" class="form-control" placeholder="Question" id="txtquestion"> 
                <span class="input-group-btn"> 
                 <button type="button" class="btn waves-effect waves-light btn-primary add_category" data-name="question">Submit</button> 
             </span> 
           </div>

    </div> 
</div>
</div>

<div class="col-lg-6">
    <div class="panel panel-default">
        <div class="panel-heading"> 
            <h3 class="panel-title">SMS Gateway me</h3> 
        </div>

        <div class="panel-body"> 
        <form id="sms_gateway">
            <div class="col-lg-5">
              <label for="title">Device ID</label>
                <input type="text" class="form-control " id="device_id" name="device_id" value="<?php echo $sms->device_id; ?>">
            </div>

           <div class="col-lg-9">
              <label for="title">Email</label>
                <input type="email" class="form-control"  name="email" value="<?php echo $sms->email; ?>">
            </div>

            <div class="col-lg-9">
              <label for="title">Password</label>
                <input type="password" class="form-control " name="password" value="">
            </div>

            <div class="col-lg-12">
               <br/>    <br/>
             <input class="btn btn-primary pull-right" value="Submit" type="submit" />
             </div>
            </form>
       </div> 


</div>
</div>
</div>



<!-- end row -->

</div> <!-- container -->

                </div> <!-- content -->