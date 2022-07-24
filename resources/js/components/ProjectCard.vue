<template>
    <div class="p-4 bg-white border border-gray-200 hover:border-blue-300 rounded-lg duration-150"
         >
        <div class="flex items-center">
            <div>
                <a class="border-b border-blue-200 hover:border-blue-400"
                   :href="route('projects.show', project.id)">{{ project.title }}</a>
                <div class="text-sm text-gray-600" v-if="project.description">
                    {{ project.description }}
                </div>
            </div>

            <div v-if="this.withActions" class="ml-auto">
                <button @click="showEditModal = true">
                    <CogIcon class="w-5 h-5 text-gray-300"/>
                </button>
            </div>

        </div>

        <ModalProjectEdit
            v-if="showEditModal"
            :open="showEditModal"
            :project="this.project"
            @close="showEditModal = false"
        />
    </div>
</template>

<script>
import {CogIcon} from "@heroicons/vue/outline";
import ModalProjectEdit from "@/components/ModalProjectEdit";

export default {
    name: "ProjectCard",
    emits: ['openProjectEdit'],
    components: {CogIcon, ModalProjectEdit},
    props: {
        project: {
            type: Object,
        },
        withActions: {
            type: Boolean,
            default: true,
        },
    },
    data() {
        return {
            showEditModal: false,
        }
    },
}
</script>
