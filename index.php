<!Doctype html>
<?php
include("config/conf.inc");
?>
<html>
	<head>
		<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />



	</head>

	<body>
		<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Brand</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>
      <form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


		<div class="container">
			<div class="row">
				<?php
					if(isset($_GET['success'])){
						if($_GET['success']=='true'){

							?>
							<div class="alert alert-success text-center">
								Database has been Created!
				</div>
							<?php
						}
						else{

							?>
							<div class="alert alert-danger text-center">
								Database already exists! Error Occured!
				</div>
							<?php
						}
					}

					if(isset($_GET['successDrop'])){
						if($_GET['successDrop']=='true'){

							?>
							<div class="alert alert-success text-center">
								Database has been Removed!
				</div>
							<?php
						}
						else{

							?>
							<div class="alert alert-danger text-center">
								You have no privileges to Drop this Database!
				</div>
							<?php
						}
					}
				?>
				
				<div class="col-lg-5">
					<form class="form-horizontal" action="controller/createDb.php" method="POST">
<fieldset>

<!-- Form Name -->
<legend>Create Database</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-6 control-label" for="textinput">Enter Database Name:</label>  
  <div class="col-md-6">
  <input id="textinput" name="dbname" type="text" placeholder="Database Name" class="form-control input-md">
  <span class="help-block">The Database Name is Required!</span>  
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-6 control-label" for="singlebutton">Submit Data</label>
  <div class="col-md-6">
    <button type="submit" id="singlebutton" name="subbtn" class="btn btn-primary">Create Database</button>
  </div>
</div>

</fieldset>
</form>

				</div>

				<div class="col-lg-7">
					<h3>Databases</h3>
					<?php
					$sql=mysql_query("SHOW DATABASES");
					if($sql){
						$i=0;
						echo "<table class='table table-bordered'>";
						echo "<tr><th>S/N</th><th>Database Name</th><th colspan=2>Action</th></tr>";
						while($row=mysql_fetch_array($sql)){
							if($i!=0 && $row['Database']!='mysql'){
							echo "<tr>";
				echo "<td>" . $i . "</td><td>".$row['Database']."</td><td><a href='showTables.php?db=$row[Database]'>Show Tables</a></td>";
				?>

				<td><a href='dropDb.php?db=<?php echo $row[Database]; ?>' onclick="return confirm('Do you really want to Drop this Database?')">Drop Database</a></td>
							</tr>
						
						<?php	
						}
						$i++;
						}
						echo "</table>";
					}


					else{

						echo "<p class='alert alert-info'> You have no Database!</p>";
					}
					?>
				</div>
			</div>
		</div>

	</body>


</html>