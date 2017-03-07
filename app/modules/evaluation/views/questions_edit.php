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


                <div class="panel panel-default">
                    <div class="panel-heading"> 
                        <h3 class="panel-title">Questions</h3> 
                    </div> 
                    <div class="panel-body">

                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <div class="col-md-12" id="questions_container">

                           <?php foreach ($data->result() as $val) : ?>
                               <!-- QUESTION LIST -->
                               <div class="panel-group panel-group-joined" data-question-container="<?php echo $val->id; ?>"> 
                                <div class="panel panel-default"> 
                                    <div class="panel-heading"> 
                                        <h4 class="panel-title"> 
                                            <a data-toggle="collapse" href="#c<?php echo $val->id; ?>" class="collapsed question_header" aria-expanded="false">
                                              <?php echo $val->question; ?>
                                          </a>
                                      </h4> 
                                  </div> 
                                  <div id="c<?php echo $val->id; ?>" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;"> 
                                    <div class="panel-body">

                                        <ul class="list-unstyled" id="cholder<?php echo $val->id; ?>">
                                            <?php $choices = $this->general->get_table('question_choices', array('question_eval_id' => $val->id), 'id, text, question_eval_id'); ?>
                                            <?php foreach ($choices->result() as $val_c): ?>
                                                <li data-id="choices<?php echo $val_c->id; ?>">
                                                    <button class="btn btn-default delete_choices" data-id="<?php echo $val_c->id ?>">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                    <?php echo $val_c->text; ?>
                                                </li>
                                            <?php endforeach ?>
                                        </ul>
                                        <br/>
                                        <br/>
                                        <div class="input-group">
                                            <input type="text" class="form-control">
                                            <span class="input-group-btn">
                                                <button class="btn btn-primary add_choices" type="button" data-id="<?php echo $val->id; ?>">Add Choices</button>
                                            </span>
                                        </div>
                                        <br/>  <br/>
                                        <button class="btn btn-danger pull-right delete_question" type="button" data-id="<?php echo $val->id; ?>">Remove Question</button>
                                    </div> 
                                </div> 

                            </div> 
                            <!-- QUESTION LIST -->
                        </div>
                    <?php endforeach ?>
                </div>

                <br/> 
                <br/>

                <div class="col-lg-12">
                    <button class="btn btn-primary pull-right" type="button" data-toggle="modal" data-target="#question_add">Add Question</button>
                </div>

            </div>

        </div> 
    </div>

</div> <!-- end row -->

</div> <!-- container -->
</div> <!-- content -->
<div id="question_add" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content p-0">
            <ul class="nav nav-tabs navtab-bg nav-justified">
                <li class="active">
                    <a href="#home-2" data-toggle="tab" aria-expanded="false"> 
                        <span class="visible-xs"><i class="fa fa-pencil"></i></span> 
                        <span class="hidden-xs">New</span> 
                    </a> 
                </li> 
                <li class=""> 
                    <a href="#profile-2" data-toggle="tab" aria-expanded="false"> 
                        <span class="visible-xs"><i class="fa fa-check"></i></span> 
                        <span class="hidden-xs">Existing</span> 
                    </a> 
                </li> 

            </ul> 
            <div class="tab-content"> 
                <div class="tab-pane active" id="home-2"> 
                    <div class="row"> 
                      <form method="post" id="add_question">
                         <div class="form-group row">
                     
                          <label class="col-md-2 control-label" for="category">Category</label>
                          <div class="col-md-8">
                              <?php echo form_dropdown('category', $category, '', 'class="form-control"'); ?>
                          </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-md-2 control-label" for="category">Type</label>
                        <div class="col-md-8">
                          <?php echo form_dropdown('type', $types, '', 'class="form-control"'); ?>
                      </div>
                  </div>
                  <textarea class="form-control" rows="10" name="question">
                  </textarea>
                  <br/>
                  <button class="btn btn-primary pull-right" type="submit">Submit</button>
              </form>
          </div> 
      </div> 
      <div class="tab-pane" id="profile-2">
         <table id="question_list_edit" class="table table-bordered table-striped" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Question</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div> 

</div> 
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div>