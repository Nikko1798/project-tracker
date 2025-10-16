<script setup lang="ts">
import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogFooter,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
} from '@/components/ui/dialog'
import { Input } from '@/components/ui/input';
import { Button } from '@/components/ui/button';
import { LockKeyhole } from 'lucide-vue-next';
import { useForm } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import axios from 'axios';
import { eventBus } from '@/utils/mitt';
import { Eye, EyeClosed, CheckCheckIcon } from 'lucide-vue-next';
import { usePasswordToggle } from '@/composables/usePasswordToggle';
import { ref } from 'vue';
import { useAlertService } from '@/composables/MessageBox';
const {isPasswordHidden: isMainPasswordHidden, inputType: mainPassInputType, togglePassword: toggleMainPassword} = usePasswordToggle();
const {isPasswordHidden: isConfirmPasswordHidden, inputType: confirmPassInputType, togglePassword: toggleConfirmPassword} = usePasswordToggle();
const {isPasswordHidden: isCurrentasswordHidden, inputType: CurrentPassInputType, togglePassword: toggleCurrentPassword} = usePasswordToggle();
const {openSuccessNotification, openErrorNotification}=useAlertService();
const props=defineProps({
    UserId: {type: Number, required: true}
})
const isModalOpen=ref(false);
const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});
 const submit=(async ()=>{
    try{
        const response =  await axios.patch(route('user-mgmt.resetPassword', props.UserId), form,{
        
        }); 
        form.reset()
        isModalOpen.value=false
        openSuccessNotification(`${response.data.message}`)
        // alert("success")
        eventBus.emit('refresh-user-table');
        console.log(response);
    }
    catch (error: any) {
        
        openErrorNotification(error.response.data.message)
        // alert("error")
        return error;
    }
})

</script>

<template>
  <Dialog v-model:open="isModalOpen">
    <DialogTrigger>
      
      <Button size="sm" class="text-xs button-submit"><LockKeyhole></LockKeyhole>Reset Password</Button>
    </DialogTrigger>
    <DialogContent v-if="isModalOpen">
      <DialogHeader>
        <DialogTitle>Password Reset</DialogTitle>
        <DialogDescription>
          Reset user password here. Click save when you're done.
        </DialogDescription>
      </DialogHeader>
      <form @submit.prevent="submit"  class="space-y-4">
        <div class="grid gap-2">
            <Label for="current_password">Current password</Label>
            <div class="relative">
                <Input
                    id="current_password"
                    :type="CurrentPassInputType"
                    required
                    :tabindex="2"
                    autocomplete="current_password"
                    v-model="form.current_password"
                    placeholder="Current Password"
                />
                <EyeClosed @click="toggleCurrentPassword" v-if="isCurrentasswordHidden" class="absolute right-3 top-1/2 -translate-y-1/2 cursor-pointer text-gray-500" />
                <Eye @click="toggleCurrentPassword" v-else class="absolute right-3 top-1/2 -translate-y-1/2 cursor-pointer text-gray-500" />
            </div> 
            <InputError :message="form.errors.current_password" />
        </div>

        <div class="grid gap-2">
            <Label for="password">New password</Label>
            
            <div class="relative">
                <Input
                    id="password"
                    :type="mainPassInputType"
                    required
                    :tabindex="2"
                    autocomplete="password"
                    v-model="form.password"
                    placeholder="New Password"
                />
                <EyeClosed @click="toggleMainPassword" v-if="isMainPasswordHidden" class="absolute right-3 top-1/2 -translate-y-1/2 cursor-pointer text-gray-500" />
                <Eye @click="toggleMainPassword" v-else class="absolute right-3 top-1/2 -translate-y-1/2 cursor-pointer text-gray-500" />
            </div>       
            <InputError :message="form.errors.password" />
        </div>

        <div class="grid gap-2">
            <Label for="password">Confirm password</Label>
            <div class="relative">
                <Input
                    id="password_confirmation"
                    :type="confirmPassInputType"
                    required
                    :tabindex="2"
                    autocomplete="password_confirmation"
                    v-model="form.password_confirmation"
                    placeholder="Confirm Password"
                />
                <EyeClosed @click="toggleConfirmPassword" v-if="isConfirmPasswordHidden" class="absolute right-3 top-1/2 -translate-y-1/2 cursor-pointer text-gray-500" />
                <Eye @click="toggleConfirmPassword" v-else class="absolute right-3 top-1/2 -translate-y-1/2 cursor-pointer text-gray-500" />
            
            </div>
            <InputError :message="form.errors.password_confirmation" />
        </div>

        </Form>
      <DialogFooter>
        <Button @click="submit" class="bg-blue-500 cursor-pointer hover:bg-blue-700"><CheckCheckIcon></CheckCheckIcon>Update Password</Button>
      </DialogFooter>
    </DialogContent>
  </Dialog>
</template>