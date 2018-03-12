<?php 

$db = new SQlite3('user-store.db'); 

$db->query("PRAGMA synchronous = OFF");

if(isset($_GET["q"])){
    $q = $_GET["q"];
}

header('Content-Type: application/json; charset=utf-8');

if(isset($_GET["id"])){
    $interst_id = $_GET["id"];
}
if($q == "interest"){
    $results = $db->query('SELECT * FROM Interest WHERE id = ' . $interst_id); 
    while ($row = $results->fetchArray()) { 
        echo json_encode($row, JSON_UNESCAPED_UNICODE);
     }
 }
 if(isset($_GET["id"])){
    $user_id = $_GET["id"];
}
if ($q=="user"){
    $results = $db->query('SELECT * FROM Person WHERE id=' . $user_id);
    while ($row = $results->fetchArray()){
        echo json_encode($row, JSON_UNESCAPED_UNICODE);
    }
}

if($q=="removeuser"){
    $results = $db->query('DELETE  FROM Person WHERE id=' . $user_id);
}

if($q=="removeinterest"){  
    $results = $db->query('DELETE  FROM Interest WHERE id=' . $user_id);
}

if(isset($_GET["desc"])){
    $description = $_GET["desc"];
}
if($q=="addinterest"){
    $results = $db->query('INSERT INTO Interest VALUES(NULL,"'. $_GET["desc"]. '")');
}

if($q=="adduser"){
    $results = $db->query('INSERT INTO Person VALUES(NULL,"'. $_GET["fn"]. '","'. $_GET["ln"]. '","'. $_GET["tel"]. '","'. $_GET["act"]. '","'. $_GET["age"]. '")');
}
if($q=="searchinter"){
    $results = $db->query('SELECT * FROM Interest WHERE description LIKE "%'.$description.'%"');
    while ($row = $results->fetchArray()) { 
        echo json_encode($row, JSON_UNESCAPED_UNICODE);
     }
}

if(isset($_GET["fn"])){
    $firstName = $_GET["fn"];
}
if(isset($_GET["ln"])){
    $lastName = $_GET["ln"];
}
if(isset($_GET["tel"])){
    $phone = $_GET["tel"];
}
if(isset($_GET["act"])){
    $active = $_GET["act"];
}
if(isset($_GET["age"])){
    $age = $_GET["age"];
}
if($q=="searchuser"){
    $results = $db->query('SELECT * FROM Person WHERE firstName LIKE "%'.$firstName.'%"');
    while ($row = $results->fetchArray()) { 
       echo json_encode($row, JSON_UNESCAPED_UNICODE);
     }
}
if($q=="editinter"){
    $results = $db->query('UPDATE Interest SET description = "'.$description.'" WHERE id ='.$interst_id.'');
}
if($q=="edituser"){
    $results = $db->query('UPDATE Person SET firstName = "'.$firstName.'", lastName = "'.$lastName.'", phone = "'.$phone.'", active = "'.$active.'", age = "'.$age.'" WHERE id ='.$user_id.'');
}

echo json_encode($results);
