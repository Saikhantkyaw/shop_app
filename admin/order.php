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
             <h1 class="m-0">order list</h1>
          </div><!-- /.col --><br><br>
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"></h3><br>
                 
              </div>
              <?php 


              if (!empty($_GET['pageno'])) {
                $pageno=$_GET['pageno'];
              }else{
                $pageno=1;
              }
              $noOfrec=5;
              $offset=($pageno-1)*$noOfrec;



                    $statment= $pdo->prepare("SELECT * FROM sale_order ORDER BY id DESC");
              $statment->execute();
              $rawResult=$statment->FETCHALL();
              $total_pages=ceil(count($rawResult)/$noOfrec);

    $statment= $pdo->prepare("SELECT * FROM sale_order ORDER BY id DESC LIMIT $offset,$noOfrec");
              $statment->execute();
              $result=$statment->FETCHALL();
              
              
               

               ?>
             
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>id</th>
                      <th>user</th>
                      <th>total price</th>
                       <th >order date</th>
                      <th >Action</th>
                    </tr>
                  </thead>
                  <tbody>
                 
                    <?php 
                if ($result) 
                {$i=1;
                  foreach ($result as $value) 
                  {?>
          <?php  $user_statment=$pdo->prepare("SELECT * FROM users WHERE id=".$value['user_id']);
                         $user_statment->execute();
                         $user_result= $user_statment->fetchall(); ?>
                        <tr>
                      <td> <?php echo $i; ?> </td>
                      <td style ="width:400px;"> <?php echo mo($user_result[0]['id']) ;?> </td>
                    <td > 
                      <?php echo mo( $value['total_price']);?>
                        
                      </td>
                      <td><?= mo(date('Y-m-d',strtotime($value['order_date'])))?> </td>
                      <td>
                        <div class="btn-group">
                          
                        <div>
             
                      <a href="order_detail.php?id=<?php echo $value['id']; ?>" 
                       class="btn btn-warning">View</a></div><br>
                     </div>
                      </td>
                      </tr>
                    
              <?php $i++;
                  }
                }

                  ?>

                      
                  </tbody>
                </table><br>
              <nav aria-label="Page navigation example" style="float:right;">
                <ul class="pagination">
                  <li class="page-item"><a class="page-link" href="?pageno=1">First</a></li>
                  <li class="page-item" <?php if($pageno<=1){echo 'disabled';} ?>>
<a class="page-link" href="<?php if($pageno<=1){echo "#";}else{echo "?pageno=".($pageno-1);} ?>">                  Previous</a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#"><?= $pageno; ?></a></li>
                <li class="page-item" <?php if($pageno>=$total_pages){echo 'disabled';} ?>>
                 <a class="page-link" 
      href="<?php if($pageno>=$total_pages){echo "#";}else{echo "?pageno=".($pageno+1);} ?>">
                    Next</a>
                  </li>
                  <li class="page-item"><a class="page-link" href="?pageno=<?= $total_pages; ?>">Last</a>
                  </li>
                </ul>
              </nav>
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
 
 


