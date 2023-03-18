<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function get(int $followerID)
    {
        if ($followerID == 0){
            return Follower::all();
        }

        return Follower::where('id',$followerID)->firstOrFail();
    }

    public function put(int $followerID,Request $request)
    {
        $follower = Follower::with('user', 'seller')->where('id',$followerID)->firstOrFail();

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
        $follower = Follower::with('user', 'seller')->where('id',$followerID)->firstOrFail();
        $follower->delete();
        return "Deleted follower ".$follower->user->firstName." ".$follower->user->lastName." with id of ".$followerID;
    }
}
