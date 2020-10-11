<!DOCTYPE html>
<html>
    <head id="head">
        <meta charset="utf-8">
{{--        <meta name="viewport" content="width=device-width,initial-scale=1.0">--}}
{{--        <meta http-equiv="X-UA-Compatible" content="ie=edge">--}}
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
        <header id="header">
            <div class="login">
                <a href="{{url('/login')}}">Login</a>
                <a href="{{url('/pProfile')}}">Profile</a>
            </div>
            <div class="loggedin"></div>
            <a class="hd" href="{{asset('/')}}" style="text-decoration: none; color: black">
                C<spam>lub</spam> I<spam>nteraction</spam> P<spam>latform</spam>
            </a>
            <br/>
        </header>
        <section>
            <div id="container">
                @yield('b-template')
            </div>
        </section>
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
        var head = new Vue({
            el:'#header',
            data:{

            },
            mounted() {
                {{--console.log('{{session('user')['user_id']}}');--}}
            }
        });
    </script>
    @yield('s-template')
</html>
