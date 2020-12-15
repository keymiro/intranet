<?php

namespace App\Http\Controllers\Admin;

use App\Archive;
use App\Area;
use App\CategoryArchive;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ArchiveController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:archive_index')->only('IndexArchive');
        $this->middleware('permission:archive_create')->only('PostArchive');
        $this->middleware('permission:archive_edit')->only('EditArchive');
        $this->middleware('permission:archive_edit')->only('UpdateArchive');
        $this->middleware('permission:archive_destroy')->only('DeleteArchive');

    }

    public function IndexArchive()
    {
       $area= Area::all();
       $categoryArchive = CategoryArchive::all();
       $archive =Archive::latest()->paginate(5);
        return view('admin.archive.archive_index',
            compact('area','archive','categoryArchive'));
    }
    public function  PostArchive(Request $request)
    {
        $ext = $request->file('archive')->extension();
        /* variable recibidad */    /* carpeta a guardar */
        $url= $request->file('archive')->store('public/archive');
        Archive::create
        ([
            'name'=>$request['name'],
            'url'=>$url,
            'category_archive_id'=>$request['category'],
            'area_id'=>$request['area'],
            'ext'=>$ext,
            'user_id'=>auth()->user()->id,
        ]);
        return back()->with('notification','Archivo cargado correctamente');
    }

    public  function EditArchive($id)
    {
        $categoryArchive = CategoryArchive::all();
        $area= Area::all();
        $editarchive = Archive::where('id',$id)->get();
        return view('admin.archive.archive_edit',
               compact('editarchive','area','categoryArchive'));
    }
    public function UpdateArchive(Request $request, $id)
    {

        $archive =Archive::findOrFail($id);

        if ($request->hasFile('archive'))
            {
                Storage::delete($archive->url);
                $ext = $request->file('archive')->extension();
                $url= $request->file('archive')->store('public/archive');
            }else{
                $url=$archive->url;
                $ext=$archive->ext;
            }
            if (empty($request['category']) || empty($request['area']))
                {
                   $c= $archive->category_archive_id;
                   $a =$archive->area_id;
                }else{
                    $c=$request['category'];
                    $a=$request['area'];
                }

      $archive -> update
        ([
            'name'=>$request['name'],
            'url'=>$url,
            'category_archive_id'=>$request['category'],
            'area_id'=>$request['area'],
            'ext'=>$ext,
            'user_id'=>auth()->user()->id,
        ]);
        return back()->with('notification','Archivo actualizado correctamente');
    }

    public function DeleteArchive($id)
    {
       $archive = Archive::findOrFail($id);

        Storage::delete($archive->url);
        $archive->delete();

        return back()->with('notification','Archivo eliminado correctamente');

    }

}
