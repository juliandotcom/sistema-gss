<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>


<!-- Navigation -->
<?php include "includes/navigation.php"; ?>

<!-- Page Content -->
<div class="container">

<div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-8">

<?php

if (isset($_GET['p_id'])) {

    $the_end_id = $_GET['p_id'];

    $query = 
    "SELECT * 
    FROM endorsments 
    WHERE end_id = $the_end_id";

    $select_all_ends_query = mysqli_query($connection, $query); //Pass the connection and query

    while ($row = mysqli_fetch_assoc($select_all_ends_query)) {

        $end_id                     = $row['end_id'];
        $end_student_name   	    = $row['end_student_name'];
        $end_student_group          = $row['end_student_group'];
        $end_student_gender         = $row['end_student_gender'];
        $end_student_number         = $row['end_student_number'];
        $end_student_birthdate      = date("d-M-Y", strtotime($row['end_student_birthdate'])); //$row['end_date'];
        $end_student_parent         = $row['end_student_parent'];
        $end_reasons                = $row['end_reasons'];
        $end_procedures             = $row['end_procedures'];
        $end_historial              = $row['end_historial'];
        $end_situation_level        = $row['end_situation_level'];
        $end_teacher_id             = $row['end_teacher_id'];
        $end_date                   = date("d-M-Y h:i:s A", strtotime($row['end_date']));
        $end_employee_id            = $row['end_employee_id'];
        $end_revision_date          = date("d-M-Y h:i:s A", strtotime($row['end_revision_date']));
        $end_status                 = $row['end_status'];

?>


      <!-- Endorsment SHOWS HERE -->

        <!-- creation date -->
        <h1 class="page-header" >
            Referido creado el 
            <small><span class="glyphicon glyphicon-time"></span><?php echo $end_date; ?></small>
        </h1>

        <form action="">

            <!-- Endorsment status -->
            <div class="form-inline">
                <div class="form-group">
                    <label for="end_status">Estatus del Referido: </label>
                    <input disabled class="form-control" type='text' name='end_status'  value='<?php echo $end_status; ?>'>
                </div>
            </div> <br>

        
            <!-- Student name -->
            <div class="form-inline">
                <div class="form-group">
                    <label for="end_student_name">Nombre del Estudiante:</label>
                    <input disabled class="form-control" type='text' name='end_student_name'  value='<?php echo $end_student_name; ?>'>
                </div>
            </div> <br>

                     
            <!-- Gender and birthdate -->
            <div class="form-inline">
                <div class="form-group">
                    <label for="end_student_gender">Genero: </label>
                    <input disabled class="form-control" type='text' name='end_student_gender' value='<?php echo $end_student_gender; ?>'>
                </div>
                
                <div class="form-group">
                    <label for="end_student_birthdate">Fecha de Nacimiento: </label>
                    <input disabled class="form-control" type='text' name='end_student_birthdate' value='<?php echo $end_student_birthdate; ?>'>
                </div>
            </div> <br>


            <!-- Group and SIE Number -->
            <div class="form-inline">
                <div class="form-group">
                    <label for="student_group">Grupo: </label>
                    <input disabled class="form-control" type='text' name='student_group' value='<?php echo $end_student_group; ?>'>
                </div>
                <div class="form-group">
                    <label for="end_student_number">Numero de SIE: </label>
                    <input disabled class="form-control" type='text' name='end_student_number' value='<?php echo $end_student_number; ?>'>
                </div>
            </div> <br>


             <!-- Parent name -->
            <div class="form-inline">
                <div class="form-group">
                    <label for="end_parent_name">Nombre del Padre y/o Encargado:</label>
                    <input disabled class="form-control" type='text' name='end_parent_name' size='30' value='<?php echo $end_student_parent; ?>'>
                </div>
            </div>

            
            <hr>
            
            <!-- Endorsment info -->
            <div class="form-group">
                <label for="end_reasons">Razones para Referir: </label>
                <textarea disabled class="form-control"  id="end_reasons" rows='7'>
                    <?php echo $end_reasons ?>
                </textarea>
            </div> <br>

            <div class="form-group">
                <label for="end_procedures">
                    Acciones tomadas por el/la Maestr@ y/u otro peronal antes de referir al estudiante:
                </label>
                <textarea disabled class="form-control"  id="end_procedures" rows='7'>
                    <?php echo $end_procedures ?>
                </textarea>
            </div> <br>

            <div class="form-inline">
                <div class="form-group">
                    <label for="end_historial">Historial: </label>
                    <input disabled class="form-control" type='text' name='end_historial' value='<?php echo $end_historial; ?>'>
                </div> 

                <div class="form-group">
                    <label for="end_situation_level">Nivel de Situacion: </label>
                    <input disabled class="form-control" type='text' name='end_situation_level' value='<?php echo $end_situation_level; ?>'>
                </div>
            </div>
        

            <hr>



            <!-- Teacher name -->

                <div class="form-inline">
                    <div class="form-group">
                    <label for="end_teacher_id">Maestro que refiere: </label>
<?php
                $query = "SELECT * FROM teachers WHERE tea_id = $end_teacher_id";
                $select_teachers = mysqli_query($connection, $query); //Pass the connection and query

                while ($row = mysqli_fetch_assoc($select_teachers)) {
                $tea_fullname = $row['tea_firstname'] . ' ' . $row['tea_lastname'];

                    echo "<input disabled class='form-control' type='text' name='teacher' value='{$tea_fullname}'>";

                }
?>
                    </div>

                    <div class="form-group">
                        <label for="end_date">Fecha del referido:</label>
                        <input disabled class="form-control" type='text' name='end_date' value='<?php echo $end_date; ?>'>
                    </div>
                </div> <br>

            <!-- Employee name -->
            <div class="form-inline">
                <div class="form-group">
                <label for="employee">Verificado Por: </label>
<?php
            $query = "SELECT * FROM employees WHERE emp_id = $end_employee_id";
            $select_employees = mysqli_query($connection, $query); //Pass the connection and query

            // confirmQuery($select_employees);

            while ($row = mysqli_fetch_assoc($select_employees)) {
            $emp_id = $row['emp_id'];
            $emp_firstname = $row['emp_firstname'];
            $emp_lastname = $row['emp_lastname'];
            $emp_role = $row['emp_role'];
            
                echo "<input disabled class='form-control'  type='text' name='employee' size='35' 
                value='{$emp_role} - {$emp_firstname} {$emp_lastname}'>";
            }
?>
                </div>
                <div class="form-group">
                        <label for="end_revision_date">Fecha de revisión:</label>
                        <input disabled class="form-control" type='text' name='end_revision_date' value='<?php echo $end_revision_date; ?>'>
                </div>
            </div>

        </form>

            
<?php }//while loop 

}//isset p_id   ?>

 





    </div> <!-- col-md-8 -->

    <!-- Blog Sidebar Widgets Column -->
<?php include "includes/sidebar_demo.php"; ?>



</div>
<!-- /.row -->

<hr>

<?php include "includes/footer.php" ?>