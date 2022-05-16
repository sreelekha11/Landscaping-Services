
<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: ls_sh_login.html');
	exit;
}
$DATABASE_HOST = 'localhost:3308';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'landscaping_services';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
$result = mysqli_query($con,"SELECT * FROM payment");

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="UTF-8">
    <title>Payments</title>
    <!-- CSS FOR STYLING THE PAGE -->
    <style>
        table {
            margin: 0 auto;
            font-size: large;
            border: 1px solid black;
        }
  
        h1 {
            text-align: center;
            color: #006600;
            font-size: xx-large;
            font-family: 'Gill Sans', 'Gill Sans MT', 
            ' Calibri', 'Trebuchet MS', 'sans-serif';
        }
  
        td {
            background-color: #E4F5D4;
            border: 1px solid black;
        }
  
        th,
        td {
            font-weight: bold;
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
  
        td {
            font-weight: lighter;
        }
    </style>
</head>
  
<body>
    <section>
        <h1>Payments</h1>
        <!-- TABLE CONSTRUCTION-->
        <table>
            <tr>
                <th>Payment ID</th>
				<th>Employee ID</th>
				<th>Date</th>
				<th>Amount</th>
				<th>Description</th>
            </tr>
            <!-- PHP CODE TO FETCH DATA FROM ROWS-->
            <?php   // LOOP TILL END OF DATA 
                while($rows= mysqli_fetch_array($result))
                {
             ?>
            <tr>
                <!--FETCHING DATA FROM EACH 
                    ROW OF EVERY COLUMN-->
				<td><?php echo $rows['payment_id'];?></td>
				<td><?php echo $rows['employee_id'];?></td>
                <td><?php echo $rows['date'];?></td>
                <td><?php echo $rows['amount'];?></td>
				<td><?php echo $rows['description'];?></td>
            </tr>
            <?php
                }
             ?>
        </table>
    </section>
</body>
  
</html>