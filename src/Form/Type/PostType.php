<?php

namespace App\Form\Type;

use Doctrine\DBAL\Types\BooleanType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true,
            ])

            ->add('description', TextareaType::class, [
                'required' => true,
            ])

            ->add('reminder', DateTimeType::class, [
                'required' => true,
            ])

            ->add('reminder_intervals', ChoiceType::class, [
                'required' => true,
                'choices' => [
                    'Hourly' => 'hourly',
                    'Daily' => 'daily',
                    'Weekly' => 'weekly',
                    'Monthly' => 'monthly',
                    'Yearly' => 'yearly'
                ],
                'placeholder' => 'Please Select',
            ])

            ->add('save', SubmitType::class);
    }
}