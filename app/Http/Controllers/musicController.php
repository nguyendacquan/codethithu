<?php

namespace App\Http\Controllers;

use App\Models\musicians;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class musicController extends Controller
{
    //

    public function index()
    {
        $listMusic = musicians::query()->get();
        return view("clients.index", compact("listMusic"));
    }

    public function create()
    {
        return view("clients.create");
    }
    public function store(Request $request)
    {
        if ($request->isMethod('POST')) {
            $params = $request->except('_token');
            if ($request->hasFile('profile_picture')) {
                $params['profile_picture'] = $request->file('profile_picture')->store('uploads/imageMusic', 'public') ?: null;
            }
            musicians::create($params);
            return redirect()->route('music.index')->with('success', 'Them thanh cong !');
        }
    }

    public function show($id) {}

    public function edit($id)
    {
        $music = musicians::query()->findOrFail($id);
        return view('clients.edit', compact('music'));
    }
    public function update(Request $request, $id)
    {
        if ($request->isMethod('PUT')) {
            $params = $request->except('_token', '_method');
            $music = musicians::query()->findOrFail($id);
            if ($request->hasFile('profile_picture')) {
                if ($music->profile_picture) {
                    Storage::disk('public')->delete($music->profile_picture);
                }
                $params['profile_picture'] = $request->file('profile_picture')->store('uploads/imageMusic', 'public') ?: null;
            }
            $music->update($params);
            return redirect()->route('music.index')->with('success', 'Update thanh cong !');
        }
    }
    public function destroy(Request $request, $id)
    {
        if ($request->isMethod('DELETE')) {
            $music = musicians::query()->findOrFail($id);
            $music->delete();
            return redirect()->route('music.index')->with('success', 'Xoa thanh cong');
        }
    }
}
