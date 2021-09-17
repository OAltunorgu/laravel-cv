@extends('layouts.front')
@section('title')
    Özgeçmişim
@endsection
@section('css')
@endsection
@section('content')
    <div id="resume" class="content col-md-12">
        <div class="row">
            <div class="page-title">
                <h2>Özgeçmişim</h2>
            </div>
            <div class="col-md-12 page">
                <!--Resume Education Timeline-->
                <div class="resume-education col-md-12">
                    <div class="rounded-icon">
                        <i class="fa fa-graduation-cap"></i>
                    </div>
                    <div class="resume-out">
                        @foreach($educationList as $education)
                        <div class="resume-info">
                            <h2 class="info-title">{{$education->education_info}}</h2>
                            <span class="info-date">{{$education->education_date}}</span>
                            <p>{{$education->description}}</p>
                        </div> <!-- .resume-info -->
                        @endforeach
                    </div> <!-- .resume-out end -->
                </div> <!-- .resume-education .col-md-12 end -->

                <!--Resume Work Timeline-->
                <div class="resume-education col-md-12">
                    <div class="rounded-icon">
                        <i class="fa fa-suitcase"></i>
                    </div>
                    <div class="resume-out">
                        @foreach($experienceList as $experience)
                        <div class="resume-info">
                            <h2 class="info-title">{{$experience->experience_info}}</h2>
                            <span class="info-date">{{$experience->experience_date}}</span>
                            <p>{{$experience->description}}</p>
                        </div> <!-- .resume-info -->
                        @endforeach
                    </div> <!-- .resume-out end -->
                </div> <!-- .resume-education .col-md-12 end -->
            </div><!-- .col-md-12 .page -->
        </div><!--.row end-->
    </div> <!-- #resume .content .col-md-12 end -->
@endsection
@section('js')
@endsection
