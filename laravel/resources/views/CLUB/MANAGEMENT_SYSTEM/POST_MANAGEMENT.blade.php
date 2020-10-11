@extends('CTEMPLATE.CTEMPLATE')
@section('h-ctemplate')
    <link rel="stylesheet" href="{{asset('public/css/CLUB/MANAGEMENT_SYSTEM/POST_MANAGEMENT.css')}}"
          xmlns="http://www.w3.org/1999/html">
@endsection
@section('b-ctemplate')
    <h1 class="header" style="width: 360px">POST MANAGEMENT</h1>
    <div id="post-management">
        <div class="pm-container">
            <div style="display: flex; flex-direction: row;">
                <div class="pm-option" @click="changeShow(1)" :class="{selected:createShow}">CREATE POST</div>
                <div class="pm-option" @click="changeShow(2)" :class="{selected:editShow}">EDIT POST</div>
            </div>
            <div class="pm-body">
                <div v-if="editShow">
                    <table class="post-list">
                        <tr style="background-color: #3c4161;">
                            <td>
                                <table>
                                    <tr class="post-list-header" style="width: 700px">
                                        <th class="post-list-element" style="width: 35px;">No</th>
                                        <th class="post-list-element" style="width: 390px;">Post title</th>
                                        <th class="post-list-element" style="width: 198px;">Create/Edit time</th>
                                        <th class="post-list-element" style="width: 80px;">Edit</th>
                                        <th class="post-list-element" style="width: 80px;">Delete</th>
                                    </tr>
                                </table>
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <div class="post-list-body" style="width: 800px">
                                    <table>
                                        <check-list v-for="(checklist,key) in showchecklist" :listkey="key" :postid="checklist.postId" :posttitle="checklist.title" :createdtime="checklist.time" @delete="postDelete" @postdata="setPost"></check-list>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="post" v-if="postEditUI">
                    <div class="post-title">
                        <div class="preview">@{{title}}</div>
                        <textarea cols="20" rows="1" v-model="title" v-show="editTitle" @blur="editTitle=false" style="resize: none; margin-right: 10px ;" required></textarea>
                        <img class="edit" src="{{asset('resources/views/ICON/Add.svg')}}" @click="editTitle=true">
                        <div class="alert" v-if="title===''">Please Key In Something</div>
                    </div>
                    <div class="post-media" @overMouse="true">
                        <mediabox :mediaview="mediaView" v-if="editMedia" :videoshow="videoShow"></mediabox>
                        <div class="arrow" v-if="arrowShow" style="left: 20px" @click="changeLeftMedia"><</div>
                        <div class="arrow" v-if="arrowShow" style="right: 20px" @click="changeRightMedia">></div>
                        <label class="edit" for="media-upload" style="right: 10px;top: 10px;position: absolute;">
                            <img src="{{asset('resources/views/ICON/Add.svg')}}" class="edit"/>
                        </label>
                        <div class="alert" v-if="mediaView===''">Please Input Something</div>
                        <input id="media-upload" ref="media" type="file" accept="image/jpeg,image/png,video/mp4" style="display: none" @change="preview" multiple required/>
                    </div>
                    <div class="post-panel">
                        <img class="love" src="{{asset('resources/views/ICON/heart.png')}}">
                    </div>
                    <div class="post-caption">
                        <div class="caption">
                            <div class="preview" ref="caption" :class="{captionOverflow:more}" style="overflow-wrap: break-word; width: 580px;">@{{caption}}</div>
                        </div>
                        <div class="more-keep" v-if="more" @click="moreKeep">more</div>
                        <div class="more-keep" v-if="keep" @click="moreKeep">keep</div>
                        <textarea rows="4" cols="78" v-model="caption" v-show="editCaption" @blur="editCaption=false" style="margin-top: 10px;" required></textarea>
                        <div style="display:flex; flex-direction: row; align-items: center; margin-top: 10px;">
                            <img src="{{asset('resources/views/ICON/Add.svg')}}" class="edit" @click="editCaption=true">
                            <div class="alert" v-if="caption===''" style="width: 186px;">Please Key In Something</div>
                        </div>
                    </div>
                    <div class="myButton_small" @click="createPost" v-if="createShow">Post</div>
                    <div class="myButton_small" @click="editPost" v-if="editShow">Save</div>
                </div>
            </div>
        </div>
        <transition name="flash">
            <div class="submited" v-if="submited_show">Posted</div>
        </transition>
        <transition name="flash">
            <div class="submited" v-if="save">Saved</div>
        </transition>
        <transition name="flash">
            <div class="submited" v-if="fail" style="background-color: #f70000; width: 250px;">Please Complete the Post</div>
        </transition>
    </div>
@endsection
@section('s-ctemplate')
    <script>
        Vue.component('check-list',{
            props:['listkey','postid','posttitle','createdtime'],
            data:function(){
                return {
                    status:true,
                    select:false
                }
            },
            template:`
            <transition name="flash">
                <tr v-if="status" :class="{clecklistselect:select}">
                    <td class="post-list-element" style="width: 43px; text-align: center;">@{{listkey+1}}</td>
                    <td class="post-list-element" style="width: 400px;">@{{posttitle}}</td>
                    <td class="post-list-element" style="width: 210px;">@{{createdtime}}</td>
                    <td class="post-list-element" style="width: 80px; text-align: center;">
                        <div class="post-edit-button" @click="postData(postid)">Edit</div>
                    </td>
                    <td class="post-list-element" style="width: 80px; text-align: center;">
                        <div class="post-edit-button" style="background-color: #d0211c" @click="postDelete(postid)" @mousedown="select=true">Delete</div>
                    </td>
                </tr>
            </transition>`,
            methods:{
                postDelete(postid){
                    let status = confirm('Are you sure to delete this post?');
                    if(status===true){
                        axios.post('{{url('/club/cmsPost-delete')}}',{
                            postId : postid
                        }).then(response => {
                            this.status = false;
                            this.$emit('delete',postid);
                        });
                    }
                    else{
                        this.select = false;
                    }
                },

                postData(postid){
                    axios.post('{{url('/club/cmsPost-editGet')}}',{
                        postId : postid
                    }).then(response => this.$emit("postdata",response.data[0]));
                }
            }
        });
        var postManagement = new Vue({
            el:'#post-management',
            data:{
                createShow:true,
                editShow:false,
                postEditUI:true,
                editTitle:false,
                editMedia:false,
                editCaption:false,
                more:false,
                keep:false,
                postid:'',
                title:'',
                caption:'',

                media:[],
                mediaFile:[],
                mediaView:'',
                mediaKey:0,
                mediaType:'',
                videoShow:false,
                arrowShow:false,
                submited_show:false,
                fail:false,
                save:false,

                showchecklist:[],
            },
            methods:{
                changeShow(s){
                    if(s===1){
                        if(this.editShow){
                            this.postEditUI= true;
                            this.createShow= true;
                            this.editShow=false;
                            this.reset();
                        }
                    }else{
                        if(this.createShow){
                            this.postEditUI= false;
                            this.createShow= false;
                            this.editShow=true;
                            this.reset();
                        }
                    }
                },
                postDelete(id){
                    this.postEditUI= false;
                    for(let i in this.showchecklist){
                        if(this.showchecklist[i].postId==id){
                            this.showchecklist.splice(i,1);
                        }
                    }
                },
                setPost(data){
                    this.postEditUI = true;
                    this.postid = data['post_id'];
                    this.title = data['post_title'];
                    this.caption=data['post_caption'];
                    this.media = JSON.parse(data['post_media']);
                    this.editMedia = true;
                    if(this.media.length>1){
                        this.arrowShow = true;
                    }
                    let prefix = '{{asset('storage/app/public/')}}';
                    this.mediaView = prefix + '/' + this.media[0];
                    this.mediaType = this.mediaView.split(".").pop();
                    if (this.mediaType === 'mp4') {
                        this.videoShow = true;
                    } else {
                        this.videoShow = false;
                    }
                    if (this.media.length > 1) {
                        this.arrowShow = true;
                    } else {
                        this.arrowShow = false;
                    }
                },
                moreKeep(){
                    let middle = this.more;
                    this.more = this.keep;
                    this.keep = middle;
                },
                preview(e){
                    this.media= [];
                    for(let i=0;i<e.target.files.length;i++){
                        let times = e.target.files.length-1;
                        let reader = new FileReader();
                        let media = e.target.files[i];
                        this.mediaFile.push(media);
                        reader.readAsDataURL(media);
                        reader.onload = e =>{
                            this.media.push(e.target.result);
                            if(i===times){
                                this.mediaView = e.target.result;
                                this.mediaType = this.mediaView.substr(5,5);
                                if(this.mediaType==='video'){
                                    this.videoShow = true;
                                }
                                else{
                                    this.videoShow = false;
                                }
                            }
                            if(this.media.length>1){
                                this.arrowShow = true;
                            }
                            else{
                                this.arrowShow = false;
                            }
                        }
                    }
                    this.editMedia = true;
                },
                changeLeftMedia(){
                    if (this.mediaKey > 0){
                        this.mediaKey--;
                    }
                    this.mediaView = this.media[this.mediaKey];
                    if(this.media[this.mediaKey].substr(0,4)=='post'){
                        console.log(this.media[this.mediaKey].substr(0,4));
                        let prefix = '{{asset('storage/app/public/')}}';
                        this.mediaView = prefix + '/' + this.media[this.mediaKey];
                        this.mediaType = this.media[this.mediaKey].split(".").pop();
                        if(this.mediaType==='mp4'){
                            this.videoShow = true;
                        }
                        else{
                            this.videoShow = false;
                        }
                    }else{
                        this.mediaType = this.media[this.mediaKey].substr(5,5);
                        if(this.mediaType==='video'){
                            this.videoShow = true;
                        }
                        else{
                            this.videoShow = false;
                        }
                    }
                },
                changeRightMedia(){
                    if (this.mediaKey < this.media.length-1){
                        this.mediaKey++;
                    }
                    if(this.media[this.mediaKey].substr(0,4)=='post'){
                        console.log(this.media[this.mediaKey].substr(0,4));
                        let prefix = '{{asset('storage/app/public/')}}';
                        this.mediaView = prefix + '/' + this.media[this.mediaKey];
                        this.mediaType = this.media[this.mediaKey].split(".").pop();
                        if(this.mediaType==='mp4'){
                            this.videoShow = true;
                        }
                        else{
                            this.videoShow = false;
                        }
                    }else{
                        this.mediaView = this.media[this.mediaKey];
                        this.mediaType = this.media[this.mediaKey].substr(5,5);
                        if(this.mediaType==='video'){
                            this.videoShow = true;
                        }
                        else{
                            this.videoShow = false;
                        }
                    }
                },
                show_off(){
                    this.submited_show = false;
                    this.fail = false;
                    this.save= false;
                },
                reset(){
                    this.title= '';
                    this.media = [];
                    this.mediaView = '';
                    this.caption = '';
                    this.editMedia = false;
                    this.arrowShow = false;
                },
                submited(response) {
                    this.reset();
                    this.submited_show = true;
                    setTimeout(this.show_off, 3000);
                    let object = {}
                    object.postId = response.data['post_id'];
                    object.title = response.data['post_title'];
                    if(response.data['updated_at']){
                        object.time = response.data['updated_at'];
                    }else{
                        object.time = response.data['created_time'];
                    }
                    Vue.set(this.showchecklist,this.showchecklist.length,object)
                },
                createPost(){
                    if (this.title && this.caption && this.$refs.media.files[0]) {
                        let formdata = new FormData;
                        formdata.append('title', this.title);
                        formdata.append('caption', this.caption);
                        for (let i = 0; i < this.$refs.media.files.length; i++) {
                            formdata.append(i, this.$refs.media.files[i]);
                        }
                        axios.post('{{url('/club/cmsPost-input')}}', formdata, {
                            headers: {
                                "Content-Type": "multipart/form-data"
                            }
                        }).then(response => {
                            console.log('ok');
                            this.fail = false;
                            this.submited(response);
                        }).catch(function (error) {
                            console.log(error.response);
                        });
                    }else {
                        this.fail = true;
                        setTimeout(this.show_off, 3000);
                    }
                },
                editPost(){
                    if (this.title && this.caption) {
                        let formdata = new FormData;
                        formdata.append('postid',this.postid);
                        formdata.append('title', this.title);
                        formdata.append('caption', this.caption);
                        if(this.$refs.media.files[0]){
                            for (let i = 0; i < this.$refs.media.files.length; i++) {
                                formdata.append(i, this.$refs.media.files[i]);
                            }
                        }
                        axios.post('{{url('/club/cmsPost-editSave')}}', formdata, {
                            headers: {
                                "Content-Type": "multipart/form-data"
                            }
                        })
                            .then(response => {
                                console.log(response);
                                for(let i in this.showchecklist){
                                    if(this.showchecklist[i].postId==response.data['post_id']){
                                        let object = {}
                                        object.postId = response.data['post_id'];
                                        object.title = response.data['post_title'];
                                        if(response.data['updated_at']){
                                            object.time = response.data['updated_at'];
                                        }else{
                                            object.time = response.data['created_time'];
                                        }
                                        Vue.set(this.showchecklist,i,object)
                                    }
                                }
                                this.fail = false;
                                this.save = true;
                                setTimeout(this.show_off,4000);
                            })
                            .catch(function (error) {
                                console.log(error.response.data);
                            });
                    }else{
                        this.fail = true;
                        setTimeout(this.show_off,3000);
                    }
                }
            },
            updated() {
                let height = this.$refs.caption.clientHeight;
                if (height>100 && this.keep===false){
                    this.more = true;
                }
            },
            created(){
                let object = {};
                @foreach($getPost as $data)
                    object = {};
                    object.postId = '{{$data['post_id']}}';
                    object.title = '{{$data['post_title']}}';
                    @if(!empty($data['updated_at']))
                        object.time = '{{$data['updated_at']}}';
                    @else
                        object.time = '{{$data['created_time']}}';
                    @endif
                    Vue.set(this.showchecklist,this.showchecklist.length,object);
                @endforeach
            }
        });
    </script>
@endsection
