<?php
class Todo extends Stalker_Table
{
    public function schema() {
        return Stalker_Schema::build(function($table){
            $table->varchar("textt", 255);
        });
    }
}
?>
