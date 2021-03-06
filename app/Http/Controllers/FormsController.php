<?php

namespace App\Http\Controllers;
use App\TypePermit;
use App\WorkVacation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\incident;
use App\Priority;
use App\Location;
use App\AdverseEvent;
use App\User;
use App\Area;
use App\ChangeTurn;
use App\Events\WorkPermitEvent;
use App\Notifications\ChangeTurnNotification;
use App\Notifications\WorkPermitNotification;
use App\Notifications\VacationNotification;
use App\People;
use App\WorkPermit;
use Illuminate\Support\Facades\Auth;


class FormsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:traceability_index')->only('ListRequest');
        $this->middleware('permission:form_index')->only('GetReport');
        $this->middleware('permission:form_send')
            ->only(' PostReport','PostEvent',' PostWorkPermit','PostChangeTurn'
            ,'PostWorkVacation');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

/** Incidentes  */

    public function GetReport(){
        //tupo permiso rrhh//
        $typepermit = TypePermit::all();
        $locations = Location::all();
        $Priorities = Priority::all();
        $areas= Area::all();
        return view('forms.report')
            ->
        with(compact('locations','Priorities','areas','typepermit'));
    }

    public function PostReport(Request $request)
    {
        //validación de datos en la bd

      $rules =[
      //nombre del campo  nombre de la tabla mas id
          'priority'=>'required|exists:priorities,id',
         'location'=>'required|exists:locations,id',
          'title'=>'required|min:5',
         'description'=>'required|min:15',
      ];
      $messages =[
     'title.min'=>'El título debe tener al menos 5 caracteres.',
     'description.min'=>'la descripción debe tener al menos 15 caracteres.'
      ];
      $this->validate($request, $rules, $messages);
        //recibe todas las varibales de (name) y las inserta a la BD
       // incident::create($request->all());

        //otra forma de recibir variables, y sirve para usar validaciones
        $incident = new incident();
        $incident->name = $request->input('title');
        $incident->description = $request->input('description');
        $incident->priority_id = $request->input('priority');
        $incident->location_id = $request->input('location');
        $incident->client_id = auth()->user()->id;
        $incident -> save();
        return back();

    }
/*******Eventos adversos*******************************************/
    public function PostEvent(Request $request)
    {

        /***        consecutivo         **/
        $validate = AdverseEvent::select('consecutive')
            ->latest('id')
            ->first();
        if (empty($validate)) {
            $consecutive = '0000000000';
        } elseif ($validate->consecutive == $validate->consecutive) {
            $increment = $validate->consecutive;
            $consecutive = (int)$increment + 1;
            $consecutive = str_pad($consecutive,
                10,
                '0',
                STR_PAD_LEFT);
        }
        /***        consecutivo         **/
        AdverseEvent::create([
            /*** 0 revela identidad, 1 es anonimato **/
            'canoni' => $request['canoni'],
            'area_id' => $request['cservice'],
            'location_id' => $request['clocation'],
            'namepatient' => $request['cpaci'],
            'documentpatient' => $request['cid'],
            'description' => $request['cdescription'],
            'consecutive' => $consecutive,
            'user_id' => auth()->user()->id,
        ]);
        return back()->with('notification','Reporte enviado correctamente');
    }
    /** recursos humanos ############################################################*/
    /*permiso laboral*/

    public function ListRequest()
    {
     $changeturn=ChangeTurn::where('user_id',auth()->user()->id)
         ->paginate(5);
     $workpermit= WorkPermit::where('user_id',auth()->user()->id)
                            ->paginate(5);
    $workvacation= WorkVacation::where('user_id',auth()->user()->id)
            ->paginate(5);
    $aprovechangeturn=ChangeTurn::where('user_change_id',auth()->user()->id)
           ->paginate(5);

      return view('forms.list_request',
          compact('workpermit','changeturn','workvacation','aprovechangeturn'));
    }

    public function  DetailsWorkPermit($id)
    {
        WorkPermit::findOrFail($id);
        $workpermit= WorkPermit::where('id',$id)
                               ->where('user_id',auth()->user()->id)
                               ->get();
       return view('forms.rrhh.work_permit_details',
       compact('workpermit'));
    }

    public function PostWorkPermit(Request $request)
    {
        if ($request) {
          $igree = 1;
        }
     $workpermit= WorkPermit::create([
          'especify'=>$request['especify'],
          'typepaid'=>$request['typepaid'],
          'jentry'=>$request['jentry'],
          'jexit'=>$request['jexit'],
          'datepermit'=>$request['datepermit'],
          'timepermit'=>$request['timepermit'],
          'pexit'=>$request['pexit'],
          'preturn'=>$request['preturn'],
          'description'=>$request['description'],
          'observations'=>$request['observations'],
          'igree'=> $igree,
          'typepermit_id'=>$request['typepermit'],
          'user_id'=>auth()->user()->id,
      ]);
      event(new WorkPermitEvent($workpermit));
        return back()->with('notification','Solicitud enviada correctamente');
    }
/***cambio de turno */
    public function PostChangeTurn(Request $request)
    {
    $ccchange=User::select('users.id')
                  ->join('peoples as p','p.id','=','users.people_id')
                  ->where('p.document',$request['ccchange'])
                  ->first();
    $area_id_send=auth()->user()->people->area_id;
    $user = User::all();
        if(!empty($ccchange))
        {
         $changeturn= ChangeTurn::create ([
                'numberchangeturn'=>$request['numberchangeturn'],
                'datechangeturn'=>$request['datechangeturn'],
                'tchangeturn'=>$request['tchangeturn'],
                'returnchangeturn'=>$request['returnchangeturn'],
                't1changeturn'=>$request['t1changeturn'],
                'observations'=>$request['observations'],
                'user_id'=>auth()->user()->id,
                'igree'=>1,
                'user_change_id'=>$ccchange['id'],
            ]);
        //notifica a quien va a reemplazar el turno
            $ccchange->notify(new ChangeTurnNotification($changeturn));
            // notifica al coordinador del area
                foreach ($user as $u )
                {

                    if ($u->people->area_id ==$area_id_send &&
                        $u->hasRole(['coordinador','coordinador-calidad','coordinador-rrhh']) )
                        {
                        $u->notify(new ChangeTurnNotification($changeturn));
                        }
                }

                return back()->with('notification','Solicitud enviada correctamente');
        }else{
            return back()->with('error','Este usuario no existe en el sistema');
        }
    }

    public function DetailsChangeTurn($id)
    {
        ChangeTurn::findOrFail($id);
        $changeturn=ChangeTurn::where('id',$id)->first();
        return view('forms.rrhh.change_turn_details',
            compact('changeturn'));
    }
    public function ApproveChangeTurn(Request $request, $id)
    {
        $approve= ChangeTurn::findOrFail($id);
        $approve->update
        ([
            'user_change_igree'=>$request['approvechangeturn'],
        ]);
        if ($request['approvechangeturn']==1){
            return back()->with('notification','Cambio de turno [aprobadó] correctamente');
        }else{
            return back()->with('notification','Cambio de turno [denegado] correctamente');
        }
    }

    public function PostWorkVacation(Request $request)
    {
       $vacation= WorkVacation::create
        ([
            'startdate'=>$request['startdate'],
            'returndate'=>$request['returndate'],
            'fromdate'=>$request['fromdate'],
            'untildate'=>$request['untildate'],
            'businessdays'=>$request['businessdays'],
            'requesteddays'=>$request['requesteddays'],
            'pendingdays'=>$request['pendingdays'],
            'enjoydays'=>$request['enjoydays'],
            'observations'=>$request['observations'],
            'user_id'=>auth()->user()->id,
            'igree'=>1,
        ]);
        $area_id_send=auth()->user()->people->area_id;
        $user_type=auth()->user()->type_func;
        $user = User::all();
        foreach ($user as $u )
        {
            // Validad que el area del funcionario y coordinador sean las mimas
            // y valida que sea coordinador
            if ($u->people->area_id ==$area_id_send &&
                $u->hasRole(['coordinador','coordinador-calidad','coordinador-rrhh']) )
                {
                    $u->notify(new VacationNotification($vacation));
                }
                // Notifica al director correspondiente
            if($user_type ==1)
                {
                    if($u->hasRole('director-financiero')){
                            $u->notify(new VacationNotification($vacation));
                        }
                   }else{
                    if($u->hasRole('director-medico')){
                            $u->notify(new VacationNotification($vacation));
                        }
                }
        }
        return back()->with('notification', 'Solicitud enviada correctamente');
    }
    public function  DetailsWorkVacation($id)
    {
        WorkVacation::findOrFail($id);
        $workvacation= WorkVacation::where('id',$id)
            ->where('user_id',auth()->user()->id)
            ->get();
        return view('forms.rrhh.work_vacation_details',
            compact('workvacation'));
    }


}
