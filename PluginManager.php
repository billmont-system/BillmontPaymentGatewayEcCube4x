<?php

namespace Plugin\BillmontPaymentGateway;

use Eccube\Entity\Payment;
use Eccube\Plugin\AbstractPluginManager;
use Eccube\Repository\PaymentRepository;
use Plugin\BillmontPaymentGateway\Entity\PaymentStatus;
use Plugin\BillmontPaymentGateway\Service\Method\BillmontPaymentService;

use Symfony\Component\DependencyInjection\ContainerInterface;

class PluginManager extends AbstractPluginManager {

  public function enable(array $meta, ContainerInterface $container) {
    
    $this->createLinkPayment($container);
    $this->createPaymentStatuses($container);

  }

  private function createLinkPayment(ContainerInterface $container) {

    $entityManager = $container->get('doctrine')->getManager();
    $paymentRepository = $container->get(PaymentRepository::class);

    $Payment = $paymentRepository->findOneBy([], ['sort_no' => 'DESC']);
    $sortNo = $Payment ? $Payment->getSortNo() + 1 : 1;

    $Payment = $paymentRepository->findOneBy(['method_class' => BillmontPaymentService::class]);
    if ($Payment) {
      return;
    }

    $Payment = new Payment();
    $Payment->setCharge(0);
    $Payment->setSortNo($sortNo);
    $Payment->setVisible(true);
    $Payment->setMethod('Billmontクレジット決済');
    $Payment->setMethodClass(BillmontPaymentService::class);

    $entityManager->persist($Payment);
    $entityManager->flush($Payment);
  }

  private function createMasterData(ContainerInterface $container, array $statuses, $class) {
    $entityManager = $container->get('doctrine')->getManager();
    $i = 0;
    foreach ($statuses as $id => $name) {
      $PaymentStatus = $entityManager->find($class, $id);
      if (!$PaymentStatus) {
        $PaymentStatus = new $class;
      }
      $PaymentStatus->setId($id);
      $PaymentStatus->setName($name);
      $PaymentStatus->setSortNo($i++);
      $entityManager->persist($PaymentStatus);
      $entityManager->flush($PaymentStatus);
    }
  }

  private function createPaymentStatuses(ContainerInterface $container) {
    $statuses = [
      PaymentStatus::OUTSTANDING => '未決済',
      PaymentStatus::ENABLED => '有効性チェック済',
      PaymentStatus::PROVISIONAL_SALES => '仮売上',
      PaymentStatus::ACTUAL_SALES => '実売上',
      PaymentStatus::CANCEL => 'キャンセル',
    ];
    $this->createMasterData($container, $statuses, PaymentStatus::class);
  }
}

?>