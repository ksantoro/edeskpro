<?php

namespace App\Models\Tenant;

use App\Models\Main\ContactType;
use App\Models\Main\LeadSource;
use App\Models\Main\User;
use App\Models\TenantModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Contact extends TenantModel
{
   use SoftDeletes;

   protected
      $fillable = [
         'contact_type_id',
         'first_name',
         'last_name',
         'title',
         'phone',
         'phone_type_id',
         'email',
         'email_type_id',
      ];

   public function locations()
   {
      return $this->hasMany(Location::class);
   }

    public function activity_contacts()
    {
        return $this->belongsToMany(ActivityLog::class, 'activity_log', 'entity_id');
    }

    public function contact_owners()
    {
        $database = DB::connection('tenant')->getDatabaseName();
        return $this->belongsToMany(User::class, "{$database}.contact_owners", 'contact_id', 'user_id');
    }

    public function contact_types()
    {
        return $this->belongsTo(ContactType::class);
    }

    public function lead_source()
    {
        return $this->belongsTo(LeadSource::class);
    }

    public function setConnection($name)
    {
        $this->connection = $name;
        return $this;
    }
}
