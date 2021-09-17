<?php

namespace App\Http\Controllers;

use App\Models\DesignSkills;
use Illuminate\Http\Request;

class DesignSkillsController extends Controller
{
    public function list(){
        $list= DesignSkills::all();

        return view('admin.design_skills_list', compact('list'));
    }

    public function addShow(Request $request){
        $designSkills = null;
        $designSkillsID = $request->designSkillsID;
        if($designSkillsID){
            $designSkills = DesignSkills::find($designSkillsID);
        }
        return view('admin.design_skills_add',compact('designSkills'));
    }

    public function add(Request $request){
        $data=[
            'skill_name' => $request->skill_name,
            'level' => $request->level,
            'order'=> $request->order,
        ];

        if($request->status){
            $data['status'] = 1;
        }
        $designSkillsID = $request->designSkillsID;

        if($request->designSkillsID){
            DesignSkills::where('id',$designSkillsID)->update($data);
            alert()->success('Başarılı', "Tasarım becerileri düzenlendi!")->showConfirmButton('Tamam', '#3085d6')->persistent(true,true);

        }else{
            DesignSkills::create($data);
            alert()->success('Başarılı', "Tasarım becerileri eklendi!")->showConfirmButton('Tamam', '#3085d6')->persistent(true,true);
        }
        return redirect()->route('admin.designSkills.list');
    }

    public function delete(Request $request){
        $designSkillsID = $request->designSkillsID;
        DesignSkills::where('id',$designSkillsID)->delete();
        return response()->json(['message' => 'Başarılı'],200);
    }

    public function changeStatus(Request $request)
    {
        $id= $request->designSkillsID;

        $findDesignSkills = DesignSkills::find($id);
        $status = $findDesignSkills->status;
        if($status){
            $status = 0;
            $newStatus = "Pasif";
        }
        else {
            $status = 1;
            $newStatus = "Aktif";
        }

        $findDesignSkills->status = $status;
        $findDesignSkills->save();
        return response()->json([
            'newStatus' => $newStatus,
            'designSkillsID' => $id,
            'status' => $status
        ], 200);
    }


}
