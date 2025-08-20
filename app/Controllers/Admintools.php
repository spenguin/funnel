<?php

namespace App\Controllers;

use Exception;

class Admintools extends BaseController
{

    public function index()
    {
        die('test');
    }

    public function migrate()
    {
        // uncomment this after running migrations
        // exit('restricted');

        // Need a better test of access
        // if (! service('ionAuth')->isAdmin()) {
        //     return;
        // }

        // Load the migrations library
        $migrate = \Config\Services::migrations();

        try {
            // Run all available migrations
            $migrate->latest();

            // Alternatively, you can specify a specific version:
            // $migrate->version(3);

            echo 'Migrations were executed successfully.<br>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function seed()
    {
        // uncomment this after running seeds
        // exit;

        if (! service('ionAuth')->isAdmin()) {
            return;
        }

        $seeder = \Config\Database::seeder();

        try {
            echo 'Seeding Certificates...<br>';

            $seeder->call('CertificatesSeeder');
            echo 'Seeding executed successfully.<br>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }

        // add more seeds here if needed
    }

    public function rollback()
    {
        // uncomment this after running rollback
        // exit;

        if (! service('ionAuth')->isAdmin()) {
            return;
        }
        // Load the migrations library
        $migrate = \Config\Services::migrations();

        try {
            // Run rollback; see the last batch that is to be kept
            // (find it in table „migrations")
            // and reference it in $target variable
            $target = 3; // if set "3", both migrations with that no and and those below will be unaffected
            $migrate->regress($target);

            echo 'Migration rollback executed successfully.<br>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}