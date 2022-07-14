<template>
    <div>
        <NavHeader :user="this.auth.user"/>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mt-6">
                <div class="flex items-center justify-between">
                    <div class="text-3xl font-semibold mb-6">
                        Ваши проекты
                    </div>
                    <TButton @click.prevent="showCreateModal = true">Создать проект</TButton>
                </div>
                <div class="space-y-4">
                    <TransitionGroup
                        enter-active-class="transition ease-out duration-300"
                        enter-from-class="opacity-0 translate-y-95"
                        enter-to-class="opacity-100 translate-y-100"
                        leave-active-class="transition ease-in duration-300"
                        leave-from-class="opacity-100 translate-y-100"
                        leave-to-class="opacity-0 translate-y-95"
                        appear>
                    <ProjectCard v-for="project in ownProjects" :project="project" :key="project.id" @openProjectEdit="openProjectEdit"/>
                    </TransitionGroup>
                </div>
            </div>


            <div class="mt-6">
                <div class="flex items-center justify-between">
                    <div class="text-3xl font-semibold mb-6">
                        Проекты, к которым вам дали доступ
                    </div>
                </div>
                <div class="space-y-4">
                    <ProjectCard v-for="project in sharedProjects" :project="project" :key="project.id"/>
                </div>
            </div>

            <div class="mt-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center text-3xl text-gray-700 font-semibold mb-6">
                        <TrashIcon class="w-8 h-8 text-gray-300 mr-2"/>
                        <span>Корзина</span>
                    </div>
                </div>
                <div class="space-y-4">
                    <TransitionGroup
                        enter-active-class="transition ease-out duration-300"
                        enter-from-class="opacity-0 translate-y-95"
                        enter-to-class="opacity-100 translate-y-100"
                        leave-active-class="transition ease-in duration-300"
                        leave-from-class="opacity-100 translate-y-100"
                        leave-to-class="opacity-0 translate-y-95"
                        appear>
                        <TrashedProjectCard v-for="project in trashedProjects" :project="project" :key="project.id"/>
                    </TransitionGroup>
                </div>
            </div>

        </div>

        <ModalProjectCreate
            v-if="showCreateModal"
            :open="showCreateModal"
            @close="showCreateModal = false;" />

        <ModalProjectEdit
            v-if="showEditModal"
            :open="showEditModal"
            :project="this.editableProject"
            @close="showEditModal = false"
            />
    </div>
</template>

<script>

import ProjectCard from "@/components/ProjectCard";
import NavHeader from "@/components/NavHeader";
import TButton from "@/components/TButton";
import ModalProjectCreate from "@/components/ModalProjectCreate";
import ModalProjectEdit from "@/components/ModalProjectEdit";
import {TrashIcon} from "@heroicons/vue/solid";
import TrashedProjectCard from "@/components/TrashedProjectCard";
export default {
    name: "Projects",
    components: {TrashedProjectCard, ModalProjectEdit, ModalProjectCreate, TButton, NavHeader, ProjectCard, TrashIcon},
    props: {
        ownProjects: {
            type: Array,
        },
        sharedProjects: {
            type: Array,
        },
        trashedProjects: {
            type: Array,
        },
        auth: {
            type: Object,
            user: {
                type: Object,
            }
        }
    },
    data() {
        return {
            showCreateModal: false,
            showEditModal: false,
            editableProject: null,
        }
    },
    methods: {
        openProjectEdit(project) {
            this.editableProject = project;
            this.showEditModal = true;
        }
    }
}
</script>
