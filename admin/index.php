<?php 
    require '../require/comun.php';
    $sesion->administrador("../index.php");
    $yo = $sesion->getUsuario();
    $bd = new BaseDatos();
    $modeloUsuarios = new ModeloUsuario($bd);
    $p = Leer::get("p");
    $usuarios=$modeloUsuarios->getList($p,10,"1=1", array(), "login ASC");
    $numeroRegistros = $modeloUsuarios->count();
    $lista = Util::getEnlacesPaginacion($p, 10, $numeroRegistros);
?>

<!DOCTYPE html>
<html lang="en">
    <head>

        <!-- start: Meta -->
        <meta charset="utf-8">
        <title>Admin Blackboard</title>
        <meta name="description" content="Bootstrap Metro Dashboard">
        <meta name="author" content="Dennis Ji">
        <meta name="keyword" content="Metro, Metro UI, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
        <!-- end: Meta -->

        <!-- start: Mobile Specific -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- end: Mobile Specific -->

        <!-- start: CSS -->
        <link id="bootstrap-style" href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
        <link id="base-style" href="css/style.css" rel="stylesheet">
        <link id="base-style-responsive" href="css/style-responsive.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
        <!-- end: CSS -->


        <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
                <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
                <link id="ie-style" href="css/ie.css" rel="stylesheet">
        <![endif]-->

        <!--[if IE 9]>
                <link id="ie9style" href="css/ie9.css" rel="stylesheet">
        <![endif]-->

        <!-- start: Favicon -->
        <link rel="shortcut icon" href="img/favicon.ico">
        <!-- end: Favicon -->
    </head>
    <body>
        <!-- start: Header -->
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="index.html"><span>Admin Blackboard</span></a>

                    <!-- start: Header Menu -->
                    <div class="nav-no-collapse header-nav">
                        <ul class="nav pull-right">
                            <li class="dropdown">
                                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="halflings-icon white user"></i> <?php echo $yo->getNombre(); ?>
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="dropdown-menu-title">
                                        <span>Cuenta</span>
                                    </li>
                                    <li><a href="../usuario/viewperfil.php"><i class="halflings-icon user"></i> Mi perfil</a></li>
                                    <li><a href="../usuario/phpcerrarsesion.php"><i class="halflings-icon off"></i> Cerrar sesión</a></li>
                                </ul>
                            </li>
                            <!-- end: User Dropdown -->
                        </ul>
                    </div>
                    <!-- end: Header Menu -->
                </div>
            </div>
        </div>
        <!-- start: Header -->

        <div class="container-fluid-full">
            <div class="row-fluid">

                <!-- start: Main Menu -->
                <div id="sidebar-left" class="span2">
                    <div class="nav-collapse sidebar-nav">
                        <ul class="nav nav-tabs nav-stacked main-menu">
                            <li class="active"><a href="index.php"><i class="icon-edit"></i><span class="hidden-tablet"> Usuarios</span></a></li>	
                        </ul>
                    </div>
                </div>
                <!-- end: Main Menu -->
                <noscript>
                <div class="alert alert-block span10">
                    <h4 class="alert-heading">Warning!</h4>
                    <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
                </div>
                </noscript>
                <!-- start: Content -->
                <div id="content" class="span10">
                    <ul class="breadcrumb">
                        <li>
                            <i class="icon-home"></i>
                            <a href="index.php">Usuarios</a> 
                        </li>
                    </ul>
                    <div class="row-fluid sortable">	
                        <div class="box span12">
                            <div class="box-header">
                                <h2><i class="halflings-icon align-justify"></i><span class="break"></span>Tabla de usuarios</h2>
                                
                            </div>
                            <div class="box-content">
                                <table class="table table-bordered table-striped table-condensed">
                                    <thead>
                                        <tr>
                                            <th>Login</th>
                                            <th>Nombre y apellidos</th>
                                            <th>Fecha de registro</th>
                                            <th>Rol</th>
                                            <th>Estado</th> 
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>   
                                    <tbody>
                                        <?php 
                                        foreach ($usuarios as $key => $usuario) {
                                        ?>
                                        <tr>
                                            <td><a target="_blank" href="../post/verusuario.php?login=<?php echo $usuario->getLogin(); ?>"><?php echo $usuario->getLogin(); ?></a></td>
                                            <td><?php echo $usuario->getNombre()." ".$usuario->getApellidos(); ?></td>
                                            <td class="center"><?php echo $usuario->getFechaalta(); ?></td>
                                            <td class="center"><?php echo $usuario->getRol(); ?></td>
                                            <td class="center">
                                                <?php if($usuario->getIsactivo() == 1){ ?>
                                                    <span class="label label-success">Activo</span>
                                                <?php } ?>
                                                <?php if($usuario->getIsactivo() == 0){ ?>
                                                    <span class="label">Inactivo</span>
                                                <?php } ?>
                                            </td>         
                                            <td class="center">
                                                <a class="btn btn-success" href="phpactivar.php?login=<?php echo $usuario->getLogin(); ?>">
                                                    <i class="halflings-icon white edit"></i>  
                                                </a>
                                                <a class="btn" href="phpdesactivar.php?login=<?php echo $usuario->getLogin(); ?>">
                                                    <i class="halflings-icon white edit"></i>  
                                                </a>
                                                <a class="btn btn-danger" onclick="javascript:confirmar(event)" href="phpbanear.php?login=<?php echo $usuario->getLogin(); ?>">
                                                    <i class="halflings-icon white trash"></i> 
                                                </a>
                                            </td>
                                        </tr>  
                                        <?php
                                        }
                                        ?>                         
                                    </tbody>
                                </table>  
                                <div class="pagination pagination-centered">
                                    <ul>
                                        <?php 
                                            echo $lista["inicio"];
                                            echo $lista["anterior"];
                                            echo $lista["primero"];
                                            echo $lista["segundo"]; 
                                            echo $lista["actual"]; 
                                            echo $lista["cuarto"];
                                            echo $lista["quinto"]; 
                                            echo $lista["siguiente"];
                                            echo $lista["ultimo"];
                                            $bd->closeConexion();
                                        ?>
                                    </ul>
                                </div>     
                            </div>
                        </div><!--/span-->
                    </div><!--/row-->
                </div><!--/.fluid-container-->

                <!-- end: Content -->
            </div><!--/#content.span10-->
        </div><!--/fluid-row-->

        <div class="modal hide fade" id="myModal">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3>Settings</h3>
            </div>
            <div class="modal-body">
                <p>Here settings can be configured...</p>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn" data-dismiss="modal">Close</a>
                <a href="#" class="btn btn-primary">Save changes</a>
            </div>
        </div>

        <div class="clearfix"></div>

        <footer>

            <p>
                <span style="text-align:left;float:left">&copy; 2013 <a href="http://jiji262.github.io/Bootstrap_Metro_Dashboard/" alt="Bootstrap_Metro_Dashboard">Bootstrap Metro Dashboard</a></span>

            </p>

        </footer>

        <!-- start: JavaScript-->

        <script src="js/jquery-1.9.1.min.js"></script>
        <script src="js/jquery-migrate-1.0.0.min.js"></script>

        <script src="js/jquery-ui-1.10.0.custom.min.js"></script>

        <script src="js/jquery.ui.touch-punch.js"></script>

        <script src="js/modernizr.js"></script>

        <script src="js/bootstrap.min.js"></script>

        <script src="js/jquery.cookie.js"></script>

        <script src='js/fullcalendar.min.js'></script>

        <script src='js/jquery.dataTables.min.js'></script>

        <script src="js/excanvas.js"></script>
        <script src="js/jquery.flot.js"></script>
        <script src="js/jquery.flot.pie.js"></script>
        <script src="js/jquery.flot.stack.js"></script>
        <script src="js/jquery.flot.resize.min.js"></script>

        <script src="js/jquery.chosen.min.js"></script>

        <script src="js/jquery.uniform.min.js"></script>

        <script src="js/jquery.cleditor.min.js"></script>

        <script src="js/jquery.noty.js"></script>

        <script src="js/jquery.elfinder.min.js"></script>

        <script src="js/jquery.raty.min.js"></script>

        <script src="js/jquery.iphone.toggle.js"></script>

        <script src="js/jquery.uploadify-3.1.min.js"></script>

        <script src="js/jquery.gritter.min.js"></script>

        <script src="js/jquery.imagesloaded.js"></script>

        <script src="js/jquery.masonry.min.js"></script>

        <script src="js/jquery.knob.modified.js"></script>

        <script src="js/jquery.sparkline.min.js"></script>

        <script src="js/counter.js"></script>

        <script src="js/retina.js"></script>

        <script src="js/custom.js"></script>
        
        <script src="js/confirmar.js"></script>
        <!-- end: JavaScript-->

    </body>
</html>
