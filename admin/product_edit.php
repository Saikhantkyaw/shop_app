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
 
 if ($_POST){
 
  if (empty($_POST['name']) || empty($_POST['description']) || empty($_POST['category']) || 
empty($_POST['quantity']) || empty($_POST['price'])  || empty($_FILES['image'])){
        
 if (empty($_POST['name'])) {
      $name_err="you need to put product name";
    }
    if (empty($_POST['description'])) {
      $description_err="you need to put product description";
    }
    if (empty($_POST['price'])) {
      $price_err="you need to put product price";
    }elseif(is_numeric($_POST['price'])!=1){
      $price_err=" product price must be integer";
    }
    if (empty($_POST['quantity'])) {
      $qua_err="you need to put product quantity";
    }elseif(is_numeric($_POST['quantity'])!=1){
      $qua_err=" product quantity must be integer";
    }
    if (empty($_POST['category'])) {
      $category_err="you need to select category";
    }
    if (empty($_FILES['image'] )) {
      $img_err="you need to put image";
    }
 }else{
        if ($_FILES['image']['name']!=null) {
                 $files="images/".($_FILES['image']['name']);
             $imagetype=pathinfo($files,PATHINFO_EXTENSION);
              if ($imagetype!='jpg' && $imagetype!='jpeg' && $imagetype!='png' ) {
               echo "<script>alert('image must be jpg or png or jpeg')</script>";
              }else{
                     $name=$_POST['name'];
                     $description=$_POST['description'];
                    $price=$_POST['price'];
                    $category=$_POST['category'];
                    $quantity=$_POST['quantity'];
                    $image=$_FILES['image'] ['name'];
                     move_uploaded_file($_FILES['image']['tmp_name'],$files);


                     $stmt=$pdo->prepare("UPDATE products SET name=:name,description=:description,
                      price=:price,category_id=:category,quantity=:quantity,image=:image");
                     $result=$stmt->execute(
                      array(':name'=>$name,':description'=>$description,':price'=>$price,
                            ':category'=>$category,':quantity'=>$quantity,':image'=>$image)

                     );

                     if ($result) {
                      echo "<script>alert('new product is updated');window.location.href='index.php'</script>";
                     }

              }
        }else{
           
          
                   $name=$_POST['name'];
                   $description=$_POST['description'];
                  $price=$_POST['price'];
                  $category=$_POST['category'];
                  $quantity=$_POST['quantity'];
                  


                   $stmt=$pdo->prepare("UPDATE products SET name=:name,description=:description,
                      price=:price,category_id=:category,quantity=:quantity");
                   $result=$stmt->execute(
                    array(':name'=>$name,':description'=>$description,':price'=>$price,
                          ':category'=>$category,':quantity'=>$quantity)

                   );

                   if ($result) {
                    echo "<script>alert('new product is updated');window.location.href='index.php'</script>";
                   }

            
        }
  
   
   
 }
}
 
       $statment=$pdo->prepare("SELECT * FROM products WHERE id=".$_GET['id']);
       $statment->execute();
       $result= $statment->fetchall();


 ?>
          <?php require("header.php"); ?>
            <h1 class="m-0">to add new products</h1>
          </div><!-- /.col --><br><br>
          <div class="col-md-12">
            <div class="card">
            	<div class="card-body">
            		
            	
             <form action="" method="POST" accept-charset="utf-8" 
             enctype="multipart/form-data">
            
             <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>">
             <div class="form-group">
             	<label for="">product name</label>
              <p class="text-danger"><?= empty($name_err)?'':$name_err;?></p>
          <input type="text" name="name" value="<?= mo($result[0]['name']); ?>" 
          class="form-control" >
             </div>
             <div class="form-group">
             	<label for="">description</label>
              <p class="text-danger"><?= empty($description_err)?'':$description_err;?></p>
                 <textarea name="description" rows="8" cols="80" class="form-control" >
                   <?= mo($result[0]['description']); ?>
                 </textarea>
             </div>
              <div class="form-group">
                 <?php 
              $cat_statment= $pdo->prepare("SELECT * FROM categories");
              $cat_statment->execute();
              $cat_result=$cat_statment->FETCHALL();
               
              ?>
              <label for=""></label>
              <p class="text-danger"><?= empty($category_err)?'':$category_err;?></p>
             
              <select name="category" class="form-control">
               
             <?php foreach ($cat_result as $value) :?>


              <?php if ($value['id']==$result[0]['category_id']): ?>
           
                <option value="<?= $value['id']; ?>" selected><?= mo($value['name']) ; ?></option>
                <?php else: ?>
                 <option value="<?= $value['id']; ?>"><?= mo($value['name'] ); ?></option>
              <?php endif ?>
             
             
              <?php endforeach; ?>      
              </select>
             
             </div>
             <div class="form-group">
              <label for="">Quantity</label>
              <p class="text-danger"><?= empty($qua_err)?'':$qua_err;?></p>
              <input type="number" name="quantity" value="<?= mo($result[0]['quantity']); ?>" 
              class="form-control" >
             </div>
               <div class="form-group">
              <label for="">Price</label>
              <p class="text-danger"><?= empty($price_err)?'':$price_err;?></p>
              <input type="number" name="price" value="<?= mo($result[0]['price']); ?>" 
              class="form-control" >
             </div>
               <div class="form-group">
              <label for="">image</label>
              <p class="text-danger"><?= empty($img_err)?'':$img_err;?></p>
              <img src="images/<?= $result[0]['image']; ?>" width="150px" height="150px"><br>
              <input type="file" name="image" value=""  >
             </div>
             <div class="form-group">
             	<input type="submit" value="POST" class="btn btn-info">
             	<a href="index.php" class="btn btn-warning">BACK</a>
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
