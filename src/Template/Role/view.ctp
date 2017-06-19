
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
            <h4 class="page-header">View Role And Menu</h4>
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

                    <?= $this->Form->create($role) ?>
                        <fieldset>                        
                            <div class="form-group">                                
                                <?= $this->Form->input('rolename',['class'=>'form-control','label'=>false,'disabled' => 'disabled']) ?>
                            </div>                            
                            

                            <div class="form-group">
                                <label for="emp">Menu</label>
                                    <select id="selectedmenu" multiple="multiple" class="form-control"
                                            style="width: 280px;min-height: 300px;">
                                   </select>                               
                            </div>
                            <div class="form-group" style="display:none">                                         
                                <?= $this->Form->input('menu._ids',[ 'id'=>'mymenus','options'=>$menu,'label'=>false,'class'=>'form-control']) ?>
                            </div>

                            
                            <div class="form-group">
                                <?= $this->Form->button('Save',['class'=>"btn btn-primary btn-sm"]) ?>
                                <?= $this->Form->end() ?>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div> 
</div>
<script type="text/javascript">
    var menus = [];
    $(document).ready(function() 
     {     
        autoMenu(mymenus);      
        //alert("fsdf "+myreviewees);  
    });

    function autoMenu(mymenus)
    {
        var sel1 = mymenus;

        var selMenues = document.getElementById('selectedmenu');
        selMenues.options.length = 0;
        for(i=0;i<sel1.length;i++)
        {     
            if(sel1.options[i].selected==true)
            {
                var opt = document.createElement('option');
                opt.innerHTML =sel1.options[i].text.trim();
                selMenues.appendChild(opt);  

                if(menus.indexOf(sel1.options[i].text)>0)
                {
                  //do nothings
                }
                else
                {
                    menus.push(sel1.options[i].text);
                }
            }                   
        }
    }
</script>