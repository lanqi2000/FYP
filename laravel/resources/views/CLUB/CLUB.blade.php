@extends('CTEMPLATE.CTEMPLATE')
@section('h-ctemplate')
    <link rel="stylesheet" href="{{asset('public/css/CLUB/CLUB.css')}}">
@endsection
@section('b-ctemplate')

    <div class="pageHeader" id="pageHeader">
        <div class="logo">
            <img src="{{asset('resources/views/IMAGE/LOGO.png')}}" width="100%" height="100%">
        </div>
        <div>
            <h1 class="pageName">@{{title}}</h1>
            <p class="pageDiscribe">@{{ pageDiscribe }}</p>
            <a class="register">Register</a>
        </div>
    </div>

    <div id="advertisement">
        <div class="slide_viewer">
            <div class="slide-container" :style="{marginLeft:'-' + positionBanner + 'px'}">
                <div class="slide_group" v-for="banner in bannerSet">
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

    <div id="p-container">
        @if($dataset!=[])
            @foreach($dataset as $key=>$data)
                <post :postid="'{{$data['post_id']}}'" :title="'{{$data['post_title']}}'" :caption="'{{$data['post_caption']}}'" :mediaset="'{{$data['post_media']}}'" :totallike="'{{$data['post_total_like']}}'" :like="'{{$data['post_like']}}'" :comments="'{{$data['post_comment']}}'"></post>
            @endforeach
        @endif
        <iframe name="postHere" style="display: none" ></iframe>
    </div>
@endsection
@section('s-ctemplate')
    <script>
        Vue.component('historycomment',{
            props:['commentset','picture'],
            data:function(){
                return{
                    more:false,
                    keep:false,
                    firstComment:'',
                    member:true,
                    commentSet:[this.commentset.comment[0]],
                }
            },
            template:`<div class="comment-column" :class="{flexReverse:member}" >
                          <img :src="picture" height="30px" width="30px" style="border-radius: 50%;"/>
                          <div style="display: flex; flex-direction: column;">
                              <div v-for="comment in commentSet" class="comment" :class="{flexReverse:member}">@{{comment}}</div>
                              <div class="more-keep" v-if="more" @click="moreKeep" style="font-size: 12px" :class="{flexReverse:member}">more</div>
                              <div class="more-keep" v-if="keep" @click="moreKeep" style="font-size: 12px" :class="{flexReverse:member}">keep</div>
                          </div>
                      </div>`,
            methods:{
                moreKeep(){
                    if(this.more===true){
                        this.commentSet = this.commentset.comment;
                    }else{
                        this.commentSet = [];
                        this.commentSet.push(this.commentset.comment[0]);
                    }
                    let middle = this.more;
                    this.more = this.keep;
                    this.keep = middle;
                },
            },
            mounted(){
                if(this.commentset.comment.length>1){
                    this.more = true;
                }
                if(this.commentset.id=='127'){
                    this.member = true;
                }else{
                    this.member = false;
                }
            }
        });
        Vue.component('post',{
            props:['postid','title','caption','mediaset','like','comments','totallike'],
            data:function (){
                return{
                    media:[],
                    more:false,
                    keep:false,
                    arrowShow:false,
                    mediaView:'',
                    mediaKey:0,
                    mediaType:'',
                    videoShow:false,

                    //post interact
                    love:false,
                    likes:this.like,
                    totalLike:0,

                    commentMore:false,
                    commentKeep:false,
                    commentOut:false,
                    commentsetAlpha:[],
                    commentsetBeta:[],
                    commentPublish:false,
                    picture:'as',
                }
            },
            template:`<div class="pm-create-container">
            <div class="post">
                <div class="post-title">
                    <div class="preview">@{{title}}</div>
                </div>
                <div class="post-media" @overMouse="true">
                    <mediabox :mediaview="mediaView" :videoshow="videoShow"></mediabox>
                    <div class="arrow" v-if="arrowShow" style="left: 20px" @click="changeLeftMedia"><</div>
                    <div class="arrow" v-if="arrowShow" style="right: 20px" @click="changeRightMedia">></div>
                </div>
                <div class="post-interact">
                    <div class="post-panel">
                        <div style="margin-left: 5px">@{{ totalLike }}</div>
                        <form method="post" action="{{url('/club/club-input-like')}}" target="postHere">
                            <label style="height: 25px;width: 25px;margin: 10px;"><input type="image" class="love" style="margin: 3px 0 0;" src="{{asset('resources/views/ICON/heart.png')}}" :class="{loveit:love}" @click="loveIt"></label>
                            <input type="hidden" name="love" :value="likes" >
                            <input type="hidden" name="post_id" :value="postid" >
                        </form>
                        <img class="comment-panel" src='{{asset('resources/views/ICON/comment.svg')}}' @click="commentOut=!commentOut">
                    </div>
                    <transition name="flash">
                        <div class=comment-box v-if="commentOut">
                            <div class="history-comment" >
                                <historycomment v-for="myComment in commentsetBeta" :commentset="myComment" :picture="picture"></historycomment>
                                <div class="more-keep" v-if="commentMore" @click="commentMoreKeep" style="font-size: 14px; color: yellow;">more</div>
                                <div class="more-keep" v-if="commentKeep" @click="commentMoreKeep" style="font-size: 14px; color: darkorange;">keep</div>
                            </div>
                            <form style="display: flex; flex-direction: row; align-items: center;" method="post" action="{{url('/club/club-input-comment')}}" target="postHere">
                                <input type="text" ref="comment" name="post_comment" class="comment-area" required/>
                                <input type="hidden" name="post_id" :value="postid"/>
                                <div class="comment-submit">
                                    <input type="image" src="{{asset('resources/views/ICON/commentSubmit.svg')}}" width="20px" height="20px" style="filter: invert(100%);" @click="commentSubmit"/>
                                </div>
                            </form>
                        </div>
                    </transition>
                </div>
                <div class="post-caption">
                    <div class="caption">
                        <div class="preview" ref="caption" :class="{captionOverflow:more}" style="overflow-wrap: break-word; width: 580px;">@{{caption}}</div>
                    </div>
                    <footer class="post-footer">
                        <div class="post-date">
                        @if($dataset!=[])
                            @if(!empty($data['updated_at']))
                                {{$data['updated_at']}}
                            @else
                                {{$data['created_time']}}
                            @endif
                        @endif
                        </div>
                        <div class="mmore-keep" v-if="more" @click="moreKeep">more</div>
                        <div class="more-keep" v-if="keep" @click="moreKeep">keep</div>
                    </footer>
                </div>
            </div>
        </div>`,
            methods:{
                moreKeep(){
                    let middle = this.more;
                    this.more = this.keep;
                    this.keep = middle;
                },
                preset(){
                    this.media = JSON.parse(this.mediaset);
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
                    //love it or not?
                    if(this.like==1){
                        this.love = !this.love;
                        this.likes = 1;
                    }
                    else{
                        this.likes = 0;
                    }
                    this.totalLike = this.totallike;
                    this.setComment()
                },
                setComment(){
                    if(this.comments!=='[]'){
                        let commentSet;
                        commentSet = this.comments.replace("[\"","");
                        commentSet = commentSet.replace("\"]","");
                        commentSet = commentSet.split("\"\,\"");

                        let userid=0;
                        let object = {};
                        object.comment = [];
                        //----- PACK {start} -----
                        for(let i=0;i<commentSet.length;i++){
                            let commentArray;
                            commentArray = commentSet[i].split("!@##@!");

                            if(commentArray[1]=='127'){
                                if(userid===1){
                                    //pack
                                    this.commentsetAlpha.push(object);
                                    object={};
                                    object.comment = [];
                                    userid=127;
                                }
                                if(userid===0||userid===127){
                                    //push
                                    object.id = 127;
                                    object.comment.push(commentArray[0]);
                                }

                                userid=127;
                            }else if(commentArray[1]=='1'){
                                if(userid===127){
                                    //pack
                                    this.commentsetAlpha.push(object);
                                    object={};
                                    object.comment = [];
                                    userid=1;
                                }
                                if(userid===0||userid===1){
                                    //push
                                    object.id = 1;
                                    object.comment.push(commentArray[0]);
                                }
                                userid=1;
                            }
                            //pack
                            if(i===commentSet.length-1){
                                this.commentsetAlpha.push(object);
                                object={};
                                object.comment = [];
                            }
                        }
                        //----- PACK {end} -----
                        this.commentsetBeta.push(this.commentsetAlpha[0]);
                        if(this.commentsetAlpha.length>1){
                            this.commentMore = true;
                        }
                    }
                },
                changeLeftMedia(){
                    if (this.mediaKey > 0){
                        this.mediaKey--;
                    }
                    let prefix = '{{asset('storage/app/public/')}}';
                    this.mediaView = prefix + '/' + this.media[this.mediaKey];
                    this.mediaType = this.media[this.mediaKey].split(".").pop();
                    if(this.mediaType==='mp4'){
                        this.videoShow = true;
                    }
                    else{
                        this.videoShow = false;
                    }
                },
                changeRightMedia(){
                    if (this.mediaKey < this.media.length-1){
                        this.mediaKey++;
                    }
                    let prefix = '{{asset('storage/app/public/')}}';
                    this.mediaView = prefix + '/' + this.media[this.mediaKey];
                    this.mediaType = this.media[this.mediaKey].split(".").pop();
                    if(this.mediaType==='mp4'){
                        this.videoShow = true;
                    }
                    else{
                        this.videoShow = false;
                    }
                },
                loveIt(){
                    this.love = !this.love;
                    if(this.likes==1){
                        this.likes = 0;
                        this.totalLike--;
                    }
                    else{
                        this.likes = 1;
                        this.totalLike++;
                    }

                },
                commentMoreKeep(){
                    if(this.commentMore===true){
                        this.commentsetBeta = this.commentsetAlpha;
                    }else{
                        this.commentsetBeta = [];
                        this.commentsetBeta.push(this.commentsetAlpha[0]);
                    }
                    let middle = this.commentMore;
                    this.commentMore = this.commentKeep;
                    this.commentKeep = middle;
                },
                publishComment(){
                    let commentTemp = this.$refs.comment.value;
                    this.$refs.comment.value = '';
                    let object = {};
                    object.comment=[];
                    object.comment.push(commentTemp);
                    object.id = 127;
                    this.commentsetAlpha.push(object);
                    this.commentsetBeta.push(object);
                    this.commentPublish=false;
                },
                commentSubmit(){
                    if(this.$refs.comment.value !=''){
                        if(this.commentPublish===false){
                            setTimeout(this.publishComment,300);
                        }
                        this.commentPublish = true;
                        // this.$refs.comment.value = ''; ------------------------------------ set input empty
                    }
                }
            },
            mounted() {
                this.preset();
                let height = this.$refs.caption.clientHeight;
                if (height>70 && this.keep===false){
                    this.more = true;
                }
            },
        });

        var head = new Vue({
            el:'#pageHeader',
            data:{
                title:'TEETH CLUB',
                pageDiscribe: 'teeth club is very interest'
            },
        });

        let advertisement = new Vue({
            el:"#advertisement",
            data:{
                bannerSet:[],
                defaultWidth:960,
                banner:0,
                positionBanner:0
            },
            methods:{
                change(){
                    if(this.banner < this.bannerSet.length-1){
                        this.banner++;
                    }else{
                        this.banner = 0;
                    }
                    this.positionBanner = this.defaultWidth * this.banner;
                    setTimeout(this.change,4000);
                },
                moveToLeft(){
                    if (this.banner !== 0) {
                        this.banner--;
                    } else {
                        this.banner = this.bannerSet.length-1;
                    }
                    this.positionBanner = this.defaultWidth * this.banner;

                },
                moveToRight(){
                    if (this.banner < this.bannerSet.length-1) {
                        this.banner++;
                    } else {
                        this.banner = 0;
                    }
                    this.positionBanner = this.defaultWidth * this.banner;
                }
            },
            mounted() {
                let object = {};
                @foreach($getAds as $key=>$ads)
                    object = {};
                    object.image = '{{url("/club/rActivity/").'/'.$ads['activity_id']}}';
                    object.link = '{{asset('storage/app/public/advertisement').'/'.$ads['advertisement_picture']}}';
                    Vue.set(this.bannerSet,this.bannerSet.length,object);
                @endforeach
                setTimeout(this.change,5000);
            }
        });

        var post = new Vue({
            el:'#p-container',
        });
    </script>
@endsection
