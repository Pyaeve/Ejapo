<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contribuyentes extends Model
{
    //
    protected $table="contribuyente";
    public $timestamps = false;
      protected $fillable = [
        'desc','ruc','regimen', 'cliente','tipo_doc_id','tipo_doc_id_codigo','timbrado_codigo','timbrado_inicio','timbrado_fin','empresa_id'
    ];

}
