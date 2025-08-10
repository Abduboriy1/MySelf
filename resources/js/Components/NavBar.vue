<script setup lang="ts">
import { ref } from "vue";
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
import { Menu, X, Mail, Check } from "lucide-vue-next";

interface NavLink {
    name: string;
    href: string;
}

const navLinks = ref<NavLink[]>([
    { name: "About", href: "#about" },
    { name: "Experience", href: "#experience" },
    { name: "Certifications", href: "#certifications" },
    { name: "Skills", href: "#skills" },
    { name: "Contact", href: "#contact" },
    { name: "FAQ", href: "#faq" },
]);

const isMobileMenuOpen = ref(false);
const copied = ref(false);

function toggleMobileMenu() {
    isMobileMenuOpen.value = !isMobileMenuOpen.value;
}

async function copyEmailToClipboard() {
    const email = "uzbekbory@gmail.com";
    try {
        await navigator.clipboard.writeText(email);
        copied.value = true;
        setTimeout(() => (copied.value = false), 1200);
    } catch (e) {
        console.error("Failed to copy email: ", e);
    }
}
</script>

<template>
    <!-- Sticky / glassy container -->
    <div class="sticky top-4 z-50">
        <nav class="mx-auto max-w-6xl rounded-2xl border border-white/10 bg-slate-900/70 backdrop-blur px-4 md:px-6 py-3 shadow-lg"
            role="navigation" aria-label="Main">
            <div class="flex items-center justify-between gap-3">
                <!-- Left: status + mobile toggle -->
                <div class="flex items-center gap-3">
                    <div
                        class="hidden sm:flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs text-slate-300">
                        <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        Available for Projects
                    </div>

                    <button
                        class="flex sm:hidden items-center justify-center rounded-lg border border-white/10 bg-white/5 p-2 text-slate-300 hover:bg-white/10"
                        @click="toggleMobileMenu" aria-label="Toggle Menu">
                        <Menu v-if="!isMobileMenuOpen" class="h-5 w-5" />
                        <X v-else class="h-5 w-5" />
                    </button>
                </div>

                <!-- Center: logo + desktop links -->
                <div class="flex items-center gap-6">
                    <Link href="/" class="shrink-0">
                    <!-- <ApplicationLogo class="h-10 w-10 text-slate-300" /> -->
                    </Link>

                    <ul class="hidden md:flex items-center gap-4">
                        <li v-for="(link, i) in navLinks" :key="i">
                            <a :href="link.href"
                                class="inline-flex items-center gap-2 rounded-xl border border-transparent px-3 py-2 text-sm text-slate-300 hover:text-white hover:border-white/10 hover:bg-white/5 transition">
                                {{ link.name }}
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Right: email copy -->
                <button @click="copyEmailToClipboard"
                    class="inline-flex items-center gap-2 rounded-xl border border-white/10 bg-white/5 px-3 py-2 text-sm text-slate-200 hover:bg-white/10 transition"
                    aria-label="Copy email">
                    <component :is="copied ? Check : Mail" class="h-4 w-4" />
                    <span class="hidden sm:inline-block" style="min-width: 165px;">
                        {{ copied ? "Copied!" : "uzbekbory@gmail.com" }}
                    </span>
                </button>

            </div>

            <!-- Mobile menu -->
            <transition name="fade">
                <div v-if="isMobileMenuOpen" class="mt-3 border-t border-white/10 pt-3 md:hidden">
                    <ul class="grid gap-2">
                        <li v-for="(link, i) in navLinks" :key="'m-' + i">
                            <a :href="link.href"
                                class="block w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-sm text-slate-200 hover:bg-white/10"
                                @click="isMobileMenuOpen = false">
                                {{ link.name }}
                            </a>
                        </li>
                    </ul>
                </div>
            </transition>
        </nav>
    </div>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity .18s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
