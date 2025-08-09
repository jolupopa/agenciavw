import { PlaceholderPattern } from '@/components/ui/placeholder-pattern';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, usePage } from '@inertiajs/react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Propiedades',
        href: route('properties.index'),
    },
    {
        title: 'Crear',
        href: route('properties.create'),
    },
];

export default function index() {
    //console.log('usePage :', usePage().props);
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Propiedades" />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
                Listado de propiedades
            </div>
        </AppLayout>
    );
}
