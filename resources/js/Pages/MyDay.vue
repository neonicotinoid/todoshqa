<template>
    <div>
        <NavHeader/>
        <main>
            <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                <div>
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
                    <TTask v-for="task in tasks" :task="task" :key="task.id"/>
                    </TransitionGroup>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
import NavHeader from "@/components/NavHeader";
import TTask from "@/components/TTask";

export default {
    name: "MyDay",
    components: {TTask, NavHeader},
    props: {
        tasks: {
            type: Array,
        }
    }
}
</script>
