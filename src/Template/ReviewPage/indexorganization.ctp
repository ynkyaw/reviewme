<?php
use Cake\Routing\Router;
use  Cake\Cache\Cache;
/**
  * @var \App\View\AppView $this
  */
$this->layout = 'superadmin';
?>

<style type="text/css">
    input[type=radio] 
    {
       width:40px;
       padding-left:0px;
    }
    input[type=button] 
    {
       align:left;
    }
    #btnSubmit,#btnSubmit1
    {
       position: relative;
       top: 0px;   
       width: 80px;
       padding: 8px;
       -webkit-border-radius: 5px;
       -moz-border-radius: 5px;
       border: 1px #BBB; 
       text-align: center;
       background-color:#337ab7;
       color:white;
       cursor:pointer;
    }
</style>
    
<script type="text/javascript">

function myvalidation360()
{
    <?php
    echo "var isChecked = false;\n";
    echo "var num = 1;";
    foreach ($questionsss as $sss)
    {
        echo "\nvar radioList = document.getElementsByName('q_".$sss->id."');";

        echo "isChecked = false;\n";
        echo "for (var i = 0; i <radioList.length; i++) ";
        echo "{";
        echo "if(radioList[i].checked)";
            echo "{";
            echo "isChecked = true;";
            echo "break;";
            echo "}";
        echo "}";
        echo "if(!isChecked)";
        echo "{";
        echo "alert(\"Please choose one answer for question number \"+num+\". ".$sss->questionname ."\");";
        echo "return false;";
        echo "}";                   
        echo "num++;";
    }
        echo "return true;";
    ?>
}

function CreateJson()
{
    var btn = document.getElementById('btnSubmit');
    btn.disabled = true;

    if(myvalidation360())
    {
        var currentdate = new Date();
        var datetime = currentdate.getFullYear() + "-"+(currentdate.getMonth()+1) 
        + "-" + currentdate.getDate();

        var jStr = "{\"organizationreviews_id\": "+<?=$reviewid?>+",\"reviewerid\": "+<?=$reviewerid?>+","; 
        
        jStr+="\"revieweeid\": "+<?=$orgid?>+",\"isdeleted\": false,\"created\": \""+datetime+"\",";
        jStr+="\"modified\": \""+datetime+"\",\"finish\":true,\"organizationreviewsresultdetail\": [";
        
        <?php
            $count = 1;
            foreach ($questionss as $ss)
            {
		        echo "var questionval = 0;\n";
		        echo "var radioList = document.getElementsByName(\"q_".$ss->id ."\");";
		        echo "for (var i = radioList.length - 1; i >= 0; i--) ";
		        echo "{
		            if(radioList[i].checked)
		                questionval = radioList[i].value;
		        }";

		        echo "\njStr+=\"{\\\"question_id\\\": \\\"".$ss->id."\\\", \\\"mark\\\":\\\"\" + questionval + \"\\\",\\\"isdeleted\\\": false, \\\"created\\\": \\\"\"+datetime+\"\\\"\";
		            jStr+=\",\\\"modified\\\": \\\"\"+datetime+\"\\\" },\";";       
		       
		            $count++;            
            }     
        ?>
        jStr = jStr.substring(0, jStr.length-1);
        jStr += "]}";
        alert(jStr);
        sendJSON(jStr);
     }
     btn.disabled = false;
}

function sendJSON(jsonStr)
{
    $.ajax({
          	type: "POST",
          	url: "<?php echo Router::url('/', true);?>organizationreviewsresults.json",
            data: jsonStr,
            contentType: "application/json; charset=utf-8",
            traditional: true
            }).done(function(result)
            {          
	        	alert(result);  
	            if(result!='Failed')
	            {
	                window.location = '/reviewlist/indexorganization/'+<?= $reviewid ?>+'';
	            }
                           
            }).fail(function( jqXHR, textStatus, errorThrown ) 
            {
            	alert(textStatus);
                console.log(jqXHR);
                console.log(jqXHR.responseText);
            });
    
}

</script>

<div id="page-wrapper">
    <?php 
    if($questions != null)
            {?>
    <div class="row">
        <div class="col-sm-12">
            <label class="" style="color:red;margin-top:15px;">**You Should Mark All Questions**</label>
            <hr />
           <!-- page-header -->
        </div>
    </div>
    <div class="row">
        <div class="col-sm-10">
            <label style="color:#337ab7">Performance :</label>
            <label style="color:#337ab7"><i>            	
            	<?=	$reviewname->title ?>         		
                        	
            </i></label>
            <br>
            <label style="color:#337ab7">Reviewee :</label>
            <label style="color:#337ab7"><i>
            <?php
                if($departmentname != null)
                {
            	foreach ($departmentname as $departmentname):
            ?>
         		<?= $departmentname->departmentname ?>

         	<?php endforeach; 
         }
         if($companyname != null)
         {
            foreach ($companyname as $companyname):
            ?>
                <?= $companyname->name ?>

            <?php endforeach; 
         }
        
         if($orgname != null)
         {
            foreach ($orgname as $orgname):
            ?>
                <?= $orgname->name ?>

            <?php endforeach; 
        }?>
          </i></label>
        </div>
    </div>

    <div class="row well" style="margin: 0 0 0 2px;width:1000px;">
        <div class="row">
            <div class="col-md-10">
                <label style="text-align:center;display:block;color:#337ab7;font-size:20px;">Question</label>
            </div>
        </div>
        <div class="row" style="height:15px;"></div> 
        <?php
        $number=1;
        
        foreach ($questioncategoryList as $qclist):
            $isHasCatQuestion = false;
            for ($i=0; $i <count($questions); $i++) 
            { 
                if($questions[$i]->questiontypeid == $qclist->id)
                {
                    $isHasCatQuestion = true;
                    break;
                }
            }

            if($isHasCatQuestion)
            {
            ?>
            <div class="row">
                <div class="col-md-12" style="background-color:#337ab7">           
                    <label style="color:white">&nbsp;&nbsp;Question Category - &nbsp;&nbsp;<?= $qclist->questioncategoryname ?>                           
                    </label>
                </div>
           </div>
           <?php
            foreach ($subcategoryList as $sublist):

                if($qclist->id==$sublist->questioncategoryid)
                {
                    $isHasQuestion = false;
                     for ($i=0; $i <count($questions); $i++) 
                    { 
                        if($questions[$i]->subcategoryid == $sublist->id)
                        {
                            $isHasQuestion = true;
                            break;
                        }
                    }
                    if($isHasQuestion)
                    {
                ?>
                <div class="row" style="height:3px;"></div> 
                <div class="row">
                    <div class="col-md-12" style="background-color:#56B949;">           
                        <label style="color:white">&nbsp;&nbsp;<i>Subategory - &nbsp;&nbsp;<?= $sublist->name ?></i>                           
                        </label>
                    </div>
                </div>
                <div class="row" style="height:15px;">
                </div>   
                    <?php
                    for ($i=0; $i <count($questions); $i++) 
                    { 
                        if($questions[$i]->subcategoryid == $sublist->id)
                        {
                            ?>
                        <div class="row">
                            <div class="col-md-12">
                                <?= $number++?>.&nbsp;&nbsp;
                                 <i style="color: blue;"></i> <?= $questions[$i]->questionname ?><br/>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i style="color: blue;"></i> <?= $questions[$i]->questionnameeng ?>                                
                            </div>
                        </div>                

                    <div class="row">
                        <div class="col-md-12" style="padding-top:15px;">
                            <?php
                           
                            echo "<input type='radio' name='q_".$questions[$i]->id."' id='".$questions[$i]->id."1' value='1'>Critical";
                            
                            echo "<input type='radio' name='q_".$questions[$i]->id."' id='".$questions[$i]->id."2' value='2'>Bad";
                            
                            echo "<input type='radio' name='q_".$questions[$i]->id."' id='".$questions[$i]->id."3' value='3'>Average";
                            
                            echo "<input type='radio' name='q_".$questions[$i]->id."' id='".$questions[$i]->id."4' value='4'>Good";
                            
                            echo "<input type='radio' name='q_".$questions[$i]->id."' id='".$questions[$i]->id."5' value='5'>Excellent";
                            
                            ?>
                         </div>
                    </div>
                    <div class="gab" style="height:25px"></div>
                <?php 
                }
            }
        }
        }                
        ?>         
        
         <?php  
            endforeach; 
        }
            endforeach;
         ?>
        <div class="row">   
            <div class="col-xs-12">
                <input type="button" value="Finish" id="btnSubmit" name="btnSubmit" onclick='CreateJson();'/>
            </div>
        </div>
    </div>
	<?php
	}
    else
    {?>
        <div class="row">
        <div class="col-sm-12">
            <label class="" style="color:#337ab7;margin-top:15px;align:center">** Thank You **</label>
            <hr />
           <!-- page-header -->
        </div>
        </div>
    <?php
    }
    ?>

</div>
