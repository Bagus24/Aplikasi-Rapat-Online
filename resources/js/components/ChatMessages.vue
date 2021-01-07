<template>
    <ul class="chat">
        <li class="left clearfix" v-for="(message, kuy) in messages" :key="kuy">
            <div class="chat-body clearfix">
                <div class="header">
                    <strong class="primary-font">
                        {{ message.user.nama }}
                    </strong>
                </div>
                <p>
                    {{ message.message }}
                </p>
            </div>
        </li>
    </ul>
</template>

<script>
export default {
  props: ['messages'],
};
</script>