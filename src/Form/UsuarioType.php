<?php

namespace App\Form;

use App\Entity\Usuario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsuarioType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('apellidoPaterno', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Apellido Paterno'
                ],
                'required' => false,
            ])
            ->add('apellidoMaterno', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Apellido Materno'
                ],
                'required' => false,
            ])
            ->add('username', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Nombres'
                ],
                'required' => true,
            ])
            ->add('numeroIdentificacion', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Número de identificación'
                ],
                'required' => false,
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Email'
                ],
                'required' => true,
            ])
            ->add('especialidad', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Especialidad'
                ],
                'required' => false,
            ])
            ->add('estado', ChoiceType::class, [
                'choices' => [
                    'Activado' => 'activo',
                    'Desactivado' => 'desactivado'
                ],
                'attr' => [
                    'class' => 'form-control',
                ],
                'required' => true
            ])
            ->add('pais', ChoiceType::class, [
                'choices' => [
                    "Afganistán" => "Afganistán",
                    "Albania" => "Albania",
                    "Alemania" => "Alemania",
                    "Andorra" => "Andorra",
                    "Angola" => "Angola",
                    "Anguilla" => "Anguilla",
                    "Antártida" => "Antártida",
                    "Antigua y Barbuda" => "Antigua y Barbuda",
                    "Antillas Holandesas" => "Antillas Holandesas",
                    "Arabia Saudí" => "Arabia Saudí",
                    "Argelia" => "Argelia",
                    "Argentina" => "Argentina",
                    "Armenia" => "Armenia",
                    "Aruba" => "Aruba",
                    "Australia" => "Australia",
                    "Austria" => "Austria",
                    "Azerbaiyán" => "Azerbaiyán",
                    "Bahamas" => "Bahamas",
                    "Bahrein" => "Bahrein",
                    "Bangladesh" => "Bangladesh",
                    "Barbados" => "Barbados",
                    "Bélgica" => "Bélgica",
                    "Belice" => "Belice",
                    "Benin" => "Benin",
                    "Bermudas" => "Bermudas",
                    "Bielorrusia" => "Bielorrusia",
                    "Birmania" => "Birmania",
                    "Bolivia" => "Bolivia",
                    "Bosnia y Herzegovina" => "Bosnia y Herzegovina",
                    "Botswana" => "Botswana",
                    "Brasil" => "Brasil",
                    "Brunei" => "Brunei",
                    "Bulgaria" => "Bulgaria",
                    "Burkina Faso" => "Burkina Faso",
                    "Burundi" => "Burundi",
                    "Bután" => "Bután",
                    "Cabo Verde" => "Cabo Verde",
                    "Camboya" => "Camboya",
                    "Camerún" => "Camerún",
                    "Canadá" => "Canadá",
                    "Chad" => "Chad",
                    "Chile" => "Chile",
                    "China" => "China",
                    "Chipre" => "Chipre",
                    "Ciudad del Vaticano (Santa Sede)" => "Ciudad del Vaticano (Santa Sede)",
                    "Colombia" => "Colombia",
                    "Comores" => "Comores",
                    "Congo" => "Congo",
                    "Congo, República Democrática del" => "Congo, República Democrática del",
                    "Corea" => "Corea",
                    "Corea del Norte" => "Corea del Norte",
                    "Costa de Marfíl" => "Costa de Marfíl",
                    "Costa Rica" => "Costa Rica",
                    "Croacia (Hrvatska)" => "Croacia (Hrvatska)",
                    "Cuba" => "Cuba",
                    "Dinamarca" => "Dinamarca",
                    "Djibouti" => "Djibouti",
                    "Dominica" => "Dominica",
                    "Ecuador" => "Ecuador",
                    "Egipto" => "Egipto",
                    "El Salvador" => "El Salvador",
                    "Emiratos Árabes Unidos" => "Emiratos Árabes Unidos",
                    "Eritrea" => "Eritrea",
                    "Eslovenia" => "Eslovenia",
                    "España" => "España",
                    "Estados Unidos" => "Estados Unidos",
                    "Estonia" => "Estonia",
                    "Etiopía" => "Etiopía",
                    "Fiji" => "Fiji",
                    "Filipinas" => "Filipinas",
                    "Finlandia" => "Finlandia",
                    "Francia" => "Francia",
                    "Gabón" => "Gabón",
                    "Gambia" => "Gambia",
                    "Georgia" => "Georgia",
                    "Ghana" => "Ghana",
                    "Gibraltar" => "Gibraltar",
                    "Granada" => "Granada",
                    "Grecia" => "Grecia",
                    "Groenlandia" => "Groenlandia",
                    "Guadalupe" => "Guadalupe",
                    "Guam" => "Guam",
                    "Guatemala" => "Guatemala",
                    "Guayana" => "Guayana",
                    "Guayana Francesa" => "Guayana Francesa",
                    "Guinea" => "Guinea",
                    "Guinea Ecuatorial" => "Guinea Ecuatorial",
                    "Guinea-Bissau" => "Guinea-Bissau",
                    "Haití" => "Haití",
                    "Honduras" => "Honduras",
                    "Hungría" => "Hungría",
                    "India" => "India",
                    "Indonesia" => "Indonesia",
                    "Irak" => "Irak",
                    "Irán" => "Irán",
                    "Irlanda" => "Irlanda",
                    "Isla Bouvet" => "Isla Bouvet",
                    "Isla de Christmas" => "Isla de Christmas",
                    "Islandia" => "Islandia",
                    "Islas Caimán" => "Islas Caimán",
                    "Islas Cook" => "Islas Cook",
                    "Islas de Cocos o Keeling" => "Islas de Cocos o Keeling",
                    "Islas Faroe" => "Islas Faroe",
                    "Islas Heard y McDonald" => "Islas Heard y McDonald",
                    "Islas Malvinas" => "Islas Malvinas",
                    "Islas Marianas del Norte" => "Islas Marianas del Norte",
                    "Islas Marshall" => "Islas Marshall",
                    "Islas menores de Estados Unidos" => "Islas menores de Estados Unidos",
                    "Islas Palau" => "Islas Palau",
                    "Islas Salomón" => "Islas Salomón",
                    "Islas Svalbard y Jan Mayen" => "Islas Svalbard y Jan Mayen",
                    "Islas Tokelau" => "Islas Tokelau",
                    "Islas Turks y Caicos" => "Islas Turks y Caicos",
                    "Islas Vírgenes (EEUU)" => "Islas Vírgenes (EEUU)",
                    "Islas Vírgenes (Reino Unido)" => "Islas Vírgenes (Reino Unido)",
                    "Islas Wallis y Futuna" => "Islas Wallis y Futuna",
                    "Israel" => "Israel",
                    "Italia" => "Italia",
                    "Jamaica" => "Jamaica",
                    "Japón" => "Japón",
                    "Jordania" => "Jordania",
                    "Kazajistán" => "Kazajistán",
                    "Kenia" => "Kenia",
                    "Kirguizistán" => "Kirguizistán",
                    "Kiribati" => "Kiribati",
                    "Kuwait" => "Kuwait",
                    "Laos" => "Laos",
                    "Lesotho" => "Lesotho",
                    "Letonia" => "Letonia",
                    "Líbano" => "Líbano",
                    "Liberia" => "Liberia",
                    "Libia" => "Libia",
                    "Liechtenstein" => "Liechtenstein",
                    "Lituania" => "Lituania",
                    "Luxemburgo" => "Luxemburgo",
                    "Macedonia, Ex-República Yugoslava de" => "Macedonia, Ex-República Yugoslava de",
                    "Madagascar" => "Madagascar",
                    "Malasia" => "Malasia",
                    "Malawi" => "Malawi",
                    "Maldivas" => "Maldivas",
                    "Malí" => "Malí",
                    "Malta" => "Malta",
                    "Marruecos" => "Marruecos",
                    "Martinica" => "Martinica",
                    "Mauricio" => "Mauricio",
                    "Mauritania" => "Mauritania",
                    "Mayotte" => "Mayotte",
                    "México" => "México",
                    "Micronesia" => "Micronesia",
                    "Moldavia" => "Moldavia",
                    "Mónaco" => "Mónaco",
                    "Mongolia" => "Mongolia",
                    "Montserrat" => "Montserrat",
                    "Mozambique" => "Mozambique",
                    "Namibia" => "Namibia",
                    "Nauru" => "Nauru",
                    "Nepal" => "Nepal",
                    "Nicaragua" => "Nicaragua",
                    "Níger" => "Níger",
                    "Nigeria" => "Nigeria",
                    "Niue" => "Niue",
                    "Norfolk" => "Norfolk",
                    "Noruega" => "Noruega",
                    "Nueva Caledonia" => "Nueva Caledonia",
                    "Nueva Zelanda" => "Nueva Zelanda",
                    "Omán" => "Omán",
                    "Países Bajos" => "Países Bajos",
                    "Panamá" => "Panamá",
                    "Papúa Nueva Guinea" => "Papúa Nueva Guinea",
                    "Paquistán" => "Paquistán",
                    "Paraguay" => "Paraguay",
                    "Perú" => "Perú",
                    "Pitcairn" => "Pitcairn",
                    "Polinesia Francesa" => "Polinesia Francesa",
                    "Polonia" => "Polonia",
                    "Portugal" => "Portugal",
                    "Puerto Rico" => "Puerto Rico",
                    "Qatar" => "Qatar",
                    "Reino Unido" => "Reino Unido",
                    "República Centroafricana" => "República Centroafricana",
                    "República Checa" => "República Checa",
                    "República de Sudáfrica" => "República de Sudáfrica",
                    "República Dominicana" => "República Dominicana",
                    "República Eslovaca" => "República Eslovaca",
                    "Reunión" => "Reunión",
                    "Ruanda" => "Ruanda",
                    "Rumania" => "Rumania",
                    "Rusia" => "Rusia",
                    "Sahara Occidental" => "Sahara Occidental",
                    "Saint Kitts y Nevis" => "Saint Kitts y Nevis",
                    "Samoa" => "Samoa",
                    "Samoa Americana" => "Samoa Americana",
                    "San Marino" => "San Marino",
                    "San Vicente y Granadinas" => "San Vicente y Granadinas",
                    "Santa Helena" => "Santa Helena",
                    "Santa Lucía" => "Santa Lucía",
                    "Santo Tomé y Príncipe" => "Santo Tomé y Príncipe",
                    "Senegal" => "Senegal",
                    "Seychelles" => "Seychelles",
                    "Sierra Leona" => "Sierra Leona",
                    "Singapur" => "Singapur",
                    "Siria" => "Siria",
                    "Somalia" => "Somalia",
                    "Sri Lanka" => "Sri Lanka",
                    "St Pierre y Miquelon" => "St Pierre y Miquelon",
                    "Suazilandia" => "Suazilandia",
                    "Sudán" => "Sudán",
                    "Suecia" => "Suecia",
                    "Suiza" => "Suiza",
                    "Surinam" => "Surinam",
                    "Tailandia" => "Tailandia",
                    "Taiwán" => "Taiwán",
                    "Tanzania" => "Tanzania",
                    "Tayikistán" => "Tayikistán",
                    "Territorios franceses del Sur" => "Territorios franceses del Sur",
                    "Timor Oriental" => "Timor Oriental",
                    "Togo" => "Togo",
                    "Tonga" => "Tonga",
                    "Trinidad y Tobago" => "Trinidad y Tobago",
                    "Túnez" => "Túnez",
                    "Turkmenistán" => "Turkmenistán",
                    "Turquía" => "Turquía",
                    "Tuvalu" => "Tuvalu",
                    "Ucrania" => "Ucrania",
                    "Uganda" => "Uganda",
                    "Uruguay" => "Uruguay",
                    "Uzbekistán" => "Uzbekistán",
                    "Vanuatu" => "Vanuatu",
                    "Venezuela" => "Venezuela",
                    "Vietnam" => "Vietnam",
                    "Yemen" => "Yemen",
                    "Yugoslavia" => "Yugoslavia",
                    "Zambia" => "Zambia",
                    "Zimbabue" => "Zimbabue",
                ],
                'attr' => [
                    'class' => 'form-control dm-select2',
                ],
                'required' => false
            ])
            ->add('role_option', ChoiceType::class, [
                'choices' => [
                    'ADMINISTRADOR' => 'ROLE_ADMIN',
                    'MEDICO' => 'ROLE_MEDICO',
                    'ESTUDIANTE' => 'ROLE_ESTUDIANTE',
                ],
                'attr' => [
                    'class' => 'form-control',
                ],
                'required' => true,
                'mapped' => false
            ])
            /*->add('roles')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('fidEvento')*/;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Usuario::class,
        ]);
    }
}
