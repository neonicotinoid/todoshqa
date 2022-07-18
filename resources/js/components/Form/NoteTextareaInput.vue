<template>
    <textarea :value="modelValue"
              @input="$emit('update:modelValue', $event.target.value)"
              class="block mt-1.5 bg-yellow-50 w-full px-3 py-2.5 rounded-lg outline-none border border-yellow-200 shadow-sm
                    hover:border-yellow-300
                    placeholder:text-gray-400 placeholder:font-normal
                    focus:ring-1 focus:ring-yellow-500 focus:border-yellow-500 ring-inset
                    disabled:bg-gray-200 disabled:text-white disabled:cursor-not-allowed disabled:hover:border-gray-300
                    duration-150"
              :class="{'ring-1 ring-red-500 border-red-500' : isError} "
    ></textarea>
</template>

<script>
export default {
    name: "NoteTextareaInput",
    props: {
        modelValue: {},
        isError: {
            type: Boolean,
            default: false,
        },
        rows: {
            type: Number,
        },
        cols: {
            type: Number,
        },
    },
    emits: ['update:modelValue'],
}
</script>
