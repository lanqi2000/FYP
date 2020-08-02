@extends('CTEMPLATE.CTEMPLATE')
@section('h-ctemplate')
    <link rel="stylesheet" href="{{asset('public/css/CLUB/MEDIA/PICTURE.css')}}">
@endsection
@section('b-ctemplate')
    <div id="p-container" style="width: 100%; height: 100%;">
        <div v-if="trigger" style="display: none;"></div>
        <div v-else="trigger">
            <div class="showPicture" style="background-color: black; height: 100%; width: 1011px; position: absolute; display: flex; justify-content: center; align-items: center;">
                <div id="frame" style="background-color: aliceblue; height: 400px; width: 400px;">
                    <video style="height: 70%; width: 100%;"></video>
                    <div style="background-color:wheat; display: flex; height: 30%;width: 100%;">asda</div>
                </div>
                <div @click="showPicture" style="height: 20px; background-color:chartreuse; width: 20px; position: absolute; text-align: center; left:95%; top:5%;">X</div>
            </div>
        </div>
        <div class="picture">
            <h1 height="10px" style="width: 100%;">PICTURE</h1>
            <div id="box">
                <div class="p-box">
                    <div @click="showPicture" class="preview"></div>
                    <div class="p-title">PICTURE</div>
                </div>
                <div class="p-box">
                    <div class="preview"></div>
                    <div class="p-title">PICTURE</div>
                </div>
                <div class="p-box">
                    <div class="preview"></div>
                    <div class="p-title">PICTURE</div>
                </div>
                <div class="p-box">
                    <div class="preview"></div>
                    <div class="p-title">PICTURE</div>
                </div>
                <div class="p-box">
                    <div class="preview"></div>
                    <div class="p-title">PICTURE</div>
                </div>
                <div class="p-box">
                    <div class="preview"></div>
                    <div class="p-title">PICTURE</div>
                </div>
                <div class="p-box">
                    <div class="preview"></div>
                    <div class="p-title">PICTURE</div>
                </div>
                <div class="p-box">
                    <div class="preview"></div>
                    <div class="p-title">PICTURE</div>
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
        var body = new Vue({
            el:'#container',
            data:{
                trigger:true,
            },
            methods:{
                showPicture:function(){
                    this.trigger=!this.trigger;
                }
            }
        });
    </script>
@endsection
