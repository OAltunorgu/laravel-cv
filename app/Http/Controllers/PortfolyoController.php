<?php

namespace App\Http\Controllers;

use App\Http\Requests\PortfolyoRequest;
use App\Models\Portfolyo;
use App\Models\PortfolyoImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Exception;


class PortfolyoController extends Controller
{
    public function index()
    {
        $list = Portfolyo::with('featuredImage')->get();
        return view('admin.portfolyo_list', compact('list'));
    }

    public function create()
    {
        return view('admin.portfolyo_add');
    }

    public function store(PortfolyoRequest $request)
    {
        $portfolyo = Portfolyo::create([
            'title' => $request->title,
            'tags' => $request->tags,
            'about' => $request->about,
            'website' => $request->website,
            'keywords' => $request->keywords,
            'description' => $request->description,
            'status' => $request->status ? 1:0
        ]);

        if ($request->file('images')){
            $now = now()->format('YmdHis');
            $sayac = 0;
            foreach ($request->file('images') as $image){
                $extension = $image->getClientOriginalExtension();
                $name = $image->getClientOriginalName();
                $slugName = Str::slug($name, '-') . '_' . $now . '.' . $extension;
                $publicPath = 'public/';
                $path = 'portfolyo/';

                Storage::putFileAs($publicPath . $path, $image, $slugName);

                PortfolyoImage::create([
                   'portfolyo_id' => $portfolyo->id,
                    'image' => $slugName,
                    'featured' => $sayac == 0 ? 1 : 0,
                    'status' => 1
                ]);
                $sayac = 1;
            }
        }

        alert()->success('Başarılı', 'Portfolyo eklendi.')->showConfirmButton('Tamam', '#3085d6')->persistent(true,true);

        return redirect()->route('portfolyo.index');

    }

    public function show($id)
    {
        //
    }

    public function showImages(Request $request, $id)
    {
        $images = PortfolyoImage::where('portfolyo_id', $id)->get();

        return view('admin.portfolyo_list_images', compact('images'));
    }

    public function newImage(Request $request, $id)
    {

        if ($request->file('images'))
        {
            $now = now()->format('YmdHis');
            foreach ($request->file('images') as $image)
            {
                $extension = $image->getClientOriginalExtension();
                $name = explode('.', $image->getClientOriginalName());
                $slugName = Str::slug($name[0], '-') . '_' . $now . '.' . $extension;
                $publicPath = 'public/';
                $path = 'portfolyo/';
                Storage::putFileAs($publicPath . $path, $image, $slugName);

                PortfolyoImage::create([
                    'portfolyo_id' => $id,
                    'image' => $slugName,
                    'featured' => 0,
                    'status' => 1
                ]);
            }
        }

        alert()->success('Başarılı', 'Portfolyo resim eklendi.')
            ->showConfirmButton('Tamam', '#3085d6')
            ->persistent(true, true);
        return redirect()->back();
    }

    public function deleteImage(Request $request, $id)
    {
        try
        {
            $image = PortfolyoImage::find($id);
            if ($image)
            {
                if (file_exists('storage/portfolyo/' . $image->image))
                {
                    unlink('storage/portfolyo/' . $image->image);
                }
                $image->delete();
            }
        }
        catch (Exception $exception)
        {
            return response()->json(['errorMessage' => $exception->getMessage()], 500);
        }

        return response()->json(['success' => true], 200);
    }

    public function featureImage(Request $request, $id)
    {
        try
        {
            $image = PortfolyoImage::find($id);
            if ($image)
            {
                PortfolyoImage::where('portfolyo_id', $image->portfolyo_id)
                    ->update([
                        'featured' => 0
                    ]);
                $image->featured = 1;
                $image->save();
            }
        }
        catch (Exception $exception)
        {
            return response()->json(['errorMessage' => $exception->getMessage()], 500);
        }

        return response()->json(['success' => true], 200);
    }

    public function edit($id)
    {
        $portfolyo = Portfolyo::find($id);
        return view('admin.portfolyo_add',compact('portfolyo'));
    }

    public function update(Request $request, $id)
    {
        $portfolyo = Portfolyo::where('id', $id)
            ->update([
                'title' => $request->title,
                'tags' => $request->tags,
                'about' => $request->about,
                'keywords' => $request->keywords,
                'description' => $request->description,
                'website' => $request->website,
                'status' => $request->status ? 1 : 0
            ]);

        alert()->success('Başarılı', 'Portfolyo güncellendi.')
            ->showConfirmButton('Tamam', '#3085d6')
            ->persistent(true, true);
        return redirect()->route('portfolyo.index');
    }

    public function destroy($id)
    {
        try
        {
            $portfolyo = Portfolyo::find($id);
            if ($portfolyo)
            {
                $portfolyo->delete();
            }
        }
        catch (\Exception $exception)
        {
            return response()->json(['errorMessage' => $exception->getMessage()], 500);

        }
        return response()->json(['success' => true], 200);
    }

    public function changeStatus(Request $request)
    {
        $id= $request->portfolyoID;
        $newStatus = null;
        $findPortfolyo = Portfolyo::find($id);
        if($findPortfolyo->status){
            $status = 0;
            $newStatus = "Pasif";
        }
        else {
            $status = 1;
            $newStatus = "Aktif";
        }

        $findPortfolyo->status = $status;
        $findPortfolyo->save();
        return response()->json([
            'newStatus' => $newStatus,
            'portfolyoID' => $id,
            'status' => $status
        ], 200);
    }

    public function changeStatusImage(Request $request)
    {
        $id= $request->portfolyoID;
        $newStatus = null;
        $findPortfolyo = PortfolyoImage::find($id);
        if($findPortfolyo->status){
            $status = 0;
            $newStatus = "Pasif";
        }
        else {
            $status = 1;
            $newStatus = "Aktif";
        }

        $findPortfolyo->status = $status;
        $findPortfolyo->save();
        return response()->json([
            'newStatus' => $newStatus,
            'id' => $id,
            'status' => $status
        ], 200);
    }
}
