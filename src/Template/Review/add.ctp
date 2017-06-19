<?php
/**
  * @var \App\View\AppView $this
  */

    use Cake\Routing\Router;
    $this->layout = 'superadmin';
?>


<style>

.tooltip {
    background-color:#000;
    border:1px solid #fff;
    padding:10px 15px;
    width:200px;
    display:none;
    color:#fff;
    text-align:left;
    font-size:12px;
 
    /* outline radius for mozilla/firefox only */
    -moz-box-shadow:0 0 10px #000;
    -webkit-box-shadow:0 0 10px #000;
  }
    .stepwizard-step p {
        margin-top: 10px;    
    }

    .stepwizard-row {
        display: table-row;
    }

    .stepwizard {
        display: table;     
        width: 98%;
        position: relative;
    }

    .stepwizard-step button[disabled] {
        opacity: 1 !important;
        filter: alpha(opacity=100) !important;
    }

    .stepwizard-row:before {
        top: 14px;
        bottom: 0;
        position: absolute;
        content: " ";
        width: 100%;
        height: 1px;
        background-color: #ccc;
        z-order: 0;

    }

    .stepwizard-step {    
        display: table-cell;
        text-align: center;
        position: relative;
    }

    .btn-circle {
      width: 30px;
      height: 30px;
      text-align: center;
      padding: 6px 0;
      font-size: 12px;
      line-height: 1.428571429;
      border-radius: 25px;
  }

@media screen and (min-width: 768px) {
    
    #myModal .modal-dialog  {width:900px;}

}

</style>


<link rel="stylesheet" type="text/css" href="<?php echo Router::url('/', true);?>css/gallery-yui3treeview-ng.css"></link>
<link rel="stylesheet" type="text/css" href="<?php echo Router::url('/', true);?>css/gallery-yui3treeview-ng-skin.css"></link>
<link rel="stylesheet" href="<?php echo Router::url('/', true);?>css/jquery.dataTables.min.css"></link>
<script src="<?php echo Router::url('/', true);?>js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo Router::url('/', true);?>js/yui-min.js"></script>
<script src="<?php echo Router::url('/', true);?>js/gallery-yui3treeview-ng-debug.js"></script>
<script src="<?php echo Router::url('/', true);?>js/myyui.js"></script>
<script src="<?php echo Router::url('/', true);?>js/date-util.js"></script>
<script src="<?php echo Router::url('/', true);?>js/utility.js"></script>
<script type="text/javascript" src="<?php echo Router::url('/', true);?>js/treeview.min.js"></script>

<div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">New Review Category</h4>
        </div><div class="container"></div>
        <div class="modal-body">          
            <div style="height: 480px;overflow: scroll;">

                    <form method="post" accept-charset="utf-8" id="createreviewcategory" action="/reviewcategory/add">
                    
                        <div class="row">
                          <div class="col-md-6">
                            <div class="row" style="margin-bottom: 0.5em;">
                              <div class="col-lg-4">
                                <label for"txtTitle" class="form-label"> Title </label>
                              </div>
                              <div class="col-lg-8">
                                <div class="input text required"><input type="text" name="title" class="form-control" required="required" maxlength="50" id="categorytitle"/></div>      </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-4">
                                <label for"txtTitle" class="form-label"> Description </label>
                              </div>
                              <div class="col-lg-8">
                                <div class="input text required">
                                    <input type="text" name="description" class="form-control" required="required" maxlength="255" id="categorydescription"/>
                                </div>      
                            </div>
                            </div>
                           
                          </div>
                          <div class="col-md-6">
                           <div class="row">
                              <div class="col-lg-4">
                                <label for"selReviewer" class="form-label"> Reviewer </label>
                              </div>
                              <div class="col-lg-8">
                                <div class="input-group">
                                    <select  multiple="multiple" class="form-control" id="reviewers">
                                    </select>                                  
                                  <span class="input-group-btn" style="vertical-align: top;">
                                  <a data-toggle="modal" href="#myModal2" class="btn btn-primary"><i class="fa fa-user" aria-hidden="true"></i></a>
                                    
                                  </span>
                                </div>
                              </div>
                            </div>
                          </div>
                          </div>

                          <div class="row">
                            <div class="col-lg-6">
                                  <label class="form-label"> Questions </label>
                                  <div id="questiontree" style="min-width:350px; min-height:200px; padding-right: 20px; padding-bottom: 20px; border: 1px solid gray;">
                                    
                                  </div>
                            </div>
                            <div class="col-lg-6">
                                  <label class="form-label">Selected Questions </label>
                                  <select multiple="multiple" class="form-control" style="min-width:400px; min-height:200px; padding-right: 20px; padding-bottom: 20px;" id="questions"></select>
                                  
                            </div>
                          </div>
                          <div class="row" style="height: 2px;">
                            <div class="col-sm-12">
                                <?= $this->Form->input('Questions_ids',['id'=>'superquestions','options'=>$question,'label'=>false,'class'=>'form-control','style'=>'visibility:hidden;height:5px;','multiple'=>'multiple']) ?>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-lg-6">
                              <button class="btn btn-primary" id="savereviewcategory"><i class="fa fa-save"></i>&nbsp;Save</button>  
                            </div>
                          </div>
                          </form>

            </div>
            </div>
          
        </div>
        <div class="modal-footer">
          <a href="#" data-dismiss="modal" class="btn" id="btnCloseCategory" style="visibility:hidden">Close</a>
          <!-- <a href="#" class="btn btn-primary">Save changes</a> -->
        </div>
      </div>
    </div>
</div>

<div class="modal" id="myModal2">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Reviewers</h4>
        </div><div class="container"></div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-12">
                    <table id="reviewertable" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Job Title</th>
                                <th>Department</th>
                                <th>Rank</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                           <?php
                            $count=1;
                            foreach ($employeepopup as $employee): 
                           ?>
                            <tr>
                                <td><?= $count++ ?></td>
                                <td><?= h($employee->name) ?> <input type="hidden" id="employeeid<?= h($employee->id) ?>" value="<?= h($employee->id) ?>"/></td>
                                <td><?= h($employee->jobposition->jobtitle) ?></td>
                                
                                <td><?= h($employee->department->departmentname) ?></td>
                                <td><?= h($employee->rank->rank) ?></td>
                            </tr>
                            <?php endforeach; ?>   
                        </tbody>
                    </table>
                    <br/>
                    <input type="button" id="btnSelectReviewer" class="btn btn-primary" value="Select"/>
                </div>

            </div>
        </div>
        <div class="modal-footer">
          <a href="#" data-dismiss="modal" id="btnCloseReviewers" class="btn" style="visibility: hidden;">Close</a>
          <!-- <a href="#" class="btn btn-primary">Save changes</a> -->
        </div>
      </div>
    </div>
</div>

<div class="modal" id="myModal3">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Owner</h4>
        </div><div class="container"></div>
        <div class="modal-body">
        <!-- ownertable -->
         <div class="row">
                <div class="col-sm-12">
                    <table id="ownertable" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Job Title</th>
                                <th>Department</th>
                                <th>Rank</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                           <?php
                            $count=1;
                            foreach ($employeepopup as $employee): 
                           ?>
                            <tr>
                                <td><?= $count++ ?></td>
                                <td><?= h($employee->name) ?> <input type="hidden" id="employeeid<?= h($employee->id) ?>" value="<?= h($employee->id) ?>"/></td>
                                <td><?= h($employee->jobposition->jobtitle) ?></td>
                                
                                <td><?= h($employee->department->departmentname) ?></td>
                                <td><?= h($employee->rank->rank) ?></td>
                            </tr>
                            <?php endforeach; ?>   
                        </tbody>
                    </table>
                    <br/>
                    <input type="button" id="btnSelectOwner" class="btn btn-primary" value="Select"/>
                </div>

            </div>
          
        </div>
        <div class="modal-footer">
          <a href="#" data-dismiss="modal" class="btn" id="btnCloseOwner" style="visibility: hidden;">Close</a>
          
        </div>
      </div>
    </div>
</div>
        <!-- JavaScript jQuery code from Bootply.com editor -->
        
    <script type='text/javascript'>
        
        $(document).ready(function() {
        
            $('#openBtn').click(function(){
                $('#myModal').modal({show:true})
            });


            $('.modal').on('hidden.bs.modal', function( event ) {
                            $(this).removeClass( 'fv-modal-stack' );
                            $('body').data( 'fv_open_modals', $('body').data( 'fv_open_modals' ) - 1 );
                            });


            $( '.modal' ).on( 'shown.bs.modal', function ( event ) {
                   
                   // keep track of the number of open modals
                   
                   if ( typeof( $('body').data( 'fv_open_modals' ) ) == 'undefined' )
                   {
                     $('body').data( 'fv_open_modals', 0 );
                   }
                   
                     
                   // if the z-index of this modal has been set, ignore.
                        
                if ( $(this).hasClass( 'fv-modal-stack' ) )
                        {
                        return;
                        }
                   
                $(this).addClass( 'fv-modal-stack' );

                $('body').data( 'fv_open_modals', $('body').data( 'fv_open_modals' ) + 1 );

                $(this).css('z-index', 1040 + (10 * $('body').data( 'fv_open_modals' )));

                $( '.modal-backdrop' ).not( '.fv-modal-stack' )
                        .css( 'z-index', 1039 + (10 * $('body').data( 'fv_open_modals' )));


                $( '.modal-backdrop' ).not( 'fv-modal-stack' )
                        .addClass( 'fv-modal-stack' ); 

                 });

        
        });
    </script>



<div id="page-wrapper">
    <div class="row">
        <div class="col-sm-12">

            <h4 class="page-header">New Review (Top-Down)</h4>
            
        </div>   
    </div>
    <!-- Start Of Form -->
    <?= $this->Form->create($review,['id'=>'frmreview']) ?>
    
    <div class="row">
        <div class="col-sm-12">
            <div class="row form-group">
                <div class="col-sm-12" style="padding: 0 0 0 0;">
                    <ul class="nav nav-pills nav-justified thumbnail setup-panel" style="margin-bottom: 0px;">
                        <li class="active">
                            <a href="#step-1" id="link-step-1">
                                <h4 class="list-group-item-heading">Step 1</h4>
                                <p class="list-group-item-text">Review Setup</p>
                            </a>
                        </li>
                        <li class="disabled">
                            <a href="#step-2">
                                <h4 class="list-group-item-heading">Step 2</h4>
                                <p class="list-group-item-text">Reviewees</p>
                            </a>
                        </li>
                        <li class="disabled">
                            <a href="#step-3">
                                <h4 class="list-group-item-heading">Step 3</h4>
                                <p class="list-group-item-text">Category</p>
                            </a>
                        </li>
                        <li class="disabled">
                            <a href="#step-4">
                                <h4 class="list-group-item-heading">Step 4</h4>
                                <p class="list-group-item-text">Final Check</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row setup-content" id="step-1">
                <div class="col-sm-12 well" style="padding: 10px 10px 10px 10px">
                    <div class="panel panel-primary">
                      <div class="panel-heading" style="padding-top: 5px;padding-bottom: 5px;padding-right:0;">
                          <div class="row">
                              <div class="col-sm-10">
                                  <i class="fa fa-th-large"></i>&nbsp;&nbsp;
                                  <a style="color: white;">Review Setup</a>
                              </div>
                              <div class="col-sm-1" style="padding-right:0">
                                  <button id="refresh-my-step-1" class="btn btn-sm" style="color:#204d74;height:28px;"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                              </div>
                              <div class="col-sm-1">
                                <button id="my_step-1" class="btn btn-sm" style="color:#204d74;height:28px;">Next</button>
                              </div>                       
                          </div>
                      </div>
                      <div class="panel-body">
                            <div class="row">  
                                <!-- Main Content -->
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-sm-4" style="line-height: 2.5em;">
                                            <label for="txtTitle"> Title</label> <span><i style="color:red;font-size: 1.5em;">*</i></span>
                                        </div>
                                        <div class="col-sm-8">
                                            <?= $this->Form->input('title',['class'=>'form-control','label'=>false,'required','onblur'=>'changetitle(this.value);','data-original-title'=>'Must be at least 3 characters!'])?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4" style="line-height: 2.5em;">
                                            <label for="txtTitle">Type</label>
                                        </div>
                                        <div class="col-sm-8">
                                         <?= $this->Form->input('reviewtype_id',['options' => $reviewtype,'class'=>'form-control','label'=>false,'value'=>'1','disabled']) ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4" style="line-height: 2.5em;">
                                            <label for="txtTitle">Goal</label> <span><i style="color:red;font-size: 1.5em;">*</i></span>
                                        </div>
                                        <div class="col-sm-8">
                                            <?= $this->Form->input('goal',['class'=>'form-control','label'=>false,'required','onblur'=>'changegoal(this.value);','data-original-title'=>'Must be at least 3 characters!'])?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4" style="line-height: 2.5em;">
                                            <label for="txtTitle">Description</label> <span><i style="color:red;font-size: 1.5em;">*</i></span>
                                        </div>
                                        <div class="col-sm-8">
                                            <?= $this->Form->textarea('description',['class'=>'form-control','label'=>false,'required','onblur'=>'changedescription(this.value);','data-original-title'=>'Must be at least 3 characters!','id'=>'description'])?>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                      <div class="col-sm-12" style="height: 1px;">
                                        <?= $this->Form->input('owner_id',['options' => $owner,'label'=>false,'style'=>'visibility:hidden'] ) ?>

                                      </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3" style="line-height: 2.5em;">
                                            <label for="txtTitle"> Owner</label> <span><i style="color:red;font-size: 1.5em;">*</i></span>
                                        </div>
                                        <div class="col-sm-5" style="padding-left: 0px;padding-right: 0px;">
                                            <div class="input-group" style="width: 100%">
                                                
                                                <input type="text" id="reviewowner" class="form-control" disabled="disabled">

                                                <span class="input-group-btn">
                                                     <a data-toggle="modal" href="#myModal3" class="btn btn-secondary" style="border: 1px solid;"><i class="fa fa-user" aria-hidden="true"></i></a>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-sm-4" style="padding-left: 10px;padding-right: 0px; ">
                                          <div id="errorOwner" style="font-size: 0.75em;color:red;padding-top: 1.4em;">

                                                    </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3" style="line-height: 2.5em;">
                                            <label for="txtTitle">Start Date</label>
                                             <span><i style="color:red;font-size: 1.5em;">*</i></span>
                                        </div>
                                        <div class="col-sm-5" style="padding-left: 0px;padding-right: 0px;">
                                            <input type="date" class="form-control" id="startdate" onblur="if(this.value<this.min)this.value=this.min;changeDate(this.value,'startdate'); changestartdate(this.value);" style="width: 100%">
                                           
                                        </div>
                                        <div class="col-sm-4">
                                          
                                        </div>
                                    </div>
                                   
                                    <div class="row">
                                        <div class="col-sm-3" style="line-height: 2.5em;">
                                            <label for="txtTitle">End Date</label>
                                             <span><i style="color:red;font-size: 1.5em;">*</i></span>
                                        </div>  
                                        <div class="col-sm-5" style="padding-left: 0px;padding-right: 0px;">

                                              <input type="date" style="width: 100%" class="form-control" id="enddate" onblur="changeDate(this.value,'enddate');changeenddate(this.value);">
                                        </div>
                                        <div class="col-sm-4">
                                          
                                        </div>
                                    </div>
                                     <?= $this->Form->input('startdate',['label'=>false,'minYear' =>date('Y'),'maxYear' =>date('Y')+2])?>
                                    <?= $this->Form->input('enddate',['label'=>false,'minYear' =>date('Y'),'maxYear' =>date('Y')+2])?>
                                </div>
                            </div>
                            <div class="row">  
                                <div class="col-sm-12" style="text-align: right;">
                                    <button id="activate-step-2" class="btn btn-primary btn-sm">Next</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row setup-content" id="step-2">
                <div class="col-sm-12 well" style="padding: 10px 10px 10px 10px">
                    <div class="panel panel-primary">
                      <div class="panel-heading" style="padding-top: 5px;padding-bottom: 5px;padding-right:0;">
                          <div class="row">
                              <div class="col-sm-10">
                                  <i class="fa fa-th-large"></i>&nbsp;&nbsp;
                                  <a style="color: white;">Reviewees</a>
                              </div>
                              <div class="col-sm-1" style="padding-right:0">
                                <button id="refresh-my-step-2" class="btn btn-sm" style="color:#204d74;height:28px;"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                              </div>
                              <div class="col-sm-1">
                                <button id="my_step-2" class="btn btn-sm" style="color:#204d74;height:28px;">Next</button>
                              </div>                       
                          </div>
                      </div>
                      <div class="panel-body">
                          <div class="row">  
                              <!-- Main Content -->                                        
                              <div class="row">
                                  <div class="col-md-6">   
                                      <!-- For Group Combo Box -->
                                      <div class="row" style="margin-left: 20px;">                     
                                          <div class="col-sm-3" style="line-height: 2.5em;">
                                              <div style="margin-left: 25px;">
                                                  <label>Groups</label>
                                              </div>
                                          </div>
                                          <div class="col-sm-9">
                                          <div class="input-group">
                                        
                                          
                                             <?= $this->Form->input('group',['options' => $employeegroup,'class'=>'form-control','label'=>false,'id'=>'employeegroup','onchange'=>'ChangeTree();'] ) ?>
                                        
                                        <span class="input-group-btn" style="vertical-align: top;">
                                          <input type="button" id="btnFilter" class="btn btn-info" onclick="ChangeTree();" value="All" />
                                        </span>
                                        <!-- <span class="input-group-btn" style="vertical-align: top;">
                                          <input type="button" id="btnAll" class="btn" onclick="ShowAll();" value="All" />
                                        </span> -->
                                      </div>  
                                      </div>
                                         
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-1">
                                        </div>
                                        <div class="col-sm-11">
                                            <label style="color: red">*Please Choose at Least One of the following.</label>
                                        </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-sm-12">
                                              <div id="cattree1" style="margin-left: 50px;  min-width:350px; min-height:200px; padding-right: 20px; padding-bottom: 20px; border: 1px solid gray;"></div>
                                          </div>
                                      </div>                                       
                                      <!-- End of Tree View --> 
                                  </div>
                                  <div class="col-md-6">
                                  <!-- <div class="row">
                                    <div class="col-sm-12">
                                        <label>&nbsp;</label>
                                    </div>
                                  </div> -->
                                   <div class="row">
                                      <div class="col-sm-2">
                                        
                                      </div>

                                      <div class="col-sm-10" style="padding-left: 2em;">
                                        <h4><strong>Selected Reviewees </strong>
                                        </h4>
                                      </div>
                                    </div>
                                      <div class="row">
                                          <div class="col-sm-12" style="height: 25px;">                                        
                                              <?= $this->Form->input('Reviewees._ids',[ 'id'=>'myreviewees','options'=>$reviewees,'label'=>false,'class'=>'form-control','style'=>'visibility:hidden']) ?>
                                          </div>
                                      </div>

                                      <div class="row">
                                          <div class="col-sm-12">                                        
                                              <select id="selectedreviewees" multiple="multiple" class="form-control"
                                               style="min-width: 400px;min-height: 350px;">
                                              </select>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <!-- End of Main Content -->
                          <div class="row">  
                              <div class="col-sm-12" style="text-align:right;">
                                  <button id="activate-step-3" class="btn btn-primary btn-sm">Next</button>
                              </div>
                          </div>
                      </div>
                </div>
            </div>
            </div>
            <div class="row setup-content" id="step-3">
                <div class="col-sm-12 well" style="padding: 10px 10px 10px 10px">
                  <div class="panel panel-primary">
                      <div class="panel-heading" style="padding-top: 5px;padding-bottom: 5px;padding-right:0;">
                          <div class="row">
                              <div class="col-sm-11">
                                  <i class="fa fa-th-large"></i>&nbsp;&nbsp;
                                  <a style="color: white;">Categories</a>
                              </div>
                              
                              <div class="col-sm-1">
                                <button id="my_step-3" class="btn btn-sm" style="color:#204d74;height:28px;">Next</button>
                              </div>                  
                          </div>
                      </div>
                      <div class="panel-body">
                          <div class="row" style="padding-bottom: 5px">
                            <div class="col-sm-12">
                              <a data-toggle="modal" href="#myModal" class="btn btn-primary">Create Category</a>
                            </div>

                            </div>
                            <div class="row">
                              <div class="col-sm-12">
                                  <label style="color:red;font-size: 1em;"> * Please Create at Least One Category!</label>
                              </div>
                            </div>

                            <!-- Toggle Panel -->
                            <div class="row">
                                <div class="col-sm-12" style="height: 2px;">
                                    <?= $this->Form->input('reviewcategory._ids',['label'=>false,'id'=>'reviewcategory_ids','options'=>$reviewcategories,'style'=>'visibility:hidden']) ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6-12">
                                    <div id="CategoryContainer">

                                    </div>
                                </div>
                            </div>
                            <div class="row">  
                                <div class="col-sm-12" style="text-align: right;">
                                    <button id="activate-step-4" class="btn btn-primary btn-sm">Next</button>
                                </div>
                            </div>
                      </div>
                  </div>
                </div>
            </div>

                    <div class="row setup-content" id="step-4">
                        <div class="col-sm-12 well" style="padding: 10px 10px 10px 10px">

                            <!-- For Review Set Up Toggle -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading" style="padding-top: 5px;padding-bottom: 5px;padding-right:0px;">
                                            <div class="row">
                                                <div class="col-sm-11">
                                                    <i class="fa fa-th-large"></i>&nbsp;&nbsp;
                                                    <a style="color: white;">Final Check</a>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button id="my-step-4" class="btn btn-sm" style="color:#204d74;height:28px;">Back</button>  
                                                </div>                      
                                            </div>
                                        </div>
                                        <div class="panel-body">

                                            <!-- Page Header for Review Set Up -->
                                            <div class="row">  
                                                <div class="col-sm-12">
                                                    <h4 style="margin-top: 0px;margin-bottom: 0px;"> <strong>Review Set Up</strong></h4>
                                                    <hr style="margin-top: 10px;margin-bottom: 10px;">
                                                </div>
                                            </div>
                                            <!-- End of Page Header for Review Set Up -->
                                            <!-- Main Content for Review Set Up -->
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label>Title :</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <label style="font-weight: normal !important;" id='preview_titile'></label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label>Type :</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <label style="font-weight: normal !important;" >Top-Down</label>
                                                        </div>
                                                    </div>
                                                     <div class="row">
                                                        <div class="col-sm-4">
                                                            <label >Description :</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <label style="font-weight: normal !important;" id='preview_goal'></label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label >Description :</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <label style="font-weight: normal !important;" id='preview_description'></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label>Owner :</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <label style="font-weight: normal !important;" id='preview_owner'></label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label>Start Date :</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <label style="font-weight: normal !important;" id='preview_startdate'></label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label>End Date :</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <label style="font-weight: normal !important;" id='preview_enddate'></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>                                                                         
                                            <!-- End of Main Content for Review Set Up -->
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <hr style="margin-top: 10px;margin-bottom: 10px;">
                                                </div>
                                            </div>

                                            <!-- Page Header for Review Set Up -->
                                            <div class="row">  
                                                <div class="col-sm-12">
                                                    <h4 style="margin-top: 0px;margin-bottom: 0px;"> <strong>Reviewees</strong></h4>
                                                    <hr style="margin-top: 10px;margin-bottom: 10px;">
                                                </div>
                                            </div>
                                            <!-- End of Page Header for Review Set Up -->
                                            <!-- Main Content for Review Set Up -->
                                            <div class="row"> 
                                                <div class="col-sm-12">
                                                    <label style="font-size:100%;font-style: bold">Selected Reviewees</label>
                                                </div>
                                            </div> 
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div  id="revieweescontainer">
                                                    </div>
                                                </div>
                                               
                                            </div>                                                                    
                                            <!-- End of Main Content for Review Set Up -->
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <hr style="margin-top: 10px;margin-bottom: 10px;">
                                                </div>
                                            </div>

                                            <!-- Page Header for Review Set Up -->
                                            <div class="row">  
                                                <div class="col-sm-12">
                                                    <h4 style="margin-top: 0px;margin-bottom: 0px;"> <strong>Categories</strong></h4>
                                                    <hr style="margin-top: 10px;margin-bottom: 10px;">
                                                </div>
                                            </div>
                                            <!-- End of Page Header for Review Set Up -->
                                            <!-- Main Content for Review Set Up -->
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div id="categoriescontainer">
                                                        
                                                    </div>
                                                </div>
                                            </div>                                                                         
                                            <!-- End of Main Content for Review Set Up -->

                                            <!-- For Save Button -->
                                            <div class="row">  
                                                <div class="col-sm-12" style="text-align: right;">
                                                    <?= $this->Form->button(__('<i class="fa fa-save"></i>&nbsp;Save'),['class'=>'btn btn-primary btn-sm','id'=>'btnSaveReview']) ?>
                                                </div>
                                            </div>
                                            <!-- End of Save Button -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End of Review Set Up Toggle -->                                                               

                        </div>
                    </div>

                </div>
            </div>
        </div> 

  <script type="text/javascript">

      $("#frmreview :input").tooltip({
 
      // place tooltip on the right edge
      position: "center right",
 
      // a little tweaking of the position
      offset: [-2, 10],
 
      // use the built-in fadeIn/fadeOut effect
      effect: "fade",
 
      // custom opacity setting
      opacity: 0.7
 
      });

            var reviewees = [];
            var categories = [];

            //for the step 4
            function changetitle(val)
            {   
                document.getElementById('preview_titile').innerHTML = val;
            }

            function changegoal(val)
            {   
                document.getElementById('preview_goal').innerHTML = val;
            }

            function changedescription(val)
            {   
                document.getElementById('preview_description').innerHTML = val;
            }

            function changeowner(val)
            {
                document.getElementById('preview_owner').innerHTML = val;
            }

            function changestartdate(val)
            {
                document.getElementById('preview_startdate').innerHTML = val;
            }

            function changeenddate(val)
            {
                document.getElementById('preview_enddate').innerHTML = val;
            }

            function changereviewees(item,status)
            {

                if(status=="add" && item!='')
                {
                    if(reviewees.indexOf(item)>0)
                    {
                      //do nothings
                    }
                    else{
                      reviewees.push(item);
                    }
                    //alert(item);

                }else
                {
                    for (var i = reviewees.length - 1; i >= 0; i--) {
                        if(reviewees[i]==item)
                            reviewees.splice(i,1);
                    }
                }

                var selReviewees = document.getElementById('selectedreviewees');
                selReviewees.options.length = 0;
                for (var i = 0 ; i < reviewees.length ; i++) 
                {
                  var opt = document.createElement('option');
                  opt.innerHTML =reviewees[i];
                  selReviewees.appendChild(opt);    
                }
                
                var rowcount = reviewees.length/3;
                var content = "<div class='row'>";
                var divTemplate="";
                for(var i=0;i<3;i++)
                {
                    if(i<=reviewees.length)
                    {
                        divTemplate += "<div class='col-sm-4'>";
                        divTemplate += "<ul>";
                        for (var j =  0 ;  j < rowcount; j++) 
                        {
                            divTemplate+= "<li>";
                            if(j*3+i < reviewees.length)
                                divTemplate+=  reviewees[(j*3)+i];
                            divTemplate+= "</li>";
                        }
                        divTemplate+= "</ul>";
                        divTemplate+="</div>";
                    }
                    else
                    {
                        divTemplate+= "<div class='col-sm-4'></div>"
                    }
                }

                content += divTemplate+"</div>";
                var revieweescontainer = document.getElementById('revieweescontainer');
                $('#revieweescontainer').empty();
                revieweescontainer.innerHTML = content;
            }

            function changecategories(category,status)
            {
                if(status=="add")
                {
                    categories.push(category);
                    //alert(item);
                }
                else
                {
                    for (var i = categories.length - 1; i >= 0; i--) {
                        if(categories[i].id==category.id)
                            categories.splice(i,1);
                    }
                }
                var rowcount = categories.length/2;
                var content = "<div class='row'>";
                var divTemplate="";
                for(var i=0;i<2;i++)
                {

                    if(i<=categories.length)
                    {
                        divTemplate += "<div class='col-md-6'>";
                        divTemplate += "<div class='row'>";
                        for (var j =  0 ;  j < rowcount; j++) 
                        {
                            divTemplate+= "<div class='col-sm-12'>";
                            if(j*2+i < categories.length)
                                divTemplate+=  getdivContent(categories[(j*2)+i]);
                            divTemplate+= "</div>";
                        }
                        divTemplate+= "</div>";
                        divTemplate+="</div>";
                    }
                    else{
                        divTemplate+= "<div class='col-md-6'></div>"
                    }
                }
                 content += divTemplate+"</div>";
                var revieweescontainer = document.getElementById('categoriescontainer');
                $('#categoriescontainer').empty();
                revieweescontainer.innerHTML = content;
            }

            function getdivContent(category)
            {
                var content = '';
                content = '<div class="row">';
                    content +=  '<div class="col-sm-12">';
                    content += '';
                    content += '</div>';
                content += '</div>';
                content += '<div class="row">';
                    content += '<div class="col-sm-4">';
                        content += '<label>Title :</label>';
                    content += '</div>';
                    content += '<div class="col-sm-8">';
                        content += '<label>' + category.title + '</label>';
                    content += '</div>';
                content += '</div>';
                content += '<div class="row">'
                    content += '<div class="col-sm-4">';
                        content += '<label>Description :</label>';
                    content+= '</div>';
                    content += '<div class="col-sm-8">';
                        content += '<label>'+category.description+'</label>';
                    content+= '</div>';
                content+= '</div>';
                content += '<div class="row">';
                    content+= '<div class="col-sm-12">';
                        content+= '<label style="font-size:100%;font-style: bold">Reviewers</label>';
                        content+= '<ul>';
                                for (var i = category.employee.length - 1; i >= 0; i--) {
                                    content += '<li>'+category.employee[i].name +'</li>';
                                }
                        content += '</ul>';
                    content+= '</div>';
                content += '</div>';
                content += '<div class="row">';
                    content+= '<div class="col-sm-12">';
                        content += '<label style="font-size:100%;font-style: bold">Questions</label>';
                        content += '<ul>';
                                for (var i = category.question.length - 1; i >= 0; i--) {
                                    content += '<li>'+category.question[i].questionname +'</li>'; 
                                }
                        content += '</ul>';
                    content += '</div>';
                content += '</div>';
                return content;
            }
        </script>
        <script type="text/javascript">     
           
            function ChangeTree()
            {             
                reviewees = [];
                changereviewees('','add');
                var btnFilter = document.getElementById('btnFilter');
                //alert(btnFilter.value);
                if(btnFilter.value == 'Filter'){

                var groupid = document.getElementById('employeegroup').value;
                document.getElementById('btnFilter').value = "All";
                //document.getElementById('btnAll').style = "background-color:white";

                  $.ajax({
                      type: "POST",
                      url: "<?php echo Router::url('/', true);?>employeegroup/getemployeebygroupid/"+groupid
                      
                    }).done(function(result)
                    {   
                        //alert(result);       
                        $('#cattree1').empty();
                        var obj = JSON.parse(result);
                        //alert(obj.result[0]);
                        

                        buildEmployeeTree('cattree1',obj.result);

                    }).fail(function ( jqXHR, textStatus, errorThrown ) 
                    {
                        console.log(jqXHR);
                        console.log(jqXHR.responseText);
                        //alert(textStatus);
                        //alert(errorThrown);
                    });
                }else{
                   $('#cattree1').empty();
                  buildEmployeeTree('cattree1',<?php echo $yuistring;?>);
                  
                  document.getElementById('btnFilter').value = "Filter";
                }

                // var newData =  [{label: "Export/Import Department" ,children:[ {label: "U Maung Maung"}, {label: "Kyaw Kyaw"}]}];
                // $('#cattree1').empty();
                // buildTree('cattree1',newData);

            }
            
            function  checkLeaf(empname,selectid = "myreviewees" )
            {
                if(selectid=="myreviewees")
                    changereviewees(empname,"add");


                var sel = document.getElementById(selectid);
                for(l=0;l<sel.options.length;l++)
                {
                    var text= sel.options[l].text;
                    if(text==empname)
                    {
                        sel.options[l].selected=true;
                        if(selectid=="superquestions")
                            addToQuestions(sel.options[l].value,sel.options[l].text);
                    }
                }
            }

            function addToQuestions(value,display)
            {
                var questions = document.getElementById("questions");
                var isExist = false;
                for(j=0;j<questions.options.length;j++)
                {
                    var text= questions.options[j].value;
                    if(text==value)
                    {
                        isExist = true;
                        break;
                    }
                }
                if(!isExist){
                    var opt = document.createElement('option');
                    opt.value = value;
                    opt.innerHTML =display;
                    //opt.selected = true;
                    questions.appendChild(opt);
                }

            }
            function removeFromQuestions(value)
            {
                var sel = document.getElementById("questions");
                for(i=0;i<sel.options.length;i++)
                {
                    var text= sel.options[i].value;
                    if(text==value)
                    {
                        sel.removeChild(sel.options[i]);
                        break;
                    }
                }                
            }

            function  uncheckLeaf(empname,selectid = "myreviewees" )
            {
                if(selectid=="myreviewees")
                    changereviewees(empname,"remove");

                var sel = document.getElementById(selectid);
                for(k=0;k<sel.options.length;k++)
                {
                    var text= sel.options[k].text;
                    if(text==empname)
                    {
                        sel.options[k].selected=false;
                        if(selectid=="superquestions")
                            removeFromQuestions(sel.options[k].value);
                        break;
                    }
                }
            }


            function CreateNewCategory(data)
            {
               
                CreateNewCategoryDiv(data);
                //Adding to option
                var categories = document.getElementById("reviewcategory_ids");
                
                var opt = document.createElement('option');
                opt.value = data.id;
                opt.innerHTML = data.id;
                opt.selected = true;
                categories.appendChild(opt);
                changecategories(data,'add');
            }

            function RemoveDiv(divid,myid)
            {
                var container = document.getElementById('CategoryContainer');
                var child = document.getElementById(divid);

                $.ajax({
                  type: "POST",
                  url: "<?php echo Router::url('/', true);?>reviewcategory/delete/"+myid
                }).done(function(data)
                {
                    if(data!="Failed")
                    {
                        container.removeChild(child);
                        var categories = document.getElementById("reviewcategory_ids");
                        for (var i=0; i<categories.length; i++){
                          if (categories.options[i].value == myid )
                                categories.remove(i);
                          }
                    }
                    else
                        alert("Removed Failed!");

                }).fail(function ( jqXHR, textStatus, errorThrown ) 
                {
                    console.log(jqXHR);
                    console.log(jqXHR.responseText);
                    container.removeChild(child);
                    var categories = document.getElementById("reviewcategory_ids");
                    for (var i=0; i<categories.length; i++){
                      if (categories.options[i].value == myid )
                            categories.remove(i);
                      }
                });
            }

            function CheckValidation()
            {
              var step1_error = false;
              var step2_error = false;
              var step3_error = false;
              var name_pattern = /^(([A-Za-z]+[\-\']?)*([A-Za-z]+)?\s)+([A-Za-z]+[\-\']?)*([A-Za-z]+)?$/;

              var txtTitle = document.getElementById('title');
              var txtGoal = document.getElementById('goal');
              var txtDescription = document.getElementById('description');
              var txtOwner = document.getElementById('reviewowner');

              var startDateCtrl = document.getElementById('startdate');

              var endDateCtrl = document.getElementById('enddate');

              if(!name_pattern.test(txtTitle.value))
              {
                txtTitle.style = "background-color:yellow";
                step1_error = true;
              }
              else if(!name_pattern.test(txtGoal.value))
              {
                txtGoal.style = "background-color:yellow";
                step1_error = true;
              }else if(!name_pattern.test(txtDescription.value))
              {
                txtDescription.style = "background-color:yellow";
                step1_error = true;
              }else if(!name_pattern.test(txtOwner.value)){
                document.getElementById('errorOwner').innerHTML = " <i class='fa fa-long-arrow-left'></i> Please Click to add Owner!";
                step1_error = true;
              }else if(startDateCtrl.value == ''){
                startDateCtrl.style = "background-color:yellow";
                step1_error = true;
              }else if(endDateCtrl.value == ''){
                startDateCtrl.style = "background-color:yellow";
                step1_error = true;
              }              

              if(step1_error)
              {
                $('ul.setup-panel li:eq(0)').removeClass('disabled');
                $('ul.setup-panel li a[href="#step-1"]').trigger('click');
                $(this).remove();
                return false;
              }

              if(reviewees.length<1)
              {
                $('ul.setup-panel li:eq(0)').removeClass('disabled');
                $('ul.setup-panel li a[href="#step-2"]').trigger('click');
                $(this).remove();

                selectedreviewees.style = "background-color:yellow;min-width: 450px;min-height: 300px;"; 

                return false;
              }
              return true;              
            }

            $('input[type=text]').keydown(function(e) 
            {
              var id = e.target.id;
              var mytarget = document.getElementById(id);
              mytarget.style="background-color:white";
            });

            $('textarea').keydown(function(e) 
            {
              var id = e.target.id;
              var mytarget = document.getElementById(id);
              mytarget.style="background-color:white";
            });
        </script>


<script type="text/javascript">

  $(document).ready(function() 
  {
      var utc = new Date().toJSON().slice(0,10).replace(/-/g,'-');

      document.getElementById('startdate').setAttribute("min", utc);

      document.getElementById('enddate').setAttribute("min", utc);


    $("#btnSaveReview").click(
      function(e)
      {
        if(!CheckValidation())
        {
          e.preventDefault();
          e.stopImmediatePropagation();
        }
      });

      $("#savereviewcategory").click(function(e) 
      {
          e.preventDefault();
          e.stopImmediatePropagation();
          //var jsonStr =JSON.stringify(jsondata);
          var title = document.getElementById('categorytitle');
          var description = document.getElementById('categorydescription');
          var isdeleted = false;
          var jsonStr = "{";
          jsonStr+= "\"title\":\""+title.value+"\",";
          jsonStr+= "\"description\":\""+description.value+"\",";
          jsonStr += "\"created\": \""+ new Date()+ "\",";
          jsonStr += "\"modified\": \""+ new Date() +"\","
          jsonStr+= "\"isdeleted\": false,";  
          jsonStr+="\"employee\": [";

          var employeeList =  document.getElementById('reviewers');
          for (var i=0; i<employeeList.length; i++)
          {
              jsonStr+= "{\"id\":"+employeeList[i].value+"},";                  
          }

          jsonStr = jsonStr.substring(0,jsonStr.length-1);

          jsonStr+="],";
          jsonStr+="\"question\": [";
          
          var questionList =  document.getElementById('questions');
          for (var i=0; i<questionList.length; i++)
          {
              jsonStr+= "{\"id\":"+questionList[i].value+"},";
                  
          }
          jsonStr = jsonStr.substring(0,jsonStr.length-1);
          jsonStr+="]";
          jsonStr+="}";
          //var jsondata = JSON.parse(jsonStr);

          //alert(jsonStr);
          console.log(jsonStr);                                          
        
          $.ajax({
                  type: "POST",
                  url: "<?php echo Router::url('/', true);?>reviewcategory.json",
                     data: jsonStr ,
                    contentType: "application/json; charset=utf-8",
                    traditional: true
                }).done(function(result)
                {            
                    //alert(JSON.stringify(result));
                    //alert(result);
                    console.log(result);
                    document.getElementById("btnCloseCategory").click();
                    CreateNewCategory(JSON.parse(result));

                }).fail(function ( jqXHR, textStatus, errorThrown ) 
                {
                    console.log(jqXHR);
                    console.log(jqXHR.responseText);
                    //alert(textStatus);
                    alert(errorThrown);
                });

        document.getElementById('categorytitle').value = "";
        document.getElementById('categorydescription').value = "";

        var reviewerlist = document.getElementById('reviewers');
        reviewerlist.options.length = 0;

        document.getElementById('superquestions').value = "";//hidden

        var qlist = document.getElementById('questions');//view  
        qlist.options.length=0;        

        $('#questiontree').empty();
        buildQuestionTree('questiontree' ,<?php echo $yuistringDepartment;?>,'superquestions');        

        questions = [];

        e.preventDefault();
        e.stopImmediatePropagation();

  });
      //$('.glyphicon-cloud').click(ajaxDemo);

      
      hideDate("startdate");
      hideDate("enddate");
      ChangeTree();
      buildQuestionTree('questiontree' ,<?php echo $yuistringDepartment;?>,'superquestions');

      var navListItems = $('ul.setup-panel li a'),
      allWells = $('.setup-content');

      allWells.hide();

      navListItems.click(function(e)
      {
          e.preventDefault();
          var $target = $($(this).attr('href')),
          $item = $(this).closest('li');
            //alert($target.value);
            if (!$item.hasClass('disabled')) 
            {
                navListItems.closest('li').removeClass('active');
                $item.addClass('active');
                allWells.hide();
                $target.show();
            }
        });                                        

  $('#refresh-my-step-1').on('click', function(e) 
    {
        document.getElementById('title').value = "";
        document.getElementById('goal').value = "";
        //document.getElementById('reviewtype-id').value = 0;
        document.getElementById('description').value = "";
        document.getElementById('reviewowner').value = 0;
        document.getElementById('stratdate').value = "";
        document.getElementById('enddate').value = "";
        
        document.getElementById('preview_titile').innerHTML = "";
        //document.getElementById('preview_type').innerHTML = "";
        document.getElementById('preview_goal').innerHTML = "";
        document.getElementById('preview_description').innerHTML = "";
        document.getElementById('powner_id').innerHTML = "";
        document.getElementById('preview_startdate').innerHTML = "";
        document.getElementById('preview_enddate').innerHTML = "";     
          
        e.preventDefault();
        e.stopImmediatePropagation();
    })

    $('#refresh-my-step-2').on('click', function(e) 
    {   
        document.getElementById('myreviewees').value = "";

        var selectlist = document.getElementById('selectedreviewees');//view //myreviewees->hidden
        
        selectlist.options.length = 0;

        $('#cattree1').empty();
          buildEmployeeTree('cattree1',<?php echo $yuistring;?>);

        reviewees = [];

        document.getElementById('revieweescontainer').innerHTML = "";

        e.preventDefault();
        e.stopImmediatePropagation();
    })

$('ul.setup-panel li.active a').trigger('click');

    // DEMO ONLY //                                                
    $('#my_step-1').on('click', function(e) {
        $('ul.setup-panel li:eq(1)').removeClass('disabled');
        $('ul.setup-panel li a[href="#step-2"]').trigger('click');
        e.preventDefault();
        e.stopImmediatePropagation();
    })
    $('#my_step-2').on('click', function(e) {
        $('ul.setup-panel li:eq(2)').removeClass('disabled');
        $('ul.setup-panel li a[href="#step-3"]').trigger('click');
        e.preventDefault();
        e.stopImmediatePropagation();
    })
    $('#my_step-3').on('click', function(e) {
        $('ul.setup-panel li:eq(3)').removeClass('disabled');
        $('ul.setup-panel li a[href="#step-4"]').trigger('click');
        e.preventDefault();
        e.stopImmediatePropagation();
    })
    $('#my-step-4').on('click', function(e) {
        $('ul.setup-panel li:eq(4)').removeClass('disabled');
        $('ul.setup-panel li a[href="#step-3"]').trigger('click');
        e.preventDefault();
        e.stopImmediatePropagation();
    })
    $('#activate-step-2').on('click', function(e) {
        $('ul.setup-panel li:eq(1)').removeClass('disabled');
        $('ul.setup-panel li a[href="#step-2"]').trigger('click');
        $(this).remove();
    })    
    $('#activate-step-3').on('click', function(e) {
        $('ul.setup-panel li:eq(2)').removeClass('disabled');
        $('ul.setup-panel li a[href="#step-3"]').trigger('click');
        $(this).remove();
    })
    $('#activate-step-4').on('click', function(e) {
        $('ul.setup-panel li:eq(3)').removeClass('disabled');
        $('ul.setup-panel li a[href="#step-4"]').trigger('click');
        $(this).remove();
    })  

    // For Tree View  
    $( '.tree li').each(
     function() {
        if( $( this ).children( 'ul' ).length > 0 ) 
        {
            $( this ).addClass( 'parent' );  

            $( '.tree li.parent > label' ).click( function( ) {
                $( this ).parent().toggleClass( 'active' );
                $( this ).parent().children( 'ul' ).slideToggle( 'fast' );
            });   
        }
    });

    $( '.tree1 li').each(
     function() {
        if( $( this ).children( 'ul' ).length > 0 ) 
        {
            $( this ).addClass( 'parent' );  

            $( '.tree li.parent > label' ).click( function( ) {
                $( this ).parent().toggleClass( 'active' );
                $( this ).parent().children( 'ul' ).slideToggle( 'fast' );
            });   
        }
    });

    $( '.tree2 li').each(
     function() {
        if( $( this ).children( 'ul' ).length > 0 ) 
        {
            $( this ).addClass( 'parent' );  

            $( '.tree li.parent > label' ).cli/ck( function( ) {
                $( this ).parent().toggleClass( 'active' );
                $( this ).parent().children( 'ul' ).slideToggle( 'fast' );
            });   
        }
    });
});

var reviewertable = $('#reviewertable').DataTable();

$('#reviewertable tbody').on( 'click', 'tr', function () {
    $(this).toggleClass('selected');
} );

$('#btnSelectReviewer').click( function () 
{
    var selectedrow = reviewertable.rows('.selected').data(); 
    if(selectedrow.length>0)
    {
        var employeeSelect  = document.getElementById('reviewers');
        employeeSelect.options.length=0;
        for (var i = selectedrow.length - 1; i >= 0; i--) 
        {
            //alert(selectedrow[i]);
            var str = selectedrow[i][1];
            var empname = str.substring(0,str.indexOf("<"));
            var index = str.indexOf('value=');
            str = str.substring(index+7);
            index = str.indexOf('"');
            var empId = str.substring(0,index);
            var opt = document.createElement('option');
            opt.value = empId;
            opt.innerHTML = empname;
            //opt.selected = true;
            //categories.appendChild(opt);
            employeeSelect.appendChild(opt);
            document.getElementById('btnCloseReviewers').click();
        }
    }

});

var ownertable = $('#ownertable').DataTable();

$('#ownertable tbody').on( 'click', 'tr', function () {
    $(this).toggleClass('selected');
} );

$('#btnSelectOwner').click( function () 
{
    var selectedrow = ownertable.rows('.selected').data(); 
    if(selectedrow.length==1)
    {
        var ownerSelect = document.getElementById('owner-id');
        var ownerText = document.getElementById('reviewowner');
        var errorOwnerDiv = document.getElementById('errorOwner');

        for (var i = selectedrow.length - 1; i >= 0; i--) 
        {
            //alert(selectedrow[i]);
            var str = selectedrow[i][1];
            var empname = str.substring(0,str.indexOf("<"));
            var index = str.indexOf('value=');
            str = str.substring(index+7);
            index = str.indexOf('"');
            var empId = str.substring(0,index);
            ownerSelect.value = empId;
            ownerText.value = empname;
            document.getElementById('btnCloseOwner').click();
            changeowner(empname);
            errorOwnerDiv.innerHTML = "";

        }
    }

});
        </script>
    <!-- This is end of Form -->
    <?= $this->Form->end() ?>