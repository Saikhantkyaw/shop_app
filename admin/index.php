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
                 <a href="product_add.php" class="btn btn-info">new product add</a>
              </div>
              <?php 


              if (!empty($_GET['pageno'])) {
                $pageno=$_GET['pageno'];
              }else{
                $pageno=1;
              }
              $noOfrec=5;
              $offset=($pageno-1)*$noOfrec;


              if (empty($_POST['search'])&&empty($_COOKIES['search'])) {

                    $statment= $pdo->prepare("SELECT * FROM products ORDER BY id DESC");
              $statment->execute();
              $rawResult=$statment->FETCHALL();
              $total_pages=ceil(count($rawResult)/$noOfrec);

      $statment= $pdo->prepare("SELECT * FROM products ORDER BY id DESC LIMIT $offset,$noOfrec");
              $statment->execute();
              $result=$statment->FETCHALL();
              
              }else{

              $searchkey=$_POST['search']?$_POST['search']:$_COOKIES['search'];
  $statment= $pdo->prepare("SELECT * FROM products WHERE title LIKE '%$searchkey%' 
   ORDER BY id DESC");
              $statment->execute();
              $rawResult=$statment->FETCHALL();
              $total_pages=ceil(count($rawResult)/$noOfrec);

$statment= $pdo->prepare("SELECT * FROM products WHERE title LIKE '%$searchkey%' ORDER BY id DESC LIMIT $offset,$noOfrec");

              $statment->execute();
              $result=$statment->FETCHALL();
              }
               

               ?>
             
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>id</th>
                      <th>name</th>
                      <th>description</th>
                       <th>category</th>
                      <th>Instock</th>
                      <th>price</th>
                     <th>action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                if ($result) 
                {$i=1;
                  foreach ($result as $value) 
                  {?>
                    <?php 


          $cat_statment= $pdo->prepare("SELECT * FROM categories WHERE id=".$value['categoy_id']);
                    $cat_statment->execute();
                    $cat_result=$statment->FETCHALL();
                     ?>
                        <tr>
                      <td> <?php echo $i; ?> </td>
                      <td style ="width:400px;"> <?php echo mo($value['name']) ;?> </td>
                      <td style ="width:450px;">
                      <?php echo substr(mo( $value['description']),0,30) ;?>
                        
                      </td>
                      <td><?php echo mo($cat_result[0]['name']) ;?></td>
                      <td><?php echo mo($value['quantity']) ;?></td>
                      <td><?php echo mo($value['price']) ;?></td>
                      <td>
                        <div class="btn-group">
                          
                        <div>
             
                      <a href="edit.php?id=<?php echo $value['id']; ?>"  class="btn btn-warning">Edit</a></div><br>
                      <div>
                      
                      <a href="delete.php?id=<?php echo $value['id']; ?>" 
                      onclick="return confirm('ARE you sure to delete?')" class="btn btn-danger">Delete</a></div></div>
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
 
 


