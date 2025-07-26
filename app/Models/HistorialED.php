<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialED extends Model
{
    use HasFactory;

    protected $fillable = ['patient_id', 'date', 'summary', 'doctor'];

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }
}
