<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmpresasUsuarios extends Model
{
    //
    protected $table ="empresa_usuario";
    public $timestamps=false;
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'empresa_id','user_id',
    ];
}
