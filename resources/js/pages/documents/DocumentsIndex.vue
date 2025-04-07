<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';



const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Листа на Сите Записи',
        href: '/documents',
    },
];

const props = defineProps({
    docTypes: {
        type: Array,
        required: true,
    },
});



const pdfUrl = ref<string | null>(null);
const docType = ref<number | null>(null);




</script>

<template>
<Head title="Листа на сите Записи" />

<AppLayout :breadcrumbs="breadcrumbs" class="h-full">

</AppLayout>
</template>
