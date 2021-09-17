<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExperienceAddRequest;
use App\Http\Requests\ExperienceRequest;
use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function list(){
        $list= Experience::all();

        return view('admin.experience_list', compact('list'));
    }

    public function addShow(Request $request){
        $id = $request->experienceID;
        $experience = null;
        if(!is_null($id)){
            $experience = Experience::find($id);

        }
        return view('admin.experience_add', compact('experience'));
    }

    public function add(ExperienceRequest $request){
        $status = 0;
        $order = $request->order;

        if(isset($request->status)){
            $status = 1;
        }

        if(isset($request->experienceID)){

            $id = $request->experienceID;
            Experience::where("id",$id)
                ->update([
                    "experience_date" => $request->experience_date,
                    "experience_info" => $request->experience_info,
                    "description" => $request->description,
                    "status" => $status,
                    "order" => $order ? $order : 999
                ]);
            alert()->success('Başarılı', $id . " ID'sine sahip Eğitim bilgisi güncellendi.")->showConfirmButton('Tamam', '#3085d6')->persistent(true,true);

            return redirect()->route('admin.experience.list');

        }else{
            Experience::create([
                "experience_date" => $request->experience_date,
                "experience_info" => $request->experience_info,
                "description" => $request->description,
                "status" => $status,
                "order" => $order ? $order : 999
            ]);
            alert()->success('Başarılı','Eğitim bilgisi eklendi.')->showConfirmButton('Tamam', '#3085d6')->persistent(true,true);

            return redirect()->route('admin.experience.list');
        }
    }

    public function changeStatus(Request $request)
    {
        $id= $request->experienceID;

        $findExperience = Experience::find($id);
        $status = $findExperience->status;
        if($status){
            $status = 0;
            $newStatus = "Pasif";
        }
        else {
            $status = 1;
            $newStatus = "Aktif";
        }

        $findExperience->status = $status;
        $findExperience->save();
        return response()->json([
            'newStatus' => $newStatus,
            'experienceID' => $id,
            'status' => $status
        ], 200);
    }

    public function delete(Request $request)
    {
        $id = $request->experienceID;
        Experience::where('id',$id)->delete();
        return response()->json([],200);
    }
}
