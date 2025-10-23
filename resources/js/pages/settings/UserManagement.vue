<script setup lang="ts">
import ProfileController from '@/actions/App/Http/Controllers/Settings/ProfileController';
import { edit } from '@/routes/profile';
import { send } from '@/routes/verification';
import { Form, Head, Link, usePage, useForm } from '@inertiajs/vue3';

import DeleteUser from '@/components/DeleteUser.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import { type BreadcrumbItem } from '@/types';
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert'
import { route } from 'ziggy-js';
import Datatable from '@/components/Datatable.vue';
import ChangePasswordForm from './UserManagementForm/ChangePasswordForm.vue';
import UpdateProfileForm from './UserManagementForm/UpdateProfileForm.vue';
import axios from 'axios'
import { ref } from 'vue';
interface Props {
    mustVerifyEmail: boolean;
    status?: string;
}

defineProps<Props>();

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Profile settings',
        href: edit().url,
    },
];

const page = usePage() as any;
const user = page.props.auth.user;
const form = useForm({
    name: user?.name,
    email: user?.email,
});
const result=ref<Record<number, string>>({});
const getReferenceNumbers=(async ($userId: any)=>{
    const response =  await axios.patch(route('user-mgmt.updateUserProfile', $userId),{
    
    }); 
    const mappedItems=response.data.map((item: any)=>{
        return item.id;
    })
    result.value = mappedItems;
})
function isArrayOfObjects(arr: any) {
    return Array.isArray(arr) && arr.length > 0 && typeof arr[0] === 'object';
}

function isArrayOfPrimitives(arr: any) {
    return Array.isArray(arr) && arr.length > 0 && typeof arr[0] !== 'object';
}
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        
        <Head title="Profile settings" />

        <SettingsLayout>
                <HeadingSmall title="User management" description="Manage users here." />
                <Datatable 
                    :apiUrl="route('user-mgmt.all-users')" 
                    :extraParams="{}"
                    :tableHeaders="[]"
                    :visible-columns="['id', 'name','email', 'referenceNumbers', 'actions']" 
                    :sortableColumns="['name', 'email']"
                    :itemsPerPage="1"
                    eventName="refresh-user-table">
                        <template #header-id>
                            <div class="text-white">ID</div>
                        </template>
                        <template #header-name>
                            <div class="text-white">Full name</div>
                        </template>
                        <template #header-email>
                            <div class="text-white">Email</div>
                        </template>
                        <template #header-referenceNumbers>
                            <div class="text-white">Ref#</div>
                        </template>
                         <template #header-actions>
                            <div class="text-white">Actions</div>
                        </template>

                        <template #cell-3="{rowData}">
                            <div class="space-x-2">
                                <!-- <span v-for="(item in rowData.reference_numbers)">{{ item.reference_number }}</span> -->
                                    <span v-for="ref in rowData.reference_numbers" :key="ref.id">
                                        {{ ref.reference_number }}
                                    </span>
                            </div>
                        </template>
                        <template #cell-4="{rowData}">
                            <div class="space-x-2 space-y-2" >
                                <ChangePasswordForm :UserId="rowData.id"/>
                                <UpdateProfileForm :UserData="rowData"/>
                            </div>
                        </template>
                        
                </Datatable>
            

            <!-- <DeleteUser /> -->
        </SettingsLayout>
    </AppLayout>
</template>
