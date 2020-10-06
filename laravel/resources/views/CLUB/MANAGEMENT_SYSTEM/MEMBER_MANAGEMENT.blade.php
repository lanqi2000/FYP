@extends('CTEMPLATE.CTEMPLATE')
@section('h-ctemplate')
    <link rel="stylesheet" href="{{asset('public/css/CLUB/MANAGEMENT_SYSTEM/MEMBER_MANAGEMENT.css')}}">
@endsection
@section('b-ctemplate')
    <h1 class="header" style="width: 360px">MEMBER MANAGEMENT</h1>
    <div id="member-management">
        <div class="mm-container">
            <div style="display: flex; flex-direction: row;">
                <div class="pm-option" @click="changeShow(1)" :class="{selected:createShow}">MEMBER LIST</div>
                <div class="pm-option" @click="changeShow(2)" :class="{selected:editShow}">MEMBER APPLICATION</div>
            </div>
            <table class="list">
                <tr style="background-color: #3c4161">
                    <td>
                        <table>
                            <tr class="list-header">
                                <th class="list-element" style="width: 30px;">No</th>
                                <th class="list-element" style="width: 400px;">MEMBER ID</th>
                                <th class="list-element" style="width: 200px;">STUDENT ID</th>
                                <th class="list-element" style="width: 80px;">REMOVE</th>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td >
                        <div class="post-list-body">
                            <table>
                                <check-list v-for="(checklist,key) in showchecklist" :listkey="key" :postid="checklist.postId" :posttitle="checklist.title" :createdtime="checklist.time" @postdata="setPost"></check-list>
                            </table>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection
@section('s-ctemplate')
    <script>
        var CMS = new Vue({
            el:'#cms-container',
            data:{

            },
            methods:{
                changeShow(s){
                    if(s===1){
                        if(this.editShow){
                            this.postEditUI= true;
                            this.createShow= true;
                            this.editShow=false;
                            this.reset();
                        }
                    }else{
                        if(this.createShow){
                            this.postEditUI= false;
                            this.createShow= false;
                            this.editShow=true;
                            this.reset();
                        }
                    }
                },
            }
        });
    </script>
@endsection
