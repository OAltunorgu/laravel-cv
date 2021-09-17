@extends('layouts.front')

@section('title')
    {{$personal->title}}
@endsection

@section('css')
@endsection

@section('content')
<div id="about" class="content col-md-12 fadeInUp">
    <div class="row">
        <div class="page-title">
            <h2>{{$personal->main_title}}</h2>
        </div>
        <!-- Info -->
        <div class="col-md-12 pinfo">
            <div class="col-md-12 about-info">
                <ul class="info-list">
                    <li>Ad Soyad : <span>{{$personal->full_name}}</span> </li>
                    <li>Doğum Tarihi : <span>{{$personal->birthday}}</span> </li>
                    <li>Meslek : <span>{{$personal->task_name}}</span> </li>
                    <li>Website : <span><a href="{{$personal->website}}">{{$personal->website}}</a></span> </li>
                    <li>Email : <span>{{$personal->mail}}</span> </li>
                    <li>Adres : <span>{{$personal->address}}</span> </li>
                </ul>
            </div> <!-- .col-md-4 .about-info -->
        </div><!-- .col-md-12 .spotted -->

        <div class="col-md-12 spotted ptext">
            <div class="col-md-12 about-text">
                <h2 class="section-title">{{$personal->task_name}}</h2>
                {!! $personal->about_text !!}
            </div><!--.col-md-12 .about-text end-->
        </div><!-- .col-md-12 .spotted -->
        <!-- Skills -->
        <div class="col-md-12 gray-bg ptext">
            <div class="col-md-6 my-skills">
                <h2 class="section-title">Tasarım Becerileri</h2>
                <ul class="skill-list">
                    @foreach($designSkillsList as $designSkills)
                    <li>
                        <h3>{{$designSkills->skill_name}}</h3>
                        <div class="progress">
                            <div class="percentage" style="width:{{$designSkills->level}}%;"></div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div> <!--.col-md-6 .my-skills end-->
            <div class="col-md-6 my-skills">
                <h2 class="section-title">Kod Becerileri</h2>
                <ul class="skill-list">
                    @foreach($codeSkillsList as $codeSkills)
                        <li>
                            <h3>{{$codeSkills->skill_name}}</h3>
                            <div class="progress">
                                <div class="percentage" style="width:{{$codeSkills->level}}%;"></div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div> <!--.col-md-6 .my-skills end-->
        </div>
        <!-- Services -->
        <div class="col-md-12 pwedo">
            <div class="col-md-12 col-sm-12 col-xs-12 services">
                @foreach($skillsList as $skills)
                <div class="service col-md-4 col-sm-6">
                    <i class="{{$skills->icon}}"></i>
                    <div class="features">
                        <b>{{$skills->name}}</b>
                        <p>{{$skills->detail}}</p>
                    </div>
                </div> <!-- .service .col-md-4 .col-sm-6 end -->
                @endforeach
            </div> <!-- .col-md-12 .services -->
        </div> <!-- .col-md-12 .spotted-->
    </div><!--.row end-->
</div> <!-- #about .content .col-md-12 end -->

@endsection


@section('js')
@endsection
