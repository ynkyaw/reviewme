<?php
use Cake\Routing\Router;
use Cake\View\Helper\SessionHelper;
$session = $this->request->session();

?>
<!DOCTYPE html>
<html class="yui3-js-enabled">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>ReviewMe</title>
	<link href="<?php echo Router::url('/', true);?>css/treeview.min.css" rel="stylesheet"  type="text/css">
    <link href="<?php echo Router::url('/', true);?>css/bypeople.css" rel="stylesheet"  type="text/css">
	<link href="<?php echo Router::url('/', true);?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo Router::url('/', true);?>vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="<?php echo Router::url('/', true);?>dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="<?php echo Router::url('/', true);?>vendor/morrisjs/morris.css" rel="stylesheet">
    <link href="<?php echo Router::url('/', true);?>vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <script src="<?php echo Router::url('/', true);?>vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo Router::url('/', true);?>vendor/jquery/jquery.ui.min.js"></script>
    <script src="<?php echo Router::url('/', true);?>vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo Router::url('/', true);?>vendor/metisMenu/metisMenu.min.js"></script>
    <script src="<?php echo Router::url('/', true);?>vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo Router::url('/', true);?>vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo Router::url('/', true);?>vendor/datatables-responsive/dataTables.responsive.js"></script>
    <script src="<?php echo Router::url('/', true);?>dist/js/sb-admin-2.js"></script>
    <script src="<?php echo Router::url('/', true);?>js/bypeople.js"></script>    
    <script src="<?php echo Router::url('/', true);?>js/date-util.js"></script>
	</head>
	<body class="yui3-skin-sam">

		<div id="wrapper">

			<nav class="navbar navbar-default" role="navigation" style="margin-bottom: 0">          
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo Router::url('/', true);?>"><b><?= $session->read('companyname')?></b></a>
                </div>              
                <div style="margin-left:650px;">
                    <a class="navbar-brand" style="text-align:center;"><b>ReviewMe</b></a>
                </div>
                <ul class="nav navbar-nav navbar-right ">
                    <li class="dropdown container-fluid">

                    <div style="text-align: right;float: left;padding-top: 1.2em;">
                        <?= $session->read('username')?>
                    </div>
                    <li class="dropdown container-fluid">

                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li>
                                <a href="#"><i class="fa fa-user fa-fw"></i>User Profile</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="<?php echo Router::url('/', true);?>users/logout"><i class="fa fa-sign-out fa-fw"></i>Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
               
                <div id="navbar" class="sidebar-nav">
                    <div class="navbar-default sidebar">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                       
                        <li>
                            <a href="<?php echo Router::url('/', true);?>dashboard"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <?php
                                foreach ($headerAry as $hary) 
                                {
                                if($hary == 'Review')
                                { 
                                ?>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Review<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <?php
                                foreach ($menuAry as $mname) 
                                {
                                if($mname == 'employeereview')
                                { 
                                ?>
                                <li> 
                                    <a href="<?php echo Router::url('/', true);?>review"><i class="fa fa-pencil-square-o fa-fw"></i>
                                        Employee Review
                                    </a> 
                                </li>
                                <?php } 
                                if($mname == 'organizationreview')
                                    {
                                ?>
                                <li> 
                                    <a href="<?php echo Router::url('/', true);?>organizationreviews/index"><i class="fa fa-pencil-square-o fa-fw"></i>
                                        Organization Review
                                    </a> 
                                </li>
                                <?php 
                            }
                            if($mname == 'singleitemreview')
                            {
                                ?>
                                <li> 
                                    <a href="<?php echo Router::url('/', true);?>itemreviews/index"><i class="fa fa-pencil-square-o fa-fw"></i>
                                        Single Item Review
                                    </a> 
                                </li> 
                                <?php }}?>                               
                            </ul>
                        </li>  
                        <?php }
                    }
                    foreach ($headerAry as $hary) 
                                {
                                if($hary == 'EmployeeManagement')
                                { 
                    ?>                      
                        <li>
                            <a href="#"><i class="fa fa-user fa-fw"></i> Employee Management <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <?php 
                                foreach ($menuAry as $mname) 
                                {
                                if($mname == 'employee')
                                {
                                ?>
                                <li>
                                    <a href="<?php echo Router::url('/', true);?>employee"><i class="fa fa-user fa-fw"></i> Employee</a> 
                                </li>
                                <?php 
                            }
                            if($mname == 'department')
                            {
                                ?>
                                <li>
                                    <a href="<?php echo Router::url('/', true);?>department"><i class="fa fa-institution fa-fw"></i> Department </a> 
                                </li> 
                                <?php 
                            }
                            if($mname == 'jobposition')
                            {
                                ?>
                                <li>
                                    <a href="<?php echo Router::url('/', true);?>jobposition"><i class="fa fa-graduation-cap fa-fw"></i> JobPosition</a> 
                                </li> 
                                <?php
                            }
                            if($mname == 'rank')
                            {
                                ?>  
                                <li>
                                    <a href="<?php echo Router::url('/', true);?>rank"><i class="fa fa-cubes fa-fw"></i> Rank </a> 
                                </li> 
                                <?php 
                            }
                            if($mname == 'group')
                            {
                                ?>    
                                <li>
                                    <a href="<?php echo Router::url('/', true);?>employeegroup"><i class="fa fa-group fa-fw"></i> Group</a>
                                </li>   
                                <?php }}?>                       
                            </ul>                                
                        </li>
                        <?php 
                    }
                }
                foreach ($headerAry as $hary) 
                                {
                                if($hary == 'SingleItemManagement')
                                { 
                ?>
                        <li>
                            <a href="#"><i class="fa fa-cube fa-fw"></i> Single Item Management <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <?php 
                                foreach ($menuAry as $mname) 
                                {
                                if($mname == 'product')
                                {
                                ?>
                                <li>
                                    <a href="<?php echo Router::url('/', true);?>products"><i class="fa fa-cube fa-fw"></i> Product </a> 
                                </li>
                                <?php 
                            }
                            if($mname == 'project')
                            {
                            ?>
                                <li>
                                    <a href="<?php echo Router::url('/', true);?>projects"><i class="fa fa-object-group fa-fw"></i> Project </a>
                                </li>
                                <?php 
                            }
                            if($mname == 'service')
                            {
                                ?> 
                                <li>
                                    <a href="<?php echo Router::url('/', true);?>services"><i class="fa fa-puzzle-piece fa-fw"></i> Service</a> 
                                </li>
                                <?php
                            }}
                                ?>                        
                            </ul>                                
                        </li>
                        <?php 
                    }
                }
                foreach ($headerAry as $hary) 
                                {
                                if($hary == 'OraganizationManagement')
                                { 
                ?>
                        <li>
                            <a href="#"><i class="fa fa-building-o fa-fw"></i> Organization Management <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <?php 
                                foreach ($menuAry as $mname) 
                                {
                                if($mname == 'companies')
                                {
                                ?>
                                <li>
                                    <a href="<?php echo Router::url('/', true);?>companies/edit/1"><i class="fa fa-institution fa-fw"></i> Companies </a> 
                                </li> 
                                <?php }}
                                ?>
                            </ul>                                
                        </li>
                        <?php 
                    }
                }
                foreach ($headerAry as $hary) 
                                {
                                if($hary == 'Question')
                                { 
                ?>
                        <li>
                            <a href="#"><i class="fa fa-question-circle fa-fw"></i> Question <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <?php 
                                foreach ($menuAry as $mname) 
                                {
                                if($mname == 'questions')
                                {
                                ?>
                                <li>
                                    <a href="<?php echo Router::url('/', true);?>question"><i class="fa fa-question-circle fa-fw"></i>Questions</a>
                                </li>
                                <?php }
                                if($mname == 'questioncategories')
                                    {
                                        ?>
                                <li>
                                    <a href="<?php echo Router::url('/', true);?>questioncategory"><i class="fa fa-question-circle fa-fw"></i>Question Categories</a>
                                </li>
                                <?php }
                                if($mname == 'subcategories')
                                    {
                                        ?>
                                <li>
                                    <a href="<?php echo Router::url('/', true);?>subcategory"><i class="fa fa-question-circle fa-fw"></i>Subcategories</a>
                                </li>   
                                <?php }} ?>                                   
                            </ul>                                
                        </li> 
                        <?php 
                    }
                }
                foreach ($headerAry as $hary) 
                                {
                                if($hary == 'Reports')
                                { 
                ?>                      
                
                        <li>
                            <a href="#"><i class="fa fa-sliders fa-fw"></i> Reports <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <?php 
                                foreach ($menuAry as $mname) 
                                {
                                if($mname == 'employeereport')
                                {
                                ?>
                                <li>
                                    <a href="<?php echo Router::url('/', true);?>reportlist/index"><i class="fa fa-user fa-fw"></i>Employee</a>
                                </li>
                                <?php 
                            }
                            if($mname == 'singleitem')
                            {
                            ?>
                                <li>
                                    <a href="<?php echo Router::url('/', true);?>reportlist/indexproduct"><i class="fa fa-cube fa-fw"></i>Single Item</a>
                                </li>
                                <?php 
                            }
                            if($mname == 'organization')
                            {
                                ?>
                                <li>
                                    <a href="<?php echo Router::url('/', true);?>reportlist/indexproduct"><i class="fa fa-building-o fa-fw"></i>Organization</a>
                                </li>
                                <?php }}
                                ?>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <?php 
                    }
                }
                foreach ($headerAry as $hary) 
                                {
                                if($hary == 'UserManagement')
                                { 
                ?>
                        <li>
                            <a href="#"><i class="fa fa-user fa-fw"></i> User Management<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <?php 
                                foreach ($menuAry as $mname) 
                                {
                                if($mname == 'user')
                                {
                                ?>
                                <li>
                                    <a href="<?php echo Router::url('/', true);?>users"><i class="fa fa-user fa-fw"></i>User</a>
                                </li>
                                <?php
                            }
                            if($mname == 'role')
                            {
                                ?>
                                <li>
                                    <a href="<?php echo Router::url('/', true);?>role"><i class="fa fa-lock fa-fw"></i>Role</a>
                                </li>
                                <?php }}?>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <?php 
                    }
                }
                foreach ($headerAry as $hary) 
                                {
                                if($hary == 'Others')
                                { 
                        ?>
                        <li>
                            <a href="#"><i class="fa fa-cog fa-fw"></i> Others<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <?php 
                                foreach ($menuAry as $mname) 
                                {
                                if($mname == 'activate')
                                {
                                ?>
                                <li>
                                    <a href="<?php echo Router::url('/', true);?>users/activatelist"><i class="fa fa-cog fa-fw"></i>Activate Setting</a>
                                </li>
                                <?php }} ?>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                       <?php 
                   }
               }

               ?>
                    </ul>                  
                </div>   
                </div>       
            </nav>			
		</div>

		<?= $this->Flash->render() ?>
		
		 <?= $this->fetch('content') ?>

		<footer>
    	</footer>

</body>
</html>
