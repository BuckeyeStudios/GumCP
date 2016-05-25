<?php
	include_once('./include/config.php');
	
	
switch ($_REQUEST['action']) {
	case 'kill_pid':
		if($_REQUEST['pid']>0)
		{
			$cmd = 'kill -9 '.$_REQUEST['pid'];
			$message = 'Command "'.$cmd.'" executed';
		}
		else
		{
			$message = 'Process ID should be an integer';
		}
	break;
	case 'kill_pname':
		if(!empty($_REQUEST['pname']))
		{
			$cmd = 'killall '.$_REQUEST['pname'];
			$message = 'Command "'.$cmd.'" executed';
		}
		else
		{
			$message = 'Process Name shouldn\'t be an empty value';
		}
	break;
	case 'start_sname':
		if(!empty($_REQUEST['sname']))
		{
			$cmd = 'sudo service '.$_REQUEST['sname'].' start';
			$message = 'Command "'.$cmd.'" executed';
		}
		else
		{
			$message = 'Service Name shouldn\'t be an empty value';
		}
	break;
	case 'stop_sname':
		if(!empty($_REQUEST['sname']))
		{
			$cmd = 'sudo service '.$_REQUEST['sname'].' stop';
			$message = 'Command "'.$cmd.'" executed';
		}
		else
		{
			$message = 'Service Name shouldn\'t be an empty value';
		}
		
	break;
	case 'update_sources':
		$cmd = 'sudo apt-get update';
		$message = 'Command "'.$cmd.'" executed';

	break;
	case 'update_firmware':
		$cmd = 'sudo rpi-update';
		$message = 'Command "'.$cmd.'" executed';
		
	break;
	case 'reboot':
		$cmd = 'sudo reboot';
		$message = 'Command "'.$cmd.'" executed';
	break;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>GumCP Actions</title>
	<link href="./static/css.php" rel="stylesheet" type="text/css">
	<script src="./static/js.php" type="text/javascript"></script>
</head>

<body>
<div class="container">
	
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="./index.php"><img src="./static/images/raspberry.png" />GumCP</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="./index.php">Dashboard</a></li>
					<li><a href="./services.php">Services</a></li>
					<li><a href="./processes.php">Processes</a></li>
					<li><a href="./phpinfo.php">PHP info</a></li>
					<li class="active"><a href="./actions.php">Actions</a></li>
					<?php
						if(LOGIN_REQUIRED==true)
						{
							echo '<li><a href="./logout.php">Logout</a></li>';
						}
					?>
				</ul>
			</div><!--/.nav-collapse -->
		</div><!--/.container-fluid -->
	</nav>

	

				<div id="system-status" class="panel panel-default" style="margin-bottom: 5px">
					<div class="panel-heading">
						<h3 class="panel-title">Actions</h3>
					</div>
					<div class="panel-body">

						<?php
							if(!empty($message))
							{
								echo '<div class="alert alert-info" role="alert" style="margin-bottom:20px;">'.$message.'</div>';
							}	
						?>
						
						<form method="post">
							<div class="form-group row">
								<label class="col-sm-2 form-control-label" for="pid">Kill Process by ID</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="pid" name="pid" placeholder="Process ID (PID)">
									<input type="hidden" class="form-control" name="action" value="kill_pid">
									<small class="text-muted">Provide the PID to kill.</small>
								</div>
								<div class="col-sm-4">
									<button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure?')">Kill</button>
								</div>
							</div>
							
							
						</form>
						
						<form method="post" style="margin-top: 20px;">
							<div class="form-group row">
								<label class="col-sm-2 form-control-label" for="pname">Kill Processes by Name</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="pname" name="pname" placeholder="Process Name">
									<input type="hidden" class="form-control" name="action" value="kill_pname">
									<small class="text-muted">Provide the process name to kill.</small>
								</div>
								<div class="col-sm-4">
									<button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure?')">Kill</button>
								</div>
							</div>
							
							
						</form>
								
								
						<form method="post" style="margin-top: 20px;">
							<div class="form-group row">
								<label class="col-sm-2 form-control-label" for="sname">Start Service by Name</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="sname" name="sname" placeholder="Service Name">
									<input type="hidden" class="form-control" name="action" value="start_sname">
									<small class="text-muted">Provide the service name to start.</small>
								</div>
								<div class="col-sm-4">
									<button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure?')">Start</button>
								</div>
							</div>
							
							
						</form>
						
						
						<form method="post" style="margin-top: 20px;">
							<div class="form-group row">
								<label class="col-sm-2 form-control-label" for="sname">Stop Service by Name</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="sname" name="sname" placeholder="Service Name">
									<input type="hidden" class="form-control" name="action" value="stop_sname">
									<small class="text-muted">Provide the service name to stop.</small>
								</div>
								<div class="col-sm-4">
									<button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure?')">Stop</button>
								</div>
							</div>
							
							
						</form>
						
						<form method="post" style="margin-top: 20px;">
							<div class="form-group row">
								<label class="col-sm-2 form-control-label">Update Sources</label>
								<input type="hidden" class="form-control" name="action" value="update_sources">
								<div class="col-sm-4">
									<button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure?')">Update</button>
								</div>
							</div>
							
							
						</form>
						
						<form method="post" style="margin-top: 20px;">
							<div class="form-group row">
								<label class="col-sm-2 form-control-label">Update Firmware</label>
								<input type="hidden" class="form-control" name="action" value="update_firmware">
								<div class="col-sm-4">
									<button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure?')">Update</button>
								</div>
							</div>
							
							
						</form>
						
						<form method="post" style="margin-top: 20px;">
							<div class="form-group row">
								<label class="col-sm-2 form-control-label">Reboot System</label>
								<input type="hidden" class="form-control" name="action" value="reboot">
								<div class="col-sm-4">
									<button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure?')">Reboot</button>
								</div>
							</div>
							
							
						</form>
						
						
						<div class="well well-sm">
							Run command: <b>sudo apt-get install php5-ssh2</b> to install php ssh support, so you can execute the actions. Dont forget to run: <b>service apache2 restart</b> after ssh2 is installed.
						</div>
								
					</div>
				
				
				</div>
				
				
		
</div>

<footer class="footer">
	<div class="container">
		<p class="text-muted">GumCP <a href="https://github.com/gumslone/GumCP">GitHub</a>.</p>
	</div>
</footer>

</body>
</html>
<?php
	if(!empty($cmd))
	{
		$connection = ssh2_connect('localhost', SSH_PORT);
		ssh2_auth_password($connection, SSH_USER, SSH_PASS);
		$stream = ssh2_exec($connection, $cmd);
		ssh2_exec($connection, 'exit');
	}
?>