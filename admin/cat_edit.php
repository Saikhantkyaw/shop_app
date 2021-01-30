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
  $statment= $pdo->prepare("SELECT * FROM categories WHERE id=".$_GET['id']);
  $statment->execute();
  $result=$statment->FETCHALL();

 if ($_POST) 
 {
  if (empty($_POST['name'])||empty($_POST['description'])) {
    if (empty($_POST['name'])) {
     $name_err="you need to put your name";
    }
    if (empty($_POST['description'])) {
     $description_err="you need to put description";
    }
  }else{
    $name=$_POST['name'];
    $description=$_POST['description'];
    $id=$_POST['id'];
  $statment=$pdo->prepare("UPDATE categories SET name=:name,description=:description 
    WHERE id='$id'");
  $result=$statment->execute(
   array(
      ':name'=>$name,
      ':description'=>$description
   )
 );
  if ($result) {
    echo "<script>alert('your category is updated');window.location.href='category.php'</script>";
  }
  }
 }

 ?>
          <?php require("header.php"); ?>
            <h1 class="m-0">to add new category</h1>
          </div><!-- /.col --><br><br>
          <div class="col-md-12">
            <div class="card">
            	<div class="card-body">
            		
            	
             <form action="cat_add.php" method="post" accept-charset="utf-8" 
             enctype="multipart/form-data">
             <input type="hidden" name="id" value="<?=  mo($result[0]['id']); ?>">
             <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>">
             <div class="form-group">
             	<label for="">category name</label>
              <p class="text-danger"><?= empty($name_err)?'':$name_err;?></p>
             	<input type="text" name="name" value="<?= mo($result[0]['name']); ?>" 
              class="form-control" >
             </div>
             <div class="form-group">
             	<label for="">description</label>
              <p class="text-danger"><?= empty($description_err)?'':$description_err;?></p>
                 <textarea name="description" rows="8" cols="80" class="form-control" >
                   <?= mo($result[0]['description']);?>
                 </textarea>
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
