<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class PenerimaModel extends Authenticatable
{
    use HasFactory;

    protected $table = 'm_penerima';

    protected $primaryKey = 'id_penerima';

    protected $fillable = [
        'id_bansos',
        'id_warga',
        'pln',
        'pdam',
        'pendapatan',
        'status_kesehatan',
        'status_rumah',
        'status',
        'skoredas',
        'skoresaw',
    ];

    public function bansos()
    {
        return $this->belongsTo(BansosModel::class, 'id_bansos', 'id_bansos');
    }
    public function user()
    {
        return $this->belongsTo(WargaModel::class, 'id_warga', 'id_warga');
    }
}
