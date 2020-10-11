@extends('CTEMPLATE.CTEMPLATE')
@section('h-ctemplate')
    <link rel="stylesheet" href="{{asset('public/css/CLUB/MANAGEMENT_SYSTEM/MEDIA_MANAGEMENT.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('b-ctemplate')
    <h1 class="header" style="width: 360px">MEDIA MANAGEMENT</h1>
    <div id="media-management">
        <div style="display: flex; flex-direction: column;">
            <div class="mm-header">UPLOAD PICTURE</div>
            <div class="mm-box">
                <div class="mm-box-left">
                    <div class="preview-arrow" @click="changePreview(1)"><</div>
                    <div class="preview">
                        <img :src="image" height="100%"/>
                    </div>
                    <div class="preview-arrow" @click="changePreview(2)">></div>
                </div>
                <div class="mm-box-right">
                    <input type="file" ref="image" id="image" accept="image/jpeg,image/png" style="display: none;" @change="upload(1)" multiple>
                    <label class="myButton" for="image">+ Select Image</label>
                    <select class="activity-selection" v-model="imageActivity">
                        <option value="" selected>Not Activity</option>
                        <option v-for="value in activities" :value="value.activity_id">@{{ value.activity_name }}</option>
                    </select>
                    <div class="myButton_small" @click="finalUpload(1)">Upload</div>
                </div>
            </div>
            <div class="mm-header">UPLOAD VIDEO</div>
            <div class="mm-box">
                <div class="mm-box-left">
                    <div class="preview-arrow" @click="changePreview(3)"><</div>
                    <div class="preview" @mouseover="playButton=true" @mouseleave="playButton=false" >
                        <video height="auto" ref="v1" style="outline:none;" width="100%" v-if="video">
                            <source :src="video" type="video/mp4" />
                        </video>
                        <img src="{{asset('resources/views/ICON/play.svg')}}" class="play" v-if="playButton && video" @click="play">
                    </div>
                    <div class="preview-arrow" @click="changePreview(4)">></div>
                </div>
                <div class="mm-box-right">
                    <input type="file" ref="video" id="video" accept="video/mp4" style="display: none;" @change="upload(2)" multiple>
                    <label class="myButton" for="video">+ Select Video</label>
                    <select class="activity-selection" v-model="videoActivity">
                        <option value="" selected>Not Activity</option>
                        <option v-for="value in activities" :value="value.activity_id">@{{ value.activity_name }}</option>
                    </select>
                    <div class="myButton_small" @click="finalUpload(2)">Upload</div>
                </div>
            </div>
            <div class="videoBackground" v-if="playVideo"></div>
            <div v-if="playVideo" class="videoShow">
                <div class="preview-arrow" @click="changePreview(3)"><</div>
                <video ref="v2" style="outline:none;" class="{playvideo:playVideo}" controls>
                    <source :src="video" type="video/mp4"/>
                </video>
                <div class="preview-arrow" @click="changePreview(4)">></div>
            </div>
            <img src="{{asset('resources/views/ICON/exit.svg')}}" class="exit" v-if="playVideo" @click="playVideo=false" >
        </div>
        <transition name="flash">
            <div class="submited" v-if="pass">Successful</div>
        </transition>
        <transition name="flash">
            <div class="submited" style="background-color: #f70000;" v-if="fail">Please Complete Requirement</div>
        </transition>
    </div>

@endsection
@section('s-ctemplate')
    <script>
        var mediaManagement = new Vue({
            el:'#media-management',
            data:{
                image:null,
                imageHead:0,
                imageSet:[],
                imageActivity:null,

                video:null,
                video1Head:0,
                video2Head:0,
                videoSet:[],
                videoActivity:null,
                playButton:false,
                playVideo:false,

                activities:[],

                pass:false,
                fail:false,
            },
            methods:{
                upload(n){
                    let formData = new FormData;
                    if(n===1){
                        console.log('upload');
                        console.log(this.$refs.image.files);
                        for (let i in this.$refs.image.files){
                            formData.append(i,this.$refs.image.files[i]);
                            if(this.$refs.image.files[0]){
                                axios.post('/club/cmsMedia-upload/1',formData)
                                    .then(response=> {
                                        console.log(response.data);
                                        this.imageSet.splice(0);
                                        this.image = null;
                                        this.image = '{{asset('storage/app/public/club/picture/temp')}}'+'/'+response.data[0];
                                        this.imageSet = response.data;
                                    })
                                    .catch(error=>console.log(error.response))
                            }
                        }
                    }else if(n===2){
                        for (let i in this.$refs.video.files){
                            formData.append(i,this.$refs.video.files[i]);
                            if(this.$refs.video.files[0]){
                                axios.post('/club/cmsMedia-upload/2',formData)
                                    .then(response=> {
                                        this.videoSet = response.data;
                                        this.video = null;
                                        this.$refs.v1.src =
                                            this.video = '{{asset('storage/app/public/club/video/temp')}}'+'/'+response.data[0]+'#t=0.5';
                                    })
                                    .catch(error=>console.log(error.response))
                            }
                        }
                    }
                },
                changePreview(n){
                    if(this.imageSet.length>1){
                        switch (n){
                            case 1:
                                if (this.imageHead!==0){
                                    this.imageHead--;
                                    this.image = '{{asset('storage/app/public/club/picture/temp')}}'+'/'+this.imageSet[this.imageHead];
                                }
                                break;
                            case 2:
                                if (this.imageHead!==this.imageSet.length-1){
                                    this.imageHead++;
                                    this.image = '{{asset('storage/app/public/club/picture/temp')}}'+'/'+this.imageSet[this.imageHead];
                                }
                                break;
                        }
                    }
                    else if(this.videoSet.length>1){
                        switch (n){
                            case 3:
                                if(this.playVideo){
                                    if (this.video2Head!==0){
                                        this.video2Head--;
                                    }
                                    this.$refs.v2.src = this.video = '{{asset('storage/app/public/club/video/temp')}}'+'/'+this.videoSet[this.video2Head]+'#t=0.5';
                                }else {
                                    if (this.video1Head!==0){
                                        this.video1Head--;
                                    }
                                    this.$refs.v1.src = this.video = '{{asset('storage/app/public/club/video/temp')}}'+'/'+this.videoSet[this.video1Head]+'#t=0.5';
                                }

                                break;
                            case 4:
                                if(this.playVideo){
                                    if (this.video2Head!==this.videoSet.length-1){
                                        this.video2Head++;
                                    }
                                    this.$refs.v2.src = this.video = '{{asset('storage/app/public/club/video/temp')}}'+'/'+this.videoSet[this.video2Head]+'#t=0.5';
                                }else {
                                    if (this.video1Head!==this.videoSet.length-1){
                                        this.video1Head++;
                                    }
                                    this.$refs.v1.src = this.video = '{{asset('storage/app/public/club/video/temp')}}'+'/'+this.videoSet[this.video1Head]+'#t=0.5';
                                }

                                break;
                        }
                    }
                },
                show_off(){
                    this.pass=false;
                    this.fail=false;
                },
                finalUpload(n){
                    let formData = new FormData;
                    if(n===1){
                        for (let i in this.$refs.image.files){
                            formData.append(i,this.$refs.image.files[i]);
                        }
                        if(this.$refs.image.files[0]){
                            axios.post('/club/cmsMedia-inputMedia/1',formData)
                                .then(response=>{
                                    axios.post('{{url('/club/cmsMedia-input/1')}}',{
                                        imageActivity:this.imageActivity,
                                        imageSet:response.data,
                                    })
                                        .then(response=>{
                                            this.$refs.image.value = null;
                                            this.imageSet.splice(0);
                                            this.image = '';
                                            this.imageActivity = null;
                                            this.imageHead = 0;
                                            this.fail=false;
                                            this.pass = true;
                                            setTimeout(this.show_off, 3000);
                                        })
                                        .catch(error=>{
                                            axios.post('/club/cmsMedia-deleteMedia/1',{
                                                ImageSet:response.data
                                            });
                                            console.log(error.response);
                                            this.pass=false;
                                            this.fail = true;
                                            setTimeout(this.show_off, 3000)
                                        })
                                })
                                .catch(error=>error.response)
                        }
                    }else if(n===2){
                        for (let i in this.$refs.video.files){
                            formData.append(i,this.$refs.video.files[i]);
                        }
                        if(this.$refs.video.files[0]){
                            axios.post('/club/cmsMedia-inputMedia/2',formData)
                                .then(response=>{
                                    console.log(this.videoActivity);
                                    console.log('asd',response.data);
                                    axios.post('{{url('/club/cmsMedia-input/2')}}',{
                                        videoActivity:this.videoActivity,
                                        videoSet:response.data,
                                    })
                                        .then(response=>{
                                            this.$refs.video.value = null;
                                            this.videoSet.splice(0);
                                            this.video = '';
                                            this.videoActivity = null;
                                            this.video1Head = 0;
                                            this.video2Head = 0;
                                            this.fail=false;
                                            this.pass = true;
                                            setTimeout(this.show_off, 3000);
                                        })
                                        .catch(error=>{
                                            axios.post('/club/cmsMedia-deleteMedia/2',{
                                                VideoSet:response.data
                                            });
                                            console.log(error.response);
                                            this.pass=false;
                                            this.fail = true;
                                            setTimeout(this.show_off, 3000);
                                        })
                                })
                                .catch(error=>error.response)
                        }
                    }
                },
                play(){
                    this.playVideo = true;
                    this.video2Head = this.video1Head;
                    this.$refs.v2.src = this.video = '{{asset('storage/app/public/club/video/temp')}}'+'/'+this.videoSet[this.video2Head]+'#t=0.5';
                }
            },
            mounted() {
                axios.post('{{url('/club/cmsMedia-getActivity')}}').then(response=>{
                    for (let i in response.data){
                        Vue.set(this.activities,i,response.data[i]);
                    }
                });
            }
        });
    </script>
@endsection
