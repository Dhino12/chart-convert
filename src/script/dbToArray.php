<?php 
// include 'functions.php';

function dbToArray($tables)
{
    $column = [];
    // $dataDb = [];

    for ($i = 0; $i < count($tables) ; $i++) { 
        $tableName = $tables[$i]['Tables_in_chart_generator'];
        $table = query("DESC `$tableName`;", true);
        
        for ($j=0; $j < count($table); $j++) {
            $columnName = $table[$j]['Field'];
            $column[$tableName]['column'][$j] = $columnName;
            $column[$tableName][$columnName] = query("SELECT `$columnName` FROM `$tableName`;", false);
        }
    }
    
    return $column;
}

/**
 * output dbToArray() :
 * $column = [
 *  ["tables_name"] => [
 *          [column] => ['columnName1', 'columnName2'],
 *          [ColumnName1] => [
 *              ['Data1', 'Data2', 'Data3']
 *            ],
 *          [ColumnName2] => [
 *              ['Data1', 'Data2', 'Data3']
 *            ],
 *      ]
 * ]
 */
?>