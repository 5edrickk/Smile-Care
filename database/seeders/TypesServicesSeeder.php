<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('types_services')->insert([
            ['id' => 1,
            'name' => 'Dentisterie opératoire',
            'description' => 'La dentisterie opératoire est une branche de la dentisterie qui se concentre sur la préservation et la restauration des dents endommagées ou atteintes par des caries. L\'objectif principal de la dentisterie opératoire est de traiter les problèmes dentaires en préservant autant que possible la structure dentaire naturelle.'],

            ['id' => 2,
            'name' => 'Médecine buccale',
            'description' => 'La médecine buccale se consacre au diagnostic et aux traitements de lésions, de maladies buccales et de désordres de l\'articulation temporo-mandibulaire. Ces spécialistes sont aussi consultés dans le traitement de personnes ayant des complications médicales comme lors du traitement d\'un cancer.'],

            ['id' => 3,
            'name' => 'Soins de prévention et de parodontie',
            'description' => 'La ou le parodontiste est le spécialiste de la médecine dentaire qui se consacre à la prévention, au diagnostic et au traitement des maladies et affections de l\'os et de la gencive, c\'est-à-dire les tissus de support de la dent.'],

            ['id' => 4,
            'name' => 'Dentisterie pédiatrique',
            'description' => 'La ou le spécialiste en dentisterie pédiatrique est spécialisé dans la prévention, le diagnostic et le traitement destinés aux enfants et aux adolescents, ainsi qu\'aux personnes de tout âge ayant des besoins particuliers.'],

            ['id' => 5,
            'name' => 'Orthodontie',
            'description' => 'L\'orthodontiste est un spécialiste dont l\'expertise est dans le diagnostic, l\'interception et le traitement des anomalies dento-faciales souvent appelées malocclusions. Ce spécialiste élabore la planification, la fabrication et la mise en bouche des appareils dento-orthopédiques nécessaires à l\'alignement des dents, des mâchoires et des tissus mous qui contribuent à l\'harmonie dento-faciale.'],

            ['id' => 6,
            'name' => 'Endodontie',
            'description' => 'L\'endodontiste est un spécialiste qui se consacre à la prévention, au diagnostic et au traitement des maladies de la pulpe dentaire, dans le but de conserver la dent et de garder les tissus environnants, os et gencive, en santé.'],

            ['id' => 7,
            'name' => 'Prosthodontie et implantologie',
            'description' => 'La prosthodontie permet de remplacer des dents manquantes ou détériorées. La ou le  prosthodontiste effectue un diagnostic et établit un plan de traitement pouvant inclure des restaurations, des facettes en porcelaine, des couronnes, des ponts et des plaques occlusales afin de rétablir la fonction masticatoire et l\'aspect esthétique à la suite de pertes de dents.'],

            ['id' => 8,
            'name' => 'Chirurgie',
            'description' => 'La chirurgienne ou le chirurgien buccal et maxillo-facial est certifié pour effectuer la chirurgie des dents, des os et des muscles des mâchoires et de la face. Cette ou ce dentiste spécialiste effectue des chirurgies pouvant aller d\'extractions plus complexes de dents jusqu\'à des chirurgies complexes de reconstruction à la suite d\'un trauma ou d\'une résection de tumeur.'],

            ['id' => 9,
            'name' => 'Radiologie',
            'description' => 'La ou le radiologiste buccal et maxillo-facial est un spécialiste dans la réalisation et l\'interprétation d\'imageries médicales. Elle ou il utilise diverses techniques avancées d\'imagerie et procède à des interprétations plus complexes afin de diagnostiquer plusieurs pathologies et troubles crânio-faciaux.'],
            ]);
    }
}
