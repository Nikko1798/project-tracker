<script setup lang="ts">
    import { PropType } from 'vue';
    const props=defineProps({
        pisData: {
            type: Object as PropType<Record<string, any>>, 
            default: () => [],
        },
    })
</script>

<template>
    <div class="shadow-xl rounded-lg p-7">
        <div class=" border-gray-400 pb-2 mb-2">
            <p class="font-bold text-sm">PROPONENT DETAILS</p>
        </div>
        <div class="space-y-2">
            
          
             <div class="grid grid-cols-[40%_60%] lg:grid-cols-[25%_75%] gap-4">
                <p class="text-gray-600 text-sm"><b>Proponent: </b></p>
                <p class="text-gray-600 text-sm">{{ props.pisData[0]?.proponent_name  }}</p>
            </div>
            <div class="grid grid-cols-[40%_60%] lg:grid-cols-[25%_75%] gap-4">
                <p class="text-gray-600 text-sm"><b>Address: </b></p>
                <p class="text-gray-600 text-sm">{{ props.pisData[0]?.address }}</p>
            </div>
             <div class="grid grid-cols-[40%_60%] lg:grid-cols-[25%_75%] gap-4">
                <p class="text-gray-600 text-sm"><b>Email address: </b></p>
                <p class="text-gray-600 text-sm">{{ props.pisData[0]?.email }}</p>
            </div>
            <div class="grid grid-cols-[40%_60%] lg:grid-cols-[25%_75%] gap-4">
                <p class="text-gray-600 text-sm"><b>Contact Numbers: </b></p>
                <p class="text-gray-600 text-sm">{{ props.pisData[0]?.contact_nos }}</p>
            </div>
            
        </div>
    </div>
</template>