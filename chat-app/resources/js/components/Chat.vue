<template>
    <div class="chat-container">
      <div class="messages">
        <div v-for="(msg, index) in messages" :key="index" class="message">
          <strong>{{ msg.user }}</strong>: {{ msg.message }}
        </div>
      </div>
      <input v-model="newMessage" @keyup.enter="sendMessage" placeholder="メッセージを入力..." />
      <button @click="sendMessage">送信</button>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import axios from 'axios';
  
  const messages = ref([]);
  const newMessage = ref('');
  const user = ref('ゲスト'); // 仮のユーザー名
  
  // メッセージを取得
  const fetchMessages = async () => {
    try {
      const response = await axios.get('/api/messages');
      messages.value = response.data;
    } catch (error) {
      console.error('メッセージ取得エラー:', error);
    }
  };
  
  // メッセージを送信
  const sendMessage = async () => {
    if (newMessage.value.trim() === '') return;
  
    try {
      const response = await axios.post('/api/messages', {
        user: user.value,
        message: newMessage.value,
      });
  
      messages.value.push(response.data);
      newMessage.value = '';
    } catch (error) {
      console.error('メッセージ送信エラー:', error);
    }
  };
  
  // 初回ロード時にメッセージ取得
  onMounted(fetchMessages);
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