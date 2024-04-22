<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PenjualanDetailModel extends Model
{
    use HasFactory;
    protected $table = 't_penjualan_detail';
    protected $primaryKey = 'detail_id';
    protected $fillable = ['penjualan_id', 'barang_id', 'harga', 'jumlah'];
    public function barang(): HasOne
    {
        return $this->hasOne(BarangModel::class, 'barang_id', 'barang_id');
    }
    public function penjualan(): HasOne
    {
        return $this->hasOne(PenjualanModel::class, 'penjualan_id', 'penjualan_id');
    }
}
