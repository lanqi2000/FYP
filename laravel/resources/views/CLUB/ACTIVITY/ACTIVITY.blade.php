@extends('CTEMPLATE.CTEMPLATE')
@section('h-ctemplate')
    <link rel="stylesheet" href="{{asset('public/css/CLUB/ACTIVITY/ACTIVITY.css')}}">
@endsection
@section('b-ctemplate')
    <div id="a-container">
        <div class="activity">
            <h1>RECENT</h1>
            <a class="ACT" href="/SOURCE_CODE/HTML/CLUB/ACTIVITY/RECENT_ACTIVITY.html">
                <div class="a-media">
                    <img alt="poster" src="{{asset('resources/views/IMAGE/POSTER.jpg')}}" height="100%">
                </div>
                <div class="a-caption">
                    <caption>lalalalaalalla</caption>
                </div>
            </a>
        </div>
        <div class="activity">
            <h1>PASSED</h1>
            <a class="ACT" href="/SOURCE_CODE/HTML/CLUB/ACTIVITY/PASSED_ACTIVITY.html">
                <div class="a-media">
                    <img alt="poster" src="{{asset('resources/views/IMAGE/POSTER.jpg')}}" height="100%">
                </div>
                <div class="a-caption">
                    <caption>lalalalaalalla</caption>
                </div>
            </a>
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
