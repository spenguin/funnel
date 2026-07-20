<?php

namespace App\Controllers;

class Migrate extends BaseController
{

    function index()
    {
        echo command('migrate');
    }
    
    function status()
    {
        echo '<pre>' . command('migrate:status'). '</pre>';
    }

    /**
     * Run Seeders
     */
    function seed($seeder='')
    {
        if( empty($seeder) )
        {
            // Run all Seeder files
        } else {
            return command("db:seed $seeder");
        }

    }

    /**
     * Run Rollback
     */
    function rollback()
    {
        echo command('migrate:rollback');
    }


    // function __construct()
    // {
    //     // $this->confirmMigrationTable();
    // }
    
    
    // // Could make this a helper index 
    // public function index()
    // {
        
    // }


    // echo command('migrate:file "app\Database\Migrations\2022-02-16-101819_AddBlogMigration.php"');


    // private function confirmMigrationTable()
    // {
    //     // Does the migration table exist?
    //     $db     = db_connect();
    //     $sql    = "SHOW TABLES LIKE 'migrations';";
    //     $query  = $db->query($sql);
    //     if (!$query->connID->affected_rows)
    //     {
    //         // Migration table doesn't exist, so create it
    //         // echo command('migrate:file "app\Database\Migrations\2022-02-16-101819_AddBlogMigration.php"');
    //         $sql = "
    //             SET NAMES utf8mb4;
    //             SET FOREIGN_KEY_CHECKS = 0;
    //             CREATE TABLE `migrations` (
    //             `id` int(11) NOT NULL AUTO_INCREMENT,
    //             `name` varchar(255) DEFAULT NULL,
    //             `version` varchar(255) DEFAULT NULL,
    //             `group` varchar(255) DEFAULT NULL,
    //             `batch` int(11) DEFAULT NULL,
    //             `class` varchar(255) DEFAULT NULL,
    //             `namespace` varchar(255) DEFAULT NULL,
    //             `time` int(11) DEFAULT NULL,
    //             PRIMARY KEY (`id`)
    //             ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

    //             SET FOREIGN_KEY_CHECKS = 1;
    //         ";
    //         $db->query($sql);
    //     } 
    // }
}