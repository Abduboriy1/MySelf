<template>
    <div
        class="w-full h-full max-h-[80vh] mx-auto flex flex-col bg-gradient-to-b from-zinc-900/70 to-zinc-900/40 backdrop-blur-md border border-zinc-800 rounded-2xl shadow-2xl">
        <!-- Header -->
        <div class="px-4 py-3 border-b border-zinc-800 flex items-center gap-3">
            <div class="h-8 w-8 rounded-full bg-zinc-800 grid place-items-center">
                <Bot class="h-4 w-4 text-zinc-300" />
            </div>
            <div class="flex-1">
                <div class="text-sm font-medium text-zinc-100">Assistant</div>
                <div class="text-xs text-zinc-400">Ask anything. Shift+Enter = newline</div>
            </div>
            <button v-if="isStreaming" @click="stopStreaming"
                class="text-xs px-2 py-1 rounded-md border border-zinc-700 hover:bg-zinc-800 text-zinc-300">Stop</button>
        </div>

        <!-- Messages -->
        <div ref="chatContainer" class="flex-1 overflow-y-auto px-3 sm:px-4 py-4 space-y-4 custom-scrollbar"
            @scroll="onScroll">
            <template v-for="m in messages" :key="m.id">
                <div :class="['flex gap-3 items-start', m.role === 'user' ? 'flex-row-reverse' : '']">
                    <!-- Avatar -->
                    <div class="shrink-0 h-8 w-8 rounded-full bg-zinc-800 grid place-items-center ring-1 ring-zinc-700">
                        <User v-if="m.role === 'user'" class="h-4 w-4 text-zinc-300" />
                        <Bot v-else class="h-4 w-4 text-zinc-300" />
                    </div>

                    <!-- Bubble -->
                    <div class="max-w-[85%] sm:max-w-[70%] group">
                        <div :class="[
                            'rounded-2xl px-4 py-2 text-sm leading-relaxed shadow-sm ring-1',
                            m.role === 'user' ? 'bg-blue-600 text-white ring-blue-500/40' : 'bg-zinc-900/60 text-zinc-100 ring-zinc-700/60'
                        ]">
                            <div v-html="rendered(m.content)"></div>
                            <div class="mt-1 text-[10px] opacity-60 select-none">
                                {{ formatTime(m.createdAt) }}
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="opacity-0 group-hover:opacity-100 transition-opacity mt-1 flex gap-2">
                            <button @click="copyText(m.content)"
                                class="text-[11px] px-2 py-1 rounded-md border border-zinc-700 hover:bg-zinc-800 text-zinc-300">Copy</button>
                            <button v-if="m.role === 'assistant'" @click="regenerate(m)"
                                class="text-[11px] px-2 py-1 rounded-md border border-zinc-700 hover:bg-zinc-800 text-zinc-300">Regenerate</button>
                        </div>
                    </div>
                </div>
            </template>

            <!-- Typing indicator -->
            <div v-if="isStreaming" class="flex items-center gap-2 text-zinc-400 text-sm">
                <div class="h-2 w-2 rounded-full bg-zinc-500 animate-bounce [animation-delay:-0.2s]"></div>
                <div class="h-2 w-2 rounded-full bg-zinc-500 animate-bounce"></div>
                <div class="h-2 w-2 rounded-full bg-zinc-500 animate-bounce [animation-delay:0.2s]"></div>
                <span class="ml-2">Assistant is typing…</span>
            </div>
        </div>

        <!-- Scroll to bottom affordance -->
        <button v-if="!atBottom && messages.length" @click="scrollToBottom(true)"
            class="absolute self-center -mt-7 z-10 text-xs px-2 py-1 rounded-full border border-zinc-700 bg-zinc-900/80 text-zinc-300 hover:bg-zinc-800">New
            messages ↓</button>

        <!-- Composer -->
        <div class="p-3 border-t border-zinc-800">
            <div class="relative flex items-end gap-2">
                <textarea ref="textareaRef" v-model="inputText" :rows="1" @input="autoResize"
                    @keydown.enter.exact.prevent="sendMessage" @keydown.enter.shift.exact.stop
                    class="flex-1 resize-none bg-zinc-900/60 text-zinc-100 placeholder-zinc-500 rounded-xl border border-zinc-700 focus:border-blue-500/60 focus:outline-none px-3 py-2 max-h-40"
                    placeholder="Type a message…"></textarea>
                <button :disabled="!canSend || isStreaming" @click="sendMessage"
                    class="h-10 w-10 grid place-items-center rounded-xl bg-blue-600 disabled:opacity-40 disabled:cursor-not-allowed hover:bg-blue-500 transition-colors">
                    <Send class="h-4 w-4 text-white" />
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, nextTick } from 'vue'
import { Send, Bot, User } from 'lucide-vue-next'

// State
const messages = ref([])
const inputText = ref('')
const isStreaming = ref(false)
const abortCtrl = ref(null)
const chatContainer = ref(null)
const textareaRef = ref(null)
const atBottom = ref(true)
let idCounter = 1

const canSend = computed(() => inputText.value.trim().length > 0)

// Init greeting like ChatGPT
onMounted(() => {
    pushMessage({ role: 'assistant', content: 'Hello! How can I help you today?' })
    nextTick(scrollToBottom)
})

function pushMessage({ role, content }) {
    messages.value.push({ id: idCounter++, role, content, createdAt: new Date() })
}

function formatTime(d) {
    try { return new Intl.DateTimeFormat([], { hour: 'numeric', minute: '2-digit' }).format(new Date(d)) } catch { return '' }
}

// Minimal markdown (bold, code, links, line breaks)
function rendered(text = '') {
    return text
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
        .replace(/`([^`]+)`/g, '<code class="px-1 py-0.5 rounded bg-zinc-800 border border-zinc-700 text-[90%]">$1</code>')
        .replace(/\n/g, '<br/>')
        .replace(/(https?:\/\/[^\s]+)/g, '<a class="underline hover:no-underline" target="_blank" href="$1">$1<\/a>')
}

async function sendMessage() {
    if (!canSend.value || isStreaming.value) return
    const text = inputText.value
    inputText.value = ''
    autoResize()

    pushMessage({ role: 'user', content: text })
    const assistantMsg = { id: idCounter++, role: 'assistant', content: '', createdAt: new Date() }
    messages.value.push(assistantMsg)
    await nextTick(scrollToBottom)

    // Call backend
    abortCtrl.value = new AbortController()
    isStreaming.value = true
    try {
        const res = await fetch('api/query-rag', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ query: text }),
            signal: abortCtrl.value.signal,
        })
        const data = await res.json().catch(() => ({ response: 'Sorry, something went wrong.' }))
        const reply = res.ok && data?.response ? String(data.response) : 'Sorry, I couldn\'t process your request.'
        await streamInto(assistantMsg, reply)
    } catch (e) {
        if (e.name !== 'AbortError') {
            await streamInto(assistantMsg, 'Error connecting to AI service.')
        }
    } finally {
        isStreaming.value = false
        abortCtrl.value = null
        nextTick(scrollToBottom)
    }
}

function stopStreaming() {
    if (abortCtrl.value) abortCtrl.value.abort()
}

// Typewriter stream like ChatGPT
async function streamInto(msg, text, delay = 12) {
    msg.content = ''
    for (let i = 0; i < text.length; i++) {
        msg.content += text[i]
        if (i % 3 === 0) await new Promise(r => setTimeout(r, delay))
        if (!isStreaming.value) break
        if (!atBottom.value) scrollToBottom()
    }
    msg.content = text
}

function onScroll() {
    const el = chatContainer.value
    if (!el) return
    const threshold = 24
    atBottom.value = el.scrollTop + el.clientHeight >= el.scrollHeight - threshold
}

function scrollToBottom(smooth = false) {
    const el = chatContainer.value
    if (!el) return
    el.scrollTo({ top: el.scrollHeight, behavior: smooth ? 'smooth' : 'auto' })
    atBottom.value = true
}

async function copyText(text) {
    try {
        await navigator.clipboard.writeText(text)
    } catch { }
}

async function regenerate(m) {
    // Simple regenerate: resend the last user message
    const lastUser = [...messages.value].reverse().find(x => x.role === 'user')
    if (!lastUser) return
    inputText.value = lastUser.content
    await nextTick(() => sendMessage())
}

function autoResize() {
    const el = textareaRef.value
    if (!el) return
    el.style.height = 'auto'
    el.style.height = Math.min(el.scrollHeight, 160) + 'px'
}
</script>

<style scoped>
.custom-scrollbar::-webkit-scrollbar {
    width: 8px;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.12);
    border-radius: 8px;
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: rgba(255, 255, 255, 0.25);
}
</style>
