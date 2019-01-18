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


        <!-- View endrosments button -->
        <button type="button" class="btn btn-primary btn-lg btn-block" onclick="view_endorsments()">
        <i class="fa fa-file-text fa-1x"></i> 
<?php

            $teacher_id = $_SESSION['id'];
            $query = "SELECT * FROM endorsments WHERE end_teacher_id = $teacher_id";
            $select_all_post = mysqli_query($connection, $query);
            $app_count = mysqli_num_rows($select_all_post);

            echo "Ver tus {$app_count} referidos.";

?>    
        </button>

        <!-- Create endrosments button -->
        <button type="button" class="btn btn-secondary btn-lg btn-block" onclick="create_endrosments()">
            <i class="fa fa fa-edit fa-1x"></i> Crear Referido   
        </button>

<script>
            function view_endorsments(){
                    location.href = "endorsments.php";
                } 
            function create_endrosments(){
                    location.href = "endorsments.php?source=add_endorsment";
                } 
</script>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->


<?php include "includes/admin_footer.php"; ?>