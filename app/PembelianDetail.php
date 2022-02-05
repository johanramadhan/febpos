<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PembelianDetail extends Model
{
    protected $guarded = [];

    protected $primaryKey = 'id_pembelian_detail';

    protected $hidden = [
        
    ];

    public function product()
    {
        return $this->hasOne(Product::class, 'id_produk', 'id_produk');
    }
}
