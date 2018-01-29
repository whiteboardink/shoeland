
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <link rel="icon" href="images/icon4.png">

    <title>Shoeland | Admin</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="starter-template.css" rel="stylesheet">
    <script src="js/ie-emulation-modes-warning.js"></script>
    <link href="css/style.css" rel="stylesheet">
    <?php
      include('session.php');
    ?>
  </head>

  <body>

    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Shoeland</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="dashboard.php">Dashboard</a></li>
            <li><a href="help.php">Help</a></li>
            <li><a href="contact.php">Contact</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Welcome to Admin Panel</a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-10">
            <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Shoeland | Dashboard <small>Manage your app here</small></h1>
          </div>
        </div>
      </div>
    </header>

    <section id="breadcrumb">
      <div class="container">
          <ol class="breadcrumb">
            <li class="active">You may add or update products</li>
          </ol>
      </div>
    </section>

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="list-group">
              <a href="dashboard.php" class="list-group-item">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard
              </a>
              <a href="home.php" class="list-group-item"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a>
              <a href="products.php" class="list-group-item active main-color-bg"><span class="glyphicon glyphicon-tags" aria-hidden="true"></span> Products</a>
              <a href="brands.php" class="list-group-item"><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span> Brands</a>
              <a href="youtube.php" class="list-group-item"><span class="glyphicon glyphicon-facetime-video" aria-hidden="true"></span> Youtube Link</a>
              <a href="notification.php" class="list-group-item"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Notifications</a>
              <a href="users.php" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Users</a>
              <a href="social.php" class="list-group-item"><span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span> Social Feeds</a>
            </div>


        </div>
        <div class="col-md-9">
          <div class="panel panel-default">
            <div class="panel-heading main-color-bg">
              <h3 class="panel-title">Update Status</h3>
            </div>
            <div class="panel-body">
              <?php
              require_once("dbConnect.php");
              $product_name=$_POST['element_1'];
              $classification=$_POST['element_2'];
              $price=$_POST['element_3'];
              $price="MRP:".$price;
              $size="Size:".$_POST['element_4'];
              $colour=$_POST['element_5'];
              $filetmp = $_FILES["element_6"]["tmp_name"];
              $productid=$_POST['element_7'];
              $filename="product".$productid;
              $filepath = "photo/".$filename;

              move_uploaded_file($filetmp,$filepath);
              $query="UPDATE SHOELANDPRODUCTS SET pname='$product_name',mrp='$price',classification='$classification',size='$size', colour='$colour',image_link='$filepath',image_name='$filename' WHERE pid=$productid;";
              $result=mysqli_query($con,$query);
              if ($result)
              {
              echo "Product Updated Successfully!";
              header( "refresh:4;url=products.php" );
              }
              else {
                echo "Failed:Database has encountered an error while uploading!!!";
                header( "refresh:4;url=products.php" );
              }
              $query="SELECT vertion from version where table_name='SHOELANDPRODUCTS';";
              $version=mysqli_query($con,$query);
              $row = mysqli_fetch_assoc($version);
              $value=$row['vertion'];
              $value=$value+1;
              $query="UPDATE version set vertion= $value where table_name='SHOELANDPRODUCTS';";
              mysqli_query($con,$query);
              mysqli_close($con);

              ?>

            </div>
          </div>

        </div>
        </div>
      </div>
    </section>




    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
