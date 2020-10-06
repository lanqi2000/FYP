@extends('CTEMPLATE.CTEMPLATE')
@section('h-ctemplate')
    <link rel="stylesheet" href="{{asset('public/css/CLUB/COOPERATE_SYSTEM/COOPERATE_SYSTEM.css')}}">
@endsection
@section('b-ctemplate')
    <div id="a-container" style="width: 100%; height: 100%">
        <div class="activity">
                <div>
                    <h1 class="header" style="width: 400px">COOPERATION CENTER</h1>
                    <div class="rnr">
                        <h2>Request</h2>
                        <div class="request" id="request">
                            <table>
                                <request></request>
                                <request></request>
                                <request></request>
                                <request></request>
                                <request></request>
                                <request></request>
                                <request></request>
                            </table>
                        </div>
                        <h2>Recieve</h2>
                        <div class="receive" id="recieve">
                            <table>
                                <request></request>
                                <request></request>
                                <request></request>
                                <request></request>
                                <request></request>
                                <request></request>
                                <request></request>
                            </table>
                        </div>
                    </div>
                    <div class="cod" id="cod" style="border-left: 1px black dotted">
                        <h2>Center of Documents</h2>
                        <div class="document-list">
                            <document></document>
                            <document></document>
                            <document></document>
                            <document></document>
                            <document></document>
                            <document></document>
                            <document></document>
                            <document></document>
                            <document></document>
                            <document></document>
                            <document></document>
                            <document></document>
                            <document></document>
                        </div>
                    </div>
                </div>
                <h2 style="margin-left: 30px;">Timeline</h2>
                <div class="timeline" id="timeline">
                    <table>
                        <tr>
                            <td>
                                <div style="width:890px;">
                                    <table class="table-head">
                                        <tr>
                                            <th>Time</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>P-I-C</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </table>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div style="width:905px; max-height:500px; overflow-y:scroll;">
                                    <table>
                                        <timeline></timeline>
                                        <timeline></timeline>
                                        <timeline></timeline>
                                        <timeline></timeline>
                                        <timeline></timeline>
                                        <timeline></timeline>
                                        <timeline></timeline>
                                        <timeline></timeline>
                                        <timeline></timeline>
                                        <timeline></timeline>
                                        <timeline></timeline>
                                        <timeline></timeline>
                                        <timeline></timeline>
                                        <timeline></timeline>
                                        <timeline></timeline>
                                        <timeline></timeline>
                                        <timeline></timeline>
                                        <timeline></timeline>
                                        <timeline></timeline>
                                        <timeline></timeline>
                                        <timeline></timeline>
                                        <timeline></timeline>
                                        <timeline></timeline>
                                        <timeline></timeline>
                                        <timeline></timeline>
                                        <timeline></timeline>
                                        <timeline></timeline>
                                        <timeline></timeline>
                                        <timeline></timeline>
                                        <timeline></timeline>
                                        <timeline></timeline>
                                        <timeline></timeline>
                                        <timeline></timeline>
                                        <timeline></timeline>
                                        <timeline></timeline>
                                        <timeline></timeline>
                                        <timeline></timeline>
                                        <timeline></timeline>
                                        <timeline></timeline>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
        </div>
    </div>
@endsection
@section('s-ctemplate')
    <script>
        Vue.component('request',{
            template:
                `<tr>
                    <td>
                        <ul>
                            <li>Request</li>
                        </ul>
                    </td>
                    <td>xx/xx/xxxx</td>
                </tr>`
        });
        Vue.component('document',{
            template:
                `<div class="document">
                    <div class="document-icon">I</div>
                    <div class="document-title">Document</div>
                    <div class="document-icon">D</div>
                </div>`
        });
        Vue.component('timeline',{
            template:
                `<tr class="table-body">
                    <td>xx:xx am</td>
                    <td>@{{ title }}</td>
                    <td>@{{ description }}</td>
                    <td>LIM JUN XIANG</td>
                    <td>-</td>
                </tr>`
        });
        new Vue({
            el:'#cod'
        });
        new Vue({
            el:'#request'
        });
        new Vue({
            el:'#recieve'
        });
        new Vue({
            el:'#timeline'
        });
        var head = new Vue({
            el:'#head',
            data:{
                title:'TEETH CLUB'
            },
        });
    </script>
@endsection
