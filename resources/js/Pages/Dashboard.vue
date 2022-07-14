<template>
    <NavHeader :user="auth.user"/>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <div class="text-3xl font-semibold mb-6">
                Ваши проекты
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
                <ProjectCard v-for="project in projects" :project="project" :key="project.id" @openProjectEdit="openProjectEdit"/>
            </TransitionGroup>
        </div>
    </div>

</template>

<script>
import NavHeader from "@/components/NavHeader";
import ProjectCard from "@/components/ProjectCard";
export default {
    components: {NavHeader, ProjectCard},
    props: {
        auth: {
            user: {
                type: Object,
            }
        },
        projects: {
            type: Array,
            required: true,
        }
    }
}
</script>
