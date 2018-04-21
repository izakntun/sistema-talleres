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

    public function excel()
    {
        \Excel::download(new ExportarRegistroTickets, 'Tickets.xlsx');
    }

    public function create()
    {
        $prioridad = \DB::select(\DB::raw('SELECT * FROM prioridad'));
        $categoria = \DB::select(\DB::raw('SELECT * FROM categoria'));
        $entidades = \DB::select(\DB::raw('SELECT * FROM entidad_federativa'));
        $consulta = \DB::select(\DB::raw('SELECT * FROM medio_consulta'));
        $entes = \DB::select(\DB::raw('SELECT id, nombre FROM ente_publico'));
        $estatus = \DB::select(\DB::raw('SELECT * FROM estatus'));
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
            //$test = (array)$test;
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
            //dd($request->input('folio'));
            $result = \DB::table('control_ticket')
                ->orderBy('id', 'DESC')
                ->limit(0)->limit(1)->get();

            \DB::insert(\DB::raw('
            INSERT INTO control_ticket (
                ente_publico_id, prioridad_id, estatus_id, medio_consulta_id, categoria_id, users_id, folio_registro, folio, fecha_creacion, asunto, descripcion, fecha_solucion, observaciones, respuesta)
                VALUES (:ente_publico_id, :prioridad_id, :estatus_id, :medio_consulta_id, :categoria_id, :users_id, :folio_registro, :folio, :fecha_creacion, :asunto, :descripcion, :fecha_solucion, :observaciones, :respuesta)'),
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
            );
            \DB::update(\DB::raw('UPDATE ente_publico SET 
                                            nombre_enlace = :nombre_enlace,
                                            correo_electronico = :correo_electronico,
                                            telefono = :telefono
                                        WHERE id = :id'),
                [
                    'nombre_enlace' => $request->input('enlace'),
                    'correo_electronico' => $request->input('correo_electronico'),
                    'telefono' => $request->input('telefono'),
                    'id' => $request->input('ente_publico')
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
        $ticket = \DB::select(\DB::raw('select ef.id entidad_federativa_id, ct.*, ep.nombre_enlace, ep.correo_electronico, ep.telefono from control_ticket ct
                join ente_publico ep on ct.ente_publico_id = ep.id 
                join entidad_federativa ef on ep.entidad_federativa_id = ef.id
                where ct.id = :id'),
            [
                'id' => $id
            ]
        );
        //dd($ticket);
        $prioridad = \DB::select(\DB::raw('SELECT * FROM prioridad'));
        $categoria = \DB::select(\DB::raw('SELECT * FROM categoria'));
        $entidades = \DB::select(\DB::raw('SELECT * FROM entidad_federativa'));
        $consulta = \DB::select(\DB::raw('SELECT * FROM medio_consulta'));
        $entes = \DB::select(\DB::raw('SELECT id, nombre FROM ente_publico'));
        $estatus = \DB::select(\DB::raw('SELECT * FROM estatus'));
        return view('registro_ticket.edit', compact('prioridad', 'categoria', 'entidades', 'consulta', 'entes', 'estatus', 'ticket'));
    }

    public function update(UpdateTicketRequest $request, $id)
    {
        try
        {
            \DB::beginTransaction();
            //dd($request->all(), $id);
            \DB::insert(\DB::raw('
            UPDATE control_ticket SET
                ente_publico_id = :ente_publico_id, 
                prioridad_id = :prioridad_id, 
                estatus_id = :estatus_id, 
                medio_consulta_id = :medio_consulta_id, 
                categoria_id = :categoria_id, 
                users_id = :users_id, 
                folio = :folio, 
                fecha_creacion = :fecha_creacion, 
                asunto = :asunto, 
                descripcion = :descripcion, 
                fecha_solucion = :fecha_solucion, 
                observaciones = :observaciones, 
                respuesta = :respuesta
            WHERE id = :id'),
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
                    'respuesta' => $request->input('respuesta'),
                    'id' => $id
                ]
            );
            \DB::update(\DB::raw('UPDATE ente_publico SET 
                                            nombre_enlace = :nombre_enlace,
                                            correo_electronico = :correo_electronico,
                                            telefono = :telefono
                                        WHERE id = :id'),
                [
                    'nombre_enlace' => $request->input('enlace'),
                    'correo_electronico' => $request->input('correo_electronico'),
                    'telefono' => $request->input('telefono'),
                    'id' => $request->input('ente_publico')
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
            \DB::delete(\DB::raw('DELETE FROM control_ticket WHERE id =:id'), ['id' => $id]);
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
