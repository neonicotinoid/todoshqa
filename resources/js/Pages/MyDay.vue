<template>
    <div>
        <Head>
            <title>
                Мой День
            </title>
        </Head>
        <NavHeader :user="this.auth.user"/>
        <MyDayHeader/>
        <main>
            <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                <div class="space-y-4 px-2 md:px-0">
                    <div class="flex justify-between">
                        <h2 class="text-xl font-semibold text-gray-500">
                            Задачи
                        </h2>
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
                    <TTask v-for="task in actualTasks" :task="task" :key="task.id"/>
                    </TransitionGroup>
                </div>

                    <div>
                        <div class="flex justify-between mb-4">
                            <h2 class="text-xl font-semibold text-gray-500">
                                Законченные задачи
                            </h2>
                            <TButton size="xs" color="white" @click.prevent="isShowCompleted = ! isShowCompleted">
                                {{ isShowCompleted ? 'Скрыть завершенные' : 'Показать завершенные'}}
                            </TButton>
                        </div>
                        <div v-if="isShowCompleted" class="space-y-4">
                            <TransitionGroup
                                enter-active-class="transition ease-out duration-300"
                                enter-from-class="opacity-0 translate-y-95"
                                enter-to-class="opacity-100 translate-y-100"
                                leave-active-class="transition ease-in duration-300"
                                leave-from-class="opacity-100 translate-y-100"
                                leave-to-class="opacity-0 translate-y-95"
                                appear>
                                <TTask v-for="task in completedTasks" :task="task" :key="task.id"/>
                            </TransitionGroup>
                        </div>
                    </div>
            </div>
            </div>
        </main>
    </div>
</template>

<script>
import NavHeader from "@/components/NavHeader";
import TTask from "@/components/TTask";
import MyDayHeader from "@/components/MyDay/MyDayHeader";
import TButton from "@/components/TButton";
import { Head } from "@inertiajs/inertia-vue3";

export default {
    name: "MyDay",
    components: {TButton, MyDayHeader, TTask, NavHeader, Head},
    props: {
        actualTasks: {
            type: Array,
        },
        completedTasks: {
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
            isShowCompleted: false,
        }
    }
}
</script>
