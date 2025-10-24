import AppLayout from '@/layouts/app-layout';
import { Head, Link, usePage, useForm } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { DataTable } from '@/components/ui/data-table';
import { ColumnDef } from '@tanstack/react-table';
import { Loader2 } from 'lucide-react';
import { type BreadcrumbItem } from '@/types';
//import products, { create, edit, destroy } from '@/routes/products';
import { useState } from 'react';

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Productos',
    href: 'products',
    //href: products.index(),
  },
];

interface Product {
  id: number;
  name: string;
  description: string;
  stock: number;
  price: number;
}

interface ProductsPageProps {
  products: Product[];
}

export default function Index() {
  const { products } = usePage<ProductsPageProps>().props;
  const [loading, setLoading] = useState(false);
  const {processing, delete: destroy} = useForm();

  const handleDelete = (id: number) => {
    if (confirm('Are you sure you want to delete this product')) {
            destroy(route('products.destroy', id))
      /* router.delete(destroy(id).url, {
        onFinish: () => setLoading(false),
      }); */
    }
  };

  const columns: ColumnDef<Product>[] = [
    { accessorKey: 'id',  header: 'ID', },
    { accessorKey: 'name', header: 'Nombre', },
    { accessorKey: 'description', header: 'Descripción', },
    { accessorKey: 'stock', header: 'Stock', },
    { accessorKey: 'price',header: 'Precio',
      cell: ({ row }) => <>${row.original.price}</>,
    },
    {
      id: 'acciones',
      header: 'Acciones',
      cell: ({ row }) => (
        <div className="flex justify-end space-x-2">
          <Link href={route('products.edit', row.original.id)}>
            <Button className="bg-slate-500 hover:bg-slate-700">Editar</Button>
          </Link>

          <Button
            onClick={() => handleDelete(row.original.id)}
            className="bg-red-500 hover:bg-red-700"
          >
            Eliminar
          </Button>
        </div>
      ),
    },
  ];

  return (
    <AppLayout breadcrumbs={breadcrumbs}>
      <Head title="Productos | Lista" />

      <div className="mb-4 flex justify-between">
        <Link href={route('products.create')}>
          <Button>Nuevo Producto</Button>
        </Link>
      </div>

      {loading ? (
        <div className="flex justify-center py-10">
          <Loader2 className="animate-spin w-8 h-8 text-gray-500" />
        </div>
      ) : (
        <DataTable columns={columns} data={products} />
      )}
    </AppLayout>
  );
}