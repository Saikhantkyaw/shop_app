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
  $statment= $pdo->prepare("SELECT * FROM categories ORDER BY id DESC");
  $statment->execute();
  $result=$statment->FETCHALL();
 if ($_POST) 
 {

 }

 ?>
          <?php require("header.php"); ?>
            <h1 class="m-0">to add new products</h1>
          </div><!-- /.col --><br><br>
          <div class="col-md-12">
            <div class="card">
            	<div class="card-body">
            		
            	
             <form action="cat_add.php" method="post" accept-charset="utf-8" 
             enctype="multipart/form-data">
             <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>">
             <div class="form-group">
             	<label for="">product name</label>
              <p class="text-danger"><?= empty($name_err)?'':$name_err;?></p>
             	<input type="text" name="name" value="" class="form-control" >
             </div>
             <div class="form-group">
             	<label for="">description</label>
              <p class="text-danger"><?= empty($description_err)?'':$description_err;?></p>
                 <textarea name="description" rows="8" cols="80" class="form-control" ></textarea>
             </div>
              <div class="form-group">
              <label for=""></label>
              <select name="category" class="form-control">
                <option value="">SELECT Categories</option>
               <option value="1">gogo</option>
                  <option value="2">momo</option>
                    
              </select>
             
             </div>
             <div class="form-group">
              <label for="">Quantity</label>
              <p class="text-danger"><?= empty($qua_err)?'':$qua_err;?></p>
              <input type="number" name="quantity" value="" class="form-control" >
             </div>
               <div class="form-group">
              <label for="">Price</label>
              <p class="text-danger"><?= empty($price_err)?'':$price_err;?></p>
              <input type="number" name="quantity" value="" class="form-control" >
             </div>
               <div class="form-group">
              <label for="">image</label>
              <p class="text-danger"><?= empty($price_err)?'':$price_err;?></p>
              <input type="file" name="image" value=""  >
             </div>
             <div class="form-group">
             	<input type="submit" value="POST" class="btn btn-info">
             	<a href="category.php" class="btn btn-warning">BACK</a>
             </div>
             </form>
             	</div>
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
