<?php

namespace App\Http\Controllers;

use App\Models\Skills;
use Illuminate\Http\Request;

class SkillsController extends Controller
{
    public function list(){
        $list= Skills::all();

        return view('admin.skills_list', compact('list'));
    }

    public function addShow(Request $request){
        $skills = null;
        $skills = $request->skillsID;
        if($skills){
            $skills = skills::find($skills);
        }
        return view('admin.skills_add',compact('skills'));
    }

    public function add(Request $request){
        $data=[
            'name' => $request->name,
            'detail' => $request->detail,
            'icon' => $request->icon,
        ];

        if($request->status){
            $data['status'] = 1;
        }
        $skillsID = $request->skillsID;

        if($request->skillsID){
            Skills::where('id',$skillsID)->update($data);
            alert()->success('Başarılı', "Becerisi düzenlendi!")->showConfirmButton('Tamam', '#3085d6')->persistent(true,true);

        }else{
            Skills::create($data);
            alert()->success('Başarılı', "Becerisi eklendi!")->showConfirmButton('Tamam', '#3085d6')->persistent(true,true);
        }
        return redirect()->route('admin.skills.list');
    }

    public function delete(Request $request){
        $skillsID = $request->skillsID;
        Skills::where('id',$skillsID)->delete();
        return response()->json(['message' => 'Başarılı'],200);
    }

    public function changeStatus(Request $request)
    {
        $id= $request->skillsID;

        $findSkills = Skills::find($id);
        $status = $findSkills->status;
        if($status){
            $status = 0;
            $newStatus = "Pasif";
        }
        else {
            $status = 1;
            $newStatus = "Aktif";
        }

        $findSkills->status = $status;
        $findSkills->save();
        return response()->json([
            'newStatus' => $newStatus,
            'skillsID' => $id,
            'status' => $status
        ], 200);
    }

}
