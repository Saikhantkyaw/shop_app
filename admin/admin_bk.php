 <?php 


              if (!empty($_GET['pageno'])) {
                $pageno=$_GET['pageno'];
              }else{
                $pageno=1;
              }
              $noOfrec=5;
              $offset=($pageno-1)*$noOfrec;


              if (empty($_POST['search'])&&empty($_COOKIES['search'])) {

                    $statment= $pdo->prepare("SELECT * FROM posts ORDER BY id DESC");
              $statment->execute();
              $rawResult=$statment->FETCHALL();
              $total_pages=ceil(count($rawResult)/$noOfrec);

          $statment= $pdo->prepare("SELECT * FROM posts ORDER BY id DESC LIMIT $offset,$noOfrec");
              $statment->execute();
              $result=$statment->FETCHALL();
              
              }else{

              $searchkey=$_POST['search']?$_POST['search']:$_COOKIES['search'];
  $statment= $pdo->prepare("SELECT * FROM posts WHERE title LIKE '%$searchkey%'  ORDER BY id DESC");
              $statment->execute();
              $rawResult=$statment->FETCHALL();
              $total_pages=ceil(count($rawResult)/$noOfrec);

$statment= $pdo->prepare("SELECT * FROM posts WHERE title LIKE '%$searchkey%' ORDER BY id DESC LIMIT $offset,$noOfrec");

              $statment->execute();
              $result=$statment->FETCHALL();
              }
               

               ?>



                <?php 
                if ($result) 
                {$i=1;
                  foreach ($result as $value) 
                  {?>
                        <tr>
                      <td> <?php echo $i; ?> </td>
                      <td style ="width:400px;"> <?php echo mo($value['title']) ;?> </td>
                    <td style ="width:450px;"> <?php echo substr(mo( $value['content']),0,50) ;?>
                        
                      </td>
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