@extends('CTEMPLATE.CTEMPLATE')

@section('h-ctemplate')
    <link rel="stylesheet" href="{{asset('public/css/CLUB/MEDIA/PICTURE.css')}}">
@endsection

@section('b-ctemplate')

    <div id="p-container" style="width: 100%; height: 100%;">
        <div class="SP" v-if="trigger">
            <div class="backGround"></div>
            <div class="showPic" >
                <div class="exit" @click="showPicture">X</div>
                <div class="arrowPic" style="top:50%; left:10%;"><</div>
                <div class="arrowPic" style="top:50%; right:10%;">></div>
                <div class="pic">@{{ pic.picture }}</div>
                <div class="p-caption">@{{ pic.caption }}</div>
            </div>
        </div>
        <div class="picture">
            <h1 class="header" style="width: 200px; margin-left: -50px;">PICTURE</h1>
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
            el:'#p-container',
            data:{
                trigger:false,
                pic:{
                    picture:'pic',
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
                <div class="p-box" @click="myclick">
                    <div class="preview"></div>
                    <div class="p-title">PICTURE</div>
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
