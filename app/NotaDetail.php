<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotaDetail extends Model
{
    protected $table = 'nota_detail';
    public $incrementing = true;
    public $timestamps = true;


    public function Product()
    {
        return $this->hasOne('App\Product', 'id', 'id_product');
    }
}
