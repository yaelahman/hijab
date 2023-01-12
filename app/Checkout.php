<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    protected $table = 'checkout';
    public $incrementing = true;
    public $timestamps = true;
}
