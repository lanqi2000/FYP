@extends('TEMPLATE.TEMPLATE')
@section('h-template')
<link rel="stylesheet" href="{{asset('public/css/PERSONAL_PROFILE.css')}}">
@endsection
@section('b-template')
    <div id="profile">
        <div class="pro-container">
            <h1 class="header" style="text-align: center">MY PROFILE</h1>
            <form method="post" style="display: flex;flex-direction: row;" action="{{url('/pProfile_input')}}" enctype="multipart/form-data" target="postHere" @submit="submited">
                <div class="profile-column">
                    <div style="border: 3px solid #343959; width:150px; height:150px; margin: 0 auto">
                            <img :src="picture" height="150px" width="150px" >
                    </div>
                    <div>
                        <input type="file" id="file" accept="image/*" style="display: none" ref="image" @change="preview">
                        <label for="file"><div class="myButton" style="width: 188px;">+ Choose a Picture</div></label>
                    </div>
                    <div class="form-box input-text">
                        <label class="form-label">User Id</label>
                        <input class="form-input" style="color: darkgrey" type="text" value="127" disabled/>
                    </div>
                    <div class="form-box input-text">
                        <label class="form-label">Name</label>
                        <input class="form-input" type="text" v-model="name" @change="defaultDataPack(1)"/>
                    </div>
                </div>
                <div class="profile-column"style="display: flex;flex-direction: column;">
                    <div class="form-box">
                        <label class="form-label">Gender</label>
                        <div class="input-radio-checkbox">
                            <input class="form-input" name="gender" v-model="gender" value="Male" type="radio" @change="defaultDataPack(2)"/>
                            <label style="margin: 0 10px;">Male</label>
                        </div>
                        <div class="input-radio-checkbox">
                            <input class="form-input" name="gender" v-model="gender" value="Female" type="radio" @change="defaultDataPack(2)"/>
                            <label style="margin: 0 10px;">Female</label>
                        </div>
                    </div>
                    <div class="form-box input-text">
                        <label class="form-label">Student ID</label>
                        <input class="form-input" type="text" v-model="studentId" @change="defaultDataPack(3)"/>
                    </div>
                    <div class="form-box input-text">
                        <label class="form-label">Contact Number</label>
                        <input class="form-input" type="text" v-model="contactNumber" @change="defaultDataPack(4)"/>
                    </div>
                    <div class="finalStep">
                        <div class="myButton_small" @click="submit">Save</div>
                        <input type="reset" class="myButton_small" @click="reset">
                        <div @click="window.history.back()" class="myButton_small">Cancel</div>
                    </div>
                </div>
            </form>
            <iframe name="postHere" ref="submit" style="display:none;" ></iframe>
        </div>
        <transition name="flash">
            <div class="submited" v-if="submited_show">Saved</div>
        </transition>
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
    var profile = new Vue({
        el:'#profile',
        data:{
            picture:'{{asset('resources/views/IMAGE/User.png')}}',
            name:'{{$data['user_name']}}',
            gender:'{{$data['user_gender']}}',
            studentId:'{{$data['student_id']}}',
            contactNumber:'{{$data['user_hp']}}',

            submited_show:false
        },
        methods:{
            setData(){
                if('{{$data['user_picture']}}'!==''){
                    this.picture = '{{asset('public/storage/profilePic/'.$data['user_picture'])}}';
                }
            },
            preview(e){
                var image = e.target.files[0];
                var reader = new FileReader();
                reader.readAsDataURL(image);
                reader.onload = e =>{
                    this.picture = e.target.result;
                }
            },
            submit(){
                let formData = new FormData;
                if(this.$refs.image.files[0]){
                    formData.append('picture',this.$refs.image.files[0]);
                }
                formData.append('name',this.name);
                formData.append('gender',this.gender);
                formData.append('studentId',this.studentId);
                formData.append('contactNumber',this.contactNumber);
                for(var pair of formData.entries()) {
                    console.log(pair[0]+ ', '+ pair[1]);
                }
                axios.post('pProfile_input',formData)
                    .then(response=>this.submited())
                    .catch(error=>console.log(error.response));
            },
            reset(){
                this.name='';
                this.gender='';
                this.studentId='';
                this.contactNumber='';
            },
            show_off(){
                this.submited_show = false;
            },
            submited(){
                this.submited_show = true;
                setTimeout(this.show_off, 3000);
            },
        },
        mounted() {
            this.setData();
        },
    });
</script>
@endsection
