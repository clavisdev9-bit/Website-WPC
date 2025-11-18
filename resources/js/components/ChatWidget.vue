<!-- <template>
   <div v-if="debug">
    <p>Webhook URL saat ini:</p>
    <code>{{ webhookUrl }}</code>
  </div>
</template>

<script setup>
import { ref, nextTick, onMounted } from 'vue'
import '../../css/chat.css';
import { createChat } from '../../js/chat.js'
// 1️⃣ Buat variabel reaktif
const webhookUrl = ref('https://workflow-dev-clavis-flow.tmlkkz.easypanel.host/webhook/a1ba1836-2b7b-4485-b3fb-f0ad4da3eb25/chat')

// 2️⃣ Gunakan di lifecycle hook
onMounted(() => {
  createChat({ webhookUrl: webhookUrl.value });
  const interval = setInterval(() => {
    const title = document.querySelector('.chat-header h1');
    if (title && !title.classList.contains('fa-added')) {
      title.innerHTML += ' <i class="fa-sharp-duotone fa-solid fa-comments"></i>';
      title.classList.add('fa-added');
      clearInterval(interval);
    }
  }, 200);
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
</script> -->



<template>
  <div v-if="debug">
    <p>Webhook URL saat ini:</p>
    <code>{{ webhookUrl }}</code>
  </div>
</template>

<script setup>
import { ref, nextTick, onMounted } from 'vue'
import '../../css/chat.css'
import { createChat } from '../../js/chat.js'

// Debug mode (aktifkan jika perlu)
const debug = ref(false)

// Webhook URL
const webhookUrl = ref(
  'https://workflow-dev-clavis-flow.tmlkkz.easypanel.host/webhook/a1ba1836-2b7b-4485-b3fb-f0ad4da3eb25/chat'
)

// Lifecycle: inisialisasi chat widget
onMounted(() => {
  createChat({ webhookUrl: webhookUrl.value })

  const interval = setInterval(() => {
    const title = document.querySelector('.chat-header h1')

    if (title && !title.classList.contains('fa-added')) {
      title.innerHTML += ' <i class="fa-sharp-duotone fa-solid fa-comments"></i>'
      title.classList.add('fa-added')
      clearInterval(interval)
    }
  }, 200)
})

// State chat widget
const isOpen = ref(false)
const input = ref('')
const messages = ref([
  { sender: 'bot', text: 'Halo! Ada yang bisa saya bantu hari ini?' }
])
const chatBody = ref(null)

// Toggle open/close chat
const toggleChat = () => {
  isOpen.value = !isOpen.value
  nextTick(scrollToBottom)
}

// Mengirim pesan
async function sendMessage() {
  if (!input.value.trim()) return

  const userMsg = input.value.trim()
  messages.value.push({ sender: 'user', text: userMsg })
  input.value = ''

  scrollToBottom()

  try {
    const response = await fetch(webhookUrl.value, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        chatInput: userMsg,
        sessionId: 'vue-chat-session'
      })
    })

    const data = await response.json()

    messages.value.push({
      sender: 'bot',
      text:
        data.text ||
        data.reply ||
        data.answer ||
        'Maaf, saya tidak mengerti 😅'
    })
  } catch (err) {
    console.error(err)
    messages.value.push({
      sender: 'bot',
      text: '⚠️ Terjadi kesalahan koneksi.'
    })
  }

  scrollToBottom()
}

// Scroll otomatis
function scrollToBottom() {
  nextTick(() => {
    const el = chatBody.value
    if (el) el.scrollTop = el.scrollHeight
  })
}
</script>
