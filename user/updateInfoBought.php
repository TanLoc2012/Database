<?php
    $sql = "UPDATE invoice
            SET invoice.date_pay='2021-11-07'
            WHERE invoice.id=2";
    execute($sql);
    $sql = "UPDATE lend
            SET lend.date_lend='2021-11-07'
            WHERE lend.invoice_id IN (SELECT id FROM invoice WHERE invoice.id=2)";
    execute($sql);
    $sql = "UPDATE bought
            SET bought.purchase_date='2021-11-07'
            WHERE bought.invoice_id IN (SELECT id FROM invoice WHERE invoice.id=2)";
    execute($sql);