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
import { LockKeyhole, LoaderCircle } from 'lucide-vue-next';
import { useForm } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import axios from 'axios';
import { eventBus } from '@/utils/mitt';
import { Eye, EyeClosed, CheckCheckIcon } from 'lucide-vue-next';
import { usePasswordToggle } from '@/composables/usePasswordToggle';
import { ref } from 'vue';
import { useAlertService } from '@/composables/MessageBox';
import { generatepassword } from '@/composables/generatePassword';
const {isPasswordHidden: isMainPasswordHidden, inputType: mainPassInputType, togglePassword: toggleMainPassword} = usePasswordToggle();
const {isPasswordHidden: isConfirmPasswordHidden, inputType: confirmPassInputType, togglePassword: toggleConfirmPassword} = usePasswordToggle();
const {isPasswordHidden: isCurrentasswordHidden, inputType: CurrentPassInputType, togglePassword: toggleCurrentPassword} = usePasswordToggle();
const {openSuccessNotification, openErrorNotification}=useAlertService();
const {randomPass}=generatepassword();
const props=defineProps({
    UserId: {type: Number, required: true}
})
const isModalOpen=ref(false);

const form = useForm({
    password: randomPass.value,
    password_confirmation: randomPass.value,
});
let isFormProcessing=ref(false);
 const submit=(async ()=>{
    isFormProcessing.value=true;
    try{
        const response =  await axios.patch(route('user-mgmt.resetPassword', props.UserId), form,{
        
        }); 
        isFormProcessing.value=false;
        form.reset()
        isModalOpen.value=false
        openSuccessNotification(`${response.data.message}`)
        // alert("success")
        eventBus.emit('refresh-user-table');
        console.log(response);
    }
    catch (error: any) {
        
        isFormProcessing.value=false;
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
      
      <form @submit.prevent="submit"  class="space-y-4">
        <DialogHeader>
          <DialogTitle>Password Reset</DialogTitle>
          <DialogDescription>
            Reset user password here. Click save when you're done.
          </DialogDescription>
        </DialogHeader>
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

        <DialogFooter>

          <Button type="submit" class="bg-blue-500 cursor-pointer hover:bg-blue-700" :disabled="isFormProcessing">
            <LoaderCircle v-if="isFormProcessing" class="h-4 w-4 animate-spin" />
            
            Update Password
          </Button>
        </DialogFooter>
      </form>
    </DialogContent>
  </Dialog>
</template>