@extends('CTEMPLATE.CTEMPLATE')
@section('h-ctemplate')
    <link rel="stylesheet" href="{{asset('public/css/CLUB/CLUB_HISTORY.css')}}">
@endsection
@section('b-ctemplate')
    <h1 class="header"style="width: 200px;">CLUB HISTORY</h1>
    <div class="a-container">
        <div class="activity">
            <div class="yearContainer">
                <div class="arrowYear" style="border-top-left-radius: 2px ; border-bottom-left-radius: 2px; "><</div>
                <div class="year">@{{ year }}</div>
                <div class="arrowYear" style="border-top-right-radius: 2px ; border-bottom-right-radius: 2px; ">></div>
            </div>
            <div class="content">slot</div>
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
