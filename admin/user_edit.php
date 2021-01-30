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
    if ($_POST) {
      if (empty($_POST['name']) || empty($_POST['email'])) {

     if (empty($_POST['name'])) {
       $name_err="* you need to fill name";
     }
     if (empty($_POST['email'])) {
       $email_err="* you need to fill email";
     }

   }elseif(!empty($_POST['password'])&& strlen($_POST['password']) < 4){
     $password_err="* your password must be 4 at least";
   }else{
     $id=$_POST['id'];
   
    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=password_hash($_POST['password'], PASSWORD_DEFAULT);
    if (empty($_POST['role'])) {
      $role=0;
    }else{
      $role=1;
    }
    $statment= $pdo->prepare("SELECT * FROM users WHERE email= :email AND id!=$id");
    $statment->BindValue(':email',$email);
    $statment->execute();
    $user=$statment->fetch(PDO::FETCH_ASSOC);
    if ($user) {
      echo "<script>alert('input invaid')</script>";
    }else{
       $statment=$pdo->prepare("UPDATE users SET name='$name',email='$email',
        role='$role',password='$password' WHERE
       id='$id'");
        $result=$statment->execute();
        if ($result) {
                echo
              "<script>alert('Your account is sucessfully updated');
                window.location.href='user_list.php'</script>";
        }
       
    }
   }
    
  }

     
    
       $statment=$pdo->prepare("SELECT * FROM users WHERE id=".$_GET['id']);
       $statment->execute();
       $result= $statment->fetchall();
   

    
 
 ?>
          <?php require("header.php"); ?>
            <h1 class="m-0">edit your account info</h1>
          </div><!-- /.col --><br><br>
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                    <form action="" method="post" accept-charset="utf-8" >
            <div class="form-group">
               <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>">
              <input type="hidden" name="id" value="<?=$result[0]['id'] ?>">
              <label for="">Name</label>
              <p class="text-danger"><?= empty($name_err)?'':$name_err;?></p>
              <input type="text" name="name" placeholder="enter your name" class="form-control" 
              value="<?=mo($result[0]['name']); ?>">
              
            </div>
            <div class="form-group">
              <label for="">Email</label>
              <p class="text-danger"><?= empty($email_err)?'':$email_err;?></p>
           <input type="email" name="email" placeholder="enter your email" class="form-control" 
           value="<?=mo($result[0]['email']); ?>">
              
            </div>
             <div class="form-group">
              <label for="">password</label>
               <p class="text-danger"><?= empty($password_err)?'':$password_err;?></p>
           <input type="password" name="password" placeholder="enter your password" 
           class="form-control" >
              <span style="font-size: 10px">This user already has password!!</span>
            </div>
            <div class="form-group">
              <label for="">admin</label>
              
              <input type="checkbox" name="role" value="<?=$result[0]['role'] ?>">
            </div>
             <div class="form-group">
              <input type="submit" name="submit" value="submit" class="btn btn-info">
              <a href="user_list.php" class="btn btn-primary">Back</a>
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
