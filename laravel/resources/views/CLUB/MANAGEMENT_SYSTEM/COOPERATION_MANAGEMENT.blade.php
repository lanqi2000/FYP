@extends('CTEMPLATE.CTEMPLATE')
@section('h-ctemplate')
    <link rel="stylesheet" href="{{asset('public/css/CLUB/MANAGEMENT_SYSTEM/CLUB_MANAGEMENT_SYSTEM.css')}}">
@endsection
@section('b-ctemplate')
    <div id="cms-container">
        <div class="cms-nav">
            <a class="navigation" :href="navLink" @mouseover="navNameShow=!navNameShow" @mouseleave="navNameShow=!navNameShow">
                <img :src="navIcon">
            </a>
            <transition name="rotate-to-right">
                <div class="navigation-name" v-if="navNameShow">@{{ navName }}</div>
            </transition>

        </div>
    </div>
@endsection
@section('s-ctemplate')
    <script>
        Vue.component('right-nav',{
            template:``
        });
        var CMS = new Vue({
            el:'#cms-container',
            data:{
                navNameShow:false,
                navData:[
                    [
                        {
                            navName:'Post Management',
                            navIcon:'{{asset('resources/views/CLUB/MANAGEMENT_SYSTEM/ICON/Post.png')}}',
                            navLink:,
                            navStats:false
                        },
                        {
                            navName:'Advertisement Management',
                            navIcon:'{{asset('resources/views/CLUB/MANAGEMENT_SYSTEM/ICON/Advertisement.png')}}',
                            navLink:,
                            navStats:false
                        }],
                    [
                        {
                            navName:'Activity Management',
                            navIcon:'{{asset('resources/views/CTEMPLATE/ICON/Activity.png')}}',
                            navLink:,
                            navStats:false
                        },
                        {
                            navName:'Media Management',
                            navIcon:'{{asset('resources/views/CTEMPLATE/ICON/Media.png')}}',
                            navLink:,
                            navStats:false
                        }],
                    [
                        {
                            navName:'Cooparation Management',
                            navIcon:'{{asset('resources/views/CTEMPLATE/ICON/Cooparation.png')}}',
                            navLink:,
                            navStats:false
                        },
                        {
                            navName:'Member Management',
                            navIcon:'{{asset('resources/views/CLUB/MANAGEMENT_SYSTEM/ICON/Member.png')}}',
                            navLink:,
                            navStats:false
                        }],
                    [
                        {
                            navName:'History Management',
                            navIcon:'{{asset('resources/views/CTEMPLATE/ICON/Media.png')}}',
                            navLink:,
                            navStats:false
                        },
                        {
                            navName:'Info Management',
                            navIcon:'{{asset('resources/views/CTEMPLATE/ICON/Info.png')}}',
                            navLink:,
                            navStats:false
                        }],
                ]
            },
        });
    </script>
@endsection
