<?php
    require_once("functions/product.php");
    $search = $_GET["search"];
    $search = search_items($search);
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
            <h2><?php echo $_GET["search"];?></h2>
            <div class="row">
           
                <?php foreach($search as $item):?>
                    <div class="col-3">
                        <div class="card" style="width: 18rem;">
                            <img src="<?php echo $item["thumbnail"] ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $item["name"] ?></h5>
                                <p class="card-text"><?php echo $item["description"] ?></p>
                                <p class="text-danger"><?php echo $item["price"] ?></p>
                                <a href="/detail.php?id=<?php echo $item["id"];?>" class="btn btn-primary">Add to cart</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>    
        
            </div>
        </div>
    
    </main>
</body>
</html>