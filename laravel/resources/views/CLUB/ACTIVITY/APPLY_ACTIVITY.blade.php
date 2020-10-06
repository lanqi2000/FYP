@extends('CTEMPLATE.CTEMPLATE')
@section('h-ctemplate')
        <link rel="stylesheet" href="{{asset('public/css/CLUB/ACTIVITY/APPLY_ACTIVITY.css')}}">
@endsection
@section('b-ctemplate')
    <div id="f-container" style="width: 100%; height: 100%">
        <div class="activity-apply-form">
            <h1>Application Form</h1>
            <div class="form-body">
                <div class="form-box input-text" v-if="userId">
                    <label class="form-label">User Id</label>
                    <input class="form-input" style="color: darkgrey" type="text" value="127" disabled/>
                </div>
                <div class="form-box input-text" v-if="inputName">
                    <label class="form-label">Name</label>
                    <input class="form-input" type="text" v-model="name" @change="defaultDataPack(1)"/>
                </div>
                <div class="form-box" v-if="inputGender">
                    <label class="form-label">Gender</label>
                    <div class="input-radio-checkbox">
                        <input class="form-input" name="gender" v-model="gender" value="Male" type="radio" @change="defaultDataPack(2)"/>
                        <label style="margin: 0 10px;">Male</label>
                    </div>
                    <div class="input-radio-checkbox">
                        <input class="form-input" name="gender" v-model="gender" value="Female" type="radio" @change="defaultDataPack(2)"/>
                        <label style="margin: 0 10px;">Female</label>
                    </div>
                </div>
                <div class="form-box input-text" v-if="inputStudentId">
                    <label class="form-label">Student ID</label>
                    <input class="form-input" type="text" v-model="studentId" @change="defaultDataPack(3)"/>
                </div>
                <div class="form-box input-text" v-if="inputContactNumber">
                    <label class="form-label">Contact Number</label>
                    <input class="form-input" type="text" v-model="contactNumber" @change="defaultDataPack(4)"/>
                </div>
            </div>

            <application-form v-for="(value,index) in inputList" :selection="value[0]" :index="index" :defaultdata="value" @value="dataPack"></application-form>

            <div class="form-panel" >
                <div v-if="!success" class="myButton_small form-submit" @click="submit">Submit</div>
                <input v-if="!success" type="reset" class="myButton_small form-reset" value="Reset" style="margin: 0 10px; outline: none;">
                <a v-if="!success" href="{{url("/club/rActivity/$id")}}" class="myButton_small form-cancel">Cancel</a>
                <div v-if="success" style="margin: 40px 0">Submitted</div>
            </div>

        </div>
        <transition name="flash">
            <div class="submited" v-if="pass">Successful</div>
        </transition>
        <transition name="flash">
            <div class="submited" v-if="fail" style="background-color: #f70000;">Please Complete the Form</div>
        </transition>
    </div>
@endsection
@section('s-ctemplate')
        <script>
            Vue.component('input-radio',{
                props:['index','defaultdata','radioname'],
                data:function (){
                    return{
                        editRadioCheck:false,
                        value:this.defaultdata
                    }
                },
                template:`<div class="input-radio-checkbox">
                            <input class="form-input" :name="radioname" type="radio" @change="emit"/>
                            <label style="margin: 0 10px;">@{{ value }}</label>
                        </div>`,
                methods:{
                    emit(){
                        console.log('as');
                        this.$emit('value',this.value);
                    },
                },
            });
            Vue.component('input-checkbox',{
                props:['index','defaultdata'],
                data:function (){
                    return{
                        editRadioCheck:false,
                        value:this.defaultdata,
                    }
                },
                template:`
                    <div class="input-radio-checkbox">
                        <input class="form-input" type="checkbox" @change="emit"/>
                        <label style="margin: 0 10px;">@{{ value }}</label>
                    </div>`,
                methods:{
                    emit(){
                        this.$emit('value',this.value,this.index);
                    }
                },
            });
            Vue.component('application-form',{
                props:['selection','index','defaultdata'],
                data:function(){
                    return {
                        title:this.defaultdata[1],
                        rcSelection:this.defaultdata[2],
                        rcValue:[],
                        value:'',

                        editRadioCheck:false,
                    }
                },
                template:
                    `<div class="form-body">
                    <div class="form-box input-text" v-if="selection===1">
                        <label class="form-label">@{{ title }}</label>
                        <input class="form-input" type="text" v-model="value" @change="emit"/>
                    </div>

                    <div class="form-box" v-if="selection===2">
                        <label class="form-label">@{{ title }}</label>
                        <input-radio v-for="(value,index) in rcSelection" :defaultdata="value" @value="emit" :index="index" :radioname="title"></input-radio>
                    </div>

                    <div class="form-box" v-if="selection===3">
                        <label class="form-label">@{{ title }}</label>
                        <input-checkbox v-for="(value,index) in rcSelection" :defaultdata="value" @value="rcValuePack" :index="index"></input-checkbox>
                    </div>

                    <div class="form-box" v-if="selection===4">
                        <label class="form-label">@{{ title }}</label>
                        <input class="form-input input-file" ref="inputFile" type="file" @change="emit" multiple/>
                    </div>
                </div>`,
                methods:{
                    emit(value){
                        console.log(this.selection);
                        switch(this.selection){
                            case 1:
                                this.$emit('value',this.value,this.index);
                                break;
                            case 2:
                                this.$emit('value',value,this.index);
                                break;
                            case 3:
                                this.$emit('value',this.rcValue,this.index);
                                break;
                            case 4:
                                let formData = new FormData;
                                for (let i = 0; i < this.$refs.inputFile.files.length; i++) {
                                    formData.append(i, this.$refs.inputFile.files[i]);
                                }
                                axios.post('{{url('/club/aActivity-input/'.$id)}}',formData)
                                    .then(response=>{
                                        console.log(response);
                                        this.$emit('value',response.data,this.index);
                                    })
                                    .catch(error=>console.log(error.response));
                                break;
                        }

                    },
                    rcValuePack(value,key){
                        if(this.rcValue[key]){
                            this.rcValue[key]= '';
                        }
                        else {
                            this.rcValue[key]= value;
                        }
                        this.emit();
                    }
                },
            });
            var head = new Vue({
                el:'#head',
                data:{
                    title:'TEETH CLUB'
                },
            });
            var fContainer = new Vue({
                el:'#f-container',
                data:{
                    inputList:[],
                    userId:true,
                    inputName:true,inputGender:true,inputStudentId:true,inputContactNumber:true,
                    name:'{{$getDefaultData['user_name']}}',gender:'{{$getDefaultData['user_gender']}}',studentId:'{{$getDefaultData['student_id']}}',contactNumber:'{{$getDefaultData['user_hp']}}',
                    defaultTotal:0,

                    pass:false,
                    success:false,
                    fail:false,

                    getInputList:[],

                    dataSet:[],
                },methods:{
                    setActivity(){
                        this.getInputList = @json($getData);
                        this.inputName = false;
                        this.inputGender = false;
                        this.inputStudentId = false;
                        this.inputContactNumber = false;
                        for(let input in this.getInputList){
                            switch (this.getInputList[input][0]){
                                case "default1":
                                    this.inputName = true;
                                    this.defaultTotal++;
                                    if(this.name!==''){
                                        this.dataSet[input]=this.name;
                                    }else
                                        this.dataSet[input]='';
                                    break;
                                case "default2":
                                    this.inputGender = true;
                                    this.defaultTotal++;
                                    if(this.name!==''){
                                        this.dataSet[input]=this.gender;
                                    }else
                                        this.dataSet[input]='';
                                    break;
                                case "default3":
                                    this.inputStudentId = true;
                                    this.defaultTotal++;
                                    if(this.name!==''){
                                        this.dataSet[input]=this.studentId;
                                    }else
                                        this.dataSet[input]='';
                                    break;
                                case "default4":
                                    this.inputContactNumber = true;
                                    this.defaultTotal++;
                                    if(this.name!==''){
                                        this.dataSet[input]=this.contactNumber;
                                    }else
                                        this.dataSet[input]='';
                                    break;
                                case 1:case 2:case 3:case 4:
                                    Vue.set(this.inputList,this.inputList.length,this.getInputList[input]);
                                    this.dataSet[input]='';
                                    break;
                            }
                        }
                    },
                    defaultDataPack(n){
                        switch (n){
                            case 1:
                                this.dataSet[0]=this.name;
                                break;
                            case 2:
                                if(this.inputName){
                                    this.dataSet[1]=this.gender;
                                }
                                else this.dataSet[0]=this.gender;
                                break;
                            case 3:
                                if(this.inputName && this.inputGender){
                                    this.dataSet[2]=this.studentId;
                                }
                                else if(this.inputName || this.inputGender){
                                    this.dataSet[1]=this.studentId;
                                }
                                else this.dataSet[0]=this.studentId;
                                break;
                            case 4:
                                if(this.inputName && this.inputGender && this.inputStudentId){
                                    this.dataSet[3]=this.contactNumber;
                                }
                                else if(this.inputName && this.inputGender){
                                    this.dataSet[2]=this.contactNumber;
                                }
                                else if(this.inputName && this.inputStudentId){
                                    this.dataSet[2]=this.contactNumber;
                                }
                                else if(this.inputGender && this.inputStudentId){
                                    this.dataSet[2]=this.contactNumber;
                                }
                                else if(this.inputName || this.inputGender || this.inputStudentId){
                                    this.dataSet[1]=this.contactNumber;
                                }
                                else this.dataSet[0]=this.contactNumber;
                                break;
                        }
                        console.log(this.dataSet);
                    },
                    dataPack(value,key){
                        this.dataSet[this.defaultTotal+key]=value;
                        console.log(this.dataSet);
                    },
                    show_off(){
                        this.pass = false;
                        this.fail = false;
                    },
                    submit(){
                        let formData = new FormData;
                        let array = [];
                        let next = true;

                        for (let index in this.dataSet) {
                            let object = {};
                            if (this.dataSet[index]!==''){
                                object[index] = this.dataSet[index];
                                array.push(object);
                            }else{
                                this.fail = true;
                                next = false;
                                setTimeout(this.show_off, 3000);
                                break;
                            }
                        }
                        console.log(array);
                        if(next){
                            formData.append('jsonData', JSON.stringify(array));
                            axios.post('{{url('/club/aActivity-input/'.$id)}}',formData)
                                .then(response=>{
                                    console.log(response.data);
                                    if (response.data==='ok'){
                                        this.pass = true;
                                        this.success = true;
                                        setTimeout(this.show_off, 3000);
                                        this.userId= false;
                                        this.inputList.splice(0);
                                        this.inputName = this.inputGender = this.inputStudentId = this.inputContactNumber = false;
                                    }else{
                                        this.fail = true;
                                        setTimeout(this.show_off, 3000);
                                    }
                                })
                                .catch(error=>console.log(error.response));
                        }
                    }
                },mounted() {
                    this.setActivity();
                }
            });
            function goBack(){
                window.history.back();
            }
        </script>
@endsection
