
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, useForm } from '@inertiajs/react';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import {Label} from '@/components/ui/label';
import {Input} from '@/components/ui/input';
import { Button } from '@/components/ui/button';
import InputError from '@/components/input-error';
import { ArrowLeft } from 'lucide-react';
import { LoaderCircle } from 'lucide-react';

// Define a type for Typeproperty if you haven't already
interface Typeproperty {
    name: string;
    active: boolean;
}

export default function TypepropertyForm({...props}) {


     // Destructure props and provide default values for typeproperty
    // if it's not passed (e.g., when creating a new one).
    const { typeproperty = { name: '', active: true }, isView, isEdit } = props;


    const breadcrumbs: BreadcrumbItem[] = [
    {
        title: `${isView ? 'Ver' : isEdit ? 'Editar' : 'Crear'} Tpo de Propiedad`,
        href:  route('typeproperty.create'),
    },
];

    const {data, setData, post, put, processing, errors, reset }  = useForm<{
        name: string;
        active: boolean; // <--- This is the key change
    }>({
        // Now typeproperty will always have a name and active property,
        // even if it's the default empty object.
        name: typeproperty.name,
        active: typeproperty.active,
    });



    const submit = (e: React.FormEvent<HTMLFormElement>) => {
        e.preventDefault();

        if (isEdit) {
            // Assuming you have a route like 'typeproperty.update' that takes an ID
            put(route('typeproperty.update', typeproperty.id)); // You'll need typeproperty.id if editing
                reset('name', 'active');    
        } else {
            post(route('typeproperty.store'));
                reset('name', 'active');
        }

    };


    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="crear tipo de propiedad" />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
                <div className="ml-auto">
                    <Link
                        as="button"
                        className="flex items-center bg-indigo-600 hover:bg-indigo-500 text-white text-sm px-4 py-2 rounded-lg cursor-pointer"
                        href={route('typeproperty.index')}
                    >
                    <ArrowLeft size={18} className='me-2'/>
                        Regresar Listado
                    </Link>
                </div>
                <Card className="bg-gray-50 w-1/2 mx-auto">
                    <CardHeader>
                        <CardTitle>
                             {isView ? 'Ver' : isEdit ? 'Editar' : 'Crear'} Tpo de Propiedad
                        </CardTitle>
                    </CardHeader>
                    <CardContent>
                        <form onSubmit={submit} className="flex flex-col " autoComplete="off">
                            <div className="">

                                {/** Yypeproperty name */}
                                <Label htmlFor="name">Nombre Tipo de propiedad</Label>
                                <Input
                                    value={data.name}
                                    id="name"
                                    name="name"
                                    type="text"
                                    placeholder="nombre del tipo de propiedad"
                                    autoFocus
                                    tabIndex={1}
                                    onChange={(e) => setData('name', e.target.value)}
                                    disabled={processing || isView}
                                />
                                <InputError message={errors.name} />


                            </div>

                            <div>
                                {/** Yypeproperty activa */}
                                <Label htmlFor="activa">Estado </Label>
                                <Input
                                    id="activa"
                                    name="activa"
                                    type="checkbox"
                                    checked={data.active} // Bind checked property to data.activa
                                    tabIndex={2}
                                    className={"w-8 h-8"}
                                    onChange={(e) => setData('active', e.target.checked)} // Update with e.target.checked
                                    disabled={processing || isView}
                              />
                                <InputError message={errors.active} />
                            </div>

                            <div>
                                {!isView && (
                                    <Button type="submit" className="mt-4 w-fit cursor-pointer" tabIndex={3}>
                                         {processing && <LoaderCircle className="h-4 w-4 animate-spin" />} 

                                          {processing ? ( isEdit ? 'Actualizando...' : 'Creando...') : isEdit ? 'Actualizar' : 'Crear'} Tipo de propiedad
                                    </Button>
                                )}
                            </div>

                        </form>
                    </CardContent>

                </Card>


            </div>
        </AppLayout>
    );
}
