<template>
    <Head>
        <title>
            Todoshqa – ToDo app build with TailwindCSS, VueJS, Inertia and Laravel
        </title>
    </Head>
    <div class="bg-white">
        <Transition enter-active-class="transition duration-300"
                    enter-from-class="opacity-0 translate-y-95"
                    enter-to-class="opacity-100 translate-y-100"
                    leave-active-class="transition ease-in"
                    leave-from-class="opacity-100 translate-y-100"
                    leave-to-class="opacity-0 translate-y-95" appear>
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="pt-2 flex items-center justify-between">
                    <div class="flex items-center">
                        <img class="w-8 h-8" src="/css/icon.png" alt="">
                        <span class="ml-2 text-xl font-semibold text-purple-800">Todoshqa</span>
                    </div>

                    <div>
                        <a class="inline-flex items-center space-x-2 text-sm text-gray-600 group" href="https://github.com/neonicotinoid/todoshqa" target="_blank">
                            <svg class="w-6 h-6 text-gray-600 duration-150 group-hover:text-blue-700"
                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" fill="currentColor">
                                <path
                                    d="M15,3C8.373,3,3,8.373,3,15c0,5.623,3.872,10.328,9.092,11.63C12.036,26.468,12,26.28,12,26.047v-2.051 c-0.487,0-1.303,0-1.508,0c-0.821,0-1.551-0.353-1.905-1.009c-0.393-0.729-0.461-1.844-1.435-2.526 c-0.289-0.227-0.069-0.486,0.264-0.451c0.615,0.174,1.125,0.596,1.605,1.222c0.478,0.627,0.703,0.769,1.596,0.769 c0.433,0,1.081-0.025,1.691-0.121c0.328-0.833,0.895-1.6,1.588-1.962c-3.996-0.411-5.903-2.399-5.903-5.098 c0-1.162,0.495-2.286,1.336-3.233C9.053,10.647,8.706,8.73,9.435,8c1.798,0,2.885,1.166,3.146,1.481C13.477,9.174,14.461,9,15.495,9 c1.036,0,2.024,0.174,2.922,0.483C18.675,9.17,19.763,8,21.565,8c0.732,0.731,0.381,2.656,0.102,3.594 c0.836,0.945,1.328,2.066,1.328,3.226c0,2.697-1.904,4.684-5.894,5.097C18.199,20.49,19,22.1,19,23.313v2.734 c0,0.104-0.023,0.179-0.035,0.268C23.641,24.676,27,20.236,27,15C27,8.373,21.627,3,15,3z"/>
                            </svg>
                            <span class="group-hover:text-blue-700">Github</span>
                        </a>
                    </div>
                </div>

                <svg class="absolute top-10 right-0 text-gray-500 opacity-5 z-0" width="364" height="384"
                     viewBox="0 0 364 384" fill="none">
                    <defs>
                        <pattern id="eab71dd9-9d7a-47bd-8044-256344ee00d0" x="0" y="0" width="20" height="20"
                                 patternUnits="userSpaceOnUse">
                            <rect x="0" y="0" width="4" height="4" fill="currentColor"/>
                        </pattern>
                    </defs>
                    <rect width="364" height="384" fill="url(#eab71dd9-9d7a-47bd-8044-256344ee00d0)"/>
                </svg>

                <div class="mt-12 md:mt-32 grid grid-cols-1 md:grid-cols-2 gap-24">
                    <div>
                        <div class="text-3xl md:text-6xl font-bold">
                        <span class="bg-clip-text text-transparent bg-gradient-to-r from-slate-800 to-blue-800">
                            Тудушка
                        </span>
                        </div>
                        <div class="mt-6 text-lg md:text-2xl text-gray-800">
                            Демонстрационное TODO приложение, <br>
                            построенное на Laravel и VueJS через InertiaJS
                        </div>
                        <div class="mt-8 flex space-x-4 items-start">
                            <div v-if="isLoggedIn">
                                <TButton size="lg" color="blue">
                                    <Link :href="route('dashboard')" methid="get">
                                        К приложению
                                    </Link>
                                </TButton>
                                <div class="text-center text-xs mt-1 text-gray-500">
                                    <p>Вы вошли как:</p>
                                    <p class="font-semibold">
                                        {{ this.auth.user.name }}
                                    </p>
                                </div>
                            </div>

                            <div v-if="!isLoggedIn">
                                <TButton color="blue" size="lg">
                                    <Link :href="route('login')" method="get">
                                        Залогиниться
                                    </Link>
                                </TButton>
                            </div>

                            <TButton size="lg" color="white">
                                Документация
                            </TButton>
                        </div>
                    </div>
                    <div class="relative flex justify-center items-center">
                        <div class="absolute -top-6 left-12  animate-soar inline-block text-lg font-semibold shadow-xl shadow-purple-100 px-6 pt-2 pb-3 rounded-full transform"
                             style="background:linear-gradient(to right, #9553e9, #6d74ed);">
                            <svg class="block fill-current text-white" style="height:25px" viewBox="0 0 275.3 50.5">
                                <path d="M231.2 16.1h-17.8l17.2 17.2-17.2 17.2h17.8l17.2-17.2z"></path><path d="M258.1 16.1h-17.8l17.2 17.2-17.2 17.2h17.8l17.2-17.2z"></path><path d="M6 15.3h10.3l-6 34.2H0l6-34.2zm.6-9.1C7.2 2.9 10.3 0 13.7 0s5.7 2.8 5.2 6.2c-.5 3.4-3.7 6.2-7.2 6.2s-5.6-3-5.1-6.2zM54.3 28.5l-3.7 21H40.4L43.8 30c.8-4.4-1.6-6.2-4.9-6.2-3.4 0-6.5 2-7.5 6.6L28 49.5H17.8l6-34.2h10.3l-.5 3.2c2.3-2.6 6.2-4.2 10.1-4.2 6.9.1 12.2 5.1 10.6 14.2zM94.5 32.4c-.1.8-.5 2.7-1.1 4.1H68.9c.6 3.8 3.8 4.8 7 4.8 2.9 0 5.2-.8 7.2-2.7l7.2 5.9c-4 4-8.7 6-15 6-11.8 0-18-8.5-16.3-18.7a20.7 20.7 0 0 1 20.5-17.4c9.8 0 16.9 7.6 15 18zm-9.7-3.7c-.3-3.8-3-5.3-6.2-5.3a8.9 8.9 0 0 0-8.3 5.3h14.5zM123.9 14.6l-2 11.6c-4-.6-10.5.8-11.7 7.8l.1-.4-2.8 15.9H97.3l6-34.2h10.3l-1.1 6.2c2.1-4.7 6.6-6.9 11.4-6.9zM137.8 37.3c-.5 3.1 2 3.3 6.6 2.9l-1.6 9.3c-12.3 1.4-16.9-2.7-15.2-12.2l2.1-12.1h-5.5l1.8-9.9h5.4l1.2-6.5 10.8-3.1-1.7 9.6h7.1l-1.8 9.9h-7l-2.2 12.1zM155.3 15.3h10.3l-6 34.2h-10.3l6-34.2zm.6-9.1c.5-3.3 3.7-6.2 7.1-6.2s5.7 2.8 5.2 6.2c-.5 3.4-3.7 6.2-7.2 6.2s-5.7-3-5.1-6.2zM208.1 15.3l-6 34.2h-10.3l.4-2.3a15.5 15.5 0 0 1-10.3 3.3c-11.1 0-15.3-9.6-13.5-18.9 1.6-8.8 8.6-17.2 19.2-17.2 4.5 0 7.7 1.8 9.6 4.6l.6-3.6h10.3zm-13.2 17.2c.9-5.2-1.9-8.4-6.6-8.4a9.5 9.5 0 0 0-9.5 8.3c-.9 5.1 1.8 8.3 6.6 8.3 4.6.1 8.6-3.1 9.5-8.2z"></path></svg>

                        </div>
                        <div
                            class="flex items-center space-x-4 absolute -top-14 right-12 animate-soar inline-block text-lg font-semibold shadow-xl shadow-cyan-50 bg-white border border-[#77C1D2] px-8 py-2 rounded-full transform">

                            <svg class="logo" viewBox="0 0 128 128" width="24" height="24" data-v-b746bafa="">
                                <path fill="#42b883" d="M78.8,10L64,35.4L49.2,10H0l64,110l64-110C128,10,78.8,10,78.8,10z" data-v-b746bafa=""></path><path fill="#35495e" d="M78.8,10L64,35.4L49.2,10H25.6L64,76l38.4-66H78.8z" data-v-b746bafa=""></path></svg>
                            <span>
                                VueJS
                            </span>
                        </div>

                        <div
                            class="absolute -bottom-12 left-16 animate-soar inline-block text-lg font-semibold shadow-xl shadow-cyan-50 bg-white border border-[#38bdf8] p-2 rounded-full transform">
                            <svg viewBox="0 0 248 31" class="text-slate-900 w-48 h-auto">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M25.517 0C18.712 0 14.46 3.382 12.758 10.146c2.552-3.382 5.529-4.65 8.931-3.805 1.941.482 3.329 1.882 4.864 3.432 2.502 2.524 5.398 5.445 11.722 5.445 6.804 0 11.057-3.382 12.758-10.145-2.551 3.382-5.528 4.65-8.93 3.804-1.942-.482-3.33-1.882-4.865-3.431C34.736 2.92 31.841 0 25.517 0zM12.758 15.218C5.954 15.218 1.701 18.6 0 25.364c2.552-3.382 5.529-4.65 8.93-3.805 1.942.482 3.33 1.882 4.865 3.432 2.502 2.524 5.397 5.445 11.722 5.445 6.804 0 11.057-3.381 12.758-10.145-2.552 3.382-5.529 4.65-8.931 3.805-1.941-.483-3.329-1.883-4.864-3.432-2.502-2.524-5.398-5.446-11.722-5.446z"
                                      fill="#38bdf8"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M76.546 12.825h-4.453v8.567c0 2.285 1.508 2.249 4.453 2.106v3.463c-5.962.714-8.332-.928-8.332-5.569v-8.567H64.91V9.112h3.304V4.318l3.879-1.143v5.937h4.453v3.713zM93.52 9.112h3.878v17.849h-3.878v-2.57c-1.365 1.891-3.484 3.034-6.285 3.034-4.884 0-8.942-4.105-8.942-9.389 0-5.318 4.058-9.388 8.942-9.388 2.801 0 4.92 1.142 6.285 2.999V9.112zm-5.674 14.636c3.232 0 5.674-2.392 5.674-5.712s-2.442-5.711-5.674-5.711-5.674 2.392-5.674 5.711c0 3.32 2.442 5.712 5.674 5.712zm16.016-17.313c-1.364 0-2.477-1.142-2.477-2.463a2.475 2.475 0 012.477-2.463 2.475 2.475 0 012.478 2.463c0 1.32-1.113 2.463-2.478 2.463zm-1.939 20.526V9.112h3.879v17.849h-3.879zm8.368 0V.9h3.878v26.06h-3.878zm29.053-17.849h4.094l-5.638 17.849h-3.807l-3.735-12.03-3.771 12.03h-3.806l-5.639-17.849h4.094l3.484 12.315 3.771-12.315h3.699l3.734 12.315 3.52-12.315zm8.906-2.677c-1.365 0-2.478-1.142-2.478-2.463a2.475 2.475 0 012.478-2.463 2.475 2.475 0 012.478 2.463c0 1.32-1.113 2.463-2.478 2.463zm-1.939 20.526V9.112h3.878v17.849h-3.878zm17.812-18.313c4.022 0 6.895 2.713 6.895 7.354V26.96h-3.878V16.394c0-2.713-1.58-4.14-4.022-4.14-2.55 0-4.561 1.499-4.561 5.14v9.567h-3.879V9.112h3.879v2.285c1.185-1.856 3.124-2.749 5.566-2.749zm25.282-6.675h3.879V26.96h-3.879v-2.57c-1.364 1.892-3.483 3.034-6.284 3.034-4.884 0-8.942-4.105-8.942-9.389 0-5.318 4.058-9.388 8.942-9.388 2.801 0 4.92 1.142 6.284 2.999V1.973zm-5.674 21.775c3.232 0 5.674-2.392 5.674-5.712s-2.442-5.711-5.674-5.711-5.674 2.392-5.674 5.711c0 3.32 2.442 5.712 5.674 5.712zm22.553 3.677c-5.423 0-9.481-4.105-9.481-9.389 0-5.318 4.058-9.388 9.481-9.388 3.519 0 6.572 1.82 8.008 4.605l-3.34 1.928c-.79-1.678-2.549-2.749-4.704-2.749-3.16 0-5.566 2.392-5.566 5.604 0 3.213 2.406 5.605 5.566 5.605 2.155 0 3.914-1.107 4.776-2.749l3.34 1.892c-1.508 2.82-4.561 4.64-8.08 4.64zm14.472-13.387c0 3.249 9.661 1.285 9.661 7.89 0 3.57-3.125 5.497-7.003 5.497-3.591 0-6.177-1.607-7.326-4.177l3.34-1.927c.574 1.606 2.011 2.57 3.986 2.57 1.724 0 3.052-.571 3.052-2 0-3.176-9.66-1.391-9.66-7.781 0-3.356 2.909-5.462 6.572-5.462 2.945 0 5.387 1.357 6.644 3.713l-3.268 1.82c-.647-1.392-1.904-2.035-3.376-2.035-1.401 0-2.622.607-2.622 1.892zm16.556 0c0 3.249 9.66 1.285 9.66 7.89 0 3.57-3.124 5.497-7.003 5.497-3.591 0-6.176-1.607-7.326-4.177l3.34-1.927c.575 1.606 2.011 2.57 3.986 2.57 1.724 0 3.053-.571 3.053-2 0-3.176-9.66-1.391-9.66-7.781 0-3.356 2.908-5.462 6.572-5.462 2.944 0 5.386 1.357 6.643 3.713l-3.268 1.82c-.646-1.392-1.903-2.035-3.375-2.035-1.401 0-2.622.607-2.622 1.892z"
                                      fill="currentColor"></path>
                            </svg>
                        </div>
                        <div class="inline-block relative mx-auto">
                            <div class="bg-red-500 w-16 h-16 absolute left-6 top-6 blur-3xl"></div>
                            <svg class="w-24 h-auto" width="50" height="52" viewBox="0 0 50 52"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M49.626 11.564a.809.809 0 0 1 .028.209v10.972a.8.8 0 0 1-.402.694l-9.209 5.302V39.25c0 .286-.152.55-.4.694L20.42 51.01c-.044.025-.092.041-.14.058-.018.006-.035.017-.054.022a.805.805 0 0 1-.41 0c-.022-.006-.042-.018-.063-.026-.044-.016-.09-.03-.132-.054L.402 39.944A.801.801 0 0 1 0 39.25V6.334c0-.072.01-.142.028-.21.006-.023.02-.044.028-.067.015-.042.029-.085.051-.124.015-.026.037-.047.055-.071.023-.032.044-.065.071-.093.023-.023.053-.04.079-.06.029-.024.055-.05.088-.069h.001l9.61-5.533a.802.802 0 0 1 .8 0l9.61 5.533h.002c.032.02.059.045.088.068.026.02.055.038.078.06.028.029.048.062.072.094.017.024.04.045.054.071.023.04.036.082.052.124.008.023.022.044.028.068a.809.809 0 0 1 .028.209v20.559l8.008-4.611v-10.51c0-.07.01-.141.028-.208.007-.024.02-.045.028-.068.016-.042.03-.085.052-.124.015-.026.037-.047.054-.071.024-.032.044-.065.072-.093.023-.023.052-.04.078-.06.03-.024.056-.05.088-.069h.001l9.611-5.533a.801.801 0 0 1 .8 0l9.61 5.533c.034.02.06.045.09.068.025.02.054.038.077.06.028.029.048.062.072.094.018.024.04.045.054.071.023.039.036.082.052.124.009.023.022.044.028.068zm-1.574 10.718v-9.124l-3.363 1.936-4.646 2.675v9.124l8.01-4.611zm-9.61 16.505v-9.13l-4.57 2.61-13.05 7.448v9.216l17.62-10.144zM1.602 7.719v31.068L19.22 48.93v-9.214l-9.204-5.209-.003-.002-.004-.002c-.031-.018-.057-.044-.086-.066-.025-.02-.054-.036-.076-.058l-.002-.003c-.026-.025-.044-.056-.066-.084-.02-.027-.044-.05-.06-.078l-.001-.003c-.018-.03-.029-.066-.042-.1-.013-.03-.03-.058-.038-.09v-.001c-.01-.038-.012-.078-.016-.117-.004-.03-.012-.06-.012-.09v-.002-21.481L4.965 9.654 1.602 7.72zm8.81-5.994L2.405 6.334l8.005 4.609 8.006-4.61-8.006-4.608zm4.164 28.764l4.645-2.674V7.719l-3.363 1.936-4.646 2.675v20.096l3.364-1.937zM39.243 7.164l-8.006 4.609 8.006 4.609 8.005-4.61-8.005-4.608zm-.801 10.605l-4.646-2.675-3.363-1.936v9.124l4.645 2.674 3.364 1.937v-9.124zM20.02 38.33l11.743-6.704 5.87-3.35-8-4.606-9.211 5.303-8.395 4.833 7.993 4.524z"
                                    fill="#FF2D20" fill-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                </div>


            </div>
        </Transition>
        <section class="bg-gradient-to-r from-sky-500 to-blue-400 py-8 mt-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-white bg-white/10 p-3 rounded-lg">
                        <span class="text-2xl font-bold">Адаптивно</span>
                        <div class="mt-2 leading-6">Свёрстано с использованием фрэймворка TailwindCSS 3</div>
                    </div>

                    <div class="text-white bg-white/10 p-3 rounded-lg">
                        <span class="text-2xl font-bold">С тестами</span>
                        <div class="mt-2 leading-6">
                            Эндпойнты и содержимое ответов InertiaJS покрыты тестами
                        </div>
                    </div>

                    <div class="text-white bg-white/10 p-3 rounded-lg">
                        <span class="text-xl font-bold">Интерактивно</span>
                        <div class="mt-2 leading-6">
                            Динамичность обеспечивается шаблонами на VueJS
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="mb-6">
                        <h2 class="text-gray-800 text-4xl font-bold">
                            "Продуктовые фичи"
                        </h2>
                    </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-12">
                    <div
                        class="relative overflow-hidden bg-gradient-to-r from-slate-100 to-stone-100 shadow-sm py-12 px-8 rounded-xl before:block before:absolute before:w-36 before:h-10 before:bg-blue-400 before:right-4 before:blur-3xl">
                        <div class="text-2xl font-medium">
                            Формируйте список дел на день
                        </div>
                        <div class="text-gray-700 mt-4">
                            Отбирайте задачи на сегодняшний день, выбирая задачи из разных проектов.
                        </div>
                        <!--                  <div class="absolute right-4 top-4 px-2 py-0.5 rounded-lg bg-purple-500 text-white opacity-100">-->
                        <!--                В разработке-->
                        <!--             </div>-->
                    </div>


                    <div
                        class="relative overflow-hidden bg-gradient-to-r from-slate-100 to-stone-100 shadow-sm py-12 px-8 rounded-xl before:block before:absolute before:w-36 before:h-10 before:bg-sky-400 before:right-4 before:blur-3xl">
                        <div class="text-2xl font-medium">
                            Категоризуйте задачи по проектам
                        </div>
                        <div class="text-gray-700 mt-4">
                            Добавляйте и редактируйте свои проекты, делитесь доступом к проектам с другими
                            зарегистрированными пользователями.
                        </div>
                    </div>

                    <div
                        class="relative overflow-hidden bg-gradient-to-r from-slate-100 to-stone-100 py-12 px-8 rounded-xl before:block before:absolute before:w-36 before:h-10 before:bg-amber-400 before:right-4 before:bottom-4 before:blur-3xl">
                        <div class="text-2xl font-medium">
                            Управляйте задачами
                        </div>
                        <div class="text-gray-700 mt-4">
                            Создавайте задачи в рамках проектов; расставляйте дедлайны и планируйте их выполнение.
                        </div>
                    </div>

                    <div
                        class="relative overflow-hidden bg-gradient-to-r from-slate-100 to-stone-100 py-12 px-8 rounded-xl before:block before:absolute before:w-36 before:h-10 before:bg-fuchsia-400 before:right-12 before:top-12 before:blur-3xl">
                        <div class="text-2xl font-medium">
                            Делитесь доступом к проекту
                        </div>
                        <div class="text-gray-700 mt-4">
                            Добавляйте и редактируйте свои проекты, делитесь доступом к проектам с другими
                            зарегистрированными пользователями.
                        </div>
                    </div>

                </div>
            </div>
        </section>


        <footer class="bg-gray-900 py-8 text-white mt-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-3 gap-x-12">
                    <div>
                        <div>Todoshqa</div>
                        <div class="mt-2 text-sm">
                            Демонстрационное TODO приложение, построенное TailwindCSS, VueJS, InertiaJS и Laravel.
                        </div>
                        <div class="mt-4">
                            <img class="w-12 h-12" src="/css/icon.png" alt="Todoshqa Logo">
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
import TButton from "@/components/TButton";
import TTask from "@/components/TTask";
import {Head} from "@inertiajs/inertia-vue3";

export default {
    components: {TTask, TButton, Link, Head},
    props: {
        tasks: {
            type: Array,
        },
        auth: {
          user: {
              type: Object,
          }
        }
    },
    computed: {
        isLoggedIn: function() {
            return !!this.$props.auth.user;
        },
    }
}

</script>
