<script setup>
import AiChat from '@/Components/AiChat.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';

</script>

<template>
    <GuestLayout>

        <div style="height: 80vh;" class="w-full max-w-5xl mx-auto rounded-lg">
            <AiChat></AiChat>
        </div>
        
    </GuestLayout>
</template>

<style>

body {
  background-image: radial-gradient(rgba(0, 0, 0, 0.685) 1px, transparent 0);
  background-size: 40px 40px;
}

/* Custom Scrollbar */
body::-webkit-scrollbar {
    width: 10px;
}

body::-webkit-scrollbar-track {
    background: transparent;
}

body::-webkit-scrollbar-thumb {
    background: rgba(17, 24, 39, .8);
}

body::-webkit-scrollbar-thumb:hover {
    background: rgba(17, 24, 39, .8);
}

</style>
