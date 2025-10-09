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
            <p class="font-bold text-sm">APPROVED BUDGET</p>
        </div>
        <div class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2">
                <div class="space-y-2">
                    <div class="grid grid-cols-[40%_46%] lg:grid-cols-[50%_50%] gap-4">
                        <p class="text-gray-600 text-sm"><b>Per Review / Policy: </b></p>
                        <p class="text-gray-600 text-sm">
                                  {{ Number(props.pisData[0]?.amt_per_review ?? 0).toLocaleString('en-US', { minimumFractionDigits: 2 }) }}
                        </p>
                    </div>

                    <div class="grid grid-cols-[40%_46%] lg:grid-cols-[50%_50%] gap-4">
                        <p class="text-gray-600 text-sm"><b>EXECOM Board: </b></p>
                        <p class="text-gray-600 text-sm">
                            {{ Number(props.pisData[0]?.amt_execom ?? 0).toLocaleString('en-US', { minimumFractionDigits: 2 }) }}
                        </p>
                    </div>
                </div>

                <div class="space-y-2">
                    <div class="grid grid-cols-[40%_46%] lg:grid-cols-[30%_70%] gap-4">
                        <p class="text-gray-600 text-sm"><b>Ad Hoc Panel: </b></p>
                        <p class="text-gray-600 text-sm">
                               {{ Number(props.pisData[0]?.amt_adhoc_experts ?? 0).toLocaleString('en-US', { minimumFractionDigits: 2 }) }}
                        </p>
                    </div>

                    <div class="grid grid-cols-[40%_46%] lg:grid-cols-[30%_70%] gap-4">
                        <p class="text-gray-600 text-sm"><b>Board: </b></p>
                        <p class="text-gray-600 text-sm">
                               {{ Number(props.pisData[0]?.cost ?? 0).toLocaleString('en-US', { minimumFractionDigits: 2 }) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>