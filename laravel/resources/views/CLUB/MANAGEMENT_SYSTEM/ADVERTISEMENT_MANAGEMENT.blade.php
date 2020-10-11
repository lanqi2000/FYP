@extends('CTEMPLATE.CTEMPLATE')
@section('h-ctemplate')
    <link rel="stylesheet" href="{{asset('public/css/CLUB/MANAGEMENT_SYSTEM/ADVERTISEMENT_MANAGEMENT.css')}}">
@endsection
@section('b-ctemplate')
    <h1 class="header" style="width: 400px">ADVERTISEMENT MANAGEMENT</h1>

    <div id="advertisement-management">
        <div style="display: flex; flex-direction: row; margin: 30px 0 10px 30px;">
            <div class="am-option" @click="changeShow(1)" :class="{selected:createShow}">CREATE ADVERTISEMENT</div>
            <div class="am-option" @click="changeShow(2)" :class="{selected:deleteShow}">DELETE ADVERTISEMENT</div>
        </div>

        <div class="slide_group" v-if="createShow">
            <img class="banner" :src="image" alt="">
        </div>

        <div class="ads-panel" v-if="createShow">
            <div class="adsPicture-container">
                <div>Recommendation : 900px x 450px</div>
                <label for="adsPicture" class="myButton">+ select image</label>
                <input id="adsPicture" ref="image" type="file" accept="image/jpeg,image/png" style="display: none;" @change="preview">
            </div>
            <div class="adsLink-container">
                <label>Select activity :</label>
                <select v-model="id" style="width: 200px; margin-left: 10px">
                    @foreach($getAct as $act)
                        <option :value="'{{$act['activity_id']}}'">{{ $act['activity_name'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
{{--        delete--}}
        <div id="advertisement" v-if="deleteShow">
            <div class="slide_viewer" v-if="bannerSet.length!==0">
                <div class="slide-container" :style="{marginLeft:'-' + positionBanner + 'px'}">
                    <div class="slide_group" v-for="(banner,key) in bannerSet">
                        <div class="slide-no">@{{ key+1 }}</div>
                        <a class="banner-container" :href="banner.image" target="_blank"><img class="banner" :src="banner.link" alt=""></a>
                    </div>
                </div>
                <div class="previous_btn" title="Previous" @click="moveToLeft">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="35px" height="35px" viewBox="-11 -11.5 65 66">
                        <g>
                            <g>
                                <path fill="#474544" d="M-10.5,22.118C-10.5,4.132,4.133-10.5,22.118-10.5S54.736,4.132,54.736,22.118
                  c0,17.985-14.633,32.618-32.618,32.618S-10.5,40.103-10.5,22.118z M-8.288,22.118c0,16.766,13.639,30.406,30.406,30.406 c16.765,0,30.405-13.641,30.405-30.406c0-16.766-13.641-30.406-30.405-30.406C5.35-8.288-8.288,5.352-8.288,22.118z"/>
                                <path fill="#474544" d="M25.43,33.243L14.628,22.429c-0.433-0.432-0.433-1.132,0-1.564L25.43,10.051c0.432-0.432,1.132-0.432,1.563,0	c0.431,0.431,0.431,1.132,0,1.564L16.972,21.647l10.021,10.035c0.432,0.433,0.432,1.134,0,1.564	c-0.215,0.218-0.498,0.323-0.78,0.323C25.929,33.569,25.646,33.464,25.43,33.243z"/>
                            </g>
                        </g>
                    </svg>
                </div>
                <div class="next_btn" title="Next" @click="moveToRight">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="35px" height="35px" viewBox="-11 -11.5 65 66">
                        <g>
                            <g>
                                <path fill="#474544" d="M22.118,54.736C4.132,54.736-10.5,40.103-10.5,22.118C-10.5,4.132,4.132-10.5,22.118-10.5	c17.985,0,32.618,14.632,32.618,32.618C54.736,40.103,40.103,54.736,22.118,54.736z M22.118-8.288	c-16.765,0-30.406,13.64-30.406,30.406c0,16.766,13.641,30.406,30.406,30.406c16.768,0,30.406-13.641,30.406-30.406 C52.524,5.352,38.885-8.288,22.118-8.288z"/>
                                <path fill="#474544" d="M18.022,33.569c 0.282,0-0.566-0.105-0.781-0.323c-0.432-0.431-0.432-1.132,0-1.564l10.022-10.035 			L17.241,11.615c 0.431-0.432-0.431-1.133,0-1.564c0.432-0.432,1.132-0.432,1.564,0l10.803,10.814c0.433,0.432,0.433,1.132,0,1.564 L18.805,33.243C18.59,33.464,18.306,33.569,18.022,33.569z"/>
                            </g>
                        </g>
                    </svg>
                </div>
            </div>
        </div>

        <div class="ads-delete" v-if="deleteShow">
            <table class="ads-delete-table">
                <tr><td class="ads-delete-head"><table><tr>
                                <th style="width:45px">No</th>
                                <th style="width:295px">Activity</th>
                                <th style="width:250px">Create At</th>
                                <th style="width:110px"><div>Delete</div></th>
                            </tr></table></td></tr>
                <tr><td class="ads-delete-body"><table>
                            @if(!empty($getAds))
                                @foreach($getAds as $key=>$ads)
                                    <tr style="height: 40px" :class="{clecklistselect:bannerSet['{{$key}}'].status}" v-if="bannerSet.length!==0">
                                        <td style="width:50px; text-align: center;">{{$key+1}}</td>
                                        <td style="width:300px; text-align: center; border-left: 2px dashed #343959;">{{$ads['activity_name']}}</td>
                                        <td style="width:250px; text-align: center; border-left: 2px dashed #343959;">{{$ads['advertisement_created_at']}}</td>
                                        <td style="width:110px; border-left: 2px dashed #343959;"><div class="ads-delete-button" @click="deleteAds('{{$ads['advertisement_id']}}','{{$ads['advertisement_picture']}}','{{$key}}')">Delete</div></td>
                                    </tr>
                                @endforeach
                            @endif
                        </table></td></tr>
            </table>
        </div>

        <div class="myButton_small" @click="submit" v-if="createShow">Publish</div>
        <transition name="flash">
            <div class="submited" v-if="pass">Successful</div>
        </transition>
        <transition name="flash">
            <div class="submited" v-if="fail" style="background-color: #f70000; width: 250px;">Please Complete the Setting</div>
        </transition>
    </div>
@endsection
@section('s-ctemplate')
    <script>
        let advertisement = new Vue({
            el:"#advertisement-management",
            data:{
                createShow:false,
                deleteShow:true,

                image:'',
                id:'',

                bannerSet:[],
                defaultWidth:960,
                banner:0,
                positionBanner:0,

                pass:false,
                fail:false
            },
            methods:{
                changeShow(n){
                    this.createShow = this.deleteShow = false;
                    switch (n){
                        case 1:this.createShow=true;break;
                        case 2:this.deleteShow=true;break;
                    }
                },
                preview(e){
                    this.image= '';
                    let reader = new FileReader();
                    let media = e.target.files[0];
                    reader.readAsDataURL(media);
                    reader.onload = e =>{
                        this.image = e.target.result;
                    }
                },
                moveToLeft(){
                    if (this.banner !== 0) {
                        this.bannerSet[this.banner].status = false;
                        this.banner--;
                    } else {
                        this.bannerSet[this.banner].status = false;
                        this.banner = this.bannerSet.length-1;
                    }
                    this.positionBanner = this.defaultWidth * this.banner;
                    this.bannerSet[this.banner].status = true;
                },
                moveToRight(){
                    if (this.banner < this.bannerSet.length-1) {
                        this.bannerSet[this.banner].status = false;
                        this.banner++;
                    } else {
                        this.bannerSet[this.banner].status = false;
                        this.banner = 0;
                    }
                    this.positionBanner = this.defaultWidth * this.banner;
                    this.bannerSet[this.banner].status = true;
                },
                deleteAds(id,picture,n){
                    axios.post('{{url('/club/cmsAdvertisement-delete')}}',{
                        id:id,
                        image:picture
                    })
                    .then(response=>{
                        window.location.reload();
                    })
                    .catch(error=>console.log(error.response))
                },
                reset(){
                    this.image = '';
                    this.id = '';
                    this.$refs.image.value = null;
                },
                show_off(){
                    this.fail = false;
                    this.pass = false;
                },
                submit(){
                    let formData = new FormData;
                    if(this.$refs.image.files[0] && this.id!==''){
                        formData.append('image',this.$refs.image.files[0]);
                        formData.append('link',this.id);
                        let i = 0;
                        @foreach($getAct as $act)
                            if('{{$act['activity_id']}}'==this.id && i===0){
                                formData.append('name','{{$act['activity_name']}}');
                                i++;
                            }
                        @endforeach
                        axios.post('{{url('/club/cmsAdvertisement-input')}}',formData)
                            .then(response=> {
                                this.fail = false;
                                this.pass = true;
                                setTimeout(this.show_off,3000);
                                this.reset();
                            })
                            .catch(error=>console.log(error.response));
                    }else{
                        this.fail = true;
                        setTimeout(this.show_off,3000);
                    }
                }
            },
            mounted() {
                let object = {};
                @if(!empty($getAds))
                    @foreach($getAds as $key=>$ads)
                        object = {};
                        object.image = '{{url("/club/rActivity/").'/'.$ads['activity_id']}}';
                        object.link = '{{asset('storage/app/public/advertisement').'/'.$ads['advertisement_picture']}}';
                        if('{{$key}}'!=0){
                            object.status = false;
                        }else{
                            object.status = true;
                        }
                    Vue.set(this.bannerSet,this.bannerSet.length,object);
                    @endforeach
                @endif
            }
        });
    </script>
@endsection
