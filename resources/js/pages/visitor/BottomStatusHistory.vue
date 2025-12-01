<script setup lang="ts">
import {
  Table,
  TableBody,
  TableCaption,
  TableCell,
  TableFooter,
  TableHead,
  TableHeader,
  TableRow,
} from '@/components/ui/table'
import { computed, onMounted, PropType, ref } from 'vue';

const invoices = [
  {
    invoice: 'INV001',
    paymentStatus: 'Paid',
    totalAmount: '$250.00',
    paymentMethod: 'Credit Card',
  },
  {
    invoice: 'INV002',
    paymentStatus: 'Pending',
    totalAmount: '$150.00',
    paymentMethod: 'PayPal',
  },
  {
    invoice: 'INV003',
    paymentStatus: 'Unpaid',
    totalAmount: '$350.00',
    paymentMethod: 'Bank Transfer',
  },
  {
    invoice: 'INV004',
    paymentStatus: 'Paid',
    totalAmount: '$450.00',
    paymentMethod: 'Credit Card',
  },
  {
    invoice: 'INV005',
    paymentStatus: 'Paid',
    totalAmount: '$550.00',
    paymentMethod: 'PayPal',
  },
  {
    invoice: 'INV006',
    paymentStatus: 'Pending',
    totalAmount: '$200.00',
    paymentMethod: 'Bank Transfer',
  },
  {
    invoice: 'INV007',
    paymentStatus: 'Unpaid',
    totalAmount: '$300.00',
    paymentMethod: 'Credit Card',
  },
]
const isExpanded = ref<boolean[]>([]);
const props=defineProps({
     pisData: {
        type: Object as PropType<Record<string, any>>, 
        default: () => [],
    },
})

const showProjectDescToggleArr=computed(()=>{
    return props.pisData[0].history.map((item: any)=>{
        return item.remarks.length>40 ? false : true
    })
})
// const isExpanded=computed(()=>{
//     return props.pisData[0].history.map((item: any)=>{
//         return item.remarks.length>40 ? false : true
//     })
// })
const toggleExpand=((index: number)=>{
    isExpanded.value[index] = !isExpanded.value[index];
})
onMounted(()=>{
    const boolVal=showProjectDescToggleArr.value[0]
    console.log(boolVal)

    isExpanded.value = props.pisData[0].history.map((item: any)=>{
        return item.remarks.length>40 ? false : true
    })
})
</script>

<template>
    <div class="shadow-xl rounded-lg p-7">
        <div class=" border-gray-400 pb-2 mb-2">
            <p class="font-bold text-sm">PROJECT STATUS/HISTORY</p>
        </div>
        <div>
            <Table>
                <TableHeader>
                <TableRow class="bg-gray-200">
                    <TableHead class="w-[20%] border-gray-400 border-1">
                    Date
                    </TableHead>
                    <TableHead class="w-[50%] border-gray-400 border-1">Remarks</TableHead>
                    <TableHead class="w-[30%] border-gray-400 border-1">Person Responsible</TableHead>
                </TableRow>
                </TableHeader>
                <TableBody>
                <TableRow v-for="(item, index) in props.pisData[0].history">
                    <TableCell class="font-medium border-gray-400 border-1">
                         <p class="text-gray-600 text-sm">{{ item.last_updated ? new Date(item.last_updated).toLocaleDateString('en-US', { 
                            year: 'numeric', 
                            month: 'long', 
                            day: 'numeric' 
                        }) : "" }}</p>
                    </TableCell>
                    <TableCell class="border-gray-400 border-1">
                        {{isExpanded[index] ? item.remarks : item.remarks.slice(0,40) }} 
                        <span v-if="!showProjectDescToggleArr[index]" @click="toggleExpand(index)" class="text-blue-600 cursor-pointer">{{isExpanded[index] ? '...See less' : '...See more'}}</span>
                        <!-- {{ remarksUtil[index].showAllRemarks ? remarksUtil[index].minifiedRem  : remarksUtil[index].minifiedRem + ' see more...' }} <p @click="showMore(index)">ssee</p> -->
                    </TableCell>
                    <TableCell class="border-gray-400 border-1">
                        {{ item.full_name }}
                    </TableCell>
                </TableRow>
                </TableBody>
            </Table>
        </div>
    </div>

</template>
