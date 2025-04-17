<script setup lang="ts">
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';
import { BookOpen, Folder, LayoutGrid, LibraryBig, Users } from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';
import { type SharedData, type User } from '@/types';

const page = usePage<SharedData>();
const user = page.props.auth.user as User;

const mainNavItems: NavItem[] = [
    {
        title: 'Нов Запис',
        href: '/dashboard',
        icon: LayoutGrid,
    },
    {
        title: 'Сите Записи',
        href: '/documents',
        icon: LibraryBig,
    },
];

if (user.role_id !== 3) {
    mainNavItems.push({
        title: 'Корисници',
        href: '/documents',
        icon: Users,
    });
}
</script>


<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="route('dashboard')">
                        <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <!-- <NavFooter :items="footerNavItems" /> -->
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
