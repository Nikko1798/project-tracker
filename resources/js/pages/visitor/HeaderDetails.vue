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
    <div class="grid grid-cols-1 gap-4 shadow-xl p-4 rounded-lg">
    
        <div class="h-auto">
             <div class="grid grid-cols-1 space-y-2 border-b-1 border-gray-200 pb-2 mb-4">
                <div class="grid grid-cols-[40%_60%] lg:grid-cols-[25%_75%] gap-4">
                    <p class="text-gray-600 text-sm"><b>Project Title: </b></p>
                    <p class="text-gray-600 text-sm">{{ props.pisData[0]?.project_title }}</p>
                </div>
                
               
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 space-y-2">
                <div class="space-y-2">
                    <div class="grid grid-cols-[40%_60%] lg:grid-cols-[50%_50%] gap-4">
                        <p class="text-gray-600 text-sm"><b>Reference Number: </b></p>
                        <p class="text-gray-600 text-sm">{{ props.pisData[0]?.reference_number }}</p>
                    </div>

                     <div class="grid grid-cols-[40%_60%] lg:grid-cols-[50%_50%] gap-4">
                        <p class="text-gray-600 text-sm"><b>Project Category: </b></p>
                        <p class="text-gray-600 text-sm">{{ props.pisData[0]?.project_category }}</p>
                    </div>
                </div>

                <div class="">
                    <div class="grid grid-cols-[40%_60%] lg:grid-cols-[40%_60%] gap-4">
                        <p class="text-gray-600 text-sm"><b>Date received: </b></p>
                        <p class="text-gray-600 text-sm">
                            {{ props.pisData[0]?.date_recieved ? new Date(props.pisData[0]?.date_recieved).toLocaleDateString('en-US', { 
                                    year: 'numeric', 
                                    month: 'long', 
                                    day: 'numeric' 
                                }) : "" }}
                        </p>
                </div>
                </div>
            </div>
            

          

            <!-- <div class="grid grid-cols-[40%_60%] lg:grid-cols-[25%_75%] gap-4">
                <p class="text-gray-600 text-sm"><b>Document Origin: </b></p>
                <p class="text-gray-600 text-sm">[origin]</p>
            </div> -->
        </div>
    </div>
</template>