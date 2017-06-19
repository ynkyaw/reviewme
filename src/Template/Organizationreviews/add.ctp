<?php
/**
  * @var \App\View\AppView $this
  */

    use Cake\Routing\Router;

    $this->layout = 'superadmin';
?>

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

<div class="modal" id="myModal3">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Owner</h4>
        </div><div class="container"></div>
        <div class="modal-body">
        <!-- ownertable -->
         <div class="row" style="height: 480px;overflow: scroll;">
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

<div id="page-wrapper">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-header">New Organization Review</h4>            
        </div>   
    </div>
    <!-- Start Of Form -->
    <?= $this->Form->create($organizationreview) ?>
    
    <div class="row">
        <div class="col-sm-12">
            <div class="row form-group">
                <div class="col-sm-12" style="padding: 0 0 0 0;">
                    <ul class="nav nav-pills nav-justified thumbnail setup-panel" style="margin-bottom: 0px;">
                        <li class="active">
                            <a href="#step-1">
                                <h4 class="list-group-item-heading">Step 1</h4>
                                <p class="list-group-item-text">Review Setup</p>
                            </a>
                        </li>
                        <li class="disabled">
                            <a href="#step-2">
                                <h4 class="list-group-item-heading">Step 2</h4>
                                <p class="list-group-item-text">Reviewees & Reviewers</p>
                            </a>
                        </li>
                        <li class="disabled">
                            <a href="#step-3">
                                <h4 class="list-group-item-heading">Step 3</h4>
                                <p class="list-group-item-text">Questions</p>
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
                          <div class="panel-heading" style="padding-top: 5px;padding-bottom: 5px;padding-right:0;" >
                              <div class="row">
                                  <div class="col-sm-10">
                                      <i class="fa fa-th-large"></i>&nbsp;&nbsp;
                                      <a style="color: white;">Review Setup</a>
                                  </div>
                                  <div class="col-sm-1" style="padding-right:0">
                                    <button id="refresh-my-step-1" class="btn btn-sm" style="color:#204d74;height:28px;"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                                  </div>
                                  <div class="col-sm-1">
                                    <button id="activate-my-step-2" class="btn btn-sm" style="color:#204d74;height:28px;">Next</button>
                                  </div>                    
                              </div>
                          </div>
                          <div class="panel-body" id="steponediv">
                              <div class="row">  
                                  <!-- Main Content -->
                                  <div class="col-md-6">
                                      <div class="row">
                                          <div class="col-sm-4" style="line-height: 2.5em;">
                                              <label for="txtTitle"> Title</label>
                                               <span><i style="color:red;font-size: 1.5em;">*</i></span>
                                          </div>
                                          <div class="col-sm-8">
                                              <?= $this->Form->input('title',['class'=>'form-control','label'=>false,'required','onblur'=>'changetitle(this.value);'])?>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-sm-4" style="line-height: 2.5em;">
                                              <label for="txtTitle">Type</label>
                                               <span><i style="color:red;font-size: 1.5em;">*</i></span>
                                          </div>
                                          <div class="col-sm-8">
                                             <?= $this->Form->input('reviewtype_id',['options' => $reviewtype,'class'=>'form-control','label'=>false,'id' => 'revtype']) ?>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-sm-4" style="line-height: 2.5em;">
                                              <label for="txtTitle">Goal</label>
                                               <span><i style="color:red;font-size: 1.5em;">*</i></span>
                                          </div>                                         
                                          <div class="col-sm-8">                                              
                                              <?= $this->Form->input('goal',['options' => array('For Reporting'=> 'For Reporting','For Marketing'=>'For Marketing','For New Customer'=>'For New Customer'),'class'=>'form-control','label'=>false,'onblur'=>'changegoal(this.options[this.selectedIndex].text);']) ?>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-sm-4" style="line-height: 2.5em;">
                                              <label for="txtTitle">Description</label>
                                               <span><i style="color:red;font-size: 1.5em;">*</i></span>
                                          </div>
                                          <div class="col-sm-8">
                                              <?= $this->Form->textarea('description',['class'=>'form-control','label'=>false,'required','onblur'=>'changedescription(this.value);','id'=>'description'])?>                                              
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
                                            <label for="txtTitle"> Owner</label>
                                             <span><i style="color:red;font-size: 1.5em;">*</i></span>
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
                                        <div id="errorOwner" style="font-size: 0.75em;color:red;padding-top: 0.85em;">
                                        </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-sm-3" style="line-height: 2.5em;">
                                              <label for="txtTitle">Start Date</label>
                                               <span><i style="color:red;font-size: 1.5em;">*</i></span>
                                          </div>
                                          <div class="col-sm-5" style="padding-left: 0px;padding-right: 0px;">
                                              <input style="width: 100%" type="date" class="form-control" id="stratdate" onblur="changeDate(this.value,'startdate'); changestartdate(this.value);">
                                             
                                          </div>
                                          <div class="col-sm-4">
                                               <div id="errorstratdate" style="font-size: 0.75em;color:red;padding-top: 0.85em;">
                                                </div>
                                          </div>
                                      </div>
                                     
                                      <div class="row">
                                         <div class="col-sm-3" style="line-height: 2.5em;">
                                              <label for="txtTitle">End Date</label>
                                               <span><i style="color:red;font-size: 1.5em;">*</i></span>
                                          </div>
                                           <div class="col-sm-5" style="padding-left: 0px;padding-right: 0px;">
                                                <input style="width: 100%" type="date" class="form-control" id="enddate" onblur="changeDate(this.value,'enddate');changeenddate(this.value);">
                                          </div>
                                          <div class="col-sm-4">
                                             <div id="errorenddate" style="font-size: 0.75em;color:red;padding-top: 0.85em;">
                                             </div>
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
                                  <label id="itemtitle">Product</label> <label> & Reviewers</label>
                              </div>
                              <div class="col-sm-1" style="padding-right:0">
                                <button id="refresh-my-step-2" class="btn btn-sm" style="color:#204d74;height:28px;"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                              </div> 
                              <div class="col-sm-1">
                                <button id="activate-my-step-3" class="btn btn-sm" style="color:#204d74;height:28px;">Next</button>
                              </div>                     
                          </div>
                      </div>
                      <div class="panel-body">
                        <div class="row">  
                            <div class="col-sm-2" style="line-height: 2.5em;">
                                <label for="txtTitle" id="itemname">Product</label>
                                <span><i style="color:red;font-size: 1.5em;">*</i></span>
                            </div>
                            <div class="col-sm-4">
                              <?=   
                                $this->Form->input('revieweeid',['id'=>'myreviewers','options' => $companylist,'class'=>'form-control','label'=>false,'required'])
                                ?>
                            </div> 
                        </div>
                        <hr/>                     

                         <div class="row">  
                            <div class="col-sm-12">
                                <h5> <strong>Employee</strong></h5>
                                <hr/>
                            </div>
                        </div>

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
                                           <?= $this->Form->input('group',['options' => $employeegroup,'class'=>'form-control','label'=>false,'required' => false,'allowEmpty' => true,'id'=>'employeegroup','onchanged'=>'ChangeTree();'] ) ?>
                                      
                                        <span class="input-group-btn" style="vertical-align: top;">
                                          <input type="button" id="btnFilter" class="btn" onclick="ChangeTree();" value="Filter" />
                                        </span>
                                        <span class="input-group-btn" style="vertical-align: top;">
                                          <input type="button" id="btnAll" class="btn" onclick="ShowAll();" value="All" />
                                        </span>
                                    </div>  
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
                                    <div class="row">                                       
                                        <div class="row" >
                                          <div class="col-sm-12" style="margin-top:40px;">
                                              <select id="selectedreviewees" multiple="multiple" class="form-control"
                                               style="min-width: 450px;min-height: 300px;">
                                              </select>
                                          </div>

                                           <div class="col-sm-12" style="padding-top: 3em;">
                                            <?= $this->Form->input('Reviewers._ids',[ 'id'=>'myreviewees','options'=>$reviewers,'label'=>false,'class'=>'form-control','style'=>'display:none','required']) ?>
                                        </div>
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
                      <div class="panel-heading" style="padding-top: 5px;padding-bottom: 5px;padding-right:0">
                          <div class="row">
                              <div class="col-sm-10">
                                  <i class="fa fa-th-large"></i>&nbsp;&nbsp;
                                  <a style="color: white;">Questions</a>
                              </div>
                              <div class="col-sm-1" style="padding-right:0">
                                <button id="refresh-my-step-3" class="btn btn-sm" style="color:#204d74;height:28px;"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                              </div>
                              <div class="col-sm-1">
                                <button id="activate-my-step-4" class="btn btn-sm" style="color:#204d74;height:28px;">Next</button>
                              </div>                      
                          </div>
                      </div>
                      <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                 <div id="questiontree" style="min-width:350px; min-height:200px; padding-right: 20px; padding-bottom: 20px; border: 1px solid gray;">
                                    
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <select multiple="multiple" class="form-control" style="min-width:400px; min-height:200px; padding-right: 20px; padding-bottom: 20px;" id="questions"></select>
                            </div>
                        </div>
                        <div class="row" style="height: 2px;">
                            <div class="col-sm-12">
                                <?= $this->Form->input('Question_ids',['id'=>'superquestions','options'=>$question,'label'=>false,'class'=>'form-control','style'=>'visibility:hidden;height:5px;','multiple'=>'multiple']) ?>
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
                                <div class="panel-heading" style="padding-top: 5px;padding-bottom: 5px;padding-right:0;">
                                    <div class="row">
                                        <div class="col-sm-11">
                                            <i class="fa fa-th-large"></i>&nbsp;&nbsp;
                                            <a style="color: white;">Final Check</a>
                                        </div>
                                        <div class="col-sm-1">
                                            <button id="activate-my-step-5" class="btn btn-sm" style="color:#204d74;height:28px;">Back</button>  
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
                                                    <label style="font-weight: normal !important;" id='preview_type'>Product Review </label>
                                                </div>
                                            </div>
                                             <div class="row">
                                                <div class="col-sm-4">
                                                    <label >Goal :</label>
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
                                                    <label style="font-weight: normal !important;" id='powner_id'></label>
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
                                            <h4 style="margin-top: 0px;margin-bottom: 0px;"> 
                                              <strong>Reviewees & Reviewers</strong></h4>
                                            <hr style="margin-top: 10px;margin-bottom: 10px;">
                                        </div>
                                    </div>
                                    <!-- End of Page Header for Review Set Up -->
                                    <!-- Main Content for Review Set Up -->
                                     <div class="row"> 
                                        <div class="col-sm-12">
                                            <label style="font-size:100%;font-style: bold">Reviewees</label>
                                        </div>
                                    </div> 
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div  id="reviewerscontainer">
                                            </div>
                                        </div>                                       
                                    </div> 

                                     <div class="row"> 
                                        <div class="col-sm-12">
                                            <label style="font-size:100%;font-style: bold">Reviewers</label>
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
                                            <h4 style="margin-top: 0px;margin-bottom: 0px;"> <strong>Questions</strong></h4>
                                            <hr style="margin-top: 10px;margin-bottom: 10px;">
                                        </div>
                                    </div>
                                    <!-- End of Page Header for Review Set Up -->
                                    <!-- Main Content for Review Set Up -->
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div id="questionscontainer">
                                                
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
                </div>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
  var reviewees = [];
  var questions = [];
  var reviewers = {};

  var deptlist;
  var orglist;
  var companylist;

    $(document).ready(function() 
    {
        var utc = new Date().toJSON().slice(0,10).replace(/-/g,'-');
                                    
        document.getElementById('stratdate').setAttribute("min", utc);

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

        hideDate("startdate");
        hideDate("enddate");
        ShowAll(); 
        buildQuestionTree('questiontree' ,<?php echo $yuistringDepartment;?>,'superquestions');
        deptlist = <?php echo json_encode($deptlist); ?>;
        orglist = <?php echo json_encode($orglist); ?>;
        companylist = <?php echo json_encode($companylist); ?>;
    });
    
    $("#revtype").change(function (e) 
    {
        if($(this).find(':selected').val() == 8)
        {
            $('#myreviewers option').remove();
            for (var key in deptlist) 
            {
                var content='';

                content +="<option value=";
                content += key;
                content += ">";
                content += deptlist[key];
                content += "</option>";
                $(content).appendTo("#myreviewers");
            }

            var itemname = document.getElementById('itemname');
            $('#itemname').empty();
            itemname.innerHTML = "Department";

            var itemtitle = document.getElementById('itemtitle');
            $('#itemtitle').empty();
            itemtitle.innerHTML = "Department";            

        }
        else if($(this).find(':selected').val() == 9)
        {
            $('#myreviewers option').remove();
            for (var key in orglist) 
            {
                //alert("org "+ key+"/"+orglist[key]);
                var content='';

                content +="<option value=";
                content += key;
                content += ">";
                content += orglist[key];
                content += "</option>";
                $(content).appendTo("#myreviewers");
            }

            var itemname = document.getElementById('itemname');
            $('#itemname').empty();
            itemname.innerHTML = "Organization"; 

            var itemtitle = document.getElementById('itemtitle');
            $('#itemtitle').empty();
            itemtitle.innerHTML = "Organization";    
        }
        else if($(this).find(':selected').val() == 10)
        {
            $('#myreviewers option').remove();
            for (var key in companylist) 
            {
                var content='';

                content +="<option value=";
                content += key;
                content += ">";
                content += companylist[key];
                content += "</option>";
                $(content).appendTo("#myreviewers");
            }

            var itemname = document.getElementById('itemname');
            $('#itemname').empty();
            itemname.innerHTML = "Company";

            var itemtitle = document.getElementById('itemtitle');
            $('#itemtitle').empty();
            itemtitle.innerHTML = "Company"; 
        }
    });

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

    function changestartdate(val)
    {
        document.getElementById('preview_startdate').innerHTML = val;
    }

    function changeenddate(val)
    {
        document.getElementById('preview_enddate').innerHTML = val;
    }

    function changeowner(val)
    {
        document.getElementById('powner_id').innerHTML = val;
    }

    var ownertable = $('#ownertable').DataTable();
    $('#ownertable tbody').on( 'click', 'tr', function () {
          $(this).toggleClass('selected');
      });

    $('#btnSelectOwner').click(function () 
    {
        var selectedrow = ownertable.rows('.selected').data(); 
        if(selectedrow.length==1)
        {
            var ownerSelect = document.getElementById('owner-id');
            var ownerText = document.getElementById('reviewowner');

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
            }
        }
    });

    var navListItems = $('ul.setup-panel li a'),
    allWells = $('.setup-content');

    allWells.hide();

    navListItems.click(function(e)
    {
        e.preventDefault();
        var $target = $($(this).attr('href')),
        $item = $(this).closest('li');
                  //alert($target.value);
                if (!$item.hasClass('disabled')) {
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
        //document.getElementById('revtype').value = 0;
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
        document.getElementById('myreviewers').value = "";   
        document.getElementById('myreviewees').value = "";//hidden

        var selectlist = document.getElementById('selectedreviewees');//view
        
        selectlist.options.length = 0;

        ShowAll();
        reviewees = [];        
        reviewers = {};

        document.getElementById('reviewerscontainer').innerHTML = "";
        document.getElementById('revieweescontainer').innerHTML = "";

        e.preventDefault();
        e.stopImmediatePropagation();
    })

    $('#refresh-my-step-3').on('click', function(e) 
    { 
        document.getElementById('superquestions').value = "";//hidden

        var qlist = document.getElementById('questions');//view        

        qlist.options.length=0;        

        $('#questiontree').empty();
        buildQuestionTree('questiontree' ,<?php echo $yuistringDepartment;?>,'superquestions');        

        questions = [];
        document.getElementById('questionscontainer').innerHTML = "";  

        e.preventDefault();
        e.stopImmediatePropagation();
    })

    $('ul.setup-panel li.active a').trigger('click');
      // DEMO ONLY //

    $('#activate-my-step-2').on('click', function(e) {
        $('ul.setup-panel li:eq(1)').removeClass('disabled');
        $('ul.setup-panel li a[href="#step-2"]').trigger('click');
        e.preventDefault();
        e.stopImmediatePropagation();
    })
    $('#activate-my-step-3').on('click', function(e) {      
        $('ul.setup-panel li:eq(2)').removeClass('disabled');
        $('ul.setup-panel li a[href="#step-3"]').trigger('click');
        e.preventDefault();
        e.stopImmediatePropagation();
    })
    $('#activate-my-step-4').on('click', function(e) {      
        $('ul.setup-panel li:eq(3)').removeClass('disabled');
        $('ul.setup-panel li a[href="#step-4"]').trigger('click');
        e.preventDefault();
        e.stopImmediatePropagation();
    })  
    
    $('#activate-my-step-5').on('click', function(e) {      
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

    var reviewerscontainer = document.getElementById('reviewerscontainer');
    $('#reviewerscontainer').empty();
    reviewerscontainer.innerHTML = $('#myreviewers option:selected').html();

    $(document).on("change" , "#myreviewers" , function() 
    {
        var reviewerscontainer = document.getElementById('reviewerscontainer');
        $('#reviewerscontainer').empty();
        reviewerscontainer.innerHTML = $('#myreviewers option:selected').html();
        //reviewers.push($('#myreviewers option:selected').val());
    });

</script>
<script type="text/javascript">
    function ShowAll()
    {
        $('#cattree1').empty();
        buildEmployeeTree('cattree1',<?php echo $yuistring;?>);
        document.getElementById('btnAll').style = "background-color:blue";
        document.getElementById('btnFilter').style = "background-color:white";
    }

    function checkLeaf(empname,selectid = "myreviewees" )
    {
        if(selectid=="myreviewees")
            changereviewees(empname.trim(),"add");
        else
            //alert("dsfsdf");
            changequestions(empname.trim(),"add");

        var sel = document.getElementById(selectid);
        for(l=0;l<sel.options.length;l++)
        {
            var text= sel.options[l].text;
            if(text.trim()==empname.trim())
            {
                sel.options[l].selected=true;    
                if(selectid.trim()=="superquestions")
                   // alert("sfsfdsfd");
                    addToQuestions(sel.options[l].value,sel.options[l].text);   
                  break;         
            }
        }
    }

    function uncheckLeaf(empname,selectid = "myreviewees" )
    {
        if(selectid=="myreviewees")
            changereviewees(empname.trim(),"remove");
        else
            changequestions(empname.trim(),"remove");

        var sel = document.getElementById(selectid);
        for(k=0;k<sel.options.length;k++)
        {
            var text= sel.options[k].text;
            if(text.trim()==empname.trim())
            {
                sel.options[k].selected=false;
                if(selectid.trim()=="superquestions")
                    removeFromQuestions(sel.options[k].value);
                break;                
            }
        }
    }

    function ChangeTree()
    {
        var groupid = document.getElementById('employeegroup').value;
        document.getElementById('btnFilter').style = "background-color:blue";
        document.getElementById('btnAll').style = "background-color:white";

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
                alert(textStatus);
                alert(errorThrown);
            });
    }

    function changereviewees(item,status)
    {
        if(status=="add" && item!='')
        {
            reviewees.push(item);
            //alert(item);

        }else
        {
            for (var i = reviewees.length - 1; i >= 0; i--) 
            {
                if(reviewees[i]==item.trim())
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

    function changequestions(question,status)
    {
        //alert("q "+question+'status'+status);
        if(status=="add")
        {
            questions.push(question);            
         }
        else
        {
            for (var i = questions.length - 1; i >= 0; i--) 
            {
                if(questions[i].trim()==question.trim())
                    questions.splice(i,1);
            }
        }

        var rowcount = questions.length/2;
        var content = "<div class='row'>";
        var divTemplate="";
        for(var i=0;i<2;i++)
        {
            if(i<=questions.length)
            {
                divTemplate += "<div class='col-md-6'>";
                divTemplate += "<ul>";
                for (var j =  0 ;  j < rowcount; j++) 
                {
                     divTemplate+= "<li>";
                    if(j*2+i < questions.length)
                        divTemplate+=  questions[(j*2)+i];
                    divTemplate+= "</li>";
                }
                divTemplate+= "</ul>";
                divTemplate+="</div>";
            }
            else
            {
                divTemplate+= "<div class='col-md-6'></div>"
            }
        }

        content += divTemplate+"</div>";
        var questionscontainer = document.getElementById('questionscontainer');
        $('#questionscontainer').empty();
        questionscontainer.innerHTML = content;
    }

    function addToQuestions(value,display)
    {
        //alert("val "+value+"display "+display);
        var questions = document.getElementById("questions");
        var isExist = false;
        for(j=0;j<questions.options.length;j++)
        {
            var text= questions.options[j].value;
            if(text.trim()==value.trim())
            {
                isExist = true;
                break;
            }
        }
        if(!isExist)
        {
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
            if(text.trim()==value.trim())
            {
                sel.removeChild(sel.options[i]);
                break;
            }
        }        
    }

    function CheckValidation()
    {
      var step1_error = false;
      var step2_error = false;
      var step3_error = false;
      var name_pattern = /^(([A-Za-z0-9]+[\-\']?)*([A-Za-z0-9]+)?\s)+([A-Za-z0-9]+[\-\']?)*([A-Za-z0-9]+)?$/;

      var txtTitle = document.getElementById('title');
      var txtGoal = document.getElementById('goal');
      var txtDescription = document.getElementById('description');
      var txtOwner = document.getElementById('reviewowner');

      var startDateCtrl = document.getElementById('stratdate');

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
      }else if(!name_pattern.test(txtOwner.value))
      {
        document.getElementById('errorOwner').innerHTML = " <i class='fa fa-long-arrow-left'></i> Please Click to add Owner!";
        step1_error = true;
      }else if(startDateCtrl.value == '')
      {
        startDateCtrl.style = "background-color:yellow;width:100%";
        errorstratdate.innerHTML = " <i class='fa fa-long-arrow-left'></i> Choose Start Date!";
        step1_error = true;
      }else if(endDateCtrl.value == '')
      {
        startDateCtrl.style = "background-color:yellow;width:100%";
        errorenddate.innerHTML = " <i class='fa fa-long-arrow-left'></i> Choose Start Date!";
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
        //step1_error = true;

        return false;
      }
      if(questions.length<1)
      {
        $('ul.setup-panel li:eq(0)').removeClass('disabled');
        $('ul.setup-panel li a[href="#step-3"]').trigger('click');
        $(this).remove();

        //questions.style = "background-color:yellow;min-width: 450px;min-height: 300px;";

        return false;
      }
      return true;
      
    }

</script>

<?= $this->Form->end() ?>
