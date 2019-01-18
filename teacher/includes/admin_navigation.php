<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Sistema Administrador</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li><a href="../includes/logout.php">HOME SITE</a></li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-user"></i> 

<?php

            if(isset($_SESSION['username'])) {
                
                echo $_SESSION['username'];

            }

?>

                    <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="../includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>

<!-------------------------------------------------------------------------------------------------------------------------->

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>

                    <!-- REFERRALS DROP DOWN -->
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#endorsment_dropdown">
                        <i class="fa fa-fw fa-file-word-o"></i> Referidos <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="endorsment_dropdown" class="collapse">
                            <li>
                                <a href="./endorsments.php">Ver Referidos</a>
                            </li>
                            <li>
                                <a href="endorsments.php?source=add_endorsment">Crear Referidos</a>
                            </li>
                        </ul>
                    </li>

<!-------------------------------------------------------------------------------------------------------------------------->

                    <li>
                        <a href="profile.php"><i class="far fa-user-circle"></i> Perfil</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>