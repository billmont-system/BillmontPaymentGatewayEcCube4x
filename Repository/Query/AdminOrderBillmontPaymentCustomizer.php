<?php


namespace Plugin\BillmontPaymentGateway\Repository\Query;

use Eccube\Doctrine\Query\WhereClause;
use Eccube\Doctrine\Query\WhereCustomizer;
use Eccube\Repository\QueryKey;

class AdminOrderBillmontPaymentCustomizer extends WhereCustomizer {


  protected function createStatements($params, $queryKey) {
    $rtn = [];

    if (!empty($params['billmont_payment_tran_code']) && $params['billmont_payment_tran_code']){

       $rtn[] = WhereClause::like('o.BillmontPaymentTranCode', ':BillmontPaymentTranCode', ['BillmontPaymentTranCode' => '%'.$params['billmont_payment_tran_code'].'%' ]);

    }


    if (!empty($params['billmont_payment_status_id']) && $params['billmont_payment_status_id']){

      $rtn[] = WhereClause::in('o.BillmontPaymentStatus', ':BillmontPaymentStatus', ['BillmontPaymentStatus' => $params['billmont_payment_status_id']]);

    }

    return $rtn;
  }


  public function getQueryKey() {
    return QueryKey::ORDER_SEARCH_ADMIN;
  }
}
?>