<script lang="ts" setup>
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
            <p class="font-bold text-sm">CONTACT PERSONS</p>
        </div>
        <div class="space-y-4">

            <div class="grid grid-row space-y-4">
                <div class=" grid grid-cols-2">
                    <div>
                        <p class="text-gray-600 text-sm"><b>Contact of the Project Development Officer: </b></p>
                        <p class="text-gray-600 text-sm">[email address here]</p>
                    </div>

                    <div>
                        <p class="text-gray-600 text-sm"><b>Contact Person from the Monitoring Division: </b></p>
                        <p class="text-gray-600 text-sm">[proponent address here]</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-row space-y-4">
                <div class=" grid grid-cols-2">
                    <div>
                        <p class="text-gray-600 text-sm"><b>Contact Person from the Accounting Section: </b></p>
                        <p class="text-gray-600 text-sm">[email address here]</p>
                    </div>

                    <div>
                        <p class="text-gray-600 text-sm"><b>Contact Person from the Accreditation: </b></p>
                        <p class="text-gray-600 text-sm">[proponent address here]</p>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</template>