@extends('CTEMPLATE.CTEMPLATE')
@section('h-ctemplate')
    <link rel="stylesheet" href="{{asset('public/css/CLUB/MANAGEMENT_SYSTEM/CLUB_MANAGEMENT_SYSTEM.css')}}">
@endsection
@section('b-ctemplate')
    <h1 class="header" style="width: 360px">Club Management System</h1>
    <div id="cms-container">
        <right-nav v-for="nav in navData1" :navlink="nav.navlink" :navicon="nav.navicon" :navnameshow="nav.navStatus" :navname="nav.navname"></right-nav>
        <left-nav v-for="nav in navData2" :navlink="nav.navlink" :navicon="nav.navicon" :navnameshow="nav.navStatus" :navname="nav.navname"></left-nav>
        <right-nav v-for="nav in navData3" :navlink="nav.navlink" :navicon="nav.navicon" :navnameshow="nav.navStatus" :navname="nav.navname"></right-nav>
        <left-nav v-for="nav in navData4" :navlink="nav.navlink" :navicon="nav.navicon" :navnameshow="nav.navStatus" :navname="nav.navname"></left-nav>
    </div>
@endsection
@section('s-ctemplate')
    <script>
        Vue.component('right-nav',{
            props:['navlink','navicon','navnameshow','navname'],
            template:`
                    <div class="cms-nav">
                        <a class="navigation" :href="navlink" @mouseover="navnameshow=!navnameshow" @mouseleave="navnameshow=!navnameshow">
                            <img class="navigation-logo" :src="navicon"/>
                        </a>
                        <transition name="rotate-to-right">
                            <div class="navigation-name" v-if="navnameshow">@{{ navname }}</div>
                        </transition>
                    </div>`
        });
        Vue.component('left-nav',{
            props:['navlink','navicon','navnameshow','navname'],
            template:`
                    <div class="cms-nav">
                        <div class="nav-name-box">
                            <transition name="rotate-to-left">
                                <div class="navigation-name" v-if="navnameshow">@{{ navname }}</div>
                            </transition>
                        </div>
                        <a class="navigation" :href="navlink" @mouseover="navnameshow=!navnameshow" @mouseleave="navnameshow=!navnameshow">
                            <img class="navigation-logo" :src="navicon"/>
                        </a>
                    </div>`
        });
        var CMS = new Vue({
            el:'#cms-container',
            data:{
                navnameshow:false,
                navData1:[
                        {
                            navname:'Post Management',
                            navicon:'{{asset('resources/views/CLUB/MANAGEMENT_SYSTEM/ICON/Post.png')}}',
                            navlink:'{{url("/club/cmsPost")}}',
                            navStatus:false
                        },
                        {
                            navname:'Advertisement Management',
                            navicon:'{{asset('resources/views/CLUB/MANAGEMENT_SYSTEM/ICON/Advertisement.png')}}',
                            navlink:'{{url("/club/cmsAdvertisement")}}',
                            navStatus:false
                        }],
                navData2:[
                        {
                            navname:'Activity Management',
                            navicon:'{{asset('resources/views/CTEMPLATE/ICON/Activity.png')}}',
                            navlink:'{{url("/club/cmsActivity")}}',
                            navStatus:false
                        },
                        {
                            navname:'Media Management',
                            navicon:'{{asset('resources/views/CTEMPLATE/ICON/Media.png')}}',
                            navlink:'{{url("/club/cmsMedia")}}',
                            navStatus:false
                        }],
                navData3:[
                        {
                            navname:'Cooperation Management',
                            navicon:'{{asset('resources/views/CTEMPLATE/ICON/cooperate.png')}}',
                            navlink:'{{url("/club/cmsCooperation")}}',
                            navStatus:false
                        },
                        {
                            navname:'Member Management',
                            navicon:'{{asset('resources/views/CLUB/MANAGEMENT_SYSTEM/ICON/Member.png')}}',
                            navlink:'{{url("/club/cmsMember")}}',
                            navStatus:false
                        }],
                navData4:[
                        {
                            navname:'History Management',
                            navicon:'{{asset('resources/views/CTEMPLATE/ICON/History.png')}}',
                            navlink:'{{url("/club/cmsHistory")}}',
                            navStatus:false
                        },
                        {
                            navname:'Info Management',
                            navicon:'{{asset('resources/views/CTEMPLATE/ICON/Info.png')}}',
                            navlink:'{{url("/club/cmsInfo")}}',
                            navStatus:false
                        }],
            },
        });
    </script>
@endsection
