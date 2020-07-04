<?php
include("config.php");
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Douyu 688</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container-fluid">
        <!-- <div class="row">
            <div class="col-sm-12">
                <img src="images/banner2.jpg" alt="" class="img-fluid" >
            </div>
        </div> -->
        <nav class="navbar navbar-expand-lg navbar-info bg-dark">
                <img src="images/sam.jpg" style="width:60px" class="img-fluid rounded-circle">
                <a href="main.html" class="navbar-brand text-white">&nbsp;ABC Shop</a>         
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                   </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                            <a class="nav-item nav-link text-white active" href="main.html">Home<span class="sr-only">(Current)</span></a>
                            <a class="nav-item nav-link text-white" href="products.php">Product</a>
                            <a class="nav-item nav-link text-white" href="#">FAQ</a>
                            <a class="nav-item nav-link text-white" href="#">Contact</a>
                    </div>
                </div>
                <form class="form-inline" action="products.php" method="post">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" style="margin-top:5%;" name="search">
                    <button class="search" type="submit" style="border:none; color:white; background-color: lightblue; margin-top:5%;">Search</button>
                </form>
        </nav>

        <div class="container-fluid" style="margin-top:10px;">
            <div class="row">
                <div class="col-md-2">
                    <ul class="list-group">
                        <li class="list-group-item active">Brands</li>
                        <li class="list-group-item"><a href="products.php?category=Samsung">Samsung</a></li>
                        <li class="list-group-item"><a href="products.php?category=ASUS">ASUS</a></li>
                        <li class="list-group-item"><a href="products.php?category=Xiaomi">Xiaomi</a></li>
                        <li class="list-group-item"><a href="products.php?category=Oppo">Oppo</a></li>
                        <li class="list-group-item"><a href="products.php?category=Huawei">Huawei</a></li>
                </div>
                <div class="col-md-1">
                        
                </div>
                <div class="col-md-8">
                        <div class="card">
                            <div class="card-title">&nbsp;Products</div>
                                <div class="row">
                                    <?php
                                        $category="";
                                        if(isset($_GET['category'])){
                                            $category=" and category='".$_GET['category']."'";
                                        }
                                        //for pagination
                                        $page = @$_GET['page'];
                                        if($page == 0 || $page == 1){
                                            $page1 = 0;
                                        }
                                        else{
                                            $page1 = ($page * 6) - 6;
                                /*If need to change how the item show in numbers , change this number the number you need*/
                                        }
                                        //end code

                                        //get search keyword
                                        $search="";
                                        if(isset($_REQUEST['search'])){
                                            $search=" and title like '%".$_REQUEST['search']."%'";
                                        }
                                        //end code

                                        $sql="select ID,title,price,image from product_detail where 
                                        available=1".$category.$search." LIMIT ".$page1.",6"; 
                                        //change something that makes the result show the same category
                                /*If need to change how the item show in numbers , change this number the number you need*/
                                
                                        $result=$conn->query($sql);

                                        if($result->num_rows > 0){
                                            while($row = $result->fetch_assoc()){

                                                $ID=$row['ID'];
                                                $title=$row['title'];
                                                $price=$row['price'];
                                                $image=$row['image'];
                                    ?>
                                    <div class="col-sm-4">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <h5 class="class-title"><?php echo $title; ?></h5>
                                                <img src="image/<?php echo $image;?>" alt="" class="img-fluid">
                                                <div class="card-heading">RM <?php echo $price; ?>
                                                    <button style="float:right;" class="btn btn-danger btn-xs">AddToCart</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="card card-footer">
                            <ul class="pagination pagination-md">
                                <?php
                                $result = $conn->query("SELECT * FROM product_detail WHERE available='1'");
                                $count = $result->num_rows;

                                    $a = $count/6; 
                                /*If need to change how the item show in numbers , change this number the number you need*/
                                    $a =ceil($a);

                                ?>
                                <?php for($i = 1 ; $i <= $a ; $i++){?>
                                <li class="page-item"><a class="page-link" href="products.php?page=<?php echo $i;?>"><?php echo $i;?></a></li>
                                <?php } ?>
                            </ul>
                            &copy; 2019</div>

                </div>
                <div class="col-md-1">
                        
                </div>
            </div>
        </div>


</body>
</html>