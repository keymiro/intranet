<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Notification;
use App\WorkPermit;
use App\WorkVacation;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\AdverseEvent;
use App\ChangeTurn;

class FormsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //VACACIONES RegisterChangeturn
        $this->middleware('permission:vacation_index')
            ->only('listWorkVacation','DetailsWorkVacation');
        $this->middleware('permission:change_turn_index')
            ->only('ListChangeTurn','DetailsChangeTurn');
        $this->middleware('permission:change_turn_register')
            ->only('RegisterChangeturn');
        $this->middleware('permission:work_permit_index')
            ->only('ListWorkPermit','DetailsWorkPermit');
        $this->middleware('permission:adverse_event_index')
            ->only('index','DetailsAdverseEnvents');
        $this->middleware('permission:adverse_event_asing')
            ->only('ExportAdverseEnvent','UpdateAdverseEnvents');
    }

    public function index()
    {
      $event=  AdverseEvent::latest()->paginate(5);
      return view('admin.forms.quality.quality_list',
            compact('event'));
    }
    public function DetailsAdverseEnvents($id)
    {
     AdverseEvent::findOrFail($id);
     $event= AdverseEvent::with('user','user.people','user.people.area','location')
         ->where( 'id',$id)
         ->get();
        return view('admin.forms.quality.quality_details',
            compact('event'));

    }
    public function UpdateAdverseEnvents(Request $request, $id)
    {
        $IdEvent = AdverseEvent::findOrFail($id);
        $IdEvent -> update
        ([
            'unitanalysis'=>$request['cunid'],
            'nameevent'=>$request['cnameevent'],
            'coordinator'=>$request['ccoord'],
        ]);
        return back()->with('notification','Asignación realizada correctamente');
    }
    public function ExportAdverseEnvent($id)
    {
        $title= AdverseEvent::find($id);
        AdverseEvent::findOrFail($id);
        $event= AdverseEvent::with('user','user.people','user.people.area','location')
            ->where( 'id',$id)
            ->get();

        $pdf = PDF::loadView('admin.forms.quality.ExportAdverseEnvent',
            compact('event','title'));
        return $pdf->stream('ExportAdverseEnvent.pdf');

    }
    /** Recursos humanos **/
    public  function ListWorkPermit()
    {
        $workpermit = WorkPermit::latest()->paginate(5);
        return view('admin.forms.rrhh.workpermit.work_permit_list',
            compact('workpermit'));
    }
    public function  DetailsWorkPermit($id)
    {
        WorkPermit::findOrFail($id);
        $workpermit= WorkPermit::where('id',$id)->get();
       return view('admin.forms.rrhh.workpermit.work_permit_details',
       compact('workpermit'));
    }
    public function RegisterWorkPermit($id)
    {
        $registerWorkPermit = WorkPermit::findOrFail($id);

        $registerWorkPermit -> update
        ([
            'rdate'=>Carbon::now(),
        ]);
        return back()->with('notification','Registrado correctamente');
    }
    public function ApproveWorkPermit(Request $request, $WorkPermitId, $off)
    {

        $UserId =auth()->user()->id;
        $approvepermit = WorkPermit::findOrFail($WorkPermitId);

        $offnotification= Notification::where('workpermit_id',$WorkPermitId);
        $offnotification-> update
        ([
            'v'=>$off,
        ]);


        if (auth()->user()->role->id  ==4 ||
            auth()->user()->role->id ==3 ||
            auth()->user()->role->id ==2)
        {

           if (auth()->user()->role->id==4) {
               $approvepermit -> update ([
                   'coordigree_id'=> $UserId,
                   'coordigree'=>$request['approvepermit'],
               ]);

               }elseif (auth()->user()->role->id==3){
                   $approvepermit -> update ([
                       'directigree_id'=>$UserId,
                       'directigree'=>$request['approvepermit'],
                   ]);
                   }elseif (auth()->user()->role->id==2){
                       $approvepermit -> update ([
                           'managigree_id'=>$UserId,
                           'managigree'=>$request['approvepermit'],
                       ]);
       }

        }else {
            return back()->with('error','No posee el rol para hacer dicha acción');
              }
            if ($request['approvepermit']==0) {
                return back()->with('notification','Permiso [denegado] correctamente');

            }else {
                return back()->with('notification','Permiso [aprovadó] correctamente');
            }
    }
    public function ListChangeTurn()
    {
      $changeturn = ChangeTurn::paginate(5);
        return view('admin.forms.rrhh.changeturn.change_turn_list',
        compact('changeturn'));
    }
    public function DetailsChangeTurn($id)
    {
       ChangeTurn::findOrFail($id);
       $changeturn=ChangeTurn::where('id',$id)->get();
        return view('admin.forms.rrhh.changeturn.change_turn_details',
        compact('changeturn'));
    }
    public function RegisterChangeturn($id)
    {
        $changeturn = ChangeTurn::findOrFail($id);

        $changeturn -> update
        ([
            'rdaterrhh'=>Carbon::now(),
        ]);
        return back()->with('notification','Registrado correctamente');
    }
    public function ApproveChangeTurn(Request $request,$ChangeTurnId,$off)
    {
        $offv = ChangeTurn::findOrFail($ChangeTurnId);
        $offv->update
        ([
            'v' => $off,
            'coordigree_id'=>auth()->user()->id,
            'coordigree'=>$request['approvechangeturn'],
        ]);
        if ($request['approvechangeturn']==1){
            return back()->with('notification','Cambio de turno [aprobadó] correctamente');
        }else{
            return back()->with('notification','Cambio de turno [denegado] correctamente');
        }
    }
    public function listWorkVacation()
    {
       $workvacation = WorkVacation::latest()->paginate(5);
        return view('admin.forms.rrhh.workvacation.work_vacation_list',
            compact('workvacation'));
    }
    public function DetailsWorkVacation($id)
    {
        WorkVacation::findOrFail($id);
        $workvacation=WorkVacation::where('id',$id)->get();
        return view('admin.forms.rrhh.workvacation.work_vacation_details',
            compact('workvacation'));
    }
    public function ApproveWorkVacation(Request $request, $WorkVacationId, $off)
    {
        $workvacation = WorkVacation::findOrFail($WorkVacationId);

        if (auth()->user()->role->id==4) {
               $workvacation -> update ([
                    'coordigree_id'=> auth()->user()->id,
                    'coordigree'=>$request['approvevacation'],
                    'v'=>$off,
                ]);

            }elseif (auth()->user()->role->id==3) {
                $workvacation->update([
                    'directigree_id' => $UserId,
                    'directigree' => $request['approvevacation'],
                    'v' => $off,
                ]);
            }

        if ($request['approvevacation']==0) {
            return back()->with('notification','Solicitud [denegada] correctamente');

        }else {
            return back()->with('notification','Solicitud [aprobada] correctamente');
        }
    }

}
