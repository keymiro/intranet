<?php

namespace App\Http\Controllers;

use App\Archive;
use App\Area;
use App\CategoryArchive;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:archive_index')->only('IndexArchive');
        $this->middleware('permission:correspondence_index')->only('IndexCorrespondence');
    }

    public function IndexArchive(Request $request)
    {
        //scope=querys definidos en los modelos para hacer filtros
        $name     = $request->get('name');
        $category = $request->get('category');
        $areas    = $request->get('area');

        $archive = Archive::select('*','archives.created_at','archives.name')
            ->join('areas as a', 'a.id','=','archives.area_id')
            ->join('category_archives as c', 'c.id','=','archives.category_archive_id')
            ->latest('archives.created_at')
            ->where('c.id','!=',2)
            ->name($name)
            ->category($category)
            ->area($areas)
            ->paginate(5);

        return view('archive.archive_index',
            compact( 'archive'));
    }
    /*********************correspondencia********************************/
    public function IndexCorrespondence(Request $request)
    {
        $name  = $request->get('name');

        $correspondence = Archive::select('*','archives.created_at','archives.name')
            ->join('areas as a', 'a.id','=','archives.area_id')
            ->join('category_archives as c', 'c.id','=','archives.category_archive_id')
            ->latest('archives.created_at')
            ->where('a.id',auth()->user()->people->area_id)
            ->where('c.id','=',2)
            ->name($name)
            ->paginate(5);

        return view('archive.correspondence.correspondence_index',
            compact('correspondence'));
    }
}
