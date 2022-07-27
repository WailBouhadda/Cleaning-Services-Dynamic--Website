<?php 


$connect = new PDO("mysql:host=localhost;dbname=cleaningservices","root","");

$data = array();


$query = "SELECT * FROM reservation ORDER BY idreservation";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$today = date('Y-m-d');

$statut = null;
foreach($result as $row){

    if($row['dateseance'] < $today){
        $statut =  'label-success';
    }else{
        $statut = 'label-info';
    }

    $data[] = array(
        'id'        => $row['idreservation'],
        'title'     => $row['typemenage'],
        'start'     => $row['dateseance'],
        'className' => $statut
    );
}


echo json_encode($data);

?>