<template>
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 sm:items-center sm:pt-0">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            <div class="space-y-4">
                <TTask v-for="task in this.tasks" :task="task"/>
            </div>

            <div>
                <TButton :pressable="true" size="lg">Button</TButton>
            </div>

        </div>
    </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3';
import TButton from "@/components/TButton";
import TTask from "@/components/TTask";

export default {
    components: {TTask, TButton},
    props: {
        tasks: {
            type: Array,
        }
    },
}

</script>
