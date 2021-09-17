@extends('layouts.front')
@section('title')
    Portfolio
@endsection
@section('css')
@endsection
@section('content')
    <!--Portfolio Section -->
    <div id="portfolio" class="content col-md-12">
        <div class="row">
            <div class="page-title">
                <h2>Portfolyo</h2>
                <!-- Portfolio Filter -->{{--
                <div class="portfolio_filter pull-right">
                    <ul>
                        <li class="select-cat" data-filter="*">All</li>
                        <li data-filter=".web-design">Web Design</li>
                        <li data-filter=".aplication">Applications</li>
                        <li data-filter=".development">Development</li>
                    </ul>
                </div> <!-- .portfolio-filter .pull-right end -->--}}
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 page">
                <!-- Portfolio Items -->
                <div class="portfolio_items">
                    @foreach($portfolyo as $item)
                    <div class="single_item web-design col-md-4 col-sm-12 col-xs-12">
                        <div class="work-inner">
                            <div class="work-overlay">
                                <h3> {{$item->title}} </h3>
                                <p>{{$item->tags}}</p>
                                <a href="{{$item->website}}" class="link"><i class="fa fa-link"></i></a>
                                <a href="{{route('portfolyo.detail', ['id' => $item->id])}}" class="image-link lightbox"> <i class="fa fa-search"></i></a>
                            </div>
                            <img src="{{asset('storage/portfolyo/'.$item->featuredImage->image)}}" alt="{{$item->title}}" height="256" width="242"/>
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
