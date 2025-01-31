<?php

namespace App\Form;

use App\Entity\Marca;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class MarcaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder
            ->add('nombre',TextType::class,[
                'attr'=>[
                    'class'=>'form-control',
                    'placeholder'=>'Nombre de la marca'
                ],
                'required' => false,
            ])
            ->add('signo',TextType::class,[
                'attr'=>[
                    'class'=>'form-control',
                    'placeholder'=>'Ejemplo: < P >'
                ],
                'required'=>false,
            ])
            ->add('asignacion',TextType::class,[
                'attr'=>[
                    'class'=>'form-control',
                    'placeholder'=>'Asignación'
                ],
                'required'=>false,
            ])
            ->add('marca',ChoiceType::class,[
                'choices'=>[
                    'PSEUDO PSORA'=>'PSEUDO PSORA',
                    'PSORA'=>'PSORA',
                    'SIN MARCA GIAMPIETRO'=>'SIN MARCA GIAMPIETRO',
                    'SYPHILLIS'=>'SYPHILLIS'
                ],
                'attr' => [
                    'class' => 'form-control dm-select2',
                ],
                'required' => false
            ])
            ->add('color', ChoiceType::class, [
                'choices' => [
                    'ROJO' => 'ROJO',
                    'VERDE' => 'VERDE',
                    'AZUL' => 'AZUL',
                    'NEGRO' => 'NEGRO'
                ],
                'attr' => [
                    'class' => 'form-control dm-select2',
                ],
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Marca::class,
        ]);
    }
}
