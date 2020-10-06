@extends('CTEMPLATE.CTEMPLATE')
@section('h-ctemplate')
        <link rel="stylesheet" href="{{asset('public/css/CLUB/ACTIVITY/RECENT_ACTIVITY.css')}}">
@endsection
@section('b-ctemplate')
    <div id="a-container" style="width: 100%; height: 100%">
        <div class="activity-preview">
            <div class="activity-title">
                @{{name}}
            </div>
            <div class="activity-image">
                <img :src="image" height="100%">
            </div>
            <div class="activity-description">
                <div class="caption">
                    <div class="preview" ref="caption" style="overflow-wrap: break-word; width: 580px; white-space: pre;">@{{caption}}</div>
                </div>
            </div>
            <div class="activity-detail">
                <div class="activity-detail-row">
                    <div class="activity-detail-col">Application open at :</div>
                    <div class="activity-detail-col value">@{{ openTime }}</div>
                    <div class="activity-detail-col">Application close at :</div>
                    <div class="activity-detail-col value">@{{ closeTime }}</div>
                </div>
                <div class="activity-detail-row">
                    <div class="activity-detail-col">Target :</div>
                    <div class="activity-detail-col value">@{{ target }}</div>
                    <div class="activity-detail-col">Limit of Participants :</div>
                    <div class="activity-detail-col value">@{{ limit }}</div>
                </div>
            </div>
            <div class="activity-panel">
                <a v-if="applyStatus==='0'" href="{{url("/club/aActivity/".$getData[0]['activity_id'])}}" class="myButton_small">APPLY</a>
                <div v-if="applyStatus==='1'" class="panel-button" style="color: cornflowerblue">PENDING</div>
                <div v-if="applyStatus==='2'" class="panel-button" style="color: lime">APPROVED</div>
                <div v-if="applyStatus==='3'" class="panel-button" style="color: red">DENIED</div>
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
            var aContainer = new Vue({
                el:'#a-container',
                data:{
                    name:'{{$getData[0]['activity_name']}}',
                    image:'{{asset("/public/storage/activity/".$getData[0]['activity_image'])}}',
                    caption:`{{$getData[0]['activity_caption']}}`,
                    openTime:'{{$getData[0]['activity_apply_open']}}',
                    closeTime:'{{$getData[0]['activity_apply_close']}}',
                    target:'{{$getData[0]['activity_participant_condition']}}',
                    limit:'{{$getData[0]['activity_participant_max']}}',

                    applyStatus:'{{$getStatus}}'
                }
            });
        </script>
@endsection
