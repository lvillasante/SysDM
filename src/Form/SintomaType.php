<?php

namespace App\Form;

use App\Entity\Sintoma;
use App\Entity\Marca;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class SintomaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('nombre', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Nombre del síntoma'
                ],
                'required' => false,
            ])
            ->add('relacion',ChoiceType::class,[
                'choices'=>[
                    'MENTE'=>'MENTE',
                    'VERTIGO'=>'VERTIGO',
                    'CABEZA'=>'CABEZA',
                    'OJO'=>'OJO',
                    'VISION'=>'VISION',
                    'OIDO'=>'OIDO',
                    'AUDICIÓN'=>'AUDICIÓN',
                    'NARIZ'=>'NARIZ',
                    'CARA'=>'CARA',
                    'BOCA'=>'BOCA',
                    'DIENTES'=>'DIENTES',
                    'GARGANTA'=>'GARGANTA',
                    'GARGANTA EXTERNA (CUELLO)'=>'GARGANTA EXTERNA (CUELLO)',
                    'ESTOMAGO'=>'ESTOMAGO',
                    'ABDOMEN'=>'ABDOMEN',
                    'RECTO'=>'RECTO',
                    'HECES'=>'HECES',
                    'VEJIGA'=>'VEJIGA',
                    'RIÑONES'=>'RIÑONES',
                    'PROSTATA'=>'PROSTATA',
                    'URETRA'=>'URETRA',
                    'ORINA'=>'ORINA',
                    'MASCULINO, GENITAL/SEXO'=>'MASCULINO, GENITAL/SEXO',
                    'FEMENINO, GENITAL/SEXO'=>'FEMENINO, GENITAL/SEXO',
                    'LARINGE Y TRAQUEA'=>'LARINGE Y TRAQUEA',
                    'RESPIRACION'=>'RESPIRACION',
                    'TOS'=>'TOS',
                    'EXPECTORACION'=>'EXPECTORACION',
                    'PECHO'=>'PECHO',
                    'ESPALDA'=>'ESPALDA',
                    'EXTREMIDADES'=>'EXTREMIDADES',
                    'SUEÑO, DOMIR'=>'SUEÑO, DOMIR',
                    'SUEÑOS'=>'SUEÑOS',
                    'ESCALOFRIO'=>'ESCALOFRIO',
                    'FIEBRE'=>'FIEBRE',
                    'TRASNPIRACION'=>'TRASNPIRACION',
                    'PIEL'=>'PIEL',
                    'GENERALES'=>'GENERALES',
                ],
                'attr' => [
                    'class' => 'form-control dm-select2',
                ],
                'required' => false
            ])
            ->add('sintoma', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Nombre del síntoma'
                ],
                'required' => false,
            ])
            ->add('rubro', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Rubro'
                ],
                'required' => false,
            ])
            ->add('subrubro', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Sub-Rubro'
                ],
                'required' => false,
            ])
            ->add('modalidad', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Modalidad'
                ],
                'required' => false,
            ])

            ->add('marcas', EntityType::class, [
                'class' => Marca::class,
                'choice_label' => function ($marca) {
                    return $marca->getNombre()." ".$marca->getSigno() ;
                },
                'multiple' => true,
                "attr" => [
                    "class" => "form-control dm-select2",
                    "style" => "width:100%"
                ],
            ])


            /*->add('createdAt')
            ->add('updatedAt')
            ->add('estado')
            ->add('fidEvento')
            ->add('fidUsuario')*/;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sintoma::class,
        ]);
    }
}
