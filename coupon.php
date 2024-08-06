<?php

session_start();
include('db.php');
include('admin_header.php');

if(!$_SESSION['users'])
{
    header("location:login.php");
}


$get="select *from coupon";
$b=mysqli_query($abc,$get);

if(isset($_REQUEST['get']))

{
    $name=$_REQUEST['name'];
    $rate=$_REQUEST['rate'];


  $sql="insert into coupon (name,rate) values ('$name','$rate')";
  mysqli_query($abc,$sql);
  echo "data Success";  
  header("location:coupon.php");
}

if(isset($_REQUEST['del']))
{
  $id=$_REQUEST['del'];
  $delt="delete from coupon where coupon_id='$id' ";
  mysqli_query($abc,$delt);
  header("location:coupon.php");

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   
<div class="main_box">
<form action="" class="form" method="post">

<div class="cate">Add Coupon Form</div>


    <div class="type">

     <div class="file">   
    <div class="done">Name</div>
    <div><input type="text" class="text" name="name"></div>
    </div>
    
    <div class="file">
    <div class="done">Rate</div>
    <div class="file1"><input type="text" class="text" name="rate"></div>
    </div>
    </div>

    <div class="sub"><input type="submit" class="but" name="get"></div>

</form>

<div class="view">Coupon Data View</div>

<table border="1" align="center" id="example">
    <thead>
    <tr>
        <th>No</th>
        <th>Name</th>
        <th>Rate</th>
        <th>Action</th>
    </tr>
    </thead>

<tbody>
    <?php
    $no=1;
     while($d=mysqli_fetch_array($b))
     {
      ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php  echo $d['name'];?></td>
            <td><?php  echo $d['rate'];?></td>
            <td>
                  <a href="coupon.php?del=<?php echo $d['coupon_id']; ?>" onclick="return confirm('are you sure this record delete?')"><i class="fa-solid fa-trash"></i></a> 
                  <i class="fa-solid fa-arrows-left-right"></i>
                  <a href="coupon_edit.php?edit=<?php echo $d['coupon_id']; ?>"><i class="fa-solid fa-pencil"></i></a>
            </td>
        </tr>
      <?php
     }
    ?>
    </tbody>
</table>

</div>

    </div>  
<script>new DataTable('#example');</script>
</body>
</html>