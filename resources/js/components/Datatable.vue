<script setup lang="ts">
import { ref, computed, PropType, onMounted, watch  } from 'vue'
import {
  Table,
  TableBody,
  TableCaption,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from '@/components/ui/table'
import {
  Pagination,
  PaginationContent,
  PaginationEllipsis,
  PaginationItem,
  PaginationNext,
  PaginationPrevious,
} from '@/components/ui/pagination'

import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { Search, Watch } from 'lucide-vue-next'
import { Input } from '@/components/ui/input'
import axios from 'axios';
import { debounce, sortBy } from 'lodash';
import { eventBus } from '@/utils/mitt';
import Loader from './Loader.vue'; 
import { ArrowUpDown } from 'lucide-vue-next'
    const props = defineProps({
        apiUrl: { type: String, required: true },
        // tableHeaders: { type: Array, required: true },
        sortableColumns: { type: Array as PropType<string[]> },
        visibleColumns: { type: Array as PropType<string[]>, required: true },
        itemsPerPage: { type: Number, default: 1 },
        eventName: { type: String, required: true }, // Unique event name for refreshing
        extraParams: { type: Object, default: () => ({}) }, // Accept additional parameters
    });
    const isLoading=ref(false)
    const query = ref('');
    const tableData = ref([]);
    const currentPage = ref(1);
    const totalItems = ref(0);
    const currSortBy=ref('');
    const ascOrDesc=ref<string>('');

    // This function is responsible for accessing a specific value from a deeply nested object
    // example data.item.approver.name this function loop through the object and find thtet value if that data.item.approver.name
    const getNestedValue = (obj: any, path: any) => {
        return path.split('.').reduce((acc: any, part: any) => acc && acc[part], obj);
    };

    const filteredTableData = computed(() => {
        return tableData.value.map(item => {
            let filteredItem: Record<string, any> = {}; // ✅ Fix here
            props.visibleColumns.forEach(col => {
                filteredItem[col] = getNestedValue(item, col);
            });
            filteredItem.subItems = item;
            return filteredItem;
        });
    });

    const fetchData = async () => {
        isLoading.value=true;
        try {
        const response = await axios.get(props.apiUrl, {
            params: {
            name: query.value,
            page: currentPage.value,
            sortBy: currSortBy.value,
            sortOrder: ascOrDesc.value,
            ...props.extraParams,
            },
        });
        tableData.value = response.data.data;
        totalItems.value = response.data.last_page;
        isLoading.value=false;
        } catch (error) {
        console.error("Error fetching data:", error);
        }
    };
    const debouncedFetchData = debounce(fetchData, 300);
    const searchMethod = () => {
        currentPage.value = 1;
        fetchData();
    };
    const sortColum=((column: any)=>{
        currSortBy.value=column
        if(!ascOrDesc.value)
        {
            //walang laman
            ascOrDesc.value='asc';
        }
        else{
            //check naman kung same pa din yung column na sino sort
            if(currSortBy.value!=column)
            {
                //pag hindi same always ascending
                ascOrDesc.value='asc';
            }
            else{
                //pag same 
                ascOrDesc.value=ascOrDesc.value!='asc' ? 'asc' : 'desc';
            }
        }
    });
    //trigger refresh of specific table base on event name
    eventBus.on(props.eventName, fetchData);
    onMounted(fetchData);
   
    watch([query, currentPage, currSortBy, ascOrDesc, () => props.extraParams], debouncedFetchData, { deep: true }); //extraParams is an object (e.g., { status: 'active', type: 'urgent' }), Vue doesn’t detect changes inside it unless deep: true is used.
 
    watch(() => props.extraParams, () => {
        fetchData()
    }, { deep: true });
    watch([query, currSortBy], debounce(() => {
        currentPage.value=1
    }, 300));
    const nextPage=(()=>{
        currentPage.value++;
    })
    const previousPage=(()=>{
        currentPage.value--;
    })
    const goToPage=((page: any)=>{
        currentPage.value=page;
    })
   
</script>

<template>
    <div class="flex justify-end space-x-4">
        <div class="relative w-full sm:w-[400px]">
            <Input id="search" v-model="query" type="text" placeholder="Search..." class="pl-10 w-full" />
            <span class="absolute start-0 inset-y-0 flex items-center justify-center px-2">
            <Search class="size-6 text-muted-foreground" />
            </span>
        </div>
    </div>

    
    <div class="relative mt-3">
        <Loader :isLoading="isLoading"></Loader>
        <div class="overflow-x-auto w-full">
            
            <Table class="rounded-lg">
                <TableHeader class="bg-gradient-to-r from-[#2A52BE] to-[#007FFF]">
                    <TableHead v-for="(header, index) in visibleColumns" :key="index">
                        <div class="flex items-center gap-3">
                            <slot :name="`header-${header}`" class="">
                            <span v-html="header" class=""></span>
                            </slot>
                            <ArrowUpDown v-if="sortableColumns?.includes(header)" 
                            @click="sortColum(header)"
                            class="text-white hover:bg-secondary hover:opacity-80 hover:text-gray-500 cursor-pointer w-4 h-4 rounded" />
                        </div>
                    </TableHead>
                </TableHeader>
            
                <TableBody >
                    <TableRow v-if="filteredTableData.length === 0">
                        <TableCell :colSpan="visibleColumns.length">
                            <div class="flex items-center justify-center gap-2 p-5">
                                <svg height="20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path opacity="0.1" d="M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z" fill="#817e7e"></path>
                                    <path d="M17 17L21 21" stroke="#817e7e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z" stroke="#817e7e" stroke-width="2"></path>
                                </g>
                                </svg>
                                <span>No results found.</span>
                            </div>
                        </TableCell>
                    </TableRow>
                    <TableRow v-else v-for="(item, rowIndex) in filteredTableData" :key="rowIndex">
                        <TableCell v-for="(column, colIndex) in visibleColumns" :key="colIndex">
                            <slot :name="`cell-${colIndex}`" :rowData="item.subItems">
                               
                                <span v-html="item[column]"></span>
                            </slot>
                            
                        </TableCell>
                    </TableRow>
                </TableBody>
            </Table>
        </div>
        <div class="flex justify-end mt-5">
        <Pagination v-slot="{ page }" :items-per-page="itemsPerPage" :total="totalItems" :default-page="currentPage">
            <PaginationContent v-slot="{ items }">
            <PaginationPrevious @click="previousPage" />

            <template v-for="(item, index) in items" :key="index">
                <PaginationItem
                @click="goToPage(item.value)"
                v-if="item.type === 'page'"
                :value="item.value"
                :is-active="item.value === currentPage"
                >
                {{ item.value }}
                </PaginationItem>
            </template>

            <PaginationEllipsis :index="4" />

            <PaginationNext @click="nextPage" />
            </PaginationContent>
        </Pagination>
    </div>
    </div>

    
    
</template>