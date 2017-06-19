<?php
/**
  * @var \App\View\AppView $this
  */

    use Cake\Routing\Router;
    $this->layout = 'superadmin';

?>

<style type="text/css">
.not-active 
{
   pointer-events: none;
   cursor: default;
}

</style>
<div id="page-wrapper">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-header">Organization Review List (Department,Team,Company)</h4>
        </div>                     
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?php 
                $message = $this->Flash->render();
                if($message!= null){
                    echo "<div class='alert alert-success'>".$message."</div>";
                }
             ?>                    
        </div>                
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-sm-10">
                            <a style="color: white;" data-toggle="collapse" data-target="#demo">Organization Review List </a>
                        </div>
                        <div class="col-sm-2" style="text-align: right;">
                            <a href="<?php echo Router::fullBaseUrl();?>/organizationreviews/add" style="color: white;">
                                <i class="fa fa-plus-square" style="font-size:1.5em;"></i>
                                &nbsp;&nbsp;New
                            </a>
                        </div>
                    </div>
                </div>
                <div id="demo" class="collapse">
                    <div class="panel-body">
                        <div class="table-responsive">
                        <table width="100%" class="table table-striped table-bordered table-hover" >
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Goals</th>
                                    <th>Reviewers</th>
                                    <th>Status</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if($organizationreviews!=null)
                                {
                                    $i = 0;
                                    foreach ($organizationreviews->result as $td)
                                    {
                                        if($i%2==0) echo '<tr class="even gradeC">';
                                        else echo '<tr class="odd gradeX">';
                                        echo "<td>".$td->title."</td>";
                                        echo "<td>".$td->goal."</td>";
                                        echo "<td>".$td->reviewers."</td>";      

                                        if($td->results>0) 
                                            echo "<td>On Going</td><td><button type=\"button\" class=\"btn btn-default\" disabled>Delete</button></td>";
                                        else
                                            echo "<td>Incoming</td><td><button type=\"button\" class=\"btn btn-default\" onclick=\"Delete(".$td->id.",'".$td->title."');\" >Delete</button></td>";
                                        echo "</tr>";
                                        $i++;
                                    }
                                }
                                ;?>                             
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
        </div>
        <!-- /.panel -->
    </div>    
</div>   

<script type="text/javascript">

    function Delete(id,title)
    {
        var result = confirm("Do you want to delete the selected review ("+title+")");
        if(result)
        {
            $.ajax({
                      type: "POST",
                      url: "<?php echo Router::fullBaseUrl();?>/organizationreviews/delete/"+id
                      
                    }).done(function(result)
                    {   
                        if(result=="Success")
                        {
                            alert("Delete Success!");
                            window.location = "<?php echo Router::fullBaseUrl();?>/organizationreviews/";
                        }

                    }).fail(function ( jqXHR, textStatus, errorThrown ) 
                    {
                        console.log(jqXHR);
                        console.log(jqXHR.responseText);
                        alert(textStatus);
                        alert(errorThrown);
                    });
        }
    }

</script>