<?php

namespace Core;

class HandleError {

    /**
     *  when error is caught die with error page
     */
    public function withMessage($errorCode = null, $errorMessage = null)
    {
        $errorFile = __DIR__ . '/../errors/' . $errorCode . '.php';

        if(file_exists($errorFile))
        {
            $_SESSION['errorCode'] = $errorCode;
            $_SESSION['errorMessage'] = $errorMessage;
        
            include($errorFile);
            exit;
        }
        else
        {
            die('error occurred');
        }
        
    }

}