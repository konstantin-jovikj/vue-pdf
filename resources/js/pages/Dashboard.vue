<script setup>
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';


const breadcrumbs = [
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
    fuels: {
        type: Array,
        required: true,
    },
});

const form = useForm({
    marka: '',
    doctype: '',
    tip: '',
    varijanta: '',
    izvedba: '',
    file: '',
    fuel: '',
    tip_motor: '',
    eu_odobrenie: '',
    cm3: '',
    kw: '',
    co2_nedc: '',
    co2_wltp: '',
});

const pdfUrl = ref(null);

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
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl ">
            <div class="flex h-full auto-rows-max gap-4  flex-col md:flex-row">
                <div
                    class="w-full grid h-full auto-rows-max gap-2 rounded-xl mt-8 border-sidebar-border/70 p-4 dark:border-sidebar-border">
                    <form @submit.prevent="
                        form.post('/document/store', {
                            forceFormData: true,
                            onError: () => form.reset(),
                        })
                        " class="flex flex-col gap-6">


                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Doc Type -->
                            <div class="grid gap-2">
                                <Label for="doctype" class="ms-4">Тип на Документ</Label>
                                <select
                                    class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm"
                                    id="doctype" v-model="form.doctype">
                                    <option v-for="docType in docTypes" :key="docType.id" :value="docType.id">{{
                                        docType.doc_type }}</option>
                                </select>
                                <InputError :message="form.errors.doctype" />
                            </div>

                            <!-- File -->
                            <div class="grid gap-2">
                                <Label for="file" class="ms-4">Прикачи Документ</Label>
                                <Input id="file" @change="handleFileChange" type="file" accept="application/pdf"
                                    required autofocus :tabindex="1" autocomplete="file" />
                                <InputError :message="form.errors.file" />
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Marka -->
                            <div class="grid gap-2">
                                <Label for="marka" class="ms-4">Марка (D.1)</Label>
                                <Input id="marka" type="text" required autofocus :tabindex="1" autocomplete="marka"
                                    v-model="form.marka" placeholder="marka" />
                                <InputError :message="form.errors.marka" />
                            </div>

                            <!-- Komercijalna Oznaka -->
                            <div class="grid gap-2">
                                <Label for="komercijalna_oznaka" class="ms-4">Комерцијална Ознака (D.3)</Label>
                                <Input id="komercijalna_oznaka" type="text" required autofocus :tabindex="1"
                                    autocomplete="komercijalna_oznaka" v-model="form.komercijalna_oznaka"
                                    placeholder="komercijalna_oznaka" />
                                <InputError :message="form.errors.komercijalna_oznaka" />
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Tip -->
                            <div class="grid gap-2">
                                <Label for="tip" class="ms-4">Тип (D.2)</Label>
                                <Input id="tip" type="text" required autofocus :tabindex="1" autocomplete="tip"
                                    v-model="form.tip" placeholder="Tip" />
                                <InputError :message="form.errors.tip" />
                            </div>

                            <!-- varijanta -->
                            <div class="grid gap-2">
                                <Label for="varijanta" class="ms-4">Варијанта (D.2)</Label>
                                <Input id="varijanta" type="text" required autofocus :tabindex="1"
                                    autocomplete="varijanta" v-model="form.varijanta" placeholder="Varijanta" />
                                <InputError :message="form.errors.varijanta" />
                            </div>

                            <!-- izvedba -->
                            <div class="grid gap-2">
                                <Label for="izvedba" class="ms-4">Изведба (D.2)</Label>
                                <Input id="izvedba" type="text" required autofocus :tabindex="1" autocomplete="izvedba"
                                    v-model="form.izvedba" placeholder="izvedba" />
                                <InputError :message="form.errors.izvedba" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- eu odobrenie -->
                            <div class="grid gap-2">
                                <Label for="eu_odobrenie" class="ms-4">Ознака на Одобрение (К)</Label>
                                <Input id="eu_odobrenie" type="text" required autofocus :tabindex="1"
                                    autocomplete="eu_odobrenie" v-model="form.eu_odobrenie"
                                    placeholder="eu_odobrenie" />
                                <InputError :message="form.errors.eu_odobrenie" />
                            </div>

                            <!-- cm3 -->
                            <div class="grid gap-2">
                                <Label for="cm3" class="ms-4">Зафатнина на Моторот cm3 (P.1)</Label>
                                <Input id="cm3" type="text" required autofocus :tabindex="1" autocomplete="cm3"
                                    v-model="form.cm3" placeholder="cm3" />
                                <InputError :message="form.errors.cm3" />
                            </div>

                            <!-- kw -->
                            <div class="grid gap-2">
                                <Label for="kw" class="ms-4">Силина на Моторот kW (P.2)</Label>
                                <Input id="kw" type="text" required autofocus :tabindex="1" autocomplete="kw"
                                    v-model="form.kw" placeholder="kw" />
                                <InputError :message="form.errors.kw" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Fuel -->
                            <div class="grid gap-2">
                                <Label for="doctype" class="ms-4">Вид на Гориво (P.3)</Label>
                                <select
                                    class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm"
                                    id="doctype" v-model="form.fuel">
                                    <option v-for="fuel in fuels" :key="fuel.id" :value="fuel.id">{{
                                        fuel.fuel }}</option>
                                </select>
                                <InputError :message="form.errors.fuel" />
                            </div>

                            <!-- Tip na Motor -->
                            <div class="grid gap-2">
                                <Label for="tip_motor" class="ms-4">Тип на Мотор (P.5)</Label>
                                <Input id="tip_motor" type="text" required autofocus :tabindex="1"
                                    autocomplete="tip_motor" v-model="form.tip_motor" placeholder="tip_motor" />
                                <InputError :message="form.errors.tip_motor" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                            <!-- co2_nedc -->
                            <div class="grid gap-2">
                                <Label for="co2_nedc" class="ms-4">CO2 (g/km) NEDC (V.7)</Label>
                                <Input id="co2_nedc" type="text" autofocus :tabindex="1" autocomplete="co2_nedc"
                                    v-model="form.co2_nedc" placeholder="co2_nedc" />
                                <InputError :message="form.errors.co2_nedc" />
                            </div>

                            <!-- co2_wltp -->
                            <div class="grid gap-2">
                                <Label for="co2_wltp" class="ms-4">CO2 (g/km) WLTP (V.7)</Label>
                                <Input id="co2_wltp" type="text" autofocus :tabindex="1" autocomplete="co2_wltp"
                                    v-model="form.co2_wltp" placeholder="co2_wltp" />
                                <InputError :message="form.errors.co2_wltp" />
                            </div>
                        </div>



                        <div class="flex gap-2 w-50 justify-center ">
                            <Button type="submit" class="mt-4 w-[200px] " :tabindex="4" :disabled="form.processing">
                                <span v-if="form.processing"
                                    class="h-4 w-4 border-2 border-white border-t-transparent rounded-full animate-spin inline-block"></span>

                                Зачувај
                            </Button>
                        </div>
                    </form>
                </div>
                <div class="w-full  rounded-xl border border-sidebar-border/70 bg-gray-50 dark:border-sidebar-border">
                    <div v-if="pdfUrl" class="h-full  rounded border bg-red-400">
                        <iframe :src="pdfUrl" class="h-[100%] w-full" />
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
