@extends('CTEMPLATE.CTEMPLATE')
@section('h-ctemplate')
    <link rel="stylesheet" href="{{asset('public/css/CLUB/CLUB_HISTORY.css')}}">
@endsection
@section('b-ctemplate')
    <div id="a-container" style="width: 100%; height: 100%">
        <div class="activity">
            <div class="ACT">
                <svg style="width:1000%; height: 40px;">
                    <line x1="0" y1="30px" x2="100%" y2="30px" style="stroke:black; stroke-width:2"/>
                </svg>
                <div class="year" style="left: 0;">
                    <div>
                        <div>2020</div>
                        <div>
                            <ul>
                                <li>activity 1</li>
                                <li>activity 2</li>
                                <li>activity 3</li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <div>2020</div>
                        <div>
                            <ul>
                                <li>activity 1</li>
                                <li>activity 2</li>
                                <li>activity 3</li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <div>2020</div>
                        <div>
                            <ul>
                                <li>activity 1</li>
                                <li>activity 2</li>
                                <li>activity 3</li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <div>2020</div>
                        <div>
                            <ul>
                                <li>activity 1</li>
                                <li>activity 2</li>
                                <li>activity 3</li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <div>2020</div>
                        <div>
                            <ul>
                                <li>activity 1</li>
                                <li>activity 2</li>
                                <li>activity 3</li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <div>2020</div>
                        <div>
                            <ul>
                                <li>activity 1</li>
                                <li>activity 2</li>
                                <li>activity 3</li>
                            </ul>
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
                title:'TEETH CLUB'
            },
        });
    </script>
@endsection
