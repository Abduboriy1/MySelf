<script setup>
import NavBar from '@/Components/NavBar.vue';
import Footer from '@/Components/Footer.vue';
</script>


<template>
    <div class="relative min-h-screen flex flex-col overflow-hidden">
        <!-- Animated Background -->
        <div class="absolute inset-0 bg-sky-blue overflow-hidden">
            <div class="cloud-container absolute inset-0">
                <div class="cloud" style="top: 20%; left: 70%; animation-delay: 0s; animation-duration: 5s;"></div>
                <div class="cloud" style="top: 40%; left: 20%; animation-delay: 1s; animation-duration: 6s;"></div>
            </div>
        </div>
    
        <!-- Content Overlay -->
        <div class="lex-grow container mx-auto px-4 py-6 relative z-10 flex flex-col min-h-screen">
            <!-- Navbar -->
            <NavBar />

            <!-- Main Content -->
            <main class="flex-grow container mx-auto px-4 py-6">
                <slot />
            </main>

            <!-- Footer -->
           <Footer></Footer>
        </div>
    </div>
  </template>
  
  
<style scoped>


    @keyframes moveClouds {
        0% {
            transform: translateX(0);
        }
        50% {
            transform: translateX(100px);
        }
        100% {
            transform: translateX(0);
        }
    }
  
    .bg-sky-blue {
        background: linear-gradient(to bottom, #87ceeb, #f0f8ff, transparent);
    }

    .cloud-container {
        position: absolute;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }

    .cloud {
        position: absolute;
        background: white;
        width: 150px;
        height: 100px;
        border-radius: 50%;
        box-shadow: 
            -40px -20px 0 -10px white,
            40px -20px 0 -10px white,
            0 20px 0 -10px white;
        filter: blur(10px);
        opacity: 0.8;
        animation: moveClouds 5s ease-in-out infinite;
    }

    .footer {
        border-radius: 14px;
        height: 250px;
        background: linear-gradient(to bottom, #87cfebcb, #f0f8ff);
        color: black;
    }
  </style>
  

  