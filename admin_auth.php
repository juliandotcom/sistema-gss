<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>

    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>LOGIN ADMIN TEST</h1>
                    <form role="form" action="includes/login_admin.php" method="post" id="login-form" autocomplete="off">


                        <div class="form-group">
                            <label for="username" class="sr-only">Nombre de Usuario</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Usuario">
                        </div>
                        
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="login" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Login Admin">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
