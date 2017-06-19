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

    function myvalidationPA()
    {
        var mgcmt = document.getElementById("tmanagercomment").value;
        var epcmd = document.getElementById("temployeecomment").value;  

        var tmgcmt = document.getElementById("tmanagercomment");  
        var tepcmt = document.getElementById("temployeecomment");
        
        if(!epcmd)
        {
            alert("Please Enter Employee Comment");
            tepcmt.style="height:70px;width:400px;background-color: yellow;";
            return  false;
        }
        else
        {
            tepcmt.style="height:70px;width:400px;background-color: white;";
        }
        if(!mgcmt)
        {
            alert("Please Enter Manager Comment");
            tmgcmt.style="height:70px;width:400px;background-color: yellow;";
            return  false; 
        }
        else
        {
            tmgcmt.style="height:70px;width:400px;background-color: white;";
        }        
        
        return true;
    }

    function CreatePAFinishJson()
    {
        if(myvalidationPA())
        {     
            var currentdate = new Date();
            var mgrcmt = document.getElementById("tmanagercomment").value;
            var empcmt = document.getElementById("temployeecomment").value;

            var datetime = currentdate.getFullYear() + "-"+(currentdate.getMonth()+1) 
            + "-" + currentdate.getDate();

            var jStr = "{\"reviewid\": "+<?= $revmgid ?>+",\"reviewerid\": "+<?= $reviewermg ?>+","; 
            
            jStr+="\"revieweeid\": "+<?= $revieweemg ?>+",\"managercomment\":\""+ mgrcmt +"\",\"employeecomment\":\"" +empcmt+"\",";
            jStr+="\"IsDeleted\": false,\"created\": \""+datetime+"\",";
            jStr+="\"modified\": \""+datetime+"\",\"finish\":true,\"reviewresultdetail\": [";
            
            <?php
                for($i=0; $i <count($revieweedetail); $i++)
                {
                    echo "var questionval = 0;\n";
                    echo "var textareavalue = '';\n";
                    echo "var textareavalue = document.getElementById(\"t_".$revieweedetail[$i]['questionid']."\").value;";

                    echo "var radioList = document.getElementsByName(\"q_".$revieweedetail[$i]['questionid']."\");";
                    echo "for (var i = radioList.length - 1; i >= 0; i--) ";
                    echo "{
                        if(radioList[i].checked)
                            questionval = radioList[i].value;
                    }";

                    echo "\n jStr += \"{\\\"id\\\": \\\"".$revieweedetail[$i]['id'];
                    echo "\\\",\\\"questionid\\\": \\\"".$revieweedetail[$i]['questionid'];
                    echo "\\\",\\\"reviewresult_id\\\": \\\"".$revieweedetail[$i]['reviewresult_id'];
                    echo "\\\", \\\"mark\\\":\\\"\" + questionval + \"\\\",\\\"managercomment\\\" : \\\"\"";
                    echo "+textareavalue+\"\\\",\\\"isDeleted\\\": false, \\\"created\\\": \\\"\"+datetime+\"\\\"\";";
                    echo "jStr+=\",\\\"modified\\\": \\\"\"+datetime+\"\\\" },\";";         
           
                }
                                 
            ?>
            jStr = jStr.substring(0, jStr.length-1);
            jStr += "]}";
            //alert(jStr);
            sendJSONToAdd(jStr);
        }
    }

    function sendJSONToAdd(jsonStr = "")
    {
        //alert("reviewresultid "+<?= $reviewresultid ?>+"");
        $.ajax({
                  type: "PUT",
                  url: "<?php echo Router::url('/', true);?>reviewresult/"+<?= $reviewresultid ?>+".json",
                    data: jsonStr,
                    contentType: "application/json; charset=utf-8",
                    traditional: true
                }).done(function(result)
                {
                    //alert(result);
                    if(result!='Failed')  
                        window.location = '/reviewlist/indexpa/<?= $revmgid ?>/<?= $revtitle ?>/<?= $reviewermg ?>';
                     
                }).fail(function( jqXHR, textStatus, errorThrown) 
                {
                    console.log(jqXHR);
                    console.log(jqXHR.responseText);
                    alert("Failed");                    
                });
    }

</script>

<div id="page-wrapper">
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
            	<?= $revtitle ?>         	
            </i></label>
            <br>
            <label style="color:#337ab7">Reviewee :</label>
            <label style="color:#337ab7"><i>
                <?= $revieweename ?>
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
            $number =1;
            
            foreach ($questioncategoryList as $qclist):
            $isHasCatQuestion = false;
            for ($i=0; $i <count($revieweedetail); $i++) 
            { 
                if($revieweedetail[$i]['questiontypeid'] == $qclist->id)
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
                     for ($i=0; $i <count($revieweedetail); $i++) 
                    { 
                        if($revieweedetail[$i]['subcategoryid'] == $sublist->id)
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
                    for ($i=0; $i <count($revieweedetail); $i++) 
                    { 
                        if($revieweedetail[$i]['subcategoryid'] == $sublist->id)
                        {
                            ?>
                        <div class="row">
                            <div class="col-md-12">
                                <?= $number++?>.&nbsp;&nbsp;
                                 <i style="color: blue;"></i> <?= $revieweedetail[$i]['questionname'] ?><br/>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i style="color: blue;"></i> <?= $revieweedetail[$i]['questionnameeng'] ?>                                
                            </div>
                        </div> 
                       
                    <div class="row">
                        <div class="col-md-12" style="padding-top:15px;">
                            <?php
                          
                          echo "<input type='radio' name='q_".$revieweedetail[$i]['questionid']."' id='".$revieweedetail[$i]['questionid']."1' value='1' ";
                          if($revieweedetail[$i]['mark']==1)
                                echo "checked ";
                                echo " >Critical";                         
                            
                           echo "<input type='radio' name='q_".$revieweedetail[$i]['questionid']."' id='".$revieweedetail[$i]['questionid']."2' value='2' ";
                           if($revieweedetail[$i]['mark']==2)
                                echo "checked ";
                                echo " >Bad";
                            
                           echo "<input type='radio' name='q_".$revieweedetail[$i]['questionid']."' id='".$revieweedetail[$i]['questionid']."3' value='3' ";
                           if($revieweedetail[$i]['mark']==3)
                                echo "checked ";
                                echo " >Normal";
                            
                           echo "<input type='radio' name='q_".$revieweedetail[$i]['questionid']."' id='".$revieweedetail[$i]['questionid']."4' value='4' ";
                           if($revieweedetail[$i]['mark']==4)
                                echo "checked ";
                                echo " >Good";
                            
                           echo "<input type='radio' name='q_".$revieweedetail[$i]['questionid']."' id='".$revieweedetail[$i]['questionid']."5' value='5' ";
                           if($revieweedetail[$i]['mark']==5)
                                echo "checked ";
                                echo " >Excellent";                            
                            
                            ?>
                         </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="padding-top:-10px;padding-left:40px;">
                            <?php
                            echo "</br>";    
                            echo "<textarea name='t_".$revieweedetail[$i]['questionid']."' id='t_".$revieweedetail[$i]['questionid']."' style='height:40px;width:400px;'>".$revieweedetail[$i]['managercomment']."</textarea>";
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
                    <div class="col-md-6" style="padding-top:-10px;padding-left:40px;">
                    <?php 
                        echo "Manager Comment";
                        echo "<textarea name='tmanagercomment' id='tmanagercomment' style='height:70px;width:400px;background-color: white;'>".$infomgrcmt."</textarea>";
                        ?>
                    </div>
                    <div class="col-md-6" style="padding-top:-10px;padding-left:40px;">
                    <?php
                        echo "Employee Comment";
                        echo "<textarea name='temployeecomment' id='temployeecomment' style='height:70px;width:400px;background-color: white;'>".$infoempcmt."</textarea>";
                        ?>
                    </div>
                </div>     

            <div class="gab" style="height:25px"></div>        
        <div class="row">   
            <div class="col-xs-12">
                <input type="button" value="Finish" id="btnSubmit" name="btnSubmit" onclick='CreatePAFinishJson();'/>
            </div>
        </div>
    </div>    
</div>