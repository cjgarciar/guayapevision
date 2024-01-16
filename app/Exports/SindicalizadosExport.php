<?php

namespace App\Exports;

use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Illuminate\Http\Request;
use DB;
use Session;

class SindicalizadosExport implements FromCollection, WithHeadings, WithColumnFormatting, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array{
        return [
            'ID',
            'IDENTIDAD',            
            'NOMBRE COMPLETO',            
            'FECHA NACIMIENTO',
            'FECHA DEFUNSIÓN',
            'ESTADO SINDICATO',
            'SEXO',
            'TELEFONO',
            'PAIS NACIMIENTO',
            'DOMICILIO'                        
        ];
    }

    public function columnFormats(): array{

        return [
            'B' => NumberFormat::FORMAT_TEXT,
            'D' => NumberFormat::FORMAT_TEXT,
            'F' => NumberFormat::FORMAT_TEXT,
            'H' => NumberFormat::FORMAT_TEXT,
        ];
    }

    public function collection(){

        $sql_reg_ficha_personas = DB::select("select rfp.id, quote_literal( rfp.identidad ) as identidad , upper(TRIM(
            COALESCE(TRIM(rfp.primer_nombre)||' ','')||
            COALESCE(TRIM(rfp.segundo_nombre)||' ','')||
            COALESCE(TRIM(rfp.primer_apellido)||' ','')||
            COALESCE(TRIM(rfp.segundo_apellido||' '),'')
        ) ) nombre_persona, rfp.fecha_nacimiento, rfp.fecha_defuncion,
        tes.nombre as estado_sindicato , rfp.sexo, rfp.telefono, tp.nombre as pais_nacimiento, rfp.domicilio
        from public.reg_ficha_personas rfp
        left join public.tbl_departamentos td on td.id = rfp.id_departamento_residencia
        left join public.tbl_municipios tm on tm.id = rfp.id_municipio_residencia
        left join public.tbl_paises tp on tp.id = rfp.id_pais_nacimiento 
        left join public.tbl_departamentos td1 on td1.id = rfp.id_departamento_nacimiento
        left join public.tbl_municipios tm1 on tm1.id = rfp.id_municipio_nacimiento 
        left join public.tbl_paises tp1 on tp1.id = rfp.id_pais_residencia
        left join public.tbl_estado_sindicato tes on tes.id = rfp.id_estado_sindicato
        where rfp.deleted_at is null
        and rfp.id_estado_sindicato = 1
        order by 3 asc");

        //$sql_reg_ficha_personas=json_decode( json_encode($sql_reg_ficha_personas), true);

        return collect($sql_reg_ficha_personas);

        //return $sql_reg_ficha_personas;

    }

}
