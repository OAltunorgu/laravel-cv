@extends('layouts.front')
@section('title')
    İletişim
@endsection
@section('css')
@endsection
@section('content')
    <div id="contact" class="content col-md-12">
        <div class="row">
            <div class="page-title">
                <h2>İletişim </h2>
            </div>
            <div class="col-md-12 page">
                <!-- Contact Form -->
                <form class="col-md-6 contact-form"  method="POST" action="mail.php">
                    <h2 class="section-title">İletişim Formu</h2>
                    <!--Name-->
                    <input id="con_name" name="con_name" class="form-inp requie" type="text" placeholder="Ad Soyad"  />
                    <!--Email-->
                    <input id="con_email" name="con_email" class="form-inp requie" type="text" placeholder="Email" />
                    <!--Message-->
                    <textarea name="con_message" id="con_message" class="requie" placeholder="Mesaj" rows="8"></textarea>
                    <input id="con_submit" class="but-big" type="submit" value="Gönder">
                </form>
                <!-- Contact Information -->
                <div class="col-md-6 contact-info">
                    <h2 class="section-title">İletişim Bilgileri</h2>
                    <ul class="info-list">
                        <li>Adres : <span>{{$personal->address}}</span> </li>
                        <li>Telefon No : <span>{{$personal->phone}}</span> </li>
                        <li>Website : <a href="{{$personal->website}}">{{$personal->website}}</a> </li>
                        <li>Email : <span>{{$personal->mail}}</span> </li>
                    </ul>
                    <div class="social-icons">
                        @foreach($socialMediaData as $item)
                            <a class="facebook" href="{{$item->link ? $item->link : 'javascript:void(0)'}}" target="_blank" title="{{$item->name}}">
                                <i class="{!!$item->icon!!}"></i>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div><!-- .col-md-12 .page -->
        </div><!--.row end-->
    </div> <!-- #contact .content .col-md-12 end -->
@endsection
@section('js')
@endsection
