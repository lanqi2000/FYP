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
                        <img class="media-icon" src="{{asset('resources/views/ICON/PICTURE.svg')}}" height="100%">
                    </a>
                </div>
                <div class="m-title">Video</div>
                <div class="m-box">
                    <a href="{{url('/club/video')}}" class="m-media">
                        <img class="media-icon" src="{{asset('resources/views/ICON/VIDEO.svg')}}" height="100%">
                    </a>
                </div>
            </div>
            <div class="m-right">
                <div class="m-title">Activity</div>
                <transition name="rotate-to-left">
                    <div class="sign" v-if="checkActPic"><img class="sign-icon" src="{{asset('resources/views/ICON/PICTURE.svg')}}" ></div>
                </transition>
                <div class="m-activity" @mouseleave="checkActPic=false" @mouseover="checkActPic=true">
                    @foreach($getActPic as $act)
                        <a class="bar" href="{{url('/club/picture/'.$act['id'])}}">
                            <div class="activity-title">{{$act['name']}}</div>
                        </a>
                    @endforeach
                </div>
                <transition name="rotate-to-left">
                    <div class="sign" v-if="checkActVid" style="margin-top: 290px"><img class="sign-icon" src="{{asset('resources/views/ICON/VIDEO.svg')}}" ></div>
                </transition>
                <div class="m-activity" @mouseleave="checkActVid=false" @mouseover="checkActVid=true">
                    @foreach($getActVid as $act)
                        <a class="bar" href="{{url('/club/video/'.$act['id'])}}">
                            <div class="activity-title">{{$act['name']}}</div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
@section('s-ctemplate')
    <script>
        Vue.component('activity-bar',{
            props:['id','name'],
            template:`
                <div class="bar">

                </div>`
        });
        new Vue({
            el:'#m-container',
            data:{
                checkActPic:false,
                checkActVid:false
            },
        });
        var head = new Vue({
            el:'#head',
            data:{
                title:'TEETH CLUB'
            },
        });
    </script>
@endsection
