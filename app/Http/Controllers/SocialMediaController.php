<?php

namespace App\Http\Controllers;

use App\Models\SocialMedia;
use Illuminate\Http\Request;

class SocialMediaController extends Controller
{
    public function list(){
        $list = SocialMedia::all();
        return view('admin.social_media_list', compact('list'));
    }

    public function addShow(Request $request){
        $socialMedia = null;
        $socialMediaID = $request->socialMediaID;
        if($socialMediaID){
            $socialMedia = SocialMedia::find($socialMediaID);
        }
        return view('admin.social_media_add',compact('socialMedia'));
    }

    public function add(Request $request){
        $data=[
            'name' => $request->name,
            'link' => $request->link,
            'order'=> $request->order,
            'icon'=> $request->icon,
        ];

        if($request->status){
            $data['status'] = 1;
        }
        $socialMediaID = $request->socialMediaID;

        if($request->socialMediaID){
            SocialMedia::where('id',$socialMediaID)->update($data);
            alert()->success('Başarılı', "Sosyal medya hesabınız düzenlendi!")->showConfirmButton('Tamam', '#3085d6')->persistent(true,true);

        }else{
            SocialMedia::create($data);
            alert()->success('Başarılı', "Sosyal medya hesabınız eklendi!")->showConfirmButton('Tamam', '#3085d6')->persistent(true,true);
        }
        return redirect()->route('admin.socialMedia.list');
    }

    public function delete(Request $request){
        $socialMediaID = $request->socialMediaID;
        SocialMedia::where('id',$socialMediaID)->delete();
        return response()->json(['message' => 'Başarılı'],200);
    }

    public function changeStatus(Request $request)
    {
        $id= $request->socialMediaID;

        $findSocialMedia = SocialMedia::find($id);
        $status = $findSocialMedia->status;
        if($status){
            $status = 0;
            $newStatus = "Pasif";
        }
        else {
            $status = 1;
            $newStatus = "Aktif";
        }

        $findSocialMedia->status = $status;
        $findSocialMedia->save();
        return response()->json([
            'newStatus' => $newStatus,
            'socialMediaID' => $id,
            'status' => $status
        ], 200);
    }

}
