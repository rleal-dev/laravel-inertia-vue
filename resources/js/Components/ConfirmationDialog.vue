<script setup>
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';

const props = defineProps({
    show: Boolean,
    title: String,
    message: String,
});

const emit = defineEmits(["cancel", "confirm"]);
</script>

<template>
    <Modal :show="show" max-width="md">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ title }}</h2>
            <p class="text-gray-600 dark:text-gray-400">{{ message }}</p>
            
            <div class="mt-6 flex justify-end">
                <SecondaryButton @click="($event) => emit('cancel')">Cancel</SecondaryButton>

                <DangerButton class="ml-3" @click="($event) => emit('confirm')">
                    Confirm
                </DangerButton>
            </div>
        </div>
    </Modal>
</template>
