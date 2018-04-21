<?php namespace App\exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Monolog\Logger;

class ExportarRegistroTickets implements FromView
{
    public function view(): View
    {
        $results = \DB::table('control_ticket AS ct')
            ->select('ct.folio AS folio_ticket', 'ct.folio_registro AS folio_registro', 'e.descripcion AS estatus', 'c.descripcion AS categoria',
                'p.descripcion AS descripcion', 'ct.fecha_creacion AS fecha_registro', 'ep.nombre AS ente_publico', 'tep.descripcion AS tipo_ente',
                'ef.nombre AS entidad_federativa', 'ep.nombre_enlace AS enlace', 'ep.correo_electronico AS email', 'ep.telefono AS telefono', 'ct.asunto AS asunto',
                'ct.descripcion AS descripcion', 'ct.fecha_solucion AS fecha_respuesta', 'ct.respuesta AS respuesta', 'ct.observaciones AS observaciones')
            ->join('ente_publico AS ep', 'ct.ente_publico_id', '=', 'ep.id')
            ->join('tipo_ente_publico AS tep', 'ep.tipo_ente_publico_id', '=', 'tep.id')
            ->join('entidad_federativa AS ef', 'ep.entidad_federativa_id', '=', 'ef.id')
            ->join('estatus AS e', 'ct.estatus_id', '=', 'e.id')
            ->join('categoria AS c', 'ct.categoria_id', '=', 'c.id')
            ->join('prioridad AS p', 'ct.prioridad_id', '=', 'p.id')->get();
        //dd($results);
        return view('excel.tickets_excel', compact('results'));
    }
}