@extends('CTEMPLATE.CTEMPLATE')
@section('h-ctemplate')
    <link rel="stylesheet" href="{{asset('public/css/CLUB/ACTIVITY/ACTIVITY.css')}}">
@endsection
@section('b-ctemplate')
    <div id="a-container">
        <div class="activity">
            <h1 class="header">RECENT ACTIVITY</h1>
            <div class="activity-box">
                @foreach($currentActivity as $data)
                    <activity-box :link="'{{url('club/rActivity/'.$data['activity_id'])}}'" :image="'{{asset('/public/storage/activity/'.$data['activity_image'])}}'" :name="'{{$data['activity_name']}}'"></activity-box>
                @endforeach
            </div>
        </div>
        <div class="activity">
            <h1 class="header" >PASSED ACTIVITY</h1>
            <div class="activity-box">
                @foreach($passedActivity as $data)
                    <activity-box :link="'{{url('club/pActivity/'.$data['activity_id'])}}'" :image="'{{asset('/public/storage/activity/'.$data['activity_image'])}}'" :name="'{{$data['activity_name']}}'"></activity-box>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@section('s-ctemplate')
    <script>
        Vue.component('activity-box',{
            props:['link','image','name'],
            template:`  <a class="ACT" target="_blank" :href="link">
                            <div class="a-media">
                                <img alt="poster" :src="image" height="100%">
                            </div>
                            <div class="a-title">
                                @{{name}}
                            </div>
                        </a>`
        });
        var aContainer = new Vue({
            el:'#a-container',
            data:{

            }
        });
        var head = new Vue({
            el:'#head',
            data:{
                title:'TEETH CLUB'
            },
        });
    </script>
@endsection
