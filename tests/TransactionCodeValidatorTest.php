<?php

use PHPUnit\Framework\TestCase;
use app\parse\TransactionCodeValidator;

class TransactionCodeValidatorTest extends TestCase
{

    /**
     * Test for a valid transaction code
     */
    public function testVerify_key1()
    {
        $valid_transaction_code = TransactionCodeValidator::verify_key("U6BD3M75FD");
        $this->assertTrue($valid_transaction_code, "U6BD3M75FD is a valid transaction code");

    }

    /**
     * Test for an invalid transaction code
     */
    public function testVerify_key2()
    {
        $valid_transaction_code = TransactionCodeValidator::verify_key("WPTJMNVH4U");
        $this->assertFalse($valid_transaction_code, "WPTJMNVH4U is an invalid transaction code");

    }
}
