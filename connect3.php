<?php

//$cust_quest = filter_input(INPUT_POST, 'cust_quest');
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
echo " connected to db";
$url = $_SERVER['HTTP_REFERER'];
//$useremail = var_dump(parse_url($url, PHP_URL_QUERY));
//echo $useremail . " ";
$url_piece = explode("=", $url);
echo $url_piece[1]; // piece1
$useremail = $url_piece[1];
  $chosen_quest = $_POST['delete_quest'];
if (isset($_POST['save']))
{
// This section is all the queries it takes to get to the right Case_ID
// we need to get Customer_ID to get to the VIN on the Vehicles table
// The VIN gives us the case_ID on the customers table
  //Getting Customer_ID
  $sql_query = "SELECT Customer_ID FROM customers WHERE cust_email='$useremail'";
  echo $sql_query;
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


  $quest_num = "q".$case_id."_".$chosen_quest;
  echo $quest_num;

  $sql_delete = "DELETE FROM questionnaire WHERE quest_num = '$quest_num'";
    if(mysqli_query($conn, $sql_delete))
    {
      echo "New Answer Entry Updated successfully ! The deleted question is ".$quest_num;
    }
    else {
      echo "hit the else";
      echo "Error: ". $sql . "" . mysqli_error($conn);
    }
}
echo "connection about to close";
mysqli_close($conn);
$url = "plan.php?Username=" .$useremail;
echo "<a href='$url'>Go to plan page</a>";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
</html>
