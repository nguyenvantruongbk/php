<?php 
require_once("database.php");
// function connect(){
//     $host = "127.0.0.1";
//     $user = "root";
//     $pwd = "root";
//     $db = "t2311e_demo";
//     $conn = new mysqli($host,$user,$pwd,$db);
//     if($conn->connect_error)
//         die("Connect refused!");
//     return $conn;
// }

// function query($sql){
//     $conn = connect();
//     return $conn->query($sql);
// }

// function insert_get_id($sql){
//     $conn = connect();
//     if($conn->query($sql) == true){
//         return $conn->insert_id;
//     }
//     return 0;
// }
//
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
function search_items($search){
    
    $sql = "SELECT * FROM products WHERE name LIKE '%$search%'";
    $result = query($sql);
    $list = [];
    while($row = $result->fetch_assoc()){
        $list[] = $row;
    }
    return $list;

}
//   //2. query SQL
//      // 2.1. Lấy tham số
//      $limit = isset($_GET["limit"]) && $_GET["limit"]!= "" ?$_GET["limit"]:20;
//      $search = isset($_GET["search"])?$_GET["search"]:"";
//      //2.2. áp dụng giá trị tham số vào truy vấn
//     $sql = "SELECT * FROM products WHERE name LIKE '%$search%' LIMIT $limit";
//     $result = $conn->query($sql);
//     $list = [];
//     while($row = $result->fetch_assoc()){
//       $list[] = $row;
//     }

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
