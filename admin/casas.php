<?php  
session_start();  
if(!isset($_SESSION["user"]))
{
 header("location:index.php");
}
?> 
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> WEN SEG</title>
	<!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
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
                    <span class="sr-only">Navegación de palanca</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="home.php">MENÚ PRINCIPAL </a>
            </div>
        </nav>
        <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">

                    <li>
                        <a  href="settings.php"><i class="fa fa-dashboard"></i>Casas en alquiler</a>
                    </li>
					<li>
                        <a  class="active-menu" href="casas.php"><i class="fa fa-plus-circle"></i>Agregar alquiler</a>
                    </li>
                    <li>
                        <a  href="casasdel.php"><i class="fa fa-desktop"></i>Eliminar alquiler</a>
                    </li>
					

                    
            </div>

        </nav>
        <!-- /. NAV SIDE  -->
       
        
       
        <div id="page-wrapper" >
            <div id="page-inner">
			 <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                          NUEVO ALQUILER <small></small>
                        </h1>
                    </div>
                </div> 
                 
                                 
            <div class="row">
                
                <div class="col-md-5 col-sm-5">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                         AGREGAR NUEVO ALQUILER

                        </div>
                        <div class="panel-body">
						<form name="form" method="post">
                            <div class="form-group">
                            <label> Titulo</label>
                            <!-- tienes que crear en la base de datos de housebook el nombre y el precio igual como aparece  -->
                            <input name="titulo" class="form-control" type="text" size="10" maxlength="100" required/>
                                            <label> Tipo de alquiler*</label>
                                            <select name="tipo"  class="form-control" required>
												<option value selected ></option>
                                                <option value="Apartamento">APARTAMENTO</option>
                                                <option value="Duplex">DUPLEX</option>
												<option value="Casa">CASA </option>
												<option value="Edificio">EDIFICIO</option>
                                            </select>
                              </div>
							  
								<div class="form-group">
                                            <label>Forma de alquiler</label>
                                            <select name="bed" class="form-control" required>
												<option value selected ></option>
                                                <option value="Vacacional">Vacacional</option>
                                                <option value="Mensual">Mensual</option>
												
                                            </select>
                                            <div class="form-group"><label>Precio</label>
                                            <input name="precio" class="form-control" type="number" size="12" maxlength="1" required/></div>                                             

                               </div>
                               <div class="form-group"><label>Descripción</label><input type="text" name="description" id="descripcion" class="form-control" ></div>
							 <input type="submit" name="add" value="Add New" class="btn btn-primary"> 
							</form>
							<?php
							 include('db.php');
							 if(isset($_POST['add']))
							 {
										$room = $_POST['tipo'];
										$bed = $_POST['bed'];
                                        $price = $_POST['precio'];
										$place = $_POST['description'];
                                        $titulo = $_POST['titulo'];
										
                                        //Comprobar si existe un alquiler igual o no?
                                        $check="SELECT count(*) FROM housing";
                                        $rs = mysqli_query($con,$check);
										$data = mysqli_fetch_array($rs, MYSQLI_NUM)[0]+1;
                                        $username = $_SESSION['user'];
                                        $check2="SELECT id FROM user WHERE username = '$username'";
                                        $rs2 = mysqli_query($con,$check2);
										$data2 = mysqli_fetch_array($rs2, MYSQLI_NUM)[0];
										$sql ="INSERT INTO `housing`( `id`,`titulo`,`type`, `form`,`price`,`owner`,`description`) VALUES ('$data','$titulo','$room','$bed','$price','$data2','$place')" ;
										if(mysqli_query($con,$sql))
										{
										 echo '<script>alert("Nuevo inmueble") </script>' ;
										}else {
											echo '<script>alert("Ha ocurrido un error") </script>' ;
										}
							 }
							//}
							
							?>
                        </div>
                        
                    </div>
                </div>
                
                  
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                         INFORMACIÓN DE aquileres

                        </div>
                        <div class="panel-body">
								<!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <?php
						$sql = "SELECT * from housing limit 0,10";
						$re = mysqli_query($con,$sql)
						?>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Alquier ID</th>
                                            <th>Tipo alquiler</th>
											<th>forma de alquiler</th>
                                            <th>Precio</th>
                                            <th>Descripción</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
									
									<?php
										while($row= mysqli_fetch_array($re))
										{
												$id = $row['id'];
											if($id % 2 == 0) 
											{
												echo "<tr class=odd gradeX>
													<td>".$row['id']."</td>
													<td>".$row['type']."</td>
												   <th>".$row['form']."</th>
												   <th>".$row['price']."</th>
                                                   <th>".$row['description']."</th>

												</tr>";
											}
											else
											{
												echo"<tr class=even gradeC>
													<td>".$row['id']."</td>
													<td>".$row['type']."</td>
												   <th>".$row['form']."</th>
												   <th>".$row['price']."</th>
                                                   <th>".$row['description']."</th>
                                                   
												</tr>";
											
											}
										}
									?>
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->	   
                       </div>
                        
                    </div>
                </div>
            </div>		
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
      <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>
    
   
</body>
</html>
