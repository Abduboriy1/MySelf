<template>
  <footer class="mt-[300px] rounded-2xl border border-stone-200 bg-white/80 backdrop-blur-lg text-stone-800">
    <div class="max-w-7xl mx-auto py-20 px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
        <!-- About -->
        <div class="space-y-6  p-6">
          <h2
            class="text-3xl font-bold bg-gradient-to-r from-amber-600 via-orange-500 to-amber-500 bg-clip-text text-transparent">
            ~Bory~
          </h2>
          <p class="text-stone-500 leading-relaxed">
            Software Engineer specializing in full-stack development with expertise in PHP, Laravel, React, and cloud
            technologies. Passionate about building scalable solutions and optimizing workflows.
          </p>
          <div class="flex space-x-4">
            <a href="https://github.com/Abduboriy1" target="_blank" rel="noopener noreferrer"
              class="text-stone-500 hover:text-stone-900 transition-colors">
              <Github class="h-6 w-6" />
              <span class="sr-only">GitHub</span>
            </a>
            <a href="https://www.linkedin.com/in/abduboriy" target="_blank" rel="noopener noreferrer"
              class="text-stone-500 hover:text-stone-900 transition-colors">
              <Linkedin class="h-6 w-6" />
              <span class="sr-only">LinkedIn</span>
            </a>
            <a href="mailto:uzbekbory@gmail.com" class="text-stone-500 hover:text-stone-900 transition-colors">
              <Mail class="h-6 w-6" />
              <span class="sr-only">Email</span>
            </a>
          </div>
        </div>

        <div></div>

        <!-- Latest Projects -->
        <div class=" p-6">
          <h3 class="text-xl font-semibold mb-6">Latest Projects</h3>
          <div class="space-y-4">
            <a href="#" class="block text-stone-500 hover:text-stone-900 transition-colors">
              X - Logs
            </a>
            <a href="#" class="block text-stone-500 hover:text-stone-900 transition-colors">
              Chrome Extension
            </a>
            <a href="#" class="block text-stone-500 hover:text-stone-900 transition-colors flex items-center">
              My Self WebApp - AI
              <Sparkles class="ml-1 h-4 w-4 text-amber-500" />
            </a>
          </div>
        </div>

        <!-- Contact -->
        <div class=" p-6">
          <h3 class="text-xl font-semibold mb-6">Get In Touch</h3>
          <p class="text-stone-500 mb-4">
            Interested in working together? Let's connect and create something amazing.
          </p>
          <a href="mailto:uzbekbory@gmail.com"
            class="inline-flex items-center text-white bg-gradient-to-r from-amber-500 via-orange-500 to-amber-600 hover:opacity-90 px-4 py-2 rounded-xl transition">
            Contact Me
            <ArrowRight class="ml-2 h-4 w-4" />
          </a>
        </div>
      </div>

      <!-- Bottom -->
      <div class="mt-20 pt-8 border-t border-stone-200 flex flex-col md:flex-row justify-between items-center">
        <p class="text-stone-400 text-sm">
          © {{ currentYear }} Abduboriy. All rights reserved.
        </p>
        <nav class="flex space-x-4 mt-4 md:mt-0">
          <router-link to="/privacy" class="text-sm text-stone-500 hover:text-stone-900 transition-colors">
            Privacy Policy
          </router-link>
          <router-link to="/terms" class="text-sm text-stone-500 hover:text-stone-900 transition-colors">
            Terms of Service
          </router-link>
        </nav>
      </div>
    </div>
  </footer>
</template>

<script setup>
import { ref } from 'vue'
import { Github, Linkedin, Mail, ArrowRight, Sparkles } from 'lucide-vue-next'

const currentYear = ref(new Date().getFullYear())
</script>
