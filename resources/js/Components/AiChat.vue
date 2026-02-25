<template>
    <div
        class="w-full h-full mx-auto flex flex-col rounded-2xl bg-white shadow-2xl overflow-hidden">
        <!-- Header -->
        <div class="px-4 py-3 border-b border-stone-200 flex items-center gap-3 shrink-0">
            <div class="h-8 w-8 rounded-full bg-stone-100 grid place-items-center ring-1 ring-stone-200">
                <Bot class="h-4 w-4 text-stone-500" />
            </div>
            <div class="flex-1 min-w-0">
                <div class="text-sm font-medium text-stone-800 truncate">Assistant</div>
                <div class="text-xs text-stone-500">Ask anything • Shift+Enter = newline</div>
            </div>
            <button v-if="isStreaming" @click="stopStreaming"
                class="text-xs px-2 py-1 rounded-md border border-stone-200 hover:bg-stone-100 text-stone-600">
                Stop
            </button>
        </div>

        <!-- Messages -->
        <div ref="chatContainer" class="relative flex-1 overflow-y-auto px-3 sm:px-4 py-4 space-y-4 custom-scrollbar"
            @scroll="onScroll">
            <template v-for="m in messages" :key="m.id">
                <div :class="['flex gap-3 items-start', m.role === 'user' ? 'flex-row-reverse' : '']">
                    <!-- Avatar -->
                    <div class="shrink-0 h-8 w-8 rounded-full bg-stone-100 grid place-items-center ring-1 ring-stone-200">
                        <User v-if="m.role === 'user'" class="h-4 w-4 text-stone-500" />
                        <Bot v-else class="h-4 w-4 text-stone-500" />
                    </div>

                    <!-- Bubble -->
                    <div class="max-w-[85%] sm:max-w-[70%] group">
                        <div :class="[
                            'rounded-2xl px-4 py-2 text-sm leading-relaxed shadow-sm ring-1',
                            m.role === 'user'
                                ? 'bg-amber-600 text-white ring-amber-500/40'
                                : 'bg-stone-100 text-stone-800 ring-stone-200',
                        ]">
                            <!-- Rendered markdown -->
                            <div class="prose-chat" v-html="rendered(m.content)"></div>
                            <div class="mt-1 text-[10px] opacity-60 select-none">
                                {{ formatTime(m.createdAt) }}
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="opacity-0 group-hover:opacity-100 transition-opacity mt-1 flex gap-2">
                            <button @click="copyText(m.content)"
                                class="text-[11px] px-2 py-1 rounded-md border border-stone-200 hover:bg-stone-100 text-stone-600">
                                Copy
                            </button>
                            <button v-if="m.role === 'assistant'" @click="regenerate(m)"
                                class="text-[11px] px-2 py-1 rounded-md border border-stone-200 hover:bg-stone-100 text-stone-600">
                                Regenerate
                            </button>
                        </div>
                    </div>
                </div>
            </template>

            <!-- Typing indicator -->
            <div v-if="isStreaming" class="flex items-center gap-2 text-stone-500 text-sm">
                <div class="h-2 w-2 rounded-full bg-stone-400 animate-bounce [animation-delay:-0.2s]"></div>
                <div class="h-2 w-2 rounded-full bg-stone-400 animate-bounce"></div>
                <div class="h-2 w-2 rounded-full bg-stone-400 animate-bounce [animation-delay:0.2s]"></div>
                <span class="ml-2">Assistant is typing…</span>
            </div>

            <!-- New messages pill -->
            <button v-if="!atBottom && messages.length" @click="scrollToBottom(true)"
                class="sticky bottom-3 mx-auto block text-xs px-2 py-1 rounded-full border border-stone-200 bg-stone-50 text-stone-600 hover:bg-stone-100">
                New messages ↓
            </button>
        </div>

        <!-- Composer -->
        <div class="p-3 border-t border-stone-200 bg-gradient-to-t from-stone-50 to-white"
            :style="{ paddingBottom: `max(env(safe-area-inset-bottom), 12px)` }">
            <div class="relative flex items-end gap-2">
                <textarea ref="textareaRef" v-model="inputText" :rows="1" @input="autoResize"
                    @keydown.enter.exact.prevent="sendMessage" @keydown.enter.shift.exact.stop
                    @keydown.esc="blurComposer"
                    class="flex-1 resize-none bg-stone-50 text-stone-800 placeholder-stone-400 rounded-xl border border-stone-200 focus:border-amber-400/60 focus:outline-none px-3 py-2 max-h-40"
                    placeholder="Type a message…" />
                <button :disabled="!canSend || isStreaming" @click="sendMessage"
                    class="h-10 w-10 grid place-items-center rounded-xl bg-amber-600 disabled:opacity-40 disabled:cursor-not-allowed hover:bg-amber-500 transition-colors"
                    aria-label="Send">
                    <Send class="h-4 w-4 text-white" />
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, nextTick } from 'vue'
import { Send, Bot, User } from 'lucide-vue-next'

/* ---------------- state ---------------- */
const messages = ref([])
const inputText = ref('')
const isStreaming = ref(false)
const abortCtrl = ref(null)
const chatContainer = ref(null)
const textareaRef = ref(null)
const atBottom = ref(true)
let idCounter = 1

const canSend = computed(() => inputText.value.trim().length > 0)

/* ---------------- lifecycle ---------------- */
onMounted(() => {
    // Initial greeting
    if (!messages.value.length) {
        pushMessage({ role: 'assistant', content: 'Hello! How can I help you today?' })
    }
    nextTick(() => {
        autoResize()
        scrollToBottom()
    })
})

/* ---------------- helpers ---------------- */
function pushMessage({ role, content }) {
    messages.value.push({ id: idCounter++, role, content, createdAt: new Date() })
}

function formatTime(d) {
    try {
        return new Intl.DateTimeFormat([], { hour: 'numeric', minute: '2-digit' }).format(new Date(d))
    } catch { return '' }
}

function blurComposer() {
    textareaRef.value?.blur()
}

/* Minimal Markdown renderer with fenced code blocks & lists */
function rendered(text = '') {
    // escape
    let t = String(text).replace(/&/g, '&amp;').replace(/</g, '&lt;')

    // fenced code blocks ```lang\n...\n```
    t = t.replace(/```(\w+)?\n([\s\S]*?)```/g, (_, lang = '', code = '') => {
        const safe = code.replace(/</g, '&lt;')
        const l = lang ? `<span class="code-lang">${lang}</span>` : ''
        return `<pre class="code-block"><code>${safe}</code>${l}</pre>`
    })

    // inline code
    t = t.replace(/`([^`]+)`/g, '<code class="code-inline">$1</code>')

    // bold / italic
    t = t.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
    t = t.replace(/\*(.*?)\*/g, '<em>$1</em>')

    // links
    t = t.replace(/(https?:\/\/[^\s)]+)(?![^<]*>)/g, '<a class="chat-link" target="_blank" href="$1">$1</a>')

    // lists (very light)
    t = t
        .replace(/(^|\n)\s*-\s+(.*)/g, '$1<li>$2</li>')
        .replace(/(<li>[\s\S]*?<\/li>)(?![\s\S]*<\/ul>)/g, '<ul class="chat-list">$1</ul>')

    // line breaks
    t = t.replace(/\n/g, '<br/>')

    return t
}

/* ---------------- messaging ---------------- */
async function sendMessage() {
    if (!canSend.value || isStreaming.value) return
    const text = inputText.value
    inputText.value = ''
    autoResize()

    pushMessage({ role: 'user', content: text })
    const assistantMsg = { id: idCounter++, role: 'assistant', content: '', createdAt: new Date() }
    messages.value.push(assistantMsg)
    await nextTick(scrollToBottom)

    // Request
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
        const reply = res.ok && data?.response ? String(data.response) : "Sorry, I couldn't process your request."
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

/* fake typewriter stream for now; swap with real SSE later */
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

/* ---------------- scroll ---------------- */
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

/* ---------------- actions ---------------- */
async function copyText(text) {
    try { await navigator.clipboard.writeText(text) } catch { }
}

async function regenerate(m) {
    const lastUser = [...messages.value].reverse().find(x => x.role === 'user')
    if (!lastUser) return
    inputText.value = lastUser.content
    await nextTick(() => sendMessage())
}

/* ---------------- ui ---------------- */
function autoResize() {
    const el = textareaRef.value
    if (!el) return
    el.style.height = 'auto'
    el.style.height = Math.min(el.scrollHeight, 160) + 'px'
}
</script>

<style scoped>
/* --- Scrollbar --- */
.custom-scrollbar::-webkit-scrollbar {
    width: 8px;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
    background: rgba(0, 0, 0, 0.15);
    border-radius: 8px;
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: rgba(0, 0, 0, 0.25);
}

/* --- Chat prose (safe, minimal) --- */
.prose-chat :where(p, ul, ol) {
    margin: 0.25rem 0;
}

.prose-chat a.chat-link {
    text-decoration: underline;
    color: #d97706;
}

.prose-chat strong {
    font-weight: 700;
}

.prose-chat em {
    font-style: italic;
}

/* inline code */
.code-inline {
    background: #f5f5f4;
    border: 1px solid #d6d3d1;
    border-radius: 0.375rem;
    padding: 0.15rem 0.35rem;
    font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", monospace;
    font-size: 0.92em;
}

/* fenced code block */
.code-block {
    background: #fafaf9;
    border: 1px solid #e7e5e4;
    border-radius: 0.75rem;
    padding: 0.75rem 0.9rem;
    overflow-x: auto;
    white-space: pre;
    line-height: 1.4;
    margin: 0.25rem 0 0.25rem;
    font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", monospace;
    font-size: 0.86rem;
    position: relative;
}

.code-block .code-lang {
    position: absolute;
    top: 6px;
    right: 10px;
    font-size: 10px;
    opacity: 0.5;
}

/* mobile hover affordance replacement: show actions when tapping near bubble */
@media (hover: none) {

    .group:active+.actions,
    .group:active .actions {
        opacity: 1 !important;
    }
}
</style>
