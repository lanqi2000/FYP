@extends('CTEMPLATE.CTEMPLATE')

@section('h-ctemplate')
    <link rel="stylesheet" href="{{asset('public/css/CLUB/MEDIA/PICTURE.css')}}">
@endsection
@section('b-ctemplate')
    <div id="p-container" style="width: 100%; height: 100%;">
        <div class="picture">
            <h1 class="header" style="width: 200px; margin-left: -50px;">PICTURE</h1>
            <div class="box">
                <picture-box v-for="(pic,index) in picSet" @click.native="showPicture(index)" :path="pic"></picture-box>
            </div>
        </div>
        <div class="picture-background" v-if="trigger"></div>
        <div v-if="trigger" class="picture-show">
            <div class="preview-arrow left" @click="changePicture(1)"><</div>
            <img class="show-picture" :src="picture">
            <div class="preview-arrow right" @click="changePicture(2)">></div>
        </div>
        <img src="{{asset('resources/views/ICON/exit.svg')}}" class="exit" v-if="trigger" @click="trigger=false" >
    </div>
@endsection
@section('s-ctemplate')
    <script>
        Vue.component("picture-box",{
            props: ['path'],
                data: function (){
                return{
                    fullScreen:false,
                }
            },
            template: `
                <div @mouseover="fullScreen=true" @mouseleave="fullScreen=false" class="picture-box" >
                    <img :src="path" class="media" :class="{fullscreenbackground:fullScreen}"/>
                    <transition name="flash">
                        <img v-if="fullScreen" class="full-screen" src="{{asset('resources/views/ICON/fullscreen.svg')}}">
                    </transition>
                </div>`,
        });
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
                picture:'',
                picSet:[],
                head:0
            },
            methods:{
                showPicture(n){
                    this.picture = this.picSet[n];
                    this.head = n;
                    this.trigger=true;
                },
                changePicture(n){
                    if(this.picSet.length>1){
                        switch(n){
                            case 1:
                                if(this.head!==0){
                                    this.head--;
                                    this.picture = this.picSet[this.head];
                                }
                                break;
                            case 2:
                                if(this.head!==this.picSet.length-1){
                                    this.head++;
                                    this.picture = this.picSet[this.head];
                                }
                                break;
                        }
                    }
                }
            },
            mounted() {
                @foreach($getPic as $pic)
                    Vue.set(this.picSet,this.picSet.length,'{{asset('storage/app/public/club1/picture')}}'+'/'+'{{$pic['picture_name']}}');
                @endforeach
            },
        });
    </script>
@endsection
