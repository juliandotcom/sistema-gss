<?php include "includes/admin_header.php" ?>

    <div id="wrapper">

<?php if($connection) echo "conn" ?>


        <!-- Navigation -->
<?php include "includes/admin_navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Dashboard
                            <small><?php echo $_SESSION['firstname']; ?></small>
                        </h1>

                    </div>
                </div>
                <!-- /.row -->


       
                <!-- /.row -->
                

<div class="row">


        <!-- View appointments button -->
        <button type="button" class="btn btn-primary btn-lg btn-block" onclick="view_appointments()">
        <i class="fa fa-file-text fa-1x"></i> 
<?php

            $parent_id = $_SESSION['id'];
            $query = "SELECT * FROM appointments WHERE app_parent_id = $parent_id";
            $select_all_post = mysqli_query($connection, $query);
            $app_count = mysqli_num_rows($select_all_post);

            echo "Ver tus {$app_count} citas.";

?>    
        </button>

        <!-- Create appointments button -->
        <button type="button" class="btn btn-secondary btn-lg btn-block" onclick="create_appointments()">
            <i class="fa fa fa-edit fa-1x"></i> Solicitar una cita   
        </button>

                <script>
            function view_appointments(){
                    location.href = "appointments.php";
                } 
            function create_appointments(){
                    location.href = "appointments.php?source=add_appointment";
                } 
        </script>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->


<?php include "includes/admin_footer.php"; ?>