<?php include "db.php"; ?>
<?php include "functions.php"; ?>
<?php session_start(); ?>

<?php 

if (isset($_POST['login'])) {

    $user_username = $_POST['username'];
    $user_password = $_POST['password'];

    //Clean SQL Injection
    $user_username = mysqli_real_escape_string($connection, $user_username);
    $user_password = mysqli_real_escape_string($connection, $user_password);

    $query = "SELECT * FROM teachers WHERE tea_username = '{$user_username}' ";
    $select_user_query = mysqli_query($connection, $query);
    
    if (!$select_user_query) {
        die("QUERY FAILED: " . mysqli_error($connection));
    }//if

    while($row = mysqli_fetch_array($select_user_query)){
        $db_user_id = $row['tea_id'];
        $db_user_username = $row['tea_username'];
        $db_user_password = $row['tea_password'];
        $db_user_firstname = $row['tea_firstname'];
        $db_user_lastname = $row['tea_lastname'];
        // $db_user_role = $row['tea__role'];

    }//while loop


}//isset iff

//=== means identical
if(password_verify($user_password, $db_user_password)){

    $_SESSION['username']   = $db_user_username;
    $_SESSION['firstname']  = $db_user_firstname;
    $_SESSION['lastname']   = $db_user_lastname;
    $_SESSION['id']         = $db_user_id;
    $_SESSION['user_role'] = $db_user_role;


    header("Location: ../teacher");

}  else {
    
    header("Location: ../index.php");
}

?>
