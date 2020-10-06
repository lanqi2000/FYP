@extends('CTEMPLATE.CTEMPLATE')
@section('h-ctemplate')

    <link rel="stylesheet" href="{{asset('public/css/CLUB/ABOUT_CLUB.css')}}">

@endsection
@section('b-ctemplate')

    <div id="main" style="width: 100%; height: 100%">
        <div class="i-container">
            <div class="selection">
                <div @click="change(1)">ABOUT US</div>
                <div @click="change(2)">VISION</div>
                <div @click="change(3)">LOGO</div>
                <div @click="change(4)">ORGANIZATION STRUCTURE</div>
                <div @click="change(5)">MEMBER BENIFITS</div>
            </div>
            <div class="content">
                <div v-if="show1">
                    <div class="myContent">
                        <h2>About Us</h2>
                        <pre>Name  :    @{{club}}</pre>
                        <pre>Email :    @{{email}}</pre>
                        <pre>Other :    blablabla</pre>
                    </div>
                </div>
                <div v-if="show2">
                    <div class="myContent">
                        <h2>Vision</h2>
                        <pre>BLABLALBA</pre>
                        <h2>Vision</h2>
                        <pre>blablabla</pre>
                    </div>
                </div>
                <diV v-if="show3">
                    <div style="display: flex; flex-direction: column;" class="myContent">
                        <h2>Logo</h2>
                        <img style="height: 200px; width: 160px;" src="{{asset('resources/views/IMAGE/POSTER.jpg')}}">
                        <caption>caption</caption>
                    </div>
                </div>
                <div v-if="show4" style="flex-direction: column;">
                    <div class="myContent">
                        <h2>ID Project</h2>
                        <pre><h4>The Alley Melaka 鹿角巷</h4>
    Address: No 55 Jalan KLJ 10, Taman Kota Laksamana Jaya Melaka 75200
    Business Hour: 11:00 AM – 1:00 AM
    Discount: 10% for each student with MMU student ID</pre>
                    </div>
                </div>
                <div v-if="show5" style="flex-direction: column;">
                    <div class="myContent">
                        <h2>Organization Structure</h2>
                        <div style="display:flex; flex-direction: column;">
                            <h4>President</h4>
                            <p>Mr teeth</p>
                            <h4>Vice President</h4>
                            <p>Mr teeth</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
@section('s-ctemplate')

    <script>
        var head = new Vue({
            el:'#head',
            data:{
                title:'TEETH CLUB - INFO'
            },
        });
        new Vue({
            el:'#main',
            data:{
                club:'TEETH CLUB',
                email:'blablabla.com',

                temp:1,
                show1:true,
                show2:false,
                show3:false,
                show4:false,
                show5:false,
            },
            methods:{
                change(select){
                    switch (this.temp){
                        case 1: this.show1=false;
                                break;
                        case 2: this.show2=false;
                                break;
                        case 3: this.show3=false;
                                break;
                        case 4: this.show4=false;
                                break;
                        case 5: this.show5=false;
                                break;
                        default: break;
                    }
                    switch (select){
                        case 1: this.show1=true;
                                this.temp = select;
                                break;
                        case 2: this.show2=true;
                                this.temp = select;
                                break;
                        case 3: this.show3=true;
                                this.temp = select;
                                break;
                        case 4: this.show4=true;
                                this.temp = select;
                                break;
                        case 5: this.show5=true;
                                this.temp = select;
                                break;
                    }
                }
            }
        });
    </script>

@endsection
