<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemohon extends Model
{
    use HasFactory;
    protected $table = 'pemohons';
    protected $primaryKey = 'id_pemohon';
    protected $fillable = [
        'id_user',
        'id_surat'
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function Surat()
    {
        return $this->belongsTo(Surat::class, 'id_surat');
    }
}
