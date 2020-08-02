@extends('TEMPLATE.TEMPLATE')
@section('h-template')
<link rel="stylesheet" href="{{asset('public/css/PERSONAL_PROFILE.css')}}">
@endsection
@section('b-template')
    <div class="profile">
        <div class="pro-container">
            <form>
                <div style="background-color: beige; float:left; padding: 30px;">
                    <img src="{{asset('resources/views/IMAGE/POSTER.jpg')}}" style="height: 200px; width:200px;">
                    <input type="file" style="width: 200px;">
                </div>
                <div style="background-color: beige;  padding: 30px;">
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
                    <input type="submit" value="submit">
                </div>
            </form>

        </div>
    </div>
@endsection
@section('s-template')
<script>
    var head = new Vue({
        el:'#head',
        data:{
            title:'PERSONAL PROFILE'
        },
    });
</script>
@endsection
