<script lang="ts" setup>
import { computed, PropType } from 'vue';
const props=defineProps({
     pisData: {
        type: Object as PropType<Record<string, any>>, 
        default: () => [],
    },
})
const contactPersonFromAcctg = (() => {
  const acctng = props.pisData[0]?.acctng ?? [];

  return acctng.map((person: any) => person.full_name).join(', ');
})();


</script>

<template>
    <div class="shadow-xl rounded-lg p-7">
        <div class=" border-gray-400 pb-2 mb-2">
            <p class="font-bold text-sm">CONTACT PERSONS</p>
        </div>
        <div class="space-y-8">

            <div class="grid grid-row space-y-4">
                <div class=" grid grid-cols-2">
                    <div>
                        <p class="text-gray-600 text-sm"><b>Contact of the Project Development Officer: </b></p>
                        <p class="text-gray-600 text-sm">{{ props.pisData[0]?.project_manager }}</p>
                    </div>

                    <div>
                        <p class="text-gray-600 text-sm"><b>Contact Person from the Monitoring Division: </b></p>
                        <p class="text-gray-600 text-sm">{{ props.pisData[0]?.contact_from_monitoring_division }}</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-row space-y-4">
                <div class=" grid grid-cols-2">
                    <div>
                        <p class="text-gray-600 text-sm"><b>Contact Person from the Accounting Section: </b></p>
                        <p class="text-gray-600 text-sm">{{ contactPersonFromAcctg }}</p>
                    </div>

                    <div>
                        <p class="text-gray-600 text-sm"><b>Contact Person from the Accreditation: </b></p>
                        <p class="text-gray-600 text-sm">{{ props.pisData[0]?.contact_from_accreditation }}</p>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</template>