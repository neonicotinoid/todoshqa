<template>
    <div>
        <label class="block text-sm text-gray-500" :for="this.for">
            {{ label }}
        </label>
        <slot/>
    </div>
</template>

<script>
export default {
    name: "FormGroup",
    props: {
        label: {
            type: String,
        },
        for: {
            type: String,
        },
    },
}
</script>
