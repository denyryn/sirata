<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;
    protected $table = 'dosens';
    protected $primaryKey = 'id_dosen';
    protected $fillable = [
        'nip',
        'nidn',
        'id_user',
        // 'id_jabatan',
        'id_prodi',
        'nama_dosen',
        'gelar_depan',
        'gelar_belakang',
        'golongan'
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function Jabatan()
    {
        return $this->hasOne(Jabatan::class, 'id_dosen');
    }

    public function Mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'id_dosen_pembimbing');
    }

    public function Program_Studi()
    {
        return $this->belongsTo(Program_Studi::class, 'id_prodi');
    }

}
