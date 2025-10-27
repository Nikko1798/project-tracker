import { computed } from "vue";
export function generatepassword()
{
    const randomPass=computed(()=>{
        const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@$%&*_+?';
        let result = '';
        for (let i = 0; i < 14; i++) {
            result += chars.charAt(Math.floor(Math.random() * chars.length));
        }
        return result;
    })

    return {randomPass};
}