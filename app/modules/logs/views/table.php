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
                                    
                                </div>
                                <table class="table table-bordered table-striped" id="datatable-editable">
                                    <thead>
                                        <tr>
                                            <th>Role</th>
                                            <th>Username</th>
                                            <th>Phone Number</th>
                                            <th>Email</th>
                                            <th>Tags</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="gradeX">
                                            <td>Admin</td>
                                            <td>johnenrico</td>
                                            <td>+63933188537</td>
                                            <td>johnenricocomia@yahoo.com</td> 
                                            <td>
                                                 <span class="label label-primary">Cvsu Users</span>
                                                 <span class="label label-primary">Random People</span>
                                            </td> 
                                             <td>
                                                 <span class="label label-warning">Unverified</span>
                                            
                                            </td>   
                                            <td class="actions">
                                               <button class="btn btn-default waves-effect waves-light btn-xs m-b-5">
                                               <i class="fa fa-pencil"></i> Edit</button>

                                              <button class="btn btn-default waves-effect waves-light btn-xs m-b-5"><i class="fa fa-tags"></i> Tags</button>

                                               <button class="btn btn-default waves-effect waves-light btn-xs m-b-5"><i class="fa fa-trash"></i> Delete</button>


                                            </td>
                                        </tr>
                                      
                                    </tbody>
                                </table>
                            </div>
                            <!-- end: page -->

                        </div> <!-- end Panel -->

                    </div> <!-- container -->
                               
                </div> <!-- content -->
