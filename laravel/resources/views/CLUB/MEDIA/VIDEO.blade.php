@extends('CTEMPLATE.CTEMPLATE')
@section('h-ctemplate')
    <link rel="stylesheet" href="{{asset('public/css/CLUB/MEDIA/VIDEO.css')}}">
@endsection
@section('b-ctemplate')
    <div id="v-container" style="width: 100%; height: 100%;">
        <div class="SP" v-if="trigger">
            <div class="backGround"></div>
            <div class="showPic" >
                <div class="exit" @click="showPicture">X</div>
                <div class="arrowVid" style="top:50%; left:10%;"><</div>
                <div class="arrowVid" style="top:50%; right:10%;">></div>
                <div class="vid">@{{ pic.picture }}</div>
                <div class="v-caption">@{{ pic.caption }}</div>
            </div>
        </div>
        <div class="video">
            <h1 class="header" style="width: 200px; margin-left: -50px;">VIDEO</h1>
            <div class="box">
                <picture-box></picture-box>
                <picture-box></picture-box>
                <picture-box></picture-box>
                <picture-box></picture-box>
                <picture-box></picture-box>
                <picture-box></picture-box>
                <picture-box></picture-box>
                <picture-box></picture-box>
                <picture-box></picture-box>
                <picture-box></picture-box>
                <picture-box></picture-box>
                <picture-box></picture-box>
                <picture-box></picture-box>
                <picture-box></picture-box>
                <picture-box></picture-box>
                <picture-box></picture-box>
                <picture-box></picture-box>
                <picture-box></picture-box>
                <picture-box></picture-box>
                <picture-box></picture-box>
                <picture-box></picture-box>
            </div>
        </div>
    </div>
@endsection
@section('s-ctemplate')
    <script>
        var bus = new Vue();
        var head = new Vue({
            el:'#head',
            data:{
                title:'TEETH CLUB'
            },
        });
        var body = new Vue({
            el:'#v-container',
            data:{
                trigger:false,
                pic:{
                    picture:'video',
                    caption:'caption',
                }
            },
            methods:{
                showPicture(){
                    this.trigger=!this.trigger;
                }
            },
            mounted() {
                bus.$on(
                    "myshow",()=>{
                        this.showPicture();
                    }
                )
            },
            components: {
                "picture-box": {
                    props: [],
                    template: `
                <div class="v-box" @click="myclick">
                    <div class="preview"></div>
                    <div class="v-title">VIDEO</div>
                </div>`,
                    methods: {
                        myclick() {
                            bus.$emit("myshow");
                        }
                    }
                }
            }
        });
    </script>
@endsection
