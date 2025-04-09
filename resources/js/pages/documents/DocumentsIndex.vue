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
            <table class="min-w-full divide-y divide-gray-200 shadow table-auto sm:rounded-lg">
                <thead class="bg-primary">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-white uppercase bg-sky-700">
                            Id
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-white uppercase bg-sky-700">
                            Бр
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-white uppercase bg-sky-700">
                            Tip na Dokument
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-white uppercase bg-sky-700">
                            Марка
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-white uppercase bg-sky-700">
                            Тип
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-white uppercase bg-sky-700">
                            Варијанта
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr class="hover:bg-slate-100" v-for="(document, index) in documents.data" :key="document.id">
                        <td class="text-xs text-slate-300">
                            {{ document.id }}
                        </td>
                        <td class="">
                            {{ documents.from + index }}
                        </td>
                        <td class="font-bold">
                            {{ document.doc_type ? document.doc_type.doc_type : '/' }}
                        </td>
                        <td class="font-bold">
                            {{ document.marka }}
                        </td>
                        <td class="font-bold">
                            {{ document.tip }}
                        </td>
                        <td class="font-bold">
                            {{ document.varijanta }}
                        </td>

                        <td class="">
                            <div class="flex gap-2">



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
