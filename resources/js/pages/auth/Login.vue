<script setup lang="ts">
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert'
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthBase from '@/layouts/AuthLayout.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';
import { route } from 'ziggy-js';
import { onMounted } from 'vue';
defineProps<{
    status?: string;
    canResetPassword: boolean;
}>();

const form = useForm({
    identifier: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
onMounted(()=>{
    const appUrl = import.meta.env.VITE_BASE_URL;
console.log(appUrl); // https://example.com
})
const page=usePage() as any;
</script> 

<template>
    <AuthBase title="" description="">
        <Head title="Log in" />
        <div class="flex flex-col items-center justify-center">
            <p class="text-center font-cubao text-6xl">
                <span class="text-red-600">M</span>
                <span class="text-green-600">A</span>
                <span class="text-orange-600">B</span>
                <span class="text-blue-600">U</span>
                <span class="text-yellow-500">H</span>
                <span class="text-pink-600">A</span>
                <span class="text-violet-600">Y</span>
            </p>
            <p class=" text-sm text-gray-600">
                Please enter your credentials below to login
            </p>
        </div>


        <div v-if="page.props.errors.auth_error">
            <Alert variant="destructive">
                <AlertCircle class="w-4 h-4" />
                <AlertTitle>Error</AlertTitle>
                <AlertDescription>
                    {{ page.props.errors.auth_error }}
                </AlertDescription>
            </Alert>
        </div>

        <form @submit.prevent="submit" class="flex flex-col gap-6">
            <div class="grid gap-6">
                <div class="grid gap-2">
                    <Label for="email">Login ID</Label>
                    <Input
                        id="email"
                        type="text"
                        required
                        autofocus
                        :tabindex="1"
                        v-model="form.identifier"
                        placeholder="Enter your login id here..."
                    />
                    <InputError :message="form.errors.identifier" />
                </div>

                <div class="grid gap-2">
                    <div class="flex items-center justify-between">
                        <Label for="password">Password</Label>
                        <TextLink v-if="canResetPassword" :href="route('password.request')" class="text-sm" :tabindex="5">
                            Forgot password?
                        </TextLink>
                    </div>
                    <Input
                        id="password"
                        type="password"
                        required
                        :tabindex="2"
                        autocomplete="current-password"
                        v-model="form.password"
                        placeholder="Password"
                    />
                    <InputError :message="form.errors.password" />
                </div>

                <div class="flex items-center justify-between" :tabindex="3">
                    <Label for="remember" class="flex items-center space-x-3">
                        <Checkbox id="remember" v-model:checked="form.remember" :tabindex="4" />
                        <span>Remember me</span>
                    </Label>
                </div>

                <Button type="submit" class="mt-4 w-full button-submit" :tabindex="4" :disabled="form.processing">
                    <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                    Log in
                </Button>
            </div>
        </form>
    </AuthBase>
</template>
