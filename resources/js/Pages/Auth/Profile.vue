<template xmlns="http://www.w3.org/1999/html">
    <div>
        <NavHeader :user="this.auth.user"/>

            <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                <div class="text-3xl mt-6 font-semibold mb-6">
                    Ваш профиль
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

                        <div>
                            <div v-if="profile.avatar" class="relative inline-block mx-auto w-24 h-24 mb-4 rounded-full">
                                <img :src="profile.avatar.original_url"
                                     class="inline-block mx-auto w-24 h-24 rounded-full">
                                <TButton @click.prevent="removeAvatar" color="red" size="xs">Удалить аватар</TButton>
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

                            <TButton @click.prevent="uploadAvatar" size="xs" class="w-full">
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

export default {
    name: "Profile",
    components: {AvatarPlaceholder, TButton, TextInput, FormGroup, NavHeader},
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
