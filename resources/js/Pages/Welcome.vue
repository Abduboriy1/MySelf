<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import {ref, onMounted, onBeforeUnmount, computed} from 'vue'
import {
    Mail,
    Phone,
    MapPin,
    Github,
    Linkedin,
    Download,
    ArrowRight,
    Briefcase,
    Calendar,
    Code2,
    Sparkles,
    X,
    Award,
    MessageCircle
} from 'lucide-vue-next'
import AiChat from '@/Components/AiChat.vue'
import resume from '../Assets/Resume.pdf'
import me from '../Assets/me.png'

const chatOpen = ref(false)
const unread = ref(0) // increment when you want to show a badge

// Prefer bottom-sheet on small screens, drawer on md+
const isDesktop = computed(() => typeof window !== 'undefined' && window.matchMedia('(min-width: 768px)').matches)

// Keyboard shortcuts
function onKey(e) {
    const metaK = (e.metaKey || e.ctrlKey) && e.key.toLowerCase() === 'k'
    if (metaK) {
        e.preventDefault()
        chatOpen.value = true
    }
    if (e.key === 'Escape' && chatOpen.value) chatOpen.value = false
}

onMounted(() => window.addEventListener('keydown', onKey))
onBeforeUnmount(() => window.removeEventListener('keydown', onKey))

// Optional: simulate unread badge clear on open
function openChat() {
    chatOpen.value = true
    unread.value = 0
}

const profile = ref({
    name: 'Abduboriy Abdurakhmonov',
    title: 'Full Stack Software Engineer',
    tagline: 'I ship fast, type-safe, and user-friendly products.',
    location: 'St. Louis, MO',
    email: 'uzbekbory@gmail.com',
    phone: '+1 (636) 575-1811',
    avatarUrl: 'https://media.licdn.com/dms/image/v2/D4D03AQEvPc5gog5Y-w/profile-displayphoto-shrink_800_800/B4DZZqqjjNG4Ac-/0/1745546263732?e=1757548800&v=beta&t=QHnlvPfbfL33JgDX-DKO0Fd1oIvam88DBZomgFxmEqI',
    social: [
        {label: 'GitHub', href: 'https://github.com/yourhandle', icon: Github},
        {label: 'LinkedIn', href: 'https://linkedin.com/in/yourhandle', icon: Linkedin},
        {label: 'Email', href: 'mailto:you@example.com', icon: Mail},
    ],
    highlights: [
        {k: '7+', v: 'yrs experience'},
        {k: '500+ hrs', v: 'saved via automation'},
        {k: '20+', v: 'applications developed'},
    ],
    experiences: [
        {
            company: 'SRS Acquiom',
            role: 'Software Engineer',
            period: '2025 — Present',
            bullets: [
                'Working with colleagues on multiple Go applications.'
            ],
            tech: ['Go', 'Vue 3', 'TypeScript', 'PostgreSQL', 'CI/CD', 'TestRails', 'vi-test']
        },
        {
            company: 'Prologue Technology',
            role: 'Software Engineer II',
            period: '2023 — 2025',
            bullets: [
                'Led end-to-end delivery for multiple features used by 1k+ users.',
                'Built Laravel + Vue automation flows integrated with Jira & NetSuite.',
                'Improved page loads by 40% via query tuning and virtualized lists.'
            ],
            tech: ['Laravel', 'Vue 3', 'PHP', 'TypeScript', 'MySQL', 'CI/CD']
        },
        {
            company: 'K&F Express LLC',
            role: 'Software Developer I',
            period: '2019 — 2023',
            bullets: [
                'Replatformed React/Firebase app to Laravel/Vue, cutting infra by ~$5k/mo.',
                'Built driver tasking, HOS tools, and internal analytics dashboards.',
                'Automated manual tasks, saving 200+ hrs annually.'
            ],
            tech: ['Laravel', 'Vue', 'React', 'C#/.NET', 'Firebase']
        },
        {
            company: 'Truman State University',
            role: 'Web Developer',
            period: '2020 — 2022',
            bullets: [
                'Utilized HTML, CSS, JavaScript, and PHP to create and maintain university websites.',
                'Collaborated with cross-functional teams to gather requirements and deliver high-quality web solutions.'],
            tech: ['HTML', 'CSS', 'JavaScript', 'PHP', 'WordPress']
        }
    ],
    skills: [
        'Go', 'Laravel', 'Vue 3', 'TypeScript', 'PHP', 'MySQL', 'PostgreSQL', 'REST', 'CI/CD', 'Vite', 'Tailwind',
        'Node', 'Python', 'RAG', 'Chroma', 'Docker', 'Linux', 'Nginx', 'Jira', 'NetSuite'
    ],
    certifications: [
        {name: 'Linux and Bash for Data Engineering', authority: 'Meta', year: 2025},
        {name: 'Database Structures and Management with MySQL', authority: 'Meta', year: 2025}
    ],
    resumeUrl: resume
})
</script>

<template>
    <GuestLayout>
        <div class="relative overflow-hidden text-stone-800 min-h-screen rounded-3xl p-4 md:p-6 space-y-4 md:space-y-6">


            <!-- === About content takes the whole page === -->
            <section id="about" class="mx-auto max-w-6xl px-6 pt-10 pb-10 bg-white rounded-2xl border border-stone-200 shadow-sm">
                <div class="grid items-center gap-8 md:grid-cols-[1.2fr_.8fr]">
                    <div>
                        <p class="inline-flex items-center gap-2 text-xs tracking-widest text-stone-500">
                            <Sparkles class="h-4 w-4"/>
                            ABOUT ME
                        </p>
                        <h1 class="mt-2 text-4xl font-bold tracking-tight md:text-5xl">
                            <span
                                class="bg-gradient-to-r from-amber-600 via-orange-500 to-amber-500 bg-clip-text text-transparent">
                                {{ profile.value?.name || profile.name }}
                            </span>
                        </h1>
                        <p class="mt-2 text-lg text-stone-600">{{ profile.title }}</p>
                        <p class="mt-4 max-w-2xl text-stone-500">{{ profile.tagline }}</p>

                        <div class="mt-6 flex flex-wrap items-center gap-3 text-sm">
                            <a :href="`mailto:${profile.email}`"
                               class="inline-flex items-center gap-2 rounded-full border border-stone-200 bg-stone-100 px-3 py-1 backdrop-blur hover:bg-stone-200">
                                <Mail class="h-4 w-4 opacity-80"/>
                                {{ profile.email }}
                            </a>
                            <a :href="`tel:${profile.phone}`"
                               class="inline-flex items-center gap-2 rounded-full border border-stone-200 bg-stone-100 px-3 py-1 backdrop-blur hover:bg-stone-200">
                                <Phone class="h-4 w-4 opacity-80"/>
                                {{ profile.phone }}
                            </a>
                            <span
                                class="inline-flex items-center gap-2 rounded-full border border-stone-200 bg-stone-100 px-3 py-1">
                                <MapPin class="h-4 w-4 opacity-80"/> {{ profile.location }}
                            </span>
                        </div>

                        <div class="mt-5 flex flex-wrap gap-3">
                            <a v-for="s in profile.social" :key="s.label" :href="s.href"
                               class="group inline-flex items-center gap-2 rounded-xl border border-stone-200 bg-stone-100 px-3 py-2 text-sm backdrop-blur hover:bg-stone-200"
                               rel="noopener"
                               target="_blank">
                                <component :is="s.icon" class="h-4 w-4 opacity-70 group-hover:opacity-100"/>
                                <span>{{ s.label }}</span>
                            </a>
                        </div>

                        <div class="mt-7 flex gap-3">
                            <a :href="profile.resumeUrl"
                               class="inline-flex items-center gap-2 rounded-xl border border-stone-200 bg-stone-100 px-4 py-2 text-sm backdrop-blur hover:bg-stone-200">
                                <Download class="h-4 w-4"/>
                                Download Resume
                            </a>
                            <a :href="`mailto:${profile.email}`"
                               class="inline-flex items-center gap-2 rounded-xl border border-stone-200 bg-stone-100 px-4 py-2 text-sm backdrop-blur hover:bg-stone-200">
                                Contact
                                <ArrowRight class="h-4 w-4"/>
                            </a>
                        </div>
                    </div>

                    <div class="relative">
                        <div
                            class="relative mx-auto aspect-square w-64 overflow-hidden rounded-3xl border border-stone-200 bg-gradient-to-br from-stone-100 to-stone-50 shadow-2xl md:w-72">
                            <img v-if="me" :src="me" alt="Headshot" class="h-full w-full object-cover"/>
                            <div v-else class="flex h-full w-full items-center justify-center text-stone-400">Add your
                                photo
                            </div>
                        </div>
                        <div class="absolute -bottom-10 -left-4 flex gap-3 mt-10">
                            <div v-for="h in profile.highlights" :key="h.k"
                                 class="rounded-2xl border border-stone-200 bg-stone-100 px-4 py-3 text-center backdrop-blur">
                                <div class="text-xl text-stone-900 font-semibold">{{ h.k }}</div>
                                <div class="text-xs text-stone-900">{{ h.v }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="experience" class="relative mx-auto max-w-6xl px-6 py-10 bg-white rounded-2xl border border-stone-200 shadow-sm">


                <!-- header -->
                <header class="relative z-10 flex items-center justify-between gap-3">
                    <div class="flex items-center gap-3">
                        <div class="grid size-10 place-items-center">
                            <Briefcase class="size-5"/>
                        </div>
                        <div>
                            <h2 class="text-2xl font-semibold tracking-tight">Experience</h2>
                            <p class="text-sm text-stone-500">Impact, scope, and the tools that got it done.</p>
                        </div>
                    </div>

                    <!-- subtle pill -->
                    <span class="hidden md:inline-flex items-center gap-2 rounded-full px-3 py-1 text-xs
             bg-stone-100 ring-1 ring-stone-200 text-stone-600">
                        <span class="size-1.5 rounded-full bg-emerald-400/80 animate-pulse"></span>
                        Updated automatically
                    </span>
                </header>

                <!-- timeline -->
                <ol class="relative z-10 mt-8 space-y-12"> <!-- added space-y for breathing room -->
                    <!-- gradient spine -->
                    <div aria-hidden="true" class="pointer-events-none absolute left-4 top-0 h-full w-px md:left-1/2
           bg-gradient-to-b from-transparent via-stone-300 to-transparent"></div>

                    <li v-for="(job, idx) in profile.experiences" :key="idx"
                        class="relative md:grid md:grid-cols-2 md:gap-10 md:items-start">

                        <!-- dot -->
                        <div class="absolute left-[15px] md:left-1/2 md:-translate-x-1/2 top-4 size-3 rounded-full
             bg-gradient-to-br from-amber-500 to-orange-400 ring-2 ring-offset-2 ring-offset-stone-50 ring-stone-300">
                        </div>

                        <!-- left column -->
                        <div class="pl-10 pr-2 md:pl-0 md:pr-8 md:text-right md:order-1">
                            <div class="inline-flex items-center gap-2 text-xs text-stone-500">
                                <Calendar class="size-4"/>
                                <span class="tabular-nums">{{ job.period }}</span>
                            </div>
                            <div class="mt-2 flex items-center justify-end gap-2">
                                <h3 class="text-lg font-semibold leading-snug">{{ job.role }}</h3>
                                <span class="inline-flex items-center gap-1.5 rounded-full px-2 py-1
                         bg-amber-100 text-amber-700 ring-1 ring-inset ring-amber-300/40">
                                    <Briefcase class="size-3.5"/> {{ job.company }}
                                </span>
                            </div>
                            <div class="mt-3 flex flex-wrap gap-2 md:justify-end">
                                <span v-for="t in job.tech" :key="t" class="rounded-full px-2.5 py-1 text-[11px] leading-4
                 bg-stone-100 text-stone-700 ring-1 ring-stone-200
                 transition-transform duration-300">
                                    {{ t }}
                                </span>
                            </div>
                        </div>

                        <!-- right column: full-hover card -->
                        <div class="pl-10 md:pl-8 md:order-2">
                            <article class="relative overflow-hidden rounded-2xl
               bg-gradient-to-b from-stone-100 to-stone-50
               ring-1 ring-stone-200 shadow-[0_0_0_1px_rgba(0,0,0,0.02)]
               transition-all duration-300
               hover:shadow-2xl hover:shadow-amber-500/20 hover:ring-amber-400/40">

                                <!-- fix: full-bleed sheen overlay -->
                                <span class="pointer-events-none absolute inset-0 opacity-0 transition-opacity duration-300
                 group-hover:opacity-100"
                                      style="background: conic-gradient(from 180deg at 50% -10%, rgba(56,189,248,.18), transparent 40%);">
                                </span>

                                <div class="relative p-6">
                                    <ul class="space-y-2.5 text-stone-600">
                                        <li v-for="(b, i) in job.bullets" :key="i" class="flex gap-3">
                                            <span class="mt-2.5 size-1.5 shrink-0 rounded-full bg-amber-500/70"></span>
                                            <p class="leading-relaxed">{{ b }}</p>
                                        </li>
                                    </ul>
                                    <footer class="mt-5 flex items-center justify-between text-xs text-stone-500">
                                        <span class="inline-flex items-center gap-2">
                                            <span class="size-1.5 rounded-full bg-emerald-400"></span>
                                            Proven impact
                                        </span>
                                    </footer>
                                </div>
                            </article>
                        </div>
                    </li>
                </ol>

            </section>


            <section id="skills" class="mx-auto max-w-6xl px-6 py-10 bg-white rounded-2xl border border-stone-200 shadow-sm">
                <h2 class="flex items-center gap-2 text-2xl font-semibold">
                    <Code2 class="h-6 w-6"/>
                    Skills
                </h2>
                <div class="mt-5 flex flex-wrap gap-2">
                    <span v-for="s in profile.skills" :key="s"
                          class="rounded-full border border-stone-200 bg-stone-100 px-3 py-1 text-sm text-stone-700">{{
                            s
                        }}</span>
                </div>
            </section>

            <section id="certifications" class="mx-auto max-w-6xl px-6 py-10 bg-white rounded-2xl border border-stone-200 shadow-sm">
                <h2 class="flex items-center gap-2 text-2xl font-semibold">
                    <Award class="h-6 w-6"/>
                    Certifications
                </h2>

                <ul class="mt-6 grid gap-4 sm:grid-cols-2">
                    <li v-for="(c, i) in profile.certifications" :key="i"
                        class="rounded-xl border border-stone-200 bg-stone-100 p-4 backdrop-blur">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <div class="text-base font-medium text-stone-900">
                                    {{ c.name }}
                                </div>
                                <div class="mt-1 text-sm text-stone-500">
                                    {{ c.authority }}
                                </div>
                            </div>
                            <span
                                class="shrink-0 rounded-full border border-stone-200 bg-stone-50 px-2 py-0.5 text-xs text-stone-700">
                                {{ c.year }}
                            </span>
                        </div>

                        <!-- Optional helpers if you add them later (won't render unless present) -->
                        <div v-if="c.url || c.id" class="mt-3 flex flex-wrap items-center gap-3 text-xs">
                            <a v-if="c.url" :href="c.url"
                               class="inline-flex items-center gap-1 underline underline-offset-4 hover:opacity-90"
                               rel="noopener"
                               target="_blank">
                                Verify
                                <ArrowRight class="h-3 w-3"/>
                            </a>
                            <span v-if="c.id" class="rounded-full border border-stone-200 bg-stone-100 px-2 py-0.5">
                                ID: {{ c.id }}
                            </span>
                        </div>
                    </li>
                </ul>
            </section>

            <section id="contact" class="mx-auto max-w-6xl px-6 py-10 bg-white rounded-2xl border border-stone-200 shadow-sm">
                <h2 class="flex items-center gap-2 text-2xl font-semibold">
                    <Mail class="h-6 w-6"/>
                    Contact
                </h2>
                <p class="mt-2 text-stone-500">Get in touch — I'm open to new opportunities.</p>
                <div class="mt-6 flex flex-wrap gap-3 text-sm">
                    <a :href="`mailto:${profile.email}`"
                       class="inline-flex items-center gap-2 rounded-full border border-stone-200 bg-stone-100 px-3 py-1 hover:bg-stone-200">
                        <Mail class="h-4 w-4 opacity-80"/> {{ profile.email }}
                    </a>
                    <a :href="`tel:${profile.phone}`"
                       class="inline-flex items-center gap-2 rounded-full border border-stone-200 bg-stone-100 px-3 py-1 hover:bg-stone-200">
                        <Phone class="h-4 w-4 opacity-80"/> {{ profile.phone }}
                    </a>
                    <a v-for="s in profile.social" :key="s.label" :href="s.href"
                       class="inline-flex items-center gap-2 rounded-full border border-stone-200 bg-stone-100 px-3 py-1 hover:bg-stone-200"
                       target="_blank" rel="noopener">
                        <component :is="s.icon" class="h-4 w-4 opacity-80"/> {{ s.label }}
                    </a>
                </div>
            </section>

            <!-- ===== Floating Action Button (FAB) - bottom right ===== -->
            <button aria-label="Open AI chat" class="fixed bottom-[calc(env(safe-area-inset-bottom)+1rem)] right-4 z-50
         inline-flex items-center gap-2 rounded-full border border-amber-700
         bg-amber-600 px-4 py-2 text-sm font-medium text-white shadow-xl
         backdrop-blur hover:bg-amber-700 active:scale-[0.98]
         md:px-5 md:py-2.5" @click="openChat">
                <span class="relative inline-flex">
                    <MessageCircle class="h-5 w-5"/>
                    <span v-if="unread > 0"
                          class="absolute -right-1 -top-1 grid h-4 w-4 place-items-center rounded-full bg-emerald-500 text-[10px] font-bold text-white">
                        {{ Math.min(9, unread) }}
                    </span>
                </span>
                <span class="hidden sm:block">Ask AI</span>
            </button>

            <!-- ===== Backdrop ===== -->
            <transition name="fade">
                <div v-if="chatOpen" aria-hidden="true"
                     class="fixed inset-0 z-40 bg-stone-900/30 backdrop-blur-[2px]" @click="chatOpen = false"></div>
            </transition>

            <!-- ===== Responsive Chat Container =====
                - Mobile: bottom-sheet full height (100dvh)
                - Desktop: right drawer with rounded corners
            -->
            <transition :name="isDesktop ? 'slide-right' : 'slide-up'" mode="out-in">
                <section v-if="chatOpen" aria-modal="true" class="fixed z-50
           md:right-4 md:top-4
           md:h-[80vh] md:w-[520px]
           md:rounded-2xl
           md:border md:border-stone-200
           md:bg-white
           md:shadow-2xl
           md:backdrop-blur
           /* Mobile bottom-sheet */
           left-0 right-0 bottom-0 top-0
           md:left-auto md:bottom-auto md:top-4
           bg-white" role="dialog">
                    <!-- Header -->
                    <header
                        class="flex items-center justify-between border-b border-stone-200 px-4 py-3 md:rounded-t-2xl">
                        <div class="flex items-center gap-2 text-sm text-stone-600">
                            <Sparkles class="h-4 w-4"/>
                            Ask AI about {{ profile.value?.name || profile.name }}
                        </div>
                        <button aria-label="Close"
                                class="rounded-lg border border-stone-200 bg-stone-100 p-2 hover:bg-stone-200"
                                @click="chatOpen = false">
                            <X class="h-4 w-4"/>
                        </button>
                    </header>


                    <!-- Scroll area -->
                    <div class="flex h-[calc(100dvh-56px)] flex-col md:h-[calc(80vh-56px)]">
                        <AiChat/>
                    </div>

                </section>
            </transition>
        </div>
    </GuestLayout>
</template>

<style scoped>
/* Smooth scrolling */
:global(html) {
    scroll-behavior: smooth;
}

/* Offset anchor targets to account for sticky navbar (~96px) */
section[id] {
    scroll-margin-top: 6rem;
}

/* Optional: slim scrollbars inside chat */
:deep(.overflow-y-auto)::-webkit-scrollbar {
    width: 8px;
}

:deep(.overflow-y-auto)::-webkit-scrollbar-thumb {
    background: rgba(0, 0, 0, .15);
    border-radius: 9999px;
}
</style>
