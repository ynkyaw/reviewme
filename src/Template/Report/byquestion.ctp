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
       -moz-border-radius: 5px;
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
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
           <h4>Employee Report By Question</h4>
        </div>
    </div>
    <div class="gab" style="height:30px"></div>
        <div class="row">
            <div class="col-md-4">
                <label for="name">Performance</label>

                    <?= $this->Form->input('name',['class'=>'form-control','label'=>false,'id'=>'tags']) ?>
            </div>
            <div class="col-md-4">
                <label for="name">Department</label>                                   
                    <?= $this->Form->input('id',['options' => $deptlist,'class'=>'form-control','label'=>false,'id' => 'deptlist']) ?>
            </div>
            <div class="col-md-4">
                <label for=""></label>
                <br/>
                <input type="button" value=" Show " id="btnSubmit" name="btnSubmit" style="floating:right;"/>

                <a href="/report/excelExport" onclick="location.href=this.href+'/'+document.getElementById('revlist').options[document.getElementById('revlist').selectedIndex].value+'/'+document.getElementById('deptlist').options[document.getElementById('deptlist').selectedIndex].value;return false;" class="button">Download</a>
            </div>
        </div>
        <div class="gab" style="height:30px"></div>
        <!-- ownertable -->
         <div class="row">
            <div class="col-sm-12" id="displayArea">                
                
            </div>
        </div> 
       <!--  <div class="ui-widget">
          <label for="tags">Tags: </label>
          <input id="tags">
        </div> -->
  </div>

<script>
$(document).ready(function(){ 
    var revnameauto = [];

    $.ajax({              
              url: "<?php echo Router::url('/', true);?>report/autoComplete",
              type: "POST"
            }).done(function(result)
            {
                if(result != '' || result != null)
                { 
                    var reviewjson = JSON.parse(result);
                    var revArray = reviewjson.result;

                    for(var i=0;i<revArray.length;i++)
                    {
                        revnameauto.push(revArray[i].title);
                        //alert(revArray[i].title);
                    }
                }
               
            }).fail(function (jqXHR, textStatus, errorThrown) 
            {               
                console.log(jqXHR);
                console.log(jqXHR.responseText);
                alert(textStatus);
                alert(errorThrown);
            });

    $("#tags").autocomplete({
      source: revnameauto
    });

    //for autocomplete employee dropdown
  /*  $("#revlist").change(function (e) 
    {
        //alert("selected is"+$(this).find(':selected').val());
        loadDept($(this).find(':selected').val());
    });
*/

    $("#btnSubmit").click(function (e) 
    {
        //var eval = document.getElementById("revlist");
        
       // ee_id = eval.options[eval.selectedIndex].value;

        var revname = $("#tags").val();

        var dept = document.getElementById("deptlist");
        dd_id = dept.options[dept.selectedIndex].value;
       
        loadResult(revname,dd_id);        
    });

    });

    
    $('#tags').on('blur', function() {
        //alert("name is " + $("#tags").val());
        loadDept($("#tags").val());
    });

    function excelExport(eid,did)
    {
        //alert(eid+did);
        $.ajax({              
              url: "<?php echo Router::url('/', true);?>report/excelExport/"+eid+"/"+did+"",
              type: "POST"
            }).done(function(result)
            {
                //alert(result);

            }).fail(function ( jqXHR, textStatus, errorThrown ) 
            {               
                console.log(jqXHR);
                console.log(jqXHR.responseText);
                alert(textStatus);
                alert(errorThrown);
            });
    }

    function loadDept(rev_name)
    {
        //alert("rev name is "+rev_name);
        $.ajax({              
              url: "<?php echo Router::url('/', true);?>report/getdeptList/"+rev_name+"",
              type: "POST"
            }).done(function(result)
            {
                if(result != '' || result != null)
                {    
                    $('#deptlist option').remove();

                    var responsedData = JSON.parse(result);
                    var departmentArray = responsedData.result;
                    
                    for(var i=0;i< departmentArray.length;i++)
                    {
                       var content='';

                        content +="<option value=";
                        content += departmentArray[i].id;
                        content += ">";
                        content += departmentArray[i].departmentname;
                        content += "</option>";
                        $(content).appendTo("#deptlist");
                    }
                    $("#deptlist").prepend("<option value='0' selected='selected'>All</option>");
                }
               
            }).fail(function ( jqXHR, textStatus, errorThrown ) 
            {               
                console.log(jqXHR);
                console.log(jqXHR.responseText);
                alert(textStatus);
                alert(errorThrown);
            });
    }

    //original is with revid and deptid
    function loadResult(review_name,dept_id)
    {
        $('#ownertable').empty();
        //reviewid = document.getElementById('').options[dept.selectedIndex].value;
        $.ajax({              
              url: "<?php echo Router::url('/', true);?>report/getResult/"+dept_id+"/"+review_name,
              type: "POST"
            }).done(function(result)
            {
                if(result != '' || result != null)
                {  
                    var responsedData = JSON.parse(result);
                    var resultArray = responsedData.result;
                    var content = '';
                    var count = 1;

                    content += "<table id=\"ownertable\" cellspacing=\"0\" width=\"100%\" class=\"display dataTable\" name=\"display\"><thead><tr><th style='text-align:center'>No</th><th style='text-align:center'>Question</th><th style='text-align:center'>Score With Weight</th><th style='text-align:center'>Score With Weight(%)</th><th style='text-align:center'>Score Without Weight</th></tr></thead>";
                    
                    for(var i=0;i<resultArray.length;i++)
                    {
                        content += "<tr><td style='text-align:right;'>"+count+"</td>";
                        content += "<td >";
                        content += "<i style='color: blue;'>MM</i>";
                        content += resultArray[i].questionname.trim() +"<br/>";
                        content += "<i style='color: blue;'>ENG</i>";
                        content += resultArray[i].questionnameeng;
                        content += "</td>";

                        content += "<td style='text-align:center;'>"+parseFloat(resultArray[i].WeightScore).toFixed(2)+" / " +parseFloat(resultArray[i].MaxScore).toFixed(2)+ "</td>"; 
                        content += "<td style='text-align:center;'>"+parseFloat((resultArray[i].WeightScore/resultArray[i].MaxScore)*100).toFixed(2)+"</td>";
                        content += "<td style='text-align:right;'>"+resultArray[i].Score+"</td></tr>";
                        
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
