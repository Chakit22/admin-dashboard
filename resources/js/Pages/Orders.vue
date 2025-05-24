<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

// Define props to recieve form backend
const props = defineProps({
    orders: {
        type: Array,
        default: () => [],
    },
});
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Orders
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="mb-4 text-lg font-medium">Orders List</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                        >
                                            Name
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                        >
                                            Email
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                        >
                                            Phone
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                        >
                                            Address
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                        >
                                            Total Price
                                        </th>
                                    </tr>
                                </thead>
                                <tbody
                                    class="divide-y divide-gray-200 bg-white"
                                >
                                    <tr v-for="order in orders" :key="order.id">
                                        <td class="whitespace-nowrap px-6 py-4">
                                            {{ order.name }}
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4">
                                            {{ order.email }}
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4">
                                            {{ order.phone }}
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4">
                                            {{ order.address }}
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4">
                                            ${{ order.total_price }}
                                        </td>
                                    </tr>
                                    <tr v-if="orders.length === 0">
                                        <td
                                            colspan="4"
                                            class="px-6 py-4 text-center text-gray-500"
                                        >
                                            No orders found.
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
