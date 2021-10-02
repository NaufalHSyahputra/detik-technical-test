<?php

class Transaction  
{
    private $reference_id;
    private $invoice_id;
    private $item_name;
    private $amount;
    private $payment_type;
    private $customer_name;
    private $merchant_id;
    private $nomor_va;
    private $status;
    private $db;

    public function __construct()
    {
        require_once 'database.php';     
        $this->db = $mysqli;
    }

    /**
     * Get the value of reference_id
     */ 
    public function getReferenceId()
    {
        return $this->reference_id;
    }

    /**
     * Set the value of reference_id
     *
     * @return  self
     */ 
    public function setReferenceId($reference_id)
    {
        $this->reference_id = $reference_id;

        return $this;
    }

    /**
     * Get the value of invoice_id
     */ 
    public function getInvoiceId()
    {
        return $this->invoice_id;
    }

    /**
     * Set the value of invoice_id
     *
     * @return  self
     */ 
    public function setInvoiceId($invoice_id)
    {
        $this->invoice_id = $invoice_id;

        return $this;
    }

    /**
     * Get the value of item_name
     */ 
    public function getItemName()
    {
        return $this->item_name;
    }

    /**
     * Set the value of item_name
     *
     * @return  self
     */ 
    public function setItemName($item_name)
    {
        $this->item_name = $item_name;

        return $this;
    }

    /**
     * Get the value of amount
     */ 
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set the value of amount
     *
     * @return  self
     */ 
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get the value of payment_type
     */ 
    public function getPaymentType()
    {
        return $this->payment_type;
    }

    /**
     * Set the value of payment_type
     *
     * @return  self
     */ 
    public function setPaymentType($payment_type)
    {
        $this->payment_type = $payment_type;

        return $this;
    }

    /**
     * Get the value of customer_name
     */ 
    public function getCustomerName()
    {
        return $this->customer_name;
    }

    /**
     * Set the value of customer_name
     *
     * @return  self
     */ 
    public function setCustomerName($customer_name)
    {
        $this->customer_name = $customer_name;

        return $this;
    }

    /**
     * Get the value of merchant_id
     */ 
    public function getMerchantId()
    {
        return $this->merchant_id;
    }

    /**
     * Set the value of merchant_id
     *
     * @return  self
     */ 
    public function setMerchantId($merchant_id)
    {
        $this->merchant_id = $merchant_id;

        return $this;
    }

    /**
     * Get the value of nomor_va
     */ 
    public function getNomorVA()
    {
        return $this->nomor_va;
    }

    /**
     * Set the value of nomor_va
     *
     * @return  self
     */ 
    public function setNomorVA()
    {
        $nomor_va = $this->generateVA();
        $this->nomor_va = $nomor_va;

        return $this;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    public function createTransaction()
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO transactions (invoice_id, item_name, amount, payment_type, nomor_va, customer_name, merchant_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param(
                "isisssi",
                $this->getInvoiceId(),
                $this->getItemName(),
                $this->getAmount(),
                $this->getPaymentType(),
                $this->getNomorVA(),
                $this->getCustomerName(),
                $this->getMerchantId()
            );
            if ($stmt->execute()) { 
                $reference_id = $stmt->insert_id;
                return ['status' => true, 'message' => 'Create Transaction Success', 'data' => ['reference_id' => $reference_id, 'number_va' => $this->getNomorVA(), 'status' => ucfirst($this->getStatus())]];
            } else { 
                return ['status' => false, 'message' => 'Create Transaction Failed', 'data' => $stmt->error];
            }
        } catch (\Exception $e) {
            return ['status' => false, 'message' => 'Create Transaction Failed', 'data' => $e->getMessage()];
        }
    }

    public function getTransaction()
    {
        $stmt = $this->db->prepare("SELECT id as reference_id, invoice_id, status FROM transactions WHERE id = ? AND merchant_id = ?");
        $stmt->bind_param(
            "ii",
            $this->getReferenceId(),
            $this->getMerchantId()
        );
        $stmt->execute();
        $result = $stmt->get_result(); 
        // $transaction = ;
        return $result->fetch_assoc();
    }

    public function updateTransaction()
    {
        $stmt = $this->db->prepare("UPDATE transactions SET status = ? WHERE id = ?");
        $stmt->bind_param(
            "si",
            $this->getStatus(),
            $this->getReferenceId()
        );
        if ($stmt->execute()) { 
            return ['status' => true, 'message' => 'Update Transaction Success', 'data' => $stmt->affected_rows];
        } else { 
            return ['status' => false, 'message' => 'Update Transaction Failed', 'data' => $stmt->error];
        }
    }

    private function generateVA()
    {
        return random_int(1000000000, 2147483640);
    }
}
