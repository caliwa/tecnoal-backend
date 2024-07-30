<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\EvaluacionDesempeno\CargoEmpleado;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CargoSAP extends Model
{
    use HasFactory;

    protected $fillable = ['Descripcion'];


    public function cargoEmpleados()
    {
        return $this->hasMany(CargoEmpleado::class, 'cargo_s_a_p_id');
    }
}
