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
import { Eye, EyeClosed, CheckCheckIcon, User2Icon } from 'lucide-vue-next';
import { usePasswordToggle } from '@/composables/usePasswordToggle';
import { onMounted, PropType, ref } from 'vue';
import { useAlertService } from '@/composables/MessageBox';
const {isPasswordHidden: isMainPasswordHidden, inputType: mainPassInputType, togglePassword: toggleMainPassword} = usePasswordToggle();
const {isPasswordHidden: isConfirmPasswordHidden, inputType: confirmPassInputType, togglePassword: toggleConfirmPassword} = usePasswordToggle();
const {isPasswordHidden: isCurrentasswordHidden, inputType: CurrentPassInputType, togglePassword: toggleCurrentPassword} = usePasswordToggle();
const {openSuccessNotification, openErrorNotification}=useAlertService();
const props=defineProps({
    UserData: {  type: Object as PropType<Record<string, any>>, // note the []
            default: () => {},}
})
const isModalOpen=ref(false);
const form = useForm({
    email: props.UserData.email,
    name: props.UserData.name,
});
 const submit=(async ()=>{
    try{
        const response =  await axios.patch(route('user-mgmt.updateUserProfile', props.UserData.id), form,{
        
        }); 
        // form.reset()
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
            <Button size="sm" class="text-xs button-submit"><User2Icon></User2Icon>Update Profile</Button>
        </DialogTrigger>
        <DialogContent v-if="isModalOpen">
            
            <form @submit.prevent="submit" >
                <DialogHeader>
                    <DialogTitle>Edit profile</DialogTitle>
                    <DialogDescription>
                        Make changes to user profile here. Click save when you're done.
                    </DialogDescription>
                </DialogHeader>
                    <div class="grid gap-2">
                        <Label for="name">Full Name</Label>

                        <Input
                            id="name"
                            class="mt-1 block w-full"
                            name="name"
                            v-model="form.name"
                            required
                            autocomplete="name"
                            placeholder="Full name"
                        />
                        <InputError :message="form.errors.name" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="email">Email</Label>

                        <Input
                            id="email"
                            type="email"
                            class="mt-1 block w-full"
                            name="email"
                            v-model="form.email"
                            required
                            autocomplete="username"
                            placeholder="Email address"
                        />  
                        <InputError :message="form.errors.email" />
                    </div> 
                <DialogFooter>
                    <Button type="submit" 
                        class="bg-blue-500 cursor-pointer hover:bg-blue-700">
                        <CheckCheckIcon></CheckCheckIcon>Update
                    </Button>
                </DialogFooter>
            
            </form>
        </DialogContent>
    </Dialog>
</template>