<?php

include 'conn.php';

function splitArray(array $datas)
{
    $tHead = [];
    $tBody = [];
    $tCollaction = [];
    foreach ($datas as $key => $value) {
        if (explode('-', $key)[0] === '0') {
            $tHead[] = $value;
        } else if(is_numeric(explode('-', $key)[0])) {
            $tBody[] = $value; 
        }
    } 

    array_push($tCollaction, $tHead, $tBody);

    return $tCollaction;
}

function query(String $query, $assoc)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    
    if (!$result) {
        return mysqli_error($conn);;
    }

    if ($assoc === true) {
        // kembalikan data array assosiative
        $datas = [];
        while ($data = mysqli_fetch_assoc($result)) {
            $datas[] = $data;
        }
    }else if ($assoc === false) {
        // kembalikan data array numerik
        $datas = [];
        while ($data = mysqli_fetch_row($result)) {
            foreach($data as $key => $value) {
                $datas[] = $value;
                
            }
        }
    } else {
        // jika input data
        return $result;
    }

    return $datas;
}

function crTableDb($datas)
{
    $tTitle = $datas['titleTable'];
    $tCollaction = splitArray($datas);
    $tHead[] = $tCollaction[0]; 
    
    $strThead = '';

    foreach($tHead[0] as $key => $value) {
        if((count($tHead[0]) - 1) == $key) {
            $strThead .= "`$value` VARCHAR(180)";

        } else {
            $strThead .= "`$value` VARCHAR(180),";

        }
    }
    
    $result = query("CREATE TABLE `$tTitle` ($strThead);", '');

    if (is_string($result)) {
        return $result; // kembalikan pesan kesalahan
    }
    
    return $tCollaction;
}

function addValue($tBodyDatas, $tTitle, $tHead)
{ 
    $strTBody = '';

    for ($i = 0; $i <= count($tBodyDatas) - 1 ; $i++) {
        if($i === 0) { 
            $strTBody .= "('". $tBodyDatas[$i] ."',";
            
        } else if ((count($tBodyDatas) - 1) === $i) { 
            $strTBody .= "'". $tBodyDatas[$i] ."')";
            
        } else if ($i % count($tHead) == 0) { 
            $strTBody .= "),('". $tBodyDatas[$i] ."',";
            
        } else { 
            $strTBody .= "'". $tBodyDatas[$i] ."',";

        }
    }

    $fixString = str_replace(',)', ')', $strTBody);
    var_dump($fixString);
    $query = "INSERT INTO `$tTitle` VALUES $fixString;";

    $data = query($query, '');

    return $data;
}   

function updateValue($datas, $tablesName)
{
    global $conn;
    $columns = $datas[0];
    $rows = $datas[1];
    $query = "";
    $counter = 0;

    foreach($rows as $row) {
        $column = htmlspecialchars($columns[$counter]);
        $row = htmlspecialchars($row);

        if (count($columns) - 1 === $counter) {
            $query .= "`$column`='$row'";
            $counter = -1;
            query("UPDATE `$tablesName` SET $query WHERE id='$row'", "");
            $query = "";

        } else {
            $query .= "`$column`='$row',";
        }

        $counter++;
    }

    return mysqli_affected_rows($conn);
}

function clearData() {
    global $conn;
    $query = "SHOW TABLES";
    $tablesName = query($query, false); 
    foreach ($tablesName as $value) {
        mysqli_query($conn, "DROP TABLE `$value`");

    }
    return mysqli_affected_rows($conn);
}
