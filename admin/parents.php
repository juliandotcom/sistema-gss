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
                    Parents
                    <small>Section</small>
                </h1>

<?php

            if(isset($_GET['source'])){

                $source = $_GET['source'];
            } else {
                $source = '';
            }

            switch($source) {
                case 'add_parent';
                include "includes/add_parent.php";
                break;

                case 'edit_parent';
                include "includes/edit_parent.php";
                break;

                default:
                include "includes/view_all_parents.php";

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