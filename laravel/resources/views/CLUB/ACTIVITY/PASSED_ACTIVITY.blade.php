@extends('CTEMPLATE.CTEMPLATE')
@section('h-ctemplate')
        <link rel="stylesheet" href="{{asset('public/css/CLUB/ACTIVITY/PASSED_ACTIVITY.css')}}">
@endsection
@section('b-ctemplate')
    <div id="a-container" style="width: 100%; height: 100%">
        <div class="activity-preview">
            <div class="activity-title">
                @{{name}}
            </div>
            <div class="activity-image">
                <img :src="image" height="100%">
            </div>
            <div class="activity-description">
                <div class="caption">
                    <caption class="preview" ref="caption" style="overflow-wrap: break-word; width: 580px;">@{{caption}}</caption>
                </div>
            </div>
            <div class="activity-panel">
                <a href="{{url("/club/picture")}}" class="myButton_small">PICTURE</a>
                <a href="{{url("/club/video")}}" class="myButton_small">VIDEO</a>
            </div>
        </div>
    </div>
@endsection
@section('s-ctemplate')
        <script>
            console.log('{{$getData[0]}}');
            var head = new Vue({
                el:'#head',
                data:{
                    title:'TEETH CLUB'
                },
            });
            var aContainer = new Vue({
                el:'#a-container',
                data:{
                    name:'{{$getData[0]['activity_name']}}',
                    image:'{{asset("storage/app/public/activity/".$getData[0]['activity_image'])}}',
                    caption:'{{$getData[0]['activity_caption']}}'
                }
            });
        </script>
@endsection
