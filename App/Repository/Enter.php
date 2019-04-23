<?php

namespace App\Repository;

class Enter extends Base {

    public function getSessionByLaunchKey($launchKey, $fields)
    {
        return [
            'id' => '123',
            'user_id' => 1,
        ];
    }

    public function slotExistForGameCode($gameCode)
    {
        return true;
    }

    public function getAccountById($id, $fields = ['balance', 'bonus', 'exclusion_active', 'activity_status', 'currency'])
    {
        return [
            'balance' => 123,
            'bonus' => 500,
            'exclusion_active' => 0,
            'activity_status' => 1,
            'currency' => 'GBP',
        ];
    }

    public function updateSession($id, $fields)
    {
        return true;
    }

}