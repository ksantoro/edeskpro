<?php

namespace App\Models\Main;

use App\Models\Tenant\Contact;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    const
        SUPER      = 1,
        ADMIN      = 2,
        TECH       = 3,
        CSR        = 4,
        SALES      = 5,
        SALES_MGR  = 6,
        FIELD_TECH = 7,
        FOREMAN    = 8,
        MARKETING  = 9,
        FINANCE    = 10;

    protected $connection = 'main';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id', 'first_name', 'last_name', 'email', 'password', 'type_user_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function roles()
    {
        $database = DB::connection('tenant')->getDatabaseName();
        return $this->belongsToMany(Role::class, "{$database}.user_roles", 'user_id', 'role_id');
    }

    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        }
        else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }

        return false;
    }

    public function hasRole($role_id)
    {
        if ($this->roles()->where('id', $role_id)->first()) {
            return true;
        }

        return false;
    }

    public function types()
    {
        return $this->hasMany(UserType::class);
    }

    public function contact_owners()
    {
        $database = DB::connection('tenant')->getDatabaseName();
        return $this->belongsToMany(Contact::class, "{$database}.contact_owners", 'user_id', 'contact_id');
    }

    public function scopeAllUsers($query)
    {
        return $query->where('type_user_id', '<>', 1)->where('company_id', '=', Auth::user()->company->id);
    }

    public function scopeSuperUser($query)
    {
        return $query->where('type_user_id', '=', 1)->where('company_id', '=', Auth::user()->company->id);
    }

    public function scopeAdminUser($query)
    {
        return $query->where('type_user_id', '=', 2)->where('company_id', '=', Auth::user()->company->id);
    }

    public function scopeTechUser($query)
    {
        return $query->where('type_user_id', '=', 3)->where('company_id', '=', Auth::user()->company->id);
    }

    public function scopeCSRUser($query)
    {
        return $query->where('type_user_id', '=', 4)->where('company_id', '=', Auth::user()->company->id);
    }

    public function scopeSalesUser($query)
    {
        return $query->where('type_user_id', '=', 5)->where('company_id', '=', Auth::user()->company->id);
    }

    public function scopeSalesMgrUser($query)
    {
        return $query->where('type_user_id', '=', 6)->where('company_id', '=', Auth::user()->company->id);
    }

    public function scopeFieldTechUser($query)
    {
        return $query->where('type_user_id', '=', 7)->where('company_id', '=', Auth::user()->company->id);
    }

    public function scopeForemanUser($query)
    {
        return $query->where('type_user_id', '=', 8)->where('company_id', '=', Auth::user()->company->id);
    }

    public function scopeMarketingUser($query)
    {
        return $query->where('type_user_id', '=', 9)->where('company_id', '=', Auth::user()->company->id);
    }

    public function scopeFinanceUser($query)
    {
        return $query->where('type_user_id', '=', 10)->where('company_id', '=', Auth::user()->company->id);
    }
}
