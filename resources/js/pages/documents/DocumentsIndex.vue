<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { onMounted } from 'vue';

const props = defineProps({
    documents: {
        type: Object,
        required: true
    },
});

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
            <table class="min-w-full divide-y-2 divide-gray-800 shadow table-auto sm:rounded-lg rounded-lg">
                <thead class="bg-primary text-[11px]">
                    <tr class="bg-gray-200 text-gray-700 rounded pt-2">

                        <th scope="col" class="px-6 py-3  font-medium tracking-wider text-left">
                            Бр
                        </th>
                        <th scope="col" class="px-6 py-3  font-medium text-left  ">
                            Тип на Документ
                        </th>
                        <th scope="col" class="px-6 py-3  font-medium  text-left  ">
                            Марка
                        </th>
                        <th scope="col" class="px-6 py-3  font-medium  text-left  ">
                            Тип
                        </th>
                        <th scope="col" class="px-6 py-3  font-medium  text-left  ">
                            Варијанта
                        </th>
                        <th scope="col" class="px-6 py-3  font-medium  text-left  ">
                            Изведба
                        </th>
                        <th scope="col" class="px-6 py-3  font-medium  text-left  ">
                            ЕУ Одобрение
                        </th>
                        <th scope="col" class="px-6 py-3  font-medium  text-left  ">
                            Зафатнина на Мотор (cm3)
                        </th>
                        <th scope="col" class="px-6 py-3  font-medium  text-left  ">
                            Силина на Мотор (kW)
                        </th>
                        <th scope="col" class="px-6 py-3  font-medium  text-left  ">
                            Гориво
                        </th>
                        <th scope="col" class="px-6 py-3  font-medium  text-left  ">
                            CO2 (g/km)
                        </th>
                        <th scope="col" class="px-6 py-3  font-medium  text-left  ">
                            Акција
                        </th>

                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-x divide-gray-200 text-[12px]">
                    <tr class="hover:bg-slate-100 " v-for="(document, index) in documents.data" :key="document.id">

                        <td class="">
                            {{ documents.from + index }}
                        </td>
                        <td class="font-normal py-1 ">
                            {{ document.doc_type ? document.doc_type.doc_type : '/' }}
                        </td>
                        <td class="font-normal py-1 ">
                            {{ document.marka }}
                        </td>
                        <td class="font-normal py-1 ">
                            {{ document.tip }}
                        </td>
                        <td class="font-normal py-1 ">
                            {{ document.varijanta }}
                        </td>
                        <td class="font-normal py-1 ">
                            {{ document.izvedba }}
                        </td>
                        <td class="font-normal py-1 ">
                            {{ document.eu_odobrenie }}
                        </td>
                        <td class="font-normal py-1 ">
                            {{ document.cm3 }}
                        </td>
                        <td class="font-normal py-1 ">
                            {{ document.kw }}
                        </td>
                        <td class="font-normal py-1 ">
                            {{ document.fuel ? document.fuel.fuel : '/' }}
                        </td>
                        <td class="font-normal py-1 " v-if="!document.co2_nedc">
                            {{ document.co2_wltp }}
                        </td>
                        <td class="font-normal py-1 " v-else>
                            {{ document.co2_nedc }}
                        </td>

                        <td class="">
                            <div class="flex gap-2 py-1 ">

                                <button>
                                    Edit
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
