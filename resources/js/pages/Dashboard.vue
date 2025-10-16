<script setup lang="ts">
import { PropType } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import VisitorView from './visitor/index.vue';
import logo from '@/assets/images/Logo2.png'

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
];
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4" >
        
        </div>
         <img :src="logo" alt="" class="fixed bottom-0 left-1/2 transform -translate-x-1/2 w-50 h-auto mb-15 opacity-14">
        
    </AppLayout>
</template>
