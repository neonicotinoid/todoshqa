<template>
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 sm:items-center sm:pt-0">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            <div class="space-y-4">
                <ProjectCard v-for="project in ownProjects" :project="project"/>
            </div>

            <div>
                <h3>
                    Расшаренные компоненты
                </h3>
                <div class="space-y-4">
                    <ProjectCard v-for="project in sharedProjects" :project="project"/>
                </div>
            </div>

        </div>
    </div>
</template>

<script>

import ProjectCard from "@/components/ProjectCard";
export default {
    name: "Projects",
    components: {ProjectCard},
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
