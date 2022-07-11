<template>
    <TModal :showing="open">
        <form @submit.prevent>
            <div>
                <TextInput v-model="projectForm.title" />
            </div>
            <div>
                <TextInput v-model="projectForm.description"/>
            </div>
        </form>
    </TModal>
</template>

<script>
import TModal from "@/components/TModal";
import TextInput from "@/components/Form/TextInput";
export default {
    name: "ModalProjectEdit",
    components: {TextInput, TModal},
    props: {
        open: {
            type: Boolean,
            default: false,
        },
        project: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            projectForm: this.$inertia.form({
                title: this.project.title,
                description: this.project.description,
            })
        }
    },
    methods: {
        saveProject() {
            console.log('save project');
        },
    }
}
</script>

