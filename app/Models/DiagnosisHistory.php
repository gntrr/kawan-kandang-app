<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagnosisHistory extends Model
{
    use HasFactory;

    protected $table = 'diagnosis_histories';
    protected $primaryKey = 'id_diagnosis';
    
    protected $fillable = [
        'gejala_dipilih',
        'hasil_penyakit',
        'solusi',
        'tanggal_diagnosis',
    ];

    protected $casts = [
        'tanggal_diagnosis' => 'date',
    ];

    public function penyakit()
    {
        return $this->belongsTo(Penyakit::class, 'hasil_penyakit', 'kode_penyakit');
    }

    public function getGejalasArray()
    {
        return json_decode($this->gejala_dipilih, true);
    }
}
