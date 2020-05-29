<?php declare(Strict_types = 1);

namespace App\Support\Database;

use Illuminate\Database\Migrations\Migration as BaseMigration;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Connection;
use Illuminate\Database\Schema\Builder;

class Migration extends BaseMigration
{
    protected Connection $db;
    protected Builder $schema;
    
    public function __construct()
    {
        $manager = app(DatabaseManager::class);
        $this->db = $manager->connection();
        $this->schema = $manager->getSchemaBuilder();
    }
}
