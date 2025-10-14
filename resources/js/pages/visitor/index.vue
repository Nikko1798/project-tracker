<template>
    <div class="grid grid-cols-1 gap-4 shadow-xl p-4 rounded-lg border-b-6 border-[#007FFF]">
        <div class="flex flex-col items-center
         space-x-2 md:space-x-0">
            <span class="text-xs md:text-xs"><b>STATUS</b></span>
            <div class="flex text-xl text-blue-500 items-center md:text-2xl font-bold">
                <CircleCheckBig class="md:w-5 md:h-5 w-4 h-4 mr-2" />
                <span >{{ props.pisData[0]?.statusName }}</span>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-[65%_35%] gap-4 items-stretch">
        <!-- Left column -->
        <div class="flex flex-col">
            <HeaderDetails :pisData="pisData" />
            <ProponentDetails :pisData="pisData" />
            <ProjectDetails :pisData="pisData" />
            <!-- <ApprovedBudgetDetails :pisData="pisData" /> -->
            
            <ResponsiblePersons :pisData="pisData" />
        </div>

        <!-- Right column (matches height, scrolls if longer) -->
        <div class="overflow-y-auto h-full">
            <StatusHistory :pisData="pisData" />
        </div>
    </div>
</template>
<script setup lang="ts">
import { onMounted, PropType, toRaw } from 'vue';
import { CircleCheckBig } from 'lucide-vue-next';
import StatusHistory from './StatusHistory.vue';
import ProjectDetails from './ProjectDetails.vue';
import HeaderDetails from './HeaderDetails.vue';
import ProponentDetails from './ProponentDetails.vue';
import ResponsiblePersons from './ResponsiblePersons.vue';
import ApprovedBudgetDetails from './ApprovedBudgetDetails.vue';
const props=defineProps({
     pisData: {
        type: Object as PropType<Record<string, any>>, 
        default: () => [],
    },
})
onMounted(()=>{
    console.log(toRaw(props.pisData[0]))
})
</script>