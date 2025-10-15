<script setup lang="ts">
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert'
import PasswordController from '@/actions/App/Http/Controllers/Settings/PasswordController';
import InputError from '@/components/InputError.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import { edit } from '@/routes/password';
import { Form, Head, useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

import HeadingSmall from '@/components/HeadingSmall.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { type BreadcrumbItem } from '@/types';
import { route } from 'ziggy-js';
const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Password settings',
        href: edit().url,
    },
];

const passwordInput = ref<HTMLInputElement | null>(null);
const currentPasswordInput = ref<HTMLInputElement | null>(null);
const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});
const submit = () => {
    form.put(route('password.update'), {
        onFinish: () => form.reset('password', 'current_password', 'password_confirmation'),
    });
};
const page = usePage() as any

</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="Password settings" />
       
        <SettingsLayout>
            <div class="space-y-6 md:max-w-2xl">
                <div v-if="page.props.flash.success">
                    <Alert class="border-green-500 text-green-700 bg-green-50">
                        <AlertCircle class="w-4 h-4 text-green-700" />
                        <AlertTitle>Success!!</AlertTitle>
                        <AlertDescription>
                            {{ page.props.flash.success }}
                        </AlertDescription>
                    </Alert>
                </div>

                <div v-if="page.props.flash.error">
                    <Alert variant="destructive">
                        <AlertCircle class="w-4 h-4" />
                        <AlertTitle>Error</AlertTitle>
                        <AlertDescription>
                            {{ page.props.flash.error }}
                        </AlertDescription>
                    </Alert>
                </div>
                <HeadingSmall title="Update password" description="Ensure your account is using a long, random password to stay secure" />
        
                <form @submit.prevent="submit"  class="space-y-4">
                    <div class="grid gap-2">
                        <Label for="current_password">Current password</Label>
                        <Input
                            id="current_password"
                            type="password"
                            required
                            :tabindex="2"
                            autocomplete="current_password"
                            v-model="form.current_password"
                            placeholder="Current Password"
                        />
                        <InputError :message="form.errors.current_password" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="password">New password</Label>
                        <Input
                            id="password"
                            type="password"
                            required
                            :tabindex="2"
                            autocomplete="password"
                            v-model="form.password"
                            placeholder="New Password"
                        />
                        <InputError :message="form.errors.password" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="password">Confirm password</Label>
                        <Input
                            id="password_confirmation"
                            type="password"
                            required
                            :tabindex="2"
                            autocomplete="password_confirmation"
                            v-model="form.password_confirmation"
                            placeholder="Confirm Password"
                        />
                        <InputError :message="form.errors.password_confirmation" />
                    </div>

                    <div class="flex items-center gap-4">
                         <Button type="submit" class="mt-4 w-full button-submit" :tabindex="4" :disabled="form.processing">
                            <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                            Log in
                        </Button>
                    </div>
                </Form>
            </div>
        </SettingsLayout>
    </AppLayout>
</template>
