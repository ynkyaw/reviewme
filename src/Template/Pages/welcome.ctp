<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

$this->layout = false;

if (!Configure::read('debug')):
    throw new NotFoundException('Please replace src/Template/Pages/home.ctp with your own version.');
endif;

$cakeDescription = 'CakePHP: the rapid development PHP framework';
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>reviewme</title>
		<link href="../favicon.ico" type="image/x-icon" rel="icon"/>
        <link href="../favicon.ico" type="image/x-icon" rel="shortcut icon"/>
		
	<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="../css/ForgetPswd.css" rel="stylesheet" type="text/css">
	
	</head>
    
	<body>
		
			<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
				<div class="navbar-header">
					<a class="navbar-brand" href="index.html"><b>Review Me</b></a>
				</div>
				<ul class="nav navbar-top-links navbar-right">
					<li>
						<a href="users/login">
							<span class="glyphicon glyphicon-log-in"></span> Login
						</a>
						
					</li>
					<li>
						<a href="signup">
							<span class="glyphicon glyphicon-log-in"></span> Sign Up
						</a>
					</li>
				</ul>
			</nav>
		
		<section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">At Your Service</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="service-box text-center">
                        <i class="fa fa-4x fa-bar-chart-o text-primary sr-icons"></i>
                        <h3>Employee Perfomance Review System</h3>
                        	<p class="text-muted">
							<ul class="list-unstyled">
                                <li>Automate the cumbersome</li>
                                <li>Reduce time consuming task</li>
                                <li>Organization's workforce</li>
							</ul>
							</p>
					</div>					
                </div>
                <div class="col-lg-4 col-md-4 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-sitemap text-primary sr-icons"></i>
                        <h3>Bonus Performance Review System</h3>
						<p class="text-muted">
							<ul class="list-unstyled">
                                <li>Calculate bonus plan</li>
                                <li>Allocate for bonus use</li>
                                <li>Determine performance rating</li>
							</ul>
						</p>

					</div>
                </div>
                <div class="col-lg-4 col-md-4 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-newspaper-o text-primary sr-icons"></i>
                        <h3>Project Performance Review System</h3>
                        <p class="text-muted">
							<ul class="list-unstyled">
                                <li>Generate project plans</li>
                                <li>Compared with performance targets</li>
                                <li>Improve projects and decision making</li>                                
							</ul>
						</p>
					</div>
                </div>
                </div>
        </div>
    </section>                  	
		
	<script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>
    <script src="../dist/js/sb-admin-2.js"></script>
    <script>
    // tooltip demo
    $('.tooltip-demo').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    })
    // popover demo
    $("[data-toggle=popover]")
        .popover()
    </script>
	</body>
</html>