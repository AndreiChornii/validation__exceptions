<?php

class EmptyStringException extends Exception
{
    public function __construct()
    {
        $message = 'Empty string';
        parent::__construct($message);
    }
}

class InvalidInputTypeException extends Exception{
    public function __construct()
    {
        $message = 'Invalid type string';
        parent::__construct($message);
    }
}

class ValidationService
{

    /**
     * @param $message
     * @return bool|null
     * @throws EmptyStringException
     */
    public function ensureTextValid($message): void
    {
        if ($message === "") {
            throw new EmptyStringException();
        }
    }

    public function ensureTypeValid($message): void
    {
//        echo $message . PHP_EOL;
        for ($i=0; $i<strlen($message); $i++){

//            echo $i . ' : '. ord($message[$i]) . PHP_EOL;
            if((ord ($message[$i]) < 48) || (ord($message[$i]) > 57)) throw new InvalidInputTypeException();
        }
    }

    public function getValidation($message): bool
    {
        $this->ensureTextValid($message);

        $this->ensureTypeValid($message);

        return true;
    }
}

$request = json_decode(file_get_contents('php://input'), true);
$validationService = new ValidationService($request['inputed_data']);

try {
    $validationService->getValidation($request['inputed_data']);
//    var_dump($request);
    $rez =  'Valid: '. $request['inputed_data'];

} catch (Exception $exception) {
    $rez = 'Выброшено исключение: ' . $exception->getMessage();
}

    $response = [
        'result' => true,
        'message' => $rez
    ];

    echo json_encode($response);