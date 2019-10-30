<?php
namespace app\components\gii\ajaxcrud; 

use yii;
class GeneratorSetting{
    
    public function checkTable($table)
    {
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("SELECT COUNT(*) totalColumns
        FROM   INFORMATION_SCHEMA.COLUMNS
        WHERE  table_name = '$table' AND 
        TABLE_SCHEMA = '".explode('=', Yii::$app->db->dsn)[2]."'");

        return $result = $command->queryAll();
    }
    
//    public static function removeView($table)
//    {
//        unlink('../views/'.$table.'/view.php');
//    }
    
}
