<?php

namespace App\Http\Controllers;

use App\Models\PersonalInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class PersonalInformationController extends Controller
{
    public function index()
    {
        $information = PersonalInformation::find(1);

        return view('admin.personal_information', compact('information'));
    }

    public function update(Request $request)
    {
        $this->validate($request,
            [
                'image' => 'mimes:jpeg,jpg,png',
            ],
            [
                'image.mimes' => 'Seçilen resim yalnızca .jpeg, .jpg, .png uzantılı olabilir.',
            ]);

        $information = PersonalInformation::find(1);

        if ($request->file('image'))
        {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileOriginalName = $file->getClientOriginalName();
            $explode = explode('.', $fileOriginalName);
            $fileOriginalName = Str::slug($explode[0], '-') . '_' . now()->format('d-m-Y_H-i-s') . '.' . $extension;

            Storage::putFileAs('public/image', $file, $fileOriginalName);
            $information->image = 'image/' . $fileOriginalName;

        }

        $information->main_title = $request->main_title;
        $information->about_text = $request->about_text;
        $information->full_name = $request->full_name;
        $information->title = $request->title;
        $information->task_name = $request->task_name;
        $information->birthday = $request->birthday;
        $information->website = $request->website;
        $information->phone = $request->phone;
        $information->mail = $request->mail;
        $information->address = $request->address;

        $information->save();


        alert()->success('Başarılı', "Kişisel bilgileriniz güncellendi")
            ->showConfirmButton('Tamam', '#3085d6')
            ->persistent(true, true);

        return redirect()->back();
    }
}
