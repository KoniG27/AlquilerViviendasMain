<?php
include('db.php')
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>RESERVACION WEN SEG</title>
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
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <a  href="../index.php"><i class="fa fa-home"></i> Página principal</a>
                    </li>            
					</ul>
            </div>
        </nav>
        <div id="page-wrapper" >
            <div id="page-inner">
			 <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            RESERVA <small></small>
                        </h1>
                    </div>
                </div>             
            <div class="row">    
                <div class="col-md-5 col-sm-5">
                    <div class="panel panel-primary">
                        <div class="panel-heading">INFORMACION PERSONAL</div>
                        <div class="panel-body">
						<form name="form" method="post">
                            <div class="form-group">
                                            <label>Titulo*</label>
                                            <select name="title" class="form-control" required >
												<option value selected ></option>
                                                <option value="Dr.">Dr.</option>
                                                <option value="Miss.">Miss.</option>
                                                <option value="Mr.">Mr.</option>
                                                <option value="Mrs.">Mrs.</option>
												<option value="Prof.">Prof.</option>
												<option value="Rev .">Rev .</option>
												<option value="Rev . Fr">Rev . Fr .</option>
                                            </select>
                              </div>
							  <div class="form-group">
                                            <label>Nombre</label>
                                            <input name="nombre" class="form-control" required>      
                               </div>
							   <div class="form-group">
                                            <label>Email</label>
                                            <input name="email" type="email" class="form-control" required>        
                               </div>   
                        </div>
                        
                    </div>
                </div>
<?php
include('db.php');
$rsql ="SELECT titulo from housing";
$rre=mysqli_query($con,$rsql);
?>
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                     INFORMACIÓN DE RESERVA

                        </div>
                        <div class="panel-body">
                        <div class="form-group">
                                            <label>Seleccione el título del alquiler
 *</label>
                                            <select name="titulo"  class="form-control" required>
												<option value selected ></option>
												<?php
												while($rrow=mysqli_fetch_array($rre))
												{
												$value = $rrow['titulo'];
												 echo '<option value="'.$value.'">'.$value.'</option>';
												
												}
												?>                   
                                            </select>
                              </div>
							  <div class="form-group">
                                            <label>Entrada</label>
                                            <input name="startDate" type ="date" class="form-control">
                                            
                               </div>
							   <div class="form-group">
                                            <label>Salida</label>
                                            <input name="endDate" type ="date" class="form-control">
                                            
                               </div>
                       </div>
                        
                    </div>
                </div>
				
				
                <div class="col-md-12 col-sm-12">
                    <div class="well">
                        <h4>VERIFICACIÓN HUMANA</h4>
                        <p>Escriba debajo de este código
 <?php $Random_code=rand(); echo$Random_code; ?> </p><br />
						<p>Ingrese el código aleatorio<br /></p>
							<input  type="text" name="code1" title="random code" />
							<input type="hidden" name="code" value="<?php echo $Random_code; ?>" />
						<input type="submit" name="submit" class="btn btn-primary">
						<?php
							if(isset($_POST['submit']))
							{
							$code1=$_POST['code1'];
							$code=$_POST['code']; 
							if($code1!="$code")
							{
							$msg="Invalide code"; 
							}
							else
							{
                                $fechaFin= new DateTime($_POST['endDate']);
                                $fechaInicio= new DateTime($_POST['startDate']);
									$con=mysqli_connect("localhost","root","","alquilerviviendas");
									$check="SELECT * FROM housingbook, user, housing  WHERE user.email = '$_POST[email]' AND housingbook.userId = user.id; 
                                    -- AND housing.id = housingbook.housingId AND housing.titulo = '$_POST[titulo]'
                                    -- AND (housingbook.startDate BETWEEN '$_POST[startDate]' AND '$_POST[endDate]') 
                                    -- OR (housingbook.endDate BETWEEN '$_POST[startDate]' AND '$_POST[endDate]')";
									$rs = mysqli_query($con,$check);
									$data = mysqli_fetch_array($rs, MYSQLI_NUM);
									if($data[0] > 1) { //NULL
										echo "<script type='text/javascript'> alert('Ya existe ese usuario')</script>";
										
									}

									else
									{
                                        $check0="SELECT count(*) FROM housingbook";
                                        $rs0 = mysqli_query($con,$check0);
										$data0 = mysqli_fetch_array($rs0, MYSQLI_NUM)[0]+1;
                                        $check1="SELECT id FROM user WHERE email = '$_POST[email]'";
									    $rs1 = mysqli_query($con,$check1);
									    $data1 = mysqli_fetch_array($rs1, MYSQLI_NUM)[0];
                                        $check2="SELECT id FROM housing WHERE housing.titulo = '$_POST[titulo]' ";
									    $rs2 = mysqli_query($con,$check2);
									    $data2 = mysqli_fetch_array($rs2, MYSQLI_NUM)[0];
                                        // $fechaFin= new DateTime($_POST['endDate']);
                                        // $fechaInicio= new DateTime($_POST['startDate']);
                                        $fecha = $fechaFin->diff($fechaInicio)->days;
										$new ="Not Conform";
										$newUser="INSERT INTO `housingbook`(`id`,`housingId`, `userId`, `startDate`, `endDate`,`ndays`) VALUES ('$data0','$data2','$data1','$_POST[startDate]','$_POST[endDate]','$fecha')";
										if (mysqli_query($con,$newUser))
										{
											echo "<script type='text/javascript'> alert('Su solicitud de reserva ha sido enviada')</script>";
											
										}
										else
										{
											echo "<script type='text/javascript'> alert('Error al agregar usuario en la base de datos')</script>";
											
										}
									}

							$msg="Tu código es correcto
";
							}
							}
							?>
						</form>
							
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
