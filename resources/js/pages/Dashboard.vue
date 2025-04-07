<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

import { useForm } from '@inertiajs/vue3';


    



const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Внеси нов Запис',
        href: '/dashboard',
    },
];

const props = defineProps({
    docTypes: {
        type: Array,
        required: true,
    },
});

const form = useForm({
    marka: '',
    doctype: '',
    tip: '',
    varijanta: '',
    file: '',
});

const pdfUrl = ref<string | null>(null);
const docType = ref<number | null>(null);


const handleFileChange = (e) => {
    const file = e.target.files[0];
    if (file && file.type === 'application/pdf') {
        form.file = file;
        pdfUrl.value = URL.createObjectURL(file);
    }
};


</script>

<template>
    <Head title="Нов Запис" />

    <AppLayout :breadcrumbs="breadcrumbs" class="h-full">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl bg-red-100 p-4">
            <div class="grid h-full auto-rows-max gap-4 bg-blue-100 md:grid-cols-2">
                <div class="relative h-full overflow-hidden rounded-xl border border-sidebar-border/70 bg-slate-400 p-8 dark:border-sidebar-border">
                    <form @submit.prevent="
                                form.post('/document/store', {
                                    forceFormData: true,
                                    onError: () => form.reset(),
                                })
                            " class="flex flex-col gap-6">
                        <div class="grid gap-2">
                            <Label for="marka" class="ms-4">Марка</Label>
                            <Input
                                id="marka"
                                type="text"
                                required
                                autofocus
                                :tabindex="1"
                                autocomplete="marka"
                                v-model="form.marka"
                                placeholder="marka"
                            />
                            <InputError :message="form.errors.marka" />
                        </div>

                        <!-- Doc Type -->
                        <div class="grid gap-2">
                            <Label for="doctype" class="ms-4">Тип на Документ</Label>
                            <select
                                class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm"
                                id="doctype"
                                v-model="form.doctype"
                            >
                                <option v-for="docType in docTypes" :key="docType.id" :value="docType.id">{{ docType.doc_type }}</option>
                            </select>
                            <InputError :message="form.errors.doctype" />
                        </div>

                        <!-- Tip -->
                        <div class="grid gap-2">
                            <Label for="tip" class="ms-4">Тип</Label>
                            <Input id="tip" type="text" required autofocus :tabindex="1" autocomplete="tip" v-model="form.tip" placeholder="Tip" />
                            <InputError :message="form.errors.tip" />
                        </div>

                        <!-- varijanta -->
                        <div class="grid gap-2">
                            <Label for="varijanta" class="ms-4">Варијанта</Label>
                            <Input
                                id="varijanta"
                                type="text"
                                required
                                autofocus
                                :tabindex="1"
                                autocomplete="varijanta"
                                v-model="form.varijanta"
                                placeholder="Varijanta"
                            />
                            <InputError :message="form.errors.varijanta" />
                        </div>

                        <!-- File -->
                        <div class="grid gap-2">
                            <Label for="file" class="ms-4">Прикачи Документ</Label>
                            <Input
                                id="file"
                                @change="handleFileChange"
                                type="file"
                                accept="application/pdf"
                                required
                                autofocus
                                :tabindex="1"
                                autocomplete="file"
                            />
                            <InputError :message="form.errors.file" />
                        </div>

                        <div class="grid gap-2">
                            <Button type="submit" class="mt-4 w-full" :tabindex="4" :disabled="form.processing">
                                <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                                Zacuvaj
                            </Button>
                        </div>
                    </form>
                </div>
                <div class="relative overflow-hidden rounded-xl border border-sidebar-border/70 bg-slate-300 dark:border-sidebar-border">
                    <div v-if="pdfUrl" class="h-full overflow-auto rounded border">
                        <iframe :src="pdfUrl" class="h-[90%] w-full" />
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
