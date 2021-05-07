<?php

namespace App\Imports;

use App\Contribuyentes;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

class ContribuyentesImport implements ToModel
{
        use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
       // $cont = Contribuyentes::find(['tipo_doc_id_codigo'=>$row[1]]);
       
        
        return new Contribuyentes([
            //
            'desc'=>$row[0],
            'tipo_doc_id'=>2,
            'tipo_doc_id_codigo'=>$row[1]
            ]);
    }
    
     public function batchSize(): int
    {
        return 500;
    }
    
}
