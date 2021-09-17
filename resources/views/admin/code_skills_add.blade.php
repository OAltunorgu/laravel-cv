@extends('layouts.admin')
@php
    if($codeSkills){
        $codeSkillsText="Kod Becerileri Düzenleme";}
    else{
        $codeSkillsText="Kod Becerileri Ekleme";
    }
@endphp
@section('title')
    {{$codeSkillsText}}
@endsection
@section('css')

@endsection

@section('content')
    <div class="page-header">
        <h3 class="page-title">{{$codeSkillsText}}</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Admin Panel</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.codeSkills.list')}}">Kod Becerileriniz</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$codeSkillsText}}</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample" id="createExperienceForm" method="POST" action="">
                        @csrf
                        @if($codeSkills)
                            <input type="hidden" name="socialMediaID" value="{{$codeSkills->id}}">
                        @endif
                        <div class="form-group">
                            <label for="skill_name">Kod Becerisi Adı</label>
                            <input type="text" class="form-control" name="skill_name" id="skill_name" placeholder="Ad" value="{{$codeSkills ? $codeSkills->skill_name : ''}}">
                            @error('skill_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="level">Seviye</label>
                            <input type="text" class="form-control" name="level" id="level" placeholder="Seviye" value="{{$codeSkills ? $codeSkills->level : ''}}">
                            @error('level')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="order">Sırası</label>
                            <input type="text" class="form-control" name="order" id="order" placeholder="Sırası"
                                   value="{{$codeSkills ? $codeSkills->order : ''}}">
                            @error('order')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="form-check form-check-success">
                                <label class="form-check-label" for="status">
                                    <?php if($codeSkills){
                                        $checkStatus = $codeSkills->status ? "checked" : '';
                                    }else{
                                        $checkStatus = '';
                                    } ?>
                                    <input type="checkbox" name="status" id="status" class="form-check-input" {{$checkStatus}}>Kod becerisi Gösterimi Yapılsın Mı?
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

