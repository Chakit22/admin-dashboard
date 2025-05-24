<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

// Define props to receive products from the backend
const props = defineProps({
    products: {
        type: Array,
        default: () => [],
    },
});

// Form for creating a new product
const form = useForm({
    name: "",
    price: "",
    image_url: "",
});

// Submit handler for creating a new product
const submit = () => {
    form.post(route("products.store"), {
        onFinish: () => form.reset(),
        preserveScroll: true,
    });
};

// Delete handler
const deleteProduct = (productId) => {
    if (confirm("Are you sure you want to delete this product?")) {
        form.delete(route("products.destroy", productId), {
            preserveScroll: true,
        });
    }
};
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Products
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <!-- Create Product Form -->
                <div
                    class="mb-8 overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                        <h3 class="mb-4 text-lg font-medium">
                            Create New Product
                        </h3>
                        <form @submit.prevent="submit" class="space-y-4">
                            <div>
                                <InputLabel for="name" value="Name" />
                                <TextInput
                                    id="name"
                                    v-model="form.name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    required
                                />
                                <InputError
                                    :message="form.errors.name"
                                    class="mt-2"
                                />
                            </div>

                            <div>
                                <InputLabel for="price" value="Price" />
                                <TextInput
                                    id="price"
                                    v-model="form.price"
                                    type="number"
                                    step="0.01"
                                    class="mt-1 block w-full"
                                    required
                                />
                                <InputError
                                    :message="form.errors.price"
                                    class="mt-2"
                                />
                            </div>

                            <div>
                                <InputLabel for="image_url" value="Image URL" />
                                <TextInput
                                    id="image_url"
                                    v-model="form.image_url"
                                    type="url"
                                    class="mt-1 block w-full"
                                    required
                                />
                                <InputError
                                    :message="form.errors.image_url"
                                    class="mt-2"
                                />
                            </div>

                            <div class="flex justify-end">
                                <PrimaryButton
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing"
                                >
                                    Create Product
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Products List -->
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="mb-4 text-lg font-medium">Products List</h3>
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
                                            Price
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                        >
                                            Image
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                        >
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody
                                    class="divide-y divide-gray-200 bg-white"
                                >
                                    <tr
                                        v-for="product in products"
                                        :key="product.id"
                                    >
                                        <td class="whitespace-nowrap px-6 py-4">
                                            {{ product.name }}
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4">
                                            ${{ product.price }}
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4">
                                            <img
                                                v-if="product.image_url"
                                                :src="product.image_url"
                                                :alt="product.name"
                                                class="h-10 w-10 rounded-full"
                                            />
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4">
                                            <button
                                                @click="
                                                    deleteProduct(product.id)
                                                "
                                                class="text-red-600 hover:text-red-900"
                                            >
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                    <tr v-if="products.length === 0">
                                        <td
                                            colspan="4"
                                            class="px-6 py-4 text-center text-gray-500"
                                        >
                                            No products found.
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
