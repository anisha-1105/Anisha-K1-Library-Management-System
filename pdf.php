<?php
include "db.php";
require "vendor/autoload.php";
$result=$conn->query ("select*from books");
$pdf=new TCPDF();
$pdf->AddPage();
$pdf->setFont("times","I","12");
$html='<table border="1" style="background-color:yellow;">
    <tr>
    <td>Book ID</td>
    <td>Book Title</td>
    <td>ISBN Number</td>
    <td>category</td>
    <td>Price</td>
    <td>Author</td>
       
    </tr>';
while($row=$result->fetch_assoc()){
    $html.='<tr>
    <td>'.$row ["bid"].'</td>
    <td>'.$row ["bname"].'</td>
    <td>'.$row ["ISBN"].'</td>
    <td>'.$row ["Category"].'</td>
    <td>'.$row ["price"].'</td>
    <td>'.$row ["author"].'</td>
    </tr>';

}
$html.='</table>';
$pdf->writehtml($html,true,false,true,false,'');
$pdf->Output("Books.pdf");
?>
