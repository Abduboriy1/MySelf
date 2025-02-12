<script setup>
import { ref, computed, watch, nextTick } from 'vue';
import { Send, Bot, User } from 'lucide-vue-next';

const messages = ref([
    
]);
const inputText = ref("");
const typingIndex = ref(0);
const isTyping = ref(false);
const chatContainer = ref(null);

addMessage("Hello! How can I help you?", "bot");

const typingMessage = computed(() => {
    const lastMessage = messages.value[messages.value.length - 1];
    if (isTyping.value) {
        return lastMessage.text.slice(0, typingIndex.value);
    }
    return lastMessage.text;
});

async function addMessage(text, sender) {
    messages.value.push({ text, sender });
    isTyping.value = true;
    typingIndex.value = 0;

    for (let i = 0; i <= text.length; i++) {
        await new Promise(resolve => setTimeout(resolve, 30));
        typingIndex.value = i;
    }

    isTyping.value = false;
    scrollToBottom();
}

async function sendMessage() {
    if (!inputText.value.trim()) return;

    const userMessage = inputText.value;
    inputText.value = "";

    addMessage(userMessage, "user");

    // Simulate bot response
    addMessage("That's interesting! Tell me more.", "bot");
}

function scrollToBottom() {
    nextTick(() => {
        if (chatContainer.value) {
            chatContainer.value.scrollTo({ top: chatContainer.value.scrollHeight, behavior: "smooth" });
        }
    });
}
</script>

<template>
    <div style="border-radius: 10px; height: inherit; background-color: rgba(17, 24, 39, .5);" class="w-full mx-auto text-white shadow-lg p-4 flex flex-col">
        <!-- Chat Messages -->
        <div ref="chatContainer" class="flex-1 overflow-y-auto space-y-2 p-2 custom-scrollbar">
            <div v-for="(message, index) in messages" :key="index" class="flex items-start space-x-2"
                :class="message.sender === 'user' ? 'justify-end' : 'justify-start'">
                <Bot v-if="message.sender === 'bot'" class="w-5 h-5 text-blue-400" />
                <div class="px-4 py-2 rounded-lg"
                    :class="message.sender === 'user' ? 'bg-blue-500 text-white' : 'bg-gray-700 text-gray-200'">
                    {{ index === messages.length - 1 && isTyping ? typingMessage : message.text }}
                </div>
                <User v-if="message.sender === 'user'" class="w-5 h-5 text-green-400" />
            </div>
        </div>

        <!-- Input Field -->
        <div class="flex items-center border-t border-gray-600 p-2">
            <input v-model="inputText" @keyup.enter="sendMessage"
                class="flex-1 bg-gray-700 text-white px-3 py-2 rounded-lg focus:outline-none"
                placeholder="Type a message..." />
            <button @click="sendMessage" class="ml-2 bg-blue-500 p-2 rounded-lg hover:bg-blue-600">
                <Send class="w-5 h-5 text-white" />
            </button>
        </div>
    </div>
</template>

<style>
/* Custom Scrollbar */
.custom-scrollbar::-webkit-scrollbar {
    width: 6px;
}

.custom-scrollbar::-webkit-scrollbar-track {
    background: transparent;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.2);
    border-radius: 10px;
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: rgba(255, 255, 255, 0.4);
}
</style>
