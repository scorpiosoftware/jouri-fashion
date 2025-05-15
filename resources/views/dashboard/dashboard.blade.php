<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
            <div class="mb-4 md:mb-0">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800 dark:text-white">
                    {{ session('lang') == 'en' ? 'Dashboard Overview' : 'نظرة عامة على لوحة التحكم' }}
                </h1>
                <p class="text-gray-600 dark:text-gray-400 mt-1">
                    {{ session('lang') == 'en' ? 'Welcome back! Here\'s what\'s happening with your business today.' : 'مرحبًا بعودتك! إليك ما يحدث في عملك اليوم.' }}
                </p>
            </div>

            <!-- Date Filter -->
            <form action="{{ route('dashboard.index') }}" method="get" class="flex items-center gap-3">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                        </svg>
                    </div>
                    <input type="date" id="datepicker" name="date"
                        class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                        placeholder="{{ session('lang') == 'en' ? 'Select date' : 'اختر تاريخًا' }}">
                </div>
                <button type="submit"
                    class="px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-sm transition-colors duration-200">
                    {{ session('lang') == 'en' ? 'Apply' : 'تطبيق' }}
                </button>
            </form>
            <script defer>
                flatpickr("#datepicker", {
                    dateFormat: "Y-m-d",
                    defaultDate: "today",
                    minDate: new Date(new Date().getFullYear(), new Date().getMonth(), 1), // 1st of current month
                    locale: {
                        firstDayOfWeek: 1 // Monday
                    },
                    // No maxDate restriction
                    onValueUpdate: function(selectedDates, dateStr, instance) {
                        // Validate selection is not before 1st of current month
                        const firstOfMonth = new Date(new Date().getFullYear(), new Date().getMonth(), 1);
                        if (selectedDates[0] < firstOfMonth) {
                            instance.setDate(firstOfMonth);
                        }
                    }
                });
            </script>
        </div>

        <!-- Key Metrics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Applied Orders Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            {{ session('lang') == 'en' ? 'Applied Orders' : 'الطلبات المنجزة' }}
                        </p>
                        <div class="flex items-center mt-2">
                            <h3 class="text-2xl font-semibold text-gray-900 dark:text-white">
                                {{ $applied_orders->count() }}
                            </h3>
                            <span
                                class="ml-2 px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                +0.0%
                            </span>
                        </div>
                    </div>
                    <div class="p-3 rounded-lg bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Revenue Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            {{ session('lang') == 'en' ? 'Revenue' : 'الإيرادات' }}
                        </p>
                        <div class="flex items-center mt-2">
                            <h3 class="text-2xl font-semibold text-gray-900 dark:text-white">
                                د.ع {{ number_format($revenue) }}
                            </h3>
                            <span
                                class="ml-2 px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                -0.0%
                            </span>
                        </div>
                    </div>
                    <div class="p-3 rounded-lg bg-green-50 dark:bg-green-900/30 text-green-600 dark:text-green-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Unpaid Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            {{ session('lang') == 'en' ? 'Unpaid' : 'غير مدفوعة' }}
                        </p>
                        <div class="flex items-center mt-2">
                            <h3 class="text-2xl font-semibold text-gray-900 dark:text-white">
                                د.ع {{ number_format($unpaid) }}
                            </h3>
                            <span
                                class="ml-2 px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                +0.0%
                            </span>
                        </div>
                    </div>
                    <div class="p-3 rounded-lg bg-purple-50 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            {{ session('lang') == 'en' ? 'Total' : 'المجموع' }}
                        </p>
                        <div class="flex items-center mt-2">
                            <h3 class="text-2xl font-semibold text-gray-900 dark:text-white">
                                د.ع {{ number_format($total) }}
                            </h3>
                            <span
                                class="ml-2 px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                +0.0%
                            </span>
                        </div>
                    </div>
                    <div class="p-3 rounded-lg bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Traffic Sources Section -->
        <div class="mb-8">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-gray-800 dark:text-white">
                    {{ session('lang') == 'en' ? 'Traffic Sources' : 'مصادر الزيارات' }}
                </h2>
                <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                    {{ session('lang') == 'en' ? 'Last 30 days' : 'آخر 30 يومًا' }}
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Visitors -->
                <div
                    class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 hover:shadow-md transition-shadow duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            {{ session('lang') == 'en' ? 'Total Visitors' : 'إجمالي الزوار' }}
                        </h3>
                        <div class="p-2 rounded-lg bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex items-end justify-between">
                        <p class="text-3xl font-bold text-gray-900 dark:text-white">
                            {{ number_format($totalVisits) }}
                        </p>
                        <div class="flex items-center text-sm text-green-600 dark:text-green-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 10l7-7m0 0l7 7m-7-7v18" />
                            </svg>
                            12.5%
                        </div>
                    </div>
                </div>

                <!-- Facebook -->
                <div
                    class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 hover:shadow-md transition-shadow duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            Facebook
                        </h3>
                        <div class="p-2 rounded-lg bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                viewBox="0 0 1024 1024" id="facebook">
                                <path fill="#1877f2"
                                    d="M1024,512C1024,229.23016,794.76978,0,512,0S0,229.23016,0,512c0,255.554,187.231,467.37012,432,505.77777V660H302V512H432V399.2C432,270.87982,508.43854,200,625.38922,200,681.40765,200,740,210,740,210V336H675.43713C611.83508,336,592,375.46667,592,415.95728V512H734L711.3,660H592v357.77777C836.769,979.37012,1024,767.554,1024,512Z">
                                </path>
                                <path fill="#fff"
                                    d="M711.3,660,734,512H592V415.95728C592,375.46667,611.83508,336,675.43713,336H740V210s-58.59235-10-114.61078-10C508.43854,200,432,270.87982,432,399.2V512H302V660H432v357.77777a517.39619,517.39619,0,0,0,160,0V660Z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex items-end justify-between">
                        <p class="text-3xl font-bold text-gray-900 dark:text-white">
                            {{ number_format($facebook) }}
                        </p>
                        <div class="flex items-center text-sm text-green-600 dark:text-green-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 10l7-7m0 0l7 7m-7-7v18" />
                            </svg>
                            8.2%
                        </div>
                    </div>
                </div>

                <!-- Instagram -->
                <div
                    class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 hover:shadow-md transition-shadow duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            Instagram
                        </h3>
                        <div class="p-2 rounded-lg bg-pink-100 dark:bg-pink-900/30 text-pink-600 dark:text-pink-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                viewBox="0 0 102 102" id="instagram">
                                <defs>
                                    <radialGradient id="a" cx="6.601" cy="99.766" r="129.502"
                                        gradientUnits="userSpaceOnUse">
                                        <stop offset=".09" stop-color="#fa8f21"></stop>
                                        <stop offset=".78" stop-color="#d82d7e"></stop>
                                    </radialGradient>
                                    <radialGradient id="b" cx="70.652" cy="96.49" r="113.963"
                                        gradientUnits="userSpaceOnUse">
                                        <stop offset=".64" stop-color="#8c3aaa" stop-opacity="0"></stop>
                                        <stop offset="1" stop-color="#8c3aaa"></stop>
                                    </radialGradient>
                                </defs>
                                <path fill="url(#a)"
                                    d="M25.865,101.639A34.341,34.341,0,0,1,14.312,99.5a19.329,19.329,0,0,1-7.154-4.653A19.181,19.181,0,0,1,2.5,87.694A34.341,34.341,0,0,1,.364,76.142C.061,69.584,0,67.617,0,51s.067-18.577.361-25.14A34.534,34.534,0,0,1,2.5,14.312,19.4,19.4,0,0,1,7.154,7.154,19.206,19.206,0,0,1,14.309,2.5A34.341,34.341,0,0,1,25.862.361C32.422.061,34.392,0,51,0s18.577.067,25.14.361A34.534,34.534,0,0,1,87.691,2.5a19.254,19.254,0,0,1,7.154,4.653A19.267,19.267,0,0,1,99.5,14.309a34.341,34.341,0,0,1,2.14,11.553c.3,6.563.361,8.528.361,25.14s-.061,18.577-.361,25.14A34.5,34.5,0,0,1,99.5,87.694,20.6,20.6,0,0,1,87.691,99.5a34.342,34.342,0,0,1-11.553,2.14c-6.557.3-8.528.361-25.14.361s-18.577-.058-25.134-.361">
                                </path>
                                <path fill="url(#b)"
                                    d="M25.865,101.639A34.341,34.341,0,0,1,14.312,99.5a19.329,19.329,0,0,1-7.154-4.653A19.181,19.181,0,0,1,2.5,87.694A34.341,34.341,0,0,1,.364,76.142C.061,69.584,0,67.617,0,51s.067-18.577.361-25.14A34.534,34.534,0,0,1,2.5,14.312,19.4,19.4,0,0,1,7.154,7.154,19.206,19.206,0,0,1,14.309,2.5A34.341,34.341,0,0,1,25.862.361C32.422.061,34.392,0,51,0s18.577.067,25.14.361A34.534,34.534,0,0,1,87.691,2.5a19.254,19.254,0,0,1,7.154,4.653A19.267,19.267,0,0,1,99.5,14.309a34.341,34.341,0,0,1,2.14,11.553c.3,6.563.361,8.528.361,25.14s-.061,18.577-.361,25.14A34.5,34.5,0,0,1,99.5,87.694,20.6,20.6,0,0,1,87.691,99.5a34.342,34.342,0,0,1-11.553,2.14c-6.557.3-8.528.361-25.14.361s-18.577-.058-25.134-.361">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex items-end justify-between">
                        <p class="text-3xl font-bold text-gray-900 dark:text-white">
                            {{ number_format($instagram) }}
                        </p>
                        <div class="flex items-center text-sm text-green-600 dark:text-green-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 10l7-7m0 0l7 7m-7-7v18" />
                            </svg>
                            15.7%
                        </div>
                    </div>
                </div>

                <!-- WhatsApp -->
                <div
                    class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 hover:shadow-md transition-shadow duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            WhatsApp
                        </h3>
                        <div
                            class="p-2 rounded-lg bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                id="whatsapp">
                                <path fill="#25D366"
                                    d="M24 48c13.255 0 24-10.745 24-24S37.255 0 24 0 0 10.745 0 24s10.745 24 24 24Z">
                                </path>
                                <path fill="#FDFDFD" fill-rule="evenodd"
                                    d="M24.791 37.353h-.006c-2.388-.001-4.735-.6-6.82-1.738L10.4 37.6l2.025-7.395a14.246 14.246 0 0 1-1.905-7.135c.003-7.868 6.405-14.27 14.27-14.27 3.819.002 7.402 1.488 10.096 4.185a14.185 14.185 0 0 1 4.176 10.097c-.003 7.866-6.402 14.267-14.27 14.27Zm-6.475-4.321.433.257a11.844 11.844 0 0 0 6.037 1.653h.005c6.538 0 11.859-5.32 11.862-11.861a11.79 11.79 0 0 0-3.471-8.392 11.78 11.78 0 0 0-8.386-3.479c-6.543 0-11.864 5.321-11.867 11.861 0 2.241.626 4.424 1.814 6.313l.282.448-1.199 4.378 4.49-1.178Zm13.176-6.878c.25.12.417.201.489.321.089.149.089.863-.208 1.696s-1.722 1.593-2.407 1.695c-.614.092-1.392.13-2.246-.14a20.465 20.465 0 0 1-2.033-.752c-3.343-1.444-5.602-4.684-6.029-5.296-.03-.043-.05-.073-.063-.088l-.002-.004c-.189-.252-1.453-1.94-1.453-3.685 0-1.643.806-2.504 1.178-2.9l.07-.075a1.31 1.31 0 0 1 .95-.446c.238 0 .476.002.684.012.026.002.052.002.08.001.207 0 .467-.002.722.612.099.236.242.586.394.956.307.747.646 1.572.706 1.691.089.179.148.387.03.625l-.05.102c-.09.182-.156.316-.307.493-.06.07-.121.144-.183.22-.123.149-.245.298-.352.405-.179.177-.364.37-.157.727.209.357.924 1.525 1.984 2.47 1.14 1.017 2.13 1.447 2.632 1.664.098.043.178.077.236.106.356.179.564.15.772-.089.208-.238.892-1.041 1.13-1.398.237-.357.475-.297.802-.179.327.12 2.08.982 2.436 1.16l.195.096Z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex items-end justify-between">
                        <p class="text-3xl font-bold text-gray-900 dark:text-white">
                            {{ number_format($whatsapp) }}
                        </p>
                        <div class="flex items-center text-sm text-green-600 dark:text-green-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 10l7-7m0 0l7 7m-7-7v18" />
                            </svg>
                            22.3%
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Secondary Traffic Sources -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <!-- Snapchat -->
            <div
                class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                        Snapchat
                    </h3>
                    <div
                        class="p-2 rounded-lg bg-yellow-100 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                            viewBox="147.553 39.286 514.231 514.631" id="snapchat">
                            <path fill="#fffc00"
                                d="M147.553 423.021v.023c.308 11.424.403 22.914 2.33 34.268 2.042 12.012 4.961 23.725 10.53 34.627 7.529 14.756 17.869 27.217 30.921 37.396 9.371 7.309 19.608 13.111 30.94 16.771 16.524 5.33 33.571 7.373 50.867 7.473 10.791.068 21.575.338 32.37.293 78.395-.33 156.792.566 235.189-.484 10.403-.141 20.636-1.41 30.846-3.277 19.569-3.582 36.864-11.932 51.661-25.133 17.245-15.381 28.88-34.205 34.132-56.924 3.437-14.85 4.297-29.916 4.444-45.035v-3.016c0-1.17-.445-256.892-.486-260.272-.115-9.285-.799-18.5-2.54-27.636-2.117-11.133-5.108-21.981-10.439-32.053-5.629-10.641-12.68-20.209-21.401-28.57-13.359-12.81-28.775-21.869-46.722-26.661-16.21-4.327-32.747-5.285-49.405-5.27-.027-.004-.09-.173-.094-.255H278.56c-.005.086-.008.172-.014.255-9.454.173-18.922.102-28.328 1.268-10.304 1.281-20.509 3.21-30.262 6.812-15.362 5.682-28.709 14.532-40.11 26.347-12.917 13.386-22.022 28.867-26.853 46.894-4.31 16.084-5.248 32.488-5.271 49.008">
                            </path>
                        </svg>
                    </div>
                </div>
                <div class="flex items-end justify-between">
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">
                        {{ number_format($snapchat) }}
                    </p>
                    <div class="flex items-center text-sm text-green-600 dark:text-green-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 10l7-7m0 0l7 7m-7-7v18" />
                        </svg>
                        5.4%
                    </div>
                </div>
            </div>

            <!-- TikTok -->
            <div
                class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                        TikTok
                    </h3>
                    <div class="p-2 rounded-lg bg-black dark:bg-gray-900 text-white dark:text-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill-rule="evenodd"
                            clip-rule="evenodd" viewBox="0 0 512 512" id="tiktok">
                            <path
                                d="M353.97 0.43c0.03,7.81 2.31,120.68 120.76,127.72 0,32.55 0.04,56.15 0.04,87.21 -8.97,0.52 -77.98,-4.49 -120.93,-42.8l-0.13 169.78c1.63,117.84 -85.09,189.55 -198.44,164.78 -195.46,-58.47 -130.51,-348.37 65.75,-317.34 0,93.59 0.05,-0.03 0.05,93.59 -81.08,-11.93 -108.2,55.52 -86.65,103.81 19.6,43.97 100.33,53.5 128.49,-8.53 3.19,-12.14 4.78,-25.98 4.78,-41.52l0 -337.13 86.28 0.43z">
                            </path>
                        </svg>
                    </div>
                </div>
                <div class="flex items-end justify-between">
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">
                        {{ number_format($tiktok) }}
                    </p>
                    <div class="flex items-center text-sm text-green-600 dark:text-green-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 10l7-7m0 0l7 7m-7-7v18" />
                        </svg>
                        18.9%
                    </div>
                </div>
            </div>

            <!-- Google -->
            <div
                class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                        Google
                    </h3>
                    <div class="p-2 rounded-lg bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 512 512"
                            id="google">
                            <path fill="#fbbb00"
                                d="M113.47 309.408 95.648 375.94l-65.139 1.378C11.042 341.211 0 299.9 0 256c0-42.451 10.324-82.483 28.624-117.732h.014L86.63 148.9l25.404 57.644c-5.317 15.501-8.215 32.141-8.215 49.456.002 18.792 3.406 36.797 9.651 53.408z">
                            </path>
                            <path fill="#518ef8"
                                d="M507.527 208.176C510.467 223.662 512 239.655 512 256c0 18.328-1.927 36.206-5.598 53.451-12.462 58.683-45.025 109.925-90.134 146.187l-.014-.014-73.044-3.727-10.338-64.535c29.932-17.554 53.324-45.025 65.646-77.911h-136.89V208.176h245.899z">
                            </path>
                            <path fill="#28b446"
                                d="m416.253 455.624.014.014C372.396 490.901 316.666 512 256 512c-97.491 0-182.252-54.491-225.491-134.681l82.961-67.91c21.619 57.698 77.278 98.771 142.53 98.771 28.047 0 54.323-7.582 76.87-20.818l83.383 68.262z">
                            </path>
                            <path fill="#f14336"
                                d="m419.404 58.936-82.933 67.896C313.136 112.246 285.552 103.82 256 103.82c-66.729 0-123.429 42.957-143.965 102.724l-83.397-68.276h-.014C71.23 56.123 157.06 0 256 0c62.115 0 119.068 22.126 163.404 58.936z">
                            </path>
                        </svg>
                    </div>
                </div>
                <div class="flex items-end justify-between">
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">
                        {{ number_format($google) }}
                    </p>
                    <div class="flex items-center text-sm text-green-600 dark:text-green-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 10l7-7m0 0l7 7m-7-7v18" />
                        </svg>
                        7.1%
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity Section -->
        <div
            class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 mb-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-800 dark:text-white">
                    {{ session('lang') == 'en' ? 'Recent Activity' : 'النشاط الأخير' }}
                </h2>
                <a href="#"
                    class="text-sm font-medium text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                    {{ session('lang') == 'en' ? 'View all' : 'عرض الكل' }}
                </a>
            </div>

            <div class="space-y-4">
                <!-- Activity Item 1 -->
                <div class="flex items-start">
                    <div class="flex-shrink-0 mr-3 mt-1">
                        <div
                            class="h-8 w-8 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600 dark:text-green-400"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 dark:text-white">
                            {{ session('lang') == 'en' ? 'New order #1234 completed' : 'تم إكمال طلب جديد #1234' }}
                        </p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            {{ session('lang') == 'en' ? 'Customer: Ahmed Mohammed - Total: د.ع 125,000' : 'العميل: أحمد محمد - الإجمالي: د.ع 125,000' }}
                        </p>
                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">
                            2 hours ago
                        </p>
                    </div>
                </div>

                <!-- Activity Item 2 -->
                <div class="flex items-start">
                    <div class="flex-shrink-0 mr-3 mt-1">
                        <div
                            class="h-8 w-8 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 dark:text-blue-400"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 dark:text-white">
                            {{ session('lang') == 'en' ? 'Payment received for order #1233' : 'تم استلام الدفع للطلب #1233' }}
                        </p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            {{ session('lang') == 'en' ? 'Amount: د.ع 85,000 - Method: Cash on delivery' : 'المبلغ: د.ع 85,000 - الطريقة: الدفع عند الاستلام' }}
                        </p>
                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">
                            5 hours ago
                        </p>
                    </div>
                </div>

                <!-- Activity Item 3 -->
                <div class="flex items-start">
                    <div class="flex-shrink-0 mr-3 mt-1">
                        <div
                            class="h-8 w-8 rounded-full bg-yellow-100 dark:bg-yellow-900/30 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 text-yellow-600 dark:text-yellow-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 dark:text-white">
                            {{ session('lang') == 'en' ? 'New message from customer' : 'رسالة جديدة من عميل' }}
                        </p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            {{ session('lang') == 'en' ? 'Noor Ali: "When will my order be delivered?"' : 'نور علي: "متى سيتم تسليم طلبي؟"' }}
                        </p>
                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">
                            1 day ago
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        /* Smooth transitions for dark mode */
        .transition-colors {
            transition-property: background-color, border-color, color, fill, stroke;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 150ms;
        }
    </style>
</x-app-layout>
