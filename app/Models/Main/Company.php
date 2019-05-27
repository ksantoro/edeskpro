<?php

namespace App\Models\Main;

use App\Models\MainModel;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class Company extends MainModel
{
    protected
        $fillable = [
            'id',
            'name',
            'hostname',
            'username',
            'password',
            'database',
            'created_at',
            'updated_at',
            'deleted_at',
        ];

    /**
     * Establish a connection with the tenant's database.
     */
    public function connect()
    {
        if (! $this->connected()) {
            tenant_connect(
                $this->hostname,
                $this->username,
                $this->password,
                $this->database
            );
        }
    }

    /**
     * Check if the current tenant connection settings matches the company's database settings.
     *
     * @return bool
     */
    private function connected()
    {
        $connection = Config::get('database.connections.tenant');

        return $connection['username'] == $this->username &&
            $connection['password'] == $this->password &&
            $connection['database'] == $this->database;
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Creates a new database schema.

     * @param  string $db_name The new schema name.
     * @return bool
     */
    public function createSchema($db_name)
    {
        try {
            return DB::statement("CREATE DATABASE IF NOT EXISTS " . $db_name);
        }
        catch (\Exception $e) {
            return response($e->getMessage());
        }
    }

    public function migrateNewCompanySchema($id)
    {
        Artisan::call('tenant:migrate', ['tenant' => $id]);
    }
}
