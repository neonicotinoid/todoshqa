<template>
    <TModal :showing="open">
        <div>

            <div>
                <div class="text-lg font-semibold text-gray-900 mb-4">
                    Настройки доступа к проекту
                </div>
                <div>
                    <div class="text-sm text-gray-900 font-medium">
                        Владелец проекта:
                    </div>

                </div>
                <div class="mt-2">
                    <UserCard :user="project.user"/>
                </div>

                <div v-if="project.users.length > 0" class="mt-8">
                    <div class="text-sm text-gray-900 font-medium">
                        Пользователи с доступом к проекту
                    </div>

                    <div class="mt-2 space-y-1">
                        <TransitionGroup
                            enter-active-class="transition ease-out duration-300"
                            enter-from-class="opacity-0 translate-y-95"
                            enter-to-class="opacity-100 translate-y-100"
                            leave-active-class="transition ease-in duration-300"
                            leave-from-class="opacity-100 translate-y-100"
                            leave-to-class="opacity-0 translate-y-95"
                            appear>

                            <UserCard v-for="user in project.users" :user="user" :key="user.id">
                                <template v-slot:actions>
                                    <button
                                        @click.prevent="unshareProject(user.id)"
                                        class="text-red-600 w-5 h-5 ml-auto"
                                        title="Удалить доступ у пользователя">
                                        <UserRemoveIcon/>
                                    </button>
                                </template>
                            </UserCard>
                        </TransitionGroup>
                    </div>
                </div>

                <div v-else class="mt-5">
                    <div class="inline-block px-3 py-0.5 bg-green-100 rounded-xl text-sm text-green-700 font-medium">
                        Проект приватный, к нему есть доступ только у вас
                    </div>
                </div>

                <div class="mt-8">
                    <div class="text-sm text-gray-900 font-medium">
                        Предоставить доступ
                    </div>

                    <form @submit.prevent="shareProject">
                        <FormGroup label="Email пользователя" for="email-for-sharing" :error="this.shareForm.errors.email">
                            <TextInput v-model="shareForm.email" id="email-for-sharing" :is-error="Boolean(this.shareForm.errors.email)" placeholder="user@email.com"/>
                        </FormGroup>
                        <div class="mt-4">
                            <TButton>Дать доступ</TButton>
                        </div>
                    </form>
                </div>



            </div>
        </div>
    </TModal>
</template>

<script>
import TModal from "@/components/TModal";
import {UserRemoveIcon} from "@heroicons/vue/solid";
import FormGroup from "@/components/Form/FormGroup";
import TextInput from "@/components/Form/TextInput";
import TButton from "@/components/TButton";
import UserCard from "@/components/UserCard";

export default {
    name: "ModalProjectSharing",
    components: {UserCard, TButton, TextInput, FormGroup, TModal, UserRemoveIcon},
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
            shareForm: this.$inertia.form({
                email: '',
            })
        }
    },
    methods: {
        shareProject() {
            this.shareForm.post(route('projects.share', this.project.id), {
                onSuccess: () => {this.shareForm.reset();}
            })
        },
        unshareProject(userId) {
            this.$inertia.post(route('projects.unshare', this.project.id), {
                user_id: userId,
            });
        },
    },
}
</script>
