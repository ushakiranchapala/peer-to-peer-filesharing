<?php
include_once 'dbconnect.php';
?>
	<?php
	ob_start();
	session_start();
	require_once 'dbconnect.php';
	
	// if session is not set this will redirect to login page
	if( !isset($_SESSION['user']) ) {
		header("Location: index.php");
		exit;
	}
	// select loggedin users detail
	$res=mysql_query("SELECT * FROM users WHERE userId=".$_SESSION['user']);
	$userRow=mysql_fetch_array($res);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>File Uploading With PHP and MySql</title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
<div class='container'>
<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">BTH</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
             <li><a href="home.php">Home</a></li>
            <li><a href="view.php">My files</a></li>
			
			<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">sent files <span class="caret"></span></a>
          <ul class="dropdown-menu">
           <li><a href="view_send.php">can view</a></li>
			<li><a href="edit_send.php">can edit</a></li>
          </ul>
        </li>
		<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">recived files <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="view_recive.php">can view</a></li>
			<li><a href="edit_recive.php">can edit</a></li>
          </ul>
        </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			  <span class="glyphicon glyphicon-user"></span>&nbsp;Hi' <?php echo $userRow['userEmail']; ?>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav> 
</div>

<br>
<br>
<br>
<br>
	<div class="table-responsive">
	<table class="table table-striped">

    <tr>
     <td>File Name</td>
	 <td>reciver</td>
     <td>View</td>
	
    </tr>
    <?php
	$userId=$_SESSION['user'];
	$sql="SELECT * FROM can_view where sender=$userId";
	$result_set=mysql_query($sql);
	while($row=mysql_fetch_array($result_set))
	{
		?>
			
        <tr>
        <td><?php echo $row['file_id'] ?></td>
        <td><?php echo $row['reciver_name'] ?></td>
        <td><a href="uploads/<?php echo $row['file_id']?>" target="_blank">view file</a></td>
		
        </tr>
        <?php
	}
	?>
    </table>
    
</div>
 
    <script src="assets/jquery-1.11.3-jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>