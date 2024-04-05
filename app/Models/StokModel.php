<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class StokModel extends Model
{
    use HasFactory;
    protected $table = 't_stok';
    protected $primaryKey = 'stok_id';
    protected $fillable = ['barang_id','user_id', 'stok_tanggal', 'stok_jumlah'];
    public function user(): HasOne
    {
        return $this->hasOne(UserModel::class, 'user_id', 'user_id');
    }

    public function barang(): HasOne
    {
        return $this->hasOne(BarangModel::class, 'barang_id', 'barang_id');
    }
}
