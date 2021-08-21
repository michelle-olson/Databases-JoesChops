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
                    <h4>BILLING</h4>
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
            <table border="1" style="width:10%">
                <tr class="" style="background: rgba(255,255,224,1.0)">
                    <td style="font-size: 14px;"  class="db text-center" width="100px">
                        BILL NO
                    </td>
                    
                </tr>
                <tr>
                    <td style="font-size: 12px;" class="text-center">
						<?php
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
						$sql_query = "SELECT Bill_num FROM `bill` INNER JOIN `customers` ON bill.Customer_ID = customers.Customer_ID
									WHERE cust_email='$useremail'";
						$result = $conn-> query($sql_query);
						$row = $result -> fetch_assoc();
						echo $row["Bill_num"];
						
						?>						
					</td>
                    
                </tr>
            </table>
            </div>
            <br>

			<!-- Bill to table -->
            <table width="100%" border="1">
                <tr style="background: rgba(255,255,224,1.0)">
                    <th class="text-center" colspan="2" style="width: 25%;">Bill To</th>
                </tr>
                <tr>
                    <th style="width: 25%;font-size: 12px;background: rgba(255,255,255,1.0)">Customer</th>
                    <th><?php                                      					
					
					$useremail=$_GET['Username'];
                    $sql_query = "SELECT cust_fname, cust_lname FROM customers WHERE cust_email='$useremail'";
                    $result = $conn-> query($sql_query);
                    $row = $result -> fetch_assoc();
                    echo $row["cust_fname"] ." ". $row["cust_lname"];
                  //  $conn->close();?></th>
                </tr>
                <tr>
                    <th style="width: 5%;font-size: 12px;background: rgba(255,255,255,1.0)">Delivery address</th>
                    <th>
                      <?php
                        $useremail=$_GET['Username'];                   
						$sql_query = "SELECT cust_address FROM customers WHERE cust_email='$useremail'";
						$result = $conn-> query($sql_query);
						$row = $result -> fetch_assoc();
						echo $row["cust_address"];
                       ?>
                      </th>
                </tr>              
                <tr>
                    <th style="width: 5%;font-size: 12px;background: rgba(255,255,255,1.0)">Vehicle</th>
                    <th>
                      <?php
                      $useremail=$_GET['Username'];;                   
						$sql_query = "SELECT make, model, year FROM vehicles INNER JOIN customers ON vehicles.Customer_ID = customers.Customer_ID 
								WHERE customers.cust_email='$useremail'";
						$result = $conn-> query($sql_query);
						$row = $result -> fetch_assoc();
						
						echo $row["make"] ." ". $row["model"]. " " .$row["year"];
                      
                       ?>
                     </th>
                </tr>
                <tr>
                    <th style="width: 5%;font-size: 12px;background: rgba(255,255,255,1.0)">VIN</th>
                    <th>
                      <?php
						$useremail=$_GET['Username'];;                   
						$sql_query = "SELECT VIN FROM vehicles INNER JOIN customers ON vehicles.Customer_ID = customers.Customer_ID 
								WHERE customers.cust_email='$useremail'";
						$result = $conn-> query($sql_query);
						$row = $result -> fetch_assoc();						
						echo $row["VIN"];
						
                       ?>
                    </th>
                </tr>
                <tr>
                    <th style="width: 5%;font-size: 12px;background: rgba(255,255,255,1.0)">Overhaul description</th>
                    <th><?php
						$useremail=$_GET['Username'];;                   
						$sql_query = "SELECT overhl_desc FROM bill INNER JOIN customers ON bill.Customer_ID = customers.Customer_ID 
								WHERE customers.cust_email='$useremail'";
						$result = $conn-> query($sql_query);
						$row = $result -> fetch_assoc();						
						echo $row["overhl_desc"];
						
                       ?></th>
                </tr>
            </table>
            <br>
			<!-- Items table -->
			<table width= "100%" border="1">
				<tr style="background: rgba(255,255,255,1.0)">
                    <th class="text-center" colspan="2" style="width: 25%;">Items</th>
                </tr>
			</table>

			<!-- Table for the Items inside Items table -->
            <table width="100%" border="1px">
                <tr style="background: rgba(255,255,224,1.0);">
			
                    <th class="text-center" colspan="3">
                        Part ID
                    </th>
                    <th class="text-center">
                        Manuf
                    </th>
                    <th class="text-center">
                        Price
                    </th>
                    <th class="text-center">
                        Quantity
                    </th><th class="text-center">
                        Total
                    </th>

                </tr>
                <tbody>
					
					<tr>
						<td colspan="3">
							<?php						
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
							
							?>
						</td>
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
								$sql_query4 = "SELECT manuf FROM `parts` WHERE `Part_ID` LIKE '$part_id'";
								$result4 = $conn-> query($sql_query4);
								$row4 = $result4 -> fetch_assoc();
								echo $row4["manuf"];
							
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
								$sql_query4 = "SELECT part_price FROM `parts` WHERE `Part_ID` LIKE '$part_id'";
								$result4 = $conn-> query($sql_query4);
								$row4 = $result4 -> fetch_assoc();
								echo "$";
								echo $row4["part_price"];
								
								$first_num = $row4["part_price"];
							
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
								$sql_query4 = "SELECT part_quantity FROM `parts` WHERE `Part_ID` LIKE '$part_id'";
								$result4 = $conn-> query($sql_query4);
								$row4 = $result4 -> fetch_assoc();
								
								echo $row4["part_quantity"];
								
								$second_num = $row4["part_quantity"];
							?></td>
						<td>
							<?php
								$res_PT = $first_num * $second_num;
								echo "$";
								echo $res_PT;
							?>
						</td>
					</tr>
                </tbody>

            </table>
			<!-- Extension of the Items table -->
			<table width="100%" border="1px">
				<tr>
                    <th style="width: 10%;font-size: 12px;background: rgba(255,255,255,1.0)">Parts Total</th>
                    <th><?php
							$res_PT = $first_num * $second_num;
							echo "$";
							echo $res_PT;
						?></th>
                </tr>
			</table>
			<br>

			<!-- Labor table -->
			<table width= "100%" border="1">
				<tr style="background: rgba(255,255,255,1.0)">
                    <th class="text-center" colspan="2" style="width: 25%;">Labor</th>
                </tr>
			</table>

			<!-- All the labors inside Labor table-->
			<table width="100%" border="1px">
				<tr style="background: rgba(255,255,224,1.0);">
                    <th class="text-center" colspan="3">
                        Labor ID
                    </th>
                    <th class="text-center">
                        Description
                    </th>
                    <th class="text-center">
                        Price
                    </th>
                    <th class="text-center">
                        Quantity
                    </th>
                </tr>
				<tbody>
					
					<tr>
						<td colspan="3">
							<?php						
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
								$part_id = $row3["Part_ID"];
								$sql_query4 = "SELECT Labor_ID FROM `labor` WHERE `Part_ID` LIKE '$part_id'";
								$result4 = $conn-> query($sql_query4);
								$row4 = $result4 -> fetch_assoc();
								echo $row4["Labor_ID"];
								
								
							
							?>
						</td>
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
								$part_id = $row3["Part_ID"];
								$sql_query4 = "SELECT labor_desc FROM `labor` WHERE `Part_ID` LIKE '$part_id'";
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
								$sql_query3 = "SELECT Part_ID FROM `part choice` WHERE `Case_ID` LIKE '$case_id'";
								$result3 = $conn-> query($sql_query3);
								$row3 = $result3 -> fetch_assoc();
								$part_id = $row3["Part_ID"];
								$sql_query4 = "SELECT labor_cost FROM `labor`WHERE `Part_ID` LIKE '$part_id'";
								$result4 = $conn-> query($sql_query4);
								$row4 = $result4 -> fetch_assoc();
								echo "$";
								echo $row4["labor_cost"];
								
								$first_lprice = $row4["labor_cost"];
								
							
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
								$sql_query4 = "SELECT part_quantity FROM `parts` WHERE `Part_ID` LIKE '$part_id'";
								$result4 = $conn-> query($sql_query4);
								$row4 = $result4 -> fetch_assoc();
								
								echo $row4["part_quantity"];
								
								$second_lqua = $row4["part_quantity"];
								
							?></td>
						
					</tr>
                </tbody>
			</table>
            <table width="100%" border="1px">
				<tr>
                    <th style="width: 10%;font-size: 12px;background: rgba(255,255,255,1.0)">Labor Total</th>
                    <th>
						<?php
							$res_LT = $first_lprice * $second_lqua;
							echo "$";
							echo $res_LT;
						?>
					</th>
                </tr>
			</table>
			<br>

			<!-- Overhead and all the stuff at the bottom of the page lol -->
			<table width="100%" border="1">
                <tr>
                    <th style="width: 25%;font-size: 12px;background: rgba(255,255,255,1.0)">Overhead</th>
                    <th><?php
						$percent = 0.2;
						$res_OH = $percent * ($res_PT + $res_LT);
						echo "$";
						echo (round($res_OH,2));
						
                       ?></th>
                </tr>
                <tr>
                    <th style="width: 5%;font-size: 12px;background: rgba(255,255,255,1.0)">Tax (6.5%)</th>
                    <th>
						<?php
							$tax_percent = 0.065;
							$tax_num = $tax_percent * ($res_PT + $res_LT + $res_OH);
							echo "$";
							echo (round($tax_num, 2));
						?>
					</th>
                </tr>
                <tr>
                    <th style="width: 5%;font-size: 12px;background: rgba(255,255,255,1.0)">Total Price</th>
                    <th>
						<?php
							$total_P = ($res_PT + $res_LT + $res_OH + $tax_num);
							echo "$";
							echo (round($total_P,2));
						?>
					</th>
                </tr>
                <tr>
                    <th style="width: 5%;font-size: 12px;background: rgba(255,255,255,1.0)">
						Amount Due (Price + Tax minus deposit)</th>
                    <th>
						<?php 
							$useremail=$_GET['Username'];
							$sql_query = "SELECT VIN FROM vehicles INNER JOIN customers ON vehicles.Customer_ID = customers.Customer_ID
    								WHERE customers.cust_email='$useremail'";
							$result = $conn-> query($sql_query);
							$row = $result -> fetch_assoc();
							$VIN = $row['VIN'];
							$sql_query2 = "SELECT deposit FROM `Customization Project` WHERE VIN = '$VIN'";
							$result2 = $conn-> query($sql_query2);
							$row2 = $result2 -> fetch_assoc();
							$depo_sit = $row2["deposit"];
							
							$amount_D = $total_P - $depo_sit;
							echo "$";
							echo (round($amount_D,2));
						?>
					</th>
                </tr>
                <tr>
                    <th style="width: 5%;font-size: 12px;background: rgba(255,255,255,1.0)">Payment Method</th>
                    <th><?php
						$useremail=$_GET['Username'];;                   
						$sql_query = "SELECT pay_method FROM bill INNER JOIN customers ON bill.Customer_ID = customers.Customer_ID 
								WHERE customers.cust_email='$useremail'";
						$result = $conn-> query($sql_query);
						$row = $result -> fetch_assoc();						
						echo $row["pay_method"];
						
                       ?></th>
                </tr>
                <tr>
                    <th style="width: 5%;font-size: 12px;background: rgba(255,255,255,1.0)">Payment Date</th>
                    <th><?php
						$useremail=$_GET['Username'];;                   
						$sql_query = "SELECT pay_date FROM bill INNER JOIN customers ON bill.Customer_ID = customers.Customer_ID 
								WHERE customers.cust_email='$useremail'";
						$result = $conn-> query($sql_query);
						$row = $result -> fetch_assoc();						
						echo $row["pay_date"];
						$conn->close();
                       ?></th>
                </tr>
            </table>
            <br>
			<?php
				$useremail=$_GET['Username'];
				$url = "plan.php?Username=" .$useremail;
				echo "<a href='$url'>Back to plan page</a>";
			?>
			<br></br>
			<br>

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
