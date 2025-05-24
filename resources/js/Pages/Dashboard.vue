<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

// Define props to receive stats and pending products from the backend
const props = defineProps({
    stats: {
        type: Object,
        default: () => ({
            total: 0,
            pending: 0,
            approved: 0,
        }),
    },
    pendingProducts: {
        type: Array,
        default: () => [],
    },
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                SneakPeek Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <!-- Stats Overview - Modern Grid Cards -->
                <div
                    class="mb-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3"
                >
                    <!-- Total Listings Card -->
                    <div
                        class="transform rounded-xl bg-white p-6 shadow-lg transition-all duration-300 hover:scale-105 hover:shadow-xl"
                    >
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">
                                    Total Listings
                                </h3>
                                <p
                                    class="mt-2 text-3xl font-bold text-gray-900"
                                >
                                    {{ stats.total }}
                                </p>
                            </div>
                            <div class="rounded-full bg-blue-100 p-3">
                                <svg
                                    class="h-6 w-6 text-blue-600"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"
                                    />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Approval Card -->
                    <div
                        class="transform rounded-xl bg-white p-6 shadow-lg transition-all duration-300 hover:scale-105 hover:shadow-xl"
                    >
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">
                                    Pending Approval
                                </h3>
                                <p
                                    class="mt-2 text-3xl font-bold text-orange-600"
                                >
                                    {{ stats.pending }}
                                </p>
                            </div>
                            <div class="rounded-full bg-orange-100 p-3">
                                <svg
                                    class="h-6 w-6 text-orange-600"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                    />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Approved Card -->
                    <div
                        class="transform rounded-xl bg-white p-6 shadow-lg transition-all duration-300 hover:scale-105 hover:shadow-xl"
                    >
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">
                                    Approved
                                </h3>
                                <p
                                    class="mt-2 text-3xl font-bold text-green-600"
                                >
                                    {{ stats.approved }}
                                </p>
                            </div>
                            <div class="rounded-full bg-green-100 p-3">
                                <svg
                                    class="h-6 w-6 text-green-600"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M5 13l4 4L19 7"
                                    />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Approvals - Grid Layout -->
                <div class="overflow-hidden rounded-xl bg-white shadow-lg">
                    <div class="p-6">
                        <h3 class="mb-6 text-xl font-semibold text-gray-800">
                            Pending Approvals
                        </h3>

                        <!-- Grid of Pending Products -->
                        <div
                            v-if="pendingProducts.length > 0"
                            class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3"
                        >
                            <div
                                v-for="product in pendingProducts"
                                :key="product.id"
                                class="transform overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm transition-all duration-300 hover:shadow-lg"
                            >
                                <div class="aspect-w-16 aspect-h-9 w-full">
                                    <img
                                        v-if="product.image_url"
                                        :src="product.image_url"
                                        :alt="product.name"
                                        class="h-48 w-full object-cover"
                                    />
                                    <div
                                        v-else
                                        class="flex h-48 w-full items-center justify-center bg-gray-100"
                                    >
                                        <svg
                                            class="h-12 w-12 text-gray-400"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                            />
                                        </svg>
                                    </div>
                                </div>

                                <div class="p-4">
                                    <h4
                                        class="mb-1 text-lg font-semibold text-gray-900"
                                    >
                                        {{ product.name }}
                                    </h4>
                                    <div
                                        class="mb-2 flex items-center text-sm text-gray-600"
                                    >
                                        <span
                                            class="font-medium text-gray-800"
                                            >{{ product.brand }}</span
                                        >
                                        <span class="mx-2">•</span>
                                        <span>Size {{ product.size }}</span>
                                    </div>
                                    <div
                                        class="mb-4 text-lg font-bold text-gray-900"
                                    >
                                        ${{ product.price }}
                                    </div>
                                    <Link
                                        :href="
                                            route(
                                                'products.toggle-approval',
                                                product.id
                                            )
                                        "
                                        method="post"
                                        as="button"
                                        class="inline-flex w-full items-center justify-center rounded-lg bg-green-600 px-4 py-2 text-sm font-medium text-white transition-colors duration-300 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
                                    >
                                        <svg
                                            class="mr-2 h-5 w-5"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M5 13l4 4L19 7"
                                            />
                                        </svg>
                                        Approve
                                    </Link>
                                </div>
                            </div>
                        </div>

                        <!-- Empty State -->
                        <div
                            v-else
                            class="flex flex-col items-center justify-center rounded-lg bg-gray-50 py-12"
                        >
                            <svg
                                class="mb-4 h-12 w-12 text-gray-400"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"
                                />
                            </svg>
                            <p class="text-gray-500">
                                No pending approvals at the moment.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
