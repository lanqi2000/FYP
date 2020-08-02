@extends('CTEMPLATE.CTEMPLATE')
@section('h-ctemplate')
    <link rel="stylesheet" href="{{asset('public/css/CLUB/COOPERATE_SYSTEM/COOPERATE_SYSTEM.css')}}">
@endsection
@section('b-ctemplate')
    <div id="a-container" style="width: 100%; height: 100%">
        <div class="activity">
                <div>
                    <div id="rnr">
                        <h2>Request</h2>
                        <div id="request">
                            <table>
                                <tr>
                                    <td>
                                        <ul>
                                            <li>request 1</li>
                                        </ul>
                                    </td>
                                    <td>10/7/20</td>
                                </tr>
                            </table>
                        </div>
                        <h2>Recieve</h2>
                        <div id="receive">
                            <table>
                                <tr>
                                    <td>
                                        <ul>
                                            <li>request 1</li>
                                        </ul>
                                    </td>
                                    <td>10/7/20</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div id="cod" style="border-left: 1px black dotted">
                        <h2>Center of Documents</h2>
                        <table>
                            <thead>
                                <th>Title</th>
                                <th>Date</th>
                                <th>Type</th>
                            </thead>
                            <tbody>
                                <td>lalala</td>
                                <td>lalala</td>
                                <td>lalala</td>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="timeline">
                    <table>
                        <thead>
                            <th>Time</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>P-I-C</th>
                            <th>Remarks</th>
                        </thead>
                        <tbody>
                            <td>12123</td>
                            <td>blablab</td>
                            <td>blabl</td>
                            <td>mr teeth</td>
                            <td>-</td>
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
@endsection
@section('s-ctemplate')
    <script>
        var head = new Vue({
            el:'#head',
            data:{
                title:'TEETH CLUB'
            },
        });
    </script>
@endsection
