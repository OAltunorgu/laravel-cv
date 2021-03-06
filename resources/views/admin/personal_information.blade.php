@extends('layouts.admin')

@section('title')
    Kişisel Bilgiler
@endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/ckeditor/samples/css/samples.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css') }}">
@endsection

@section('content')
    <div class="page-header">
        <h3 class="page-title">Kişisel Bilgiler</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Admin Panel</a></li>
                <li class="breadcrumb-item active" aria-current="page">Kişisel Bilgiler Düzenleme</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample" id="createEducationForm" method="POST" action="" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="main_title">Anasayfa Başlık</label>
                            <input type="text" class="form-control" name="main_title" id="main_title" placeholder="Anasayfa Başlık" value="{{$information->main_title}}">
                            @error('main_title')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="editor1">Hakkımda Yazısı</label>
                            <textarea cols="80" id="editor1" name="about_text" rows="10" data-sample="1"
                                      data-sample-short="">
                                {!! $information->about_text !!}
                            </textarea>
                        </div>

                        <div class="form-group">
                            <label for="full_name">Ad Soyad</label>
                            <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Anasayfa Başlık" value="{{$information->full_name}}">
                            @error('full_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="title">Başlık</label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="Başlık" value="{{$information->title}}">
                            @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="image">Resim</label>
                                    <input type="file" class="form-control" name="image" id="image">
                                    @error('image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <img width="50%"
                                         src="{{ asset($information->image ? 'storage/'. $information->image : 'assets/images/faces/face15.jpg') }}">                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="task_name">Pozisyon</label>
                            <input type="text" class="form-control" name="task_name" id="task_name" placeholder="Anasayfa Başlık" value="{{$information->task_name}}">
                            @error('task_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="birthday">Doğum Tarihi</label>
                            <input type="text" class="form-control" name="birthday" id="birthday" placeholder="Doğum Tarihi" value="{{$information->birthday}}">
                            @error('birthday')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="website">Web Site</label>
                            <input type="text" class="form-control" name="website" id="website" placeholder="Web Site" value="{{$information->website}}">
                            @error('website')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone">Telefon Numarası</label>
                            <input type="text" class="form-control" name="phone" id="phone" placeholder="Telefon Numarası" value="{{$information->phone}}">
                            @error('phone')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="mail">Mail Adresi</label>
                            <input type="text" class="form-control" name="mail" id="mail" placeholder="Mail Adresi" value="{{$information->mail}}">
                            @error('mail')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="address">Adres</label>
                            <input type="text" class="form-control" name="address" id="address" placeholder="Adres" value="{{$information->address}}">
                            @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mr-2" id="createButton">Kaydet</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
    <script src=" {{ asset('assets/ckeditor/samples/js/sample.js') }}"></script>
    <script>
        var editor1 = CKEDITOR.replace('editor1', {
            extraAllowedContent: 'div',
            height: 150
        });
    </script>
@endsection

