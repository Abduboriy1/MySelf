<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import { ref } from 'vue'
import { Mail, Phone, MapPin, Github, Linkedin, Download, ArrowRight, Briefcase, Calendar, Code2, Sparkles, X, Award } from 'lucide-vue-next'
import AiChat from '@/Components/AiChat.vue'
import resume from '../Assets/Resume.pdf'
const chatOpen = ref(false)

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
                'Built driver tasking, HOS tools, and internal analytics dashboards.'
            ],
            tech: ['Laravel', 'Vue', 'React', 'C#/.NET', 'Firebase']
        },
        {
            company: 'Truman State University',
            role: 'Web Developer',
            period: '2020 — 2022',
            bullets: [
                'Replatformed React/Firebase app to Laravel/Vue, cutting infra by ~$5k/mo.',
                'Built driver tasking, HOS tools, and internal analytics dashboards.'
            ],
            tech: ['Laravel', 'Vue', 'React', 'C#/.NET', 'Firebase']
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
                            <img v-if="profile.avatarUrl" :src="profile.avatarUrl" alt="Headshot"
                                class="h-full w-full object-cover" />
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

            <section class="mx-auto max-w-6xl px-4 py-12 bg-slate-900/90 rounded-xl">
                <h2 class="flex items-center gap-2 text-2xl font-semibold">
                    <Briefcase class="h-6 w-6" /> Experience
                </h2>
                <ol class="relative mt-6 border-s border-white/10">
                    <li v-for="(job, idx) in profile.experiences" :key="idx" class="ms-4 pb-10">
                        <div class="absolute -left-1.5 mt-1.5 h-3 w-3 rounded-full border border-white/20 bg-white/40">
                        </div>
                        <div class="flex flex-col justify-between gap-2 md:flex-row md:items-center">
                            <div class="text-lg font-medium">{{ job.role }} · <span class="text-slate-400">{{
                                job.company }}</span></div>
                            <div class="inline-flex items-center gap-2 text-sm text-slate-400">
                                <Calendar class="h-4 w-4" /> {{ job.period }}
                            </div>
                        </div>
                        <ul class="mt-3 list-disc space-y-2 pl-6 text-slate-300">
                            <li v-for="(b, i) in job.bullets" :key="i">{{ b }}</li>
                        </ul>
                        <div class="mt-3 flex flex-wrap gap-2">
                            <span v-for="t in job.tech" :key="t"
                                class="rounded-full border border-white/10 bg-white/5 px-2.5 py-1 text-xs text-slate-300">{{
                                    t }}</span>
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

            <!-- ========= Side tab trigger (always visible) ========= -->
            <button :class="bg - slate - 900 / 90" @click="chatOpen = true"
                class="bg-slate-900/90 group rotate-90 fixed right-1 top-1/2 z-40 -translate-y-1/2 rounded-2xl border border-white/10 px-3 py-2 text-sm font-medium backdrop-blur transition hover:bg-black/70"
                aria-label="Open AI chat about me">
                <span class="inline-flex items-center gap-2 origin-right ">
                    <Sparkles class="h-4 w-4" />
                    <span class="text-c">Chat with AI about me</span>
                </span>
            </button>

            <!-- ========= Slide-over chat panel ========= -->
            <transition name="fade" mode="out-in">
                <div v-if="chatOpen" class="fixed inset-0 z-50">
                    <!-- backdrop -->
                    <div class="absolute inset-0 bg-black/50" @click="chatOpen = false" aria-hidden="true"></div>
                    <!-- panel -->
                    <div class="absolute right-0 top-0 h-full w-full lg:w-1/2">
                        <transition name="slide">
                            <section
                                class="absolute right-0 top-0 flex h-full w-full flex-col border-l border-white/10 bg-slate-900/95 backdrop-blur">
                                <!-- header -->
                                <header class="flex items-center justify-between border-b border-white/10 px-4 py-3">
                                    <div class="flex items-center gap-2 text-sm text-slate-300">
                                        <Sparkles class="h-4 w-4" /> Ask AI about {{ profile.name }}
                                    </div>
                                    <button @click="chatOpen = false"
                                        class="rounded-lg border border-white/10 bg-white/5 p-2 hover:bg-white/10"
                                        aria-label="Close">
                                        <X class="h-4 w-4" />
                                    </button>
                                </header>
                                <!-- body -->
                                <div class="flex-1 overflow-hidden">
                                    <AiChat />
                                </div>
                            </section>
                        </transition>
                    </div>
                </div>
            </transition>
        </div>
    </GuestLayout>
</template>

<style scoped>
/* transitions for the overlay + panel */
.fade-enter-active,
.fade-leave-active {
    transition: opacity 200ms ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

.slide-enter-active,
.slide-leave-active {
    transition: transform 220ms ease;
}

.slide-enter-from,
.slide-leave-to {
    transform: translateX(100%);
}
</style>
