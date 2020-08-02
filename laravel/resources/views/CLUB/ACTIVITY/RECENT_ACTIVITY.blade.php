@extends('CTEMPLATE.CTEMPLATE')
@section('h-ctemplate')
        <link rel="stylesheet" href="{{asset('public/css/CLUB/ACTIVITY/RECENT_ACTIVITY.css')}}">
@endsection
@section('b-ctemplate')
                    <div id="a-container" style="width: 100%; height: 100%">
                        <div class="activity">
                            <div class="ACT">
                                <div class="a-media">
                                    <img alt="poster" src="{{asset('resources/views/IMAGE/POSTER.jpg')}}" height="100%">
                                </div>
                                <div class="a-caption">
                                    <caption>caption</caption>
                                </div>
                                <div class="a-panel">
                                    <a href="/SOURCE_CODE/HTML/CLUB/ACTIVITY/APPLY_ACTIVITY.html">APPLY</a>
                                </div>
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
