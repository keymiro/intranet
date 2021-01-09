<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class ResultQuestionnaireExport implements FromQuery,WithHeadings,ShouldAutoSize
{
    use Exportable;
    public function headings(): array
    {
        return
        [
            'ID','PUNTAJE','NOMBRE DEL CUESTIONARIO',
            'PREGUNTAS','OPCIÓN A','OPCIÓN B', 'OPCIÓN C',
            'OPCIÓN D','APROBO','RESPUESTA SELECCIONADA',
            'RESPUESTA CORRECTA','VALIDACIÓN DE CORRECTAS',
            'NOMBRES','APELLIDOS','CC','CEL','CORREO',
        ];
    }

    public function query()
    {
      return  $query = DB::table('resultquestionnaires AS rq')
            ->selectRaw('
                    rq.id AS id,
                    rq.score as Puntaje,
                    qnn.name  AS Cuestionario,
                    qs.statement AS Preguntas,
                    qs.option_a AS Opción_A,
                    qs.option_b AS Opción_B,
                    qs.option_c AS Opción_C,
                    qs.option_d AS Opción_D,
                    (case rq.pass
                    when "1" then "Aprobo"
                    when "0" then "No Aprobo" end)
                      AS  Aprobo,
                    (case rq.correctoption_id
                         when "1"
                             then "A"
                             when "2"
                             then "B"
                             when "3"
                             then "C"
                             when "4"
                             then "D"
                         end) AS RespuestaSeleccionada,co.option AS RespuestaCorrecta,
                    (case rq.correctoption_id
                         when qs.correctoption_id
                            then "✓"
                         else "X"
                         end) AS Correctas,
                    p.names AS Nombres,
                    p.lastnames AS Apellidos,
                    p.document AS Documento,
                    p.phone AS Cel,
                    usr.email AS Correo
            ')->distinct('rq.questionnaire_id','p.names')
            ->join('questionnaires AS qnn', 'qnn.id', '=', 'rq.questionnaire_id')
            ->join('questions AS qs', 'qs.id', '=', 'rq.question_id')
            ->join('users AS usr', 'usr.id', '=', 'rq.user_id')
            ->join('correctoptions AS co', 'co.id', '=', 'qs.correctoption_id')
            ->join('peoples AS p', 'p.id', '=', 'usr.people_id')
            ->join('repetitions AS r', 'r.id', '=', 'rq.repetition_id')
            ->orderBy('rq.id');

    }
}
