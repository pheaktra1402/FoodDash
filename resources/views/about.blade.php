<x-app-layout>
    <div class="bg-white">
        <!-- Hero -->
        <div class="relative bg-slate-900 py-24 sm:py-32 overflow-hidden">
            <div class="absolute inset-0">
                <img class="w-full h-full object-cover opacity-20" src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?ixlib=rb-1.2.1&auto=format&fit=crop&w=1974&q=80" alt="Restaurant interior">
            </div>
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">About Us</h1>
                <p class="mt-4 max-w-2xl text-xl text-slate-300 mx-auto">We are passionate about delivering the best food from local restaurants directly to your doorstep, fast and fresh.</p>
            </div>
        </div>

        <!-- Content -->
        <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-base font-semibold text-emerald-600 tracking-wide uppercase">Our Mission</h2>
                <p class="mt-1 text-4xl font-extrabold text-slate-900 sm:text-5xl sm:tracking-tight lg:text-6xl">Quality food, fast delivery.</p>
                <p class="max-w-xl mt-5 mx-auto text-xl text-slate-500">We started this platform with one simple goal: to make it incredibly easy for everyone to enjoy their favorite meals without leaving the comfort of their home.</p>
            </div>

            <div class="mt-20">
                <dl class="space-y-10 md:space-y-0 md:grid md:grid-cols-3 md:gap-x-8 md:gap-y-10">
                    <div class="relative">
                        <dt>
                            <div class="absolute flex items-center justify-center h-12 w-12 rounded-xl bg-emerald-500 text-white shadow-lg">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-slate-900">Lightning Fast Delivery</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-slate-500">
                            Our drivers are stationed around the city to ensure your food arrives hot and fresh, in record time.
                        </dd>
                    </div>

                    <div class="relative">
                        <dt>
                            <div class="absolute flex items-center justify-center h-12 w-12 rounded-xl bg-emerald-500 text-white shadow-lg">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-slate-900">Best Partner Restaurants</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-slate-500">
                            We carefully vet all our partner restaurants to guarantee top-tier hygiene and culinary excellence.
                        </dd>
                    </div>

                    <div class="relative">
                        <dt>
                            <div class="absolute flex items-center justify-center h-12 w-12 rounded-xl bg-emerald-500 text-white shadow-lg">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                </svg>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-slate-900">Exceptional Support</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-slate-500">
                            Our customer support team is available 24/7 to resolve any issues and ensure you have a perfect meal.
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</x-app-layout>
