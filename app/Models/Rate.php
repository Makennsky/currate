<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $fillable =   ['pair', 'value'];

    protected $hidden   =   ['updated_at', 'id'];

    protected $table    =   'rates';
}
