<script setup lang="ts">
import UserInfo from '@/components/UserInfo.vue';
import { DropdownMenuGroup, DropdownMenuItem, DropdownMenuLabel, DropdownMenuSeparator } from '@/components/ui/dropdown-menu';
import { logout } from '@/routes';
import { edit } from '@/routes/profile';
import type { User } from '@/types';
import { Link, router } from '@inertiajs/vue3';
import { LogOut, Settings } from 'lucide-vue-next';
import { usePage } from '@inertiajs/vue3';
import { UserPlus } from 'lucide-vue-next';
import { route } from 'ziggy-js';

interface Props {
    user: User;
}

const handleLogout = () => {
    router.flushAll();
};

defineProps<Props>();


const page = usePage()
// Explicitly grab roles, fallback to empty array
const roles = (page.props.auth as any)?.roles ?? []
// Ensure it's a real array (handles Laravel collections)
const roleList: string[] = Array.isArray(roles) ? roles : Object.values(roles)
const isAdmin = roleList.includes('admin') || roleList.includes('super-admin')
</script>

<template>
    <DropdownMenuLabel class="p-0 font-normal">
        <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
            <UserInfo :user="user" :show-email="true" />
        </div>
    </DropdownMenuLabel>
    <DropdownMenuSeparator />
    <DropdownMenuGroup>
        <DropdownMenuItem :as-child="true">
            <Link v-if="isAdmin" class="block w-full" :href="route('profile.edit')" prefetch as="button">
                <Settings class="mr-2 h-4 w-4" />
                Settings
            </Link>
            <Link v-else class="block w-full" :href="route('password.edit')" prefetch as="button">
                <Settings class="mr-2 h-4 w-4" />
                Update Password
            </Link>
        </DropdownMenuItem>
        
        <DropdownMenuItem v-if="isAdmin" :as-child="true">
            <Link v-if="isAdmin" class="block w-full" :href="route('register')" prefetch as="button">
                <UserPlus class="mr-2 h-4 w-4" />
                Add user
            </Link>
        </DropdownMenuItem>
    </DropdownMenuGroup>
    <DropdownMenuSeparator />
    <DropdownMenuItem :as-child="true">
            <Link class="block w-full" :href="route('logout')" method="post" @click="handleLogout" as="button">
                <LogOut class="mr-2 h-4 w-4" />
                Log out
            </Link>
    </DropdownMenuItem>
</template>
