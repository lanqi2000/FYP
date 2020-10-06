<!DOCTYPE html>
<html>
    <head id="head">
        <meta charset="utf-8">
        <script src="https://unpkg.com/vue/dist/vue.js"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <link rel="stylesheet" href="{{asset('public/css/TEMPLATE.css')}}">
        <!--google font-->
        <link href="https://fonts.googleapis.com/css2?family=Monoton&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
        <title>@{{title}}</title>

        @yield('h-template')

    </head>
    <body>
        <style>
            .loading{
                height: 100vh;
                width: 100vw;
                position: fixed;
                left: 0;
                top: 0;
                background-color: #090d31;
                z-index: 1000000000;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .loading>div{
                background: linear-gradient(130deg,#74b9ff,white);
                height: 70px;
                width: 70px;
                border-radius: 50px;
                background-size: 200% 200%;
                animation: animation-gradient 2s linear infinite;
                position: relative;
                display: flex;
                justify-content: center;
            }
            .loading>div>div{
                position: absolute;
                top:130%;
                color: white;
                font-family: Arial;
            }
            @keyframes animation-gradient {
                25%{
                    background-position: left bottom;
                }
                50%{
                    background-position: right bottom;
                }
                75%{
                    background-position: right top;
                }
                100%{
                    background-position: left top;
                }
            }
            .load-leave-to{
                opacity: 0;
            }
            .load-leave-active{
                transition: opacity 500ms;
            }
        </style>
        <div id="loading">
            <transition name="load">
                <div class="loading" v-if="load">
                    <div>
                        <div>loading...</div>
                    </div>
                </div>
            </transition>
        </div>


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
        <section>
            <div id="container">
                @yield('b-template')
            </div>
        </section>
        <!--message-->
        <div id="c-container">
            <div id="message" @click="message_show">
                <img src="{{asset('resources/views/TEMPLATE/ICON/chat.png')}}" width="30px" style="filter: invert(100%)">
            </div>
            <div class="chat" v-if="chat">New message</div>
        </div>
    </body>
    <script>
        var bus = new Vue();
        var load = new Vue({
           el:'#loading',
            data:{
                load:true
            },
            methods:{
                loading(){
                    this.load=false;
                }
            },
            mounted() {
                setTimeout(this.loading,500);
            }
        });
        var message = new Vue({
            el:'#c-container',
            data:{
                chat:false,
            },
            methods:{
                message_show(){
                    bus.$emit("message",false);
                    this.chat=!this.chat;
                }
            },
            mounted() {
                bus.$on("arf",()=>{
                    this.chat = false;
                })
            }
        });
    </script>
    @yield('s-template')
</html>
