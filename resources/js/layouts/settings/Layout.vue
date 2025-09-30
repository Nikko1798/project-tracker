<script setup lang="ts">
import Heading from '@/components/Heading.vue';
import { Button } from '@/components/ui/button';
import { Separator } from '@/components/ui/separator';
import { toUrl, urlIsActive } from '@/lib/utils';
import { appearance } from '@/routes';
import { edit as editPassword } from '@/routes/password';
import { edit } from '@/routes/profile';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import { onMounted, toRaw } from 'vue';

import { usePage } from '@inertiajs/vue3'
import { route } from 'ziggy-js';


const page = usePage()
// Explicitly grab roles, fallback to empty array
const roles = (page.props.auth as any)?.roles ?? []
// Ensure it's a real array (handles Laravel collections)
const roleList: string[] = Array.isArray(roles) ? roles : Object.values(roles)
const isAdmin = roleList.includes('admin') || roleList.includes('super-admin')

const sidebarNavItems: NavItem[] = [
    {
        title: 'Profile',
        href: 'profile.edit',
    },
    {
        title: 'Password',
        href: 'password.edit',
    },
    // {
    //     title: 'Appearance',
    //     href: 'appearance',
    // },
];
const sidebarNavItemsForVisitor: NavItem[] = [
    {
        title: 'Password',
        href: 'password.edit',
    },
];
const currentPath = typeof window !== undefined ? window.location.pathname : '';
</script>

<template>
    <div class="px-4 py-6">
        <Heading title="Settings" description="Manage your profile and account settings" />

        <div class="flex flex-col lg:flex-row lg:space-x-12">
            <aside class="w-full max-w-xl lg:w-48">
                <nav class="flex flex-col space-y-1 space-x-0">
                    <Button
                        v-if="isAdmin"
                        v-for="item in sidebarNavItems"
                        :key="toUrl(item.href)"
                        variant="ghost"
                        :class="['w-full justify-start', { 'bg-muted': urlIsActive(item.href, currentPath) }]"
                        as-child
                    >
                        <Link :href="route(item.href)">
                            {{ item.title }}
                        </Link>
                    </Button>

                     <Button
                        v-else
                        v-for="itm in sidebarNavItemsForVisitor"
                        :key="toUrl(itm.href)"
                        variant="ghost"
                        :class="['w-full justify-start', { 'bg-muted': urlIsActive(itm.href, currentPath) }]"
                        as-child
                    >
                        <Link :href="itm.href">
                            {{ itm.title }}
                        </Link>
                    </Button>
                </nav>
            </aside>

            <Separator class="my-6 lg:hidden" />

            <div class="flex-1 md:max-w-2xl">
                <section class="max-w-xl space-y-12">
                    <slot />
                </section>
            </div>
        </div>
    </div>
</template>
