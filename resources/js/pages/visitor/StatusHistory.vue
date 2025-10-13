<script setup lang="ts">
import { computed, onMounted, PropType, ref, watch } from 'vue';
import { Accordion, AccordionContent, AccordionItem, AccordionTrigger } from '@/components/ui/accordion'

const props=defineProps({
     pisData: {
        type: Object as PropType<Record<string, any>>, 
        default: () => [],
    },
})

// Use the same values you assigned to each AccordionItem
const allItemValues = props.pisData[0].history.map((_ : any, i: any) => String(i))
// `v-model` binding controls which items are open
const openItems = ref<string[]>([])
const toggleText = computed(() => {
  return openItems.value.length !== allItemValues.length
    ? "OPEN ALL"
    : "CLOSE ALL";
});

// Open all
const openAll = () => {
    
  openItems.value = [...allItemValues]
}

// Close all
const closeAll = () => {
  openItems.value = []
}

const toggleAccordionView=(()=>{
    if(openItems.value.length !== allItemValues.length)
    {
        openAll()
    }
    else{
        closeAll()
    }
})
watch(() => props.pisData, (newVal) => {
  },
  { immediate: true }
);
</script>
<template>
    <div class="shadow-xl p-4 rounded-lg h-full">
        <div class=" border-gray-400 pb-2 mb-2">
            <div class="grid grid-cols-2">
                <p class="font-bold text-sm">PROJECT STATUS/HISTORY </p>
                <p class="text-blue-600 cursor-pointer text-end mr-3" @click="toggleAccordionView">{{ toggleText }}</p>
            </div>
                <Accordion v-model="openItems" type="multiple" collapsible>
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