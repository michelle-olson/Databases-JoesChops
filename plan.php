<!DOCTYPE html>
<html lang="en">

<head>
    <link href="style2.css" rel="stylesheet">
    <meta charset="utf-8">

    <link rel="stylesheet" href="paper.css">
    <link rel="stylesheet" href="normalize.css">

    <style>@page {
        size: A4 portrait;
        margin-top: 8px;
        margin-bottom: 10px;
        margin-left: 20px;
    }</style>
	<style>
        .column {
            float: left;
            padding: 5px;
        }
		.row::after {
            content: "";
            clear: both;
            display: table;
        }
		table tbody tr td {
            padding: 2px !important;
            line-height: 1.35 !important;
        }
		@media print {
            .box-body {
                margin-top: 10px !important;
                margin-bottom: 10px;
            }
        }
    </style>
    <style>
        .center-me {
            font-size: 15px;
            margin: auto;
            height: 10px;
            max-width: 500px;
            margin: 75px auto 40px auto;
            display: flex;
        }
    </style>
</head>
<body class="A4 portrait">
<section class="sheet" id="content-print">

    <div class="box-body" id="box_data" style="display: flex;padding: 5px 10px 0 10px;margin-bottom: -21px;">
        <div style="width: 100%;padding-right: 10px;" class="col-md-12">
            <div class="row">
                <div class="col-lg-4" style="width: 70%;padding-left: 20px;">
                    <h4>Customization Plan</h4>
                </div>
                <div class="col-lg-8" style="width: 30%;">
                    <h5 style="font-size: 36px;margin-bottom: 15px;margin-top: 45px;">Joe's Chop</h5>

                    <p style="font-size: 12px;margin: 0;padding: 0;">6 Ridgeview Street</p>

                    <p style="font-size: 12px;margin: 0;padding-top: 3px;;">Seattle,WA, 98144</p>

                    <p style="font-size: 12px;margin: 0;padding-top: 5px;;">Phone: (123) 456-7890</p>
                    <br>
                </div>
            </div>
            <div class="" style="display: flex;margin-top: -62px;">

            </div>
            <br></br>
			<br>

			<!-- Customer information table -->
            <table width="100%" border="1">
                <tr style="background: rgba(255,255,224,1.0)">
                    <th class="text-center" colspan="2" style="width: 25%;">Customer Information</th>
                </tr>
                <tr>
                    <th style="width: 25%;font-size: 12px;background: rgba(255,255,255,1.0)">Customer Name</th>
                    <th><?php
                    $cust_quest = filter_input(INPUT_POST, 'cust_quest');
                    $host = "localhost";
                    $dbusername = "root";
                    $dbpassword = "";
                    $dbname = "joe's chops";
                    $conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);
                    if (!$conn)
                    {
                      die("Connection Failed:" . mysqli_connect_error());
                    }
					          $useremail=$_GET['Username'];
                    //echo " connected to db";
                    $sql_query = "SELECT cust_fname, cust_lname FROM customers WHERE cust_email='$useremail'";
                    $result = $conn-> query($sql_query);
                    $row = $result -> fetch_assoc();
                    echo $row["cust_fname"] ." ". $row["cust_lname"];
                    //$conn->close();?></th>
                </tr>
                <tr>
                    <th style="width: 5%;font-size: 12px;background: rgba(255,255,255,1.0)">Address</th>
                    <th><?php
					$useremail=$_GET['Username'];
                    $sql_query = "SELECT cust_address FROM customers WHERE cust_email='$useremail'";
                    $result = $conn-> query($sql_query);
                    $row = $result -> fetch_assoc();
                    echo $row["cust_address"];
					//$conn->close();
					?></th>
                </tr>
                <tr>
                    <th style="width: 5%;font-size: 12px;background: rgba(255,255,255,1.0)">Phone</th>
                    <th><?php
					$useremail=$_GET['Username'];
                    $sql_query = "SELECT cust_phone FROM customers WHERE cust_email='$useremail'";
                    $result = $conn-> query($sql_query);
                    $row = $result -> fetch_assoc();
                    echo $row["cust_phone"];
					//$conn->close();
					?></th>
                </tr>
                <tr>
                    <th style="width: 5%;font-size: 12px;background: rgba(255,255,255,1.0)">Email</th>
                    <th>
					<?php echo $_GET['Username'];; ?></th>
                </tr>
            </table>
            <br>

			<!-- Employee information table-->
			<table width="100%" border="1">
                <tr style="background: rgba(255,255,224,1.0)">
                    <th class="text-center" colspan="2" style="width: 25%;">Employee Information</th>
                </tr>
                <tr>
                    <th style="width: 25%;font-size: 12px;background: rgba(255,255,255,1.0)">Employee Name</th>
                    <th><?php
							$useremail=$_GET['Username'];
							$sql_query = "SELECT VIN FROM vehicles INNER JOIN customers ON vehicles.Customer_ID = customers.Customer_ID
    								WHERE customers.cust_email='$useremail'";
							$result = $conn-> query($sql_query);
							$row = $result -> fetch_assoc();
							$VIN = $row['VIN'];
							$sql_query2 = "SELECT Case_ID FROM `Customization Project` WHERE VIN = '$VIN'";
							$result2 = $conn-> query($sql_query2);
							$row2 = $result2 -> fetch_assoc();
							$case_id = $row2['Case_ID'];
							$sql_query3 = "SELECT Emp_ID FROM `employee task` WHERE `Case_ID` LIKE '$case_id'";
							$result3 = $conn-> query($sql_query3);
							$row3 = $result3 -> fetch_assoc();
							$emp_id = $row3['Emp_ID'];
							$sql_query4 = "SELECT emp_name FROM  `employees` WHERE `Emp_ID` LIKE '$emp_id'";
							$result4 = $conn-> query($sql_query4);
							$row4 = $result4 -> fetch_assoc();
							echo $row4["emp_name"];

					?></th>
                </tr>
                <tr>
                    <th style="width: 25%;font-size: 12px;background: rgba(255,255,255,1.0)">Email</th>
                    <th><?php
							$useremail=$_GET['Username'];
							$sql_query = "SELECT VIN FROM vehicles INNER JOIN customers ON vehicles.Customer_ID = customers.Customer_ID
    								WHERE customers.cust_email='$useremail'";
							$result = $conn-> query($sql_query);
							$row = $result -> fetch_assoc();
							$VIN = $row['VIN'];
							$sql_query2 = "SELECT Case_ID FROM `Customization Project` WHERE VIN = '$VIN'";
							$result2 = $conn-> query($sql_query2);
							$row2 = $result2 -> fetch_assoc();
							$case_id = $row2['Case_ID'];
							$sql_query3 = "SELECT Emp_ID FROM `employee task` WHERE `Case_ID` LIKE '$case_id'";
							$result3 = $conn-> query($sql_query3);
							$row3 = $result3 -> fetch_assoc();
							$emp_id = $row3['Emp_ID'];
							$sql_query4 = "SELECT emp_email FROM  `employees` WHERE `Emp_ID` LIKE '$emp_id'";
							$result4 = $conn-> query($sql_query4);
							$row4 = $result4 -> fetch_assoc();
							echo $row4["emp_email"];

					?></th>
                </tr>
            </table>
            <br>

			<!-- Vehicle information + all the components of the vehicle -->
			<table width= "100%" border="1">
				<tr style="background: rgba(255,255,224,1.0)">
                    <th class="text-center" colspan="2" style="width: 25%;">Vehicle</th>
                </tr>
			</table>
			<table width="100%" border="1px">
                <tr style="background: rgba(255,255,255,1.0);">
					<th class="text-center">
                        Make
                    </th>
                    <th class="text-center" colspan="3">
                        Model
                    </th>
                    <th class="text-center">
                        Year
                    </th>
                    <th class="text-center">
                        Engine
                    </th>
					<th class="text-center">
                        Interior
                    </th>
					<th class="text-center">
                        Exterior
                    </th>
                </tr>
				<tbody>
					<!-- this is an example but the table should fill up from the database -->
					<tr><td><!-- Make --><?php
					$useremail=$_GET['Username'];;
                    $sql_query = "SELECT make FROM vehicles INNER JOIN customers ON vehicles.Customer_ID = customers.Customer_ID
								WHERE customers.cust_email='$useremail'";
                    $result = $conn-> query($sql_query);
                    $row = $result -> fetch_assoc();
                    echo $row["make"];

					?>
					</td><td colspan="3"><?php
					$useremail=$_GET['Username'];;
                    $sql_query = "SELECT model FROM vehicles INNER JOIN customers ON vehicles.Customer_ID = customers.Customer_ID
								WHERE customers.cust_email='$useremail'";
                    $result = $conn-> query($sql_query);
                    $row = $result -> fetch_assoc();
                    echo $row["model"];

					?></td><td><?php
					$useremail=$_GET['Username'];;
                    $sql_query = "SELECT year FROM vehicles INNER JOIN customers ON vehicles.Customer_ID = customers.Customer_ID
								WHERE customers.cust_email='$useremail'";
                    $result = $conn-> query($sql_query);
                    $row = $result -> fetch_assoc();
                    echo $row["year"];

					?></td><td><?php
					$useremail=$_GET['Username'];;
                    $sql_query = "SELECT engine FROM vehicles INNER JOIN customers ON vehicles.Customer_ID = customers.Customer_ID
								WHERE customers.cust_email='$useremail'";
                    $result = $conn-> query($sql_query);
                    $row = $result -> fetch_assoc();
                    echo $row["engine"];

					?></td><td><?php
					$useremail=$_GET['Username'];;
                    $sql_query = "SELECT interior FROM vehicles INNER JOIN customers ON vehicles.Customer_ID = customers.Customer_ID
								WHERE customers.cust_email='$useremail'";
                    $result = $conn-> query($sql_query);
                    $row = $result -> fetch_assoc();
                    echo $row["interior"];

					?></td><td><?php
					$useremail=$_GET['Username'];;
                    $sql_query = "SELECT exterior FROM vehicles INNER JOIN customers ON vehicles.Customer_ID = customers.Customer_ID
								WHERE customers.cust_email='$useremail'";
                    $result = $conn-> query($sql_query);
                    $row = $result -> fetch_assoc();
                    echo $row["exterior"];


					?></td></tr>
                </tbody>
            </table>
			<br>

			<!-- Basic Customization Plan table-->
			<table width= "100%" border="1">
				<tr style="background: rgba(255,255,224,1.0)">
                    <th class="text-center" colspan="2" style="width: 25%;">Basic Customization Plan</th>
                </tr>
			</table>
			<table width="100%" border="1px">
                <tr style="background: rgba(255,255,255,1.0);">

                    <th class="text-center">
                        Parts
                    </th>
					<th class="text-center">
                        Quantity
                    </th>
                    <th class="text-center">
                        Labor Description
                    </th>
					<th class="text-center">
                        Employee
                    </th>
                </tr>
					<body>
						<tr>
						<td><?php
							$useremail=$_GET['Username'];
							$sql_query = "SELECT VIN FROM vehicles INNER JOIN customers ON vehicles.Customer_ID = customers.Customer_ID
    								WHERE customers.cust_email='$useremail'";
							$result = $conn-> query($sql_query);
							$row = $result -> fetch_assoc();
							$VIN = $row['VIN'];
							$sql_query2 = "SELECT Case_ID FROM `Customization Project` WHERE VIN = '$VIN'";
							$result2 = $conn-> query($sql_query2);
							$row2 = $result2 -> fetch_assoc();
							$case_id = $row2['Case_ID'];
							$sql_query3 = "SELECT * FROM `part choice` WHERE `Case_ID` LIKE '$case_id'";
							$result3 = $conn-> query($sql_query3);
							$row3 = $result3 -> fetch_assoc();
							echo $row3["Part_ID"];



					?></td>
						<td><?php
							$useremail=$_GET['Username'];
							$sql_query = "SELECT VIN FROM vehicles INNER JOIN customers ON vehicles.Customer_ID = customers.Customer_ID
    								WHERE customers.cust_email='$useremail'";
							$result = $conn-> query($sql_query);
							$row = $result -> fetch_assoc();
							$VIN = $row['VIN'];
							$sql_query2 = "SELECT Case_ID FROM `Customization Project` WHERE VIN = '$VIN'";
							$result2 = $conn-> query($sql_query2);
							$row2 = $result2 -> fetch_assoc();
							$case_id = $row2['Case_ID'];
							$sql_query3 = "SELECT Part_ID FROM `part choice` WHERE `Case_ID` LIKE '$case_id'";
							$result3 = $conn-> query($sql_query3);
							$row3 = $result3 -> fetch_assoc();
							$part_id = $row3['Part_ID'];
							$sql_query4 = "SELECT part_quantity FROM  `parts` WHERE `Part_ID` LIKE '$part_id'";
							$result4 = $conn-> query($sql_query4);
							$row4 = $result4 -> fetch_assoc();
							echo $row4["part_quantity"];



					?></td>
						<td><?php
							$useremail=$_GET['Username'];
							$sql_query = "SELECT VIN FROM vehicles INNER JOIN customers ON vehicles.Customer_ID = customers.Customer_ID
    								WHERE customers.cust_email='$useremail'";
							$result = $conn-> query($sql_query);
							$row = $result -> fetch_assoc();
							$VIN = $row['VIN'];
							$sql_query2 = "SELECT Case_ID FROM `Customization Project` WHERE VIN = '$VIN'";
							$result2 = $conn-> query($sql_query2);
							$row2 = $result2 -> fetch_assoc();
							$case_id = $row2['Case_ID'];
							$sql_query3 = "SELECT Part_ID FROM `part choice` WHERE `Case_ID` LIKE '$case_id'";
							$result3 = $conn-> query($sql_query3);
							$row3 = $result3 -> fetch_assoc();
							$part_id = $row3['Part_ID'];
							$sql_query4 = "SELECT labor_desc FROM  `labor` WHERE `Part_ID` LIKE '$part_id'";
							$result4 = $conn-> query($sql_query4);
							$row4 = $result4 -> fetch_assoc();
							echo $row4["labor_desc"];



					?></td>
						<td><?php
							$useremail=$_GET['Username'];
							$sql_query = "SELECT VIN FROM vehicles INNER JOIN customers ON vehicles.Customer_ID = customers.Customer_ID
    								WHERE customers.cust_email='$useremail'";
							$result = $conn-> query($sql_query);
							$row = $result -> fetch_assoc();
							$VIN = $row['VIN'];
							$sql_query2 = "SELECT Case_ID FROM `Customization Project` WHERE VIN = '$VIN'";
							$result2 = $conn-> query($sql_query2);
							$row2 = $result2 -> fetch_assoc();
							$case_id = $row2['Case_ID'];
							$sql_query3 = "SELECT Emp_ID FROM `employee task` WHERE `Case_ID` LIKE '$case_id'";
							$result3 = $conn-> query($sql_query3);
							$row3 = $result3 -> fetch_assoc();
							$emp_id = $row3['Emp_ID'];
							$sql_query4 = "SELECT emp_name FROM  `employees` WHERE `Emp_ID` LIKE '$emp_id'";
							$result4 = $conn-> query($sql_query4);
							$row4 = $result4 -> fetch_assoc();
							echo $row4["emp_name"];

					?></td>
						</tr>
					</body>
            </table>
			<br>

			<!-- Payment info at the end of the page -->
			<table width="100%" border="1">
                <tr>
                    <th style="width: 25%;font-size: 12px;background: rgba(255,255,255,1.0)">Estimated price</th>
                    <th><?php
							$useremail=$_GET['Username'];
							$sql_query = "SELECT VIN FROM vehicles INNER JOIN customers ON vehicles.Customer_ID = customers.Customer_ID
    								WHERE customers.cust_email='$useremail'";
							$result = $conn-> query($sql_query);
							$row = $result -> fetch_assoc();
							$VIN = $row['VIN'];
							$sql_query2 = "SELECT est_price FROM `Customization Project` WHERE VIN = '$VIN'";
							$result2 = $conn-> query($sql_query2);
							$row2 = $result2 -> fetch_assoc();
							echo $row2["est_price"];

					?></th>
                </tr>
                <tr>
                    <th style="width: 5%;font-size: 12px;background: rgba(255,255,255,1.0)">Deposit</th>
                    <th><?php
							$useremail=$_GET['Username'];
							$sql_query = "SELECT VIN FROM vehicles INNER JOIN customers ON vehicles.Customer_ID = customers.Customer_ID
    								WHERE customers.cust_email='$useremail'";
							$result = $conn-> query($sql_query);
							$row = $result -> fetch_assoc();
							$VIN = $row['VIN'];
							$sql_query2 = "SELECT deposit FROM `Customization Project` WHERE VIN = '$VIN'";
							$result2 = $conn-> query($sql_query2);
							$row2 = $result2 -> fetch_assoc();
							echo $row2["deposit"];

					?></th>
                </tr>
                <tr>
                    <th style="width: 5%;font-size: 12px;background: rgba(255,255,255,1.0)">Start Date</th>
                    <th><?php
							$useremail=$_GET['Username'];
							$sql_query = "SELECT VIN FROM vehicles INNER JOIN customers ON vehicles.Customer_ID = customers.Customer_ID
    								WHERE customers.cust_email='$useremail'";
							$result = $conn-> query($sql_query);
							$row = $result -> fetch_assoc();
							$VIN = $row['VIN'];
							$sql_query2 = "SELECT start_date FROM `Customization Project` WHERE VIN = '$VIN'";
							$result2 = $conn-> query($sql_query2);
							$row2 = $result2 -> fetch_assoc();
							echo $row2["start_date"];

					?></th>
                </tr>
                <tr>
                    <th style="width: 5%;font-size: 12px;background: rgba(255,255,255,1.0)">
						Estimated Delivery Date</th>
                    <th><?php
							$useremail=$_GET['Username'];
							$sql_query = "SELECT VIN FROM vehicles INNER JOIN customers ON vehicles.Customer_ID = customers.Customer_ID
    								WHERE customers.cust_email='$useremail'";
							$result = $conn-> query($sql_query);
							$row = $result -> fetch_assoc();
							$VIN = $row['VIN'];
							$sql_query2 = "SELECT est_date FROM `Customization Project` WHERE VIN = '$VIN'";
							$result2 = $conn-> query($sql_query2);
							$row2 = $result2 -> fetch_assoc();
							echo $row2["est_date"];

							$conn->close();

					?></th>
                </tr>

            </table>
            <br>

			<!-- Link to the plan webpage -->
			<?php
				$useremail=$_GET['Username'];
				$url = "bill.php?Username=" .$useremail;
				echo "<a href='$url'>Go to bill page</a>";
			?>

			<br>
			<?php
				$useremail=$_GET['Username'];
				$url = "quest.php?Username=" .$useremail;
				echo "<a href='$url'>Go to questionnaire page</a>";
			?>
			<br></br>
			<br>

			<!-- Bottom of the page -->
			<table width="94%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="19%" rowspan="3" valign="top"><strong class="asd"> &nbsp;<br></strong></td>
                    <td width="65%" align="center" valign="top">
                        <h6>Questions? contact us at (123) 456-7890 - Joe's Chop - joeschop@joeschop.com.</h6></td>

                </tr>

            </table>

			</div>

    </div>

</section>
</body>
</html>
