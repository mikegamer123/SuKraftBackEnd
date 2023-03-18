<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Media;
use App\Models\Post;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function declareAdmin(Request $request)
    {

        $token = $request->bearerToken();
        $user = User::where('api_token', $token)->firstOrFail();
        if ($user->userType == 'admin') {
            return true;
        } else {
            return false;
        }
    }

    public function get(Request $request, $id = 0)
    {
//        if(!$this->declareAdmin($request)){
//            return "Unathorized";
//        }

        if ($id == 0) {
            $models = Like::all();
            $allModels = [];
            $i = 0;
            foreach ($models as $model) {
                $allModels[$i]["user"] = User::where("id", $model->userID)->first();
                $allModels[$i]["seller"] = Seller::where("userID", $allModels[$i]["user"]->id)->first();
                $allModels[$i]["post"] = Post::where("sellerID", $allModels[$i]["seller"]->id)->first();
                $allModels[$i]["media"] = Media::where("id", $allModels[$i]["seller"]->userID)->first();
                $allModels[$i]["like"] = $model;
                $i++;
            }
            return $allModels;
        } else {
            $model["like"] = Like::where('id', $id)->firstOrFail();
            $model["user"] = User::where("id", $model['like']->userID)->first();
            $model["seller"] = Seller::where("id", $model['like']->id)->first();
            $model["media"] = Media::where('id', $model["seller"]->mediaID)->first();
            return $model;
        }
    }
}
