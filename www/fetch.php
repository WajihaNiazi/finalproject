<?php
require_once("../lib/config.php");

if(isset($_POST['search'])){

$output = '';
$name = $_POST['search'];

$sql = "SELECT * FROM room_booking_details WHERE name LIKE '".$_POST["search"]."%'";
$rowssult = mysqli_query($GLOBALS['DB'],  $sql) or die("not executed the search query");
if (mysqli_num_rows($rowssult) > 0) {
	$output .= '<h4 align="center">Search result</h4>';
		$output .= '<div class="table-responsive">
			<table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Zip</th>
                    <th>Country</th>
                    <th>Room_type</th>
                    <th>Check_in_date</th>
                    <th>Check_in_time</th>
                    <th>Check_out_date</th>
                    <th>Occupancy</th>
                </tr>';
		while($rows = mysqli_fetch_assoc($rowssult)){
             $output .= '<tr>
                            <td>'.$rows['id'].'</td>
                            <td>'.$rows['name'].'</td>
                            <td>'.$rows['email'].'</td>
                            <td>'.$rows['phone'].'</td>
                            <td>'.$rows['address'].'</td>
                            <td>'.$rows['city'].'</td>
                            <td>'.$rows['state'].'</td>
                            <td>'.$rows['zip'].'</td>
                            <td>'.$rows['contry'].'</td>
                            <td>'.$rows['room_type'].'</td>
                            <td>'.$rows['check_in_date'].'</td>
                            <td>'.$rows['check_in_time'].'</td>
                            <td>'.$rows['check_out_date'].'</td>
                            <td>'.$rows['Occupancy'].'</td>
                        </tr>';
		}
		echo $output;
}else {
	echo "Data not found";
	}	
}
?>