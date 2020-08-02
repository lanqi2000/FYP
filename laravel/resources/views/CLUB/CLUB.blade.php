@extends('CTEMPLATE.CTEMPLATE')
@section('h-ctemplate')
    <link rel="stylesheet" href="{{asset('public/css/CLUB/CLUB.css')}}">
@endsection
@section('b-ctemplate')

    <div id="logo">
        <div id="l-img">
            <img src="{{asset('resources/views/IMAGE/LOGO.png')}}" width="100%" height="100%">
        </div>
    </div>
    <br/>
    <div id="banner">
        <div id="b-img">
            <img src="{{asset('resources/views/IMAGE/BANNER.jpg')}}" width="100%" height="100%">
        </div>
    </div>
    <div id="p-container" style="width: 100%; height: 100%;">
        <div class="poster">
            <div class="p-title"></div>
            <div class="p-media">
                <img alt="poster" src="{{asset('resources/views/IMAGE/POSTER.jpg')}}" height="100%">
            </div>
            <div class="p-caption">
                <caption>lalalalaalalla</caption>
            </div>
        </div>
    </div>
@endsection
@section('s-ctemplate')
    <script>
        var head = new Vue({
            el:'#head',
            data:{
                title:'TEETH CLUB'
            },
        });
    </script>
@endsection
