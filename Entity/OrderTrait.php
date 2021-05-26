<?php

namespace Plugin\BillmontPaymentGateway\Entity;

use Doctrine\ORM\Mapping as ORM;
use Eccube\Annotation\EntityExtension;

/**
 * @EntityExtension("Eccube\Entity\Order")
 */
trait OrderTrait {

  /**
   * 決済ステータスを保持するカラム.
   *
   * dtb_order.billmont_payment_status_id
   *
   * @var BillmontPaymentStatus
   * @ORM\ManyToOne(targetEntity="Plugin\BillmontPaymentGateway\Entity\PaymentStatus")
   * @ORM\JoinColumns({
   *   @ORM\JoinColumn(name="billmont_payment_status_id", referencedColumnName="id")
   * })
   */
  private $BillmontPaymentStatus;


  /**
   * 決済完了時発行する承認番号を保持するカラム.
   *
   * dtb_order.billmont_payment_tran_code
   *
   * @var BillmontPaymentTranCode
   * @ORM\Column(name="billmont_payment_tran_code", type="string", length=255, nullable=true)
   */
  private $BillmontPaymentTranCode;

  /**
   * 決済完了時のクレジット決済明細票記名を保持するカラム.
   *
   * dtb_order.billmont_payment_dba
   *
   * @var BillmontPaymentDba
   * @ORM\Column(name="billmont_payment_dba", type="string", length=255, nullable=true)
   */
  private $BillmontPaymentDba;


  /**
   * @return PaymentStatus
   */
  public function getBillmontPaymentStatus()
  {
    return $this->BillmontPaymentStatus;
  }

  /**
   * @param PaymentStatus $BillmontPaymentStatus|null
   */
  public function setBillmontPaymentStatus(PaymentStatus $BillmontPaymentStatus = null)
  {
      $this->BillmontPaymentStatus = $BillmontPaymentStatus;
  }


  public function getBillmontPaymentTranCode(){
    return $this->BillmontPaymentTranCode;
  }

  public function setBillmontPaymentTranCode($BillmontPaymentTranCode = null){
    $this->BillmontPaymentTranCode = $BillmontPaymentTranCode;
  }


  public function getBillmontPaymentDba(){
    return $this->BillmontPaymentDba;
  }

  public function setBillmontPaymentDba($BillmontPaymentDba = null){
    $this->BillmontPaymentDba = $BillmontPaymentDba;
  }
}