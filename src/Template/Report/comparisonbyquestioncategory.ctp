<?php
use Cake\Routing\Router;
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

    #btnSubmit
    {
       position: relative;
       top: 0px;   
       width: 80px;
       padding: 10px;
       -webkit-border-radius: 5px;
       border: 1px #BBB; 
       text-align: center;
       background-color:#337ab7;
       color:white;
       cursor:pointer;
    }

    table.dataTable.no-footer 
    {
        width: 100%;
        margin: 0 auto;
        clear: both;
        border-collapse: separate;
        border-spacing: 0;
    }

    a.button
    {
       position: relative;
       top: 0px;   
       width: 90px;
       padding: 12px;
       -webkit-border-radius: 5px;
       -moz-border-radius: 5px;
       border: 1px #BBB; 
       text-align: center;
       background-color:#337ab7;
       color:white;
       cursor:pointer;
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

<div id="page-wrapper">
    <div class="gab" style="height:30px"></div>
    <div class="row">
        <div class="col-sm-10">
           <h4>Comparison by Others and Self By Each Question Category</h4>
        </div>
    </div>
    <div class="gab" style="height:30px"></div>
    <div class="" style="border: solid 0.1em;border-color: #bce8f1;padding: 45px 40px 40px 25px;">
        <div class="row">
            <div class="col-md-2">
                <label for="name">Year</label>                                   
                    <?= $this->Form->input('startdate',['options' => $yearlist,'class'=>'form-control','label'=>false,'id' => 'yearlist']) ?>
            </div>
            <div class="col-md-3">
                <label for="name">Performance</label>                                   
                    <?= $this->Form->input('id',['options' => $reviewlist,'class'=>'form-control','label'=>false,'id' => 'revlist']) ?>
            </div>
            <div class="col-md-3">
                <label for="name">Department</label>                                   
                    <?= $this->Form->input('id',['options' => $deptlist,'class'=>'form-control','label'=>false,'id' => 'deptlist']) ?>
            </div>
            <div class="col-md-3">
                <label for="name">Employee</label>                                   
                    <?= $this->Form->input('id',['options' => $emplist,'class'=>'form-control','label'=>false,'id' => 'emplist']) ?>
            </div>
            <div class="col-md-1">
                <label for=""></label>
                <br/>
                <input type="button" value=" Show " id="btnSubmit" name="btnSubmit" style="floating:right;"/>
                <br /><br />
                <a href="/report/excelExportByQC" onclick="location.href=this.href+'/'+document.getElementById('revlist').options[document.getElementById('revlist').selectedIndex].value+'/'+document.getElementById('emplist').options[document.getElementById('emplist').selectedIndex].value;return false;" class="button">Download</a>
            </div>
        </div>
        <div class="gab" style="height:30px"></div>
        <!-- ownertable -->
         <div class="row">
            <div class="col-sm-12" id="displayArea">                
                
            </div>
        </div>
    </div> 
</div>

<script>
$(document).ready(function()
{
    $("#deptlist").change(function (e) 
    {
        //alert("selected is"+$(this).find(':selected').val());
        loadEmployee($(this).find(':selected').val());
    });

    $("#yearlist").change(function (e)
    {
        //alert("selected is"+$(this).find(':selected').val());
        loadReview($(this).find(':selected').val());
    });
    

    $("#btnSubmit").click(function (e) 
    {
        var eval = document.getElementById("revlist");
        ee_id = eval.options[eval.selectedIndex].value;

        var dept = document.getElementById("deptlist");
        dd_id = dept.options[dept.selectedIndex].value;
        
        var emp = document.getElementById("emplist");
        emp = emp.options[emp.selectedIndex].value;

        loadResult(ee_id,emp);
        
    });

    });

    function loadEmployee(dept_id)
    {
        //alert(dept_id);
        $.ajax({              
              url: "<?php echo Router::url('/', true);?>report/getempList/"+dept_id+"",
              type: "POST"
            }).done(function(result)
            {
                if(result != '' || result != null)
                {    
                    $('#emplist option').remove();

                    var responsedData = JSON.parse(result);
                    var empArray = responsedData.result;
                    
                    for(var i=0;i< empArray.length;i++)
                    {
                       var content='';

                        content +="<option value=";
                        content += empArray[i].id;
                        content += ">";
                        content += empArray[i].name;
                        content += "</option>";
                        $(content).appendTo("#emplist");
                    }
                    $("#emplist").prepend("<option value='0' selected='selected'>All</option>");
                }
               
            }).fail(function ( jqXHR, textStatus, errorThrown ) 
            {               
                console.log(jqXHR);
                console.log(jqXHR.responseText);
                alert(textStatus);
                alert(errorThrown);
            });
    }

    function loadReview(revyear)
    {
        $.ajax({              
              url: "<?php echo Router::url('/', true);?>report/getreviewlist/"+revyear+"",
              type: "POST"
            }).done(function(result)
            {
                if(result != '' || result != null)
                {    
                    $('#revlist option').remove();

                    var responsedData = JSON.parse(result);
                    var reviewArray = responsedData.result;
                    
                    for(var i=0;i< reviewArray.length;i++)
                    {
                       var content='';

                        content +="<option value=";
                        content += reviewArray[i].id;
                        content += ">";
                        content += reviewArray[i].title;
                        content += "</option>";
                        $(content).appendTo("#revlist");
                    }

                    $("#revlist").prepend("<option value='0' selected='selected'>All</option>");
                }
               
            }).fail(function ( jqXHR, textStatus, errorThrown ) 
            {               
                console.log(jqXHR);
                console.log(jqXHR.responseText);
                alert(textStatus);
                alert(errorThrown);
            });
    }

    function loadResult(review_id,emp_id)
    {
        $('#ownertable').empty();
        //reviewid = document.getElementById('').options[dept.selectedIndex].value;
        $.ajax({              
              url: "<?php echo Router::url('/', true);?>report/getqccompareResult/"+review_id+"/"+emp_id,
              type: "POST"
            }).done(function(result)
            {
                console.log(result);
                if(result != '' || result != null)
                {  
                    var responsedData = JSON.parse(result);
                    var resultArray = responsedData.result;
                    var content = '';
                    var count = 1;

                    content += "<table id=\"ownertable\" cellspacing=\"0\" width=\"100%\" class=\"display dataTable\" name=\"display\"><thead><tr><th style='text-align:center'>No</th><th style='text-align:center'>Question Category</th><th style='text-align:center'>Others</th><th style='text-align:center'>Self</th><th style='text-align:center'>Different</th></tr></thead>";
                    
                    for(var i=0;i<resultArray.length;i++)
                    {
                        content += "<tr><td style='text-align:right;'>"+count+"</td>";
                        content += "<td >";
                        content += resultArray[i].name.trim();
                        content += "</td>";

                        content += "<td style='text-align:center;'>"+parseFloat(resultArray[i].Others).toFixed(2)+ "</td>"; 
                        content += "<td style='text-align:center;'>"+parseFloat(resultArray[i].Self).toFixed(2)+"</td>";
                        var finalval = parseFloat(resultArray[i].Others).toFixed(2) - parseFloat(resultArray[i].Self).toFixed(2);
                        if(finalval >= 0)
                        {
                            content += "<td style='text-align:right;color:blue;'>"+parseFloat(finalval).toFixed(2)+"</td></tr>";
                        }
                        else
                        {
                            var value1 = parseFloat(finalval).toFixed(2);
                            content += "<td style='text-align:right;color:red'>"+Math.abs(value1)+"</td></tr>";
                        }
                        
                       count++;
                    }
                    //alert("content is "+content);
                    content += "<br>";
                    content += "</tbody></table>";

                    var displayArea = document.getElementById('displayArea');
                    displayArea.innerHTML = content;

                    var ownertable = $('#ownertable').DataTable();

                    var filter = document.getElementById('ownertable_filter');
                    filter.style = "visibility:hidden";                   
                }
               
            }).fail(function ( jqXHR, textStatus, errorThrown ) 
            {                
                console.log(jqXHR);
                console.log(jqXHR.responseText);
                alert(textStatus);
                alert(errorThrown);
            });
    }

</script>