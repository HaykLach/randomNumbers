<?php declare(strict_types=1);

namespace RandomNumbers\Controllers;

use RandomNumbers\Repositories\RandomNumberRepository;

class RandomNumberGenerator extends BaseController
{

    public function generateNumber()
    {
        $randomNumber = rand();
        $numberRepository = new RandomNumberRepository();
        $details['number'] = $randomNumber;

        $itemId = $numberRepository->createItem($details);
        header("Content-Type: application/json");
        echo json_encode([
            'status' => true,
            'data' => [
                'id' => $itemId,
                'randomNumber' => $randomNumber
            ]
        ]);
        exit();
    }

    /**
     * @param string $id
     */
    public function getNumberById(string $id)
    {
        $numberRepository = new RandomNumberRepository();
        $item = $numberRepository->getItemById((int) $id);

        if (!isset($item['id'])) {
            header("Content-Type: application/json");
            echo json_encode([
                'status' => false,
                'data' => 'Item not found!'
            ]);
            exit();
        }

        header("Content-Type: application/json");
        echo json_encode([
            'status' => true,
            'data' => [
                'id' => $item['id'],
                'randomNumber' => $item['random_number']
            ]
        ]);
        exit();
    }
}