<?php
include "db.php";
header("Content-type:text/csv");
header("Content-disposition:attachment;filename=Books.csv");
$output=fopen("php://output","w");
fputcsv($output,array("bid","bname","ISBN","category","price","author"));
$result=$conn->query("select*from books");
while($row=$result->fetch_assoc()){
    fputcsv($output,$row);
}
?>


