<script setup lang="ts">
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert'
import RegisteredUserController from '@/actions/App/Http/Controllers/Auth/RegisteredUserController';
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthBase from '@/layouts/AuthLayout.vue';
import { login, register } from '@/routes';
import { Form, Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle, Eye, EyeClosed } from 'lucide-vue-next';
import { Roles } from '@/types';
import { onMounted, ref, computed } from 'vue';
import { usePage  } from '@inertiajs/vue3';
import {
  Select,
  SelectContent,
  SelectGroup,
  SelectItem,
  SelectLabel,
  SelectTrigger,
  SelectValue,
} from '@/components/ui/select'
import password from '@/routes/password';

import { type BreadcrumbItem } from '@/types';
import AppLayout from '@/layouts/AppLayout.vue';
import { route } from 'ziggy-js';
import { usePasswordToggle } from '@/composables/usePasswordToggle';
import { generatepassword } from '@/composables/generatePassword';
interface Props {
    roles: Roles[];
}
const {isPasswordHidden: isMainPasswordHidden, inputType: mainPassInputType, togglePassword: toggleMainPassword} = usePasswordToggle();
const {isPasswordHidden: isConfirmPasswordHidden, inputType: confirmPassInputType, togglePassword: toggleConfirmPassword} = usePasswordToggle();
const props=defineProps<Props>();
const page = usePage() as any;
// Explicitly grab roles, fallback to empty array
const roles = (page.props.auth as any)?.roles ?? []
// Ensure it's a real array (handles Laravel collections)
const roleList: string[] = Array.isArray(roles) ? roles : Object.values(roles)
const isSuperAdmin =  roleList.includes('super-admin')
const {randomPass}=generatepassword();


const form = useForm({
    role: null,
    reference_number: '', 
    name: '',
    email: '',
    password: randomPass.value,
    password_confirmation: randomPass.value
})
</script>

<template>
    <!-- <AuthBase title="Create an account" description="Fill in the details below to create an account">
        <Head title="Register" /> -->

    <Head title="Dashboard" />

    <AppLayout>
        <div class="min-h-screen flex items-center justify-center bg-gray-50 p-4">
            <div class="w-full max-w-md bg-white shadow-md rounded-xl p-6">

                <div v-if="page.props.flash.success">
                    <Alert class="border-green-500 text-green-700 bg-green-50 mb-5">
                        <AlertCircle class="w-4 h-4 text-green-700" />
                        <AlertTitle>Success!!</AlertTitle>
                        <AlertDescription>
                            {{ page.props.flash.success }}
                        </AlertDescription>
                    </Alert>
                </div>

                <div v-if="page.props.flash.error" class="mb-5">
                    <Alert variant="destructive">
                        <AlertCircle class="w-4 h-4" />
                        <AlertTitle>Error</AlertTitle>
                        <AlertDescription>
                            {{ page.props.flash.error }}
                        </AlertDescription>
                    </Alert>
                </div>

                <Form
                    :action="route('register')"
                    method="post"
                    :reset-on-success="['password', 'password_confirmation','name', 'role', 'reference_number', 'email']"
                    v-slot="{ errors, processing }"
                    class="flex flex-col gap-6"
                >
                    <div class="grid gap-6">
                        <div class="grid gap-2">
                            <Label for="reference_number">Reference Number</Label>
                            <Input id="reference_number" type="reference_number" v-model="form.reference_number" autofocus
                                :tabindex="1" autocomplete="reference_number" name="reference_number" placeholder="Enter reference number" />
                            <InputError :message="errors.reference_number" />
                        </div>
                        <div class="grid gap-2">
                            <Label for="name">Name</Label>
                            <Input id="name" type="text" required 
                                v-model="form.name"
                                :tabindex="2" autocomplete="name" name="name" placeholder="Full name" />
                            <InputError :message="errors.name" />
                        </div>
                        <div class="grid gap-w">
                            <Label for="role">Role</Label>
                            <Select  v-model="form.role" name="role" id="role">
                                <SelectTrigger class="w-full">
                                    <SelectValue placeholder="Select a role" />
                                </SelectTrigger>
                                <SelectContent>
                                <SelectGroup>
                                    <SelectLabel>Roles</SelectLabel>
                                    <SelectItem :tabindex="3" v-for="(item, index) in props.roles" :value="item.id">
                                        {{ item.name }}
                                    </SelectItem>
                                </SelectGroup>
                                </SelectContent>
                            </Select>
                            <InputError :message="errors.role" />
                        </div>
                        <div class="grid gap-2">
                            <Label for="email">Email address</Label>
                            <Input v-model="form.email" id="email" type="email" required :tabindex="3" autocomplete="email" name="email" placeholder="email@example.com" />
                            <InputError :message="errors.email" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="password">Password</Label>
                            <div class="relative">
                                <Input v-model="form.password" id="password" :type="mainPassInputType" required :tabindex="4" autocomplete="new-password" name="password" placeholder="Password" />
                                
                                <EyeClosed @click="toggleMainPassword" v-if="isMainPasswordHidden" class="absolute right-3 top-1/2 -translate-y-1/2 cursor-pointer text-gray-500" />
                                <Eye @click="toggleMainPassword" v-else class="absolute right-3 top-1/2 -translate-y-1/2 cursor-pointer text-gray-500" />
                            </div>
                            <InputError :message="errors.password" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="password_confirmation">Confirm password</Label>
                            <div class="relative">
                                <Input
                                    v-model="form.password_confirmation"
                                    id="password_confirmation"
                                    :type="confirmPassInputType"
                                    required
                                    :tabindex="5"
                                    autocomplete="new-password"
                                    name="password_confirmation"
                                    placeholder="Confirm password"
                                />
                                <EyeClosed @click="toggleConfirmPassword" v-if="isConfirmPasswordHidden" class="absolute right-3 top-1/2 -translate-y-1/2 cursor-pointer text-gray-500" />
                                <Eye @click="toggleConfirmPassword" v-else class="absolute right-3 top-1/2 -translate-y-1/2 cursor-pointer text-gray-500" />
                           </div>
                            <InputError :message="errors.password_confirmation" />
                        </div>

                        <Button type="submit" class="mt-2 w-full" tabindex="6" :disabled="processing">
                            <LoaderCircle v-if="processing" class="h-4 w-4 animate-spin" />
                            Create account
                        </Button>
                    </div>

                   
                </Form>
            </div>
        </div>
    </AppLayout>
    <!-- </AuthBase> -->
</template>
