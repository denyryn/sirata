<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = 'statuses';
    protected $primaryKey = 'id_status';
    protected $fillable = [
        'nama_status'
    ];

    public function Riwayat()
    {
        return $this->hasMany(Riwayat::class, 'id_status');
    }
}
