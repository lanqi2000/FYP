<template>
    <div id="c-container">
        <div class="message" @click="chat=!chat">
            <img src="{{asset('resources/views/TEMPLATE/ICON/chat.png')}}" width="30px" style="filter: invert(100%)">
        </div>
        <div class="chat" v-if="chat">New message</div>
    </div>
</template>

<script>
    export default {

    }
</script>
