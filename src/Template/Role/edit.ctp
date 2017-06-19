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
            <h4 class="page-header">Set Role And Menu</h4>
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

                    <?= $this->Form->create($role,array('onsubmit' => 'return confirm("Are you sure you want to save?")')) ?>
                        <fieldset>
                            <div class="">
                                <label for="warning" style="color:red;font-size:18px;text-align:center;">(*) </label><label style="color:red;">&nbsp;&nbsp;required fields</label>
                            </div>                            
                            <div class="form-group">
                                <label for="name" style="floating:right">Role</label><label style="color:red;font-size:18px;">*</label>
                                <?= $this->Form->input('rolename',['class'=>'form-control','label'=>false,'required','onchange'=>'CheckRole(this)']) ?>
                            </div>                            
                            <div class="row">
                                <div class="col-md-5">   
                                    <label for="emp" style="floating:right">Menu</label><label style="color:red;font-size:18px;">*</label>
                                    <div id="cattree1" style="width:300px; min-height:200px;border: 1px solid gray;border-radius:5px;">
                                    </div>
                                </div>                                 
                                    <!-- End of Tree View -->
                                <div class="col-md-5">
                                    <label for="emp"></label>
                                    <select id="selectedmenu" multiple="multiple" class="form-control"
                                            style="width:280px;min-height:320px;">
                                   </select>
                                </div> 
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
     $(document).ready(function() 
     {     
        autoMenu(mymenus);        
    });
</script>

<script type="text/javascript">

    buildMenuTree('cattree1',<?php echo $yuistring;?>);
    var menus = [];

    function changemenus(item,status)
    {
        //alert("in change"+item);
        if(status=="add" && item!='')
        {
            if(menus.indexOf(item)>0)
            {
              //do nothings
            }
            else{
              menus.push(item);
            }
            //alert(item);

        }else
        {
            for (var i = menus.length - 1; i >= 0; i--) 
            {
                if(menus[i]==item)
                    menus.splice(i,1);
            }
        }

        var selMenus = document.getElementById('selectedmenu');
        selMenus.options.length = 0;
        for (var i = 0 ; i < menus.length ; i++) 
        {
          var opt = document.createElement('option');
          opt.innerHTML =menus[i];
          selMenus.appendChild(opt);    
        }
    }


    function  checkLeaf(menuname,selectid = "mymenus" )
    {               
        var sel = document.getElementById(selectid);
        for(i=0;i<sel.options.length;i++)
        {
            var text= sel.options[i].text;
            if(text==menuname)
            {
                sel.options[i].selected=true;
            }
        }

        //alert("in leaf");
        if(selectid == "mymenus")
        {
            changemenus(menuname,"add");
        }
    }

    function  uncheckLeaf(menuname,selectid = "mymenus")
    {
        var sel = document.getElementById(selectid);
        for(i=0;i<sel.options.length;i++)
        {
            var text= sel.options[i].text;
            if(text==menuname)
            {
                sel.options[i].selected=false;
            }
        }
        if(selectid=="mymenus")
        {
            changemenus(menuname,"remove");
        }
    }

    function autoMenu(selectedmenu)
    {
        var sel1 = selectedmenu;

        var selMenus = document.getElementById('selectedmenu');
        selMenus.options.length = 0;
        for(i=0;i<sel1.length;i++)
        {                       
            if(sel1.options[i].selected==true)
            {
                var opt = document.createElement('option');
                opt.innerHTML =sel1.options[i].text.trim();
                selMenus.appendChild(opt);  

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

    function CheckRole(txtrole)
    {
         var rankDescriptionValue = txtrole.value.trim();
         if(rankDescriptionValue == "")
         {
          txtrole.setCustomValidity("Role Name Required!");  
         }
         else if(rankDescriptionValue.length<1)
         {
            txtrole.setCustomValidity("Role Name length error!");
         }else {
            txtrole.setCustomValidity("");
         }

    }
</script>
