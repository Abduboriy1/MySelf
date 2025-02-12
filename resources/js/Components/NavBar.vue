<script lang="ts">
    import { defineComponent, ref } from "vue";
    import ApplicationLogo from '@/Components/ApplicationLogo.vue';
    import { Link } from '@inertiajs/vue3';

    interface NavLink {
        name: string;
        href: string;
    }

    function copyEmailToClipboard() {
        const email = "uzbekbory@gmail.com";
        navigator.clipboard.writeText(email).then(() => {
            // alert(`Email copied to clipboard: ${email}`);
        }).catch(err => {
            console.error('Failed to copy email: ', err);
        });
    }
  
    export default defineComponent({
        name: "NavBar",
        setup() {
        const navLinks = ref<NavLink[]>([
            { name: "Experience", href: "#experience" },
            { name: "About", href: "#about" },
            { name: "Contact", href: "#contact" },
            { name: "FAQ", href: "#faq" },
        ]);
    
        return {
            copyEmailToClipboard,
            navLinks,
        };
        },
    });

</script>

<template>
    <nav class="navbar glass">
        <!-- Left Section -->
        <div class="navbar-left">
            <div class="status-badge">
                <span class="status-dot"></span> Available for Projects
            </div>
        </div>

        <!-- Center Section -->
        <ul class="navbar-center">
            <li>
                <Link href="/">
                    <ApplicationLogo class="h-20 w-20 fill-current text-gray-500" />
                </Link>
            </li>
            <li v-for="(link, index) in navLinks" :key="index">
                <a :href="link.href" class="nav-link">{{ link.name }}</a>
            </li>
        </ul>

        <!-- Right Section -->
        <div class="navbar-right">
            <div @click="copyEmailToClipboard" class="contact-badge" style="cursor: pointer;">
                <i style="font-size:24px" class="fa">&#xf0c5;</i> uzbekbory@gmail.com
            </div>
        </div>
    </nav>
</template>
  
  
<style scoped>
    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 2rem;
        background-color: #fefefe;
        border-radius: 20px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    
    .navbar-left,
    .navbar-right {
        display: flex;
        align-items: center;
    }
    
    .status-badge,
    .contact-badge {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        background-color: #ffffff;
        padding: 0.5rem 1rem;
        border-radius: 15px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        font-size: 0.9rem;
        font-weight: 500;
    }

    .contact-badge:hover {
        background-color: #62a7ec70;
    }
    
    .status-dot {
        width: 10px;
        height: 10px;
        background-color: #28a745;
        border-radius: 50%;
        animation: statusDotBlink 1s ease-in-out infinite;
    }

    @keyframes statusDotBlink {
        0% {
            background-color: #28a745;
        }
        50% {
            background-color: #7da58680;
        }
        100% {
            background-color: #28a745;
        }
    }
    
    .navbar-center {
        list-style: none;
        display: flex;
        gap: 1.5rem;
        margin: 0;
        padding: 0;
    }
    
    .nav-link {
        text-decoration: none;
        color: #333;
        font-size: 1rem;
        font-weight: bolder;
        transition: color 0.3s ease;
    }
    
    .nav-link:hover {
        color: #007bff;
    }
    
    .contact-icon {
        font-size: 1.2rem;
    }

    .glass {
        /* From https://css.glass */
        background: rgba(255, 255, 255, 0.12);
        border-radius: 16px;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(8.6px);
        -webkit-backdrop-filter: blur(8.6px);
    }
</style>
  