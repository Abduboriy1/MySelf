<script setup>
// Modern About page built for your stack: Vue 3 + TailwindCSS + lucide-vue-next.
// Works with plain Vue or Inertia. No extra UI libs required.
// Replace the placeholder data below (or pass as props).
import { ref } from 'vue'
import { Mail, Phone, MapPin, Github, Linkedin, Download, ArrowRight, Briefcase, Calendar, Code2, Sparkles } from 'lucide-vue-next'

const profile = ref({
    name: 'Your Name',
    title: 'Software Engineer',
    tagline: 'I ship fast, type-safe, and user-friendly products.',
    location: 'St. Louis, MO',
    email: 'you@example.com',
    phone: '+1 (000) 000-0000',
    avatarUrl: '', // add a headshot URL if you have one
    social: [
        { label: 'GitHub', href: 'https://github.com/yourhandle', icon: Github },
        { label: 'LinkedIn', href: 'https://linkedin.com/in/yourhandle', icon: Linkedin },
        { label: 'Email', href: 'mailto:you@example.com', icon: Mail },
    ],
    highlights: [
        { k: '5+', v: 'yrs experience' },
        { k: '500+ hrs', v: 'saved via automation' },
        { k: '99.9%', v: 'uptime on prod' },
    ],
    experiences: [
        {
            company: 'Company One',
            role: 'Software Engineer II',
            period: '2024 — Present',
            bullets: [
                'Led end‑to‑end delivery for multiple features used by 1k+ users.',
                'Built Laravel + Vue automation flows integrated with Jira & NetSuite.',
                'Improved page loads by 40% via query tuning and virtualized lists.'
            ],
            tech: ['Laravel', 'Vue 3', 'PHP', 'TypeScript', 'MySQL', 'CI/CD']
        },
        {
            company: 'Company Two',
            role: 'Software Developer I',
            period: '2022 — 2024',
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
    // Optional: If you host a PDF resume in your app/public folder, set resumeUrl
    resumeUrl: '/resume.pdf'
})
</script>

<template>
    <div class="relative overflow-hidden">
        <!-- Soft gradient blobs (pure Tailwind) -->
        <div
            class="pointer-events-none absolute -top-40 -right-32 h-96 w-96 rounded-full bg-gradient-to-tr from-fuchsia-500/20 to-indigo-500/20 blur-3xl">
        </div>
        <div
            class="pointer-events-none absolute -bottom-40 -left-32 h-[28rem] w-[28rem] rounded-full bg-gradient-to-tr from-sky-500/20 to-emerald-500/20 blur-3xl">
        </div>

        <!-- HERO -->
        <section class="mx-auto max-w-6xl px-4 pt-16 pb-10">
            <div class="grid items-center gap-8 md:grid-cols-[1.2fr_.8fr]">
                <div>
                    <p class="inline-flex items-center gap-2 text-xs tracking-widest text-slate-400">
                        <Sparkles class="h-4 w-4" /> ABOUT ME
                    </p>
                    <h1 class="mt-2 text-4xl font-bold tracking-tight md:text-5xl">
                        <span
                            class="bg-gradient-to-r from-indigo-400 via-fuchsia-400 to-emerald-400 bg-clip-text text-transparent">
                            {{ profile.name }}
                        </span>
                    </h1>
                    <p class="mt-2 text-lg text-slate-300">{{ profile.title }}</p>
                    <p class="mt-4 max-w-2xl text-slate-400">{{ profile.tagline }}</p>

                    <!-- Contact chips (lucide icons) -->
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

                    <!-- Social buttons -->
                    <div class="mt-5 flex flex-wrap gap-3">
                        <a v-for="s in profile.social" :key="s.label" :href="s.href" target="_blank" rel="noopener"
                            class="group inline-flex items-center gap-2 rounded-xl border border-white/10 bg-white/5 px-3 py-2 text-sm backdrop-blur hover:bg-white/10">
                            <component :is="s.icon" class="h-4 w-4 opacity-70 group-hover:opacity-100" />
                            <span>{{ s.label }}</span>
                        </a>
                    </div>

                    <!-- CTA -->
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

                <!-- Avatar + Stats -->
                <div class="relative">
                    <div
                        class="relative mx-auto aspect-square w-64 overflow-hidden rounded-3xl border border-white/10 bg-gradient-to-br from-slate-900 to-slate-800 shadow-2xl md:w-72">
                        <img v-if="profile.avatarUrl" :src="profile.avatarUrl" alt="Headshot"
                            class="h-full w-full object-cover" />
                        <div v-else class="flex h-full w-full items-center justify-center text-slate-500">Add your photo
                        </div>
                    </div>
                    <div class="absolute -bottom-4 -left-4 flex gap-3">
                        <div v-for="h in profile.highlights" :key="h.k"
                            class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-center backdrop-blur">
                            <div class="text-xl font-semibold">{{ h.k }}</div>
                            <div class="text-xs text-slate-400">{{ h.v }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Experience -->
        <section class="mx-auto max-w-6xl px-4 py-12">
            <h2 class="flex items-center gap-2 text-2xl font-semibold">
                <Briefcase class="h-6 w-6" /> Experience
            </h2>
            <ol class="relative mt-6 border-s border-white/10">
                <li v-for="(job, idx) in profile.experiences" :key="idx" class="ms-4 pb-10">
                    <div class="absolute -left-1.5 mt-1.5 h-3 w-3 rounded-full border border-white/20 bg-white/40">
                    </div>
                    <div class="flex flex-col justify-between gap-2 md:flex-row md:items-center">
                        <div class="text-lg font-medium">{{ job.role }} · <span class="text-slate-400">{{ job.company
                                }}</span></div>
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

        <!-- Skills -->
        <section class="mx-auto max-w-6xl px-4 pb-16">
            <h2 class="flex items-center gap-2 text-2xl font-semibold">
                <Code2 class="h-6 w-6" /> Skills
            </h2>
            <div class="mt-5 flex flex-wrap gap-2">
                <span v-for="s in profile.skills" :key="s"
                    class="rounded-full border border-white/10 bg-white/5 px-3 py-1 text-sm text-slate-300">{{ s
                    }}</span>
            </div>
        </section>
    </div>
</template>

<style scoped>
/* no external styles needed — Tailwind only */
</style>
