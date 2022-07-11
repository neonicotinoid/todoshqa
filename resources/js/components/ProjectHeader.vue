<template>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <div>
                <h1 class="text-xl md:text-3xl font-bold text-gray-900">
                    {{ project.title }}
                </h1>
                <div v-if="project.description" class="text-xs md:text-sm text-gray-400 mt-2">
                    {{ project.description }}
                </div>
            </div>
            <div class="space-x-1">
                <button  class="w-6 h-6 inline-flex justify-center items-center shadow-sm bg-white border border-gray-200 rounded p-1">
                    <ShareIcon class="w-5 h-5 text-gray-300"/>
                </button>
                <button class="w-6 h-6 inline-flex justify-center items-center shadow-sm bg-white border border-gray-200 rounded p-1">
                    <CogIcon class="w-5 h-5 text-gray-300"/>
                </button>
            </div>
        </div>
    </header>
</template>

<script>
import {ShareIcon, CogIcon} from "@heroicons/vue/solid";

export default {
    name: "ProjectHeader",
    components: {ShareIcon, CogIcon},
    props: {
        project: {
            type: Object,
            required: true,
        }
    }
}
</script>

