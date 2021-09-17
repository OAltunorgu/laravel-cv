@extends('layouts.front')
@section('title')
{{$portfolyo->title}}
@endsection
@section('css')
@endsection
@section('content')
    <!--Portfolio Section -->
    <div id="portfolio" class="content col-md-12">
        <div class="row">
            <div class="page-title">
                <h2>{{$portfolyo->title}}</h2>
                <hr>
                {!! $portfolyo->about !!}
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 page">
                <!-- Portfolio Items -->
                <div class="portfolio_items">
                    @foreach($portfolyo->images as $item)
                    <div class="single_item web-design col-md-4 col-sm-12 col-xs-12">
                        <div class="work-inner">
                            <div class="work-overlay">
                                <a href="{{asset('storage/portfolyo/'.$item->image)}}" class="image-link lightbox"> <i class="fa fa-search"></i></a>
                            </div>
                            <img src="{{asset('storage/portfolyo/'.$item->image)}}" alt="{{$item->title}}" height="256" width="242"/>
                        </div>
                    </div>
                    @endforeach
                </div> <!-- .portfolio_items end -->
            </div><!-- .col-md-12 .page -->
        </div><!--.row end-->
    </div> <!-- #portfolio .content .col-md-12 end -->
@endsection
@section('js')
@endsection
