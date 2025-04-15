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
    document: {
        type: Object,
        required: true
    },
});



const breadcrumbs = [
    { title: 'Детали за Запис', href: `/document/${props.document.id}/show` },
];

</script>

<template>

    <Head title="Детали за Запис" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">
            <div class="py-4 bg-gray-50 rounded-lg my-4 px-6">


                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <!-- <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Product name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Color
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Category
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Price
                                </th>
                            </tr>
                        </thead> -->
                        <tbody>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                <th scope="row"
                                    class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Изработил / Оператор
                                </th>
                                <td class="px-2 py-1 font-bold text-blue-600 ">
                                    {{ document.user?.name }} на
                                    <span class=" text-red-600 ps-4">
                                        {{ new Date(document.created_at).toLocaleDateString('mk-MK', {
                                            day: '2-digit',
                                            month: '2-digit', year: 'numeric'
                                        }) }}
                                    </span>
                                </td>

                            </tr>
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-slate-50">
                                <th scope="row"
                                    class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Тип на Документ
                                </th>
                                <td class="px-2 py-1 font-bold text-blue-600">
                                    {{ document.doc_type?.doc_type }}
                                </td>

                            </tr>

                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-slate-50">
                                <th scope="row"
                                    class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Датум на {{ document.doc_type?.doc_type }}
                                </th>
                                <td class="px-2 py-1 font-bold text-blue-600">
                                    {{ new Date(document.datum_na_dokument).toLocaleDateString('mk-MK', {
                                        day: '2-digit',
                                        month: '2-digit', year: 'numeric'
                                    }) }}
                                </td>
                            </tr>

                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-slate-50">
                                <th scope="row"
                                    class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Марка
                                </th>
                                <td class="px-2 py-1 font-bold text-blue-600">
                                    {{ document?.marka }}
                                </td>
                            </tr>

                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-slate-50">
                                <th scope="row"
                                    class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Тип/Варијанта/Изведба
                                </th>
                                <td class="px-2 py-1 font-bold text-blue-600">
                                    {{ document?.tip }} / {{ document?.varijanta }} / {{ document?.izvedba }}
                                </td>
                            </tr>

                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-slate-50">
                                <th scope="row"
                                    class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Година на Производство
                                </th>
                                <td class="px-2 py-1 font-bold text-blue-600">
                                    {{ document?.godina_na_proizvodstvo || '/' }}
                                </td>
                            </tr>

                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-slate-50">
                                <th scope="row"
                                    class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Најголема Конструктивна Вкупна Маса на Возилото
                                </th>
                                <td class="px-2 py-1 font-bold"
                                    :class="document?.najgolema_konstruktivna_vkupna_masa ? 'text-blue-600' : 'text-gray-400'">
                                    {{ document?.najgolema_konstruktivna_vkupna_masa || '/' }} Kg
                                </td>
                            </tr>

                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-slate-50">
                                <th scope="row"
                                    class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Најголема Легална Вкупна Маса на Возилото при Регистрација
                                </th>
                                <td class="px-2 py-1 font-bold"
                                    :class="document?.najgolema_legalna_vkupna_masa ? 'text-blue-600' : 'text-gray-400'">
                                    {{ document?.najgolema_legalna_vkupna_masa || '/' }} Kg
                                </td>
                            </tr>

                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-slate-50">
                                <th scope="row"
                                    class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Најголема Легална Вкупна Маса на Група на Возила при Регистрација
                                </th>
                                <td class="px-2 py-1 font-bold"
                                    :class="document?.najgolema_legalna_vkupna_masa_na_grupa_vozila ? 'text-blue-600' : 'text-gray-400'">
                                    {{ document?.najgolema_legalna_vkupna_masa_na_grupa_vozila || '/' }} Kg
                                </td>
                            </tr>

                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-slate-50">
                                <th scope="row"
                                    class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Маса на Возилото
                                </th>
                                <td class="px-2 py-1 font-bold"
                                    :class="document?.masa_na_voziloto ? 'text-blue-600' : 'text-gray-400'">
                                    {{ document?.masa_na_voziloto || '/' }} Kg
                                </td>
                            </tr>

                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-slate-50">
                                <th scope="row"
                                    class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Категорија и Вид на Возилото
                                </th>
                                <td class="px-2 py-1 font-bold"
                                    :class="document?.kategorija_i_vid ? 'text-blue-600' : 'text-gray-400'">
                                    {{ document?.kategorija_i_vid || '/' }}
                                </td>
                            </tr>

                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-slate-50">
                                <th scope="row"
                                    class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Облик и Намена на Каросеријата
                                </th>
                                <td class="px-2 py-1 font-bold"
                                    :class="document?.oblik_i_namena ? 'text-blue-600' : 'text-gray-400'">
                                    {{ document?.oblik_i_namena || '/' }}
                                </td>
                            </tr>

                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-slate-50">
                                <th scope="row"
                                    class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Ознака на Одобрение
                                </th>
                                <td class="px-2 py-1 font-bold"
                                    :class="document?.eu_odobrenie ? 'text-blue-600' : 'text-gray-400'">
                                    {{ document?.eu_odobrenie || '/' }}
                                </td>
                            </tr>

                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-slate-50">
                                <th scope="row"
                                    class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Број на Потврдата за Сообразност (COC)
                                </th>
                                <td class="px-2 py-1 font-bold"
                                    :class="document?.broj_na_coc ? 'text-blue-600' : 'text-gray-400'">
                                    {{ document?.broj_na_coc || '/' }}
                                </td>
                            </tr>

                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-slate-50">
                                <th scope="row"
                                    class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Број на Оски
                                </th>
                                <td class="px-2 py-1 font-bold"
                                    :class="document?.broj_na_oski ? 'text-blue-600' : 'text-gray-400'">
                                    {{ document?.broj_na_oski || '/' }}
                                </td>
                            </tr>

                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-slate-50">
                                <th scope="row"
                                    class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Должина
                                </th>
                                <td class="px-2 py-1 font-bold"
                                    :class="document?.dolzina ? 'text-blue-600' : 'text-gray-400'">
                                    {{ document?.dolzina || '/' }} mm
                                </td>
                            </tr>

                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-slate-50">
                                <th scope="row"
                                    class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Ширина
                                </th>
                                <td class="px-2 py-1 font-bold"
                                    :class="document?.sirina ? 'text-blue-600' : 'text-gray-400'">
                                    {{ document?.sirina || '/' }} mm
                                </td>
                            </tr>

                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-slate-50">
                                <th scope="row"
                                    class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Висина
                                </th>
                                <td class="px-2 py-1 font-bold"
                                    :class="document?.visina ? 'text-blue-600' : 'text-gray-400'">
                                    {{ document?.visina || '/' }} mm
                                </td>
                            </tr>

                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-slate-50">
                                <th scope="row" rowspan="2"
                                    class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white align-middle">
                                    Дозволени Пневматици и Наплатки
                                </th>
                                <td class="px-2 py-1 font-bold"
                                    :class="document?.dozvoleni_pnevmatici_i_naplatki_1 ? 'text-blue-600' : 'text-gray-400'">
                                    {{ document?.dozvoleni_pnevmatici_i_naplatki_1 || '/' }}
                                </td>
                            </tr>
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-slate-50">
                                <td class="px-2 py-1 font-bold"
                                    :class="document?.dozvoleni_pnevmatici_i_naplatki_2 ? 'text-blue-600' : 'text-gray-400'">
                                    {{ document?.dozvoleni_pnevmatici_i_naplatki_2 || '/' }}
                                </td>
                            </tr>

                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-slate-50">
                                <th scope="row"
                                    class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Тип на Моторот
                                </th>
                                <td class="px-2 py-1 font-bold"
                                    :class="document?.tip_motor ? 'text-blue-600' : 'text-gray-400'">
                                    {{ document?.tip_motor || '/' }}
                                </td>
                            </tr>

                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-slate-50">
                                <th scope="row"
                                    class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Зафатнина на Моторот
                                </th>
                                <td class="px-2 py-1 font-bold"
                                    :class="document?.cm3 ? 'text-blue-600' : 'text-gray-400'">
                                    {{ document?.cm3 || '/' }} cm3
                                </td>
                            </tr>

                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-slate-50">
                                <th scope="row"
                                    class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Силина на Моторот
                                </th>
                                <td class="px-2 py-1 font-bold"
                                    :class="document?.kw ? 'text-blue-600' : 'text-gray-400'">
                                    {{ document?.kw || '/' }} kW
                                </td>
                            </tr>

                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-slate-50">
                                <th scope="row"
                                    class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Вид на Гориво
                                </th>
                                <td class="px-2 py-1 font-bold"
                                    :class="document?.fuel.fuel ? 'text-blue-600' : 'text-gray-400'">
                                    {{ document?.fuel.fuel || '/' }}
                                </td>
                            </tr>

                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-slate-50">
                                <th scope="row"
                                    class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Број на Вртежи
                                </th>
                                <td class="px-2 py-1 font-bold"
                                    :class="document?.broj_na_vrtezi ? 'text-blue-600' : 'text-gray-400'">
                                    {{ document?.broj_na_vrtezi || '/' }} min-1
                                </td>
                            </tr>

                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-slate-50">
                                <th scope="row"
                                    class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Идентификационен Број на Моторот VIN
                                </th>
                                <td class="px-2 py-1 font-bold"
                                    :class="document?.vin ? 'text-blue-600' : 'text-gray-400'">
                                    {{ document?.vin || '/' }}
                                </td>
                            </tr>

                            <tr
                                class="bg-slate-100 border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-slate-50 b">
                                <th scope="row"
                                    class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Однос Силина/Маса (Само за Моторцикли)
                                </th>
                                <td class="px-2 py-1 font-bold"
                                    :class="document?.vin ? 'text-blue-600' : 'text-gray-400'">
                                    {{ document?.vin || '/' }}
                                </td>
                            </tr>

                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-slate-50">
                                <th scope="row"
                                    class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Боја на Возилото
                                </th>
                                <td class="px-2 py-1 font-bold"
                                    :class="document?.boja_na_voziloto ? 'text-blue-600' : 'text-gray-400'">
                                    {{ document?.boja_na_voziloto || '/' }}
                                </td>
                            </tr>

                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-slate-50">
                                <th scope="row"
                                    class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    CO2 [NEDC] / [WLTP] (g/km)
                                </th>
                                <td class="px-2 py-1 font-bold"
                                    :class="document?.co2_nedc ? 'text-blue-600' : 'text-gray-400'">
                                    {{ document?.co2_nedc || '/' }}
                                    <span class="">
                                        /
                                    </span>

                                </td>
                                <td class="px-2 py-1 font-bold"
                                    :class="document?.co2_wltp ? 'text-blue-600' : 'text-gray-400'">
                                    {{ document?.co2_wltp || '/' }}

                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </AppLayout>
</template>
