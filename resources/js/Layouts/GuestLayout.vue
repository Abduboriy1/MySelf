<script setup>
import NavBar from '@/Components/NavBar.vue';
import Footer from '@/Components/Footer.vue';
</script>


<template>
    <div class="relative min-h-screen flex flex-col overflow-hidden">
        <!-- Dark gradient background -->
        <div class="absolute inset-0 bg-main overflow-hidden">
            <!-- Dot-grid overlay -->
            <div class="absolute inset-0 dot-grid"></div>

            <!-- Orb 1: Cyan -->
            <div class="orb orb-cyan"></div>

            <!-- Orb 2: Violet -->
            <div class="orb orb-violet"></div>
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
    background: linear-gradient(to bottom, #0f172a, #1e293b, #0f172a);
}

.dot-grid {
    background-image: radial-gradient(circle, rgba(148, 163, 184, 0.05) 1px, transparent 1px);
    background-size: 32px 32px;
}

.orb {
    position: absolute;
    border-radius: 9999px;
    filter: blur(120px);
    animation: float 20s ease-in-out infinite;
    pointer-events: none;
}

.orb-cyan {
    top: -20%;
    left: -10%;
    width: 600px;
    height: 600px;
    background: rgba(6, 182, 212, 0.10);
}

.orb-violet {
    bottom: -20%;
    right: -10%;
    width: 500px;
    height: 500px;
    background: rgba(124, 58, 237, 0.10);
    filter: blur(100px);
    animation-delay: -10s;
}
</style>
