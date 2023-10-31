<?php  
session_start();  
if(!isset($_SESSION["user"]))
{
 header("location:index.php");
}
?> 

<?php
		if(!isset($_GET["rid"]))
		{
				
			 header("location:index.php");
		}
		else {
				$curdate=date("Y/m/d");
				include ('db.php');
				$id = $_GET['rid'];
				
				
				$sql ="SELECT * FROM housing, housingbook where housing.id = '$id' and housingbook.housingId = '$id'";
				$re = mysqli_query($con,$sql);
				while($row=mysqli_fetch_array($re))
				{
					$title = $row['titulo'];
					$thousing = $row['type'];
					$price = $row['price'];
					$form = $row['form'];
					$startDate = $row['startDate'];
					$endDate = $row['endDate'];
					$days = $row['ndays'];
					$status = $row['status'];
					$email = $row['owner'];
					$description = $row['description'];

				}

	}
			?> 

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Administrador	</title>
    <!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Morris Chart Styles-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Navegación de palanca
</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="home.php"> <?php echo $_SESSION["user"]; ?> </a>
            </div>
        </nav>
        <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">

                    <li>
                        <a  href="home.php"><i class="fa fa-dashboard"></i> Estado</a>
                    </li>
					<li>
                        <a class="active-menu" href="housingbook.php"><i class="fa fa-bar-chart-o"></i> Reserva</a>
                    </li>
                    <li>
                    <li>
                        <a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Cerrar sesión</a>
                    </li>
					</ul>
            </div>
        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">


                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Reserva de Inmuebles<small>	<?php echo  $curdate; ?> </small>
                        </h1>
                    </div>

					<div class="col-md-8 col-sm-8">
                    <div class="panel panel-info">
                        <div class="panel-heading">Confirmación de reserva</div>
                        <div class="panel-body">
							
							<div class="table-responsive">
                                <table class="table">
                                    <tr>
                                            <th>DESCRIPCION</th>
                                            <th>INFORMATION</th>
                                            
                                        </tr>
                                        <tr>
                                            <th>Nombre</th>
                                            <th><?php echo $title; ?> </th>
                                            
                                        </tr>
										<tr>
                                            <th>Email</th>
                                            <th><?php echo $email; ?> </th>
                                            
                                        </tr>
										<tr>
                                            <th>Tipo de la alquiler</th>
                                            <th><?php echo $thousing; ?></th>
                                            
                                        </tr>										
										<tr>
                                            <th>Forma de alquiler </th>
                                            <th><?php echo $form; ?></th>
                                            
                                        </tr>
										<tr>
                                            <th>Fecha de entrada</th>
                                            <th><?php echo $startDate; ?></th>
                                            
                                        </tr>
										<tr>
                                            <th>Fecha de salida</th>
                                            <th><?php echo $endDate; ?></th>
                                            
                                        </tr>
										<tr>
                                            <th>No de dias</th>
                                            <th><?php echo $days; ?></th>
                                            
                                        </tr>
										<tr>
                                            <th>Nivel de estado</th>
                                            <th><?php echo $status; ?></th>
                                            
                                        </tr>                           
                                </table>
                            </div>	
                        </div>
                        <div class="panel-footer">
                            <form method="post" >
										<div class="form-group">
														<label>Seleccione la Conformación</label>
														<select name="conf"class="form-control">
															<option value="Conform">Conform</option>
														</select>
										 </div>
							<input type="submit" name="co" value="Conform" class="btn btn-success">
							
							</form>
                        </div>
                    </div>
					</div>
					
					<?php
						$rsql ="select * from housing";
						$rre= mysqli_query($con,$rsql);
						$r =0 ;
						$sc =0;
						$gh = 0;
						$sr = 0;
						$dr = 0;
						while($rrow=mysqli_fetch_array($rre))
						{
							$r = $r + 1;
							$s = $rrow['type'];
							if($s=="Apartamento" )
							{
								$sc = $sc+ 1;
							}
							
							if($s=="Casa")
							{
								$gh = $gh + 1;
							}
							if($s=="Duplex" )
							{
								$sr = $sr + 1;
							}
							if($s=="Edificio" )
							{
								$dr = $dr + 1;
							}
							
						
						}
						?>
						
						
					<div class="col-md-4 col-sm-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                   Detalles de Inmuebles

                        </div>
                        <div class="panel-body">
						<table width="200px">
							
							<tr>
								<td><b>Apartamento	 </b></td>
								<td><button type="button" class="btn btn-primary btn-circle"><?php  
									$f1 =$sc;
									if($f1 <=0 )
									{	$f1 = "NO";
										echo $f1;
									}
									else{
											echo $f1;
									}
								
								
								?> </button></td> 
							</tr>
							<tr>
								<td><b>Casa</b>	 </td>
								<td><button type="button" class="btn btn-primary btn-circle"><?php 
								$f2 =  $gh;
								if($f2 <=0 )
									{	$f2 = "NO";
										echo $f2;
									}
									else{
											echo $f2;
									}

								?> </button></td> 
							</tr>
							<tr>
								<td><b>Duplex </b></td>
								<td><button type="button" class="btn btn-primary btn-circle"><?php
								$f3 =$sr;
								if($f3 <=0 )
									{	$f3 = "NO";
										echo $f3;
									}
									else{
											echo $f3;
									}

								?> </button></td> 
							</tr>
							<tr>
								<td><b>Edificio</b>	 </td>
								<td><button type="button" class="btn btn-primary btn-circle"><?php 
								
								$f4 =$dr; 
								if($f4 <=0 )
									{	$f4 = "NO";
										echo $f4;
									}
									else{
											echo $f4;
									}
								?> </button></td> 
							</tr>
							<tr>
								<td><b>Total de Inmuebles</b> </td>
								<td> <button type="button" class="btn btn-danger btn-circle"><?php 
								
								$f5 =$r; 
								if($f5 <=0 )
									{	$f5 = "NO";
										echo $f5;
									}
									else{
											echo $f5;
									}
								 ?> </button></td> 
							</tr>
						</table>
						</div>
                        <div class="panel-footer">
                            
                        </div>
                    </div>
					</div>
                </div>
                <!-- /. ROW  -->				
                </div>
                <!-- /. ROW  -->
         </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- Morris Chart Js -->
    <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
    <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>


</body>

</html>

<?php
						if(isset($_POST['co']))
						{	
							$urb = "UPDATE `housingbook` SET `status`='Conform' WHERE housingId = '$id'";		
								if($f1==0 )
								{
									echo "<script type='text/javascript'> alert('Lo siento no esta disponible')</script>";
								}
								else if($f2 ==0)
									{
										echo "<script type='text/javascript'> alert('Lo siento no esta disponible')</script>";			
									}
									else if ($f3 == 0)
									{
										echo "<script type='text/javascript'> alert('Lo siento no esta disponible')</script>";
									}
										else if($f4==0)
										{
										echo "<script type='text/javascript'> alert('Lo siento no esta disponible')</script>";
										}			
										else if( mysqli_query($con,$urb))
											{	
												
											
															$notfree="Conform";
															$rpsql = "UPDATE `housingbook` SET `status`='$notfree' where housingId ='$id'";
															if(mysqli_query($con,$rpsql))
															{
															echo "<script type='text/javascript'> alert('Booking Conform')</script>";
															echo "<script type='text/javascript'> window.location='home.php'</script>";
															}									
																			
											}               
								
						}
	
?>
