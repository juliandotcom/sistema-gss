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
                    Referidos
                    <small><?php echo $_SESSION['username']; ?></small>
                </h1>

<?php

            if(isset($_GET['source'])){

                $source = $_GET['source'];
            } else {
                $source = '';
            }

            switch($source) {
                case 'add_endorsment';
                include "includes/add_endorsment.php";
                break;

                case 'edit_endorsment';
                include "includes/edit_endorsment.php";
                break;

                default:
                include "includes/view_all_endorsments.php";

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