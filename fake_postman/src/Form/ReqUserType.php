<?php

namespace App\Form;

use App\Entity\ReqUser;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReqUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Method', ChoiceType::class, [
                'choices' => $this->getChoices()
            ])
            ->add('Url')
            ->add('Token')
            ->add('Body')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ReqUser::class,
        ]);
    }

    private function getChoices(){
        $choices = ReqUser::METHOD;
        $output = [];
        foreach($choices as $k => $v) {
            $output[$v] = $k;
        }
        return $output;
    }
}
