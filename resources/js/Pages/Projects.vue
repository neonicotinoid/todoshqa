<template>
    <div>
        <NavHeader/>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mt-6">
                <div class="flex items-center justify-between">
                    <div class="text-3xl font-semibold mb-6">
                        Ваши проекты
                    </div>
                    <TButton>Создать проект</TButton>
                </div>
                <div class="space-y-4">
                    <ProjectCard v-for="project in ownProjects" :project="project"/>
                </div>
            </div>

            <div class="mt-6">
                <div class="flex items-center justify-between">
                    <div class="text-3xl font-semibold mb-6">
                        Проекты, к которым вам дали доступ
                    </div>
                </div>
                <div class="space-y-4">
                    <ProjectCard v-for="project in sharedProjects" :project="project"/>
                </div>
            </div>

        </div>
    </div>
</template>

<script>

import ProjectCard from "@/components/ProjectCard";
import NavHeader from "@/components/NavHeader";
import TButton from "@/components/TButton";
export default {
    name: "Projects",
    components: {TButton, NavHeader, ProjectCard},
    props: {
        ownProjects: {
            type: Array,
        },
        sharedProjects: {
            type: Array,
        }
    },
}
</script>
