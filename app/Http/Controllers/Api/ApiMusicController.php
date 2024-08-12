<?php

namespace App\Http\Controllers\Api;

use App\Models\musicians;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ApiMusicResoucre;

class ApiMusicController extends Controller
{
    //
    public function index(Request $request)
    {
        $listMusic = musicians::query()->get();
        return ApiMusicResoucre::collection($listMusic);
    }

    public function store(Request $request)
    {
        if ($request->isMethod('POST')) {
            $params = $request->all();
            if ($request->hasFile('profile_picture')) {
                $params['profile_picture'] = $request->file('profile_picture')->store('uploads/imageMusic', 'public') ?: null;
            }
            $music =  musicians::create($params);
            return response()->json(['message' => 'them thanh cong', 'data' => $music]);
        }
    }

    public function show($id)
    {
        $music = musicians::query()->findOrFail($id);
        return new ApiMusicResoucre($music);
    }

    public function update(Request $request, $id)
    {
        if ($request->isMethod('PUT')) {
            $params = $request->all();
            $music = musicians::query()->findOrFail($id);
            if ($request->hasFile('profile_picture')) {
                if ($music->profile_picture) {
                    Storage::disk('public')->delete($music->profile_picture);
                }
                $params['profile_picture'] = $request->file('profile_picture')->store('uploads/imageMusic', 'public') ?: null;
            }
            $music->update($params);
            return response()->json(['message' => 'update thanh cong', 'data' => $music]);
        }
    }
    public function destroy(Request $request, $id)
    {
        if ($request->isMethod('DELETE')) {
            $music = musicians::query()->findOrFail($id);
            $music->delete();
            return response()->json(['message' => 'Xoa thanh cong'], 200);
        }
    }
}
