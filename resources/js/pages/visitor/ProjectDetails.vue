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
            <p class="font-bold text-sm">DETAILS</p>
        </div>
        <div class="space-y-2">
            
           
            <div class="grid grid-cols-1 md:grid-cols-2">
                <div class="space-y-2">
                    <div class="grid grid-cols-[40%_46%] lg:grid-cols-[50%_50%] gap-4">
                        <p class="text-gray-600 text-sm"><b>Subcom: </b></p>
                        <p class="text-gray-600 text-sm">{{ props.pisData[0]?.subcom  }}</p>
                    </div>
                    <div class="grid grid-cols-[40%_60%] lg:grid-cols-[50%_50%] gap-4">
                        <p class="text-gray-600 text-sm"><b>Project Cost: </b></p>
                        <p class="text-gray-600 text-sm">
                            {{ Number(props.pisData[0]?.cost ?? 0).toLocaleString('en-US', { minimumFractionDigits: 2 }) }}
                        </p>
                    </div>
                    <div class="grid grid-cols-[40%_60%] lg:grid-cols-[50%_50%] gap-4">
                        <p class="text-gray-600 text-sm"><b>Implemenation Date: </b></p>
                        <p class="text-gray-600 text-sm">
                                {{ props.pisData[0]?.implementation_date ? new Date(props.pisData[0]?.implementation_date).toLocaleDateString('en-US', { 
                                    year: 'numeric', 
                                    month: 'long', 
                                    day: 'numeric' 
                                }) : "" }}
                        </p>
                    </div>
                
                    <div class="grid grid-cols-[40%_60%] lg:grid-cols-[50%_50%] gap-4">
                        <p class="text-gray-600 text-sm"><b>Counterpart Fund: </b></p>
                        <p class="text-gray-600 text-sm">
                            {{ Number(props.pisData[0]?.amt_counterpart ?? 0).toLocaleString('en-US', { minimumFractionDigits: 2 }) }}
                        </p>
                    </div>
                    <div class="grid grid-cols-[40%_60%] lg:grid-cols-[50%_50%] gap-4">
                        <p class="text-gray-600 text-sm"><b>Proposal Origin: </b></p>
                        <p class="text-gray-600 text-sm">{{ props.pisData[0]?.proposal_origin }}</p>
                    </div>
                    <div class="grid grid-cols-[40%_60%] lg:grid-cols-[50%_50%] gap-4">
                        <p class="text-gray-600 text-sm"><b>Validity: </b></p>
                        <p class="text-gray-600 text-sm">{{ props.pisData[0]?.proposal_validity_year }}</p>
                    </div>
                </div>

                <div class="space-y-2">
                    <div class="grid grid-cols-[40%_60%] lg:grid-cols-[40%_60%] gap-4">
                        <p class="text-gray-600 text-sm"><b>Committee: </b></p>
                        <p class="text-gray-600 text-sm">{{ props.pisData[0]?.committee }}</p>
                    </div>
                    
                    <div class="grid grid-cols-[40%_60%] lg:grid-cols-[40%_60%] gap-4">
                        <p class="text-gray-600 text-sm"><b>Amount Requested: </b></p>
                        <p class="text-gray-600 text-sm">
                            {{ Number(props.pisData[0]?.amt_requested ?? 0).toLocaleString('en-US', { minimumFractionDigits: 2 }) }}
                        </p>
                    </div>

                    <div class="grid grid-cols-[40%_60%] lg:grid-cols-[40%_60%] gap-4">
                        <p class="text-gray-600 text-sm"><b>Project Location: </b></p>
                        <p class="text-gray-600 text-sm">{{ props.pisData[0]?.regionName }}</p>
                    </div>
                </div>
            </div>
           

            <div class="grid grid-cols-[40%_60%] lg:grid-cols-[25%_75%] gap-4">
                <p class="text-gray-600 text-sm"><b>Project Description: </b></p>
                <p class="text-gray-600 text-sm">{{ props.pisData[0]?.brief_description }}</p>
            </div>
        </div>
    </div>
</template>