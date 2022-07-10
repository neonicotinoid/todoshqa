<template>
    <div class="p-4 bg-white border border-gray-200 hover:border-blue-300 rounded-lg duration-150"
         >
        <div>
            <a class="border-b border-blue-200 hover:border-blue-400"
               :href="route('project.show', project.id)">{{ project.title }}</a>
            <div class="text-sm text-gray-600" v-if="project.description">
                {{ project.description }}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ProjectCard",
    props: {
        project: {
            type: Object,
        }
    }
}
</script>
