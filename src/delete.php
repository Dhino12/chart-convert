<?php 

session_start();
include 'script/functions.php';

if (isset($_GET['tableName'])) {
    $tableName = $_GET['tableName'];
    $id = $_SESSION['identity'];
    $level = $_SESSION['level'];
    $strTables = '';

    $tableNames = query("SELECT table_name FROM `$level` WHERE id='$id'", true)[0]['table_name'];
    $tableNames = deleteData("DROP TABLE `$tableName`", $tableNames, $tableName);
    
    query("DELETE FROM tag WHERE table_name = '$tableName' AND id_user = '$id'", '');
    
    if (is_string($tableNames)) {
        $result = query("UPDATE `$level` SET `table_name`='$tableNames' WHERE `id`='$id'", '');
        echo "<script>alert('Data $tableName berhasil dihapus')</script>";

        header("Location: index.php");
        exit;
    } else {
        echo "<script>alert('Data $tableName gagal dihapus')</script>";
    }
}

?>