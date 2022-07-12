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
                <button @click.prevent="this.projectSharing = true" class="w-6 h-6 inline-flex justify-center items-center shadow-sm bg-white border border-gray-200 rounded p-1">
                    <ShareIcon class="w-5 h-5 text-gray-300"/>
                </button>
                <button @click="this.projectEdit = true" class="w-6 h-6 inline-flex justify-center items-center shadow-sm bg-white border border-gray-200 rounded p-1">
                    <CogIcon class="w-5 h-5 text-gray-300"/>
                </button>
            </div>
        </div>
        <ModalProjectEdit
            v-if="projectEdit"
            :open="projectEdit"
            :project="this.project"
            @close="this.projectEdit = false"
        />

        <ModalProjectSharing
            v-if="projectSharing"
            :open="projectSharing"
            :project="this.project"
            @close="this.projectSharing = false"
        />
    </header>
</template>

<script>
import {ShareIcon, CogIcon} from "@heroicons/vue/solid";
import ModalProjectEdit from "@/components/ModalProjectEdit";
import ModalProjectSharing from "@/components/ModalProjectSharing";

export default {
    name: "ProjectHeader",
    components: {ModalProjectSharing, ModalProjectEdit, ShareIcon, CogIcon},
    props: {
        project: {
            type: Object,
            required: true,
        }
    },
    data() {
        return {
            projectEdit: false,
            projectSharing: false,
        }
    }
}
</script>

