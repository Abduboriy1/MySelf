<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import { ref, onMounted, onBeforeUnmount, computed } from 'vue'
import { Mail, Phone, MapPin, Github, Linkedin, Download, ArrowRight, Briefcase, Calendar, Code2, Sparkles, X, Award, MessageCircle } from 'lucide-vue-next'
import AiChat from '@/Components/AiChat.vue'
import resume from '../Assets/Resume.pdf'
import me from '../Assets/me.jpeg'

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
    title: 'Software Engineer II',
    tagline: 'I ship fast, type-safe, and user-friendly products.',
    location: 'St. Louis, MO',
    email: 'uzbekbory@gmail.com',
    phone: '+1 (636) 575-1811',
    avatarUrl: 'https://media.licdn.com/dms/image/v2/D4D03AQEvPc5gog5Y-w/profile-displayphoto-shrink_800_800/B4DZZqqjjNG4Ac-/0/1745546263732?e=1757548800&v=beta&t=QHnlvPfbfL33JgDX-DKO0Fd1oIvam88DBZomgFxmEqI',
    social: [
        { label: 'GitHub', href: 'https://github.com/yourhandle', icon: Github },
        { label: 'LinkedIn', href: 'https://linkedin.com/in/yourhandle', icon: Linkedin },
        { label: 'Email', href: 'mailto:you@example.com', icon: Mail },
    ],
    highlights: [
        { k: '6+', v: 'yrs experience' },
        { k: '500+ hrs', v: 'saved via automation' },
        { k: '99.9%', v: 'uptime on prod' },
    ],
    experiences: [
        {
            company: 'Prologue Technology',
            role: 'Software Engineer II',
            period: '2023 — Present',
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
        'Laravel', 'Vue 3', 'TypeScript', 'PHP', 'MySQL', 'PostgreSQL', 'REST', 'CI/CD', 'Vite', 'Tailwind',
        'Node', 'Python', 'RAG', 'Chroma', 'Docker', 'Linux', 'Nginx', 'Jira', 'NetSuite'
    ],
    certifications: [
        { name: 'Linux and Bash for Data Engineering', authority: 'Meta', year: 2025 },
        { name: 'Database Structures and Management with MySQL', authority: 'Meta', year: 2025 }
    ],
    resumeUrl: resume
})
</script>

<template>
    <GuestLayout>
        <div class="relative overflow-hidden bg-slate-900 text-slate-200 min-h-screen rounded-3xl">
            <!-- Background blobs -->
            <div
                class="pointer-events-none absolute -top-40 -right-32 h-96 w-96 rounded-full bg-gradient-to-tr from-fuchsia-500/30 to-indigo-500/30 blur-3xl">
            </div>
            <div
                class="pointer-events-none absolute -bottom-40 -left-32 h-[28rem] w-[28rem] rounded-full bg-gradient-to-tr from-sky-500/30 to-emerald-500/30 blur-3xl">
            </div>

            <!-- === About content takes the whole page === -->
            <section class="mx-auto max-w-6xl px-4 pt-16 pb-10 bg-slate-900/90 rounded-lx">
                <div class="grid items-center gap-8 md:grid-cols-[1.2fr_.8fr]">
                    <div>
                        <p class="inline-flex items-center gap-2 text-xs tracking-widest text-slate-400">
                            <Sparkles class="h-4 w-4" /> ABOUT ME
                        </p>
                        <h1 class="mt-2 text-4xl font-bold tracking-tight md:text-5xl">
                            <span
                                class="bg-gradient-to-r from-indigo-400 via-fuchsia-400 to-emerald-400 bg-clip-text text-transparent">
                                {{ profile.value?.name || profile.name }}
                            </span>
                        </h1>
                        <p class="mt-2 text-lg text-slate-300">{{ profile.title }}</p>
                        <p class="mt-4 max-w-2xl text-slate-400">{{ profile.tagline }}</p>

                        <div class="mt-6 flex flex-wrap items-center gap-3 text-sm">
                            <a :href="`mailto:${profile.email}`"
                                class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-3 py-1 backdrop-blur hover:bg-white/10">
                                <Mail class="h-4 w-4 opacity-80" /> {{ profile.email }}
                            </a>
                            <a :href="`tel:${profile.phone}`"
                                class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-3 py-1 backdrop-blur hover:bg-white/10">
                                <Phone class="h-4 w-4 opacity-80" /> {{ profile.phone }}
                            </a>
                            <span
                                class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-3 py-1">
                                <MapPin class="h-4 w-4 opacity-80" /> {{ profile.location }}
                            </span>
                        </div>

                        <div class="mt-5 flex flex-wrap gap-3">
                            <a v-for="s in profile.social" :key="s.label" :href="s.href" target="_blank" rel="noopener"
                                class="group inline-flex items-center gap-2 rounded-xl border border-white/10 bg-white/5 px-3 py-2 text-sm backdrop-blur hover:bg-white/10">
                                <component :is="s.icon" class="h-4 w-4 opacity-70 group-hover:opacity-100" />
                                <span>{{ s.label }}</span>
                            </a>
                        </div>

                        <div class="mt-7 flex gap-3">
                            <a :href="profile.resumeUrl"
                                class="inline-flex items-center gap-2 rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm backdrop-blur hover:bg-white/10">
                                <Download class="h-4 w-4" /> Download Resume
                            </a>
                            <a :href="`mailto:${profile.email}`"
                                class="inline-flex items-center gap-2 rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm backdrop-blur hover:bg-white/10">
                                Contact
                                <ArrowRight class="h-4 w-4" />
                            </a>
                        </div>
                    </div>

                    <div class="relative">
                        <div
                            class="relative mx-auto aspect-square w-64 overflow-hidden rounded-3xl border border-white/10 bg-gradient-to-br from-slate-900 to-slate-800 shadow-2xl md:w-72">
                            <img v-if="me" :src="me" alt="Headshot" class="h-full w-full object-cover" />
                            <div v-else class="flex h-full w-full items-center justify-center text-slate-500">Add your
                                photo</div>
                        </div>
                        <div class="absolute -bottom-4 -left-4 flex gap-3">
                            <div v-for="h in profile.highlights" :key="h.k"
                                class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-center backdrop-blur">
                                <div class="text-xl text-slate-50 font-semibold">{{ h.k }}</div>
                                <div class="text-xs text-slate-50">{{ h.v }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="relative mx-auto max-w-6xl px-4 py-14 ">



                <!-- header -->
                <header class="relative z-10 flex items-center justify-between gap-3">
                    <div class="flex items-center gap-3">
                        <div class="grid size-10 place-items-center rounded-xl bg-gradient-to-br from-sky-500/20 to-cyan-400/20
               ring-1 ring-inset ring-white/15 shadow-sm shadow-cyan-400/10">
                            <Briefcase class="size-5 text-sky-300" />
                        </div>
                        <div>
                            <h2 class="text-2xl font-semibold tracking-tight">Experience</h2>
                            <p class="text-sm text-slate-400">Impact, scope, and the tools that got it done.</p>
                        </div>
                    </div>

                    <!-- subtle pill -->
                    <span class="hidden md:inline-flex items-center gap-2 rounded-full px-3 py-1 text-xs
             bg-white/5 ring-1 ring-white/10 text-slate-300">
                        <span class="size-1.5 rounded-full bg-emerald-400/80 animate-pulse"></span>
                        Updated automatically
                    </span>
                </header>

                <!-- timeline -->
                <ol class="relative z-10 mt-8 space-y-12"> <!-- added space-y for breathing room -->
                    <!-- gradient spine -->
                    <div aria-hidden="true" class="pointer-events-none absolute left-4 top-0 h-full w-px md:left-1/2
           bg-gradient-to-b from-transparent via-white/20 to-transparent"></div>

                    <li v-for="(job, idx) in profile.experiences" :key="idx"
                        class="relative md:grid md:grid-cols-2 md:gap-10 md:items-start">

                        <!-- dot -->
                        <div class="absolute left-[15px] md:left-1/2 md:-translate-x-1/2 top-4 size-3 rounded-full
             bg-gradient-to-br from-sky-400 to-cyan-300 ring-2 ring-offset-2 ring-offset-slate-900/60 ring-white/20">
                        </div>

                        <!-- left column -->
                        <div class="pl-10 pr-2 md:pl-0 md:pr-8 md:text-right md:order-1">
                            <div class="inline-flex items-center gap-2 text-xs text-slate-400">
                                <Calendar class="size-4" />
                                <span class="tabular-nums">{{ job.period }}</span>
                            </div>
                            <h3 class="mt-2 text-lg font-semibold leading-snug">
                                {{ job.role }}

                            </h3>
                            <div class="mt-3 flex flex-wrap gap-2 md:justify-end">
                                <span v-for="t in job.tech" :key="t" class="rounded-full px-2.5 py-1 text-[11px] leading-4
                 bg-white/5 text-slate-300 ring-1 ring-white/10
                 transition-transform duration-300">
                                    {{ t }}
                                </span>
                            </div>
                        </div>

                        <!-- right column: full-hover card -->
                        <div class="pl-10 md:pl-8 md:order-2">
                            <article class="relative overflow-hidden rounded-2xl
               bg-gradient-to-b from-white/[0.06] to-white/[0.03]
               ring-1 ring-white/10 shadow-[0_0_0_1px_rgba(255,255,255,0.02)]
               transition-all duration-300
               hover:shadow-2xl hover:shadow-sky-500/20 hover:ring-sky-400/40">

                                <!-- fix: full-bleed sheen overlay -->
                                <span class="pointer-events-none absolute inset-0 opacity-0 transition-opacity duration-300
                 group-hover:opacity-100"
                                    style="background: conic-gradient(from 180deg at 50% -10%, rgba(56,189,248,.18), transparent 40%);">
                                </span>

                                <div class="relative p-6">
                                    <ul class="space-y-2.5 text-slate-300">
                                        <li v-for="(b, i) in job.bullets" :key="i" class="flex gap-3">
                                            <span class="mt-2.5 size-1.5 shrink-0 rounded-full bg-sky-300/70"></span>
                                            <p class="leading-relaxed">{{ b }}</p>
                                        </li>
                                    </ul>
                                    <footer class="mt-5 flex items-center justify-between text-xs text-slate-400">
                                        <span class="inline-flex items-center gap-2">
                                            <span class="size-1.5 rounded-full bg-emerald-400"></span>
                                            Proven impact
                                        </span>
                                        <span class="inline-flex items-center gap-1.5 rounded-full px-2 py-1
                     bg-sky-400/10 text-sky-200 ring-1 ring-inset ring-sky-300/20">
                                            <Briefcase class="size-3.5" /> {{ job.company }}
                                        </span>
                                    </footer>
                                </div>
                            </article>
                        </div>
                    </li>
                </ol>

            </section>


            <section class="mx-auto max-w-6xl px-4 pb-16 bg-slate-900/90 rounded-xl">
                <h2 class="flex items-center gap-2 text-2xl font-semibold">
                    <Code2 class="h-6 w-6" /> Skills
                </h2>
                <div class="mt-5 flex flex-wrap gap-2">
                    <span v-for="s in profile.skills" :key="s"
                        class="rounded-full border border-white/10 bg-white/5 px-3 py-1 text-sm text-slate-300">{{ s
                        }}</span>
                </div>
            </section>

            <section class="mx-auto max-w-6xl px-4 py-12 bg-slate-900/90 rounded-xl">
                <h2 class="flex items-center gap-2 text-2xl font-semibold">
                    <Award class="h-6 w-6" /> Certifications
                </h2>

                <ul class="mt-6 grid gap-4 sm:grid-cols-2">
                    <li v-for="(c, i) in profile.certifications" :key="i"
                        class="rounded-xl border border-white/10 bg-white/5 p-4 backdrop-blur">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <div class="text-base font-medium text-slate-100">
                                    {{ c.name }}
                                </div>
                                <div class="mt-1 text-sm text-slate-400">
                                    {{ c.authority }}
                                </div>
                            </div>
                            <span
                                class="shrink-0 rounded-full border border-white/10 bg-white/5 px-2 py-0.5 text-xs text-slate-300">
                                {{ c.year }}
                            </span>
                        </div>

                        <!-- Optional helpers if you add them later (won't render unless present) -->
                        <div v-if="c.url || c.id" class="mt-3 flex flex-wrap items-center gap-3 text-xs">
                            <a v-if="c.url" :href="c.url" target="_blank" rel="noopener"
                                class="inline-flex items-center gap-1 underline underline-offset-4 hover:opacity-90">
                                Verify
                                <ArrowRight class="h-3 w-3" />
                            </a>
                            <span v-if="c.id" class="rounded-full border border-white/10 bg-white/5 px-2 py-0.5">
                                ID: {{ c.id }}
                            </span>
                        </div>
                    </li>
                </ul>
            </section>

            <!-- ===== Floating Action Button (FAB) - bottom right ===== -->
            <button @click="openChat" aria-label="Open AI chat" class="fixed bottom-[calc(env(safe-area-inset-bottom)+1rem)] right-4 z-50
         inline-flex items-center gap-2 rounded-full border border-white/10
         bg-black px-4 py-2 text-sm font-medium text-slate-200 shadow-xl
         backdrop-blur hover:bg-black/70 active:scale-[0.98]
         md:px-5 md:py-2.5">
                <span class="relative inline-flex">
                    <MessageCircle class="h-5 w-5" />
                    <span v-if="unread > 0"
                        class="absolute -right-1 -top-1 grid h-4 w-4 place-items-center rounded-full bg-emerald-500 text-[10px] font-bold text-white">
                        {{ Math.min(9, unread) }}
                    </span>
                </span>
                <span class="hidden sm:block">Ask AI</span>
            </button>

            <!-- ===== Backdrop ===== -->
            <transition name="fade">
                <div v-if="chatOpen" class="fixed inset-0 z-40 bg-black/40 backdrop-blur-[2px]"
                    @click="chatOpen = false" aria-hidden="true"></div>
            </transition>

            <!-- ===== Responsive Chat Container =====
                - Mobile: bottom-sheet full height (100dvh)
                - Desktop: right drawer with rounded corners
            -->
            <transition :name="isDesktop ? 'slide-right' : 'slide-up'" mode="out-in">
                <section v-if="chatOpen" role="dialog" aria-modal="true" class="fixed z-50
           md:right-4 md:top-4
           md:h-[80vh] md:w-[520px]
           md:rounded-2xl
           md:border md:border-white/10
           md:bg-slate-900/90
           md:shadow-2xl
           md:backdrop-blur
           /* Mobile bottom-sheet */
           left-0 right-0 bottom-0 top-0
           md:left-auto md:bottom-auto md:top-4
           bg-slate-900/95">
                    <!-- Header -->
                    <header
                        class="flex items-center justify-between border-b border-white/10 px-4 py-3 md:rounded-t-2xl">
                        <div class="flex items-center gap-2 text-sm text-slate-300">
                            <Sparkles class="h-4 w-4" />
                            Ask AI about {{ profile.value?.name || profile.name }}
                        </div>
                        <button @click="chatOpen = false" aria-label="Close"
                            class="rounded-lg border border-white/10 bg-white/5 p-2 hover:bg-white/10">
                            <X class="h-4 w-4" />
                        </button>
                    </header>


                    <!-- Scroll area -->
                    <div class="flex h-[calc(100dvh-56px)] flex-col md:h-[calc(80vh-56px)]">
                        <AiChat />
                    </div>

                </section>
            </transition>
        </div>
    </GuestLayout>
</template>

<style scoped>
/* Fade (backdrop) */
.fade-enter-active,
.fade-leave-active {
    transition: opacity 200ms ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

/* Drawer (desktop) */
.slide-right-enter-active,
.slide-right-leave-active {
    transition: transform 220ms ease;
}

.slide-right-enter-from,
.slide-right-leave-to {
    transform: translateX(120%);
}

/* Bottom-sheet (mobile) */
.slide-up-enter-active,
.slide-up-leave-active {
    transition: transform 220ms ease;
}

.slide-up-enter-from,
.slide-up-leave-to {
    transform: translateY(100%);
}

/* Optional: slim scrollbars inside chat */
:deep(.overflow-y-auto)::-webkit-scrollbar {
    width: 8px;
}

:deep(.overflow-y-auto)::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, .12);
    border-radius: 9999px;
}
</style>
