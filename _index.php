<?php
    // require_once("functions/product.php");
    // $newest_products = newest_products();
    // $best_sellers = best_sellers();
    // $hot_items = hot_items();

    // require_once("functions/product.php");
    function connect(){
        $host = "127.0.0.1";
        $user = "root";
        $pwd = "root";
        $db = "t2311e_demo";
        $conn = new mysqli($host,$user,$pwd,$db);
        if($conn->connect_error)
            die("Connect refused!");
        return $conn;
    }
    
    function query($sql){
        $conn = connect();
        return $conn->query($sql);
    }
    
    function insert_get_id($sql){
        $conn = connect();
        if($conn->query($sql) == true){
            return $conn->insert_id;
        }
        return 0;
    }
/////////////////////////////////////////////

    function newest_products(){
        $sql = "select * from products order by id desc limit 4";
        $result = query($sql);
        $list = [];
        while($row = $result->fetch_assoc()){
            $list[] = $row;
        }
        return $list;
    }
    function best_sellers(){
        $sql = "select * from products order by qty desc limit 4";
        $result = query($sql);
        $list = [];
        while($row = $result->fetch_assoc()){
            $list[] = $row;
        }
        return $list;
    }

    function hot_items(){
        $sql = "select * from products order by price desc limit 4";
        $result = query($sql);
        $list = [];
        while($row = $result->fetch_assoc()){
            $list[] = $row;
        }
        return $list;
    }

    function categories_all(){
        $sql = "select * from categories";
        $result = query($sql);
        $list = [];
        while($row = $result->fetch_assoc()){
            $list[] = $row;
        }
        return $list;
    }

    function category_detail($category_id){
        $sql_cat = "select * from categories where id = $category_id";
        $result = query($sql_cat);
        if($result->num_rows > 0){
            $category = $result->fetch_assoc();
            $sql_product = "select * from products where category_id = $category_id";
            $result = query($sql_product);
            $list = [];
            while($row = $result->fetch_assoc()){
                $list[] = $row;
            }
            $category["products"] = $list;
            return $category;
        }
        return null;
        
    }

    function product_detail($product_id)  {
        $sql = "select * from products where id = $product_id";
        $result = query($sql);
        if($result->num_rows > 0){
            return $result->fetch_assoc();// 1 product
        }
        return null;
    }



    // $newest_products = newest_products();
    // $best_sellers = best_sellers();
    // $hot_items = hot_items();

    $newest_products = newest_products();
    $best_sellers = best_sellers();
    $hot_items = hot_items();
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include_once("html/styles.php");?>
</head>
<body>
    <header>
    </header>
    <?php include_once("html/nav.php");?>
    <main class="main">
        <div class="container">
            <h2>Newest products</h2>
            <div class="row">
                <?php foreach($newest_products as $item):?>
                    <div class="col-3">
                        <div class="card" style="width: 18rem;">
                            <a href="/detail.php?id=<?php echo $item["id"];?>">
                            <img src="<?php echo $item["thumbnail"] ?>" class="card-img-top" alt="...">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $item["name"] ?></h5>
                                <p class="card-text"><?php echo $item["description"] ?></p>
                                <p class="text-danger"><?php echo $item["price"] ?></p>
                                <a href="#" class="btn btn-primary">Add to cart</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>    
            </div>
        </div>
        <div class="container">
            <h2>Best sellers</h2>
            <div class="row">
                <?php foreach($best_sellers as $item):?>
                    <div class="col-3">
                        <div class="card" style="width: 18rem;">
                            <img src="<?php echo $item["thumbnail"] ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $item["name"] ?></h5>
                                <p class="card-text"><?php echo $item["description"] ?></p>
                                <p class="text-danger"><?php echo $item["price"] ?></p>
                                <a href="#" class="btn btn-primary">Add to cart</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>    
            </div>
        </div>
        <div class="container">
            <h2>Hot items</h2>
            <div class="row">
                <?php foreach($hot_items as $item):?>
                    <div class="col-3">
                        <div class="card" style="width: 18rem;">
                            <img src="<?php echo $item["thumbnail"] ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $item["name"] ?></h5>
                                <p class="card-text"><?php echo $item["description"] ?></p>
                                <p class="text-danger"><?php echo $item["price"] ?></p>
                                <a href="#" class="btn btn-primary">Add to cart</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>    
            </div>
        </div>
    </main>
</body>
</html>