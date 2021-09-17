@extends('layouts.admin')
@php
    if($experience){
        $experienceText="Deneyim Düzenle";}
    else{
        $experienceText="Yeni Deneyim Ekle";
    }
@endphp
@section('title')
    {{$experienceText}}
@endsection
@section('css')

@endsection

@section('content')
    <div class="page-header">
        <h3 class="page-title">{{$experienceText}}</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Admin Panel</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.experience.list')}}">Deneyim Bilgileri Listesi</a></li>
                <li class="breadcrumb-item active" aria-current="page">Yeni Deneyim Ekleme</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample" id="createExperienceForm" method="POST" action="">
                        @csrf
                        @if($experience)
                            <input type="hidden" name="experienceID" value="{{$experience->id}}">
                        @endif
                        <div class="form-group">
                            <label for="experience_date">Deneyim Tarihi</label>
                            <input type="text" class="form-control" name="experience_date" id="experience_date" placeholder="Deneyim Tarihi" value="{{$experience ? $experience->experience_date : ''}}">
                            <small>Örneğin: 2016 - 2020</small>
                            @error('experience_date')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="experience_info">Firma - Görev</label>
                            <input type="text" class="form-control" name="experience_info" id="experience_info" placeholder="Firma - Görev" value="{{$experience ? $experience->experience_info : ''}}">
                            @error('experience_info')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Açıklama</label>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="7" placeholder="Açıklama">{{$experience ? $experience->description : ''}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="order">Görüntülenecek Deneyim Sırası</label>
                            <input type="text" class="form-control" name="order" id="order" placeholder="Görüntülenecek Deneyim Sırası"
                                   value="{{$experience ? $experience->order : ''}}">
                            @error('order')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="form-check form-check-success">
                                <label class="form-check-label" for="status">
                                    <?php if($experience){
                                        $checkStatus = $experience->status ? "checked" : '';
                                    }else{
                                        $checkStatus = '';
                                    } ?>
                                    <input type="checkbox" name="status" id="status" class="form-check-input" {{$checkStatus}}>Deneyim Gösterimi Yapılsın Mı?
                                </label>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary mr-2" id="createButton">Kaydet</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        let createButton = $("#createButton");
        createButton.click(function (){

           if($('#experience_date').val().trim() == ''){
               Swal.fire({
                   icon: 'info',
                   title: 'Uyarı!',
                   text: 'Lütfen Deneyim Tarihini Kontrol Ediniz!',
                   confirmButtonText:"Tamam"
               })
           }
           else if($('#experience_info').val().trim() == ''){
               Swal.fire({
                   icon: 'info',
                   title: 'Uyarı!',
                   text: 'Lütfen Deneyim Bilgilerini Kontrol Ediniz!',
                   confirmButtonText:"Tamam"
               })
           }
           else if($('#description').val().trim() == ''){
               Swal.fire({
                   icon: 'info',
                   title: 'Uyarı!',
                   text: 'Lütfen Deneyim Açıklamasını Kontrol Ediniz!',
                   confirmButtonText:"Tamam"
               })
           }
           else{
                $('#createExperienceForm').submit();
           }
        });
    </script>
@endsection

