<template>
  <footer class="mt-[300px] rounded-2xl border border-white/10 bg-slate-900/80 backdrop-blur-lg text-slate-200">
    <div class="max-w-7xl mx-auto py-20 px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
        <!-- About -->
        <div class="space-y-6">
          <h2
            class="text-3xl font-bold bg-gradient-to-r from-indigo-400 via-fuchsia-400 to-emerald-400 bg-clip-text text-transparent">
            ~Bory~
          </h2>
          <p class="text-slate-400 leading-relaxed">
            Software Engineer specializing in full-stack development with expertise in PHP, Laravel, React, and cloud
            technologies. Passionate about building scalable solutions and optimizing workflows.
          </p>
          <div class="flex space-x-4">
            <a href="https://github.com/Abduboriy1" target="_blank" rel="noopener noreferrer"
              class="text-slate-400 hover:text-white transition-colors">
              <Github class="h-6 w-6" />
              <span class="sr-only">GitHub</span>
            </a>
            <a href="https://www.linkedin.com/in/abduboriy" target="_blank" rel="noopener noreferrer"
              class="text-slate-400 hover:text-white transition-colors">
              <Linkedin class="h-6 w-6" />
              <span class="sr-only">LinkedIn</span>
            </a>
            <a href="mailto:uzbekbory@gmail.com" class="text-slate-400 hover:text-white transition-colors">
              <Mail class="h-6 w-6" />
              <span class="sr-only">Email</span>
            </a>
          </div>
        </div>

        <div></div>

        <!-- Latest Projects -->
        <div>
          <h3 class="text-xl font-semibold mb-6">Latest Projects</h3>
          <div class="space-y-4">
            <a href="#" class="block text-slate-400 hover:text-white transition-colors">
              X - Logs
            </a>
            <a href="#" class="block text-slate-400 hover:text-white transition-colors">
              Chrome Extension
            </a>
            <a href="#" class="block text-slate-400 hover:text-white transition-colors flex items-center">
              My Self WebApp - AI
              <Sparkles class="ml-1 h-4 w-4 text-fuchsia-400" />
            </a>
          </div>
        </div>

        <!-- Contact -->
        <div>
          <h3 class="text-xl font-semibold mb-6">Get In Touch</h3>
          <p class="text-slate-400 mb-4">
            Interested in working together? Let's connect and create something amazing.
          </p>
          <a href="mailto:uzbekbory@gmail.com"
            class="inline-flex items-center text-white bg-gradient-to-r from-pink-500 via-blue-500 to-green-500 hover:opacity-90 px-4 py-2 rounded-xl transition">
            Contact Me
            <ArrowRight class="ml-2 h-4 w-4" />
          </a>
        </div>
      </div>

      <!-- Bottom -->
      <div class="mt-20 pt-8 border-t border-white/10 flex flex-col md:flex-row justify-between items-center">
        <p class="text-slate-500 text-sm">
          © {{ currentYear }} Abduboriy. All rights reserved.
        </p>
        <nav class="flex space-x-4 mt-4 md:mt-0">
          <router-link to="/privacy" class="text-sm text-slate-400 hover:text-white transition-colors">
            Privacy Policy
          </router-link>
          <router-link to="/terms" class="text-sm text-slate-400 hover:text-white transition-colors">
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
