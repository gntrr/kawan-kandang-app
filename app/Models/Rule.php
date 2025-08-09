<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    use HasFactory;

    protected $table = 'rules';
    protected $primaryKey = 'id_rule';
    
    protected $fillable = [
        'kode_rule',
        'nama_rule',
        'if_condition',
        'then_condition',
    ];

    public function penyakit()
    {
        return $this->belongsTo(Penyakit::class, 'then_condition', 'kode_penyakit');
    }

    public function getGejalasArray()
    {
        return explode(' AND ', $this->if_condition);
    }
}
