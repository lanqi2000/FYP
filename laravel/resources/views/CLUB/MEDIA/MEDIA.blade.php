@extends('CTEMPLATE.CTEMPLATE')
@section('h-ctemplate')
    <link rel="stylesheet" href="{{asset('public/css/CLUB/MEDIA/MEDIA.css')}}">
@endsection
@section('b-ctemplate')
    <div id="m-container">
        <h1 class="header" style="width: 200px; margin-bottom: 50px">MEDIA</h1>
        <div class="media">
            <div class="m-left">
                <div class="m-title">Photo</div>
                <div class="m-box">
                    <a href="{{url('/club/picture')}}" class="m-media">
                        <img alt="poster" src="{{asset('resources/views/IMAGE/POSTER.jpg')}}" height="100%">
                    </a>
                </div>
                <div class="m-title">Video</div>
                <div class="m-box">
                    <a href="{{url('/club/video')}}" class="m-media">
                        <img alt="poster" src="{{asset('resources/views/IMAGE/POSTER.jpg')}}" height="100%">
                    </a>
                </div>
            </div>
            <div class="m-right">
                <div class="m-title">Activity</div>
                <div class="m-activity" id="m-activity">
                    <activity-bar></activity-bar>
                    <activity-bar></activity-bar>
                    <activity-bar></activity-bar>
                    <activity-bar></activity-bar>
                    <activity-bar></activity-bar>
                    <activity-bar></activity-bar>
                    <activity-bar></activity-bar>
                    <activity-bar></activity-bar>
                    <activity-bar></activity-bar>
                    <activity-bar></activity-bar>
                    <activity-bar></activity-bar>
                    <activity-bar></activity-bar>
                    <activity-bar></activity-bar>
                </div>
            </div>


        </div>
    </div>
@endsection
@section('s-ctemplate')
    <script>
        Vue.component('activity-bar',{
            template:`<div class="bar">
                        <div class="activity-title">activity</div>
                            <div class="m-button">
                                P
                            </div>
                            <div class="m-button">
                                V
                            </div>
                        </div>
                    </div>`
        });
        new Vue({
            el:'#m-activity',
        });
        var head = new Vue({
            el:'#head',
            data:{
                title:'TEETH CLUB'
            },
        });
    </script>
@endsection
