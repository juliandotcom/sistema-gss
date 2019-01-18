<!-- Blog Sidebar Widgets Column -->
<div class="col-md-4">


    <!-- Login -->
      <!-- Login -->
   


    <!-- Blog Search Well -->
    <div class="well">
        <h4>Search</h4>
        <!-- Search Form -->
        <form action="search.php" method="post">
        <div class="input-group">
            <input name="search" type="text" class="form-control">
            <span class="input-group-btn">
                <button name="submit" class="btn btn-default" type="submit">
                    <span class="glyphicon glyphicon-search"></span>
            </button>
            </span>
        </div>
        </form><!--Search Form -->
        <!-- /.input-group -->
    </div>



    



<!-- Blog Categories Well -->
<div class="well">

<?php

    $query = "SELECT * FROM categories";
    $select_all_categories_query = mysqli_query($connection, $query); //Pass the connection and query

?>

    <h4>Categorias</h4>
    <div class="row">
        <div class="col-lg-12">
            <ul class="list-unstyled">
<?php

        while ($row = mysqli_fetch_assoc($select_all_categories_query)) {
            $cat_title = $row['cat_title'];
            $cat_id = $row['cat_id'];

            echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
        }

?>
            </ul>
        </div>



    </div>
    <!-- /.row -->
</div>



<!-- Side Widget Well -->
<?php include "includes/widget_demo.php"; ?>

