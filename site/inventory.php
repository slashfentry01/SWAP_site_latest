<!DOCTYPE html>
<?php
$mysql_host="localhost"; // Setup connection to database
$mysql_user="root";
$mysql_password="";
$mysql_db="swapsite";

$con = new mysqli($mysql_host,$mysql_user,$mysql_password,$mysql_db);
if (!$con){
    echo $con->errno ."<br>";
    die('Could not connect: '. $con->error);
}
else {
    echo "Connection to DB server at $mysql_host successful<br>"; //establish the connection to Dbase
}
error_reporting(E_PARSE);

?>
<html lang="en">
<head>
    <style>

        table {
            border: 1px solid black;
        }
    </style>
    <meta charset="UTF-8">
    <h1>Inventory CRUD</h1>
</head>
<form method="post">
    <input type="submit" name="listall" value="List All">
</form>
<br>

<form action="inventory.php" method="post" >
    <br>
    <table>
        <tr>
        <tr><td>Action Type</td>
        <tr><td><input type="radio" id="additem" name="actions" value="additem">Add</td></tr>
        <tr><td><input type="radio" id="updateitem" name="actions" value="updateitem">Update</td></tr>
        <tr><td><input type="radio" id="deleteitem" name="actions" value="deleteitem">Delete</td></tr>
        </tr>
    </table>
    <br>
    <table border="1">
        <tr>
            <td>Item ID:</td>
            <td><input type="text" name="itemid"></td>
        </tr>
        <tr>
            <td>Store Name:</td>
            <td><input type="text" name="storename"></td>
        </tr>
        <tr>
            <td>Product Name:</td>
            <td><input type="text" name="productname"></td>
        </tr>
        <tr>
            <td>Product Quantity:</td>
            <td><input type="text" name="productquantity"></td>
        </tr>
        <tr>
            <td>Description:</td>
            <td><input type="text" name="productdesc"></td>
        </tr>
        <tr>
            <td>URL:</td>
            <td><input type="text" name="producturl"></td>
        </tr>
        <tr>
            <td>Contact:</td>
            <td><input type="text" name="sellercnum"    ></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="Submit" value="Action"></td>
        </tr>

    </table>
</form>
<?php
if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['listall']))
{
    $query="SELECT ITEM_ID, STORE_NAME, PRODUCT_NAME, PRODUCT_QUANTITY, PRODUCT_DESC, PRODUCT_URL, SELLER_CONTACT FROM inventory"; //sql query
    $pQuery = $con->prepare($query); //Prepared statement
    $result=$pQuery->execute(); //execute the prepared statement
    $result=$pQuery->get_result(); //store the result of the query from prepared statement

    $nrows=$result->num_rows; //store the number of rows from the results


    if ($nrows>0) {
        echo "<br>";
        echo "<br>";
        echo "<table>"; //Draw the table header
        echo "<table align='left' border='1'>";  //Draw the table header
        echo "<tr>";
        echo "<th>ITEM_ID</th>";
        echo "<th>STORE_NAME</th>";
        echo "<th>PRODUCT_NAME</th>";
        echo "<th>PRODUCT_QUANTITY</th>";
        echo "<th>PRODUCT_DESC</th>";
        echo "<th>PRODUCT_URL</th>";
        echo "<th>SELLER_CONTACT</th>";

        echo "</tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>";
            echo $row['ITEM_ID'];
            echo "</td>";
            echo "<td>";
            echo $row['STORE_NAME'];
            echo "</td>";
            echo "<td>";
            echo $row['PRODUCT_NAME'];
            echo "</td>";
            echo "<td>";
            echo $row['PRODUCT_QUANTITY'];
            echo "</td>";
            echo "<td>";
            echo $row['PRODUCT_DESC'];
            echo "</td>";
            echo "<td>";
            echo $row['PRODUCT_URL'];
            echo "</td>";
            echo "<td>";
            echo $row['SELLER_CONTACT'];

        }}echo "</table>";}

?>
<?php

if($_SERVER['REQUEST_METHOD'] == "POST" and ($_POST['actions'] == 'additem'))
{$itemid = mysqli_real_escape_string($con,$_POST["itemid"]);
if (!empty(($itemid) && preg_match("/^[0-9]{0,64}$/",$itemid) == 1)){ //unset if invalid, continue if valid
    echo " ID Ok!";
    echo "</br>";}
else {
    unset($itemid);
    echo "Invalid ID! Null returned for id.";
    echo "</br>";
}
    $storename = mysqli_real_escape_string($con,$_POST["storename"]);
if (!empty(($storename) && preg_match("/^([A-Za-z ]{1,64})$/",$storename) == 1)){  //unset if invalid, continue if valid
    echo "store name Ok!";
    echo "</br>";
}
else{
    unset($storename);
    echo "Invalid Name! Null returned for store name.";
    echo "</br>";
}

    $productname = mysqli_real_escape_string($con,$_POST["productname"]);
    if (!empty(($productname) && preg_match("/^([A-Za-z ]{1,64})$/",$productname) == 1)){  //unset if invalid, continue if valid
        echo "product name Ok!";
        echo "</br>";
    }
    else{
        unset($productname);
        echo "Invalid Name! Null returned for product name.";
        echo "</br>";
    }
    $productquantity = mysqli_real_escape_string($con,$_POST["productquantity"]);  //unset if invalid, continue if valid
    $matches = array();
    if ((!empty($productquantity)  && preg_match("/^[0-9]{0,64}$/",$productquantity) == 1)){
    echo "</br>";
        echo "Quantity Ok!";
        echo "</br>";


    }
    else {

        unset($productquantity);
        echo "Invalid Quantity! Null Returned for Quantity.";
        echo "</br>";
    }
    $productdesc = mysqli_real_escape_string($con,$_POST["productdesc"]);
    if (!empty(($productdesc) && preg_match("/^([A-Za-z ]{1,64})$/",$productdesc) == 1)){  //unset if invalid, continue if valid
        echo "product description Ok!";
        echo "</br>";
    }
    else{
        unset($productdesc);
        echo "Invalid description! Null returned for product description.";
        echo "</br>";
    }
    $producturl = mysqli_real_escape_string($con,$_POST["producturl"]);
    if (!empty(($producturl) && preg_match("%^((https?://)|(www\.))([a-z0-9-].?)+(:[0-9]+)?(/.*)?$%i",$producturl) == 1)){  //unset if invalid, continue if valid
        echo "product url Ok!";
        echo "</br>";
    }
    else{
        unset($producturl);
        echo "Invalid url! Null returned for product url. Try starting with www.";
        echo "</br>";
    }

    $sellercontact = mysqli_real_escape_string($con,$_POST["sellercnum"]);
    if (!empty(($sellercontact) && preg_match("/^[0-9]{8}$/",$sellercontact) == 1)){  //unset if invalid, continue if valid
        echo "Contact Number Ok!";
        echo "</br>";
    }
    else {
        unset($sellercontact);
        echo "Invalid Contact Number! Null returned for contact number.";
        echo "</br>";
    }
if (!empty($itemid) &&
    !empty($storename) &&
    !empty($productname) &&
    !empty($productquantity) &&
    !empty($productdesc) &&
    !empty($producturl) &&
    !empty($sellercontact)){

    $query= $con->prepare("INSERT INTO `inventory` (`ITEM_ID`,`STORE_NAME`, `PRODUCT_NAME`,`PRODUCT_QUANTITY`, `PRODUCT_DESC`, `PRODUCT_URL`, `SELLER_CONTACT`) VALUES
    (?,?,?,?,?,?,?)"); //prepared statement
    $query->bind_param('ississi', $itemid,$storename, $productname, $productquantity, $productdesc, $producturl, $sellercontact); //bind the parameters, front portion specifies the data type.
    if ($query->execute()){  //execute query
        echo "Query executed."; //update the row successfully
    }else{
        echo "Error executing query.";
    }
}}
elseif ($_SERVER['REQUEST_METHOD'] == "POST" and ($_POST['actions'] == 'updateitem'))
{$itemid = mysqli_real_escape_string($con,$_POST["itemid"]);
if (!empty(($itemid) && preg_match("/^[0-9]{0,64}$/",$itemid) == 1)){ //unset if invalid, continue if valid
    echo " ID Ok!";
    echo "</br>";}
else {
    unset($itemid);
    echo "Invalid ID! Null returned for id.";
    echo "</br>";
}
$storename = mysqli_real_escape_string($con,$_POST["storename"]);
if (!empty(($storename) && preg_match("/^([A-Za-z ]{1,64})$/",$storename) == 1)){  //unset if invalid, continue if valid
    echo "store name Ok!";
    echo "</br>";
}
else{
    unset($storename);
    echo "Invalid Name! Null returned for store name.";
    echo "</br>";
}

$productname = mysqli_real_escape_string($con,$_POST["productname"]);
if (!empty(($productname) && preg_match("/^([A-Za-z ]{1,64})$/",$productname) == 1)){  //unset if invalid, continue if valid
    echo "product name Ok!";
    echo "</br>";
}
else{
    unset($productname);
    echo "Invalid Name! Null returned for product name.";
    echo "</br>";
}
$productquantity = mysqli_real_escape_string($con,$_POST["productquantity"]);  //unset if invalid, continue if valid
$matches = array();
if ((!empty($productquantity)  && preg_match("/^[0-9]{0,64}$/",$productquantity) == 1)){
    echo "</br>";
    echo "Quantity Ok!";
    echo "</br>";


}
else {

    unset($productquantity);
    echo "Invalid Quantity! Null Returned for Quantity.";
    echo "</br>";
}
$productdesc = mysqli_real_escape_string($con,$_POST["productdesc"]);
if (!empty(($productdesc) && preg_match("/^([A-Za-z ]{1,64})$/",$productdesc) == 1)){  //unset if invalid, continue if valid
    echo "product description Ok!";
    echo "</br>";
}
else{
    unset($productdesc);
    echo "Invalid description! Null returned for product description.";
    echo "</br>";
}
$producturl = mysqli_real_escape_string($con,$_POST["producturl"]);
if (!empty(($producturl) && preg_match("%^((https?://)|(www\.))([a-z0-9-].?)+(:[0-9]+)?(/.*)?$%i",$producturl) == 1)){  //unset if invalid, continue if valid
    echo "product url Ok!";
    echo "</br>";
}
else{
    unset($producturl);
    echo "Invalid url! Null returned for product url. Try starting with www.";
    echo "</br>";
}

$sellercontact = mysqli_real_escape_string($con,$_POST["sellercnum"]);
if (!empty(($sellercontact) && preg_match("/^[0-9]{8}$/",$sellercontact) == 1)){  //unset if invalid, continue if valid
    echo "Contact Number Ok!";
    echo "</br>";
}
else {
    unset($sellercontact);
    echo "Invalid Contact Number! Null returned for contact number.";
    echo "</br>";
}
if (!empty($itemid) &&
    !empty($storename) &&
    !empty($productname) &&
    !empty($productquantity) &&
    !empty($productdesc) &&
    !empty($producturl) &&
    !empty($sellercontact)){


    $query= $con->prepare("UPDATE inventory set STORE_NAME=?, PRODUCT_NAME=?, PRODUCT_QUANTITY=?, PRODUCT_DESC=?, PRODUCT_URL=?, SELLER_CONTACT=? WHERE ITEM_ID=? ");
    $query->bind_param('ssissii',$storename, $productname, $productquantity, $productdesc, $producturl, $sellercontact, $itemid); //bind the parameters
    if ($query->execute()){  //execute query
        echo "Query executed."; //update the row successfully

    }else{
        echo "Error executing query.";
    }
    $productid=$_POST['productid']; //grab the item ID from previous page
    $query="SELECT ITEM_ID, STORE_NAME, PRODUCT_NAME, PRODUCT_QUANTITY, PRODUCT_DESC, PRODUCT_URL, SELLER_CONTACT FROM inventory wHERE ITEM_ID=?"; //to display and select
    $pQuery = $con->prepare($query);
    $pQuery->bind_param('i', $itemid); //bind the parameters

    $result=$pQuery->execute(); //execute the query
    $result=$pQuery->get_result(); //Returns a resultset for successful SELECT queries,

    $nrows=$result->num_rows; //count the number rows from the result
    }



}
elseif($_SERVER['REQUEST_METHOD'] == "POST" and ($_POST['actions']=='deleteitem')){
$itemid = mysqli_real_escape_string($con,$_POST["itemid"]);
    if (!empty(($itemid) && preg_match("/^[0-9]{0,64}$/",$itemid) == 1)){ //unset if invalid, continue if valid
        echo " ID Ok!";
        echo "</br>";}
    else {
        unset($itemid);
        echo "Invalid ID! Null returned for id.";
        echo "</br>";
    }
if (!empty($itemid)){
    $query= $con->prepare("Delete from inventory where ITEM_ID = ?");
    $query->bind_param('i', $itemid); //bind the parameters
    if ($query->execute()){  //execute query
        echo "Query executed."; //update the row successfully

    }else{
        echo "Error executing query.";
    }

    $query="SELECT ITEM_ID, STORE_NAME, PRODUCT_NAME, PRODUCT_QUANTITY, PRODUCT_DESC, PRODUCT_URL, SELLER_CONTACT FROM inventory wHERE ITEM_ID=?"; //to display and select
    $pQuery = $con->prepare($query);
    $pQuery->bind_param('i', $itemid); //bind the parameters

    $result=$pQuery->execute(); //execute the query
    $result=$pQuery->get_result(); //Returns a resultset for successful SELECT queries,
}}

?>
<body>

</body>
</html>