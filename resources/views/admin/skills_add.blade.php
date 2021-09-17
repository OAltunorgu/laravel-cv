@extends('layouts.admin')
@php
    if($skills){
        $skillsText="Beceri Düzenleme";}
    else{
        $skillsText="Beceri Ekleme";
    }
@endphp
@section('title')
    {{$skillsText}}
@endsection
@section('css')

@endsection

@section('content')
    <div class="page-header">
        <h3 class="page-title">{{$skillsText}}</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Admin Panel</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.skills.list')}}">Becerileriniz</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$skillsText}}</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample" id="createExperienceForm" method="POST" action="">
                        @csrf
                        @if($skills)
                            <input type="hidden" name="socialMediaID" value="{{$skills->id}}">
                        @endif
                        <div class="form-group">
                            <label for="name">Beceri Adı</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Ad" value="{{$skills ? $skills->name : ''}}">
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="detail">Detay</label>
                            <input type="text" class="form-control" name="detail" id="detail" placeholder="Detay" value="{{$skills ? $skills->detail : ''}}">
                            @error('detail')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="icon">Icon</label>
                            <input type="text" class="form-control" name="icon" id="icon" placeholder="İcon" value="{{$skills ? $skills->icon : ''}}">
                            @error('icon')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="form-check form-check-success">
                                <label class="form-check-label" for="status">
                                    <?php if($skills){
                                        $checkStatus = $skills->status ? "checked" : '';
                                    }else{
                                        $checkStatus = '';
                                    } ?>
                                    <input type="checkbox" name="status" id="status" class="form-check-input" {{$checkStatus}}>Beceri Gösterimi Yapılsın Mı?
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2" id="createButton">Kaydet</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection

