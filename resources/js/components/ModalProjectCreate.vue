<template>
    <TModal :showing="open">
        <form @submit.prevent="createProject">
            <div>
                <TextInput v-model="projectForm.title" />
            </div>
            <div>
                <TextInput v-model="projectForm.description"/>
            </div>
            <div class="mt-6">
                <TButton>Создать проект</TButton>
            </div>
        </form>
    </TModal>
</template>

<script>
import TextInput from "@/components/Form/TextInput";
import TModal from "@/components/TModal";
import TButton from "@/components/TButton";

export default {
    name: "ModalProjectCreate",
    components: {TButton, TextInput, TModal},
    props: {
        open: {
            type: Boolean,
            default: false,
        },
    },
    data() {
        return {
            projectForm: this.$inertia.form({
                title: '',
                description: '',
            })
        }
    },
    methods: {
        createProject() {
            this.projectForm.post(route('project.store'), {
                onSuccess: () => {this.$emit('close');}
            })
        }
    }
}
</script>

<style scoped>

</style>
