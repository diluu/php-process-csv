<?php
namespace app\parse;


/**
 * Class BankTransaction
 * This class holds the information on Bank transactions
 * @package app\parse
 */
class BankTransaction implements \JsonSerializable
{
    private $date;
    private $transaction_code;
    private $customer_number;
    private $reference;
    private $amount;
    private $valid_transaction;

    public function __construct($date, $transaction_code, $customer_number, $reference, $amount)
    {
        $this->date=$date;
        $this->transaction_code=$transaction_code;
        $this->customer_number=$customer_number;
        $this->reference=$reference;
        $this->amount=$amount;
    }

    public function get_date(){
        return $this->date;
    }

    public function get_transaction_code(){
        return $this->transaction_code;
    }

    public function get_customer_number(){
        return $this->customer_number;
    }

    public function get_reference(){
        return $this->reference;
    }

    public function get_amount(){
        return $this->amount;
    }

    public function is_valid_transaction(){
        return $this->valid_transaction;
    }

    public function set_valid_transaction($valid){
        $this->valid_transaction = $valid;
    }


    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
