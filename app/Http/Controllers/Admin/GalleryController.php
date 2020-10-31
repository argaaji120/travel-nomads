<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GalleryRequest;
use App\Models\Gallery;
use App\Models\TravelPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $travel_package = Gallery::with('travel_package')->orderBy('travel_packages_id', 'DESC')->get();

        if (request()->ajax()) {
            $data = [];
            $no   = 1;
            foreach ($travel_package as $key => $value) {
                $data[] = [
                    'no' => $no++,
                    'travel' => $value->travel_package->title,
                    'image' => '<img src="' . Storage::url($value->image) . '" width="300px" />',
                    'action' => '<a href="' . route('gallery.edit', $value->id) . '" class="btn btn-primary btn-sm"><i class="fa fa-pencil-alt"></i></a>
                                <a href="javascript:void(0)" data-remote="' . route('gallery.show', $value->id) . '?type=confirmation" data-toggle="modal" data-target="#modalConfirm" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></i></a>'
                ];
            }
            return response()->json(compact('data'));;
        }

        return view('pages.admin.gallery.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $travel_packages = TravelPackage::all();

        return view('pages.admin.gallery.create', compact('travel_packages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryRequest $request)
    {
        $data = $request->all();

        $data['image'] = $request->file('image')->store('assets/gallery', 'public');

        Gallery::create($data);

        return redirect()->route('gallery.index')->with('success', 'Galeri Paket Travel Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gallery = Gallery::findOrFail($id);

        if (request()->type == 'confirmation') {
            return view('pages.admin.gallery.confirmation', compact('gallery'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $travel_packages = TravelPackage::all();

        $gallery = Gallery::findOrFail($id);

        return view('pages.admin.gallery.edit', compact(['gallery', 'travel_packages']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GalleryRequest $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        Storage::delete('public/' . $gallery->image);

        $data = $request->all();
        $data['image'] = $request->file('image')->store('assets/gallery', 'public');

        $gallery->update($data);

        return redirect()->route('gallery.index')->with('success', 'Galeri Paket Travel Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);
        $gallery->delete();

        return redirect()->route('gallery.index')->with('success', 'Galeri Paket Travel Berhasil Dihapus');
    }
}
