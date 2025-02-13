<template>
    <footer style="background-color: rgba(17, 24, 39, .8); border-radius: 10px;" class="text-white mt-[300px]">
      <div class="max-w-7xl mx-auto py-20 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
          <div class="space-y-6">
            <h2 class="text-3xl font-bold">~Abduboriy~</h2>
            <p class="text-gray-400 leading-relaxed">
              Software Engineer specializing in full-stack development with expertise in PHP, Laravel, React, and cloud technologies. Passionate about building scalable solutions and optimizing workflows.
            </p>
            <div class="flex space-x-4">
              <a href="https://github.com/Abduboriy1" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-white transition-colors">
                <Github class="h-6 w-6" />
                <span class="sr-only">GitHub</span>
              </a>
              <a href="https://www.linkedin.com/in/abduboriy" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-white transition-colors">
                <Linkedin class="h-6 w-6" />
                <span class="sr-only">LinkedIn</span>
              </a>
              <a href="mailto:uzbekbory@gmail.com" class="text-gray-400 hover:text-white transition-colors">
                <Mail class="h-6 w-6" />
                <span class="sr-only">Email</span>
              </a>
            </div>
          </div>
          
          <div>
            <!-- <h3 class="text-xl font-semibold mb-6">Quick Links</h3>
            <nav class="space-y-4">
              <router-link to="/" class="block text-gray-400 hover:text-white transition-colors">
                Home
              </router-link>
              <router-link to="/projects" class="block text-gray-400 hover:text-white transition-colors">
                Projects
              </router-link>
              <router-link to="/about" class="block text-gray-400 hover:text-white transition-colors">
                About
              </router-link>
              <router-link to="/contact" class="block text-gray-400 hover:text-white transition-colors">
                Contact
              </router-link>
            </nav> -->
          </div>
          
          <div>
            <h3 class="text-xl font-semibold mb-6">Latest Projects</h3>
            <div class="space-y-4">
              <a href="#" class="block text-gray-400 hover:text-white transition-colors">
                X - Logs
              </a>
              <a href="#" class="block text-gray-400 hover:text-white transition-colors">
                Chrom Extention
              </a>
              <a href="#" class="block text-gray-400 hover:text-white transition-colors flex">
                My Self WebApp - AI <Sparkles class="pl-1"/>
              </a>
            </div>
          </div>
          
          <div>
            <h3 class="text-xl font-semibold mb-6">Get In Touch</h3>
            <p class="text-gray-400 mb-4">
              Interested in working together? Let's connect and create something amazing.
            </p>
            <router-link 
              to="mailto:uzbekbory@gmail.com" 
              class="inline-flex items-center text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded transition-colors"
            >
              Contact Me
              <ArrowRight class="ml-2 h-4 w-4" />
            </router-link>
          </div>
        </div>
        
        <div class="mt-20 pt-8 border-t border-gray-800 flex flex-col md:flex-row justify-between items-center">
          <p class="text-gray-400 text-sm">
            © {{ currentYear }} Abduboriy. All rights reserved.
          </p>
          <nav class="flex space-x-4 mt-4 md:mt-0">
            <router-link to="/privacy" class="text-sm text-gray-400 hover:text-white transition-colors">
              Privacy Policy
            </router-link>
            <router-link to="/terms" class="text-sm text-gray-400 hover:text-white transition-colors">
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