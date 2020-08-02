@extends('CTEMPLATE.CTEMPLATE')
@section('h-ctemplate')
    <link rel="stylesheet" href="{{asset('public/css/CLUB/MEDIA/MEIDA.css')}}">
@endsection
@section('b-ctemplate')
    <div id="m-container" style="width: 100%; height: 100%;">
        <div class="media">
            <h1 height="10px" style="width: 100%;">MEDIA</h1>
            <div class="bar">
                <div class="m-title">photo</div>
                <a href="PICTURE.blade.php" class="m-media">
                    <img alt="poster" src="{{asset('resources/views/IMAGE/POSTER.jpg')}}" height="100px">
                </a>
            </div>
            <div class="bar" style="border-bottom: gray 1px solid;">
                <div class="m-title">video</div>
                <a href="VIDEO.blade.php" class="m-media">
                    <img alt="poster" src="{{asset('resources/views/IMAGE/POSTER.jpg')}}" height="100px">
                </a>
            </div>
            <h1 height="10px" style="width: 100%;">ACTIVITY</h1>
            <div class="bar">
                <div class="m-title">activity</div>
                <div class="m-media">
                    <div class="m-media">
                        photo
                    </div>
                    <div class="m-media">
                        video
                    </div>
                </div>
            </div>
            <div class="bar">
                <div class="m-title">activity</div>
                <div class="m-media">
                    <div class="m-media">
                        photo
                    </div>
                    <div class="m-media">
                        video
                    </div>
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
