<?php
function fsSendMail($to, $subject, $message)
{
    $headers  .= "From: NFC Support <noreply@nfcsupport.com>\n";    
    $headers .= "MIME-Version: 1.0\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\n";
    $headers .= "Content-Transfer-Encoding: 8bit\n";
    $headers .= "X-NFC-Message-Type: Account Reset Code\n";
    $headers .= "X-Priority: 1\n\n";

    return mail($to, $subject, $message, $headers);
}