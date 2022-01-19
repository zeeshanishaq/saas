<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <table class="hover:table-fixed">
                        <thead>
                            <tr>
                            <td>ID</td>
                            <td>Name</td>
                            <td>phone</td>
                            <td colspan="2">Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->phone}}</td>
                                <td>
                                    <x-nav-link :href="route('contact-edit', $user->id)" :active="request()->routeIs('contact-edit')">
                                        {{ __('Edit') }}
                                    </x-nav-link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
