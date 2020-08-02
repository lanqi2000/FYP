<!DOCTYPE html>
<html>
    <head id="head">
        <meta charset="utf-8">
        <script src="https://unpkg.com/vue/dist/vue.js"></script>
        <link rel="stylesheet" href="{{asset('public/css/TEMPLATE.css')}}">
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
        <section>
            <div id="container">
                @yield('b-template')
            </div>
        </section>
        <!--message-->
        <div id="c-container">
            <div id="message" @click="chat=!chat">
                <img src="{{asset('resources/views/TEMPLATE/ICON/chat.png')}}" width="30px" style="filter: invert(100%)">
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

    </script>
    @yield('s-template')
</html>
