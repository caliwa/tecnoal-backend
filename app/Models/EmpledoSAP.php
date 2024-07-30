<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\EvaluacionDesempeno\CargoEmpleado;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmpledoSAP extends Model
{
    protected $fillable=['CardCode','CardName','CardType','Phone1','Currency','Cellular'];

    public function costonocalidad()
    {
        return $this->hasMany(CostoNocalidad::class);
    }

    public function cargoEmpleados()
    {
        return $this->hasMany(CargoEmpleado::class, 'empledo_s_a_p_id');
    }
}

