<?php

namespace App\Http\Controllers;

use App\exports\ExportarRegistroTickets;
use App\Http\Requests\CreateTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Maatwebsite\Excel\Facades\Excel;
use Mockery\Exception;
use Monolog\Logger;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = \DB::table('control_ticket AS ct')
            ->select('ct.id', 'u.name AS name', 'ct.asunto AS asunto', 'ep.nombre AS nombre', 'tep.descripcion AS descripcion', 'ef.nombre AS nombre')
            ->join('users AS u', 'ct.users_id', '=', 'u.id')
            ->join('ente_publico AS ep', 'ct.ente_publico_id', '=', 'ep.id')
            ->join('entidad_federativa AS ef', 'ep.entidad_federativa_id', '=', 'ef.id')
            ->join('tipo_ente_publico AS tep', 'ep.tipo_ente_publico_id', '=', 'tep.id')->paginate(5);
        return view('registro_ticket.dashboard', compact('results'));
    }

    public function allTickets()
    {
        if (Request()->ajax())
        {
            $result = \DB::table('control_ticket AS ct')
                ->select('ct.id', 'u.name AS name', 'ct.asunto AS asunto', 'ep.nombre AS nombre', 'tep.descripcion AS descripcion', 'ef.nombre AS nombre')
                ->join('users AS u', 'ct.users_id', '=', 'u.id')
                ->join('ente_publico AS ep', 'ct.ente_publico_id', '=', 'ep.id')
                ->join('entidad_federativa AS ef', 'ep.entidad_federativa_id', '=', 'ef.id')
                ->join('tipo_ente_publico AS tep', 'ep.tipo_ente_publico_id', '=', 'tep.id')->get();
            return response()->json($result);
        }
    }

    public function allEntes($id)
    {
        if (Request()->ajax())
        {
            $entes = \DB::table('ente_publico')->where('entidad_federativa_id', $id)->get();
            return response()->json($entes);
        }
    }

    public function excel()
    {
        \Excel::download(new ExportarRegistroTickets, 'Tickets.xlsx');
    }

    public function create()
    {
        $prioridad = \DB::table('prioridad')->get();
        $categoria = \DB::table('categoria')->get();
        $entidades = \DB::table('entidad_federativa')->get();
        $consulta = \DB::table('medio_consulta')->get();
        $entes = \DB::table('ente_publico')->get();
        $estatus = \DB::table('estatus')->get();
        return view('registro_ticket.create', compact('prioridad', 'categoria', 'entidades', 'consulta', 'entes', 'estatus'));
    }

    public function store(CreateTicketRequest $request)
    {
        try
        {
            $data = \DB::table('control_ticket')
                ->orderBy('id', 'DESC')
                ->limit(0)->limit(1)->get();
            $data = json_decode($data);
            $arr = !$data ? $data : get_object_vars($data[0]);
            $sheetNumberYear = date('Y');
            if (!$arr || $arr['folio_registro'] == null)
            {
                $sheetNumber = 'CT/'.$sheetNumberYear.'/'.str_pad(1, 6, "0", STR_PAD_LEFT);
            }
            else
            {
                $array = explode('/', $arr['folio_registro']);
                $prevYear = $array[0];
                $prevSheet = $array[1];
                if ($sheetNumberYear == $prevYear)
                {
                    $numberFolio = $prevSheet + 1;
                    $sheetNumber = 'CT/'.$sheetNumberYear.'/'.str_pad($numberFolio, 6, "0", STR_PAD_LEFT);
                }
                else
                {
                    $sheetNumber = 'CT/'.$sheetNumberYear.'/'.str_pad(1, 6, "0", STR_PAD_LEFT);
                }
            }
            \DB::beginTransaction();

            \DB::table('control_ticket')
                ->insert([
                    [
                        'ente_publico_id' => $request->input('ente_publico'),
                        'prioridad_id' => $request->input('prioridad'),
                        'estatus_id' => $request->input('estatus'),
                        'medio_consulta_id' => $request->input('medio_consulta'),
                        'categoria_id' => $request->input('categoria'),
                        'users_id' => \Auth::id(),
                        'folio_registro' => $sheetNumber,
                        'folio' => $request->input('folio'),
                        'fecha_creacion' => $request->input('fecha_registro'),
                        'asunto' => $request->input('asunto'),
                        'descripcion' => $request->input('descripcion'),
                        'fecha_solucion' => $request->input('fecha_respuesta'),
                        'observaciones' => $request->input('observaciones'),
                        'respuesta' => $request->input('respuesta')

                    ]
                ]);

            \DB::table('ente_publico')
            ->where('id', $request->input('ente_publico'))
            ->update(
                [
                    'nombre_enlace' => $request->input('enlace'),
                    'correo_electronico' => $request->input('correo_electronico'),
                    'telefono' => $request->input('telefono')
                ]
            );
            \DB::commit();
            return redirect()->route('/');
        }
        catch (Exception $e)
        {
            Logger()->debug($e);
            \DB::rollBack();
        }
    }

    public function edit($id)
    {
        $ticket = \DB::table('control_ticket AS ct')
            ->select('ef.id AS entidad_federativa', 'ct.*', 'ep.nombre_enlace', 'ep.correo_electronico', 'ep.telefono')
            ->join('ente_publico AS ep', 'ct.ente_publico_id', '=', 'ep.id')
            ->join('entidad_federativa AS ef', 'ep.entidad_federativa_id', '=', 'ef.id')
            ->where('ct.id', $id)->first();
        //dd($ticket);

        $prioridad = \DB::table('prioridad')->get();
        $categoria = \DB::table('categoria')->get();
        $entidades = \DB::table('entidad_federativa')->get();
        $consulta = \DB::table('medio_consulta')->get();
        $entes = \DB::table('ente_publico')->get();
        $estatus = \DB::table('estatus')->get();

        return view('registro_ticket.edit', compact('prioridad', 'categoria', 'entidades', 'consulta', 'entes', 'estatus', 'ticket'));
    }

    public function update(UpdateTicketRequest $request, $id)
    {
        try
        {
            \DB::beginTransaction();

            \DB::table('control_ticket')
                ->where('id', $id)
                ->update(
                    [
                        'ente_publico_id' => $request->input('ente_publico'),
                        'prioridad_id' => $request->input('prioridad'),
                        'estatus_id' => $request->input('estatus'),
                        'medio_consulta_id' => $request->input('medio_consulta'),
                        'categoria_id' => $request->input('categoria'),
                        'users_id' => \Auth::id(),
                        'folio' => $request->input('folio'),
                        'fecha_creacion' => $request->input('fecha_registro'),
                        'asunto' => $request->input('asunto'),
                        'descripcion' => $request->input('descripcion'),
                        'fecha_solucion' => $request->input('fecha_respuesta'),
                        'observaciones' => $request->input('observaciones'),
                        'respuesta' => $request->input('respuesta')

                    ]
                );

            \DB::table('ente_publico')
                ->where('id', $request->input('ente_publico'))
                ->update(
                    [
                        'nombre_enlace' => $request->input('enlace'),
                        'correo_electronico' => $request->input('correo_electronico'),
                        'telefono' => $request->input('telefono')
                    ]
                );

            \DB::commit();
            return redirect()->route('/');
        }
        catch (Exception $e)
        {
            Logger()->debug($e);
            \DB::rollBack();
        }
    }

    public function destroy($id)
    {
        try
        {
            \DB::beginTransaction();
            \DB::table('control_ticket')->where('id', $id)->delete();
            \DB::commit();
            return redirect()->route('/');
        }
        catch (Exception $e)
        {
            Logger()->debug($e);
            \DB::rollBack();
        }
    }
}
