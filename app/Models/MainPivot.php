<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class MainPivot extends Pivot
{
    protected $connection = 'main';
}
