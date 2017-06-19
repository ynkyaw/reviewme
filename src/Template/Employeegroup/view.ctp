<?php
/**
  * @var \App\View\AppView $this
  */
$this->layout = 'superadmin';
?>

<div id="page-wrapper1" style="margin: 0 0 0 290px;">
    <div class="row">
        <div class="col-sm-10">
            <h4 class="page-header">Employee Group</h4>
        </div>
    </div>        
    
    <div class="panel-group" id="accordion">
        <div class="panel panel-info" style="width:1000px;">                                    
            <div id="groupA" class="panel-collapse collapse in">
                <div class="panel-heading">
                    <?= $this->Form->create($employeegroup) ?>
                        <fieldset>
                            <div class="form-group">
                                <label for="name">Group Name</label>
                                <?= $this->Form->input('name',['class'=>'form-control','disabled'=>'disabled','label'=>false]) ?>
                            </div>
                            <div class="form-group">
                                <label for="description">Group Description</label>
                                <?= $this->Form->input('description',['class'=>'form-control','type' => 'textarea','disabled'=>'disabled','label'=>false]) ?>
                            </div>
                            <div class="form-group">
                                <label for="emp">Employee</label>
                                    <select id="selectedemp" multiple="multiple" class="form-control"
                                            style="width: 280px;min-height: 300px;">
                                   </select>                               
                            </div>
                            <div class="form-group" style="display:none">                                         
                                <?= $this->Form->input('employee._ids',[ 'id'=>'myreviewees','options'=>$employee,'label'=>false,'class'=>'form-control']) ?>
                            </div>
                            
                            <?= $this->Form->end() ?>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div> 
</div>
<script type="text/javascript">
    var reviewees = [];
    $(document).ready(function() 
     {     
        autoEmp(myreviewees);      
        //alert("fsdf "+myreviewees);  
    });

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
</script>

