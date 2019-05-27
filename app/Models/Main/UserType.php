<?php

namespace App\Models\Main;

use App\Models\MainModel;

class UserType extends MainModel
{
    protected $table = 'type_user';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
