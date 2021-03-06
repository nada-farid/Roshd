<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Clinic extends Model
{
    use SoftDeletes;

    public $table = 'clinics';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'clinic_number',
        'clinic_name',
        'created_at',
        'updated_at',
        'deleted_at',
    ]; 

    public function specializations()
    {
        return $this->belongsToMany(Specialization::class);
    }

    public function doctors()
    {
        return $this->belongsToMany(Doctor::class,'doctor_clinic')->withPivot(['day','start_time','end_time']);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
