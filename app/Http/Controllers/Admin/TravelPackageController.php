<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TravelPackageRequest;
use App\Models\TravelPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TravelPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $travel_package = TravelPackage::orderBy('id', 'DESC')->get();

        if (request()->ajax()) {
            $data = [];
            $no   = 1;
            foreach ($travel_package as $key => $value) {
                $data[] = [
                    'no' => $no++,
                    'title' => $value->title,
                    'location' => $value->location,
                    'departure_date' => date('d-m-Y', strtotime($value->departure_date)),
                    'type' => $value->type,
                    'action' => '<a href="javascript:void(0)" data-remote="' . route('travel-package.show', $value->id) . '" data-toggle="modal" data-target="#myModal" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a> 
                                <a href="' . route('travel-package.edit', $value->id) . '" class="btn btn-primary btn-sm"><i class="fa fa-pencil-alt"></i></a>
                                <a href="javascript:void(0)" data-remote="' . route('travel-package.show', $value->id) . '?type=confirmation" data-toggle="modal" data-target="#modalConfirm" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></i></a>'
                ];
            }
            return response()->json(compact('data'));;
        }

        return view('pages.admin.travel-package.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.travel-package.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TravelPackageRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        TravelPackage::create($data);

        return redirect()->route('travel-package.index')->with('success', 'Paket Travel Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = TravelPackage::findOrFail($id);

        if (request()->type == 'confirmation') {
            return view('pages.admin.travel-package.confirmation', compact('item'));
        }

        return view('pages.admin.travel-package.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = TravelPackage::findOrFail($id);

        return view('pages.admin.travel-package.edit')->with([
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TravelPackageRequest $request, $id)
    {
        $item = TravelPackage::findOrFail($id);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        $item->update($data);

        return redirect()->route('travel-package.index')->with('success', 'Paket Travel Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = TravelPackage::findOrFail($id);
        $item->delete();

        return redirect()->route('travel-package.index')->with('success', 'Paket Travel Berhasil Dihapus');
    }
}
