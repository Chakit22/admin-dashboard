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

// Form for creating a new sneaker listing
const form = useForm({
    name: "",
    brand: "",
    size: "",
    price: "",
    image: null,
});

// Submit handler for creating a new sneaker
const submit = () => {
    form.post(route("products.store"), {
        onSuccess: () => {
            form.reset();
            form.clearErrors();
            // Force a full page reload to refresh the products list
            window.location.reload();
        },
        preserveScroll: true,
    });
};

// Handle image selection
const handleImageSelect = (event) => {
    const file = event.target.files[0];
    form.image = file;
};

// Delete handler
const deleteProduct = (productId) => {
    if (confirm("Are you sure you want to delete this sneaker listing?")) {
        form.delete(route("products.destroy", productId), {
            preserveScroll: true,
        });
    }
};
</script>

<template>
    <Head title="Products" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Sneaker Listings
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <!-- Create Sneaker Form -->
                <div class="mb-8 overflow-hidden rounded-xl bg-white shadow-lg">
                    <div class="p-6">
                        <div class="mb-6 flex items-center justify-between">
                            <h3 class="text-xl font-semibold text-gray-800">
                                Add New Sneaker
                            </h3>
                        </div>
                        <form @submit.prevent="submit" class="space-y-6">
                            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                                <div class="space-y-2">
                                    <InputLabel
                                        for="name"
                                        value="Sneaker Name"
                                        class="text-gray-700"
                                    />
                                    <TextInput
                                        id="name"
                                        v-model="form.name"
                                        type="text"
                                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        placeholder="Nike Dunk Low Panda"
                                        required
                                    />
                                    <InputError
                                        :message="form.errors.name"
                                        class="mt-1"
                                    />
                                </div>

                                <div class="space-y-2">
                                    <InputLabel
                                        for="brand"
                                        value="Brand"
                                        class="text-gray-700"
                                    />
                                    <TextInput
                                        id="brand"
                                        v-model="form.brand"
                                        type="text"
                                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        placeholder="Nike"
                                        required
                                    />
                                    <InputError
                                        :message="form.errors.brand"
                                        class="mt-1"
                                    />
                                </div>

                                <div class="space-y-2">
                                    <InputLabel
                                        for="size"
                                        value="Size"
                                        class="text-gray-700"
                                    />
                                    <TextInput
                                        id="size"
                                        v-model="form.size"
                                        type="text"
                                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        placeholder="US 10"
                                        required
                                    />
                                    <InputError
                                        :message="form.errors.size"
                                        class="mt-1"
                                    />
                                </div>

                                <div class="space-y-2">
                                    <InputLabel
                                        for="price"
                                        value="Price"
                                        class="text-gray-700"
                                    />
                                    <TextInput
                                        id="price"
                                        v-model="form.price"
                                        type="number"
                                        step="0.01"
                                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        placeholder="199.99"
                                        required
                                    />
                                    <InputError
                                        :message="form.errors.price"
                                        class="mt-1"
                                    />
                                </div>
                            </div>

                            <div class="space-y-2">
                                <InputLabel
                                    for="image"
                                    value="Sneaker Image"
                                    class="text-gray-700"
                                />
                                <input
                                    type="file"
                                    id="image"
                                    @input="handleImageSelect"
                                    accept="image/*"
                                    class="mt-1 block w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-blue-500"
                                    required
                                />
                                <InputError
                                    :message="form.errors.image"
                                    class="mt-1"
                                />
                                <p class="mt-1 text-sm text-gray-500">
                                    Accepted formats: JPEG, PNG, JPG, GIF (max
                                    2MB)
                                </p>
                            </div>

                            <div class="flex justify-end">
                                <PrimaryButton
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing"
                                    class="bg-blue-600 px-6 py-3 text-base hover:bg-blue-700 focus:ring-blue-500"
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
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                                        />
                                    </svg>
                                    Add Sneaker
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Sneakers Grid -->
                <div class="overflow-hidden rounded-xl bg-white shadow-lg">
                    <div class="p-6">
                        <div class="mb-6 flex items-center justify-between">
                            <h3 class="text-xl font-semibold text-gray-800">
                                All Sneakers
                            </h3>
                        </div>

                        <div
                            v-if="products.length > 0"
                            class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3"
                        >
                            <div
                                v-for="product in products"
                                :key="product.id"
                                class="group relative transform overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm transition-all duration-300 hover:shadow-lg"
                            >
                                <div
                                    class="aspect-w-16 aspect-h-9 w-full bg-gray-200"
                                >
                                    <img
                                        v-if="product.image_url"
                                        :src="product.image_url"
                                        :alt="product.name"
                                        class="h-64 w-full object-cover transition-transform duration-300 group-hover:scale-105"
                                    />
                                    <div
                                        v-else
                                        class="flex h-64 w-full items-center justify-center bg-gray-100"
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
                                    <div
                                        class="mb-2 flex items-start justify-between"
                                    >
                                        <div>
                                            <h4
                                                class="text-lg font-semibold text-gray-900"
                                            >
                                                {{ product.name }}
                                            </h4>
                                            <div
                                                class="mt-1 flex items-center text-sm text-gray-600"
                                            >
                                                <span
                                                    class="font-medium text-gray-800"
                                                    >{{ product.brand }}</span
                                                >
                                                <span class="mx-2">•</span>
                                                <span
                                                    >Size
                                                    {{ product.size }}</span
                                                >
                                            </div>
                                        </div>
                                        <span
                                            class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium"
                                            :class="
                                                product.is_approved
                                                    ? 'bg-green-100 text-green-800'
                                                    : 'bg-orange-100 text-orange-800'
                                            "
                                        >
                                            {{
                                                product.is_approved
                                                    ? "Approved"
                                                    : "Pending"
                                            }}
                                        </span>
                                    </div>

                                    <div
                                        class="mb-4 text-lg font-bold text-gray-900"
                                    >
                                        ${{ product.price }}
                                    </div>

                                    <div class="flex space-x-2">
                                        <Link
                                            v-if="!product.is_approved"
                                            :href="
                                                route(
                                                    'products.toggle-approval',
                                                    product.id
                                                )
                                            "
                                            method="post"
                                            as="button"
                                            class="inline-flex flex-1 items-center justify-center rounded-lg bg-green-600 px-3 py-2 text-sm font-medium text-white transition-colors duration-300 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
                                        >
                                            <svg
                                                class="mr-2 h-4 w-4"
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
                                        <button
                                            @click="deleteProduct(product.id)"
                                            class="inline-flex items-center justify-center rounded-lg bg-red-100 px-3 py-2 text-sm font-medium text-red-600 transition-colors duration-300 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                                        >
                                            <svg
                                                class="h-4 w-4"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                                />
                                            </svg>
                                        </button>
                                    </div>
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
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"
                                />
                            </svg>
                            <p class="text-gray-500">No sneakers listed yet.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
