<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BarangModel extends Model
{
    use HasFactory;

    protected $table = 'm_barang';
    protected $primaryKey = 'barang_id';
    protected $fillable = ['kategori_id','barang_nama', 'barang_kode', 'harga_beli', 'harga_jual'];
    public function kategori(): HasOne
    {
        return $this->hasOne(KategoriModel::class, 'kategori_id', 'kategori_id');
    }
}
