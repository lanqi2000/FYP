@extends('CTEMPLATE.CTEMPLATE')
@section('h-ctemplate')

    <link rel="stylesheet" href="{{asset('public/css/CLUB/ABOUT_CLUB.css')}}">

@endsection
@section('b-ctemplate')

    <div style="width: 100%; height: 100%">
        <div class="i-container">
            <div>
                <h2>About Us</h2>
                <pre>Name  :    @{{club}}</pre>
                <pre>Email :    @{{email}}</pre>
                <pre>Other :    blablabla</pre>
            </div>
        </div>
        <div class="i-container">
            <div>
                <h2>Vision</h2>
                <pre>BLABLALBA</pre>
                <h2>Vision</h2>
                <pre>blablabla</pre>
            </div>
        </div>
        <div class="i-container">
            <div style="display: flex; flex-direction: column;">
                <h2>Logo</h2>
                <img style="height: 200px; width: 160px;" src="{{asset('resources/views/IMAGE/POSTER.jpg')}}">
                <caption>caption</caption>
            </div>
        </div>
        <div class="i-container" style="flex-direction: column;">
            <div>
                <h2>ID Project</h2>
                <pre><h4>The Alley Melaka 鹿角巷</h4>
    Address: No 55 Jalan KLJ 10, Taman Kota Laksamana Jaya Melaka 75200
    Business Hour: 11:00 AM – 1:00 AM
    Discount: 10% for each student with MMU student ID</pre>
            </div>
        </div>
        <div class="i-container" style="flex-direction: column;">
            <div>
                <h2>Organization Structure</h2>
                <div>
                    <h4>President</h4>
                    <p>Mr teeth</p>
                    <h4>Vice President</h4>
                    <p>Mr teeth</p>
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
                title:'TEETH CLUB - INFO'
            },
        });
        var body = new Vue({
            el:'#container',
            data:{
                hover:false,
                club:'TEETH CLUB',
                email:'blablabla.com'
            }
        });
    </script>

@endsection
