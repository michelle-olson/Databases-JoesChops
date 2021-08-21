<?php

$cust_quest = filter_input(INPUT_POST, 'cust_quest');
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

$url_piece = explode("=", $url);
echo $url_piece[1]; // piece1
$useremail = $url_piece[1];
  $cust_quest = $_POST['cust_quest'];
if (isset($_POST['save']))
{

  $sql_query = "SELECT Customer_ID FROM customers WHERE cust_email='$useremail'";
  echo $sql_query;
  $result = $conn-> query($sql_query);
  $row = $result -> fetch_assoc();
  $cust_id = $row["Customer_ID"];
  $sql_query = "SELECT VIN FROM vehicles INNER JOIN customers ON vehicles.Customer_ID = customers.Customer_ID
        WHERE customers.cust_email='$useremail'";
  $result = $conn-> query($sql_query);
  $row = $result -> fetch_assoc();
  $VIN = $row['VIN'];
  $sql_query2 = "SELECT Case_ID FROM `Customization Project` WHERE VIN = '$VIN'";
  $result2 = $conn-> query($sql_query2);
  $row2 = $result2 -> fetch_assoc();

  $case_id = $row2['Case_ID'];
  $quest_date = date('Y-m-d');

  $count_questions = 1;
  $check_sql = "SELECT quest_num FROM questionnaire WHERE Case_ID = '$case_id'";

  $result = $conn->query($check_sql);

  if($result->num_rows > 0)
  {
    while ($row = $result->fetch_assoc())
    {
      $count_questions = $count_questions + 1;
    }
  }

  $quest_num = "q".$case_id ."_".strval($count_questions);
  echo $quest_num;
  $answ = "Employee Attn required";

  echo $cust_quest;

  $sql_insert = "INSERT INTO questionnaire (Quest_num,
     question, answer, quest_date, Case_ID) VALUES (
    '$quest_num', '$cust_quest', '$answ', '$quest_date', '$case_id')";
    if(mysqli_query($conn, $sql_insert))
    {
      echo "New Details Entry inserted successfully !";
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
