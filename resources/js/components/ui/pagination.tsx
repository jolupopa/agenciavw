import { Link } from "@inertiajs/react";


interface LinkProps {
    active: boolean;
    label: string;
    url: string | null;
}

interface Meta {
    current_page: number;
    last_page: number;
    per_page: number;
    total: number;
    from: number;
    to: number;
}

interface PaginationProps {
    links: LinkProps[];
    meta: Meta;
}

export const Pagination = ({ links, meta }: PaginationProps) => {

      console.log("Links recibidos en Pagination:", links);
    console.log("Tipo de links:", typeof links, Array.isArray(links)); // Esto es crucial

    return (
        <div className="flex items-center justify-between mt-2">
            <p>
                Mostrando {meta.from} - {meta.to} de {meta.total}{' '}
            </p>

            <div className="flex gap-2">
                {links.map((link, index) => (
                    <Link
                        as="button"
                        className={`px-3 py-2 border rounded ${link.active ? 'bg-gray-800 text-white' : ''} `}
                    href={link.url || '#'}
                    key={index}
                    dangerouslySetInnerHTML={{ __html: link.label }}
                    disabled={!link.url}
                    />
                ))}
            </div>
        </div>
    );
};
