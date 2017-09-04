<?php

namespace App\Http\Controllers\API;

use App\Services\ImageProcessingService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function imageUpload(Request $request): JsonResponse {
        $this->validate($request, [
            'file' => 'required|image'
        ]);
        $image = ImageProcessingService::processImage($request->file('file'));
        return response()->json($image);
    }

    public function search(Request $request): JsonResponse {
        $this->validate($request, [
            'term' => 'required|string'
        ]);
        $users = User::getUsersFromSupervisorLabel($request->input('term'));
        $userList = [];
        foreach($users as $user) {
            $userList[] = $user['supervisorLabel'];
        }
        return response()->json($userList);
    }
}
