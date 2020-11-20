<html>
<?php 
$mysql_host="localhost"; //set up connection to database
$mysql_user="root";
$mysql_password="";
$mysql_db="tpshop";

$con = new mysqli($mysql_host,$mysql_user,$mysql_password,$mysql_db);
if (!$con) {
    echo $con->errno ."<br>";
    die('could not connect: '. $con->error);
}
else {
    echo "Connection to DB server at $mysql_host successful<br>"; //establish connection to DBase
}


 //Submit new item
if(isset($_POST['Submit']) && $_POST['Submit'] === "Submit") { //check user input not empty
    if (!empty($_POST['ITEM_NAME']) && 
        !empty($_POST['STOCK']) &&
        !empty($_POST['UNITPRICE']) && 
        !empty($_POST['COSTPRICE']) && 
        !empty($_POST['SHORT_DESC']) && 
        !empty($_POST['MERCHANT'])) {
        echo "OK: fields are not empty<br>";
    }
    else {
        echo "Error: No fields should be empty<br>";
    }
    
    $itemName=$_POST['ITEM_NAME']; //Variables from insert form
    $stock=$_POST['STOCK'];
    $unitPrice=$_POST['UNITPRICE'];
    $costPrice=$_POST['COSTPRICE'];
    $shortDesc=$_POST['SHORT_DESC'];
    $merchant=$_POST['MERCHANT'];
    $query= $con->prepare("INSERT INTO 'item' ('ITEM_NAME','STOCK','UNITPRICE','COSTPRICE','SHORT_DESC','MERCHANT') VALUES 
    (?,?,?,?,?,?)"); //prepared statement
    $query->bind_param('siddss', $itemName, $stock, $unitPrice, $costPrice, $shortDesc, $merchant);
    
    if ($query->execute()) { //execute query
        echo "Query executed.";
    } else {
        echo "Error executing query";
    }
}


// delete item
if(isset($_GET['Submit']) && $_GET['Submit'] === "Delete") {
    $itemID=$_GET['ITEM_ID'];
    
    $query= $con->prepare("DELETE FROM 'item' where item_id = ?");
    $query->bind_param('i', $itemID); //bind the parameters
    
    if ($query->execute()) { //execute query
        
        echo "Query executed";
    } else {
        echo "Error executing query";
    }
}
?>
<body>
	<b>CRUD</b><br>
	<form action="index.php" method="post">
		<table>
			<tr><td>Item Name:</td><td><input type="text" name="ITEM_NAME"></td></tr>
			<tr><td>Stock:</td><td><input type="text" name="STOCK"></td></tr>
			<tr><td>Unit Price:</td><td><input type="text" name="UNITPRICE"></td></tr>
			<tr><td>Cost Price:</td><td><input type="text" name="COSTPRICE"></td></tr>
			<tr><td>Description:</td><td><input type="text" name="SHORT_DESC"></td></tr>
			<tr><td>Merchant:</td><td><input type="text" name="MERCHANT"></td></tr>
		</table>
		<br>
		<input type="submit" name="Submit" value="Submit">
	</form>

<?php 
// select statement
$query="SELECT ITEM_ID, ITEM_NAME, STOCK, UNITPRICE, COSTPRICE, SHORT_DESC, MERCHANT FROM item";
$pQuery = $con->prepare($query); //Prepared statement
$result=$pQuery->execute(); //execute prepared statement
$result=$pQuery->get_result(); //store the result of the query from the prepared statement
if (!$result) {
    die("SELECT query failed<br>".$con->error);
}
else {
    echo "SELECT query successful<br>";
}
$nrows=$result->num_rows; //store the number of rows from the results
echo "#rows=$nrows<br>";

if ($nrows>0) {
    echo "<table>"; //Draw the table header
    echo "<table align='left' border='1'>";
        echo "<tr>";
            echo "<th>ITEM_ID</th>";
            echo "<th>ITEM_NAME</th>";
            echo "<th>STOCK</th>";
            echo "<th>UNITPRICE</th>";
            echo "<th>COSTPRICE</th>";
            echo "<th>SHORT_DESC</th>";
            echo "<th>MERCHANT</th>";
        echo "</tr>";
        while ($row=$result->fetch_assoc()) {
        echo "<tr>";
            echo "<td>".$row['ITEM_ID']."</td>";
            
            echo "<td>".$row['ITEM_NAME']."</td>";
            
            echo "<td>".$row['STOCK']."</td>";
            
            echo "<td>".$row['UNITPRICE']."</td>";
            
            echo "<td>".$row['COSTPRICE']."</td>";
            
            echo "<td>".$row['SHORT_DESC']."</td>";
            
            echo "<td>".$row['MERCHANT']."</td>";
            
            echo "<td><a href='index.php?Submit=GetUpdate&ITEM_TD=".$row['ITEM_ID']."'>Edit</a></td>";
            
            echo "<td><a href='index.php?Submit=Delete&ITEM_TD=".$row['ITEM_ID']."'>delete</a></td>";
        }
}

?>
</body>
</html>