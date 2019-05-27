<?php

namespace App\Models\Tenant;

use App\Models\TenantModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends TenantModel
{
    use SoftDeletes;

   protected
      $fillable = [
         'contact_id',
         'is_billing',
         'contact_method_type_id',
         'street',
         'suite',
         'city',
         'state',
         'zip',
         'country',
      ];

   public function scopeForContact($query, $contact)
   {
      return $query->whereContact($contact);
   }

   public function contact()
   {
      return $this->belongsTo('App\Models\Tenant\Contact');
   }
}
