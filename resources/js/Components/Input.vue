<script setup>
import { onMounted, ref } from 'vue';

const props = defineProps({
    modelValue: {
        type: String,
        default: '',
    },
    showOnly: {
        type: Boolean,
        default: false,
    },
    color: {
        type: String,
        default: null,
    },
    type: {
        type: String,
        default: 'text',
    },
    step: {
        type: String,
        default: 'text',
    },
    inputLabel: {
        type: String,
        default: null,
    },
    inputIcon: {
        type: String,
        default: null,
    }
});

const emit = defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

// Common base classes for all inputs
const baseClasses = 'bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 disabled:cursor-not-allowed';

// Color-specific classes
const colorClasses = {
    success: 'bg-green-50 border-green-500 text-green-900 dark:text-green-400 placeholder-green-700 dark:placeholder-green-500 focus:ring-green-500 focus:border-green-500',
    info: 'bg-blue-50 border-blue-500 text-blue-900 placeholder-blue-700 focus:ring-blue-500 dark:bg-gray-700 focus:border-blue-500 dark:text-blue-500 dark:placeholder-blue-500 dark:border-blue-500',
    warning: 'bg-yellow-50 border-yellow-500 text-yellow-900 placeholder-yellow-700 focus:ring-yellow-500 dark:bg-gray-700 focus:border-yellow-500 dark:text-yellow-500 dark:placeholder-yellow-500 dark:border-yellow-500',
    danger: 'bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500',
};
</script>

<template>
    <div class="flex flex-row p-0 border-none dark:bg-gray-800">
        <div v-if="inputLabel || inputIcon" class="flex w-14 bg-gray-50 dark:bg-gray-600 text-xs uppercase text-gray-600 dark:text-gray-300 font-extrabold border-y border-l border-gray-300 dark:border-gray-400 px-4 justify-center items-center text-center rounded-l-lg">
            <span v-if="inputLabel">{{ inputLabel }}</span>
            <span v-if="inputIcon"><i :class="inputIcon"></i></span>
        </div>
        <input
            :class="[baseClasses, colorClasses[color] || '', inputLabel || inputIcon ? 'rounded-l-none' : '']"
            :value="modelValue" :type="type" :step="step"
            @input="$emit('update:modelValue', $event.target.value)"
            ref="input"
        />
    </div>
</template>
