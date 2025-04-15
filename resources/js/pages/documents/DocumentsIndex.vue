<script setup lang="js">

import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { onMounted, watch, ref } from 'vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import debounce from 'lodash/debounce';

const props = defineProps({
    documents: {
        type: Object,
        required: true
    },
});

const search_marka = ref('');
const search_tip = ref('');
const search_varijanta = ref('');
const search_izvedba = ref('');
const search_odobrenie = ref('');

watch(
    [search_marka, search_tip, search_varijanta, search_izvedba, search_odobrenie],
    debounce(() => {
        router.get('/documents', {
            search_marka: search_marka.value,
            search_tip: search_tip.value,
            search_varijanta: search_varijanta.value,
            search_izvedba: search_izvedba.value,
            search_odobrenie: search_odobrenie.value,
        }, {
            preserveState: true,
            replace: true
        });
    }, 500)
);

const breadcrumbs = [
    { title: 'Листа на Сите Записи', href: '/documents' },
];

const getPaginationLabel = (label) => {
    if (label === "&laquo; Previous") return "<<";
    if (label === "Next &raquo;") return ">>";
    return label;
};

// On mounted, log documents data for debugging
onMounted(() => {
    // Log the first document's docType to see what's available
    if (props.documents.data && props.documents.data.length > 0) {
        console.log("First document:", props.documents.data[0]);
        console.log("DocType on first document:", props.documents.data[0].docType);
    }
});
</script>

<template>

    <Head title="Листа на сите Записи" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">
            <!-- Filters -->
            <div class="py-4 bg-gray-100 rounded-lg my-4 px-6">
                <div class="grid grid-cols-1 md:grid-cols-5 gap-2">
                    <!-- Filter_Marka -->
                    <div class="grid gap-2">
                        <Label for="filter_marka" class="ms-4">Марка</Label>
                        <Input id="filter_marka" v-model="search_marka" type="search" autofocus :tabindex="1"
                            class="rounded-full" />
                        <!-- <InputError :message="form.errors.co2_nedc" /> -->
                    </div>

                    <!-- Filter_Marka -->
                    <div class="grid gap-2">
                        <Label for="filter_tip" class="ms-4">Тип</Label>
                        <Input id="filter_tip" v-model="search_tip" type="search" autofocus :tabindex="1"
                            class="rounded-full" />
                        <!-- <InputError :message="form.errors.co2_nedc" /> -->
                    </div>

                    <!-- Filter_Marka -->
                    <div class="grid gap-2">
                        <Label for="filter_varijanta" class="ms-4">Варијанта</Label>
                        <Input id="filter_varijanta" v-model="search_varijanta" type="search" autofocus :tabindex="1"
                            class="rounded-full" />
                        <!-- <InputError :message="form.errors.co2_nedc" /> -->
                    </div>

                    <!-- Filter_Marka -->
                    <div class="grid gap-2">
                        <Label for="filter_izvedba" class="ms-4">Изведба</Label>
                        <Input id="filter_izvedba" v-model="search_izvedba" type="search" autofocus :tabindex="1"
                            class="rounded-full" />
                        <!-- <InputError :message="form.errors.co2_nedc" /> -->
                    </div>

                    <!-- Filter_Marka -->
                    <div class="grid gap-2">
                        <Label for="filter_odobrenie" class="ms-4">Одобрение</Label>
                        <Input id="filter_odobrenie" v-model="search_odobrenie" type="search" autofocus :tabindex="1"
                            class="rounded-full" />
                        <!-- <InputError :message="form.errors.co2_nedc" /> -->
                    </div>


                </div>
            </div>
            <table
                class="min-w-full divide-y-2 divide-gray-800 shadow table-auto sm:rounded-lg rounded-lg border-collapse border border-gray-400">
                <thead class="bg-primary text-[11px]">
                    <tr class="bg-gray-200 text-gray-700 rounded pt-2">

                        <th scope="col"
                            class="px-6 py-3  font-medium tracking-wider text-left border-collapse border border-gray-400">
                            Бр
                        </th>
                        <th scope="col"
                            class="px-6 py-3  font-medium text-left  border-collapse border border-gray-400">
                            Тип на Документ
                        </th>
                        <th scope="col"
                            class="px-6 py-3  font-medium  text-left  border-collapse border border-gray-400">
                            Марка
                        </th>
                        <th scope="col"
                            class="px-6 py-3  font-medium  text-left border-collapse border border-gray-400 ">
                            Тип
                        </th>
                        <th scope="col"
                            class="px-6 py-3  font-medium  text-left  border-collapse border border-gray-400">
                            Варијанта
                        </th>
                        <th scope="col"
                            class="px-6 py-3  font-medium  text-left border-collapse border border-gray-400 ">
                            Изведба
                        </th>
                        <th scope="col"
                            class="px-6 py-3  font-medium  text-left border-collapse border border-gray-400 ">
                            ЕУ Одобрение
                        </th>
                        <th scope="col"
                            class="px-6 py-3  font-medium  text-left border-collapse border border-gray-400">
                            Зафатнина на Мотор (cm3)
                        </th>
                        <th scope="col"
                            class="px-6 py-3  font-medium  text-left border-collapse border border-gray-400 ">
                            Силина на Мотор (kW)
                        </th>
                        <th scope="col"
                            class="px-6 py-3  font-medium  text-left  border-collapse border border-gray-400">
                            Гориво
                        </th>
                        <th scope="col"
                            class="px-6 py-3  font-medium  text-left  border-collapse border border-gray-400">
                            CO2 (g/km)
                        </th>
                        <th scope="col"
                            class="px-6 py-3  font-medium  text-left border-collapse border border-gray-400 ">
                            Акција
                        </th>

                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-x divide-gray-200 text-[12px]">
                    <tr class="hover:bg-slate-100 text-center" v-for="(document, index) in documents.data"
                        :key="document.id">

                        <td class="border-collapse border border-gray-400">
                            {{ documents.from + index }}
                        </td>
                        <td class="font-normal py-1 border-collapse border border-gray-400">
                            {{ document.doc_type ? document.doc_type.doc_type : '/' }}
                        </td>
                        <td class="font-normal py-1 border-collapse border border-gray-400">
                            {{ document.marka }}
                        </td>
                        <td class="font-normal py-1 border-collapse border border-gray-400">
                            {{ document.tip }}
                        </td>
                        <td class="font-normal py-1 border-collapse border border-gray-400">
                            {{ document.varijanta }}
                        </td>
                        <td class="font-normal py-1 border-collapse border border-gray-400">
                            {{ document.izvedba }}
                        </td>
                        <td class="font-normal py-1 border-collapse border border-gray-400">
                            {{ document.eu_odobrenie }}
                        </td>
                        <td class="font-normal py-1 border-collapse border border-gray-400">
                            {{ document.cm3 }}
                        </td>
                        <td class="font-normal py-1 border-collapse border border-gray-400">
                            {{ document.kw }}
                        </td>
                        <td class="font-normal py-1 border-collapse border border-gray-400 ">
                            {{ document.fuel ? document.fuel.fuel : '/' }}
                        </td>
                        <td class="font-normal py-1 border-collapse border border-gray-400" v-if="!document.co2_nedc">
                            {{ document.co2_wltp }}
                        </td>
                        <td class="font-normal py-1 border-collapse border border-gray-400" v-else>
                            {{ document.co2_nedc }}
                        </td>

                        <td class="">
                            <div class="flex gap-2 py-1 ">

                                <Link
                                    class="px-2 py-1 bg-sky-500 ms-1 rounded-md text-[9px] shadow-sm hover:bg-sky-700 text-white font-bold"
                                    :href="`/document/${document.id}/show`">
                                погледни
                                </Link>
                                <Link
                                    class="px-2 py-1 bg-yellow-500 ms-1 rounded-md text-[9px] shadow-sm hover:bg-yellow-700 text-white font-bold"
                                    :href="`/document/${document.id}/edit`">
                                измени
                                </Link>
                                <button
                                    class="px-2 py-1 bg-red-500 ms-1 rounded-md text-[9px] shadow-sm hover:bg-red-700 text-white font-bold">
                                    избриши
                                </button>


                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Pagination Links -->
            <div v-if="documents && documents.links" class="flex flex-col lg:flex-row lg:justify-around">
                <div class="mt-2">
                    <Link v-for="link in documents.links" :key="link.label" :href="link.url || '#'"
                        class="p-1 mx-1 hover:bg-sky-200" :class="{
                            'text-slate-300': !link.url,
                            'text-sky-500 font-bold': link.active,
                        }">
                    {{ getPaginationLabel(link.label) }}
                    </Link>
                </div>

                <p class="mt-3 text-xs text-gray-500">
                    Прикажани се од {{ documents.from }} до
                    {{ documents.to }} од вкупно
                    {{ documents.total }} записи
                </p>
            </div>
        </div>
    </AppLayout>
</template>
