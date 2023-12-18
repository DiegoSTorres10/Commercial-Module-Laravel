<?php

namespace Database\Seeders;

use App\Models\Proveedore;
use Illuminate\Database\Seeder;

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 20; $i++) {
            $proveedor = new Proveedore();
            $proveedor->NombreComercial = $this->generateCompanyName();
            $proveedor->GrupoEmpresarial = $this->generateCompanyLegalName();
            $proveedor->Telefono = $this->generatePhoneNumber();
            $proveedor->CorreoElectronico = $this->generateEmail();
            $proveedor->save();
        }
    }

    
    private function generateCompanyName()
    {
        $adjectives = ['Tech', 'Digital', 'Innovative', 'Global', 'E-Commerce', 'Cyber', 'Smart', 'Future'];
        $nouns = ['Solutions', 'Systems', 'Tech', 'Electronics', 'Enterprises', 'Devices', 'Techs', 'Gadgets'];
        return $adjectives[array_rand($adjectives)] . ' ' . $nouns[array_rand($nouns)];
    }

    
    private function generateCompanyLegalName()
    {
        $legalNames = ['Inc.', 'Corp.', 'Ltd.', 'LLC', 'Group', 'Enterprises', 'Solutions'];
        return $this->generateCompanyName() . ' ' . $legalNames[array_rand($legalNames)];
    }

    private function generatePhoneNumber()
    {
        $telefonos = [
            '555-123-4567',
            '555-987-6543',
            '555-111-2222',
            '555-333-4444',
            '555-555-5555',
            '555-666-7777',
            '555-888-9999',
            '555-246-8101',
            '555-369-2584',
            '555-135-7913'
        ];
        return $telefonos[array_rand($telefonos)];
    }

    private function generateEmail()
    {
        $correos_electronicos = [
            'juan.perez@example.com',
            'maria.gonzalez@example.com',
            'carlos.lopez@example.com',
            'laura.fernandez@example.com',
            'pedro.martinez@example.com',
            'ana.rodriguez@example.com',
            'sergio.garcia@example.com',
            'monica.diaz@example.com',
            'oscar.perez@example.com',
            'claudia.lopez@example.com'
        ];
        return $correos_electronicos[array_rand($correos_electronicos)];
    }
}
