@extends('CTEMPLATE.CTEMPLATE')
@section('h-ctemplate')
    <link rel="stylesheet" href="{{asset('public/css/CLUB/MANAGEMENT_SYSTEM/MEDIA_MANAGEMENT.css')}}">
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
                        <option value="0">Not Activity</option>
                        <option v-for="value in activities" :value="value.activity_id">@{{ value.activity_name }}</option>
                    </select>
                    <div class="myButton_small" @click="finalUpload(1)">Upload</div>
                </div>
            </div>
            <div class="mm-header">UPLOAD VIDEO</div>
            <div class="mm-box">
                <div class="mm-box-left">
                    <div class="preview-arrow" @click="changePreview(3)"><</div>
                    <div class="preview">
                        <video height="auto" style="outline:none;" width="100%" controls v-if="video">
                            <source :src="video" type="video/mp4" />
                        </video>
                    </div>
                    <div class="preview-arrow" @click="changePreview(4)">></div>
                </div>
                <div class="mm-box-right">
                    <input type="file" ref="video" id="video" accept="video/mp4" style="display: none;" @change="upload(2)" multiple>
                    <label class="myButton" for="video">+ Select Image</label>
                    <select class="activity-selection" v-model="videoActivity">
                        <option value="0">Not Activity</option>
                        <option v-for="value in activities" :value="value.activity_id">@{{ value.activity_name }}</option>
                    </select>
                    <div class="myButton_small" @click="finalUpload(2)">Upload</div>
                </div>
            </div>
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
                videoHead:0,
                videoSet:[],
                videoActivity:null,

                activities:[],

                pass:false,
                fail:false,
            },
            methods:{
                upload(n){
                    let formData = new FormData;
                    if(n===1){
                        for (let i in this.$refs.image.files){
                            formData.append(i,this.$refs.image.files[i]);
                            if(this.$refs.image.files[0]){
                                axios.post('/club/cmsMedia-upload/1',formData)
                                    .then(response=> {
                                        console.log(response.data);
                                        this.imageSet.splice(0);
                                        this.image = null;
                                        this.image = '{{asset('public/storage/club/picture/temp')}}'+'/'+response.data[0];
                                        this.imageSet = response.data;
                                    })
                                    .catch(error=>error.response)
                            }
                        }
                    }else if(n===2){
                        for (let i in this.$refs.video.files){
                            formData.append(i,this.$refs.video.files[i]);
                            if(this.$refs.video.files[0]){
                                axios.post('/club/cmsMedia-upload/2',formData)
                                    .then(response=> {
                                        this.videoSet.splice(0);
                                        this.video = null;
                                        this.video = '{{asset('public/storage/club/video/temp')}}'+'/'+response.data[0];
                                        this.videoSet = response.data;
                                    })
                                    .catch(error=>error.response)
                            }
                        }
                    }
                },
                changePreview(n){
                    console.log()
                    if(this.imageSet.length>1){
                        switch (n){
                            case 1:
                                if (this.imageHead!==0){
                                    this.imageHead--;
                                    this.image = '{{asset('public/storage/club/picture/temp')}}'+'/'+this.imageSet[this.imageHead];
                                }
                                break;
                            case 2:
                                if (this.imageHead!==this.imageSet.length-1){
                                    this.imageHead++;
                                    this.image = '{{asset('public/storage/club/picture/temp')}}'+'/'+this.imageSet[this.imageHead];
                                }
                                break;
                            case 3:
                                if (this.videoHead!==0){
                                    this.videoHead--;
                                    this.video = '{{asset('public/storage/club/video/temp')}}'+'/'+this.videoSet[this.videoHead];
                                }
                                break;
                            case 4:
                                if (this.videoHead!==this.videoSet.length-1){
                                    this.videoHead++;
                                    this.video = '{{asset('public/storage/club/video/temp')}}'+'/'+this.videoSet[this.videoHead];
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
                                            setTimeout(this.show_off, 3000);
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
                                            this.videoHead = 0;
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
