<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfessionRequest;
use App\Models\Category;
use App\Models\Profession;
use App\Models\Tag;
use Illuminate\Support\Str;

class ProfessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $professions = Profession::orderBy('name')->get();
        return view('admin.professions.index', compact('professions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::select(['id', 'name'])->orderBy('name')->get();
        $tags = Tag::select(['id', 'name'])->orderBy('name')->get();
        return view('admin.professions.create', compact('tags', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfessionRequest $request)
    {
        $data = $request->all();
        if(is_null($data['slug'])){
            $data['slug'] = Str::slug($data['name']);
        }
        $profession = Profession::create($data);
        if (array_key_exists('category_id', $data)) {
            $profession->categories()->sync($data['category_id']);
        }

        if (array_key_exists('tag_id', $data)) {
            $profession->tags()->sync($data['tag_id']);
        }

        toastr('İxtisas əlavə olundu');
        return redirect()->route('professions');
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
        $profession = Profession::findOrFail($id);
        $categories = Category::select(['id', 'name'])->orderBy('name')->get();
        $tags = Tag::select(['id', 'name'])->orderBy('name')->get();
        return view('admin.professions.edit', compact('tags', 'categories', 'profession'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfessionRequest $request, $id)
    {
        $data = $request->all();
        $profession = Profession::find($id);
        $profession->update($data);
        if (array_key_exists('category_id', $data)) {
            $profession->categories()->sync($data['category_id']);
        }

        if (array_key_exists('tag_id', $data)) {
            $profession->tags()->sync($data['tag_id']);
        }

        toastr('İxtisas əlavə olundu');
        return redirect()->route('professions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profession = Profession::find($id);

        try {
            foreach ($profession->tags as $tag) {
                $tag->pivot->delete();
            }
            foreach ($profession->categories as $category) {
                $category->pivot->delete();
            }
            $profession->delete();
            return response([
                'message' => 'Ixtisas silindi',
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
