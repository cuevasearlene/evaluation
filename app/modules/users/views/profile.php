
<div class="content">
  <div class="wraper container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="bg-picture text-center" style="background-image:url('images/big/bg.jpg')">
          <div class="bg-picture-overlay"></div>
          <div class="profile-info-name">
            <img src="http://localhost/evaluation/themes/ui/images/users/avatar-1.png" class="thumb-lg img-circle img-thumbnail" alt="profile-image">
            <h3 class="text-white"><?php echo $data->name; ?></h3>
          </div>
        </div>
        <!--/ meta -->
      </div>
    </div>
    <div class="row user-tabs">
      <div class="col-lg-6 col-md-9 col-sm-9">
        <ul class="nav nav-tabs tabs">
         <li class="active tab" > 
            <a href="#settings-2" data-toggle="tab" aria-expanded="false"> 
              <span class="visible-xs"><i class="fa fa-cog"></i></span> 
              <span class="hidden-xs">Settings</span> 
            </a>
   
          <li class="tab"> 
            <a href="#messages-2" data-toggle="tab" aria-expanded="true"> 
              <span class="visible-xs"><i class="fa fa-envelope-o"></i></span> 
              <span class="hidden-xs">Evaluation</span> 
            </a> 
          </li> 
 
          <div class="indicator"></div></ul> 
        </div>

      </div>
      <div class="row">
        <div class="col-lg-12"> 

          <div class="tab-content profile-tab-content"> 



             <div class="tab-pane active" id="settings-2">
              <!-- Personal-Information -->
              <div class="panel panel-default panel-fill">
                <div class="panel-heading"> 
                  <h3 class="panel-title">Edit Profile</h3> 
                </div> 
                <div class="panel-body"> 
                  <form class=" form-horizontal" id="user_update_form" novalidate="novalidate" method="POST" action="<?php echo site_url("users/update") ?>">

                                    <?php echo $this->general->flash_message(); ?>    
                                    <input type="hidden" name="id" value="<?php echo $data->id; ?>">
                                    <div class="form-group ">
                                        <label for="name" class="control-label col-lg-2">Name</label>
                                        <div class="col-lg-8">
                                            <input class=" form-control" id="name" name="name" type="text" required="" aria-required="true" value="<?php echo $this->session->name ? $this->session->name : $data->name; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label for="email" class="control-label col-lg-2">Email</label>
                                        <div class="col-lg-4">
                                            <input class="form-control " id="email" type="email" name="email" required="" aria-required="true" value="<?php echo $this->session->email ? $this->session->email : $data->email; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="number" class="control-label col-lg-2">Phone Number</label>
                                        <div class="col-lg-4">
                                            <input class="form-control " id="number" type="text" name="number" required="" aria-required="true" data-mask="+639999999999" value="<?php echo $this->session->number ? $this->session->number : $data->phone; ?>">
                                        </div>
                                    </div>


                                    <div class="form-group ">
                                        <label for="role" class="control-label col-lg-2">Role</label>
                                        <div class="col-lg-4">
                                             <?php echo form_dropdown('guid', $category, $this->session->guid ? $this->session->guid : $data->guid, 'class="form-control"'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label for="role" class="control-label col-lg-2">Category</label>
                                        <div class="col-lg-4">
                                             <?php echo form_dropdown('category', $user_category, $this->session->category ? $this->session->category : $data->category, 'class="form-control"'); ?>
                                        </div>
                                    </div>


                                    <div class="form-group ">
                                        <label for="username" class="control-label col-lg-2">Username</label>
                                        <div class="col-lg-8">
                                            <input class=" form-control" id="username" name="username" type="text" required="" aria-required="true" value="<?php echo $this->session->username ? $this->session->username : $data->username; ?>">
                                        </div>
                                    </div>
                                    <img src="<?php echo $this->general->generate_qr("tw", "dasd"); ?>">
                        

                                    <div class="form-group ">
                                        <label for="password" class="control-label col-lg-2">Password</label>
                                        <div class="col-lg-4">
                                            <input class="form-control " id="password" type="password" name="password" required="" aria-required="true">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="cemail" class="control-label col-lg-2">Repeat Password</label>
                                        <div class="col-lg-4">
                                            <input class="form-control " id="password_again" type="password" name="password_again" required="" aria-required="true">
                                        </div>
                                    </div>

                                    <input type="hidden" name="manual" value="1">

                                    <div class="form-group ">
                            
                                        <div class="col-lg-12">
                                            <button id="submit" class="btn btn-success waves-effect waves-light pull-right" type="submit">Submit</button>
                                        </div>
                                    </div>

                                </form>

                </div> 
              </div>
              <!-- Personal-Information -->
            </div> 

            <div class="tab-pane" id="messages-2">
              <!-- Personal-Information -->
              <div class="panel panel-default panel-fill">
                <div class="panel-heading"> 
                  <h3 class="panel-title">My Evaluation</h3> 
                </div> 
                <div class="panel-body" id="my_evaluation"> 
    
                </div> 
              </div>
              <!-- Personal-Information -->
            </div> 

          </div> 
        </div>
      </div>
    </div> <!-- container -->
    </div> <!-- content -->
  <footer class="footer text-right">
    2015 © Moltran.
  </footer>

