<?php

namespace Plugin\BillmontPaymentGateway\Form\Extension;

use Eccube\Form\Type\Admin\SearchOrderType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Plugin\BillmontPaymentGateway\Entity\PaymentStatus;


class SearchOrderTypeBillmontPaymentExtension extends AbstractTypeExtension {


  public function buildForm(FormBuilderInterface $builder, array $options) {
    
    $statuses = [
      '未決済' => PaymentStatus::OUTSTANDING,
      '実売上' => PaymentStatus::ACTUAL_SALES,
      '返金' => PaymentStatus::CANCEL,
    ];

    $builder->add('billmont_payment_tran_code', TextType::class, array(
      'label' => '決済承認番号', 
      'required' => false

    ))->add('billmont_payment_status_id', ChoiceType::class, array(
      'label' => '決済状況',
      'choices' => $statuses,
      'multiple' => true,
      'expanded' => true,
      'required' => false,
    ));
  }


  public function getExtendedType(){
    return SearchOrderType::class;
  }
}


?>