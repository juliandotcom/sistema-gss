<?php

        if(isset($_POST['checkBoxArray'])) {
            
            foreach($_POST['checkBoxArray'] as $appointmentValueId ){
                
        $bulk_options = $_POST['bulk_options'];
                
                switch($bulk_options) {
                case 'published':
                
        $query = "UPDATE appointments SET app_status = '{$bulk_options}' WHERE app_id = {$appointmentValueId}  ";
                
        $update_to_published_status = mysqli_query($connection,$query);       
        confirmQuery($update_to_published_status);

                break;        
                    
                    case 'draft':
                
        $query = "UPDATE appointments SET app_status = '{$bulk_options}' WHERE app_id = {$appointmentValueId}  ";
                
        $update_to_draft_status = mysqli_query($connection,$query);
                    
        confirmQuery($update_to_draft_status);

                break;
                            
                    case 'delete':
                
        $query = "DELETE FROM appointments WHERE app_id = {$appointmentValueId}  ";
                
        $update_to_delete_status = mysqli_query($connection,$query);
                    
        confirmQuery($update_to_delete_status);
                
                break;

                /*
                    CLONE
                */

                    case 'clone':

                    $query = "SELECT * FROM appointments WHERE app_id = '{$appointmentValueId}' ";
                    $select_app_query = mysqli_query($connection, $query);
        
                    while ($row = mysqli_fetch_array($select_app_query)) {
                        $app_status             = $row['app_status'];
                        $app_category_id        = $row['app_category_id'];
                        // $app_date               = date("d-M-Y h:i:s A", strtotime($row['app_date'])); //$row['app_date'];
                        $app_parent_name        = $row['app_parent_name'];
                        $app_student_name       = $row['app_student_name'];
                        $app_student_group      = $row['app_student_group'];
                        $app_phone_number       = $row['app_phone_number'];
                        $app_mobile_number      = $row['app_mobile_number'];
                        $app_day_of_week        = $row['app_day_of_week'];
                        $app_time_of_day        = $row['app_time_of_day'];
                        $app_parent_comment     = $row['app_parent_comment'];
                        $app_parent_id          = $row['app_parent_id'];
                        $app_employee_id        = $row['app_employee_id'];
                        // $app_employee_role      = $_POST['app_employee_role'];
                        $app_employee_comment   = $row['app_employee_comment'];
                }


                        $query = 
                        "INSERT INTO 
                        appointments(
                            app_status, 
                            app_category_id,
                            app_date, 
                            app_parent_name, 
                            app_student_name, 
                            app_student_group,
                            app_mobile_number,
                            app_phone_number,
                            app_day_of_week,
                            app_time_of_day,
                            app_parent_id,
                            app_parent_comment,
                            app_employee_id,
                            app_employee_comment) 
                        VALUES(
                            '{$app_status}', 
                            '{$app_category_id}',
                            now(),
                            '{$app_parent_name}', 
                            '{$app_student_name}', 
                            '{$app_student_group}',
                            '{$app_mobile_number}',
                            '{$app_phone_number}',
                            '{$app_day_of_week}',
                            '{$app_time_of_day}',
                            '{$app_parent_id}',
                            '{$app_parent_comment}',
                            '{$app_employee_id}',
                            '{$app_employee_comment}')";



                        $copy_query = mysqli_query($connection, $query);   

                    if(!$copy_query ) {

                        die("QUERY FAILED" . mysqli_error($connection));
                    }   
                        
                        break;
                }
            } 
        }
?>


<form action="" method="post">


<table class="table table-bordered table-hover">


        <div id="bulkOptionContainer" class="col-xs-4">

            <select class="form-control" name="bulk_options" id="">
                <option value="">Select Options</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
                <option value="clone">Clone</option>
            </select>
        </div> 

        <div class="col-xs-4">

            <input type="submit" name="submit" class="btn btn-success" value="Apply">
            <a class="btn btn-primary" href="appointments.php?source=add_appointment">Add New</a>

        </div>
         

            <thead>
                <tr>
                    <th><input id="selectAllBoxes" type="checkbox"></th>
                    <th>Id</th>
                    <th>Fecha Sometido</th>
                    <th>Padres</th>
                    <th>Estudiantes </th>
                    <th>Category</th>
                    <th>Fecha Cita</th>
                    <th>Revisado Por</th>
                    <!-- <th>Comments</th> -->
                    <th>Estatus</th>
                    <th>Ver Cita</th>
                    <th>Editar</th>
                    <th>Borrar</th>
                </tr>
            </thead>
                <tbody>

<?php

                        
    $query = 
    "SELECT * 
    FROM appointments 
    ORDER BY app_id DESC";
    $select_appointments = mysqli_query($connection, $query); //Pass the connection and query


    while ($row = mysqli_fetch_assoc($select_appointments)) {
    $app_id = $row['app_id'];
    $app_date = $row['app_date'];
    $app_user = $row['app_parent_name'];
    $app_student_name = $row['app_student_name'];
    $app_category_id = $row['app_category_id'];
    $app_day_of_week = $row['app_day_of_week'];
    $app_time_of_day = $row['app_time_of_day'];
    $app_employee_id = $row['app_employee_id'];
    // $app_employee_fullname = $row['app_employee_fullname'];
    // $app_employee_role = $row['app_employee_role'];
    $app_status = $row['app_status'];

    echo "<tr>";
?>

 <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $app_id; ?>'></td>

<?php
    //Appointment ID
    echo "<td>$app_id</td>";

    //Date of Creation
    echo "<td>$app_date</td>";

    //Name of Parent
    if(!empty($app_user)) {

        echo "<td>$app_user</td>";
   }

   echo "<td>$app_student_name</td>";

    $query = "SELECT * FROM categories WHERE cat_id = {$app_category_id} ";
    $select_categories_id = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_categories_id)) {
        $cat_id =  $row['cat_id'];
        $cat_title = $row['cat_title'];
        
        echo "<td>{$cat_title}</td>";

    }//While loop

    //Date of Appointment
    echo "<td>$app_day_of_week , $app_time_of_day</td>";




    //Employee fullname

    $query = "SELECT * FROM employees WHERE emp_id = $app_employee_id";
    $select_employees = mysqli_query($connection, $query); //Pass the connection and query

    confirmQuery($select_employees);

    while ($row = mysqli_fetch_assoc($select_employees)) {
    $emp_id = $row['emp_id'];
    $emp_fullname = $row['emp_firstname'] . ' ' . $row['emp_lastname'];
    $emp_role = $row['emp_role'];
       

        echo "<td><b>{$emp_role}</b> - {$emp_fullname}</td>";

    }
    


    // echo "<td><b>$app_employee_role</b> - $app_employee_fullname  </td>";

    //App Status
    echo "<td>$app_status</td>";

    echo "<td><a class='btn btn-primary' target='_blank' rel='noopener noreferrer' href='../appointment_tab.php?p_id={$app_id}'>View Appointment</a></td>";
    
    echo "<td><a href='appointments.php?source=edit_appointment&p_id={$app_id}'>Edit</a></td>"; //the & divide values
   
    echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this appointment?');\" 
            href='appointments.php?delete={$app_id}'>Delete</a></td>";
    echo "</tr>";

    }//while

?>
                </tbody>
                </table>
    </form>


<?php

    if(isset($_GET['delete'])){

        $the_app_id = $_GET['delete'];

        $query = "DELETE FROM appointments WHERE app_id = {$the_app_id} ";
        $delete_query = mysqli_query($connection, $query);
        header("Location: appointments.php");
    }



    if(isset($_GET['reset'])){
    
        $the_app_id = $_GET['reset'];
        
        $query = "UPDATE appointments SET app_views_count = 0 WHERE app_id = $the_app_id  ";
        $reset_query = mysqli_query($connection, $query);
        header("Location: appointments.php");
        
        
    }


?>