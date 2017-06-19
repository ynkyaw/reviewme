<?php
/**
  * @var \App\View\AppView $this
  */

    use Cake\Routing\Router;
    $this->layout = 'superadmin';

?>

<style type="text/css">
    .not-active {
   pointer-events: none;
   cursor: default;
}

</style>
<div id="page-wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-header">Employee Review List</h4>
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
                                <a style="color: white;" data-toggle="collapse" data-target="#demo">Performance Apprisal Categorized List</a>
                            </div>
                            <div class="col-sm-2" style="text-align: right;">
                                <a href="<?php echo Router::url('/', true);?>review/add" style="color: white;">
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
                                    <th>Categories</th>
                                    <th>Reviewers</th>
                                    <th>Reviewees</th>
                                    <th>Status</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if($topdown!=null){
                                    $i = 0;
                                    foreach ($topdown->result as $td)
                                    {
                                        if($i%2==0) echo '<tr class="even gradeC">';
                                        else echo '<tr class="odd gradeX">';
                                        echo "<td>".$td->title."</td>";
                                        echo "<td>".$td->goal."</td>";
                                        echo "<td>".$td->categories."</td>";
                                        echo "<td>".$td->reviewers."</td>";
                                        echo "<td>".$td->reviewees."</td>";        

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
            <div class="row">
                <div class="col-sm-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                    <div class="row">
                            <div class="col-sm-10">
                                <a style="color: white;" data-toggle="collapse" data-target="#demo2">Manager Review List</a>
                            </div>
                            <div class="col-sm-2" style="text-align: right;">
                            <a href="<?php echo Router::url('/', true);?>review/addbottomup" style="color: white;">
                                <i class="fa fa-plus-square" style="font-size:1.5em;"></i>
                                &nbsp;&nbsp;New
                            </a>
                            </div>
                        </div>
                        
                    </div>
                    <div id="demo2" class="collapse">
                    <div class="panel-body">
                        <div class="table-responsive">
                          <table width="100%" class="table table-striped table-bordered table-hover" >
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Goals</th>                                    
                                    <th>Reviewers</th>
                                    <th>Reviewees</th>
                                    <th>Status</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if($bottomup!=null){
                                $i = 0;
                                    foreach ($bottomup->result as $td)
                                    {
                                        if($i%2==0) echo '<tr class="even gradeC">';
                                        else echo '<tr class="odd gradeX">';
                                        echo "<td>".$td->title."</td>";
                                        echo "<td>".$td->goal."</td>";
                                        echo "<td>".$td->reviewers."</td>";
                                        echo "<td>".$td->reviewees."</td>";
                                        /*echo  $this->Form->postLink(__('Delete'), ['action' => 'delete', $td->id], ['confirm' => __('Are you sure you want to delete department : {0}?', $td->title),'style'=>'color:red']);*/
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
            <div class="row">
                <div class="col-sm-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                    <div class="row">
                            <div class="col-sm-10">
                                <a style="color: white;" data-toggle="collapse" data-target="#pfpanel">Performance Apprisal</a>
                            </div>
                            <div class="col-sm-2" style="text-align: right;">
                            <a href="<?php echo Router::url('/', true);?>review/addperformanceapprisal" style="color: white;">
                                <i class="fa fa-plus-square" style="font-size:1.5em;"></i>
                                &nbsp;&nbsp;New
                            </a>
                            </div>
                        </div>                        
                    </div>
                    <div id="pfpanel" class="collapse">
                    <div class="panel-body">
                        <div class="table-responsive">
                          <table width="100%" class="table table-striped table-bordered table-hover" >
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Goals</th>                                    
                                    <th>Reviewers</th>
                                    <th>Reviewees</th>
                                    <th>Status</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 

                                if($performanceapprisal!=null)
                                {                                  
                                    $i = 0;
                                    foreach ($performanceapprisal->result as $td)
                                    {
                                        if($i%2==0) echo '<tr class="even gradeC">';
                                        else echo '<tr class="odd gradeX">';
                                        echo "<td>".$td->title."</td>";
                                        echo "<td>".$td->goal."</td>";
                                        echo "<td>".$td->reviewers."</td>";
                                        echo "<td>".$td->reviewees."</td>";
                                       /* echo  $this->Form->postLink(__('Delete'), ['action' => 'delete', $td->id], ['confirm' => __('Are you sure you want to delete department : {0}?', $td->title),'style'=>'color:red']);*/
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
            <div class="row">
                <div class="col-sm-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                    <div class="row">
                            <div class="col-sm-10">
                        <a style="color: white;" data-toggle="collapse" data-target="#demo3">360º Reviews List </a>
                            </div>
                            <div class="col-sm-2" style="text-align: right;">
                            <a href="<?php echo Router::url('/', true);?>review/add360" style="color: white;">
                                <i class="fa fa-plus-square" style="font-size:1.5em;"></i>
                                &nbsp;&nbsp;New
                            </a>
                            </div>
                        </div>
                        
                    </div>
                    <div id="demo3" class="collapse">
                    <div class="panel-body">
                        <div class="table-responsive">
                       <table width="100%" class="table table-striped table-bordered table-hover" >
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Goals</th>
                                    <th>Participants</th>
                                    <th>Max Reviews (Reviewer)</th>
                                    <th>Min Reviews (Reviewer)</th>
                                    <th>Max Reviews (Reviewees)</th>
                                    <th>Status</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                if($review360 !=null){
                                $i = 0;
                                    foreach ($review360->result as $td)
                                    {
                                        if($i%2==0) echo '<tr class="even gradeC">';
                                        else echo '<tr class="odd gradeX">';
                                        echo "<td>".$td->title."</td>";
                                        echo "<td>".$td->goal."</td>";
                                        echo "<td>".$td->reviewees."</td>";
                                        echo "<td>".$td->maxreview."</td>";
                                        echo "<td>".$td->minreview."</td>";
                                        echo "<td>".$td->maxreviewed."</td>";
                                        
                                        if($td->results>0) {
                                            echo "<td> On Going </td>";
                                            $styleClass = "btn btn-secondary not-active";
                                        }
                                        else{
                                            echo "<td>Incoming</td>";
                                            $styleClass = "btn btn-primary";
                                        }

                                        echo  "<td>".$this->Form->postLink(__('Delete'), ['action' => 'delete', $td->id], ['confirm' => __('Are you sure you want to delete department : {0}?', $td->title),'style'=>'color:#dddddd;','class'=>$styleClass])."</td>";
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
                      url: "<?php echo Router::url('/', true);?>review/delete/"+id
                      
                    }).done(function(result)
                    {   
                        if(result=="Success")
                        {
                            alert("Delete Success!");
                            window.location = "<?php echo Router::url('/', true);?>review/";
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








