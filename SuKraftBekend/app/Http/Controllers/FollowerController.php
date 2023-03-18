<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function get(int $followerID)
    {
        if ($followerID == 0){
            $models = Follower::all();
            $allModels = [];
            $i = 0;
            foreach ($models as $model) {
                $allModels[$i]["user"] = User::where("id",$model->userID)->first();
                $allModels[$i]["seller"] = Seller::where("id",$model->userID)->first();
                $i++;
            }
            return $allModels;
        }else{
            $model["user"] = User::where('id', $followerID)->firstOrFail();
            $model["seller"] = seller::where('id',$model['user']->id)->first();
            return $model;
        }
    }

    public function put(int $followerID,Request $request)
    {
        $follower = Follower::with('user')->where('id',$followerID)->firstOrFail();

        if ($request->userID){
            $follower->userID = $request->userID;
        }
        if ($request->sellerID){
            $follower->sellerID = $request->sellerID;
        }
        $follower->updated_at = now()->toDateTimeString();
        $follower->save();
        return "Follower ".$follower->user->firstName." ".$follower->user->lastName." updated successfully";
    }

    public function delete(int $followerID)
    {
        $follower = Follower::with('user')->where('id',$followerID)->firstOrFail();
        $follower->delete();
        return "Deleted follower ".$follower->user->firstName." ".$follower->user->lastName." with id of ".$followerID;
    }
}
