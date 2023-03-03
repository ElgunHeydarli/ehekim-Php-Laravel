<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::orderBy('name')->get();
        return view('admin.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.tags.create');
    }

    public function store(TagRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($data['name']);
        Tag::create($data);

        toastr('Açar söz əlavə olundu');
        return redirect()->route('tags');
    }

    public function edit($id)
    {
        $tag = Tag::find($id);
        return view('admin.tags.edit', compact('tag'));
    }

    public function update($id, TagRequest $request)
    {
        $tag = Tag::find($id);
        $data = $request->all();
        $data['slug'] = Str::slug($data['name']);
        $tag->update($data);

        toastr('Açar söz redaktə olundu');
        return redirect()->route('tags');
    }

    public function destroy($id)
    {
        $tag = Tag::find($id);
        try {
            $tag->delete();
            return response([
                'message' => 'Açar söz silindi',
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
