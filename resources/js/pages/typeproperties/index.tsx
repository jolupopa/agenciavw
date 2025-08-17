
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, usePage, router, useForm } from '@inertiajs/react';
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert';
import { useEffect, useState, useRef } from 'react';
import { CirclePlusIcon, Eye, Pencil, Trash2, X } from 'lucide-react';
import { Button } from '@/components/ui/button';
import { Pagination } from '@/components/ui/pagination';
import { Input } from '@headlessui/react';



const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Tpo de Propiedades',
        href: '/typeproperty',
    },
];

interface PaginationLinkProps {
    active: boolean;
    label: string;
    url: string | null; // Puede ser null para 'Previous'/'Next' en los extremos
}



interface Meta {
    current_page: number;
    last_page: number;
    per_page: number;
    total: number;
    from: number;
    to: number;
     // Esta es la clave: 'links' dentro de 'meta' es el array de enlaces individuales
    links: PaginationLinkProps[];
    path: string; // La URL base para la paginación
}

interface TopLevelLinks {
    first: string;
    last: string;
    prev: string | null;
    next: string | null;
}

interface TypepropertyPagination {
    data: Typeproperty[];
    links: TopLevelLinks;
    meta: Meta;
}

interface Typeproperty {
    id: number;
    name: string;
    active: boolean;
}

interface filtersProps {
    search: string;
}

interface IndexProps {
    typeproperties: TypepropertyPagination,
    filters: filtersProps
}

export default function Index( { typeproperties, filters }: IndexProps ) {
    console.log('filtro:',filters);
    //console.log(typeproperties);

    console.log('tipodepropiedades :', typeproperties );
    const { flash } = usePage<{ flash?: { success?: string; error?: string } }>().props;
    const flashMessage = flash?.success || flash?.error;
    const [showAlert, setShowAlert] = useState(!!flashMessage);

     // Referencia para el temporizador de debouncing
    const debounceTimeout = useRef<NodeJS.Timeout | null>(null);

    useEffect(() => {
        if (flashMessage) {
            setShowAlert(true);
            const timer = setTimeout(() => {
                setShowAlert(false);
            }, 3000);
            return () => clearTimeout(timer);
        }
    }, [flash]);

    const { data, setData } = useForm({
        search: filters.search || '',
        per_page: typeproperties.meta.per_page,
    });


    const handleChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        const value  = e.target.value;
        setData('search', value);

         // Limpia el temporizador anterior si existe
        if (debounceTimeout.current) {
            clearTimeout(debounceTimeout.current);
        }

         // Establece un nuevo temporizador
        debounceTimeout.current = setTimeout(() => {
            router.get(
                route('typeproperty.index'),
                {
                    search: value,
                    per_page: data.per_page,
                },
                {
                    preserveScroll: true,
                    preserveState: true,
                },
            );
        }, 300); // Retraso de 300 milisegundos (ajusta según necesites)
    };

    // To reset Aplied filter
    const handleReset = () => {
         // Limpia el temporizador de debouncing al resetear
        if (debounceTimeout.current) {
            clearTimeout(debounceTimeout.current);
        }

        setData('search', '');

         router.get(route('typeproperty.index'), {},  {
            preserveScroll: true,
            preserveState: true,
        });
    };

    const handlePerPageChange = (e: React.ChangeEvent<HTMLSelectElement>) => {
        const value = e.target.value;
        setData('per_page', parseInt(value, 10));

        router.get(
            route('typeproperty.index'),
            {
                search: data.search,
                per_page: value,
            },
            {
                preserveScroll: true,
                preserveState: true,
            },
        );
    };


    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Administar tipo de propiedad" />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
                {showAlert && flashMessage && (

                    <Alert variant={'default'}
                            className={`${flash?.success ? 'bg-green-600' : (flash?.error ? 'bg-red-600' : '')} ml-auto max-w-md text-white`}
                            >
                        <AlertTitle>{flash.success ? 'Success' : 'Error'}</AlertTitle>
                        <AlertDescription className='text-white text-sm'>
                            {flash.success ? 'Success!' :  'Error!'} {''}
                            {flashMessage}
                        </AlertDescription>
                    </Alert>
                )}

                <div className="flex items-center justify-between">
                    <Input
                        className="h-10 w-1/3 border bg-gray-50 px-5"
                        type="text"
                        placeholder="Buscar..."
                        name="search"
                        onChange={handleChange}
                        value={data.search}
                    />
                    <Button onClick={handleReset} className='h-10 cursor-pointer bg-red-600 hover:bg-red-500 text-white text-sm px-4 py-2 rounded-lg'>
                        <X size={20} />
                    </Button>

                    <div className="ml-4">
                        <select
                            name="per_page"
                            id="per_page"
                            value={data.per_page}
                            onChange={handlePerPageChange}
                            className="h-10 border bg-gray-50 px-5"
                        >
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>

                    {/* Add typeproperty button */}
                    <div className="ml-auto">
                        <Link className=" flex items-center bg-indigo-600 hover:bg-indigo-500 text-white text-sm px-4 py-2 rounded-lg cursor-pointer" href={route('typeproperty.create')}><CirclePlusIcon  className={'me-2'} /> Nuevo</Link>
                    </div>
                </div>
                <div className="overflow-hidden rounded-lg border bg-white shadow-sm">
                    <table className="w-full table-auto">
                        <thead>
                            <tr className="bg-gray-800 text-white">
                                <th className="p-4 border">#</th>
                                <th className="p-4 border">Nombre</th>
                                <th className="p-4 border">Activa</th>
                                <th className="p-4 border">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            { typeproperties.data.length > 0 ? (

                                typeproperties.data.map((typeproperty, index) => (
                                <tr key={index}>
                                    <td className="px-4 py-2 text-center border">{typeproperties.meta.from + index}</td>
                                    <td className="px-4 py-2 text-center border">{typeproperty.name}</td>
                                    <td className="px-4 py-2 text-center border">{typeproperty.active ? 'Si' : 'No'}</td>
                                    <td className="px-4 py-2 text-center border">
                                        <Link
                                            as="button"
                                            className='bg-sky-600 text-white p-2 rounded-lg cursor-pointer hover:opacity-90'
                                            href={route('typeproperty.show', typeproperty.id)}
                                        >
                                            <Eye size={18}/>
                                        </Link>
                                        <Link
                                            as="button"
                                            className='ms-2 bg-blue-600 text-white p-2 rounded-lg cursor-pointer hover:opacity-90'
                                            href={route('typeproperty.edit', typeproperty.id)}
                                        >
                                            <Pencil size={18}/>
                                        </Link>
                                        <Button

                                            className='ms-2 bg-red-600 text-white p-2 rounded-lg cursor-pointer hover:opacity-90'
                                            onClick={ () => {
                                                            if(confirm('Estas seguro de eliminar este registro')) {
                                                                router.delete(route('typeproperty.destroy', typeproperty.id ,) , {
                                                                    preserveScroll: true,
                                                                })
                                                            }
                                                        }
                                                     }
                                        >
                                            <Trash2 size={18}/>
                                        </Button>
                                    </td>
                                    </tr>
                                ))
                            ) : (
                                <tr>
                                    <td colSpan={4} className={"text-center text-2xl"}>No hay registros</td>
                                </tr>
                            )}
                        </tbody>


                    </table>
                </div>

                <Pagination links={typeproperties.meta.links} meta={typeproperties.meta}  />



            </div>
        </AppLayout>
    );
}
