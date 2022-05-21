<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
})
</script>

<template>
    <Head title="Welcome" />

    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="text-sm text-gray-700 underline">
                Dashboard
            </Link>

            <template v-else>
                <Link :href="route('login')" class="text-sm text-gray-700 underline">
                    Iniciar Sesión
                </Link>

                <Link v-if="canRegister" :href="route('register')" class="ml-4 text-sm text-gray-700 underline">
                    Registrar
                </Link>
            </template>
        </div>

        <div
        class="
            w-[658px]
            h-[591px]
            mt-[164px]
            p-[48px]
            mx-auto
            bg-gradient-to-t
            from-[#EEF0F6]
            to-white
            rounded-[20px]
            drop-shadow-[0px_115px_120px_rgba(124,132,152,0.20)]
        "
    >
        <div class="font-medium text-xl text-center text-titulo">
            INICIAR SESIÓN
        </div>
        <div class="px-[48px]">
            <div class="flex justify-center py-[24px]">
                <ico-google />
                <ico-linkedin class="ml-[24px]" />
            </div>
            <div class="flex justify-center items-center h-[68px]">
                <linea-separador></linea-separador>
                <div
                    class="mx-[10px] w-[148.67px] text-center text-descripcion"
                >
                    o inicia con
                </div>
                <linea-separador></linea-separador>
            </div>
            <div class="text-descripcion pl-[12px]">Correo electrónico</div>
            <div class="py-[12px]">
                <input-custom
                    required
                    placeholder="Nombre"
                    type="text"
                    class="font-serif"
                    @keypress="SetearError()"
                    v-model="formulario.email"
                />
            </div>
            <div class="text-descripcion pl-[12px] pt-[12px]">Contraseña</div>
            <div class="py-[12px]">
                <input-custom
                    placeholder="Cédula"
                    type="password"
                    @keypress="SetearError()"
                    v-model="formulario.password"
                />
            </div>

            <div class="w-full h-[90px]">
                 <div
                    class="
                    fixed
                    mb-0
                    w-1/2
                    ml-14
                        bg-red-100
                        border border-red-400
                        text-red-700
                        px-4
                        py-3
                        rounded
                    "
                    v-show="error.bool"
                    role="alert"
                >
                    <span class="block sm:inline"
                        >{{error.message}}</span
                    >

                </div>
                <div class="h-full flex items-end" @click="Validar($event)">
                    <button-custom class="mx-auto w-[142px]"
                        >Siguiente</button-custom
                    >
                </div>
            </div>
            <div class="w-full py-[24px]">
                <div class="text-descripcion text-center">
                    No tienes cuenta?
                    <a
                        class="
                            text-bold text-link
                            cursor-pointer
                            hover:text-link-hover
                        "
                        >Regístrate</a
                    >
                </div>
            </div>
        </div>

    </div>
    </div>
</template>

<style scoped>
    .bg-gray-100 {
        background-color: #f7fafc;
        background-color: rgba(247, 250, 252, var(--tw-bg-opacity));
    }

    .border-gray-200 {
        border-color: #edf2f7;
        border-color: rgba(237, 242, 247, var(--tw-border-opacity));
    }

    .text-gray-400 {
        color: #cbd5e0;
        color: rgba(203, 213, 224, var(--tw-text-opacity));
    }

    .text-gray-500 {
        color: #a0aec0;
        color: rgba(160, 174, 192, var(--tw-text-opacity));
    }

    .text-gray-600 {
        color: #718096;
        color: rgba(113, 128, 150, var(--tw-text-opacity));
    }

    .text-gray-700 {
        color: #4a5568;
        color: rgba(74, 85, 104, var(--tw-text-opacity));
    }

    .text-gray-900 {
        color: #1a202c;
        color: rgba(26, 32, 44, var(--tw-text-opacity));
    }

    @media (prefers-color-scheme: dark) {
        .dark\:bg-gray-800 {
            background-color: #2d3748;
            background-color: rgba(45, 55, 72, var(--tw-bg-opacity));
        }

        .dark\:bg-gray-900 {
            background-color: #1a202c;
            background-color: rgba(26, 32, 44, var(--tw-bg-opacity));
        }

        .dark\:border-gray-700 {
            border-color: #4a5568;
            border-color: rgba(74, 85, 104, var(--tw-border-opacity));
        }

        .dark\:text-white {
            color: #fff;
            color: rgba(255, 255, 255, var(--tw-text-opacity));
        }

        .dark\:text-gray-400 {
            color: #cbd5e0;
            color: rgba(203, 213, 224, var(--tw-text-opacity));
        }
    }
</style>
