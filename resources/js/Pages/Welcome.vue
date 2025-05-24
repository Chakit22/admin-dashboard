<script setup>
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

function handleImageError() {
    document.getElementById("screenshot-container")?.classList.add("!hidden");
    document.getElementById("docs-card")?.classList.add("!row-span-1");
    document.getElementById("docs-card-content")?.classList.add("!flex-row");
    document.getElementById("background")?.classList.add("!hidden");
}
</script>

<template>
    <Head title="SneakPeek - Premium Sneaker Marketplace" />

    <div class="min-h-screen bg-white">
        <!-- Navigation -->
        <nav class="container mx-auto px-6 py-4 border-b">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <span class="text-2xl font-bold text-gray-900"
                        >SneakPeek</span
                    >
                </div>

                <div v-if="canLogin" class="flex items-center space-x-4">
                    <template v-if="$page.props.auth.user">
                        <Link
                            :href="route('dashboard.index')"
                            class="rounded-lg bg-gray-900 px-6 py-2 font-semibold text-white transition-all hover:bg-gray-800"
                        >
                            Dashboard
                        </Link>
                    </template>
                    <template v-else>
                        <Link
                            :href="route('login')"
                            class="text-gray-600 transition-all hover:text-gray-900"
                        >
                            Log in
                        </Link>
                        <Link
                            v-if="canRegister"
                            :href="route('register')"
                            class="rounded-lg bg-gray-900 px-6 py-2 font-semibold text-white transition-all hover:bg-gray-800"
                        >
                            Register
                        </Link>
                    </template>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="container mx-auto px-6 py-16 text-center md:py-32">
            <h1 class="mb-4 text-5xl font-bold text-gray-900 md:text-6xl">
                Welcome to SneakPeek
            </h1>
            <p class="mb-8 text-xl text-gray-600">
                Your Premium Destination for Exclusive Sneakers
            </p>
            <div class="flex justify-center space-x-4">
                <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class="rounded-lg bg-gray-900 px-8 py-3 font-semibold text-white transition-all hover:bg-gray-800"
                >
                    Get Started
                </Link>
            </div>
        </div>

        <!-- Features Section -->
        <div class="container mx-auto px-6 py-16">
            <div class="grid gap-8 md:grid-cols-3">
                <!-- Feature 1 -->
                <div
                    class="rounded-lg border p-6 shadow-sm transition-all hover:shadow-md"
                >
                    <div
                        class="mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-gray-100"
                    >
                        <svg
                            class="h-6 w-6 text-gray-900"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"
                            ></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-semibold text-gray-900">
                        Premium Selection
                    </h3>
                    <p class="text-gray-600">
                        Curated collection of the most exclusive and rare
                        sneakers from top brands
                    </p>
                </div>

                <!-- Feature 2 -->
                <div
                    class="rounded-lg border p-6 shadow-sm transition-all hover:shadow-md"
                >
                    <div
                        class="mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-gray-100"
                    >
                        <svg
                            class="h-6 w-6 text-gray-900"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"
                            ></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-semibold text-gray-900">
                        Authenticity Guaranteed
                    </h3>
                    <p class="text-gray-600">
                        Every pair is verified by our expert team for 100%
                        authenticity
                    </p>
                </div>

                <!-- Feature 3 -->
                <div
                    class="rounded-lg border p-6 shadow-sm transition-all hover:shadow-md"
                >
                    <div
                        class="mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-gray-100"
                    >
                        <svg
                            class="h-6 w-6 text-gray-900"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"
                            ></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-semibold text-gray-900">
                        Fast Delivery
                    </h3>
                    <p class="text-gray-600">
                        Quick and secure shipping to get your sneakers to you as
                        fast as possible
                    </p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="border-t bg-gray-50">
            <div class="container mx-auto px-6 py-8">
                <div
                    class="flex flex-col items-center justify-between md:flex-row"
                >
                    <div class="mb-6 text-sm text-gray-600 md:mb-0">
                        © 2025 SneakPeek. All rights reserved.
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>
