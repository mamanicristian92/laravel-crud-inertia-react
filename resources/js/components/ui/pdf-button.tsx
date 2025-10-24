import React from 'react';
import { Button } from '@/components/ui/button';
export default function PdfButton() {
    const handleClick = () => {
        window.open('/products/report', '_blank');
    };
    return (
        <Button onClick={handleClick}>
            Exportar listado a PDF
        </Button>
    );
}
