<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FileManager;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::orderBy('created_at', 'desc')->get();
        return view('admin.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'image' => 'required|max:500|mimes:png,jpg'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        if ($request->hasFile('image')) {
            $data['image'] = FileManager::fileUpload($request->file('image'), 'banners');
        }
        Banner::create($data);

        toastr('Banner əlavə edildi');
        return redirect()->route('banners');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banner = Banner::find($id);
        return view('admin.banners.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $banner = Banner::find($id);
        $validator = Validator::make($data, [
            'image' => 'max:500|mimes:png,jpg'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        if ($request->hasFile('image')) {
            FileManager::fileDelete('banners', $banner->image);
            $data['image'] = FileManager::fileUpload($request->file('image'), 'banners');
        }

        toastr('Banner redaktə edildi');
        return redirect()->route('banners');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::find($id);
        try {
            FileManager::fileDelete('banners',$banner->image);
            $banner->delete();
            return response([
                'message' => 'Banner silindi',
                'code' => 204
            ]);
        } catch (\Exception $ex) {
            return response([
                'message' => 'Silərkən xəta baş verdi',
                'code' => 500
            ]);
        }
    }
}
