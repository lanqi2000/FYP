@extends('CTEMPLATE.CTEMPLATE')
@section('h-ctemplate')
    <link rel="stylesheet" href="{{asset('public/css/CLUB/MEDIA/VIDEO.css')}}">
@endsection
@section('b-ctemplate')
    <div id="v-container" style="width: 100%; height: 100%;">
        <div class="video">
            <h1 class="header" style="width: 200px; margin-left: -50px;">VIDEO</h1>
            <div class="box">
                <video-box v-for="(vid,index) in vidSet" @click.native="showVideo(index)" :path="vid"></video-box>
            </div>
        </div>
        <div class="video-background" v-if="trigger"></div>
        <div v-if="trigger" class="video-show">
            <div class="preview-arrow left" @click="changeVideo(1)"><</div>
            <video ref="v" class="media" style="outline:none;" :class="{fullscreenbackground:fullScreen}" controls>
                <source :src="video" type="video/mp4"/>
            </video>
            <div class="preview-arrow right" @click="changeVideo(2)">></div>
        </div>
        <img src="{{asset('resources/views/ICON/exit.svg')}}" class="exit" v-if="trigger" @click="trigger=false" >
    </div>
@endsection
@section('s-ctemplate')
    <script>
        Vue.component("video-box",{
            props: ['path'],
            data: function (){
                return{
                    fullScreen:false,
                }
            },
            template: `
                <div @mouseover="fullScreen=true" @mouseleave="fullScreen=false" class="video-box" >
                    <video height="auto" ref="v1" style="outline:none;" width="100%">
                        <source :src="path" type="video/mp4" />
                    </video>
                    <transition name="flash">
                        <img v-if="fullScreen" class="full-screen" src="{{asset('resources/views/ICON/play.svg')}}">
                    </transition>
                </div>`,
            mounted() {
                this.$refs.v1.src = this.path;
            }
        });
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
                video:'',
                vidSet:[],
                head:0
            },
            methods:{
                showVideo(n){
                    this.head = n;
                    this.trigger=true;
                    this.$refs.v.src = this.video = this.vidSet[n];
                },
                changeVideo(n){
                    if(this.vidSet.length>1){
                        switch(n){
                            case 1:
                                if(this.head!==0){
                                    this.head--;
                                    this.$refs.v.src = this.video = this.vidSet[this.head];
                                }
                                break;
                            case 2:
                                if(this.head!==this.vidSet.length-1){
                                    this.head++;
                                    this.$refs.v.src = this.video = this.vidSet[this.head];
                                }
                                break;
                        }
                    }
                }
            },
            mounted() {
                @foreach($getVid as $vid)
                Vue.set(this.vidSet,this.vidSet.length,'{{asset('storage/app/public/club1/video')}}'+'/'+'{{$vid['video_name']}}'+'#t=0.5');
                @endforeach
            },
        });
    </script>
@endsection
