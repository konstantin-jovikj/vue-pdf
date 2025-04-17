<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { RadioGroup, RadioGroupItem } from '@/components/ui/radio-group'
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthBase from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';
import AppLayout from '@/layouts/AppLayout.vue';

const breadcrumbs = [
    {
        title: 'Внеси Корисник',
        href: '/register',
    },
];


interface Role {
    id: number;
    user_role: string;
}



const props = defineProps<{
    roles: Role[];
}>();


const form = useForm<{
    role_id: number;
    name: string;
    email: string;
    password: string;
    password_confirmation: string;
}>({
    role_id: 3,
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});




const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<Head title="Нов Запис" />
<template>
    <AppLayout :breadcrumbs="breadcrumbs" class="h-full">
        <AuthBase title="Додај нов кориснички профил" description="Внеси детали за новиот корисник">

            <Head title="Register" />

            <form @submit.prevent="submit" class="flex flex-col gap-6">
                <div class="grid gap-6">
                    <div class="grid gap-2">
                        <Label for="name">Име и Презиме</Label>
                        <Input id="name" type="text" required autofocus :tabindex="1" autocomplete="name"
                            v-model="form.name" placeholder="Full name" />
                        <InputError :message="form.errors.name" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="email">E-пошта</Label>
                        <Input id="email" type="email" required :tabindex="2" autocomplete="email" v-model="form.email"
                            placeholder="email@example.com" />
                        <InputError :message="form.errors.email" />
                    </div>

                    <!-- ROLE -->
                    <div class="grid gap-2">
                        <Label for="role_id" class="mb-1">Улога / Овластување</Label>
                        <RadioGroup v-model="form.role_id"
                            class="flex justify-around gap-2 border border-black py-3 px-2 rounded-md" default-value=3>
                            <div v-for="role in props.roles" :key="role.id" class="flex items-center space-x-2 ">
                                <RadioGroupItem :id="'role-' + role.id" :value="role.id" />
                                <Label :for="'role-' + role.id">{{ role.user_role }}</Label>
                            </div>
                        </RadioGroup>
                        <InputError :message="form.errors.role_id" />
                    </div>




                    <div class="grid gap-2">
                        <Label for="password">Лозинка</Label>
                        <Input id="password" type="password" required :tabindex="3" autocomplete="new-password"
                            v-model="form.password" placeholder="Password" />
                        <InputError :message="form.errors.password" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="password_confirmation">Потврди Лозинка</Label>
                        <Input id="password_confirmation" type="password" required :tabindex="4"
                            autocomplete="new-password" v-model="form.password_confirmation"
                            placeholder="Confirm password" />
                        <InputError :message="form.errors.password_confirmation" />
                    </div>

                    <Button type="submit" class="mt-2 w-full" tabindex="5" :disabled="form.processing">
                        <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                        Додај Нов Корисник
                    </Button>
                </div>

                <!-- <div class="text-center text-sm text-muted-foreground">
                    Already have an account?
                    <TextLink :href="route('login')" class="underline underline-offset-4" :tabindex="6">Log in
                    </TextLink>
                </div> -->
            </form>
        </AuthBase>
    </AppLayout>
</template>
