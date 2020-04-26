<?php
namespace app\parse;

include "BankTransaction.php";
include "TransactionCodeValidator.php";

class CSVParser
{
    /**
     * Main function called from index.php to parse the file
     * @param $csv_file file from frontend
     * @return array of BankTransaction of objects
     */
    public static function parse_csv($csv_file){

        // The array to hold all BankTransaction objects
        $bank_transactions = [];

        // Open the file for reading
        if (($h = fopen("{$csv_file}", "r")) !== FALSE)
        {
            // Read the first line to avoid the header line from processing;
            fgets($h);

            // Each line in the file is converted into an individual array
            // The items of the array are comma separated
            while (($data = fgetcsv($h, 1000, ",")) !== FALSE)
            {
                // create new BankTransaction object from the data and check the validity of transaction code
                $transaction = new BankTransaction(strtotime($data[0]), $data[1], (int)$data[2], $data[3], (int)$data[4]);
                $transaction->set_valid_transaction(TransactionCodeValidator::verify_key($data[1]));
                // new transaction is added to the transactions array
                $bank_transactions[] = $transaction;
            }

            // Close the file
            fclose($h);
        }

        // sort the array by date using the comparator cmp()
        usort($bank_transactions, "self::cmp");

        return $bank_transactions;
    }

    /**
     * Comparator to compare two BankTransaction objects
     * @param $a
     * @param $b
     * @return bool
     */
    static function cmp($a, $b){
        return $a-> get_date() > $b->get_date();
    }

}
