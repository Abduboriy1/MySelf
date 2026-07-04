<script setup>
import NavBar from '@/Components/NavBar.vue';
import Footer from '@/Components/Footer.vue';
</script>


<template>
    <div class="relative min-h-screen flex flex-col overflow-hidden">
        <!-- Warm cream gradient background -->
        <div class="absolute inset-0 bg-main overflow-hidden">
            <!-- Square-grid overlay -->
            <div class="absolute inset-0 square-grid"></div>

            <!-- Orb 1: Amber -->
            <div class="orb orb-amber"></div>

            <!-- Orb 2: Rose -->
            <div class="orb orb-rose"></div>
        </div>

        <!-- Content Overlay -->
        <div class="lex-grow container mx-auto px-4 py-6 relative z-10 flex flex-col min-h-screen">
            <!-- Navbar -->
            <NavBar />

            <!-- Main Content -->
            <main class="flex-grow container mx-auto py-6">
                <slot />
            </main>

            <!-- Footer -->
            <Footer></Footer>
        </div>
    </div>
</template>


<style scoped>
@keyframes float {
    0%, 100% {
        transform: translateY(0) scale(1);
    }
    50% {
        transform: translateY(-30px) scale(1.05);
    }
}

.bg-main {
    background: linear-gradient(to bottom, var(--bg-start), var(--bg-mid), var(--bg-end));
}

.square-grid {
    background-image:
        linear-gradient(to right, rgba(120, 113, 108, 0.12) 1px, transparent 1px),
        linear-gradient(to bottom, rgba(120, 113, 108, 0.12) 1px, transparent 1px);
    background-size: 56px 56px;
}

.orb {
    position: absolute;
    border-radius: 9999px;
    filter: blur(120px);
    animation: float 20s ease-in-out infinite;
    pointer-events: none;
}

.orb-amber {
    top: -20%;
    left: -10%;
    width: 600px;
    height: 600px;
    background: var(--orb-amber);
}

.orb-rose {
    bottom: -20%;
    right: -10%;
    width: 500px;
    height: 500px;
    background: var(--orb-rose);
    filter: blur(100px);
    animation-delay: -10s;
}
</style>
