<?php

namespace App\Http\Controllers;

use App\Models\CodeSkills;
use App\Models\DesignSkills;
use App\Models\Education;
use App\Models\Experience;
use App\Models\PersonalInformation;
use App\Models\Portfolyo;
use App\Models\Skills;
use App\Models\SocialMedia;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(){
        $designSkillsList = DesignSkills::query()
            ->statusActive()
            //->where('status',1)
            ->select('skill_name','level')
            ->orderBy('order', 'asc')
            ->get();

        $codeSkillsList = CodeSkills::query()
            ->statusActive()
            //->where('status',1)
            ->select('skill_name','level')
            ->orderBy('order', 'asc')
            ->get();

        $skillsList = Skills::query()
            ->statusActive()
            //->where('status',1)
            ->select('name','detail', 'icon')
            ->get();

        return view('pages.index', compact('designSkillsList', 'codeSkillsList', 'skillsList'));
    }

    public function resume(){
        $educationList = Education::query()
            ->statusActive()
            //           ->where('status',1)
            ->select('education_date','education_info','description')
            ->orderBy('order', 'asc')
            ->get();

        $experienceList = Experience::query()
            ->statusActive()
            //           ->where('status',1)
            ->select('experience_date','experience_info','description')
            ->orderBy('order', 'asc')
            ->get();

        $personal = PersonalInformation::find(1);
        return view('pages.resume', compact('educationList','experienceList'));
    }

    public function portfolyo(){
        $portfolyo = Portfolyo::with('featuredImage')
            ->where('status',1)
            ->orderByDesc('id')
            ->get();
        return view('pages.portfolyo',compact('portfolyo'));
    }

    public function portfolyoDetail($id){
        $portfolyo = Portfolyo::with('images')
            ->where('status',1)
            ->where('id',$id)
            ->first();

        if(is_null($portfolyo)){
            abort(404,'Portfolyo bulunamadı.');
        }
        return view('pages.portfolyoDetail',compact('portfolyo'));
    }

    public function blog(){
        return view('pages.blog');
    }

    public function iletisim(){
        return view('pages.iletisim');
    }
}
