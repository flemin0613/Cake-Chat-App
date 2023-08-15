<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Datasource\ConnectionManager;

class TransactionComponent extends Component
{
    public function beginTransaction()
    {
        $connection = ConnectionManager::get('default');
        $connection->begin();
    }

    public function commitTransaction()
    {
        $connection = ConnectionManager::get('default');
        $connection->commit();
    }

    public function rollbackTransaction()
    {
        $connection = ConnectionManager::get('default');
        $connection->rollback();
    }
}