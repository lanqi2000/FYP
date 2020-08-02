@extends('TEMPLATE.TEMPLATE')
@section('h-template')
    <link rel="stylesheet" href="{{asset('public/css/CTEMPLATE.css')}}">
    @yield('h-ctemplate')
@endsection
@section('b-template')
        <div id="left">
            <left-bar v-for="h in hover" :hover="h.status" :link="h.links" :icon="h.icons" :title="h.titles"></left-bar>
        </div>
        <div id="right">
            @yield('b-ctemplate')
        </div>


    <div id="arf-container">
        <div id="ARF" title="ANONYMOUS RATING & FEEDBACK" @click="arf=!arf">
            <img src="{{asset('resources/views/CTEMPLATE/ICON/customer-review.png')}}" width="30px" style="filter: invert(100%)">
        </div>
        <div class="arf" v-if="arf">* * * * *</div>
    </div>
@endsection
@section('s-template')
<script>
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
                    icons:"{{asset('resources/views/CTEMPLATE/ICON/pv.png')}}"
                },
                {
                    titles:'CLUB ACTIVITY',
                    status:false,
                    links:"/SOURCE_CODE/HTML/CLUB/ACTIVITY/ACTIVITY.blade.php",
                    icons:"{{asset('resources/views/CTEMPLATE/ICON/activity.png')}}"
                },
                {
                    titles:'COOPERATE SYSTEM',
                    status:false,
                    links:"/SOURCE_CODE/HTML/CLUB/COOPERATE_SYSTEM/COOPERATE_SYSTEM.blade.php",
                    icons:"{{asset('resources/views/CTEMPLATE/ICON/cooperate.png')}}"
                },
                {
                    titles:'CLUB HISTORY',
                    status:false,
                    links:"/SOURCE_CODE/HTML/CLUB/CLUB_HISTORY.blade.php",
                    icons:"{{asset('resources/views/CTEMPLATE/ICON/history.png')}}"
                },
                {
                    titles:'ABOUT CLUB',
                    status:false,
                    links:"/SOURCE_CODE/HTML/CLUB/ABOUT_CLUB.blade.php",
                    icons:"{{asset('resources/views/CTEMPLATE/ICON/about.png')}}"
                },
            ]
        },
    });
</script>
@yield('s-ctemplate')
@endsection
