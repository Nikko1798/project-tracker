<template>
    <div class="grid grid-cols-1 gap-4 shadow-xl p-4 rounded-lg">
        
        <div class="grid grid-cols-1 lg:grid-cols-[60%_40%] gap-4">
            <div>
                <p><b>{{ props.pisData[0]?.reference_number }}</b></p>
                <sub class="text-gray-600">{{ props.pisData[0]?.proponent_name }}</sub>
            </div>

            <div class="flex items-center text-sm text-green-600 items-end">
                <CircleCheckBig class="w-4 h-4 mr-2" />
                <span>{{ props.pisData[0]?.statusName }}</span>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-[60%_40%] gap-4">
         <div class="shadow-xl rounded-lg p-5">
            <div class=" border-gray-400 pb-2 mb-2">
                <p class="font-bold text-sm">DETAILS</p>
            </div>
            <div class="space-y-2">
                <div class="grid grid-cols-[40%_60%] lg:grid-cols-[25%_75%] gap-4">
                    <p class="text-gray-600 text-sm"><b>Date Received: </b></p>
                    <!-- <p class="text-gray-600 text-sm">{{ props.pisData[0]?.date_recieved }}</p> -->
                    <p class="text-gray-600 text-sm">
                         {{ props.pisData[0]?.date_recieved ? new Date(props.pisData[0]?.date_recieved).toLocaleDateString('en-US', { 
                                year: 'numeric', 
                                month: 'long', 
                                day: 'numeric' 
                            }) : "" }}
                    </p>
                </div>
                <div class="grid grid-cols-[40%_60%] lg:grid-cols-[25%_75%] gap-4">
                    <p class="text-gray-600 text-sm"><b>Project Title: </b></p>
                    <p class="text-gray-600 text-sm">{{ props.pisData[0]?.project_title }}</p>
                </div>
                <div class="grid grid-cols-[40%_60%] lg:grid-cols-[25%_75%] gap-4">
                    <p class="text-gray-600 text-sm"><b>Amount Requested: </b></p>
                    <p class="text-gray-600 text-sm">{{ props.pisData[0]?.amt_requested ?? "0.00" }}</p>
                </div>
                <div class="grid grid-cols-[40%_60%] lg:grid-cols-[25%_75%] gap-4">
                    <p class="text-gray-600 text-sm"><b>Counterpart Fund: </b></p>
                    <p class="text-gray-600 text-sm">{{ props.pisData[0]?.amt_counterpart ?? "0.00" }}</p>
                </div>
                <div class="grid grid-cols-[40%_60%] lg:grid-cols-[25%_75%] gap-4">
                    <p class="text-gray-600 text-sm"><b>Project Category: </b></p>
                    <p class="text-gray-600 text-sm">{{ props.pisData[0]?.project_category }}</p>
                </div>
                <div class="grid grid-cols-[40%_60%] lg:grid-cols-[25%_75%] gap-4">
                    <p class="text-gray-600 text-sm"><b>Proposal Origin: </b></p>
                    <p class="text-gray-600 text-sm">{{ props.pisData[0]?.proposal_origin }}</p>
                </div>
                <div class="grid grid-cols-[40%_60%] lg:grid-cols-[25%_75%] gap-4">
                    <p class="text-gray-600 text-sm"><b>Validity: </b></p>
                    <p class="text-gray-600 text-sm">{{ props.pisData[0]?.proposal_validity_year }}</p>
                </div>
                 <div class="grid grid-cols-[40%_60%] lg:grid-cols-[25%_75%] gap-4">
                    <p class="text-gray-600 text-sm"><b>Project Description: </b></p>
                    <p class="text-gray-600 text-sm">{{ props.pisData[0]?.brief_description }}</p>
                </div>
            </div>
        </div>
         <div class="shadow-xl p-4 rounded-lg">
            <div class=" border-gray-400 pb-2 mb-2">
                <p class="font-bold text-sm">PROJECT STATUS/HISTORY</p>
                  <Accordion type="single" collapsible>
                    <AccordionItem v-for="(item, index) in props.pisData[0].history"  :value="String(index)">
                        <AccordionTrigger>
                            <p class="text-gray-600 text-sm">{{ item.last_updated ? new Date(item.last_updated).toLocaleDateString('en-US', { 
                                year: 'numeric', 
                                month: 'long', 
                                day: 'numeric' 
                            }) : "" }}</p>
                        </AccordionTrigger>
                        <AccordionContent>
                            <div class="space-y-2">
                                <div class="grid grid-cols-[40%_60%] lg:grid-cols-[25%_75%] gap-4">
                                    <p class="text-gray-600 text-sm"><b>Revised Project Title: </b></p>
                                    <p class="text-gray-600 text-sm">{{ item?.revised_project_title }}</p>
                                </div>
                                <div class="grid grid-cols-[40%_60%] lg:grid-cols-[25%_75%] gap-4">
                                    <p class="text-gray-600 text-sm"><b>Remarks: </b></p>
                                    <p class="text-gray-600 text-sm">{{ item?.remarks }}</p>
                                </div>
                            </div>
                        </AccordionContent>
                    </AccordionItem>
                </Accordion>
            </div>
        </div>
    </div>
</template>
<script setup lang="ts">
import { onMounted, PropType, toRaw } from 'vue';
import { CircleCheckBig } from 'lucide-vue-next';
import { Accordion, AccordionContent, AccordionItem, AccordionTrigger } from '@/components/ui/accordion'
const props=defineProps({
     pisData: {
        type: Object as PropType<Record<string, any>>, 
        default: () => [],
    },
})
onMounted(()=>{
    console.log(toRaw(props.pisData[0]?.history))
})
</script>