<?php

    if(isset($_GET['p_id'])){
        $the_post_id = $_GET['p_id'];

    }

    $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
    $select_posts_by_id = mysqli_query($connection, $query); //Pass the connection and query


    while ($row = mysqli_fetch_assoc($select_posts_by_id)) {
    $post_id = $row['post_id'];
    $post_user = $row['post_user'];
    $post_title = $row['post_title'];
    $post_category_id = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_content = $row['post_content'];
    $post_tags = $row['post_tags'];
    $post_date = $row['post_date'];
    
    }

    if(isset($_POST['update_post'])){

        $post_user= $_POST['post_user'];
        $post_title = $_POST['title'];
        $post_category_id = $_POST['post_category'];
        $post_status = $_POST['post_status'];
    
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];

        $post_content = $_POST['post_content'];
        $post_tags = $_POST['post_tags'];

        //To move temporary image to images folder.
        move_uploaded_file($post_image_temp, "../images/$post_image");

        //to update the image on database
        if(empty($post_image)){
            $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
            $select_image = mysqli_query($connection, $query);

            confirmQuery($select_image);

            while($row = mysqli_fetch_array($select_image)){
                $post_image = $row['post_image'];
            }
        }

        $query = "UPDATE posts SET ";
        $query .= "post_title = '{$post_title}', ";
        $query .= "post_category_id = '{$post_category_id}', ";
        $query .= "post_date = '{$post_date}', ";
        $query .= "post_user = '{$post_user}', ";
        $query .= "post_status = '{$post_status}', ";
        $query .= "post_tags = '{$post_tags}', ";
        $query .= "post_content = '{$post_content}', ";
        $query .= "post_image = '{$post_image}' ";
        $query .= "WHERE post_id = '{$the_post_id}' ";

        $update_post = mysqli_query($connection, $query);

        confirmQuery($update_post);

        echo "<p class='bg-success'>Post Updated. <a target='_blank' rel='noopener noreferrer' href='../post.php?p_id={$the_post_id}'>View Post </a> or <a href='posts.php'>Edit More Posts</a></p>";


    }//Isset

?>


                                <!-- enctype sends different form data (images) -->
<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="title">
    </div>

    <div class="form-group">
    <label for="categories">Categories</label>
    <select name="post_category" id="">
<?php 

    $query = 
    "SELECT * 
    FROM posts_categories";
    $select_categories = mysqli_query($connection, $query); //Pass the connection and query

    confirmQuery($select_categories);

    while ($row = mysqli_fetch_assoc($select_categories)) {
        $cat_id = $row['post_cat_id'];
        $cat_title = $row['post_cat_title'];

        if($cat_id == $post_category_id){

            echo "<option selected value='{$cat_id}'>{$cat_title}</option>";
        
        }else {

            echo "<option value='{$cat_id}'>{$cat_title}</option>";
        }
    }//while loop
?>
    </select>
    </div>

    <div class="form-group">
    <label for="users">Users</label>
    <select name="post_user" id="">

    <?php echo "<option value='{$post_user}'>{$post_user}</option>"; ?>
           
<?php

        $users_query = "SELECT * FROM employees";
        $select_users = mysqli_query($connection,$users_query);
        
        confirmQuery($select_users);


        while($row = mysqli_fetch_assoc($select_users)) {
        $user_id = $row['emp_id'];
        $user_firstname = $row['emp_firstname'];
        $user_lastname = $row['emp_lastname'];

        // echo "<option value='{$user_username}'>{$user_username} </option>";


        echo "<option value='{$user_firstname}' '{$user_lastname}'>{$user_firstname} {$user_lastname}</option>";

        }

?>             
        </select>
    </div>





    <div class="form-group">
    <label for="post_status">Status</label>
    <select name="post_status" id="">   
        <option value='<?php echo $post_status ?>'><?php echo $post_status; ?></option>
<?php
          if($post_status == 'published' ) {
            echo "<option value='draft'>draft</option>";
          } else {
            echo "<option value='published'>publish</option>";
          }

?>
    </select>
    </div>


    <div class="form-group">
        <img width='100' src="../images/<?php echo $post_image; ?>" alt="">
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input width="100" value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea  type="text" class="form-control" name="post_content" id="body" cols="30" rows="10">
        <?php echo $post_content; ?>"
        </textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
    </div>


</form>