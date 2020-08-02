@extends('CTEMPLATE.CTEMPLATE')
@section('h-ctemplate')
        <link rel="stylesheet" href="{{asset('public/css/CLUB/ACTIVITY/APPLY_ACTIVITY.css')}}">
@endsection
@section('b-ctemplate')
                    <div id="f-container" style="width: 100%; height: 100%">
                        <div class="form">
                            <form>
                                <div class="f-info">
                                        <h3>FORM</h3>
                                        <div class="info">
                                            <p>Name:</p>
                                            <input type="text" name="name" placeholder="key in your name">
                                        </div>
                                        <div class="info">
                                            <p>Name:</p>
                                            <input type="text" name="name" placeholder="key in your name">
                                        </div>
                                        <div class="info">
                                            <p>Name:</p>
                                            <input type="text" name="name" placeholder="key in your name">
                                        </div>
                                        <div class="info">
                                            <p>Name:</p>
                                            <input type="text" name="name" placeholder="key in your name">
                                        </div>
                                        <div class="info">
                                            <p>Name:</p>
                                            <input type="text" name="name" placeholder="key in your name">
                                        </div>
                                </div>
                                <div class="f-panel">
                                    <button type="submit">SUBMIT</button>
                                    <button onclick="goBack()">CANCEL</button>
                                </div>
                            <form>
                        </div>
                    </div>
@endsection
@section('s-ctemplate')
        <script>
            function goBack(){
                window.history.back();
            }
            var head = new Vue({
                el:'#head',
                data:{
                    title:'TEETH CLUB'
                },
            });
        </script>
@endsection
