<script setup lang="js">
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';


const breadcrumbs = [
    {
        title: 'Внеси нов Запис',
        href: '/dashboard',
    },
];

const props = defineProps({
    document: {
        type: Object,
        required: true,
    },
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
    marka: props.document.marka,
    doctype: props.document.doc_type?.id,
    tip: props.document.tip,
    varijanta: props.document.varijanta,
    izvedba: props.document.izvedba,
    file: props.document?.file,
    fuel: '',
    tip_motor: '',
    eu_odobrenie: '',
    cm3: '',
    kw: '',
    co2_nedc: '',
    co2_wltp: '',
    komercijalna_oznaka: '',
    godina_na_proizvodstvo: '',
    najgolema_konstruktivna_vkupna_masa: '',
    najgolema_legalna_vkupna_masa: '',
    najgolema_legalna_vkupna_masa_na_grupa_vozila: '',
    masa_na_voziloto: '',
    kategorija_i_vid: '',
    oblik_i_namena: '',
    broj_na_coc: '',
    broj_na_oski: '',
    dolzina: '',
    sirina: '',
    visina: '',
    dozvoleni_pnevmatici_i_naplatki_1: '',
    dozvoleni_pnevmatici_i_naplatki_2: '',
    broj_na_vrtezi: '',
    vin: '',
    odnos_silina_masa: '',
    boja_na_voziloto: '',
    datum_na_dokument: props.document?.datum_na_dokument,
});

const pdfUrl = ref(null);

onMounted(() => {
    if (props.document?.filepdf) {
        pdfUrl.value = `/storage/${props.document.filepdf}`;
    }
})

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


                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
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

                            <!-- Doc Date -->
                            <div class="grid gap-2">
                                <Label for="datum_na_dokument" class="ms-4">Датум на Документот</Label>
                                <Input id="datum_na_dokument" type="date" required autofocus :tabindex="1"
                                    autocomplete="datum_na_dokument" v-model="form.datum_na_dokument" />
                                <InputError :message="form.errors.datum_na_dokument" />
                            </div>

                            <!-- File -->
                            <div class="grid gap-2">
                                <Label for="file" class="ms-4">Прикачи Документ</Label>
                                <Input id="file" @change="handleFileChange" type="file" accept="application/pdf"
                                    :tabindex="1" autocomplete="off" />

                                <!-- Show existing file info -->
                                <div v-if="props.document?.file && !form.file"
                                    class="ms-4 text-sm text-gray-500 italic">
                                    Веќе прикачен документ: <span class="text-blue-600 font-medium">{{
                                        props.document.file.split('/').pop() }}</span>
                                </div>

                                <!-- Show newly selected file -->
                                <div v-else-if="form.file" class="ms-4 text-sm text-green-600 italic">
                                    Ново избран документ: <span class="font-medium">{{ form.file.name }}</span>
                                </div>

                                <InputError :message="form.errors.file" />
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Marka -->
                            <div class="grid gap-2">
                                <Label for="marka" class="ms-4">Марка (D.1)</Label>
                                <Input id="marka" type="text" required autofocus :tabindex="1" autocomplete="marka"
                                    v-model="form.marka" />
                                <InputError :message="form.errors.marka" />
                            </div>

                            <!-- Komercijalna Oznaka -->
                            <div class="grid gap-2">
                                <Label for="komercijalna_oznaka" class="ms-4">Комерцијална Ознака (D.3)</Label>
                                <Input id="komercijalna_oznaka" type="text" required autofocus :tabindex="1"
                                    autocomplete="komercijalna_oznaka" v-model="form.komercijalna_oznaka" />
                                <InputError :message="form.errors.komercijalna_oznaka" />
                            </div>

                            <!-- Godina na Proizvodstvo -->
                            <div class="grid gap-2">
                                <Label for="godina_na_proizvodstvo" class="ms-4">Година на Производство (5А)</Label>
                                <Input id="godina_na_proizvodstvo" type="text" required autofocus :tabindex="1"
                                    autocomplete="godina_na_proizvodstvo" v-model="form.godina_na_proizvodstvo" />
                                <InputError :message="form.errors.godina_na_proizvodstvo" />
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Tip -->
                            <div class="grid gap-2">
                                <Label for="tip" class="ms-4">Тип (D.2)</Label>
                                <Input id="tip" type="text" required autofocus :tabindex="1" autocomplete="tip"
                                    v-model="form.tip" />
                                <InputError :message="form.errors.tip" />
                            </div>

                            <!-- varijanta -->
                            <div class="grid gap-2">
                                <Label for="varijanta" class="ms-4">Варијанта (D.2)</Label>
                                <Input id="varijanta" type="text" required autofocus :tabindex="1"
                                    autocomplete="varijanta" v-model="form.varijanta" />
                                <InputError :message="form.errors.varijanta" />
                            </div>

                            <!-- izvedba -->
                            <div class="grid gap-2">
                                <Label for="izvedba" class="ms-4">Изведба (D.2)</Label>
                                <Input id="izvedba" type="text" required autofocus :tabindex="1" autocomplete="izvedba"
                                    v-model="form.izvedba" />
                                <InputError :message="form.errors.izvedba" />
                            </div>
                        </div>
                        <!-- ////////// -->

                        <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
                            <!-- najgolema_konstruktivna_vkupna_masa -->
                            <div class="grid gap-2">
                                <Label for="najgolema_konstruktivna_vkupna_masa" class="ms-4">Најголема Конструктивна
                                    Вкупна Маса (F.1)</Label>
                                <Input id="najgolema_konstruktivna_vkupna_masa" type="text" autofocus :tabindex="1"
                                    autocomplete="tip" v-model="form.najgolema_konstruktivna_vkupna_masa" />
                                <InputError :message="form.errors.najgolema_konstruktivna_vkupna_masa" />
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
                            <!-- najgolema_legalna_vkupna_masa -->
                            <div class="grid gap-2">
                                <Label for="najgolema_legalna_vkupna_masa" class="ms-4">Hајголема Легална Вкупна Маса
                                    (F.2)</Label>
                                <Input id="najgolema_legalna_vkupna_masa" type="text" autofocus :tabindex="1"
                                    autocomplete="najgolema_legalna_vkupna_masa"
                                    v-model="form.najgolema_legalna_vkupna_masa" />
                                <InputError :message="form.errors.najgolema_legalna_vkupna_masa" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
                            <!-- najgolema_legalna_vkupna_masa_na_grupa_vozila -->
                            <div class="grid gap-2">
                                <Label for="najgolema_legalna_vkupna_masa_na_grupa_vozila" class="ms-4">Најголема
                                    Легална Вкупна Маса на Група Возила При Регистрација
                                    (F.3)</Label>
                                <Input id="najgolema_legalna_vkupna_masa_na_grupa_vozila" type="text" autofocus
                                    :tabindex="1" autocomplete="najgolema_legalna_vkupna_masa_na_grupa_vozila"
                                    v-model="form.najgolema_legalna_vkupna_masa_na_grupa_vozila" />
                                <InputError :message="form.errors.najgolema_legalna_vkupna_masa_na_grupa_vozila" />
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
                            <!-- masa_na_voziloto -->
                            <div class="grid gap-2">
                                <Label for="masa_na_voziloto" class="ms-4">Маса на Возилото (G)</Label>
                                <Input id="masa_na_voziloto" type="text" required autofocus :tabindex="1"
                                    autocomplete="masa_na_voziloto" v-model="form.masa_na_voziloto" />
                                <InputError :message="form.errors.masa_na_voziloto" />
                            </div>
                        </div>



                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- kategorija_i_vid -->
                            <div class="grid gap-2">
                                <Label for="kategorija_i_vid" class="ms-4">Категорија и Вид на Возилото (J)</Label>
                                <Input id="kategorija_i_vid" type="text" required autofocus :tabindex="1"
                                    autocomplete="kategorija_i_vid" v-model="form.kategorija_i_vid" />
                                <InputError :message="form.errors.kategorija_i_vid" />
                            </div>

                            <!-- oblik_i_namena -->
                            <div class="grid gap-2">
                                <Label for="oblik_i_namena" class="ms-4">Облик и Намена на каросерија (4)</Label>
                                <Input id="oblik_i_namena" type="text" required autofocus :tabindex="1"
                                    autocomplete="oblik_i_namena" v-model="form.oblik_i_namena" />
                                <InputError :message="form.errors.oblik_i_namena" />
                            </div>

                            <!-- eu odobrenie -->
                            <div class="grid gap-2">
                                <Label for="eu_odobrenie" class="ms-4">Ознака на Одобрение (К)</Label>
                                <Input id="eu_odobrenie" type="text" required autofocus :tabindex="1"
                                    autocomplete="eu_odobrenie" v-model="form.eu_odobrenie" />
                                <InputError :message="form.errors.eu_odobrenie" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <!-- broj_na_oski -->
                            <div class="grid gap-2">
                                <Label for="broj_na_oski" class="ms-4">Број на Оски(L)</Label>
                                <Input id="broj_na_oski" type="text" required autofocus :tabindex="1"
                                    autocomplete="broj_na_oski" v-model="form.broj_na_oski" />
                                <InputError :message="form.errors.broj_na_oski" />
                            </div>

                            <!-- dolzina -->
                            <div class="grid gap-2">
                                <Label for="dolzina" class="ms-4">Должина (mm) (5)</Label>
                                <Input id="dolzina" type="text" required autofocus :tabindex="1" autocomplete="dolzina"
                                    v-model="form.dolzina" />
                                <InputError :message="form.errors.dolzina" />
                            </div>

                            <!-- sirina -->
                            <div class="grid gap-2">
                                <Label for="sirina" class="ms-4">Ширина (mm) (6)</Label>
                                <Input id="sirina" type="text" required autofocus :tabindex="1" autocomplete="sirina"
                                    v-model="form.sirina" />
                                <InputError :message="form.errors.sirina" />
                            </div>

                            <!-- visina -->
                            <div class="grid gap-2">
                                <Label for="visina" class="ms-4">Висина (mm) (7)</Label>
                                <Input id="visina" type="text" required autofocus :tabindex="1" autocomplete="visina"
                                    v-model="form.visina" />
                                <InputError :message="form.errors.visina" />
                            </div>
                        </div>

                        <!-- ////////// -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- dozvoleni_pnevmatici_i_naplatki_1 -->
                            <div class="grid gap-2">
                                <Label for="dozvoleni_pnevmatici_i_naplatki_1" class="ms-4">Дозволени Пневматици и
                                    Наплатки(15.1)</Label>
                                <Input id="dozvoleni_pnevmatici_i_naplatki_1" type="text" required autofocus
                                    :tabindex="1" autocomplete="dozvoleni_pnevmatici_i_naplatki_1"
                                    v-model="form.dozvoleni_pnevmatici_i_naplatki_1" />
                                <InputError :message="form.errors.dozvoleni_pnevmatici_i_naplatki_1" />
                            </div>

                            <!-- dozvoleni_pnevmatici_i_naplatki_2 -->
                            <div class="grid gap-2">
                                <Label for="dozvoleni_pnevmatici_i_naplatki_2" class="ms-4">(15.2)</Label>
                                <Input id="dozvoleni_pnevmatici_i_naplatki_2" type="text" required autofocus
                                    :tabindex="1" autocomplete="dozvoleni_pnevmatici_i_naplatki_2"
                                    v-model="form.dozvoleni_pnevmatici_i_naplatki_2" />
                                <InputError :message="form.errors.dozvoleni_pnevmatici_i_naplatki_2" />
                            </div>

                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- broj_na_coc -->
                            <div class="grid gap-2">
                                <Label for="broj_na_coc" class="ms-4">Број на потврда за Сообразност СОС (1К)</Label>
                                <Input id="broj_na_coc" type="text" autofocus :tabindex="1" autocomplete="broj_na_coc"
                                    v-model="form.broj_na_coc" />
                                <InputError :message="form.errors.broj_na_coc" />
                            </div>

                            <!-- cm3 -->
                            <div class="grid gap-2">
                                <Label for="cm3" class="ms-4">Зафатнина на Моторот cm3 (P.1)</Label>
                                <Input id="cm3" type="text" required autofocus :tabindex="1" autocomplete="cm3"
                                    v-model="form.cm3" />
                                <InputError :message="form.errors.cm3" />
                            </div>

                            <!-- kw -->
                            <div class="grid gap-2">
                                <Label for="kw" class="ms-4">Силина на Моторот kW (P.2)</Label>
                                <Input id="kw" type="text" required autofocus :tabindex="1" autocomplete="kw"
                                    v-model="form.kw" />
                                <InputError :message="form.errors.kw" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
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

                            <!-- broj_na_vrtezi -->
                            <div class="grid gap-2">
                                <Label for="broj_na_vrtezi" class="ms-4">Број на Вртежи (min-1) (P.4)</Label>
                                <Input id="broj_na_vrtezi" type="text" required autofocus :tabindex="1"
                                    autocomplete="broj_na_vrtezi" v-model="form.broj_na_vrtezi" />
                                <InputError :message="form.errors.broj_na_vrtezi" />
                            </div>

                            <!-- Tip na Motor -->
                            <div class="grid gap-2">
                                <Label for="tip_motor" class="ms-4">Тип на Мотор (P.5)</Label>
                                <Input id="tip_motor" type="text" required autofocus :tabindex="1"
                                    autocomplete="tip_motor" v-model="form.tip_motor" />
                                <InputError :message="form.errors.tip_motor" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                            <!-- vin -->
                            <div class="grid gap-2">
                                <Label for="vin" class="ms-4">Идентификационен Број на Моторот VIN (P.5)</Label>
                                <Input id="vin" type="text" autofocus :tabindex="1" autocomplete="vin"
                                    v-model="form.vin" />
                                <InputError :message="form.errors.vin" />
                            </div>

                            <!-- boja_na_voziloto -->
                            <div class="grid gap-2">
                                <Label for="boja_na_voziloto" class="ms-4">Боја на Возилото (R)</Label>
                                <Input id="boja_na_voziloto" type="text" autofocus :tabindex="1"
                                    autocomplete="boja_na_voziloto" v-model="form.boja_na_voziloto" />
                                <InputError :message="form.errors.boja_na_voziloto" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-1 gap-2 bg-slate-100 py-2 px-1 rounded-md">
                            <!-- odnos_silina_masa -->
                            <div class="grid gap-2">
                                <Label for="odnos_silina_masa" class="ms-4">Однос Силина/Маса (Само за моторцикли) kW/kg
                                    (Q)</Label>
                                <Input id="odnos_silina_masa" type="text" autofocus :tabindex="1"
                                    autocomplete="odnos_silina_masa" v-model="form.odnos_silina_masa" />
                                <InputError :message="form.errors.odnos_silina_masa" />
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
                                    v-model="form.co2_wltp" />
                                <InputError :message="form.errors.co2_wltp" />
                            </div>
                        </div>



                        <div class="flex gap-2 w-50 justify-center ">
                            <Button type="submit" class="mt-4 w-[200px] " :tabindex="4" :disabled="form.processing">
                                <span v-if="form.processing"
                                    class="h-4 w-4 border-2 border-white border-t-transparent rounded-full animate-spin inline-block"></span>

                                Ажурирај
                            </Button>
                        </div>
                    </form>
                </div>
                <!-- <div class="w-full  rounded-xl border border-sidebar-border/70 bg-gray-50 dark:border-sidebar-border">
                    <div v-if="pdfUrl" class="h-full  rounded border bg-red-400">
                        <iframe :src="!pdfUrl?.pdfUrl || document.file" class="h-[100%] w-full" />
                    </div>
                </div> -->
                <div class="w-full rounded-xl border border-sidebar-border/70 bg-gray-50 dark:border-sidebar-border">
                    <div v-if="pdfUrl" class="h-full  rounded border bg-red-400">
                        <iframe :src="pdfUrl" class="h-[100%] w-full" />
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
