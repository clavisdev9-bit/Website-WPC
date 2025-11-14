<template>
  <!-- <div>
    <p>Webhook URL saat ini:</p>
    <code>{{ webhookUrl }}</code>
  </div> -->
   <div v-if="debug">
    <p>Webhook URL saat ini:</p>
    <code>{{ webhookUrl }}</code>
  </div>
</template>

<script setup>
import { ref, nextTick, onMounted } from 'vue'
import { createChat } from '@public/js/chat.js';
import '@public/assets/frontend/css/chat.css';
// 1️⃣ Buat variabel reaktif
const webhookUrl = ref('https://workflow-dev-clavis-flow.tmlkkz.easypanel.host/webhook/a1ba1836-2b7b-4485-b3fb-f0ad4da3eb25/chat')

// 2️⃣ Gunakan di lifecycle hook
onMounted(() => {
  createChat({ webhookUrl: webhookUrl.value })
})
const isOpen = ref(false)
const input = ref('')
const messages = ref([
  { sender: 'bot', text: 'Halo! Ada yang bisa saya bantu hari ini?' },
])
const chatBody = ref(null)

const toggleChat = () => {
  isOpen.value = !isOpen.value
  nextTick(scrollToBottom)
}

async function sendMessage() {
  if (!input.value.trim()) return

  const userMsg = input.value.trim()
  messages.value.push({ sender: 'user', text: userMsg })
  input.value = ''

  scrollToBottom()

  try {
    const response = await fetch(
  "https://workflow-dev-clavis-flow.tmlkkz.easypanel.host/webhook/a1ba1836-2b7b-4485-b3fb-f0ad4da3eb25/chat",
  {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      chatInput: userMsg,   // bukan "message"
      sessionId: "vue-chat-session", // optional, bisa random
    }),
  }
);


    const data = await response.json()

    messages.value.push({
      sender: 'bot',
      text:
        data.text ||
        data.reply ||
        data.answer ||
        'Maaf, saya tidak mengerti 😅',
    })
  } catch (err) {
    console.error(err)
    messages.value.push({
      sender: 'bot',
      text: '⚠️ Terjadi kesalahan koneksi.',
    })
  }

  scrollToBottom()
}

function scrollToBottom() {
  nextTick(() => {
    const el = chatBody.value
    if (el) el.scrollTop = el.scrollHeight
  })
}
</script>

<!-- 
<style scoped>
/* ===== Floating Button ===== */
.chat-button {
  position: fixed;
  bottom: 24px;
  right: 24px;
  background: linear-gradient(135deg, #007bff, #00aaff);
  color: white;
  border: none;
  border-radius: 50%;
  width: 65px;
  height: 65px;
  font-size: 28px;
  cursor: pointer;
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25);
  transition: all 0.3s;
  z-index: 9999;
}

.chat-button:hover {
  transform: scale(1.1);
}

/* ===== Chat Window ===== */
.chat-window {
  position: fixed;
  bottom: 100px;
  right: 24px;
  width: 360px;
  max-height: 70vh;
  background: #ffffff;
  border-radius: 16px;
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
  display: flex;
  flex-direction: column;
  overflow: hidden;
  font-family: 'Poppins', sans-serif;
  z-index: 9999;
}

/* ===== Header ===== */
.chat-header {
  background: linear-gradient(135deg, #007bff, #00aaff);
  color: white;
  padding: 14px;
  font-weight: 600;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.close-btn {
  background: none;
  border: none;
  color: white;
  font-size: 20px;
  cursor: pointer;
}

/* ===== Body ===== */
.chat-body {
  flex: 1;
  padding: 12px;
  overflow-y: auto;
  background: #f8f9fa;
  display: flex;
  flex-direction: column;
}

/* ===== Message bubbles ===== */
.msg {
  max-width: 80%;
  margin: 6px 0;
  padding: 10px 14px;
  border-radius: 16px;
  line-height: 1.4;
  font-size: 0.95rem;
  word-wrap: break-word;
}

.user {
  align-self: flex-end;
  background: #007bff;
  color: white;
  border-radius: 16px 16px 0 16px;
}

.bot {
  align-self: flex-start;
  background: #e9ecef;
  color: #212529;
  border-radius: 16px 16px 16px 0;
}

/* ===== Input Area ===== */
.chat-input {
  display: flex;
  padding: 10px;
  border-top: 1px solid #dee2e6;
  background: white;
}

.chat-input input {
  flex: 1;
  border: 1px solid #ccc;
  border-radius: 12px;
  padding: 8px 10px;
  outline: none;
  font-size: 0.95rem;
}

.chat-input button {
  background: #007bff;
  border: none;
  color: white;
  border-radius: 50%;
  width: 38px;
  height: 38px;
  margin-left: 8px;
  cursor: pointer;
  font-size: 16px;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
  .chat-window {
    width: 90%;
    right: 5%;
    bottom: 90px;
    max-height: 75vh;
  }

  .chat-button {
    width: 60px;
    height: 60px;
    font-size: 26px;
    bottom: 20px;
    right: 20px;
  }
}

/* ===== MOBILE (≤480px) ===== */
@media (max-width: 480px) {
  .chat-window {
    width: 95%;
    right: 2.5%;
    bottom: 80px;
    height: 60vh;
    border-radius: 16px 16px 0 0;
    max-height: none;
  }

  .chat-header {
    padding: 12px;
    font-size: 0.95rem;
  }

  .chat-input {
    padding: 8px;
  }

  .chat-input input {
    font-size: 0.9rem;
  }

  .chat-input button {
    width: 36px;
    height: 36px;
    font-size: 14px;
  }

  .msg {
    font-size: 0.9rem;
  }
}
</style> -->
