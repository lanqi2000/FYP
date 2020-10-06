@extends('CTEMPLATE.CTEMPLATE')
@section('h-ctemplate')
    <link rel="stylesheet" href="{{asset('public/css/CLUB/MANAGEMENT_SYSTEM/ADVERTISEMENT_MANAGEMENT.css')}}">
@endsection
@section('b-ctemplate')
    <h1 class="header" style="width: 400px">ADVERTISEMENT MANAGEMENT</h1>
    <div id="ads-management">
        <div class="ads-preview">
            <div class="ads-image">
                <img src="{{asset('resources/views/IMAGE/BANNER.jpg')}}" width="900px" height="300px">
{{--                <div class="arrow" v-if="arrowShow" style="left: 20px" @click="changeLeftMedia"><</div>--}}
{{--                <div class="arrow" v-if="arrowShow" style="right: 20px" @click="changeRightMedia">></div>--}}
                <div class="arrow" v-if="arrowShow" style="left: 5px"><</div>
                <div class="arrow" v-if="arrowShow" style="right: 5px">></div>
                <div></div>
            </div>
        </div>
        <div class="upload-picture"></div>
        <div class="save"></div>
    </div>
@endsection
@section('s-ctemplate')
    <script>
        var ads = new Vue({
            el:'#ads-management',
            data:{
                arrowShow:true,
            },
            methods:{
                {{--changeLeftMedia(){--}}
                {{--    if (this.mediaKey > 0){--}}
                {{--        this.mediaKey--;--}}
                {{--    }--}}
                {{--    this.mediaView = this.media[this.mediaKey];--}}
                {{--    if(this.media[this.mediaKey].substr(0,4)=='post'){--}}
                {{--        console.log(this.media[this.mediaKey].substr(0,4));--}}
                {{--        let prefix = '{{asset('public/storage/')}}';--}}
                {{--        this.mediaView = prefix + '/' + this.media[this.mediaKey];--}}
                {{--        this.mediaType = this.media[this.mediaKey].split(".").pop();--}}
                {{--        if(this.mediaType==='mp4'){--}}
                {{--            this.videoShow = true;--}}
                {{--        }--}}
                {{--        else{--}}
                {{--            this.videoShow = false;--}}
                {{--        }--}}
                {{--    }else{--}}
                {{--        this.mediaType = this.media[this.mediaKey].substr(5,5);--}}
                {{--        if(this.mediaType==='video'){--}}
                {{--            this.videoShow = true;--}}
                {{--        }--}}
                {{--        else{--}}
                {{--            this.videoShow = false;--}}
                {{--        }--}}
                {{--    }--}}
                {{--},--}}
                {{--changeRightMedia(){--}}
                {{--    if (this.mediaKey < this.media.length-1){--}}
                {{--        this.mediaKey++;--}}
                {{--    }--}}
                {{--    if(this.media[this.mediaKey].substr(0,4)=='post'){--}}
                {{--        console.log(this.media[this.mediaKey].substr(0,4));--}}
                {{--        let prefix = '{{asset('public/storage/')}}';--}}
                {{--        this.mediaView = prefix + '/' + this.media[this.mediaKey];--}}
                {{--        this.mediaType = this.media[this.mediaKey].split(".").pop();--}}
                {{--        if(this.mediaType==='mp4'){--}}
                {{--            this.videoShow = true;--}}
                {{--        }--}}
                {{--        else{--}}
                {{--            this.videoShow = false;--}}
                {{--        }--}}
                {{--    }else{--}}
                {{--        this.mediaView = this.media[this.mediaKey];--}}
                {{--        this.mediaType = this.media[this.mediaKey].substr(5,5);--}}
                {{--        if(this.mediaType==='video'){--}}
                {{--            this.videoShow = true;--}}
                {{--        }--}}
                {{--        else{--}}
                {{--            this.videoShow = false;--}}
                {{--        }--}}
                {{--    }--}}
                {{--},--}}
            }
        });
    </script>
@endsection
