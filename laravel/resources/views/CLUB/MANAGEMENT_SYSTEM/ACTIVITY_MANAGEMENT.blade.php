@extends('CTEMPLATE.CTEMPLATE')
@section('h-ctemplate')
    <link rel="stylesheet" href="{{asset('public/css/CLUB/MANAGEMENT_SYSTEM/ACTIVITY_MANAGEMENT.css')}}">
@endsection
@section('b-ctemplate')
    <h1 class="header" style="width: 360px">ACTIVITY MANAGEMENT</h1>
    <div id="activity-management">
        <div style="display: flex; flex-direction: row; margin-bottom: 30px;">
            <div class="am-option" @click="changeShow(1)" :class="{selected:createShow}">CREATE ACTIVITY</div>
            <div class="am-option" @click="changeShow(2)" :class="{selected:editShow}">EDIT ACTIVITY</div>
            <div class="am-option" @click="changeShow(3)" :class="{selected:responseShow}">FORM RESPONSE</div>
            <div class="am-option" @click="changeShow(4)" :class="{selected:feedbackShow}">ACTIVITY FEEDBACK</div>
        </div>
        <div class="activity-select" v-if="responseShow">
            <label>Activity :</label>
            <select v-model="activityResponse" @change="getResponseData">
                <option v-for="(checklist,key) in showCheckList" :value="checklist.actId">@{{ checklist.name }}</option>
            </select>
        </div>
        <table class="post-list" v-if="tableShow">
            <tr style="background-color: #3c4161;">
                <td>
                    <table>
                        <tr class="post-list-header" style="width: 700px" v-if="editShow">
                            <th class="post-list-element" style="width: 35px;">No</th>
                            <th class="post-list-element" style="width: 360px;">Activity Name</th>
                            <th class="post-list-element" style="width: 208px;">Create/Edit time</th>
                            <th class="post-list-element" style="width: 91px;">Edit</th>
                            <th class="post-list-element" style="width: 91px;">Delete</th>
                        </tr>
                        <tr class="post-list-header" style="width: 700px;" v-if="responseShow">
                            <th class="post-list-element" style="width: 35px;">No</th>
                            <th class="post-list-element" style="width: 330px;">User Id</th>
                            <th class="post-list-element" style="width: 130px;">Apply Status</th>
                            <th class="post-list-element" style="width: 105px;">Approve</th>
                            <th class="post-list-element" style="width: 95px;">Denial</th>
                            <th class="post-list-element" style="width: 95px;">Detail</th>
                        </tr>
                    </table>
                </td>

            </tr>
            <tr>
                <td>
                    <div class="post-list-body" style="width: 800px;" :class="{postlistoverflow:responseShow}">
                        <table>
                            <check-list v-if="editShow" v-for="(checklist,key) in showCheckList" :listkey="key" :actid="checklist.actId" :actname="checklist.name" :createdtime="checklist.time" @actdata="setActivity" @actdelete="deleteCheckList"></check-list>
                            <response-list v-if="responseShow" v-for="(responselist,key) in showResponseList" :listkey="key" :actid="responselist.activity_id" :actapplyid="responselist.activity_apply_id  " :userid="responselist.user_id" :detail="responselist.activity_apply_data" :applystatus="responselist.activity_apply_status" @check="checkResponse"></response-list>
                        </table>
                    </div>
                </td>
            </tr>
        </table>
        <form ref="form">
            <div class="activity-preview" v-if="actEditUI">
                <div class="activity-title">
                    @{{name}}
                </div>
                <div class="activity-image">
                    <img :src="image" height="100%" v-if="editMedia">
                </div>
                <div class="activity-description">
                    <div class="caption">
                        <div class="preview" ref="caption" style="overflow-wrap: break-word; width: 580px;">@{{caption}}</div>
                    </div>
                    <textarea rows="4" cols="78" v-model="caption" v-show="editCaption" @blur="editCaption=false" style="margin-top: 10px;" required></textarea>
                    <div style="display:flex; flex-direction: row; align-items: center; margin-top: 10px;">
                        <img src="{{asset('resources/views/ICON/Add.svg')}}" class="edit" @click="editCaption=true"/>
                        <div class="alert" v-if="caption===''" style="width: 186px;">Please Key In Something</div>
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
                    <div class="myButton_small">APPLY</div>
                </div>
            </div>
            <div  style="display: flex;flex-direction: row;" v-if="actEditUI">
                <div class="activity-box">
                    <div class="activity-box-image">
                        <img :src="image" height="100%" v-if="editMedia" />
                        <label class="edit" for="image-upload" style="right: 10px;top: 10px;position: absolute;">
                            <img class="edit" src="{{asset('resources/views/ICON/Add.svg')}}"/>
                        </label>
                        <div class="alert" v-if="image===''" style="margin: auto">Please Input Something</div>
                        <input id="image-upload" ref="image" type="file" accept="image/jpeg,image/png" style="display: none;" @change="preview" required/>
                    </div>
                    <div class="activity-box-name">
                        @{{name}}
                    </div>
                </div>
                <div class="detail-input">
                    <div class="detail">
                        <label>Activity Name</label>
                        <input type="text" v-model="name">
                    </div>
                    <div class="detail">
                        <label>Application open at</label>
                        <input type="date" v-model="openTime" :min="minOpen" @change="openCloseTime">
                    </div>
                    <div class="detail">
                        <label>Application close at</label>
                        <input type="date" ref="closeTime" v-model="closeTime" :min="openTime" disabled>
                    </div>
                    <div class="detail">
                        <label>Target</label>
                        <select v-model="target">
                            <option>Anybody</option>
                            <option>User</option>
                            <option>Member</option>
                        </select>
                    </div>
                    <div class="detail">
                        <label>Limit of Participants</label>
                        <input type="number" v-model="limit">
                    </div>
                </div>
            </div>

            <div class="activity-apply-form" v-if="formShow">
                <h1>Application Form</h1>
                <div class="form-body">
                    <div class="form-box input-text" v-if="inputName">
                        <label class="form-label">Name</label>
                        <input class="form-input" v-if="!formName" type="text" disabled/>
                        <div v-if="formName" style="margin-top: 10px">@{{formName}}</div>
                    </div>
                    <div class="form-box" v-if="inputGender">
                        <label class="form-label">Gender</label>
                        <div class="input-radio-checkbox" v-if="!formGender">
                            <input class="form-input" type="radio" disabled/>
                            <label style="margin: 0 10px;">Male</label>
                        </div>
                        <div class="input-radio-checkbox" v-if="!formGender">
                            <input class="form-input" type="radio" disabled/>
                            <label style="margin: 0 10px;">Female</label>
                        </div>
                        <div v-if="formName" style="margin-top: 10px">@{{formGender}}</div>
                    </div>
                    <div class="form-box input-text" v-if="inputStudentId">
                        <label class="form-label">Student ID</label>
                        <input class="form-input" v-if="!formStudentId" type="text" disabled/>
                        <div v-if="formName" style="margin-top: 10px">@{{formStudentId}}</div>

                    </div>
                    <div class="form-box input-text" v-if="inputContactNumber">
                        <label class="form-label">Contact Number</label>
                        <input class="form-input" v-if="!formContactNumber" type="text" disabled/>
                        <div v-if="formName" style="margin-top: 10px">@{{formContactNumber}}</div>
                    </div>
                </div>
                <application-form v-for="(value,index) in inputList" :index="index" :selection="value.frame[0]" :value="value.value" :actid="value.id" :actapplyid="value.actApplyId" :defaultdata="value.frame" @valueset="manualInputPack"></application-form>
                <div class="form-panel" v-if="!responseShow">
                    <div class="myButton_small form-submit">Submit</div>
                    <input type="reset" class="myButton_small form-reset" value="Reset" style="margin: 0 10px; outline: none;">
                    <div class="myButton_small form-cancel">Cancel</div>
                </div>
                <div class="setInput-panel" v-if="!responseShow">
                    <div style="display: flex; flex-direction: row; align-items: center;">
                        <div style="padding-right: 10px;">Add :</div>
                        <img class="input-button" @click="createInput(1)" src="{{asset('resources/views/CLUB/MANAGEMENT_SYSTEM/ICON/text.svg')}}" height="20px" width="20px">
                        <img class="input-button" @click="createInput(2)" src="{{asset('resources/views/CLUB/MANAGEMENT_SYSTEM/ICON/radio.svg')}}" height="20px" width="20px">
                        <img class="input-button" @click="createInput(3)" src="{{asset('resources/views/CLUB/MANAGEMENT_SYSTEM/ICON/checkbox.svg')}}" height="20px" width="20px">
                        <img class="input-button" @click="createInput(4)" src="{{asset('resources/views/CLUB/MANAGEMENT_SYSTEM/ICON/file.svg')}}" height="20px" width="20px">
                        <div style="padding-right: 10px;">Delete :</div>
                        <img src="{{asset('resources/views/ICON/Delete.svg')}}" class="edit" @click="deleteInput" style="filter: invert(41%) sepia(96%) saturate(4732%) hue-rotate(345deg) brightness(102%) contrast(100%);"/>
                    </div>
                    <div style="display: flex; flex-direction: row; align-items: center; margin-top:10px;">
                        <div style="padding-right: 10px;">Default :</div>
                        <input v-model="inputName" type="checkbox" @change="defaultInputPack" checked><label style="padding-right: 5px;">Name</label>
                        <input v-model="inputGender" type="checkbox" @change="defaultInputPack" checked><label style="padding-right: 5px;">Gender</label>
                        <input v-model="inputStudentId" type="checkbox" @change="defaultInputPack" checked><label style="padding-right: 5px;">Student ID</label>
                        <input v-model="inputContactNumber" type="checkbox" @change="defaultInputPack" checked><label style="padding-right: 5px;">Contact Number</label>
                    </div>
                </div>
            </div>

            <div style="display: flex; justify-content: center; align-items: center; margin-top: 30px">
                <div class="detail" v-if="actEditUI">
                    <label style="width: 130px; display: flex;align-items: center; font-weight: bold;">Activity End at</label>
                    <input type="date" v-model="endTime" :min="closeTime" valueAsNumber>
                </div>
            </div>
            <div style="display: flex; justify-content: center; margin: 20px;" v-if="actEditUI">
                <div class="myButton_small final-button" style="margin: 0 auto; text-align: center" @click="completeCreation" v-if="createShow">Create</div>
                <div class="myButton_small final-button" style="margin: 0 auto; text-align: center" @click="completeEdit" v-if="editShow">Save</div>
            </div>
        </form>
        <feedback-container
            v-if="feedbackShow"
            v-for="value in actFeedback"
            :actid="value.act.activity_id"
            :actname="value.act['activity_name']"
            :actendtime="value.act.activity_end_time"
            :feedbacktotal="value.feedback.total"
            :feedbackavg="value.feedback.avg"
            :feedbackcontents="value.feedback.contents"
        ></feedback-container>
        <transition name="flash">
            <div class="submited" v-if="pass">Successful</div>
        </transition>
        <transition name="flash">
            <div class="submited" v-if="fail" style="background-color: #f70000; width: 250px;">Please Complete the Setting</div>
        </transition>
    </div>
@endsection
@section('s-ctemplate')
    <script>
        Vue.component('check-list',{
            props:['listkey','actid','actname','createdtime'],
            data:function(){
                return {
                    status:true,
                    select:false
                }
            },
            template:`
                <tr v-if="status" :class="{clecklistselect:select}">
                    <td class="post-list-element" style="width: 43px; text-align: center;">@{{listkey+1}}</td>
                    <td class="post-list-element" style="width: 400px;">@{{actname}}</td>
                    <td class="post-list-element" style="width: 230px;">@{{createdtime}}</td>
                    <td class="post-list-element" style="width: 80px; text-align: center;">
                        <div class="post-edit-button" @click="actData(actid)">Edit</div>
                    </td>
                    <td class="post-list-element" style="width: 80px; text-align: center;">
                        <div class="post-edit-button" style="background-color: #d0211c" @click="actDelete(actid,listkey)" @mousedown="select=true">Delete</div>
                    </td>
                </tr>`,
            methods:{
                actDelete(actid,listkey){
                    let status = confirm('Are you sure to delete this post?');
                    if(status===true){
                        axios.post('{{url('/club/cmsActivity-delete')}}',{
                            actId : actid
                        }).then(response => {
                            this.status = false;
                            this.$emit('actdelete',listkey);
                        });
                    }
                    else{
                        this.select = false;
                    }
                },

                actData(actid){
                    axios.post('{{url('/club/cmsActivity-editGet')}}',{
                        actId : actid
                    }).then(response => this.$emit("actdata",response.data[0])).catch(error=>console.log(error.response));
                }
            }
        });
        Vue.component('response-list',{
            props:['listkey','actid','actapplyid','userid','detail','applystatus'],
            data:function(){
                return {
                    status:true,
                    select:false,

                    pending:true,
                    approved:false,
                    denied:false,
                    applyStatus:'',
                }
            },
            template:`
                <tr v-if="status" :class="{clecklistselect:select}">
                    <td class="post-list-element" style="width: 43px; text-align: center;">@{{listkey+1}}</td>
                    <td class="post-list-element" style="width: 400px;">@{{userid}}</td>
                    <td class="post-list-element" style="width: 140px; font-weight: bold; text-align: center;"
                        :class="{pending:pending, approved:approved, denied:denied}">@{{applyStatus}}</td>
                    <td class="post-list-element" style="width: 80px; text-align: center;">
                        <div class="post-edit-button" style="background-color: limegreen" @click="updateStatus(actapplyid,2)">Approve</div>
                    </td>
                    <td class="post-list-element" style="width: 80px; text-align: center;">
                        <div class="post-edit-button" style="background-color: #d0211c" @click="updateStatus(actapplyid,3)">Denial</div>
                    </td>
                    <td class="post-list-element" style="width: 80px;">
                        <div class="post-edit-button" style="background-color: coral" @click="checkResponse()">Check</div>
                    </td>
                </tr>`,
            methods:{
                actDelete(actapplyid,listkey){
                    let status = confirm('Are you sure to delete this post?');
                    if(status===true){
                        axios.post('{{url('/club/cmsActivity-delete')}}',{
                            actId : actapplyid
                        }).then(response => {
                            this.status = false;
                            this.$emit('actdelete',listkey);
                        });
                    }
                    else{
                        this.select = false;
                    }
                },

                updateStatus(actapplyid,status){
                    axios.post('{{url('/club/cmsActivity-updateResponse')}}',{
                        actApplyId : actapplyid,
                        status : status,
                    }).then(response =>{
                        console.log(response.data);
                        this.pending = this.approved = this.denied = false;
                        if(response.data=='2'){
                            this.approved=true;
                            this.applyStatus='Approved'
                        }else if(response.data=='3'){
                            this.denied=true;
                            this.applyStatus='Denied'
                        }
                    }).catch(error=>console.log(error.response));
                },
                checkResponse(){
                    this.$emit('check',this.detail,this.actid,this.actapplyid);
                }
            },
            mounted() {
                this.pending = this.approved = this.denied = false;
                switch(this.applystatus){
                    case "1":this.applyStatus='pending';this.pending=true;break;
                    case "2":this.applyStatus='Approved';this.approved=true;break;
                    case "3":this.applyStatus='Denied';this.denied=true;break;
                }
            },
        });
        Vue.component('input-radio',{
            props:['index','defaultdata'],
            data:function (){
                return{
                    editRadioCheck:false,
                    value:''
                }
            },
            template:`<div class="input-radio-checkbox">
                            <input class="form-input" type="radio" disabled/>
                            <label style="margin: 0 10px;">@{{ value }}</label>
                            <input type="text" v-model="value" v-if="editRadioCheck" @blur="editRadioCheck=false"/>
                            <img src="{{asset('resources/views/ICON/Add.svg')}}" class="edit" @click="editRadioCheck=true"/>
                            <div class="alert" v-if="value===''" style="margin-left: 10px; background-color: grey;">Please Key in Option</div>
                        </div>`,
            methods:{
                emit(){
                    this.$emit('value',this.value,this.index);
                },
            },
            mounted(){
                if(this.defaultdata[0]){
                    this.value=this.defaultdata;
                }
            },
            updated(){
                this.emit();
            }
        });
        Vue.component('input-checkbox',{
            props:['index','defaultdata'],
            data:function (){
                return{
                    editRadioCheck:false,
                    value:''
                }
            },
            template:`<div class="input-radio-checkbox">
                            <input class="form-input" type="checkbox" disabled/>
                            <label style="margin: 0 10px;">@{{ value }}</label>
                            <input type="text" v-model="value" v-if="editRadioCheck" @blur="editRadioCheck=false" @change="emit"/>
                            <img src="{{asset('resources/views/ICON/Add.svg')}}" class="edit" @click="editRadioCheck=true"/>
                            <div class="alert" v-if="value===''" style="margin-left: 10px; background-color: grey;">Please Key in Option</div>
                        </div>`,
            methods:{
                emit(){
                    this.$emit('value',this.value,this.index);
                }
            },
            mounted(){
                if(this.defaultdata[0]){
                    this.value=this.defaultdata;
                }
            },
            updated(){
                this.emit();
            }
        });
        Vue.component('application-form',{
            props:['selection','index','defaultdata','value','actid','actapplyid'],
            data:function(){
                return {
                    title:'',
                    rcSelection:[],
                    rcValue:[],
                    input:true,
                    namespace:'',
                    ida:this.actid,
                    idb:this.actapplyid,

                    editTitle:false,
                    editRadioCheck:false,
                }
            },
            template:
                `<div class="form-body">
                    <div class="form-box input-text" v-if="selection===1">
                        <div class="setTitle">
                            <label class="form-label">@{{ title }}</label>
                            <input type="text" v-model="title" v-if="editTitle && input" @blur="editTitle=false"/>
                            <img src="{{asset('resources/views/ICON/Add.svg')}}" class="edit" v-if="!editTitle && input" @click="editTitle=true"/>
                            <div class="alert" v-if="title==='' && input" style="margin-left: 10px; background-color: darkgoldenrod;">Please Key in Title</div>
                        </div>
                        <input v-if="input" class="form-input" type="text" disabled/>
                        <div v-if="!input">@{{value}}</div>
                    </div>

                    <div class="form-box" v-if="selection===2">
                        <div class="setTitle">
                            <label class="form-label">@{{ title }}</label>
                            <input type="text" v-model="title" v-if="editTitle && input" @blur="editTitle=false"/>
                            <img src="{{asset('resources/views/ICON/Add.svg')}}" class="edit" v-if="!editTitle && input" @click="editTitle=true"/>
                            <div class="alert" v-if="title==='' && input" style="margin-left: 10px; background-color: darkgoldenrod;">Please Key in Title</div>
                        </div>
                        <input-radio v-if="input" v-for="(value,index) in rcSelection" :defaultdata="value" @value="rcValuePack" :index="index"></input-radio>
                        <div style="display: flex; align-items: center; flex-direction: row; margin-top: 10px;" v-if="input">
                            Add :<img src="{{asset('resources/views/ICON/Add.svg')}}" class="edit" @click="addSelection" style="filter: invert(52%) sepia(53%) saturate(4557%) hue-rotate(196deg) brightness(101%) contrast(101%); margin-right: 10px;"/>
                            Delete :<img src="{{asset('resources/views/ICON/Delete.svg')}}" class="edit" @click="deleteSelection" style="filter: invert(41%) sepia(96%) saturate(4732%) hue-rotate(345deg) brightness(102%) contrast(100%);"/>
                        </div>
                        <div v-if="!input">@{{value}}</div>
                    </div>

                    <div class="form-box" v-if="selection===3">
                        <div class="setTitle">
                            <label class="form-label">@{{ title }}</label>
                            <input type="text" v-model="title" v-if="editTitle && input" @blur="editTitle=false"/>
                            <img src="{{asset('resources/views/ICON/Add.svg')}}" class="edit" v-if="!editTitle && input" @click="editTitle=true"/>
                            <div class="alert" v-if="title==='' && input" style="margin-left: 10px; background-color: darkgoldenrod;">Please Key in Title</div>
                        </div>
                        <input-checkbox v-if="input" v-for="(value,index) in rcSelection" :defaultdata="value" @value="rcValuePack" :index="index"></input-checkbox>
                        <div style="display: flex; align-items: center; flex-direction: row; margin-top: 10px;" v-if="input">
                            Add :<img src="{{asset('resources/views/ICON/Add.svg')}}" class="edit" @click="addSelection" style="filter: invert(52%) sepia(53%) saturate(4557%) hue-rotate(196deg) brightness(101%) contrast(101%); margin-right: 10px;"/>
                            Delete :<img src="{{asset('resources/views/ICON/Delete.svg')}}" class="edit" @click="deleteSelection" style="filter: invert(41%) sepia(96%) saturate(4732%) hue-rotate(345deg) brightness(102%) contrast(100%);"/>
                        </div>
                        <ul v-if="!input" class="list"><li v-for="i in value" >@{{i}}</li></ul>
                    </div>

                    <div class="form-box" v-if="selection===4">
                        <div class="setTitle">
                            <label class="form-label">@{{ title }}</label>
                            <input type="text" v-model="title" v-if="editTitle && input" @blur="editTitle=false" height="20px" width="20px"/>
                            <img src="{{asset('resources/views/ICON/Add.svg')}}" class="edit" v-if="!editTitle && input" @click="editTitle=true"/>
                            <div class="alert" v-if="title==='' && input" style="margin-left: 10px; background-color: darkgoldenrod;">Please Key in Title</div>
                        </div>
                        <input v-if="input" class="form-input input-file" type="file" multiple disabled/>
                        <ul v-if="!input" class="list">
                            <li v-for="i in value">
                                <a class="fileLink" target="_blank" :href="'{{asset('storage/app/public//activity')}}'+'/'+ida+'/form'+idb+'/'+i">@{{ i }}</a>
                            </li>
                        </ul>
                    </div>
                </div>`,
            methods:{
                rcValuePack(...[value,key]){
                    Vue.set(this.rcValue,key,value);
                },
                addSelection(){
                    Vue.set(this.rcSelection,this.rcSelection.length,1);
                },
                deleteSelection(){
                    this.rcSelection.splice(this.rcSelection.length-1);
                    this.rcValue.splice(this.rcValue.length-1);
                }
            },
            created(){
                this.namespace = '/'+this.actid+'/form'+this.actapplyid+'/';
                console.log(this.namespace);
            },
            mounted(){
                if(this.defaultdata.length>1){
                    this.title = this.defaultdata[1];
                    if(this.defaultdata.length>2){
                        this.rcSelection = this.defaultdata[2];
                    }
                }
                if(this.value){
                    this.input = false;
                }

            },
            updated() {
                this.namespace = '/'+this.actid+'/form'+this.actapplyid+'/';
                console.log(this.namespace);
                switch (this.selection){
                    case 1:case 4: this.$emit('valueset',this.index,this.selection,this.title);break;
                    case 2:case 3: this.$emit('valueset',this.index,this.selection,this.title,this.rcValue);break;
                }
            }
        });
        Vue.component('feedback-container',{
            props:['actid','actname','actendtime','feedbacktotal','feedbackavg','feedbackcontents'],
            data:function(){
                return{
                    range:this.feedbackcontents[0]['activity_range'],
                    comment:this.feedbackcontents[0]['feedback_comment'],

                    head:0,
                }
            },
            template:`
            <div class="feedback-container">
                <div class="feedback-left">
                    <div class="feedback-range-average">
                        @{{ feedbackavg }}<img class="star" src="{{asset('resources/views/ICON/star.png')}}">
                    </div>
                    <div class="feedback-detail">
                        <label class="feedback-detail-label">Activity</label>
                        <p class="feedback-detail-content">@{{ actname }}</p>
                        <label class="feedback-detail-label">Activity End At</label>
                        <p class="feedback-detail-content">@{{ actendtime }}</p>
                        <label class="feedback-detail-label">Total Feedback</label>
                        <p class="feedback-detail-content">@{{ feedbacktotal }}</p>
                    </div>
                </div>
                <div class="feedback-right">
                    <div class="feedback-filter">
                        <input class="radio-range" type="radio" name="classRange">
                        <label class="label-range">5<img class="star" src="{{asset('resources/views/ICON/star.png')}}"></label>
                        <input class="radio-range" type="radio" name="classRange">
                        <label class="label-range">4<img class="star" src="{{asset('resources/views/ICON/star.png')}}"></label>
                        <input class="radio-range" type="radio" name="classRange">
                        <label class="label-range">3<img class="star" src="{{asset('resources/views/ICON/star.png')}}"></label>
                        <input class="radio-range" type="radio" name="classRange">
                        <label class="label-range">2<img class="star" src="{{asset('resources/views/ICON/star.png')}}"></label>
                        <input class="radio-range" type="radio" name="classRange">
                        <label class="label-range">1<img class="star" src="{{asset('resources/views/ICON/star.png')}}"></label>
                        <input class="radio-range" type="radio" name="classRange">
                        <label class="label-range">All</label>
                    </div>
                    <div>
                        <div class="feedback-range">
                            <div class="range-box">
                                <div style="font-weight: bold; font-size: 22px; color: white">@{{ range }}</div>
                                <img class="star" src="{{asset('resources/views/ICON/star.png')}}" >
                            </div>
                        </div>
                        <div class="feedback-comment">
                            <div class="comment-arrow" @click="changeComment(1)"><</div>
                            <div class="comment-area">@{{ comment }}</div>
                            <div class="comment-arrow" @click="changeComment(2)">></div>
                        </div>
                    </div>
                </div>
            </div>`,
            methods:{
                changeComment(d){
                    switch (d){
                        case 1:
                            if(this.head>0){
                                this.head--;
                                this.range=this.feedbackcontents[this.head]['activity_range'];
                                this.comment=this.feedbackcontents[this.head]['feedback_comment'];
                            }
                            break;
                        case 2:
                            if(this.head<this.feedbackcontents.length-1){
                                this.head++;
                                this.range=this.feedbackcontents[this.head]['activity_range'];
                                this.comment=this.feedbackcontents[this.head]['feedback_comment'];
                            }
                            break;
                    }
                }
            },
        });
        var CMS = new Vue({
            el:'#activity-management',
            data:{
                createShow:true,
                editShow:false,
                responseShow:false,
                feedbackShow:false,
                tableShow:false,
                formShow:true,
                actEditUI:true,
                showCheckList:[],
                activityResponse:null,
                showResponseList:[],

                name:'',
                image:'',
                caption:'',
                minOpen:'',
                openTime:'',
                closeTime:'',
                target:null,
                limit:null,

                editMedia:false,
                editCaption:false,
                //form
                inputList:[],
                inputName:true,
                inputGender:true,
                inputStudentId:true,
                inputContactNumber:true,
                formName:'',
                formGender:'',
                formStudentId:'',
                formContactNumber:'',

                defaultSet:[["default1"],["default2"],["default3"],["default4"]],
                manualSet:[],
                formSet:[],

                endTime:'',

                pass:false,
                fail:false,

                actId:null,
                getInputList:[],

                //activity feedback
                actFeedback:[],
            },
            methods:{
                fullReset(){
                    this.actEditUI = false;
                    this.tableShow = false;
                    this.formShow = false;
                    this.createShow = false;
                    this.responseShow = false;
                    this.feedbackShow = false;
                    this.editShow=false;
                    this.reset();
                },
                changeShow(s){
                    switch (s){
                        case 1:this.fullReset();this.actEditUI = true;this.createShow = true;this.formShow = true;break;
                        case 2:this.fullReset();this.editShow = true;this.tableShow = true;break;
                        case 3:this.fullReset();this.responseShow= true;this.tableShow = true;break;
                        case 4:this.fullReset();this.feedbackShow= true;this.setFeedback();break;
                    }
                },
                setActivity(data){
                    this.actEditUI = true;
                    this.actId = data['activity_id'];
                    this.caption=data['activity_caption'];
                    this.editMedia = true;
                    let prefix = '{{asset('storage/app/public/activity')}}';
                    this.image = prefix + '/' + data['activity_image'];
                    this.name = data['activity_name'];
                    this.openTime = data['activity_apply_open'];
                    this.closeTime = data['activity_apply_close'];
                    this.target = data['activity_participant_condition'];
                    this.limit = data['activity_participant_max'];
                    this.endTime = data['activity_end_time'];
                    //set form
                    this.setForm(JSON.parse(data['activity_application_form']));
                },
                openCloseTime(){
                    if(this.openTime){
                        this.$refs.closeTime.disabled = false;
                        this.closeTime = '';
                    }
                    else{
                        this.$refs.closeTime.disabled = true;
                    }
                },
                setForm(data,value,id,actApplyId){
                    this.getInputList = data;
                    this.inputName = false;
                    this.inputGender = false;
                    this.inputStudentId = false;
                    this.inputContactNumber = false;
                    for(let input in this.getInputList){
                        switch (this.getInputList[input][0]){
                            case "default1":
                                this.inputName = true;
                                if(value){
                                    this.formName = value[input][input];
                                }
                                break;
                            case "default2":
                                this.inputGender = true;
                                if(value){
                                    this.formGender = value[input][input];
                                }
                                break;
                            case "default3":
                                this.inputStudentId = true;
                                if(value){
                                    this.formStudentId = value[input][input];
                                }
                                break;
                            case "default4":
                                this.inputContactNumber = true;
                                if(value){
                                    this.formContactNumber = value[input][input];
                                }
                                break;
                            case 1:case 2:case 3:case 4:
                                // Vue.set(this.inputList,this.inputList.length,this.getInputList[input]);
                                console.log(id);
                                console.log(actApplyId);
                                Vue.set(this.inputList,this.inputList.length, {
                                    'frame':this.getInputList[input],
                                    'value':this.formContactNumber = value[input][input],
                                    'id':id,
                                    'actApplyId':actApplyId
                                });
                                break;
                        }
                    }
                    console.log(this.inputList);
                },
                deleteCheckList(n){
                    this.showCheckList.splice(n,1);
                },
                preview(e){
                    this.image= '';
                    let reader = new FileReader();
                    let media = e.target.files[0];
                    reader.readAsDataURL(media);
                    reader.onload = e =>{
                        this.image = e.target.result;
                    }
                    this.editMedia = true;
                },
                createInput(n){
                    Vue.set(this.inputList,this.inputList.length,{frame:[n]});
                },
                deleteInput(){
                    this.inputList.splice(this.inputList.length-1);
                    this.manualSet.splice(this.manualSet.length-1);
                    console.log(this.defaultSet.concat(this.manualSet));
                },
                defaultInputPack(){
                    this.defaultSet.splice(0);
                    let s = 0;
                    if(this.inputName) {
                        Vue.set(this.defaultSet,s,{frame:["default1"]});
                        s++;
                    }
                    if(this.inputGender) {
                        Vue.set(this.defaultSet,s,{frame:["default2"]});
                        s++;
                    }
                    if(this.inputStudentId) {
                        Vue.set(this.defaultSet,s,{frame:["default3"]});
                        s++;
                    }
                    if(this.inputContactNumber){
                        Vue.set(this.defaultSet,s,{frame:["default4"]});
                        s++;
                    }
                },
                manualInputPack(n,...sd){
                    Vue.set(this.manualSet,n,sd);
                },
                completeCreation(){
                    let status = confirm("This Application Form is unchangeable.\nAre you sure to create?")
                    if(status === true){
                        let formData = new FormData;
                        let jsonData = {
                            "actName":this.name,
                            "actCaption":this.caption,
                            "actOpenTime":this.openTime,
                            "actCloseTime":this.closeTime,
                            "actTarget":this.target,
                            "actLimit":this.limit,
                            "actForm":this.defaultSet.concat(this.manualSet),
                            "actEndTime":this.endTime
                        }
                        formData.append('actImage',this.$refs.image.files[0]);
                        formData.append('jsonData',JSON.stringify(jsonData));
                        axios.post(
                            '{{url('/club/cmsActivity-input')}}',
                            formData
                        ).then(
                            response => this.result(response.data)
                        ).catch(
                            error=> console.log(error.response)
                        );
                    }
                },
                completeEdit(){
                    let formData = new FormData;
                    let jsonData = {
                        "actId":this.actId,
                        "actName":this.name,
                        "actCaption":this.caption,
                        "actOpenTime":this.openTime,
                        "actCloseTime":this.closeTime,
                        "actTarget":this.target,
                        "actLimit":this.limit,
                        "actEndTime":this.endTime
                    }
                    if(this.$refs.image.files[0]){
                        formData.append('actImage',this.$refs.image.files[0]);
                    }else{
                        formData.append('actImage','empty');
                    }
                    formData.append('jsonData',JSON.stringify(jsonData));
                    axios.post(
                        '{{url('/club/cmsActivity-editSave')}}',
                        formData
                    ).then(
                        response => {
                            this.result(response.data,this.actId)
                            this.fullReset();
                            this.editShow = true;this.tableShow = true;
                        }
                    ).catch(
                        error=> console.log(error.response)
                    );
                },
                getResponseData(){
                    this.showResponseList.splice(0);
                    axios.post('{{url('/club/cmsActivity-getResponse')}}',{
                        id:this.activityResponse
                    })
                        .then(response=>{
                            for(let i in response.data){
                                Vue.set(this.showResponseList,i,response.data[i]);
                            }
                        })
                        .catch(error=>console.log(error.response));
                },
                checkResponse(detail,actId,actApplyId){
                    this.reset();
                    axios.post('{{url('/club/cmsActivity-checkResponse')}}',{
                        actId:actId
                    })
                        .then(response=> {
                            this.setForm(response.data,JSON.parse(detail),actId,actApplyId);
                        })
                        .catch(error=>console.log(error.response))
                    this.formShow = true;
                },
                show_off(){
                    this.pass = false;
                    this.fail = false;
                },
                reset(){
                    this.name = this.caption = this.openTime = this.closeTime = this.target = this.limit  = this.endTime = this.image = this.$refs.image = null;
                    this.formName = this.formGender = this.formContactNumber = this.formStudentId = null;
                    this.input = true;
                    this.manualSet.splice(0);
                    this.inputList.splice(0);
                    this.inputName = true;
                    this.inputGender = true;
                    this.inputStudentId = true;
                    this.inputContactNumber = true;
                },
                result(res,id){
                    if(res===0){
                        this.fail=true;
                        setTimeout(this.show_off, 3000);
                    }else if(res){
                        this.pass=true;
                        this.reset();
                        setTimeout(this.show_off, 3000);
                        if(this.showCheckList[this.showCheckList.length-1].actId==id){
                            this.showCheckList.splice(this.showCheckList.length-1)
                        }
                        let object = {};
                        object.actId = res['activity_id'];
                        object.name = res['activity_name'];
                        object.time = res['activity_created_at'];
                        Vue.set(this.showCheckList,this.showCheckList.length,object);
                    }
                },
                //feedback
                setFeedback(){
                    let array = [];
                    axios.post('{{url('/club/cmsActivity-getActivity')}}')
                        .then(response=>{
                            this.actFeedback.splice(0);
                            array = response.data
                            axios.post('/club/cmsActivity-getFeedback',{
                                array:array
                            }).then(res=> {
                                let n = 0;
                                for(let i in response.data){
                                    if(res.data[i]!=='empty'){
                                        Vue.set(this.actFeedback,n,{'act':response.data[i],'feedback':JSON.parse(res.data[i])});
                                        n++;
                                    }
                                }
                            })
                            .catch(error=>console.log(error.response));
                        });
                }
            },
            created(){
                let object = {};
                @foreach($getActivity as $data)
                object = {};
                object.actId = '{{$data['activity_id']}}';
                object.name = '{{$data['activity_name']}}';
                object.time = '{{$data['activity_created_at']}}';
                Vue.set(this.showCheckList,this.showCheckList.length,object);
                @endforeach
                this.minOpen = new Date().toISOString().split("T")[0];
            },
        });
    </script>
@endsection
