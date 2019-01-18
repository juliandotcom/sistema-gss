<?php include "includes/admin_header.php" ?>

    <div id="wrapper">




        <!-- Navigation -->
<?php include "includes/admin_navigation.php" ?>


<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
            
                <h1 class="page-header">
                    Maestros
                    <small>Area</small>
                </h1>

<?php

            if(isset($_GET['source'])){

                $source = $_GET['source'];
            } else {
                $source = '';
            }

            switch($source) {
                case 'add_teacher';
                include "includes/add_teacher.php";
                break;

                case 'edit_teacher';
                include "includes/edit_teacher.php";
                break;

                default:
                include "includes/view_all_teachers.php";

            }

?>

               


                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->


<?php include "includes/admin_footer.php"; ?>