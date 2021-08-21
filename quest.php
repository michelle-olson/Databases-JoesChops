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
                    <h4>Customer Profile</h4>
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
      <table width="100%" border="1">
          <tr style="background: rgba(255,255,224,1.0)">
              <th class="text-center" colspan="2" style="width: 25%;">Questions Asked by Customer and Employees</th>
      </tr>
      </table>
      <table>
        <tr>
          <th> Question Number </th>
          <th> Question </th>
          <th> Answer </th>
          <th> Date </th>
          <th> Case ID </th>
        </tr>
        <?php
        $host = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "joe's chops";

        //create connection
        $conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);
        if (!$conn)
        {
          die("Connection Failed:" . mysqli_connect_error());
        }
        $useremail=$_GET['Username'];
        $sql_query = "SELECT Customer_ID FROM customers WHERE cust_email='$useremail'";
        $result = $conn-> query($sql_query);
        $row = $result -> fetch_assoc();
        $cust_id = $row["Customer_ID"];
        //Getting VIN
        $sql_query = "SELECT VIN FROM vehicles INNER JOIN customers ON vehicles.Customer_ID = customers.Customer_ID
              WHERE customers.cust_email='$useremail'";
        $result = $conn-> query($sql_query);
        $row = $result -> fetch_assoc();
        $VIN = $row['VIN'];
        //Getting Case_ID
        $sql_query2 = "SELECT Case_ID FROM `Customization Project` WHERE VIN = '$VIN'";
        $result2 = $conn-> query($sql_query2);
        $row2 = $result2 -> fetch_assoc();
        $case_id = $row2['Case_ID']; //We got Case_ID!
        $sql = "SELECT * FROM questionnaire WHERE Case_ID = '$case_id'";
        $giant_result = $conn->query($sql);
        if($giant_result->num_rows > 0)
        {
          while($row = $giant_result->fetch_assoc())
          {
            echo "<tr><td>".$row['Quest_num']."</td><td>".$row['question']
            . "</td><td>". $row['answer'] . "</td><td>" . $row['quest_date']. "</td><td>" .$row['Case_ID'];
          }
        }
        else
        {
          echo "No Results";
        }
        $conn->close();
        ?>
      </table>
			<!-- Critical Questions table -->
            <table width="100%" border="1">
                <tr style="background: rgba(255,255,224,1.0)">
                    <th class="text-center" colspan="2" style="width: 25%;">Critical Questions</th>
				</tr>
            </table>
			<table width="100%" border="1px">
                <tr style="background: rgba(255,255,255,1.0);">
					<th class="text-center">
                        Date
                    </th>
                    <th class="text-center" colspan="3">
                        Customer Question
                    </th>
                    <th class="text-center">
                        Joe's Chop
                    </th>
                </tr>
					<tbody>
					<!-- data for each column -->
					<tr><td>
            <?php
            echo date("m-d-Y");
            ?></td><td colspan="3">

              <form action = "connect.php" method = "POST">
                <input type = text name= "cust_quest" style="width: 85%;">
				<input type="submit" name="save" value= "Send">
              </form>
						</td>
						<td><!-- code to fetch answer from database --></td></tr>
					</tbody>
            </table>
            <br>
            <table width="100%" border="1px">
                      <tr style="background: rgba(255,255,255,1.0);">
      					<th class="text-center">
                              Date
                          </th>
                          <th class="text-center" colspan="3">
                              Customer Answer
                          </th>
                          <th class="text-center">
                              Joe's Chop
                          </th>
                      </tr>
      					<tbody>
      					<!-- data for each column -->
      					<tr><td>
                  <?php
                  echo date("m-d-Y");
                  ?></td><td colspan="3">
                    <form action = "connect2.php" method = "POST">
                      <table>
                        <td>
                            <input type = text name= "cust_answ" style="width: 2;">
                        </td>
                        <td>
                          <input type = text name= "qansw_num" style="width: 0.5;">
                        </td>
                        <td>
      				              <input type="submit" name="save" value= "Send">
                        </td>
                      </table>
                    </form>
      						</td>
      						<td><!-- code to fetch answer from database --></td></tr>
      					</tbody>
                  </table>
                  <br>
                </table>
                <br>
                <table width="100%" border="1px">
                          <tr style="background: rgba(255,255,255,1.0);">
          					<th class="text-center">
                                  Date
                              </th>
                              <th class="text-center" colspan="3">
                                  Delete Question
                              </th>
                              <th class="text-center">
                                  Joe's Chop
                              </th>
                          </tr>
          					<tbody>
          					<!-- data for each column -->
          					<tr><td>
                      <?php
                      echo date("m-d-Y");
                      ?></td><td colspan="3">

                        <form action = "connect3.php" method = "POST">
                          <input type = text name= "delete_quest" style="width: 85%;">
          				<input type="submit" name="save" value= "Send">
                        </form>
          						</td>
          						<td><!-- code to fetch answer from database --></td></tr>
          					</tbody>
                      </table>
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
