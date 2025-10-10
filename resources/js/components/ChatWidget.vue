<template>
  <div>
    <!-- Floating Chat Button -->
    <button class="chat-button" @click="toggleChat">
      💬
    </button>

    <!-- Chat Window -->
    <div v-if="isOpen" class="chat-window">
      <div class="chat-header">
        <span>WPC Chatbot</span>
        <button class="close-btn" @click="toggleChat">×</button>
      </div>

      <div class="chat-body" ref="chatBody">
        <div v-for="(msg, i) in messages" :key="i" :class="['msg', msg.sender]">
          {{ msg.text }}
        </div>
      </div>

      <div class="chat-input">
        <input
          v-model="input"
          placeholder="Ketik pesan..."
          @keyup.enter="sendMessage"
        />
        <button @click="sendMessage">➤</button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, nextTick } from 'vue'

const isOpen = ref(false)
const input = ref('')
const messages = ref([
  { sender: 'bot', text: 'Halo! Ada yang bisa saya bantu hari ini?' },
])
const chatBody = ref(null)

const toggleChat = () => {
  isOpen.value = !isOpen.value
  nextTick(() => {
    scrollToBottom()
  })
}

async function sendMessage() {
  if (!input.value.trim()) return

  const userMsg = input.value
  messages.value.push({ sender: 'user', text: userMsg })
  input.value = ''

  scrollToBottom()

  try {
    const res = await fetch(
      'https://workflow-clavis-flow.vwfini.easypanel.host/webhook/9ba92abb-8cd8-42b6-a18d-1ed83952cc54/chat',
      {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ message: userMsg }),
      }
    )
    const data = await res.json()
    messages.value.push({
      sender: 'bot',
      text: data.text || 'Maaf, saya tidak mengerti 😅',
    })
  } catch (err) {
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
  background: #ffffff;
  border-radius: 16px;
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
  display: flex;
  flex-direction: column;
  overflow: hidden;
  font-family: 'Poppins', sans-serif;
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

/* Message bubbles */
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

/* ===== Input ===== */
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
</style>
