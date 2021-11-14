<?php
include_once './core/stalker_configuration.core.php';
include_once './core/stalker_registerar.core.php';
include_once './core/stalker_schema.core.php';
include_once './core/stalker_validator.core.php';
include_once './core/stalker_database.core.php';
include_once './core/stalker_information_schema.core.php';
include_once './core/stalker_query.core.php';
include_once './core/stalker_migrator.core.php';
include_once './core/stalker_backup.core.php';
include_once './core/stalker_table.core.php';
include_once 'phpclasses.php';
require_once('miniRouter.php');
foreach ( glob("./tables/*.table.php") as $file ) {
    require_once $file;
}
Stalker_Registerar::auto_register();
if(Stalker_Migrator::need_migration()){
    Stalker_Migrator::migrate();
}

$router = new miniRouter();

$router->group("/todo", function($router){
    // always use class
    $router->get('/', function(){
        include 'main.php';
    });
$router->group('/api', function($router){
        $router->post('/save',[new php_classes(), 'save']);
        $router->post('/edit',[new php_classes(), 'edit']);
        $router->post('/del',[new php_classes(), 'del']);
    });
    
});
$router->fallback(function(){
    echo "Page Not Found";
});

$router->start_routing();
    