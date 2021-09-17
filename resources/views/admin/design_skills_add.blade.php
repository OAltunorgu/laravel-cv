@extends('layouts.admin')
@php
    if($designSkills){
        $designSkillsText="Tasarım Becerileri Düzenleme";}
    else{
        $designSkillsText="Tasarım Becerileri Ekleme";
    }
@endphp
@section('title')
    {{$designSkillsText}}
@endsection
@section('css')

@endsection

@section('content')
    <div class="page-header">
        <h3 class="page-title">{{$designSkillsText}}</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Admin Panel</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.designSkills.list')}}">Tasarım Becerileriniz</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$designSkillsText}}</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample" id="createExperienceForm" method="POST" action="">
                        @csrf
                        @if($designSkills)
                            <input type="hidden" name="socialMediaID" value="{{$designSkills->id}}">
                        @endif
                        <div class="form-group">
                            <label for="skill_name">Tasarım Adı</label>
                            <input type="text" class="form-control" name="skill_name" id="skill_name" placeholder="Ad" value="{{$designSkills ? $designSkills->skill_name : ''}}">
                            @error('skill_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="level">Seviye</label>
                            <input type="text" class="form-control" name="level" id="level" placeholder="Seviye" value="{{$designSkills ? $designSkills->level : ''}}">
                            @error('level')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="order">Sırası</label>
                            <input type="text" class="form-control" name="order" id="order" placeholder="Sırası"
                                   value="{{$designSkills ? $designSkills->order : ''}}">
                            @error('order')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="form-check form-check-success">
                                <label class="form-check-label" for="status">
                                    <?php if($designSkills){
                                        $checkStatus = $designSkills->status ? "checked" : '';
                                    }else{
                                        $checkStatus = '';
                                    } ?>
                                    <input type="checkbox" name="status" id="status" class="form-check-input" {{$checkStatus}}>Tasarım becerisi Gösterimi Yapılsın Mı?
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

