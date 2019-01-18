<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    
            <tbody>
                      

<?php 
    
    $query = "SELECT * FROM employees";
    $select_employees = mysqli_query($connection,$query);  
    while($row = mysqli_fetch_assoc($select_employees)) {
        $emp_id             = $row['emp_id'];
        $emp_username       = $row['emp_username'];
        $emp_fullname       = $row['emp_firstname'] . ' ' . $row['emp_lastname'];
        $emp_email          = $row['emp_email'];
        $emp_role           = $row['emp_role'];
    
        
        echo "<tr>";
        
        echo "<td>$emp_id </td>";
        echo "<td>$emp_username</td>";
        echo "<td>$emp_fullname</td>";
        echo "<td>$emp_email</td>";
        echo "<td>$emp_role</td>";
        
        
        // echo "<td><a href='emps.php?change_to_admin={$emp_id}'>Admin</a></td>";
        // echo "<td><a href='emps.php?change_to_sub={$emp_id}'>Subscriber</a></td>";
        echo "<td><a href='employees.php?source=edit_employee&edit_employee={$emp_id}'>Edit</a></td>";
        echo "<td><a href='employees.php?delete={$emp_id}'>Delete</a></td>";
        echo "</tr>";

    }//While loop


?>

            </tbody>
            </table>
            
            
<?php

if(isset($_GET['change_to_admin'])) {
    
    $the_emp_id = $_GET['change_to_admin'];
    
    $query = "UPDATE employees SET emp_role = 'admin' WHERE emp_id = $the_emp_id   ";
    $change_to_admin_query = mysqli_query($connection, $query);
    header("Location: employees.php");
     
}





if(isset($_GET['change_to_sub'])){
    
    $the_user_id = $_GET['change_to_sub'];
    
    $query = "UPDATE employees SET emp_role = 'subscriber' WHERE user_id = $the_user_id   ";
    $change_to_sub_query = mysqli_query($connection, $query);
    header("Location: users.php");   
}



    if(isset($_GET['delete'])){

        if(isset($_SESSION['user_role'])) {
    
            if($_SESSION['user_role'] == 'admin') {
    
            $the_user_id = mysqli_real_escape_string($connection, $_GET['delete']);
    
            $query = "DELETE FROM users WHERE user_id = {$the_user_id} ";
            $delete_user_query = mysqli_query($connection, $query);
            header("Location: users.php");
    
                }   
    
    
            }
       
        
        }

?>     