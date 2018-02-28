<?php 

$db = new SQlite3('user-store.db'); 

$db->query("PRAGMA synchronous = OFF");

$q = $_GET["q"];
$interst_id = $_GET["id"];
$user_id = $_GET["id"];
$description = $_GET["desc"];
$firstName = $_GET["fn"];
$lastName = $_GET["ln"];
$phone = $_GET["tel"];
$active = $_GET["act"];
$age = $_GET["age"];


header('Content-Type: application/json; charset=utf-8');


if($q == "interest"){
    $results = $db->query('SELECT * FROM Interest WHERE id = ' . $interst_id); 
    while ($row = $results->fetchArray()) { 
        echo json_encode($row, JSON_UNESCAPED_UNICODE);
     }
 }

if ($q=="user"){
    $results = $db->query('SELECT * FROM Person WHERE id=' . $user_id);
    while ($row = $results->fetchArray()){
        echo json_encode($row, JSON_UNESCAPED_UNICODE);
    }
}

if($q=="removeuser"){
    $results = $db->query('DELETE  FROM Person WHERE id=' . $user_id);
 // if($results){
  //  echo json_encode('User removed!', JSON_UNESCAPED_UNICODE);
 // }
}

if($q=="removeinterest"){
    
    $results = $db->query('DELETE  FROM Interest WHERE id=' . $user_id);
  //if($results){
    //    echo json_encode('Interest removed!', JSON_UNESCAPED_UNICODE);
   //    }
}
if($q=="addinterest"){
    $results = $db->query('INSERT INTO Interest VALUES(NULL,"'. $_GET["desc"]. '")');
   // if($results){
   //     echo json_encode('Interest added', JSON_UNESCAPED_UNICODE);
   // }
}
if($q=="adduser"){
    $results = $db->query('INSERT INTO Person VALUES(NULL,"'. $_GET["fn"]. '","'. $_GET["ln"]. '","'. $_GET["tel"]. '","'. $_GET["act"]. '","'. $_GET["age"]. '")');
   // if($results){
    //    echo json_encode('User added', JSON_UNESCAPED_UNICODE);
    //}
}
if($q=="searchinter"){
    $results = $db->query('SELECT * FROM Interest WHERE description LIKE "%'.$description.'%"');
    while ($row = $results->fetchArray()) { 
        echo json_encode($row, JSON_UNESCAPED_UNICODE);
     }
}
if($q=="searchuser"){
    $results = $db->query('SELECT * FROM Person WHERE firstName LIKE "%'.$firstName.'%"');
    while ($row = $results->fetchArray()) { 
    //    echo json_encode($row, JSON_UNESCAPED_UNICODE);
     }
}
if($q=="editinter"){
    $results = $db->query('UPDATE Interest SET description = "'.$description.'" WHERE id ='.$interst_id.'');
 // if($results){
      //  echo json_encode('Interest updated', JSON_UNESCAPED_UNICODE);
  //}
}
if($q=="edituser"){
    $results = $db->query('UPDATE Person SET firstName = "'.$firstName.'", lastName = "'.$lastName.'", phone = "'.$phone.'", active = "'.$active.'", age = "'.$age.'" WHERE id ='.$user_id.'');
  //if($results){
       // echo json_encode('User updated', JSON_UNESCAPED_UNICODE);
 // }
}
echo json_encode($results);
echo "done";