<script setup lang="ts">
import { PropType } from 'vue';
import { Accordion, AccordionContent, AccordionItem, AccordionTrigger } from '@/components/ui/accordion'

const props=defineProps({
     pisData: {
        type: Object as PropType<Record<string, any>>, 
        default: () => [],
    },
})
</script>
<template>
    <div class="shadow-xl p-4 rounded-lg h-full">
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

                    <AccordionContent class="bg-gray-200 p-4 rounded-md mb-2">
                        <div class="space-y-2">
                            <div class="grid grid-cols-[40%_60%] lg:grid-cols-[25%_75%] gap-4 border-b-1 border-dashed border-gray-500 pr-5">
                                <p class="text-gray-600 text-sm"><b>Remarks: </b></p>
                                <p class="text-gray-600 text-sm">{{ item?.remarks }}</p>
                            </div>
                             <div class="grid grid-cols-[40%_60%] lg:grid-cols-[25%_75%] gap-4 pr-5">
                                <p class="text-gray-600 text-sm"><b>Person Responsible: </b></p>
                                <p class="text-gray-600 text-sm">{{ item?.full_name }}</p>
                            </div>
                        </div>
                    </AccordionContent>
                </AccordionItem>
            </Accordion>
        </div>
    </div>
</template>