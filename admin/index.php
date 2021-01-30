<?php 
 session_start();
 require("../connection/config.php");
 require("../connection/common.php");
 if (empty(  $_SESSION['user_id'])&&empty(  $_SESSION['logged_in'])) 
 {
 	header("Location:login.php");
 }
 if ( $_SESSION['role']!=1) {
   header("Location:login.php");
 }
  if (!empty($_POST['search'])) {
  setcookie('search', $_POST['search'], time() + (86400 * 30), "/"); 
  
 }else{
 if (empty($_GET['pageno'])) {
  unset($_COOKIE['search']); 
    setcookie('search', null, -1, '/'); 
 }

 }
  

 ?>
          <?php require("header.php"); ?>
             <h1 class="m-0">Product list</h1>
          </div><!-- /.col --><br><br>
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"></h3><br>
                 <a href="add.php" class="btn btn-info">new product add</a>
              </div>
             
             
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>id</th>
                      <th>Title</th>
                      <th>Content</th>
                      <th >Action</th>
                    </tr>
                  </thead>
                  <tbody>
                 
                    
                      
                  </tbody>
                </table><br>
              
              </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
         
          
          <!-- /.col-md-6 -->
         
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php require("footer.php") ;?>
 
 


