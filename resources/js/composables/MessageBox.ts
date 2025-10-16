
import {useToast} from 'vue-toast-notification';
// Import one of the available themes
//import 'vue-toast-notification/dist/theme-default.css';
import 'vue-toast-notification/dist/theme-bootstrap.css';
const $toast = useToast();
export function useAlertService(){
    const openSuccessNotification=((message: string)=>{
        $toast.open({
            message: message,
            type: "success",
            duration: 1000 * 10,
            dismissible: true
        })
    })

    const openErrorNotification=((message: string)=>{
        $toast.open({
            message: message,
            type: "error",
            duration: 1000 * 10,
            dismissible: true
        })
    })
    return {openSuccessNotification, openErrorNotification};
}