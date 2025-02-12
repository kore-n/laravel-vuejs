<template>
  <div class="chat-container">
    <div class="messages">
      <div v-for="(msg, index) in messages" :key="index" class="message">
        {{ msg }}
      </div>
    </div>
    <input v-model="newMessage" @keyup.enter="sendMessage" placeholder="メッセージを入力..." />
    <button @click="sendMessage">送信</button>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const messages = ref([]);
const newMessage = ref('');

const sendMessage = () => {
  if (newMessage.value.trim() !== '') {
    messages.value.push(newMessage.value);
    newMessage.value = '';
  }
};
</script>

<style scoped>
.chat-container {
  max-width: 500px;
  margin: auto;
  padding: 20px;
  border: 1px solid #ddd;
  border-radius: 8px;
}
.messages {
  height: 300px;
  overflow-y: auto;
  border-bottom: 1px solid #ddd;
  margin-bottom: 10px;
}
.message {
  padding: 5px;
  border-bottom: 1px solid #eee;
}
input {
  width: 80%;
  padding: 8px;
}
button {
  width: 18%;
  padding: 8px;
}
</style>