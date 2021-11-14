<?php
include_once './core/stalker_configuration.core.php';
include_once './core/stalker_database.core.php';
include_once './tables/table_todolist.php';
?>
<?php

class php_classes {
    // public $row;
    function save(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $content = $_POST["content"];
            if($content==""){
                echo "empty"  ;
            }
            else{
                try{
                    $branch = new Todo();
                    $branch->textt = $content;
                    $branch->save();
                    $branch->id;
                    }
                    catch(PDOException $e){
                    echo  $e->getMessage();
                    }
            }
        }
    }
    function edit(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $newText = $_POST["newText"];
            $id = $_POST["id"];
            if($newText==""){
                echo "empty";
            }
            else{
                try {
                    $bra = Todo::get($id);
                    $bra->textt = $newText;
                    $bra->save();
                    echo "done";
                    } 
                    
                catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
                } 
            }
        }
    }
    function del(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST["id"];
                try {
                    $branch = Todo::get($id);
                    $branch->delete();
                    echo "done";
                    } 
                    
                catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
                } 
        }
    }
    function get(){
        try {
            $db = Stalker_Database::instance();
            $query = "SELECT * FROM Todo";
            $stmt = $db->execute($query);
                $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $row;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
