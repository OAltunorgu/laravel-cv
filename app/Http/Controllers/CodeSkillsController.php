<?php

namespace App\Http\Controllers;

use App\Models\CodeSkills;
use Illuminate\Http\Request;

class CodeSkillsController extends Controller
{
    public function list(){
        $list= CodeSkills::all();

        return view('admin.code_skills_list', compact('list'));
    }

    public function addShow(Request $request){
        $codeSkills = null;
        $codeSkillsID = $request->codeSkillsID;
        if($codeSkillsID){
            $codeSkills = CodeSkills::find($codeSkillsID);
        }
        return view('admin.code_skills_add',compact('codeSkills'));
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
        $codeSkillsID = $request->codeSkillsID;

        if($request->codeSkillsID){
            CodeSkills::where('id',$codeSkillsID)->update($data);
            alert()->success('Başarılı', "Kod becerileri düzenlendi!")->showConfirmButton('Tamam', '#3085d6')->persistent(true,true);

        }else{
            CodeSkills::create($data);
            alert()->success('Başarılı', "Kod becerileri eklendi!")->showConfirmButton('Tamam', '#3085d6')->persistent(true,true);
        }
        return redirect()->route('admin.codeSkills.list');
    }

    public function delete(Request $request){
        $codeSkillsID = $request->codeSkillsID;
        CodeSkills::where('id',$codeSkillsID)->delete();
        return response()->json(['message' => 'Başarılı'],200);
    }

    public function changeStatus(Request $request)
    {
        $id= $request->codeSkillsID;

        $findCodeSkills = CodeSkills::find($id);
        $status = $findCodeSkills->status;
        if($status){
            $status = 0;
            $newStatus = "Pasif";
        }
        else {
            $status = 1;
            $newStatus = "Aktif";
        }

        $findCodeSkills->status = $status;
        $findCodeSkills->save();
        return response()->json([
            'newStatus' => $newStatus,
            'codeSkillsID' => $id,
            'status' => $status
        ], 200);
    }


}
