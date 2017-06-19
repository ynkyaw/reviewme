<?php
/**
  * @var \App\View\AppView $this
  */
use Cake\Routing\Router;
$this->layout = 'superadmin';
?>

<script type="text/javascript" src="<?php echo Router::url('/', true);?>js/treeview.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo Router::url('/', true);?>css/gallery-yui3treeview-ng.css"></link>
<link rel="stylesheet" type="text/css" href="<?php echo Router::url('/', true);?>css/gallery-yui3treeview-ng-skin.css"></link>
<script type="text/javascript" src="<?php echo Router::url('/', true);?>js/yui-min.js"></script>
<script src="<?php echo Router::url('/', true);?>js/gallery-yui3treeview-ng-debug.js"></script>
<script src="<?php echo Router::url('/', true);?>js/myyui.js"></script>
<script src="<?php echo Router::url('/', true);?>js/date-util.js"></script>

<div id="page-wrapper1" style="margin: 0 0 0 290px;">
    <div class="row">
        <div class="col-sm-10">
            <h4 class="page-header">Edit Employee Group</h4>
        </div>
    </div>        
    
    <div class="panel-group" id="accordion">
        <div class="panel panel-info" style="width:1000px;">                                    
            <div id="groupA" class="panel-collapse collapse in">
                <div class="panel-heading">

                    <?php 
                        $message = $this->Flash->render();
                        if($message!= null && $message!="")
                        {
                            echo "<div class='alert alert-success'>".$message."</div>";
                        }
                     ?>  

                    <?= $this->Form->create($employeegroup,array('onsubmit' => 'return confirm("Are you sure you want to save?")')) ?>
                        <fieldset>
                            <div class="form-group">
                                <label for="name" style="floating:right">Group Name</label><label style="color:red;font-size:18px;">*</label>
                                <?= $this->Form->input('name',['class'=>'form-control','label'=>false,'required','onchange'=>'CheckGroupName(this)']) ?>
                            </div>
                            <div class="form-group">
                                <label for="description" style="floating:right">Group Description</label><label style="color:red;font-size:18px;">*</label>
                                <?= $this->Form->input('description',['class'=>'form-control','type' => 'textarea','label'=>false,'required','onchange'=>'CheckGroupDescription(this)']) ?>
                            </div>
                            <div class="row">
                                <div class="col-md-5">   
                                    <label for="emp" style="floating:right">Employee</label><label style="color:red;font-size:18px;">*</label>
                                    <div id="cattree1" style="width:300px; min-height:200px;border: 1px solid gray;border-radius:5px;" required>
                                    </div> 
                                </div>
                                <div class="col-md-5">
                                    <label for="emp"></label>
                                    <select id="selectedemp" multiple="multiple" class="form-control"
                                            style="width: 280px;min-height: 320px;">
                                   </select>
                                </div>
                            </div>
                            <div class="form-group" style="display:none">                                         
                                <?= $this->Form->input('employee._ids',[ 'id'=>'myreviewees','options'=>$employee,'label'=>false,'class'=>'form-control']) ?>
                            </div>
                            
                            <?= $this->Form->button('Save',['class'=>"btn btn-primary btn-sm"]) ?>
                            <?= $this->Form->end() ?>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div> 
</div>


<script type="text/javascript">
     $(document).ready(function() 
     {     
        autoEmp(myreviewees);        
    });
</script>

<script type="text/javascript">
    buildEmployeeTree('cattree1',<?php echo $yuistring;?>);
    var reviewees = [];

    function changereviewees(item,status)
    {
        //alert("in change"+item);
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
            for (var i = reviewees.length - 1; i >= 0; i--) 
            {
                if(reviewees[i]==item)
                    reviewees.splice(i,1);
            }
        }

        var selReviewees = document.getElementById('selectedemp');
        selReviewees.options.length = 0;
        for (var i = 0 ; i < reviewees.length ; i++) 
        {
          var opt = document.createElement('option');
          opt.innerHTML =reviewees[i];
          selReviewees.appendChild(opt);    
        }
    }


    function  checkLeaf(empname,selectid = "myreviewees" )
    {
        var sel = document.getElementById(selectid);
        for(i=0;i<sel.options.length;i++)
        {
            var text= sel.options[i].text;
            if(text.trim()==empname.trim())
            {
                sel.options[i].selected=true;
            }
        }

        if(selectid == "myreviewees")
        {
            changereviewees(empname.trim(),"add");
        }
    }

    function  uncheckLeaf(empname,selectid = "myreviewees" )
    {
        var sel = document.getElementById(selectid);
        for(i=0;i<sel.options.length;i++)
        {
            var text= sel.options[i].text;
            if(text.trim()==empname.trim())
            {
                sel.options[i].selected=false;
            }
        }
        if(selectid=="myreviewees")
        {
            changereviewees(empname.trim(),"remove");
        }
    }

    function autoEmp(selectemp)
    {
        var sel1 = selectemp;

        var selReviewees = document.getElementById('selectedemp');
        selReviewees.options.length = 0;
        for(i=0;i<sel1.length;i++)
        {  
		
              
            if(sel1.options[i].selected==true)
            {
                var opt = document.createElement('option');
                opt.innerHTML =sel1.options[i].text.trim();
                selReviewees.appendChild(opt);  

                if(reviewees.indexOf(sel1.options[i].text)>0)
                {
                  //do nothings
                }
                else
                {
                  reviewees.push(sel1.options[i].text);
                }
            }                   
        }
    }

    function CheckGroupName(txtGroupName)
    {
         var name_pattern = /^(([A-Za-z0-9]+[\-\']?)*([A-Za-z0-9]+)?\s)+([A-Za-z0-9]+[\-\']?)*([A-Za-z0-9]+)?$/;
         var singleName =/^[A-Za-z0-9]+$/;

         //var txtDepartmentName = document.getElementById("departmentname");
         var rankValue = txtGroupName.value.trim();
         if(rankValue == "")
         {
            txtGroupName.setCustomValidity("Group Name Required!");  
         }
         else if(rankValue.length<2)
         {
            txtGroupName.setCustomValidity("Group Name length error!");
           
         }else if(!name_pattern.test(rankValue)&&!singleName.test(rankValue))
         {
            txtGroupName.setCustomValidity("Group Title pattern mismatch!");
         }else {
            txtGroupName.setCustomValidity("");
         }

    }

    function CheckGroupDescription(txtDescription)
    {
         var rankDescriptionValue = txtDescription.value.trim();
         if(rankDescriptionValue == "")
         {
          txtDescription.setCustomValidity("Group Description Required!");  
         }
         else if(rankDescriptionValue.length<1)
         {
            txtDescription.setCustomValidity("Group Description length error!");
         }else {
            txtDescription.setCustomValidity("");
         }

    }

</script>
