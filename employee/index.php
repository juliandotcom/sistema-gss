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


    <!-- CITAS -->
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
<?php

            $query = "SELECT * FROM appointments";
            $select_all_post = mysqli_query($connection, $query);
            $app_count = mysqli_num_rows($select_all_post);

            echo "<div class='huge'>{$app_count}</div>";

?>       
                        <div>Citas</div>
                    </div>
                </div>
            </div>
            <a href="appointments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>


    <!-- ENDORSMENTS -->
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
<?php

                $query = "SELECT * FROM endorsments";
                $select_all_comment = mysqli_query($connection, $query);
                $end_count = mysqli_num_rows($select_all_comment);

                echo "<div class='huge'>{$end_count}</div>";

?>

                      <div>Referidos</div>
                    </div>
                </div>
            </div>
            <a href="endorsments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>



    <!-- USERS -->
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
<?php

                $query = "SELECT * FROM parents";
                $select_all_users = mysqli_query($connection, $query);
                $par_count = mysqli_num_rows($select_all_users);

                echo "<div class='huge'>{$par_count}</div>";

?>
                        <div>Parientes</div>
                    </div>
                </div>
            </div>
            <a href="parents.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

        <!-- Teachers -->
        <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
<?php

                $query = "SELECT * FROM teachers";
                $select_all_users = mysqli_query($connection, $query);
                $tea_count = mysqli_num_rows($select_all_users);

                echo "<div class='huge'>{$tea_count}</div>";

?>
                        <div>Maestros</div>
                    </div>
                </div>
            </div>
            <a href="teachers.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

                <!-- /.row -->

<?php

// APPOINTMENTS STATUS COUNT
$query = "SELECT * FROM appointments WHERE app_status = 'Pendiente' ";
$select_pendiente_app = mysqli_query($connection,$query);
$app_pendiente = mysqli_num_rows($select_pendiente_app);

$query = "SELECT * FROM appointments WHERE app_status = 'Verificado' ";
$select_verificado_app = mysqli_query($connection, $query);
$app_verificado = mysqli_num_rows($select_verificado_app);


// ENDORSMENT STATUS COUNT
$query = "SELECT * FROM endorsments WHERE end_status = 'Pendiente' ";
$select_pendiente_end = mysqli_query($connection, $query);
$end_pendiente = mysqli_num_rows($select_pendiente_end);

$query = "SELECT * FROM endorsments WHERE end_status = 'Verificado' ";
$select_verificado_end = mysqli_query($connection, $query);
$end_verificado = mysqli_num_rows($select_verificado_end);


// POSTS STATUS COUNT
$query = "SELECT * FROM posts WHERE post_status = 'draft' ";
$select_draft_post = mysqli_query($connection, $query);
$post_draft = mysqli_num_rows($select_draft_post);

$query = "SELECT * FROM posts WHERE post_status = 'published' ";
$select_published_post = mysqli_query($connection, $query);
$post_published = mysqli_num_rows($select_published_post);

?>


<canvas id="myChart"></canvas>





<script type="text/javascript">

let myChart = document.getElementById('myChart').getContext('2d');

// Global Options
Chart.defaults.global.defaultFontFamily = 'Lato';
Chart.defaults.global.defaultFontSize = 18;
Chart.defaults.global.defaultFontColor = '#777';

let massPopChart = new Chart(myChart, {
  type:'bar', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
  data:{
    labels:[
        'Citas Pendientes', 
        'Citas Verificadas', 
        'Referidos Pendientes', 
        'Referidos Verificados', 
        'Blogs Borradores', 
        'Blogs Publicados'],
    datasets:[{
      label:'Data',
      data:[
        <?php echo $app_pendiente; ?>,
        <?php echo $app_verificado; ?>,
        <?php echo $end_pendiente; ?>,
        <?php echo $end_verificado; ?>,
        <?php echo $post_draft; ?>,
        <?php echo $post_published; ?>
      ],
      //backgroundColor:'green',
      backgroundColor:[
        'rgba(255, 99, 132, 0.6)',
        'rgba(54, 162, 235, 0.6)',
        'rgba(255, 206, 86, 0.6)',
        'rgba(75, 192, 192, 0.6)',
        'rgba(153, 102, 255, 0.6)',
        'rgba(255, 159, 64, 0.6)',
        'rgba(255, 99, 132, 0.6)'
      ],
      borderWidth:1,
      borderColor:'#777',
      hoverBorderWidth:3,
      hoverBorderColor:'#000'
    }]
  },
  options:{
    title:{
      display:true,
      text:'Data',
      fontSize:25
    },
    legend:{
      display:true,
      position:'right',
      labels:{
        fontColor:'#000'
      }
    },
    layout:{
      padding:{
        left:50,
        right:0,
        bottom:0,
        top:0
      }
    },
    tooltips:{
      enabled:true
    }
  }
});
 
</script>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->


<?php include "includes/admin_footer.php"; ?>