<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FileManager;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->all();
        if (is_null($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }
        if (Category::where('name', $data['name'])->first()) {
            toastr('Bu kateqoriya artıq mövcuddur', 'warning');
            return redirect()->back();
        }
        if($request->hasFile('icon')){
            $data['icon'] = FileManager::fileUpload($request->file('icon'),'icons');
        }
        Category::create($data);
        toastr('Kateqoriya əlavə olundu');
        return redirect()->route('categories');
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
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $data = $request->all();
        if (is_null($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }
        $category = Category::findOrFail($id);
        if (Category::where('id', '!=', $id)->where('name', $data['name'])->first()) {
            toastr('Bu kateqoriya artıq mövcuddur', 'warning');
            return redirect()->back();
        }
        if($request->hasFile('icon')){
            FileManager::fileDelete('icons',$category->icon);
            $data['icon'] = FileManager::fileUpload($request->file('icon'),'icons');
        }
        $category->update($data);
        toastr('Kateqoriya redaktə olundu');
        return redirect()->route('categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        try {
            $category->delete();
            return response([
                'message' => 'Kateqoriya silindi',
                'code' => 204
            ]);
        } catch (\Exception $ex) {
            return response([
                'message' => 'Xəta baş verdi',
                'code' => 500
            ]);
        }
    }
}
