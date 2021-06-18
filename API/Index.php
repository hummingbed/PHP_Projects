<?php

$url = "https://jsonplaceholder.typicode.com/posts";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response =curl_exec($ch);

$data = json_decode($response, true);

curl_close($ch);

$con = mysqli_connect("localhost", "root","", "myapi");

foreach($data as $datas){

    $title = $datas['title'];
    $body = $datas['body'];
    // echo $datas['title'];
    
    $sql =  "INSERT INTO test (title,body) VALUES ('$title', '$body')";
    if(mysqli_query($con, $sql)){
        echo "Records inserted successfully.";
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
    }
}