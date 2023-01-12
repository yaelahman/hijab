<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    protected $table = 'nota';
    public $incrementing = true;
    public $timestamps = true;

    public function Detail()
    {
        return $this->hasMany('App\NotaDetail', 'id_nota', 'id');
    }
}
