<!DOCTYPE html>
<html>
    <head id="head">
        <meta charset="utf-8">
        <script src="https://unpkg.com/vue/dist/vue.js"></script>
        <link rel="stylesheet" href="{{asset('resources/views/SOURCE_CODE/TEMPLATE/TEMPLATE.css')}}">
        <!--google font-->
        <link href="https://fonts.googleapis.com/css2?family=Monoton&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
        <title>@{{title}}</title>
        @yield('h-template')
    </head>
    <body>
        <header>
            <div class="login">
                <a href="#">login</a>
                <a href="#">register</a>
            </div>
            <div class="loggedin"></div>
            <div class="hd">
                C<spam>lub</spam> I<spam>nteraction</spam> P<spam>latform</spam>
            </div>
            <br/>
        </header>
        {{--<section>
            <link rel="stylesheet" href="{{asset('resources/views/SOURCE_CODE/CTEMPLATE/CTEMPLATE.css')}}">
            <div id="container">
                <div id="left">
                    <left-bar v-for="h in hover" :hover="h.status" :link="h.links" :icon="h.icons" :title="h.titles"></left-bar>
                </div>
                <link rel="stylesheet" href="{{asset('resources/views/SOURCE_CODE/CSS/CLUB/CLUB.css')}}">

                <div id="right">
                    <div id="logo">
                        <div id="l-img">
                            <img src="{{asset('resources/views/SOURCE_CODE/IMAGE/LOGO.png')}}" width="100%" height="100%">
                        </div>
                    </div>
                    <br/>
                    <div id="banner">
                        <div id="b-img">
                            <img src="{{asset('resources/views/SOURCE_CODE/IMAGE/BANNER.jpg')}}" width="100%" height="100%">
                        </div>
                    </div>
                    <div id="p-container" style="width: 100%; height: 100%;">
                        <div class="poster">
                            <div class="p-title"></div>
                            <div class="p-media">
                                <img alt="poster" src="{{asset('resources/views/SOURCE_CODE/IMAGE/POSTER.jpg')}}" height="100%">
                            </div>
                            <div class="p-caption">
                                <caption>lalalalaalalla</caption>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div id="arf-container">
            <div id="ARF" title="ANONYMOUS RATING & FEEDBACK" @click="arf=!arf">
                <img src="{{asset('resources/views/SOURCE_CODE/CTEMPLATE/ICON/customer-review.png')}}" width="30px" style="filter: invert(100%)">
            </div>
            <div class="arf" v-if="arf">* * * * *</div>
        </div>--}}
        @yield('b-template')
        <!--message-->
        <div id="c-container">
            <div id="message" @click="chat=!chat">
                <img src="{{asset('resources/views/SOURCE_CODE/TEMPLATE/chat.png')}}" width="30px" style="filter: invert(100%)">
            </div>
            <div class="chat" v-if="chat">New message</div>
        </div>
    </body>
    <script>
        var message = new Vue({
            el:'#c-container',
            data:{
                chat:false
            }
        });
        /*var head = new Vue({
            el:'#head',
            data:{
                title:'TEETH CLUB'
            },
        });
        var ARF = new Vue({
            el:'#arf-container',
            data:{
                arf:false
            }
        });
        Vue.component('left-bar',{
            props:['hover','link','icon','title'],
            template:'<div class="panel" id="A1"><a :href="link" class="panel-icon"><img :src="icon" @mouseover="hover=!hover" @mouseleave="hover=!hover" width="30px" style="padding:15px; filter: invert(100%);"></a><a v-if="hover" class="panel-title" >@{{title}}</a></div>'
        });
        var left = new Vue({
            el:'#left',
            data:{
                hover:[
                    {
                        titles:'PICTURE/ VIDEO',
                        status:false,
                        links:"/SOURCE_CODE/HTML/CLUB/MEDIA.blade.php",
                        icons:"{{asset('resources/views/SOURCE_CODE/CTEMPLATE/ICON/pv.png')}}"
                    },
                    {
                        titles:'CLUB ACTIVITY',
                        status:false,
                        links:"/SOURCE_CODE/HTML/CLUB/ACTIVITY/ACTIVITY.blade.php",
                        icons:"{{asset('resources/views/SOURCE_CODE/CTEMPLATE/ICON/activity.png')}}"
                    },
                    {
                        titles:'COOPERATE SYSTEM',
                        status:false,
                        links:"/SOURCE_CODE/HTML/CLUB/COOPERATE_SYSTEM/COOPERATE_SYSTEM.blade.php",
                        icons:"{{asset('resources/views/SOURCE_CODE/CTEMPLATE/ICON/cooperate.png')}}"
                    },
                    {
                        titles:'CLUB HISTORY',
                        status:false,
                        links:"/SOURCE_CODE/HTML/CLUB/CLUB_HISTORY.blade.php",
                        icons:"{{asset('resources/views/SOURCE_CODE/CTEMPLATE/ICON/history.png')}}"
                    },
                    {
                        titles:'ABOUT CLUB',
                        status:false,
                        links:"/SOURCE_CODE/HTML/CLUB/ABOUT_CLUB.blade.php",
                        icons:"{{asset('resources/views/SOURCE_CODE/CTEMPLATE/ICON/about.png')}}"
                    },
                ]
            },
        });*/
    </script>
</html>
