@extends('layouts.admin')

@section('title')
    Portfolyo Yönetimi
@endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/ckeditor/samples/css/samples.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css') }}">
@endsection

@section('content')
    <div class="page-header">
        <h3 class="page-title">Portfolyo Yönetimi</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Admin Panel</a></li>
                <li class="breadcrumb-item active" aria-current="page">Portfolyo Yönetimi</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample" id="portfolyoForm" method="POST"
                          action="{{ isset($portfolyo) ? route('portfolyo.update', ['portfolyo' => request('portfolyo')]) : route('portfolyo.store') }}" enctype="multipart/form-data">
                        @csrf
                        @isset($portfolyo)
                            @method('PUT')
                        @endisset
                        <div class="form-group">
                            <label for="title">Başlık</label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="Başlık" value="{{$portfolyo->title ?? ''}}">
                            @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tags">Etiketler</label>
                            <input type="text" class="form-control" name="tags" id="tags" placeholder="Etiketler" value="{{$portfolyo->tags ?? ''}}">
                            @error('tags')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="about">Portfolyo Hakkında</label>
                            <textarea cols="80" id="about" name="about" rows="10">{!! $portfolyo->about ?? ''!!}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="website">Web Sitesi</label>
                            <input type="text" class="form-control" name="website" id="website" placeholder="Web site" value="{{$portfolyo->website ?? ''}}">
                            @error('website')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="keywords">Keywords</label>
                            <input type="text" class="form-control" name="keywords" id="keywords" placeholder="Keywords" value="{{$portfolyo->keywords ?? ''}}">
                            @error('keywords')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" name="description" id="description" placeholder="Description" value="{{$portfolyo->description ?? ''}}">
                            @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        @isset($portfolyo)
                        @else
                        <div class="form-group">
                                <label class="form-check-label" for="images">Portfolyo Görseli
                                </label><br>
                                <input type="file" multiple name="images[]" id="images">
                            @if($errors->has('images.*'))
                                @foreach($errors->get('images.*') as $key => $value)
                                    <div class="alert alert-danger">{{$errors->first($key)}}</div>
                                @endforeach
                            @endif
                        </div>
                        @endisset
                        <div class="form-group">
                            <div class="form-check form-check-success">
                                <label class="form-check-label" for="status">

                                    <input type="checkbox" name="status" id="status" class="form-check-input"
                                        {{isset($portfolyo) ? ($portfolyo->status ? 'checked' : '') : ''}}>Status
                                </label>
                            </div>
                        </div>

                        <button type="button" class="btn btn-primary mr-2" id="createButton">{{isset($portfolyo) ? 'Güncelle' : 'Kaydet'}}</button>
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
        var options = {
            filebrowserImageBrowseUrl: '/admin/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/admin/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/admin/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/admin/laravel-filemanager/upload?type=Files&_token='
        };

        var about = CKEDITOR.replace('about', options);

        @isset($portfolyo)
        $('#createButton').click(function (){
            if ($('#title').val().trim() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Uyarı!',
                    text: "Başlık alanı boş bırakılamaz.",
                    confirmButtonText: "Tamam"
                });
            }
            else if ($('#tags').val().trim() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Uyarı!',
                    text: "Etiket alanı boş bırakılamaz.",
                    confirmButtonText: "Tamam"
                });
            }
            else {
                $('#portfolyoForm').submit();
            }
        });
        @else
        $('#images').change(function (){
            let images = $(this);
            let imageCheckStatus = imageCheck(images);

        });

        function imageCheck(images) {
            let length = images[0].files.length;
            let files = images[0].files;
            let checkImage = ['png', 'jpg', 'jpeg'];

            for (let i = 0; i < length; i++) {
                let type = files[i].type.split('/').pop();
                let size = files[i].size;
                if ($.inArray(type, checkImage) == '-1') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Uyarı!',
                        text: "Seçilen " + files[i].name + "'ine sahip resim belirlenen formatlarda değildir. .png, .jpg, .jpeg formatlarından birisi olmalıdır.",
                        confirmButtonText: "Tamam"
                    });
                    return false;
                }
                if (size > 2048000) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Uyarı!',
                        text: "Seçilen " + files[i].name + "'i resmi 2MB'tan fazla olamaz.",
                        confirmButtonText: "Tamam"
                    });
                    return false;
                }
            }
            return true;
        }

        $('#createButton').click(function (){
               let imageCheckStatus = imageCheck($('#images'));

               if(!imageCheckStatus){
                   Swal.fire({
                       icon: 'error',
                       title: 'Uyarı!',
                       text: "Seçilen resimleri kontrol ediniz.",
                       confirmButtonText: "Tamam"
                   });
               }
               else if ($('#title').val().trim() == '') {
                   Swal.fire({
                       icon: 'error',
                       title: 'Uyarı!',
                       text: "Başlık alanı boş bırakılamaz.",
                       confirmButtonText: "Tamam"
                   });
               }
               else if ($('#tags').val().trim() == '') {
                   Swal.fire({
                       icon: 'error',
                       title: 'Uyarı!',
                       text: "Etiket alanı boş bırakılamaz.",
                       confirmButtonText: "Tamam"
                   });
               }
               else {
                   $('#portfolyoForm').submit();
               }
    });
        @endisset
    </script>
@endsection

