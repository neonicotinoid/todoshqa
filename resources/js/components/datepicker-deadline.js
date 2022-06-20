import th from "vanillajs-datepicker/locales/th";

export default (title = null) => ({
    datepicker: null,
    isOpen: false,
    init() {
        this.datepicker = new window.Datepicker(this.$refs.datepickerInput, {
            title: title,
        });
    },

    wrapper: {
        ['@task-sidebar-open.window'](event) {
            if (this.$event.detail.deadline_date !== null) {
                this.datepicker.setDate(new Date(event.detail.deadline_date));
            } else {
                this.datepicker.setDate({clear: true});

            }
        },
    },
    datepickerElem: {
      ['@change-date.camel'](event) {
          this.$dispatch('input', event.detail.date);
          console.log(event.detail.date);
          if (event.detail.date) {
              this.$refs.wireable.value = formatDate(event.detail.date);
              this.$refs.wireable.dispatchEvent(new Event('input'));
              this.$refs.dateForUser.value = formatDate(event.detail.date);
          } else {
              this.$refs.dateForUser.value = null;
              this.$wire.call('resetDeadlineDateForOpenedTask');
          }
      },
      ['@input.prevent.stop']() {},
    },

    resetDate() {
        this.datepicker.setDate({clear:true});
    }


});
