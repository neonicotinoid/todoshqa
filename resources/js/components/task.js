import th from "vanillajs-datepicker/locales/th";

export default () => ({
    init() {
        Livewire.on('task-updated', (task) => {
            if(this.$wire.get('taskId') === task) {
                this.$wire.refreshTask();
            }
        });
    },
    openTask: function (id) {
        this.$wire.openTask(id)
            .then(() => {

            });
    },

    toggleTaskState: function (id) {
        this.$wire.toggleTaskState(id).then(() => {
            document.querySelectorAll('div[x-task]')[0].focus()}
        );
    },
    focusNextTask: function () {
        let tasks = document.querySelectorAll('div[x-task]'),
            currentTask = Array.from(tasks).indexOf(this.$refs.task);
        if ((currentTask + 1) === tasks.length || currentTask >=tasks.length) {

        } else {
            tasks[currentTask + 1].focus();
        }

    },

    focusPrevTask: function () {
        let tasks = document.querySelectorAll('div[x-task]'),
            currentTask = Array.from(tasks).indexOf(this.$refs.task);

        if (currentTask > 0) {
            tasks[currentTask - 1].focus();
        }
    },
});
