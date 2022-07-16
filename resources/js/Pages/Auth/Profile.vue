<template xmlns="http://www.w3.org/1999/html">
    <div>
        <NavHeader :user="this.auth.user"/>

            <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                <div class="text-3xl mt-6 font-semibold mb-6">
                    Редактировать профиль
                </div>
            <form class="grid grid-cols-1 md:grid-cols-4 gap-y-6 md:gap-y-0 md:gap-x-6" @submit.prevent="submitProfileForm">
                <div class="col-span-3 bg-white shadow rounded-lg p-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 md:gap-x-6">
                        <div>
                            <FormGroup label="Имя пользователя" :error="this.errors.name">
                                <TextInput v-model="profileForm.name" :is-error="Boolean(this.errors.name)"/>
                            </FormGroup>
                        </div>

                        <div>
                            <FormGroup label="Email" :error="this.errors.email">
                                <TextInput v-model="profileForm.email" :is-error="Boolean(this.errors.email)"/>
                            </FormGroup>
                        </div>
                    </div>

                    <div>
                        <div class="text-xl mb-4 mt-2 border-b border-gray-100 text-gray-800 font-semibold">
                            Изменить пароль
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 md:gap-x-6">
                                <FormGroup label="Новый пароль" :error="this.errors.password">
                                    <TextInput v-model="profileForm.password" :is-error="Boolean(this.errors.password)" disabled=""/>
                                </FormGroup>

                                <FormGroup label="Подтверждение пароля" :error="this.errors.password_confirmation">
                                    <TextInput v-model="profileForm.password_confirmation" :is-error="Boolean(this.errors.password_confirmation)" disabled=""/>
                                </FormGroup>

                        </div>

                    </div>
                    <TButton>Обновить данные</TButton>
                </div>

                <div class="col-span-1">
                    <div class="bg-white shadow rounded-lg p-4 h-full" x-data>
                        <div class="text-xl mb-4 border-b border-gray-100 text-gray-800 font-semibold">
                            Фото профиля
                        </div>

                        <div class="mx-auto">
                            <div v-if="profile.avatar" class="relative mx-auto rounded-full">
                                <Transition
                                    enter-active-class="transition ease-out duration-1000"
                                    enter-from-class="opacity-0"
                                    enter-to-class="opacity-100"
                                    leave-active-class="transition ease-in duration-300"
                                    leave-from-class="opacity-100 translate-y-100"
                                    leave-to-class="opacity-0 translate-y-95"
                                    appear
                                >
                                <div class="relative w-24 h-24 mx-auto mb-4">
                                    <img :src="profile.avatar.original_url"
                                         class="block mx-auto w-24 h-24 rounded-full">
                                    <button @click.prevent="removeAvatar"
                                        title="Удалить ааватр" class="absolute right-0 bottom-0 bg-red-100 border border-red-300 rounded-full p-1">
                                        <TrashIcon class="text-red-300 w-5 h-5"/>
                                    </button>
                                </div>
                            </Transition>
                            </div>
                            <div v-else>
                                <AvatarPlaceholder class="w-24 h-24 mx-auto" :fill="profile.avatarPlaceholderColor" :initials="profile.initials"/>
                            </div>
                            <div v-if="avatarForm.avatarFileName" class="text-sm text-gray-700 font-medium mt-6">
                                Выбран файл: {{ avatarForm.avatarFileName }}
                            </div>
                        </div>

                        <div class="mt-4 space-y-2">
                            <TButton size="xs"
                                     class="w-full"
                                     @click.prevent="this.$refs.avatarInput.click()"
                                     color="white">
                                Выбрать файл
                            </TButton>

                            <TButton @click.prevent="uploadAvatar" size="xs" class="w-full" v-bind:disabled="!avatarForm.avatar">
                                Загрузить
                            </TButton>

                        </div>

                        <input ref="avatarInput"
                               type="file"
                               @change="avatarForm.avatar = $event.target.files[0];
                               avatarForm.avatarFileName = $event.target.files[0].name"
                               accept="image/png, image/jpeg, image/jpg, image/bmp, image/webp"
                               hidden/>
                        <progress class="w-full" v-if="profileForm.progress" :value="profileForm.progress.percentage" max="100">
                            {{ profileForm.progress.percentage }}%
                        </progress>

                    </div>
                </div>

                <div class="col-span-full md:mt-4">
                    <div class="text-gray-400 text-sm">
                        <div class="w-full">
                            <span class="font-medium">Вы зарегистрировались: {{profile.created_at}}</span>
                        </div>
                    </div>
                </div>

            </form>
                </div>
        </div>

</template>

<script>
import NavHeader from "@/components/NavHeader";
import FormGroup from "@/components/Form/FormGroup";
import TextInput from "@/components/Form/TextInput";
import TButton from "@/components/TButton";
import AvatarPlaceholder from "@/components/AvatarPlaceholder";
import {TrashIcon} from "@heroicons/vue/solid";

export default {
    name: "Profile",
    components: {AvatarPlaceholder, TButton, TextInput, FormGroup, NavHeader, TrashIcon},
    props: {
        profile: {
            type: Object,
        },
        errors: {
            type: Object,
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
            avatarForm: this.$inertia.form({
               avatar: null,
               avatarFileName: '',
            }),
            profileForm: this.$inertia.form({
               name: this.profile.name,
               email: this.profile.email,
               password: '',
               password_confirmation: '',
            }),
        }
    },
    methods: {
        submitProfileForm() {
            this.profileForm.post(route('user.update', this.profile.id));
        },
        removeAvatar() {
            this.$inertia.delete(route('user.removeAvatar', this.profile.id));
        },
        uploadAvatar() {
            this.avatarForm.post(route('user.uploadAvatar', this.profile.id), {
                onSuccess: () => {this.avatarForm.reset();}
            });
        },
    }
}
</script>
