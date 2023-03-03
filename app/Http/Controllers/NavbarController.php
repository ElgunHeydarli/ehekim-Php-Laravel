<?php

namespace App\Http\Controllers;

use App\Http\Requests\NavbarRequest;
use App\Models\Navbar;
use Illuminate\Http\Request;

class NavbarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $navbars = Navbar::orderBy('order','desc')->get();
        return view('admin.navbar.index',compact('navbars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.navbar.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NavbarRequest $request)
    {
        $data = $request->all();
        Navbar::create($data);

        toastr('Navbar əlavə olundu');
        return redirect()->route('admin.navbars');
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
        $navbar = Navbar::findOrFail($id);
        return view('admin.navbar.edit',compact('navbar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NavbarRequest $request, $id)
    {
        $data = $request->all();
        $navbar = Navbar::findOrFail($id);
        $navbar->update($data);

        toastr('Navbar yeniləndi');
        return redirect()->route('admin.navbars');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $navbar = Navbar::find($id);
        try {
            $navbar->delete();
            return response([
                'message'=>'Navbar silindi',
                'code'=>204,
            ]);
        } catch (\Exception $ex) {
            return response([
                'message'=>'Silərkən xəta baş verdi',
                'code'=>500,
            ]);
        }
    }
}
