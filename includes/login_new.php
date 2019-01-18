<?php include "db.php"; ?>

<?php session_start(); ?>

<?php 

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    //Clean SQL Injection
    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    /*
        Primer QUERY
    */
    $query = 
    "SELECT * 
    FROM employees 
    WHERE emp_username = '{$username}' ";
    $select_user_query = mysqli_query($connection, $query);
    if (!$select_user_query) {
        die("QUERY FAILED: " . mysqli_error($connection));
    }//if

    $count = mysqli_num_rows($select_user_query);
    /*
        FIRST IF
    */
    if($count == 1){
        while($row = mysqli_fetch_array($select_user_query)){
            $db_user_id = $row['emp_id'];
            $db_user_username = $row['emp_username'];
            $db_user_password = $row['emp_password'];
            $db_user_firstname = $row['emp_firstname'];
            $db_user_lastname = $row['emp_lastname'];
        }//while loop

        if(password_verify($password, $db_user_password)){

            $_SESSION['username'] = $db_user_username;
            $_SESSION['firstname'] = $db_user_firstname;
            $_SESSION['lastname'] = $db_user_lastname;
        
            header("Location: ../employee");
        }
    }//Primer if
        
    /*
        Segundo QUERY
    */
    $query = 
    "SELECT * 
    FROM parents 
    WHERE par_username = '{$username}' ";

    $select_user_query = mysqli_query($connection, $query);
    if (!$select_user_query) {
        die("QUERY FAILED: " . mysqli_error($connection));
    }//if

    $count = mysqli_num_rows($select_user_query);
        /*
            SECOND IF
        */
        if($count == 1){
            while($row = mysqli_fetch_array($select_user_query)){
                $db_user_id = $row['par_id'];
                $db_user_username = $row['par_username'];
                $db_user_password = $row['par_password'];
                $db_user_firstname = $row['par_firstname'];
                $db_user_lastname = $row['par_lastname'];
            }//while loop

            if(password_verify($password, $db_user_password)){

                $_SESSION['username'] = $db_user_username;
                $_SESSION['firstname'] = $db_user_firstname;
                $_SESSION['lastname'] = $db_user_lastname;
            
                header("Location: ../parent");

            }
        }//Segundo if

    /*
        Tercer QUERY
    */
    $query = 
    "SELECT * 
    FROM teachers 
    WHERE tea_username = '{$username}' ";

    $select_user_query = mysqli_query($connection, $query);
    if (!$select_user_query) {
        die("QUERY FAILED: " . mysqli_error($connection));
    }//if

    $count = mysqli_num_rows($select_user_query);
        /*
            Tercer if
        */
        if($count == 1){
            while($row = mysqli_fetch_array($select_user_query)){
                $db_user_id = $row['tea_id'];
                $db_user_username = $row['tea_username'];
                $db_user_password = $row['tea_password'];
                $db_user_firstname = $row['tea_firstname'];
                $db_user_lastname = $row['tea_lastname'];
            }//while loop

            if(password_verify($password, $db_user_password)){

                $_SESSION['username'] = $db_user_username;
                $_SESSION['firstname'] = $db_user_firstname;
                $_SESSION['lastname'] = $db_user_lastname;
            
                header("Location: ../teacher");

            }
        }//tercer if


    /*
        Cuarto QUERY
    */
    $query = 
    "SELECT * 
    FROM admins 
    WHERE admin_username = '{$username}' ";

    $select_user_query = mysqli_query($connection, $query);
    if (!$select_user_query) {
        die("QUERY FAILED: " . mysqli_error($connection));
    }//if

    $count = mysqli_num_rows($select_user_query);
        /*
            cuarto IF
        */
        if($count == 1){
            while($row = mysqli_fetch_array($select_user_query)){
                $db_user_id = $row['admin_id'];
                $db_user_username = $row['admin_username'];
                $db_user_password = $row['admin_password'];
                $db_user_firstname = $row['admin_firstname'];
                $db_user_lastname = $row['admin_lastname'];
            }//while loop

            if(password_verify($password, $db_user_password)){
                $_SESSION['id'] = $db_user_id;
                $_SESSION['username'] = $db_user_username;
                $_SESSION['firstname'] = $db_user_firstname;
                $_SESSION['lastname'] = $db_user_lastname;
            
                header("Location: ../admin");

            }
            //Cuarto if
        } else {
            print '<script type="text/javascript">';
            print 'alert("Incorrect user details.")';
            print '</script>';
            print '<meta http-equiv="REFRESH" content="0;url=../index.php">';
        }

}//isset iff
 
// else {
//     header("Location: ../index.php");
// }










?>