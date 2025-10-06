<script setup lang="ts">
import { onMounted, PropType, toRaw } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import VisitorView from './visitor/index.vue';
import { FileSearch } from 'lucide-vue-next';
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
];
const props=defineProps({
     pisData: {
        type: Object as PropType<Record<string, any>>, 
        default: () => [],
    },
})
onMounted(()=>{
    console.log(props.pisData)
})
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4" >
            <VisitorView v-if="props.pisData?.status!='404' && props.pisData" :pisData="pisData"/>
            
             <div v-else-if="!props.pisData" class="grid grid-cols-1 gap-4 text-center">
                <div class="order-2 lg:order-1 mt-4 flex items-center justify-center gap-2">
                    <FileSearch class="h-5 w-5 text-gray-500"/>
                    <b class="text-gray-500">There seems to be a problem fetching the data. Please reload the page or contact NCCA if the problem persists.</b>
                </div>
            </div>
            <div v-else class="grid grid-cols-1 gap-4 text-center">
                <div class="order-2 lg:order-1 mt-4 flex items-center justify-center gap-2">
                    <FileSearch class="h-5 w-5 text-gray-500"/>
                    <b class="text-gray-500">No data available.</b>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
