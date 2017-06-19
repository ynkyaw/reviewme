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
            <h2 class="page-header">Reviews List (Item)</h2>
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
	                        <a style="color: white;" data-toggle="collapse" data-target="#demo">Product Review List </a>
	                    </div>
	                    <div class="col-sm-2" style="text-align: right;">
	                        <a href="<?php echo Router::url('/', true);?>itemreviews/addproduct" style="color: white;">
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

		                        ?>                                
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
	                        <a style="color: white;" data-toggle="collapse" data-target="#demo2">Project Review List</a>
	                    </div>
	                    <div class="col-sm-2" style="text-align: right;">
	                    <a href="<?php echo Router::url('/', true);?>itemreviews/add" style="color: white;">
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
		                            <th>Status</th>
		                            <th>Remove</th>
		                        </tr>
		                    </thead>
		                    <tbody>
		                        <?php 
		                        ?>                                
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
	                        <a style="color: white;" data-toggle="collapse" data-target="#pfpanel">Service Review List</a>
	                    </div>
	                    <div class="col-sm-2" style="text-align: right;">
	                    <a href="<?php echo Router::url('/', true);?>itemreviews/add" style="color: white;">
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
								?>                           
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