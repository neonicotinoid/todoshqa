<template>
    <div class="p-4 bg-white border border-gray-200 hover:border-blue-300 rounded-lg duration-150"
         >
        <div class="flex items-center">
            <div>
                <a class="border-b border-blue-200 hover:border-blue-400"
                   :href="route('project.show', project.id)">{{ project.title }}</a>
                <div class="text-sm text-gray-600" v-if="project.description">
                    {{ project.description }}
                </div>
            </div>

            <div class="ml-auto">
                <button @click="$emit('openProjectEdit', project)">
                    <CogIcon class="w-5 h-5 text-gray-300"/>
                </button>
            </div>

        </div>
    </div>
</template>

<script>
import {CogIcon} from "@heroicons/vue/outline";
export default {
    name: "ProjectCard",
    emits: ['openProjectEdit'],
    components: {CogIcon},
    props: {
        project: {
            type: Object,
        }
    }
}
</script>
