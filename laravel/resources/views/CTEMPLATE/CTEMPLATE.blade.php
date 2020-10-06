@extends('TEMPLATE.TEMPLATE')

@section('h-template')
    <link rel="stylesheet" href="{{asset('public/css/CTEMPLATE.css')}}">
    @yield('h-ctemplate')
@endsection

@section('b-template')
    <div id="right">
        @yield('b-ctemplate')
    </div>
    <div id="left" ref="el">
        <div style="position:fixed; top:20px;">
            <left-bar v-for="h in hover" :hover="h.status" :link="h.links" :icon="h.icons" :title="h.titles"></left-bar>
{{--                <div @click="lol">@{{ ee }}</div>--}}
        </div>
    </div>
    <div id="arf-container">
        <div id="ARF" title="ANONYMOUS RATING & FEEDBACK" @click="arf_show">
            <img src="{{asset('resources/views/CTEMPLATE/ICON/customer-review.png')}}" width="30px" style="filter: invert(100%); cursor: pointer;">
        </div>
        <div class="arf" v-if="arf">
            <h3>Feedback</h3>
            <div v-if="!noActivity">
                <label>For : </label>
                <select style="margin-left:0px; width: 88%;" v-model="id">
                    <option v-for="activity in activities" :value="activity.activity_id">@{{ activity.activity_name }}</option>
                </select>
            </div>
            <div class="range" v-if="!noActivity">
                <label>Range : </label>
                <img src="{{asset('resources/views/ICON/star.png')}}" @click="selected(1)" class="img" :class="{yellow:stars[0]}" width="25px" height="25px">
                <img src="{{asset('resources/views/ICON/star.png')}}" @click="selected(2)" class="img" :class="{yellow:stars[1]}" width="25px" height="25px">
                <img src="{{asset('resources/views/ICON/star.png')}}" @click="selected(3)" class="img" :class="{yellow:stars[2]}" width="25px" height="25px">
                <img src="{{asset('resources/views/ICON/star.png')}}" @click="selected(4)" class="img" :class="{yellow:stars[3]}" width="25px" height="25px">
                <img src="{{asset('resources/views/ICON/star.png')}}" @click="selected(5)" class="img" :class="{yellow:stars[4]}" width="25px" height="25px">
            </div>
            <div v-if="!noActivity">
                <label>Comment :</label>
                <textarea placeholder="give some comment" v-model="comment" style="resize: none;"></textarea>
            </div>
            <div v-if="!noActivity">
                <div @click="submit" class="myButton_small">Submit</div>
                <div @click="reset" class="myButton_small">Reset</div>
            </div>
            <div v-if="noActivity">No any activity</div>
        </div>
        <transition name="flash">
            <div class="submited" v-if="pass">Successful</div>
        </transition>
        <transition name="flash">
            <div class="submited" style="background-color: #f70000;" v-if="fail">Please Complete The Feedback Form</div>
        </transition>
    </div>
@endsection

@section('s-template')
<script>
    var ARF = new Vue({
        el:'#arf-container',
        data:{
            arf:false,
            activities:[],
            id:null,

            stars:[false,false,false,false,false],
            range:null,
            comment:'',

            pass:false,
            fail:false,

            noActivity:false
        },
        methods:{
            arf_show(){
                bus.$emit("arf",false);
                this.arf=!this.arf;
            },
            selected(n){
                for(let i in this.stars){
                    this.stars.splice(i,1,false);
                }
                this.range=n;
                for(let i=0;i<n;i++){
                    Vue.set(this.stars,i,true);
                }
            },
            show_off(){
                this.pass=false;
                this.fail=false;
            },
            submit(){
                let status = confirm('Only once chance to feedback this activity.\nAre you sure to submit?');
                if(status){
                    axios.post('{{url('/ctemplate-feedback-input')}}',{
                        id:this.id,
                        range:this.range,
                        comment:this.comment
                    })
                        .then(response=>{
                            console.log(response.data);
                            this.reset();
                            this.activities.splice(0);
                            for(let i in response.data){
                                Vue.set(this.activities,i,response.data[i]);
                            }
                            if(response.data.length===0){
                                this.noActivity = true;
                            }
                            this.pass = true;
                            setTimeout(this.show_off, 3000);
                        })
                        .catch(error=>{
                            this.fail = true;
                            setTimeout(this.show_off, 3000);
                        })
                }
            },
            reset(){
                this.id = null;
                for(let i in this.stars){
                    this.stars.splice(i,1,false);
                }
                this.range = 0;
                this.comment = '';
            }
        },
        mounted() {
            bus.$on("message",()=>{
                this.arf = false;
            })
            axios.post('{{url('/ctemplate-feedback')}}')
                .then(response=> {
                    console.log(response.data);
                    this.activities = response.data;
                    if(response.data.length===0){
                        this.noActivity = true;
                    }
                })
                .catch(error=>console.log(error.response));
        }
    });
    Vue.component('left-bar',{
        props:['hover','link','icon','title'],
        template:`<div class="panel" id="A1">
                    <a :href="link" class="panel-icon">
                        <img :src="icon" @mouseover="hover=!hover" @mouseleave="hover=!hover" width="30px" style="padding:15px; filter: invert(100%);">
                    </a>
                    <a v-if="hover" class="panel-title" >@{{title}}</a>
                  </div>`
    });
    var left = new Vue({
        el:'#left',
        data:{
            hover:[
                {
                    titles:'HOME',
                    status:false,
                    links:"{{url("/club")}}",
                    icons:"{{asset('resources/views/CTEMPLATE/ICON/home.png')}}"
                },
                {
                    titles:'PICTURE/ VIDEO',
                    status:false,
                    links:"{{url("/club/media")}}",
                    icons:"{{asset('resources/views/CTEMPLATE/ICON/Media.png')}}"
                },
                {
                    titles:'CLUB ACTIVITY',
                    status:false,
                    links:"{{url("/club/activity")}}",
                    icons:"{{asset('resources/views/CTEMPLATE/ICON/Activity.png')}}"
                },

                {
                    titles:'CLUB HISTORY',
                    status:false,
                    links:"{{url("/club/history")}}",
                    icons:"{{asset('resources/views/CTEMPLATE/ICON/History.png')}}"
                },
                {
                    titles:'ABOUT CLUB',
                    status:false,
                    links:"{{url("/club/about")}}",
                    icons:"{{asset('resources/views/CTEMPLATE/ICON/Info.png')}}"
                },
                {
                    titles:'COOPERATE SYSTEM',
                    status:false,
                    links:"{{url("/club/cSystem")}}",
                    icons:"{{asset('resources/views/CTEMPLATE/ICON/cooperate.png')}}"
                },
                {
                    titles:'CLUB MANAGEMENT',
                    status:false,
                    links:"{{url("/club/cms")}}",
                    icons:"{{asset('resources/views/CTEMPLATE/ICON/cms.png')}}"
                },
            ],
        },
        methods:{
            scrollTrigger(){
                var observer = new IntersectionObserver(changes =>{
                    var top = changes[0].boundingClientRect.top;
                    var positionChild = this.$refs.el.children[0].style.position;
                    if(top < 0){
                        positionChild = "fixed";
                    }
                    else{
                        positionChild = "sticky";
                    }
                    this.$refs.el.children[0].style.position = positionChild;
                },{rootMargin:"0px 0px -99% 0px"});

                observer.observe(this.$refs.el);
            }
        },
        mounted(){
            this.scrollTrigger();
        }
    });
    Vue.component('mediabox',{
        props:['mediaview','videoshow'],
        template:`<video class="preview-media" height="auto" width="100%" controls v-if="videoshow"><source :src="mediaview" type="video/mp4" /></video>
                      <img class="preview-media" :src="mediaview" height="100%" v-else/>
                      `,
    });
</script>
@yield('s-ctemplate')
@endsection
